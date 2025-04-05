<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IProductRepository;
use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function all()
    {
        return Product::all();
    }

    public function find($id): ?Product
    {
        return Product::find($id);
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
