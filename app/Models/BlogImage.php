<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
     protected $fillable = ['blog_post_id', 'path', 'category', 'is_featured'];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
    public function event()
{
    return $this->belongsTo(EventModel::class, 'event_id');
}
}
