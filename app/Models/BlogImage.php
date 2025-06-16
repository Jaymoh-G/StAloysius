<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    protected $fillable = [
        'blog_post_id',
        'event_model_id',
        'static_page_id',
        'album_id',
        'path',
        'caption',
        'category',
        'is_featured',
        'sort_order',
        'facility_id',
        'imageable_id',
        'imageable_type'
    ];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function staticPage()
    {
        return $this->belongsTo(StaticPage::class);
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function imageable()
    {
        return $this->morphTo();
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
