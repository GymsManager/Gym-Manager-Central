<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymContactsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'snapchat' => $this->snapchat,
            'whatsapp' => $this->whatsapp,
            'pinterest' => $this->pinterest,
        ];
    }
}
