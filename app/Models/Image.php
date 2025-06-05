<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'blog_post_id',
        'path',
        'caption',
        'is_featured',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    // Get the URL for the image
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}




