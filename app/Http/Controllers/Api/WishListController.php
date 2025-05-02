<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WishList\StoreWishListRequest;
use App\Services\WishlistService;

class WishListController extends Controller
{
    private WishlistService $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index($id)
    {
        $wishlist = $this->wishlistService->getCustomerWishlist($id);

        return response()->json($wishlist);
    }

    public function store(StoreWishListRequest $request)
    {
        if($this->wishlistService->addToWishList($request->customer_id, $request->productvariant_id)){
            return response()->json(['message' => 'Added to wishlist'], 201);
        }

        return response()->json(['message' => 'Something went wrong !'], 500);
    }

    public function destroy(Request $request, $id)
    {
        if($this->wishlistService->removeFromWishList($request->id)){
            return response()->json([], 204);
        }

        return response()->json(['message' => 'WishList item not found!'], 204);
    }
}
