<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymAddressesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'en_address' => $this->en_address,
            'ar_address' => $this->ar_address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
