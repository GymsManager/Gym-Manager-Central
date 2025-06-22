<?php

namespace App\Services;

use App\Repositories\Interfaces\ActionRepositoryInterface;

class ActionService
{
    public function __construct(protected ActionRepositoryInterface $repo) {}

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
<<<<<<< HEAD
=======
        $data['name'] = [
            'ar' => $data['name_ar'] ?? null,
            'en' => $data['name_en'] ?? null,
        ];
        unset($data['name_ar'], $data['name_en']);

>>>>>>> 51bd07d (Gym-review)
        return $this->repo->create($data);
    }
    public function update(int $id, array $data)
    {
<<<<<<< HEAD
=======
        if (isset($data['name_ar']) || isset($data['name_en'])) {
            $existingName = $city->name ?? [];

            $updatedName = [
                'ar' => $data['name_ar'] ?? ($existingName['ar'] ?? null),
                'en' => $data['name_en'] ?? ($existingName['en'] ?? null),
            ];

            $data['name'] = $updatedName;

            unset($data['name_ar'], $data['name_en']);
        }

>>>>>>> 51bd07d (Gym-review)
        return $this->repo->update($id, $data);
    }
    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }
}
