<?php

namespace App\Repositories\Eloquent;

use App\Models\Action;
use App\Repositories\Interfaces\ActionRepositoryInterface;

class ActionRepository implements ActionRepositoryInterface
{
    public function all(array $filters = []) {
        return Action::query()->when(isset($filters['name']), fn($q) =>
            $q->where('name', $filters['name'])
        )->get();
    }

    public function find(int $id) {
        return Action::findOrFail($id);
    }

    public function create(array $data) {
        return Action::create($data);
    }

    public function update(int $id, array $data) {
        $Action = Action::findOrFail($id);
        $Action->update($data);
        return $Action;
    }

    public function delete(int $id) {
        return Action::findOrFail($id)->delete();
    }
}

