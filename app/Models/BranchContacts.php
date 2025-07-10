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

    protected $casts = [
        'facebook' => 'string',
        'twitter' => 'string',
        'instagram' => 'string',
        'youtube' => 'string',
        'snapchat' => 'string',
        'whatsapp' => 'string',
        'pinterest' => 'string',
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
    ];
    /**
     * Get the Branch associated with the contacts.
     */
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
