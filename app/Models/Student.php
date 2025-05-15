<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'current_education',
        'graduated_from',
        'phone',
        'email',
        'notes',
        'test',
        'qualification_id',
    ];

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function preferences()
    {
        return $this->hasMany(StudentPreference::class);
    }
}
