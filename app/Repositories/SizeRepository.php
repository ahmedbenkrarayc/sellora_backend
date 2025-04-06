<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ISizeRepository;
use App\Models\Size;

class SizeRepository implements ISizeRepository
{
    public function create(array $data)
    {
        return Size::create($data);
    }

    public function delete(int $id)
    {
        $size = Size::findOrFail($id);
        return $size->delete();
    }

    public function show(int $id)
    {
        return Size::findOrFail($id);
    }
}
