<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\SubCategoryResource;
use App\Http\Resources\Product\ProductVariantResource;
use App\Http\Resources\Product\ProductDetailResource;
use App\Http\Resources\Options\ColorResource;
use App\Http\Resources\Options\SizeResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'baseprice' => $this->baseprice,
            'subcategory_id' => $this->subcategory_id,
            'subcategory' => new SubcategoryResource($this->whenLoaded('subcategory')),
            'colors' => ColorResource::collection($this->whenLoaded('colors')),
            'sizes' => SizeResource::collection($this->whenLoaded('sizes')),
            'variants' => ProductVariantResource::collection($this->whenLoaded('productvariants')),
            'product_details' => ProductDetailResource::collection($this->whenLoaded('productdetails')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
