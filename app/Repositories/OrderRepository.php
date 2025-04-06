<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\IOrderRepository;

class OrderRepository implements IOrderRepository
{
    public function create(array $data)
    {
        return Order::create($data);
    }

    public function findById(int $id)
    {
        return Order::with('productvariants')->findOrFail($id);
    }

    public function updateStatus(int $id, string $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
        return $order;
    }

    public function delete(int $id)
    {
        return Order::destroy($id);
    }

    public function all()
    {
        return Order::with('productvariants')->get();
    }
}
