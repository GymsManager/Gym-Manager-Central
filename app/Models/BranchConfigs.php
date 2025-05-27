<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchConfigs extends Model
{
    protected $fillable = [
        'branch_id',
        'workout_type',
        'reward_points',
        'unit',
        'reward_value',
        'membership_type',
        'vat',
        'coin_login',
    ];


    /**
     * Get the Branch associated with the config.
     */
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
