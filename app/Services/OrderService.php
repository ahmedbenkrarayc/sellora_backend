<?php

namespace App\Services;

use App\Repositories\Interfaces\IOrderRepository;
use App\Events\OrderCreated;

class OrderService
{
    private $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data)
    {
        $productVariants = $data['product_variants'];
        unset($data['product_variants']);

        $order = $this->orderRepository->create($data);

        foreach ($productVariants as $variant) {
            $order->productvariants()->attach($variant['id'], [
                'quantity' => $variant['quantity']
            ]);
        }

        $order = $order->load(
            'productvariants.images', 
            'customer.user', 
            'customer.store.storeowner'
        );

        OrderCreated::dispatch($order);
        
        return $order;
    }

    public function getAll()
    {
        return $this->orderRepository->all();
    }

    public function getById($id)
    {
        return $this->orderRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->orderRepository->delete($id);
    }

    public function updateStatus($id, $status)
    {
        return $this->orderRepository->updateStatus($id, $status);
    }
}
