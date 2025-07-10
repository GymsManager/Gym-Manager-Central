<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymDomainResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'domain' => $this->domain,
            'is_primary' => $this->is_primary,
        ];
    }
}
