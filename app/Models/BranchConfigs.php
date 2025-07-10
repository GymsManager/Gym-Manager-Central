<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchConfigs extends Model
{
    protected $fillable = [
        'branch_id',
        'workout_type',
        'skip_days',
        'reward_points',
        'unit',
        'reward_value',
        'membership_type',
        'vat',
        'coin_login',
    ];

    protected $casts = [
        'skip_days' => 'array',
        'reward_points' => 'integer',
        'reward_value' => 'decimal:2',
        'vat' => 'decimal:2',
        'coin_login' => 'boolean',
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
    ];
    /**
     * Get the Branch associated with the config.
     */
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
