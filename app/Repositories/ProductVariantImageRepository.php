<?php

namespace App\Repositories;

use App\Models\ProductVariantImage;
use App\Repositories\Interfaces\IProductVariantImageRepository;
use Illuminate\Support\Facades\Storage;

class ProductVariantImageRepository implements IProductVariantImageRepository
{
    public function create(array $data)
    {
        return ProductVariantImage::create($data);
    }

    public function delete(int $id)
    {
        $image = ProductVariantImage::findOrFail($id);
        
        if (Storage::exists($image->path)) {
            Storage::delete($image->path);
        }

        return $image->delete();
    }
}
