<?php

namespace App\Repositories\Interfaces;

interface IProductVariantImageRepository
{
    public function create(array $data);
    public function delete(int $id);
}
