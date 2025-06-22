<?php

namespace App\Resources;

<<<<<<< HEAD
use app\Resources\GymAddressesResource;
use App\Resources\GymBrandingResource;
use app\Resources\GymCommerceResource;
use App\Resources\GymConfigsResource;
use app\Resources\GymContactsResource;
use app\Resources\GymPoliciesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
=======
use App\Resources\GymBrandingResource;
use App\Resources\GymDomainResource;
use App\Resources\GymPoliciesResource;
use Illuminate\Http\Resources\Json\JsonResource;
>>>>>>> 51bd07d (Gym-review)


class GymResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'slug' => $this->slug,
<<<<<<< HEAD
            'name' => [
                'en' => $this->en_name,
                'ar' => $this->ar_name,
            ],
            'email' => $this->email,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'subscribe_date' => $this->subscribe_date,
            'expire_date' => $this->expire_date,
            'subscription_plan_id' => $this->subscription_plan_id,
            // 'subscription_plan_name' => optional($this->subscriptionPlan)->name,
            'has_application' => $this->has_application,
            'skip_days' => $this->skip_days,
            'city_id' => $this->city_id,

            'branding' => new GymBrandingResource($this->whenLoaded('branding')),
            'contacts' => new GymContactsResource($this->whenLoaded('contacts')),
            'addresses' => new GymAddressesResource($this->whenLoaded('addresses')),
            'policies' => new GymPoliciesResource($this->whenLoaded('policies')),
            'config' => new GymConfigsResource($this->whenLoaded('configs')),
            'commerce' => new GymCommerceResource($this->whenLoaded('commerce')),
=======
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
>>>>>>> 51bd07d (Gym-review)

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
