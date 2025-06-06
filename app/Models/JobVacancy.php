<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobVacancy extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'job_category_id',
        'description',
        'deadline',
        'application_email',
        'is_active',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function isExpired()
    {
        return $this->deadline->isPast();
    }
}