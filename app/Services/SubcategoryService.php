<?php

namespace App\Services;

use App\Repositories\ISubcategoryRepository;

class SubcategoryService
{
    private $subcategoryRepository;

    public function __construct(ISubcategoryRepository $subcategoryRepository)
    {
        $this->subcategoryRepository = $subcategoryRepository;
    }

    public function getAll()
    {
        return $this->subcategoryRepository->all();
    }

    public function getById($id)
    {
        return $this->subcategoryRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->subcategoryRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->subcategoryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->subcategoryRepository->delete($id);
    }
}
