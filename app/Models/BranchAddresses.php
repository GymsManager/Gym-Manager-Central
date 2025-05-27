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

    /**
     * Get the Branch associated with the address.
     */
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
