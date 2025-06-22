<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymCommerceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'tax_number' => $this->tax_number,
            'merchant_id' => $this->merchant_id,
            'merchant_name' => $this->merchant_name,
            'merchant_key' => $this->merchant_key,
            'currency' => $this->currency,
            'commercial_register_number' => $this->commercial_register_number,
        ];
    }
}
