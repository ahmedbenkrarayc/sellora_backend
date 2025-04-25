<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IProductDetailsRepository;
use App\Models\ProductDetails;

class ProductDetailsRepository implements IProductDetailsRepository
{
    public function create(array $data)
    {
        return ProductDetails::create($data);
    }

    public function update($id, array $data)
    {
        $detail = ProductDetails::findOrFail($id);
        return $detail->update($data);
    }

    public function delete($id)
    {
        $detail = ProductDetails::findOrFail($id);
        return $detail->delete();
    }
}
