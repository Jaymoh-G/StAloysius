<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class TeamMember extends Model
{
    protected $casts = [
        'professional_skills' => 'array',
        'socials' => 'array',
    ];
    protected $fillable = [
        'name',
        'position',
        'description',
        'experience',
        'professional_skills',
        'socials',
        'image',
        'slug',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'department_id');
    }

    protected static function booted()
    {
        static::creating(function ($member) {
            $member->slug = Str::slug($member->name);
        });

        static::updating(function ($member) {
            $member->slug = Str::slug($member->name);
        });
    }
}
