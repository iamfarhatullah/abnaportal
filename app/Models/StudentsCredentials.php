<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsCredentials extends Model
{
    use HasFactory;

    protected $table = 'students_credentials';

    protected $fillable = [
        'student_name',
        'email',
        'password',
        'description',
        'recovery_email',
        'recovery_phone'
    ];
}
