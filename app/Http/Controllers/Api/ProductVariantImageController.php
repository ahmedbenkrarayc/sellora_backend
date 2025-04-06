<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductVariantImage\StoreProductVariantImageRequest;
use App\Services\ProductVariantImageService;
use Illuminate\Http\Request;

class ProductVariantImageController extends Controller
{
    private $productVariantImageService;

    public function __construct(ProductVariantImageService $productVariantImageService)
    {
        $this->productVariantImageService = $productVariantImageService;
    }

    public function create(StoreProductVariantImageRequest $request)
    {
        $image = $this->productVariantImageService->create(
            ['productvariant_id' => $request->productvariant_id],
            $request->file('file')
        );

        return response()->json($image, 201);
    }

    public function delete($id)
    {
        $image = $this->productVariantImageService->delete($id);

        if ($image) {
            return response()->json(['message' => 'Image deleted successfully'], 200);
        }

        return response()->json(['message' => 'Image not found'], 404);
    }
}
