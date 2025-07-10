<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'currency',
        'price',
        'duration_in_days',
        'features',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'name' => 'array',
        'description' => 'array',
    ];

    /**
     * Get the gyms associated with the subscription plan.
     */
    public function gyms()
    {
        return $this->hasMany(Gym::class);
    }
    /**
     * Get the features associated with the subscription plan.
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'subscription_plan_feature', 'subscription_plan_id', 'feature_id');
    }
    /**
     * Get the features associated with the subscription plan.
     */
    public function getFeaturesAttribute($value)
    {
        return json_decode($value, true);
    }
    /**
     * Set the features associated with the subscription plan.
     */
    public function setFeaturesAttribute($value)
    {
        $this->attributes['features'] = json_encode($value);
    }
}
