<?php

namespace App\Repositories\Interfaces;

interface IColorRepository{
    public function create(array $data);
    public function delete(int $id);
    public function show(int $id);
}