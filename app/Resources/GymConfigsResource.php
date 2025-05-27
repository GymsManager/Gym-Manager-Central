<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymConfigsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'workout_type' => $this->workout_type,
            'reward_points' => $this->reward_points,
            'unit' => $this->unit,
            'reward_value' => $this->reward_value,
            'membership_type' => $this->membership_type,
            'vat' => $this->vat,
            'role' => $this->role,
            'coin_login' => $this->coin_login,
        ];
    }
}
