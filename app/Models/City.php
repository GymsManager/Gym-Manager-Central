<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
    ];

<<<<<<< HEAD
    /**
     * Get the Branch associated with the city.
     */
    public function Branch()
=======
    protected $casts = [
        'name' => 'array',
    ];

    /**
     * Get the Arabic name.
     */
    public function getNameArAttribute()
    {
        return $this->name['ar'] ?? null;
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get the English name.
     */
    public function getNameEnAttribute()
    {
        return $this->name['en'] ?? null;
    }

    /**
     * Get the Branch associated with the city.
     */
    public function branches()
>>>>>>> 51bd07d (Gym-review)
    {
        return $this->hasMany(Branch::class);
    }
}
