<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IColorRepository;
use App\Models\Color;

class ColorRepository implements IColorRepository
{
    public function create(array $data)
    {
        return Color::create($data);
    }

    public function delete(int $id)
    {
        $color = Color::findOrFail($id);
        return $color->delete();
    }

    public function show(int $id)
    {
        return Color::findOrFail($id);
    }
}
