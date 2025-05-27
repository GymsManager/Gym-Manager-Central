<?php

namespace App\Repositories\Eloquent;

use App\Models\Feature;
use App\Repositories\Interfaces\FeatureRepositoryInterface;

class FeatureRepository implements FeatureRepositoryInterface
{
    public function all(array $filters = []) {
        return Feature::query()->when(isset($filters['name']), fn($q) =>
            $q->where('name', $filters['name'])
        )->get();
    }

    public function find(int $id) {
        return Feature::findOrFail($id);
    }

    public function create(array $data) {
        return Feature::create($data);
    }

    public function update(int $id, array $data) {
        $Feature = Feature::findOrFail($id);
        $Feature->update($data);
        return $Feature;
    }

    public function delete(int $id) {
        return Feature::findOrFail($id)->delete();
    }
}

