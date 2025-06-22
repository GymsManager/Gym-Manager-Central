<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchAddresses extends Model
{
    protected $fillable = [
        'branch_id',
        'address',
        'latitude',
        'longitude',
    ];

<<<<<<< HEAD
=======

    protected $casts = [
        'address' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
    ];


>>>>>>> 51bd07d (Gym-review)
    /**
     * Get the Branch associated with the address.
     */
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
