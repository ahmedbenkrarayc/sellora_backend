<?php

namespace App\Repositories\Interfaces;
use App\Models\Store;

interface IStoreRepository{
    public function getAll();
    public function findById(int $id);
    public function findBySubdomain(string $subdomain);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function updateStatus(int $id, string $status);
}