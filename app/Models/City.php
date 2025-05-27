<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the Branch associated with the city.
     */
    public function Branch()
    {
        return $this->hasMany(Branch::class);
    }
}
