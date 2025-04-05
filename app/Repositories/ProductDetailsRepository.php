<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IProductDetailsRepository;
use App\Models\ProductDetails;

class ProductDetailsRepository implements IProductDetailsRepository
{
    public function create(array $data)
    {
        return ProductDetail::create($data);
    }

    public function update($id, array $data)
    {
        $detail = ProductDetail::findOrFail($id);
        return $detail->update($data);
    }

    public function delete($id)
    {
        $detail = ProductDetail::findOrFail($id);
        return $detail->delete();
    }
}
