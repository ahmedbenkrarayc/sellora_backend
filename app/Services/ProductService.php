<?php

namespace App\Services;

use App\Repositories\Interfaces\IProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll($store_id)
    {
        return $this->productRepository->all($store_id);
    }

    public function getById($id)
    {
        return $this->productRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function curratedPicks($store_id)
    {
        return $this->productRepository->curratedPicks($store_id);
    }
}
