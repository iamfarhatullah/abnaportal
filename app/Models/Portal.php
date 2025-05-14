<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    protected $fillable = ['name', 'image'];

    public function universities()
    {
        return $this->belongsToMany(University::class, 'commissions')
            ->withPivot('commission_percentage')
            ->withTimestamps();
    }
}
