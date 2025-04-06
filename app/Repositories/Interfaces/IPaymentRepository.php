<?php

namespace App\Repositories\Interfaces;

interface IPaymentRepository
{
    public function create(array $data);
    public function getAll();
}