<?php

namespace App\Services;

use App\Models\Branch;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BranchService
{
    public function __construct(protected BranchRepositoryInterface $repo) {}

    public function list(array $filters = [])
    {
        return $this->repo->all($filters);
    }

    public function show(int $id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data): Branch
    {
        return DB::transaction(function () use ($data) {

            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            $data['name'] = [
                'en' => $data['en_name'] ?? '',
                'ar' => $data['ar_name'] ?? '',
            ];

            $branch = $this->repo->create($data);

            $branch->Contacts()->create($data['contact']);
            $branch->Addresses()->create($data['addresses']);
            $branch->Configs()->create($data['configs']);
            $branch->Commerces()->create($data['commerces']);

            return $branch->load(['Contacts', 'Addresses', 'Configs','Commerces']);
        });
    }

    public function update(int $id, array $data): Branch
    {
        return DB::transaction(function () use ($id, $data) {

            $data['updated_by'] = auth()->id();

            $gym = $this->repo->update($id, $data);

            $gym->branding()->updateOrCreate([], $data['branding'] ?? []);
            $gym->contacts()->updateOrCreate([], $data['contacts'] ?? []);
            $gym->addresses()->updateOrCreate([], $data['addresses'] ?? []);
            $gym->policies()->updateOrCreate([], $data['policies'] ?? []);
            $gym->configs()->updateOrCreate([], $data['config'] ?? []);
            $gym->commerce()->updateOrCreate([], $data['commerce'] ?? []);

            return $gym->load(['branding', 'contacts', 'addresses', 'policies', 'configs', 'commerce']);
        });
    }

    public function destroy(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $gym = $this->repo->find($id);

            // Delete related models first (if needed)
            $gym->branding()->delete();
            $gym->contacts()->delete();
            $gym->addresses()->delete();
            $gym->policies()->delete();
            $gym->configs()->delete();
            $gym->commerce()->delete();

            return $this->repo->delete($id);
        });
    }
}
