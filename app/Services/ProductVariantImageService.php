<?php

namespace App\Services;

use App\Repositories\Interfaces\IProductVariantImageRepository;
use Illuminate\Support\Str;

class ProductVariantImageService
{
    private $productVariantImageRepository;

    public function __construct(IProductVariantImageRepository $productVariantImageRepository)
    {
        $this->productVariantImageRepository = $productVariantImageRepository;
    }

    public function create(array $data, $file)
    {
        $fileExtension = $file->getClientOriginalExtension();
        $uniqueFileName = Str::uuid() . '.' . $fileExtension;
        
        $path = $file->storeAs('productimages', $uniqueFileName, 'public');

        $data['path'] = $path;

        return $this->productVariantImageRepository->create($data);
    }

    public function delete(int $id)
    {
        return $this->productVariantImageRepository->delete($id);
    }
}
