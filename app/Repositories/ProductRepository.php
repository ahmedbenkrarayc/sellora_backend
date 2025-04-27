<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IProductRepository;
use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function all($store_id)
    {
        return Product::whereHas('subcategory.category', function ($query) use ($store_id) {
            $query->where('store_id', $store_id);
        })->get();
    }

    public function find($id): ?Product
    {
        return Product::findOrFail($id);
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
}
