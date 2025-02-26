<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'country_id', 
        'picture', 
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // public function portals()
    // {
    //     return $this->belongsToMany(Portal::class, 'commissions')
    //                 ->withPivot('commission_percentage')
    //                 ->withTimestamps();
    // }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
