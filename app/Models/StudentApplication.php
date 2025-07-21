<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    protected $fillable = [
        'student_name',
        'kpsea_index_number',
        'current_residence',
        'guardian_name',
        'guardian_phone',
        'application_letter',
        'academic_certificates',
        'death_certificate',
    ];

    protected $casts = [
        'academic_certificates' => 'array',
        'death_certificate' => 'array',
    ];
}
