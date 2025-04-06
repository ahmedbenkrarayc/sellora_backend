<?php

namespace App\Services;

use App\Repositories\Interfaces\IProductVariantImageRepository;

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
        
        $path = $file->storeAs('productimages', $uniqueFileName);

        $data['path'] = $path;

        return $this->productVariantImageRepository->create($data);
    }

    public function delete(int $id)
    {
        return $this->productVariantImageRepository->delete($id);
    }
}
