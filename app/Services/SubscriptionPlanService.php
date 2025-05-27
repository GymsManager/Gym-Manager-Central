<?php

namespace App\Services;

use App\Repositories\Interfaces\SubscriptionPlanRepositoryInterface;

class SubscriptionPlanService
{

    public function __construct(protected SubscriptionPlanRepositoryInterface $subscriptionPlanRepository){}

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
        return $this->subscriptionPlanRepository->create($data);
    }
    public function update(int $id, array $data)
    {
        return $this->subscriptionPlanRepository->update($id, $data);
    }
    public function delete(int $id)
    {
        return $this->subscriptionPlanRepository->delete($id);
    }
}
