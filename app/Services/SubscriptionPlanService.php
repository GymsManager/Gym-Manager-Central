<?php

namespace App\Services;

use App\Repositories\Interfaces\SubscriptionPlanRepositoryInterface;

class SubscriptionPlanService
{

    public function __construct(protected SubscriptionPlanRepositoryInterface $subscriptionPlanRepository) {}

    public function list(array $filters = [])
    {
        return $this->subscriptionPlanRepository->all($filters);
    }

    public function show(int $id)
    {
        return $this->subscriptionPlanRepository->find($id);
    }

    public function store(array $data)
    {
        $data['name'] = [
            'ar' => $data['name_ar'] ?? null,
            'en' => $data['name_en'] ?? null,
        ];
        $data['description'] = [
            'ar' => $data['description_ar'] ?? null,
            'en' => $data['description_en'] ?? null,
        ];

        unset($data['name_ar'], $data['name_en']);
        unset($data['description_ar'], $data['description_en']);

        return $this->subscriptionPlanRepository->create($data);
    }
    public function update(int $id, array $data)
    {
        if (isset($data['name_ar']) || isset($data['name_en'])) {
            $existingName = $data->name ?? [];

            $updatedName = [
                'ar' => $data['name_ar'] ?? ($existingName['ar'] ?? null),
                'en' => $data['name_en'] ?? ($existingName['en'] ?? null),
            ];

            $data['name'] = $updatedName;

            unset($data['name_ar'], $data['name_en']);
        }

        if (isset($data['description_ar']) || isset($data['description_en'])) {
            $existingName = $data->description ?? [];

            $updatedName = [
                'ar' => $data['description_ar'] ?? ($existingName['ar'] ?? null),
                'en' => $data['description_en'] ?? ($existingName['en'] ?? null),
            ];

            $data['description'] = $updatedName;

            unset($data['description_ar'], $data['description_en']);
        }

        return $this->subscriptionPlanRepository->update($id, $data);
    }
    public function delete(int $id)
    {
        return $this->subscriptionPlanRepository->delete($id);
    }
}
