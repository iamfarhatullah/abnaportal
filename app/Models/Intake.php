<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intake extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function studentPreferences()
    {
        return $this->hasMany(StudentPreference::class);
    }
}
