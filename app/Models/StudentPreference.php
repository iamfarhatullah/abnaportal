<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'university_id',
        'country_id',
        'course',
        'intake_id',
        'status_id',
        'portal_id',
        'notes',
        'portal_url',
        'applied_on',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function intake()
    {
        return $this->belongsTo(Intake::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function portal()
    {
        return $this->belongsTo(Portal::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
