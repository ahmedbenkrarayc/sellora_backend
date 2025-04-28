<?php

namespace App\Services;

use App\Repositories\Interfaces\IStoreRepository;
use Illuminate\Support\Str;
use App\Models\Store;
use Illuminate\Support\Facades\Cache;

class StoreService
{
    private IStoreRepository $storeRepository;

    public function __construct(IStoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAllStores()
    {
        return Cache::store('redis')->rememberForever('stores:all', function () {
            return $this->storeRepository->getAll();
        });
    }

    public function getStoreById(int $id)
    {
        return Cache::store('redis')->rememberForever("stores:{$id}", function () use ($id) {
            return $this->storeRepository->findById($id);
        });
    }

    public function getStoreBySubdomain(string $subdomain)
    {
        return Cache::store('redis')->rememberForever("stores:subdomain:{$subdomain}", function () use ($subdomain) {
            return $this->storeRepository->findBySubdomain($subdomain);
        });
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
