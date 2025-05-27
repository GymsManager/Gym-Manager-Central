<?php

namespace App\Resources;

use app\Resources\GymAddressesResource;
use App\Resources\GymBrandingResource;
use app\Resources\GymCommerceResource;
use App\Resources\GymConfigsResource;
use app\Resources\GymContactsResource;
use app\Resources\GymPoliciesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;


class GymResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'slug' => $this->slug,
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

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
