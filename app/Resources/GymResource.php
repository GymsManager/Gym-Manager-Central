<?php

namespace App\Resources;

use App\Resources\GymBrandingResource;
use App\Resources\GymDomainResource;
use App\Resources\GymPoliciesResource;
use Illuminate\Http\Resources\Json\JsonResource;


class GymResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'slug' => $this->slug,
            'name' => $this->name,
            'status' => $this->status,
            'subscription_plan' => $this->whenLoaded('subscriptionPlan'),
            'has_application' => $this->has_application,

            'branding' => new GymBrandingResource($this->whenLoaded('branding')),
            'policies' => new GymPoliciesResource($this->whenLoaded('policies')),
            'domain' => new GymDomainResource($this->whenLoaded('domain')),
            'features' => $this->whenLoaded('features', function () {
                return $this->features->map(function ($feature) {
                    return [
                        'name' => $feature->name,
                        'is_enabled' => $feature->pivot->is_enabled,
                    ];
                });
            }),
            'actions' => $this->whenLoaded('actions', function () {
                return $this->actions->map(function ($action) {
                    return [
                        'name' => $action->name,
                        'is_enabled' => $action->pivot->is_enabled,
                    ];
                });
            }),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
