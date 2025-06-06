<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_id',
        'thumbnail',
        'album_category_id',
        'published_at',
        'is_featured',
        'order'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(AlbumCategory::class, 'album_category_id');
    }
}
