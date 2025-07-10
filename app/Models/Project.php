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
        'featured_image',
        'technologies_used',
        'is_featured',
        'paragraph1',
        'paragraph2',
        'paragraph3',
        'paragraph4',
        'paragraph5',
        'paragraph6',
        'paragraph7',
        'paragraph8',
        'paragraph9',
        'paragraph10',
        'paragraph11',
        'paragraph12',
        'paragraph13',
        'paragraph14',
        'paragraph15',
        'paragraph16',
        'paragraph17',
        'paragraph18',
        'paragraph19',
        'paragraph20',
        'paragraph21',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            // Regenerate slug if title has changed
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class)->where('category', 'project');
    }

    public function featuredImage()
    {
        return $this->hasOne(BlogImage::class)->where('is_featured', true)->where('category', 'project');
    }

    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'planning' => 'bg-warning text-dark',
            'in_progress' => 'bg-info text-white',
            'completed' => 'bg-success text-white',
            'on_hold' => 'bg-secondary text-white',
            'cancelled' => 'bg-danger text-white'
        ];

        return $statuses[$this->status] ?? 'bg-secondary text-white';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'planning' => 'Planning',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'on_hold' => 'On Hold',
            'cancelled' => 'Cancelled'
        ];

        return $statuses[$this->status] ?? 'Unknown';
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
