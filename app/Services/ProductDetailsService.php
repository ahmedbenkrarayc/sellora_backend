<?php

namespace App\Services;

use App\Repositories\Interfaces\IProductDetailsRepository;

class ProductDetailsService
{
    private $productDetailsRepository;

    public function __construct(IProductDetailsRepository $productDetailsRepository)
    {
        $this->productDetailsRepository = $productDetailsRepository;
    }

    public function create(array $data)
    {
        return $this->productDetailsRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->productDetailsRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productDetailsRepository->delete($id);
    }
}
