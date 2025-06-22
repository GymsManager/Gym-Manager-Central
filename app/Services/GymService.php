<?php

namespace App\Services;

use App\Models\Gym;
use App\Repositories\Interfaces\GymRepositoryInterface;
use App\Traits\HandlesFileAttributes;
use Illuminate\Support\Facades\DB;

class GymService
{
    use HandlesFileAttributes;

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

            $data['branding'] = [
                'main_color' => $data['main_color'] ?? '#222',
                'second_color' => $data['second_color'] ?? '#fff',
                'cover' => $data['cover'] ?? null,
                'logo' => $data['logo'] ?? null,
            ];

            $gym->branding()->create($data['branding'] ?? [
                'main_color' => '#222',
                'second_color' => '#fff',
                'cover' => null,
                'logo' => null,
            ]);

            $data['domain'] = [
                'domain' => $data['domain'] ?? null,
                'is_primary' => $data['is_primary'] ?? false,
            ];

            $gym->domain()->create($data['domain'] ?? [
                'domain' => null,
                'is_primary' => false,
            ]);

            $data['terms'] = [
                'ar' => $data['ar_terms'] ?? null,
                'en' => $data['en_terms'] ?? null,
            ];
            unset($data['ar_terms'], $data['en_terms']);

            $data['policy'] = [
                'ar' => $data['ar_policy'] ?? null,
                'en' => $data['en_policy'] ?? null,
            ];

            unset($data['ar_policy'], $data['en_policy']);

            $data['policies'] = [
                'terms' => $data['terms'] ?? null,
                'policy' => $data['policy'] ?? null,
                'privacy_file' => $data['privacy_file'] ?? null,
                'side_effects_file' => $data['side_effects_file'] ?? null,
                'faq_file' => $data['faq_file'] ?? null,
            ];



            $gym->policies()->create($data['policies'] ?? []);


            $gym->features()->attach($data['features'] ?? []);
            $gym->actions()->attach($data['actions'] ?? []);

            return $gym->load(['branding', 'policies', 'domain', 'features', 'actions']);
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

            $gym = $this->repo->update($id, $data);

            // Branding
            $brandingData = [
                'main_color' => $data['main_color'] ?? '#222',
                'second_color' => $data['second_color'] ?? '#fff',
                'cover' => $data['cover'] ?? null,
                'logo' => $data['logo'] ?? null,
            ];
            $gym->branding()->update( $brandingData);

            // Domain
            $domainData = [
                'domain' => $data['domain'] ?? null,
                'is_primary' => $data['is_primary'] ?? false,
            ];
            // $gym->domain()->update( $domainData);

            // Policies
            $policiesData = [
                'terms' => [
                    'ar' => $data['ar_terms'] ?? null,
                    'en' => $data['en_terms'] ?? null,
                ],
                'policy' => [
                    'ar' => $data['ar_policy'] ?? null,
                    'en' => $data['en_policy'] ?? null,
                ],
                'privacy_file' => $data['privacy_file'] ?? null,
                'side_effects_file' => $data['side_effects_file'] ?? null,
                'faq_file' => $data['faq_file'] ?? null,
            ];
            $gym->policies()->update( $policiesData);

            // Sync Features
            if (!empty($data['features'])) {
                $features = collect($data['features'])->mapWithKeys(fn($f) => [
                    $f['feature_id'] => ['is_enabled' => $f['is_enabled'] ?? false]
                ])->toArray();

                $gym->features()->sync($features);
            }

            // Sync Actions
            if (!empty($data['actions'])) {
                $actions = collect($data['actions'])->mapWithKeys(fn($a) => [
                    $a['action_id'] => ['is_enabled' => $a['is_enabled'] ?? false]
                ])->toArray();

                $gym->actions()->sync($actions);
            }

            return $gym->load(['branding', 'policies', 'domain', 'features', 'actions']);
        });
    }

    public function destroy(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $gym = $this->repo->find($id);

            $gym->branding()?->delete();
            $gym->domain()?->delete();
            $gym->policies()?->delete();
            $gym->features()->detach();
            $gym->actions()->detach();

            return $this->repo->delete($id);
        });
    }
}
