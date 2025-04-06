<?php

namespace App\Repositories\Interfaces;

interface IWishListRepository{
    public function findByCustomerId(int $customerId);
    public function create(int $customerId, int $productVariantId);
    public function delete(int $id);
}