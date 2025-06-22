<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
    ];

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
    {
        return $this->hasMany(Branch::class);
    }
}
