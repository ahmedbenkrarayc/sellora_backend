<?php

namespace App\Services;

use App\Repositories\Interfaces\ISizeRepository;

class SizeService
{
    private $sizeRepository;

    public function __construct(ISizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    public function create(array $data)
    {
        return $this->sizeRepository->create($data);
    }

    public function delete(int $id)
    {
        return $this->sizeRepository->delete($id);
    }

    public function show(int $id)
    {
        return $this->sizeRepository->show($id);
    }
}
