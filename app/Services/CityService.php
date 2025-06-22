<?php

namespace App\Services;

use App\Models\City;
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
        $data['name'] = [
            'ar' => $data['name_ar'] ?? null,
            'en' => $data['name_en'] ?? null,
        ];
        unset($data['name_ar'], $data['name_en']);

        return $this->repo->create($data);
    }
    public function update(City $city, array $data)
    {
        if (isset($data['name_ar']) || isset($data['name_en'])) {
            $existingName = $city->name ?? [];

            $updatedName = [
                'ar' => $data['name_ar'] ?? ($existingName['ar'] ?? null),
                'en' => $data['name_en'] ?? ($existingName['en'] ?? null),
            ];

            $data['name'] = $updatedName;

            unset($data['name_ar'], $data['name_en']);
        }
        return $this->repo->update($city, $data);
    }
    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }
}
