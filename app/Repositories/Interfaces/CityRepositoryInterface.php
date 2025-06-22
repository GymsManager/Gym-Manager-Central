<?php

namespace App\Repositories\Interfaces;

interface CityRepositoryInterface
{
    public function all(array $filters = []);
    public function find(int $id);
    public function create(array $data);
    public function update($model, array $data);
    public function delete(int $id);
}
