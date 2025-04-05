<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ISubcategoryRepository;
use App\Models\Subcategory;

class SubcategoryRepository implements ISubcategoryRepository
{
    public function all()
    {
        return Subcategory::all();
    }

    public function find($id)
    {
        return Subcategory::find($id);
    }

    public function create(array $data)
    {
        return Subcategory::create($data);
    }

    public function update($id, array $data)
    {
        $subcategory = Subcategory::findOrFail($id);
        return $subcategory->update($data);
    }

    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return $subcategory->delete();
    }
}