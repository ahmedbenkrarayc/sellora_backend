<?php

namespace App\Services;

use App\Repositories\Interfaces\IWishListRepository;

class WishlistService
{
    private IWishListRepository $wishlistRepository;

    public function __construct(IWishListRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function getCustomerWishlist(int $customerId)
    {
        return $this->wishlistRepository->findByCustomerId($customerId);
    }

    public function addToWishList(int $customerId, int $productVariantId)
    {
        try{
            $this->wishlistRepository->create($customerId, $productVariantId);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    public function removeFromWishList(int $id)
    {
        try{
            $this->wishlistRepository->delete($id);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
