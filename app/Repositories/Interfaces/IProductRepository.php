<?php

namespace App\Repositories\Interfaces;

interface IProductRepository{
    public function all(int $store_id);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function curratedPicks(int $store_id);
    public function getLatestProducts(int $store_id);
}