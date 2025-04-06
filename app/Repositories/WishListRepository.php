<?php

namespace App\Repositories;

use App\Models\Wishlist;
use App\Repositories\Interfaces\IWishlistRepository;

class WishlistRepository implements IWishlistRepository
{
    public function findByCustomerId(int $customerId)
    {
        return Wishlist::where('customer_id', $customerId)->with('productvariant')->get();
    }

    public function create(int $customerId, int $productVariantId)
    {
        return Wishlist::firstOrCreate([
            'customer_id' => $customerId,
            'productvariant_id' => $productVariantId
        ]);
    }

    public function delete(int $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        return $wishlist->delete();
    }
}
