<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Http\Requests\Product\StorePaymentRequest;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(StorePaymentRequest $request)
    {
        $validated = $request->validated();
        $payment = $this->paymentService->createPayment($validated);
    
        return response()->json($payment, 201);
    }    

    public function getAllPayments()
    {
        $payments = $this->paymentService->getAllPayments();

        return response()->json($payments);
    }
}
