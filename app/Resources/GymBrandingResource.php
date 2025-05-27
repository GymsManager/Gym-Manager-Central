<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymBrandingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'main_color' => $this->main_color,
            'second_color' => $this->second_color,
            'cover' => $this->cover,
            'logo' => $this->logo,
        ];
    }
}
