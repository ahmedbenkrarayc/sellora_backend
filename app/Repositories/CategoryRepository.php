<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICategoryRepository;
use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function all()
    {
        return Category::all();
    }

    public function find(int $id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = $this->find($id);
        if ($category) {
            return $category->update($data);
        }
        return false;
    }

    public function delete(int $id)
    {
        $category = $this->find($id);
        if ($category) {
            return $category->delete();
        }
        return false;
    }
}
