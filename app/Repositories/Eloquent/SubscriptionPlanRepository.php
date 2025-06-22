<?php

namespace App\Repositories\Eloquent;

use App\Models\SubscriptionPlan;
use App\Repositories\Interfaces\SubscriptionPlanRepositoryInterface;

class SubscriptionPlanRepository implements SubscriptionPlanRepositoryInterface
{
    public function all(array $filters = []) {
        return SubscriptionPlan::query()->when(isset($filters['name']), fn($q) =>
            $q->where('name', $filters['name'])
        )->get();
    }

    public function find(int $id) {
        return SubscriptionPlan::findOrFail($id);
    }

    public function create(array $data) {
        return SubscriptionPlan::create($data);
    }

    public function update(int $id, array $data) {
        $SubscriptionPlan = SubscriptionPlan::findOrFail($id);
        $SubscriptionPlan->update($data);
        return $SubscriptionPlan;
    }

    public function delete(int $id) {
        return SubscriptionPlan::findOrFail($id)->delete();
    }
}
