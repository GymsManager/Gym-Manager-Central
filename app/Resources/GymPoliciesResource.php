<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymPoliciesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'en_terms' => $this->en_terms,
            'ar_terms' => $this->ar_terms,
            'en_policy' => $this->en_policy,
            'ar_policy' => $this->ar_policy,
            'terms_file' => $this->terms_file,
            'privacy_file' => $this->privacy_file,
            'side_effects_file' => $this->side_effects_file,
            'faq_file' => $this->faq_file,
        ];
    }
}
