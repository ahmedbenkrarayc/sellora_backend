<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductDetails\StoreProductDetailRequest;
use App\Http\Requests\ProductDetails\UpdateProductDetailRequest;
use App\Services\ProductDetailService;

class ProductDetailsController extends Controller
{
    private $productDetailService;

    public function __construct(ProductDetailService $productDetailService)
    {
        $this->productDetailService = $productDetailService;
    }

    public function store(StoreProductDetailRequest $request): JsonResponse
    {
        $detail = $this->productDetailService->create($request->validated());
        return response()->json($detail, 201);
    }

    public function update(UpdateProductDetailRequest $request, $id): JsonResponse
    {
        $this->productDetailService->update($id, $request->validated());
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id): JsonResponse
    {
        $this->productDetailService->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
