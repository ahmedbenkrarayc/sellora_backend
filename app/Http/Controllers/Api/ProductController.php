<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($store_id)
    {
        $products = $this->productService->getAll($store_id);
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return (new ProductResource($product))->response()->setStatusCode(201);
    }

    public function show($id)
    {
        $product = $this->productService->getById($id);
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $this->productService->update($id, $request->validated());
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function curratedPicks($store_id){
        $products = $this->productService->curratedPicks($store_id);
        return ProductResource::collection($products);
    }
}
