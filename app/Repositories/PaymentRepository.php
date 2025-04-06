<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IPaymentRepository;
use App\Models\Payment;

class PaymentRepository implements IPaymentRepository
{
    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function getAll()
    {
        return Payment::all();
    }
}
