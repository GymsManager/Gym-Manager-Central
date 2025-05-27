<?php

namespace App\Services;

use App\Models\Gym;
use App\Repositories\Interfaces\GymRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GymService
{
    public function __construct(protected GymRepositoryInterface $repo) {}

    public function list(array $filters = [])
    {
        return $this->repo->all($filters);
    }

    public function show(int $id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data): Gym
    {
        return DB::transaction(function () use ($data) {

            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            $data['name'] = [
                'en' => $data['en_name'] ?? '',
                'ar' => $data['ar_name'] ?? '',
            ];

            $gym = $this->repo->create($data);

            $gym->branding()->create($data['branding'] ?? [
                'main_color' => '#222',
                'second_color' => '#fff',
                'cover' => null,
                'logo' => null,
            ]);

            $gym->domain()->create($data['domain'] ?? [
                'domain' => null,
                'is_primary' => false,
            ]);

            $gym->policies()->create($data['policies'] ?? []);

            return $gym->load(['branding', 'policies', 'domain']);
        });
    }

    public function update(int $id, array $data): Gym
    {
        return DB::transaction(function () use ($id, $data) {
            $data['updated_by'] = auth()->id();

            // Handle multilingual name
            if (isset($data['en_name']) || isset($data['ar_name'])) {
                $data['name'] = [
                    'en' => $data['en_name'] ?? '',
                    'ar' => $data['ar_name'] ?? '',
                ];
            }

            // Update the gym
            $gym = $this->repo->update($id, $data);

            // Update related models with fallback defaults
            $gym->branding()->updateOrCreate([], $data['branding']);

            $gym->domain()->updateOrCreate([], $data['domain']);

            $gym->policies()->updateOrCreate([], $data['policies'] ?? []);

            return $gym->load(['branding', 'policies', 'domain']);
        });
    }

    public function destroy(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $gym = $this->repo->find($id);

            $gym->branding()?->delete();
            $gym->domain()?->delete();
            $gym->policies()?->delete();

            return $this->repo->delete($id);
        });
    }
}
