<?php

namespace App\Repositories\Eloquent;

use App\Models\Gym;
use App\Repositories\Interfaces\GymRepositoryInterface;

class GymRepository implements GymRepositoryInterface
{
    public function all(array $filters = []) {
        return Gym::query()->when(isset($filters['status']), fn($q) =>
            $q->where('status', $filters['status'])
        )->get();
    }

    public function find(int $id) {
<<<<<<< HEAD
        return Gym::with(['branding', 'contacts','domain'])->findOrFail($id);
=======
        return Gym::with(['branding', 'policies', 'domain', 'features', 'actions'])->findOrFail($id);
>>>>>>> 51bd07d (Gym-review)
    }

    public function create(array $data) {
        return Gym::create($data);
    }

    public function update(int $id, array $data) {
        $gym = Gym::findOrFail($id);
        $gym->update($data);
        return $gym;
    }

    public function delete(int $id) {
        return Gym::findOrFail($id)->delete();
    }
}
