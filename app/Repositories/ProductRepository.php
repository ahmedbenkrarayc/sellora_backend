<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IProductRepository;
use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function all($store_id)
    {
        return Product::with([
            'subcategory.category', 
            'productdetails', 
            'productvariants.color', 
            'productvariants.size', 
            'productvariants.images'
        ])
        ->whereHas('subcategory.category', function ($query) use ($store_id) {
            $query->where('store_id', $store_id);
        })->get();
    }

    public function find($id): ?Product
    {
        return Product::with([
            'subcategory.category', 
            'productdetails', 
            'productvariants.color', 
            'productvariants.size', 
            'productvariants.images'
        ])->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update($id, array $data): bool
    {
        $product = Product::findOrFail($id);
        return $product->update($data);
    }

    public function delete($id): bool
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    public function curratedPicks($store_id)
    {
        $limit = 10;
        return Product::with([
            'subcategory.category', 
            'productdetails', 
            'productvariants.color', 
            'productvariants.size', 
            'productvariants.images'
        ])
        ->whereHas('subcategory.category', function ($query) use ($store_id) {
            $query->where('store_id', $store_id);
        })
        ->inRandomOrder()
        ->limit($limit)
        ->get();
    }

    public function getLatestProducts($store_id)
    {
        $limit = 10;
        return Product::with([
            'subcategory.category', 
            'productdetails', 
            'productvariants.color', 
            'productvariants.size', 
            'productvariants.images'
        ])
        ->whereHas('subcategory.category', function ($query) use ($store_id) {
            $query->where('store_id', $store_id);
        })
        ->orderByDesc('created_at')
        ->limit($limit)
        ->get();
    }
    
}
