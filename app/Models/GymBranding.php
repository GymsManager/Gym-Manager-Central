<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymBranding extends Model
{
    protected $fillable = [
        'gym_id',
        'logo',
        'main_color',
        'second_color',
        'cover',
    ];
    /**
     * Get the gym associated with the branding.
     */
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
