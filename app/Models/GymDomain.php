<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymDomain extends Model
{
    protected $fillable = [
        'gym_id',
        'domain',
        'is_primary',
    ];

    /**
     * Get the gym associated with the domain.
     */
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
