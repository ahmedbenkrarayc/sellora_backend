<?php

namespace App\Services;

use App\Repositories\Interfaces\IPaymentRepository;
use App\Models\Payment;

class PaymentService
{
    private $paymentRepository;

    public function __construct(IPaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(array $data)
    {
        return $this->paymentRepository->create($data);
    }

    public function getAllPayments()
    {
        return $this->paymentRepository->getAll();
    }
}
