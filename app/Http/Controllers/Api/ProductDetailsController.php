<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductDetails\StoreProductDetailsRequest;
use App\Http\Requests\ProductDetails\UpdateProductDetailsRequest;
use App\Services\ProductDetailsService;

class ProductDetailsController extends Controller
{
    private $productDetailService;

    public function __construct(ProductDetailsService $productDetailService)
    {
        $this->productDetailService = $productDetailService;
    }

    public function store(StoreProductDetailsRequest $request)
    {
        $detail = $this->productDetailService->create($request->validated());
        return response()->json($detail, 201);
    }

    public function update(UpdateProductDetailsRequest $request, $id)
    {
        $this->productDetailService->update($id, $request->validated());
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $this->productDetailService->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
