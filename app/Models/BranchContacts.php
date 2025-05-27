<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchContacts extends Model
{
    protected $fillable = [
        'branch_id',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'snapchat',
        'whatsapp',
        'pinterest',
    ];

    /**
     * Get the Branch associated with the contacts.
     */
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
