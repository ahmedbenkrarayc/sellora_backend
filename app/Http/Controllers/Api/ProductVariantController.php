<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductVariant\StoreProductVariantRequest;
use App\Http\Requests\ProductVariant\UpdateProductVariantRequest;
use App\Services\ProductVariantService;

class ProductVariantController extends Controller
{
    private ProductVariantService $service;

    public function __construct(ProductVariantService $service){
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        $variant = $this->service->getById($id);

        if($variant){
            return response()->json($variant);
        }

        return response()->json(['message' => 'Not found'], 404);
    }

    public function store(StoreProductVariantRequest $request)
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdateProductVariantRequest $request, $id)
    {
        if($this->service->update($id, $request->validated())){
            return response()->json(['message' => 'Updated successfully']);
        }

        return response()->json(['message' => 'Not found'], 404);
    }

    public function destroy($id)
    {
        if($this->service->delete($id)){
            return response()->json([], 204);
        }

        return response()->json(['message' => 'Not found'], 404);
    }
}
