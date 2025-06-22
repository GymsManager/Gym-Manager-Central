<?php

namespace App\Models;

<<<<<<< HEAD
=======
use App\Traits\HandlesFileAttributes;
>>>>>>> 51bd07d (Gym-review)
use Illuminate\Database\Eloquent\Model;

class GymBranding extends Model
{
<<<<<<< HEAD
=======
    use HandlesFileAttributes;

>>>>>>> 51bd07d (Gym-review)
    protected $fillable = [
        'gym_id',
        'logo',
        'main_color',
        'second_color',
        'cover',
    ];
<<<<<<< HEAD
=======

    protected $fileAttributes = ['logo', 'cover'];


>>>>>>> 51bd07d (Gym-review)
    /**
     * Get the gym associated with the branding.
     */
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
