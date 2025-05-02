<?php

namespace App\Repositories;

use App\Models\Wishlist;
use App\Repositories\Interfaces\IWishListRepository;

class WishlistRepository implements IWishListRepository
{
    public function findByCustomerId(int $customerId)
    {
        return Wishlist::where('customer_id', $customerId)->with('productvariant.product', 'productvariant.images')->get();
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
