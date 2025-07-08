<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'start_date',
        'end_date',
        'status',
        'department_id',
        'sort_order',
        // paragraph1-21 fields are handled automatically
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(BlogImage::class)->where('is_featured', true);
    }

    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'planning' => 'badge-warning',
            'in_progress' => 'badge-info',
            'completed' => 'badge-success',
            'on_hold' => 'badge-secondary',
            'cancelled' => 'badge-danger'
        ];

        return $statuses[$this->status] ?? 'badge-secondary';
    }

    public function getPriorityBadgeAttribute()
    {
        return null;
    }

    public function getFormattedBudgetAttribute()
    {
        return null;
    }

    public function getDurationAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return 'Duration not specified';
        }

        $start = $this->start_date;
        $end = $this->end_date;

        $diff = $start->diffInDays($end);

        if ($diff < 30) {
            return $diff . ' days';
        } elseif ($diff < 365) {
            $months = floor($diff / 30);
            return $months . ' month' . ($months > 1 ? 's' : '');
        } else {
            $years = floor($diff / 365);
            return $years . ' year' . ($years > 1 ? 's' : '');
        }
    }

    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'department_id');
    }
}
