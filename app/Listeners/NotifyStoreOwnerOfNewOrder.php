<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NotifyStoreOwnerOrderMail;
use Illuminate\Support\Facades\Mail;

class NotifyStoreOwnerOfNewOrder implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        Mail::to($order->customer->store->storeowner->email)->send(new NotifyStoreOwnerOrderMail($order));
    }
}
