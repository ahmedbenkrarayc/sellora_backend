<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Exceptions\IncompletePayment;
use App\Models\SubscriptionHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Carbon;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $user = $request->user();

        $paymentMethod = $request->payment_method;
        $priceId = config('services.stripe.price_id');

        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);

        $subscription = $user->newSubscription('default', $priceId)->create($paymentMethod);

        $user->store->update([
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        SubscriptionHistory::create([
            'user_id' => $user->id,
            'status' => 'success',
            'message' => 'Subscription started',
            'recorded_at' => now(),
        ]);

        return response()->json(['message' => 'Subscribed successfully.']);
    }

    public function cancel(Request $request)
    {
        $user = $request->user();
        $user->subscription('default')->cancel();

        $user->store->update(['is_active' => false]);

        SubscriptionHistory::create([
            'user_id' => $user->id,
            'status' => 'canceled',
            'message' => 'User canceled subscription',
            'recorded_at' => now(),
        ]);

        return response()->json(['message' => 'Subscription canceled.']);
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            return response('Invalid payload', 400);
        }

        if ($event->type === 'invoice.payment_failed') {
            $customerId = $event->data->object->customer;

            $user = User::where('stripe_id', $customerId)->first();
            if ($user) {
                $user->store->update(['is_active' => false]);

                SubscriptionHistory::create([
                    'user_id' => $user->id,
                    'status' => 'failed',
                    'message' => $event->data->object->latest_invoice,
                    'recorded_at' => now(),
                ]);
            }
        }

        if ($event->type === 'invoice.payment_succeeded') {
            $customerId = $event->data->object->customer;
            $user = User::where('stripe_id', $customerId)->first();
            if ($user) {
                $user->store->update([
                    'is_active' => true,
                    'subscribed_at' => now()
                ]);

                SubscriptionHistory::create([
                    'user_id' => $user->id,
                    'status' => 'success',
                    'message' => 'Payment succeeded',
                    'recorded_at' => now(),
                ]);
            }
        }

        return response('Webhook handled', 200);
    }
}
