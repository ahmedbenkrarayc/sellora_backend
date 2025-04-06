<?php

namespace App\Services;

use App\Repositories\Interfaces\IColorRepository;

class ColorService
{
    private $colorRepository;

    public function __construct(IColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function create(array $data)
    {
        return $this->colorRepository->create($data);
    }

    public function delete(int $id)
    {
        return $this->colorRepository->delete($id);
    }

    public function show(int $id)
    {
        return $this->colorRepository->show($id);
    }
}
