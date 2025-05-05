<?php

namespace App\Repositories\Interfaces;

interface IOrderRepository{
    public function create(array $data);
    public function findById(int $id);
    public function updateStatus(int $id, string $status);
    public function delete(int $id);
    public function all(int $store_id);
    public function ordersByCustomer(int $customer_id);
}