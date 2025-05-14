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
        'desired_course',
        'intake_id',
        'status_id',
        'notes',
        'counsellor_notes',
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
}
