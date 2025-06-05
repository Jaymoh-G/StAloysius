<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'album_category_id', 'cover_image', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($album) {
            if (!$album->slug) {
                $album->slug = Str::slug($album->title);
            }
        });

        static::updating(function ($album) {
            if ($album->isDirty('title') && !$album->isDirty('slug')) {
                $album->slug = Str::slug($album->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(AlbumCategory::class, 'album_category_id');
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class, 'album_id');
    }
}







