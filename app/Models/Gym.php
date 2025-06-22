<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Gym extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
<<<<<<< HEAD
        'code', 'slug', 'name', 'email', 'mobile', 'status', 'subscription_plan_id',
        'has_application', 'created_by', 'updated_by'
=======
        'code',
        'slug',
        'name',
        'status',
        'subscription_plan_id',
        'has_application',
        'created_by',
        'updated_by'
>>>>>>> 51bd07d (Gym-review)
    ];

    protected $casts = [
        'has_application' => 'boolean',
        'name' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gym) {
            if (empty($gym->code)) {
                $gym->code = strtoupper(uniqid('GYM'));
            }
            if (empty($gym->slug) && !empty($gym->name)) {
                $gym->slug = Str::slug(is_array($gym->name) ? $gym->name['en'] ?? reset($gym->name) : $gym->name);
            }
        });

        static::updating(function ($gym) {
            if (empty($gym->slug) && !empty($gym->name)) {
                $gym->slug = Str::slug(is_array($gym->name) ? $gym->name['en'] ?? reset($gym->name) : $gym->name);
            }
        });
    }
    /**
     * Get the branding information associated with the gym.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
<<<<<<< HEAD
    public function branding() { return $this->hasOne(GymBranding::class); }
=======
    public function branding()
    {
        return $this->hasOne(GymBranding::class);
    }
>>>>>>> 51bd07d (Gym-review)

    /**
     * Get the policies associated with the gym.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
<<<<<<< HEAD
    public function policies() { return $this->hasOne(GymPolicies::class); }
=======
    public function policies()
    {
        return $this->hasOne(GymPolicies::class);
    }
>>>>>>> 51bd07d (Gym-review)

    /**
     * Get all domains associated with the gym.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
<<<<<<< HEAD
    public function domain() { return $this->hasMany(GymDomain::class); }
=======
    public function domain()
    {
        return $this->hasOne(GymDomain::class);
    }
>>>>>>> 51bd07d (Gym-review)

    /**
     * Get the subscription plan that the gym belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
<<<<<<< HEAD
    public function subscriptionPlan() { return $this->belongsTo(SubscriptionPlan::class); }

=======
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'gym_features')
            ->withTimestamps()
            ->withPivot('is_enabled');
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class, 'gym_actions')
            ->withTimestamps()
            ->withPivot('is_enabled');
    }
>>>>>>> 51bd07d (Gym-review)
}
