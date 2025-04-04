<?php

namespace App\Services;

use App\Repositories\Interfaces\ICategoryRepository;
use App\Models\Category;

class CategoryService
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->all();
    }

    public function getCategoryById(int $id)
    {
        return $this->categoryRepository->find($id);
    }

    public function createCategory(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(int $id, array $data): bool
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
