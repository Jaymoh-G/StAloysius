<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
     protected $fillable = ['blog_post_id', 'album_id', 'path', 'category', 'caption', 'is_featured', 'sort_order'];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }
}



