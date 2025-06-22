<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;
=======
>>>>>>> 51bd07d (Gym-review)
use App\Traits\HandlesFileAttributes;

class GymPolicies extends Model
{
<<<<<<< HEAD
    use HandlesFileAttributes, SoftDeletes;
=======
    use HandlesFileAttributes;
>>>>>>> 51bd07d (Gym-review)

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

<<<<<<< HEAD
    // ✅ Only in the model, NOT in the trait
=======
>>>>>>> 51bd07d (Gym-review)
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
