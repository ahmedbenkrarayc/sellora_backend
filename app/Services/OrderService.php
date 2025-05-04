<?php

namespace App\Services;

use App\Repositories\Interfaces\IOrderRepository;
use App\Events\OrderCreated;
use App\Events\RealTimeOrderCreated;
use App\Events\RealTimeOrderStatusUpdated;

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
        broadcast(new RealTimeOrderCreated($order));
        return $order;
    }

    public function getAll($store_id)
    {
        $orders = $this->orderRepository->all($store_id);
        $orders->load(            
            'productvariants.images', 
            'customer.user', 
            'customer.store.storeowner'
        );
        return $orders;
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
        $order = $this->orderRepository->updateStatus($id, $status);
        $orders->load(            
            'productvariants.images', 
            'customer.user', 
            'customer.store.storeowner'
        );
        broadcast(new RealTimeOrderStatusUpdated($order));
        return $order;
    }
}
