<?php

namespace App\Services;

use App\Repositories\Interfaces\CityRepositoryInterface;

class CityService
{
    public function __construct(protected CityRepositoryInterface $repo) {}

    public function list(array $filters = [])
    {
        return $this->repo->all($filters);
    }

    public function show(int $id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }
    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }
    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }
}
