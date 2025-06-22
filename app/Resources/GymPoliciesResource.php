<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymPoliciesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'terms' => $this->terms,
            'policy' => $this->policy,
            'terms_file' => $this->terms_file,
            'privacy_file' => $this->privacy_file,
            'side_effects_file' => $this->side_effects_file,
            'faq_file' => $this->faq_file,
        ];
    }
}
