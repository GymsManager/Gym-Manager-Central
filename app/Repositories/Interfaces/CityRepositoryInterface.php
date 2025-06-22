<?php

namespace App\Repositories\Interfaces;

interface CityRepositoryInterface
{
    public function all(array $filters = []);
    public function find(int $id);
    public function create(array $data);
<<<<<<< HEAD
    public function update(int $id, array $data);
=======
    public function update($model, array $data);
>>>>>>> 51bd07d (Gym-review)
    public function delete(int $id);
}
