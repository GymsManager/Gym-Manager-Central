<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HandlesFileAttributes;

class GymPolicies extends Model
{
    use HandlesFileAttributes, SoftDeletes;

    protected $table = 'gym_policies';

    protected $fillable = [
        'gym_id',
        'terms',
        'policy',
        'terms_file',
        'privacy_file',
        'side_effects_file',
        'faq_file',
    ];

    // ✅ Only in the model, NOT in the trait
    protected $fileAttributes = [
        'privacy_file',
        'side_effects_file',
        'faq_file',
    ];

    protected $casts = [
        'terms' => 'array',
        'policy' => 'array',
    ];

    /**
     * Relationship: Gym this policy belongs to
     */
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    /**
     * Accessor: localized terms by app locale
     */
    public function getLocalizedTermsAttribute(): ?string
    {
        $locale = app()->getLocale();
        return $this->terms[$locale] ?? $this->terms['en'] ?? null;
    }

    /**
     * Accessor: localized policy by app locale
     */
    public function getLocalizedPolicyAttribute(): ?string
    {
        $locale = app()->getLocale();
        return $this->policy[$locale] ?? $this->policy['en'] ?? null;
    }
}
