<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchCommerce extends Model
{
    protected $fillable = [
        'branch_id',
        'tax_number',
        'merchant_id',
        'merchant_name',
        'merchant_key',
        'currency',
        'commercial_register_number',
    ];

    /**
     * Get the Branch associated with the commerce.
     */
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
