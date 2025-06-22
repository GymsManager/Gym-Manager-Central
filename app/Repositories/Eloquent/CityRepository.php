<?php

namespace App\Repositories\Eloquent;

use App\Models\City;
use App\Repositories\Interfaces\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function all(array $filters = []) {
        return City::query()->when(isset($filters['name']), fn($q) =>
            $q->where('name', $filters['name'])
        )->get();
    }

    public function find(int $id) {
        return City::findOrFail($id);
    }

    public function create(array $data) {
        return City::create($data);
    }

<<<<<<< HEAD
    public function update(int $id, array $data) {
        $city = City::findOrFail($id);
        $city->update($data);
        return $city;
=======
    public function update($City, array $data) {

        $City->update($data);
        return $City;
>>>>>>> 51bd07d (Gym-review)
    }

    public function delete(int $id) {
        return City::findOrFail($id)->delete();
    }
}

