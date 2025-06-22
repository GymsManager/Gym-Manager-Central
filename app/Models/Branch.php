<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{

    use HasFactory, SoftDeletes;

>>>>>>> 51bd07d (Gym-review)
    protected $fillable = [
        'gym_id',
        'city_id',
        'name',
        'latitude',
        'longitude',
        'skip_days',
        'subscribe_date',
        'expire_date',
        'capacity',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'name' => 'array',
        'skip_days' => 'array',
        'subscribe_date' => 'datetime',
        'expire_date' => 'datetime',
    ];
    protected $hidden = [
        'created_by',
        'updated_by',
    ];
    protected $appends = [
        'gym_name',
        'city_name',
    ];
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function getGymNameAttribute()
    {
        return $this->gym ? $this->gym->name : null;
    }
    public function getCityNameAttribute()
    {
        return $this->city ? $this->city->name : null;
    }
    public function getSkipDaysAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setSkipDaysAttribute($value)
    {
        $this->attributes['skip_days'] = json_encode($value);
    }


    public function Contacts()
    {
        return $this->hasMany(BranchContacts::class);
    }

    public function Addresses()
    {
        return $this->hasMany(BranchAddresses::class);
    }

    public function Configs()
    {
        return $this->hasMany(BranchConfigs::class);
    }

    public function Commerces()
    {
        return $this->hasMany(BranchCommerce::class);
    }
}
