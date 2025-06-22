<?php

namespace App\Repositories\Eloquent;

use App\Models\Branch;
use App\Repositories\Interfaces\BranchRepositoryInterface;

class BranchRepository implements BranchRepositoryInterface
{
    public function all(array $filters = []) {
        return Branch::query()
            ->when(isset($filters['name']), function ($q) use ($filters) {
                $q->where(function ($query) use ($filters) {
                    $name = $filters['name'];
                    $query->whereRaw("JSON_SEARCH(LOWER(name), 'one', LOWER(?)) IS NOT NULL", ["%{$name}%"]);
                });
            })
            ->when(isset($filters['status']), function ($q) use ($filters) {
                $q->where('status', $filters['status']);
            })
            ->get();
    }

    public function find(int $id) {
        return Branch::with(['Contacts', 'Addresses','Configs', 'Commerces'])->findOrFail($id);
    }

    public function create(array $data) {
        return Branch::create($data);
    }

    public function update(int $id, array $data) {
        $gym = Branch::findOrFail($id);
        $gym->update($data);
        return $gym;
    }

    public function delete(int $id) {
        return Branch::findOrFail($id)->delete();
    }
}
