<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IStoreRepository;
use App\Models\Store;

class AuthRepository implements IAuthRepository{

    public function getAll(){
        $stores = Store::with('customers', 'storeowner', 'categories.subcategories')->get();
        return $stores;
    }

    public function findById(int $id){
        $store = Store::with('storeowner', 'storeowner', 'categories.subcategories')->findOrFail($id);
        return $store;
    }

    public function create(array $data){
        $store = Store::create($data);
        return $store;
    }

    public function update(int $id, array $data){
        $store = Store::findOrFail($id);
        $store->update($data);
        return $store;
    }

    public function delete(int $id){
        $store = Store::findOrFail($id);
        return $store->delete();
    }
}