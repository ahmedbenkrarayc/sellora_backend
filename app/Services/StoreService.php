<?php

namespace App\Services;

use App\Repositories\Interfaces\IStoreRepository;
use Illuminate\Support\Str;
use App\Models\Store;

class StoreService
{
    private IStoreRepository $storeRepository;

    public function __construct(IStoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAllStores()
    {
        return $this->storeRepository->getAll();
    }

    public function getStoreById(int $id)
    {
        return $this->storeRepository->findById($id);
    }

    public function createStore(array $data)
    {
        $logoPath = null;
        if (isset($data['logo'])) {
            $logoFile = $data['logo'];
            $uniqueName = Str::uuid() . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('logos', $uniqueName, 'public');
            $data['logo'] = $logoPath;
        }
        
        return $this->storeRepository->create($data);
    }

    public function updateStore(int $id, array $data)
    {
        return $this->storeRepository->update($id, $data);
    }

    public function deleteStore(int $id)
    {
        return $this->storeRepository->delete($id);
    }
}
