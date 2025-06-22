<?php

namespace App\Models;

use App\Traits\HandlesFileAttributes;
use Illuminate\Database\Eloquent\Model;

class GymBranding extends Model
{
    use HandlesFileAttributes;

    protected $fillable = [
        'gym_id',
        'logo',
        'main_color',
        'second_color',
        'cover',
    ];

    protected $fileAttributes = ['logo', 'cover'];


    /**
     * Get the gym associated with the branding.
     */
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
