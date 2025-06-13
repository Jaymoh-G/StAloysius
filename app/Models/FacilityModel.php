<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FacilityModel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'department_id',
        'paragraph1',
        'paragraph2',
        'paragraph3',
        'paragraph4',
        'paragraph5',
        'paragraph6',
        'paragraph7',
        'banner',
    ];

    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'department_id');
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(BlogImage::class)->where('is_featured', true);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facility) {
            $facility->slug = Str::slug($facility->name);
        });

        static::updating(function ($facility) {
            $facility->slug = Str::slug($facility->name);
        });
    }
}
