<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return response()->json($this->productService->getAll());
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->productService->getById($id);
        return response()->json($product);
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
}
