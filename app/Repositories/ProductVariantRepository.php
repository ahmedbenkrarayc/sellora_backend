<?php

namespace App\Repositories;

use App\Models\ProductVariant;
use App\Repositories\Interfaces\IProductVariantRepository;

class ProductVariantRepository implements IProductVariantRepository
{
    public function all()
    {
        return ProductVariant::all();
    }

    public function find(int $id)
    {
        return ProductVariant::find($id);
    }

    public function create(array $data)
    {
        return ProductVariant::create($data);
    }

    public function update(int $id, array $data)
    {
        $variant = $this->find($id);
        return $variant ? $variant->update($data) : false;
    }

    public function delete(int $id)
    {
        $variant = $this->find($id);
        return $variant ? $variant->delete() : false;
    }
}
