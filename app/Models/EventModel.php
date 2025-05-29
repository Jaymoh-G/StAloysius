<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $fillable = [
        'name', 'slug', 'content', 'start_date', 'end_date', 'event_time', 'location',
        'organizer_name', 'organizer_photo', 'organizer_description', 'event_category_id',
        'featured', 'banner',
        // Paragraphs 1–21
        'paragraph1', 'paragraph2', 'paragraph3', 'paragraph4', 'paragraph5',
        'paragraph6', 'paragraph7', 'paragraph8', 'paragraph9', 'paragraph10',
        'paragraph11', 'paragraph12', 'paragraph13', 'paragraph14', 'paragraph15',
        'paragraph16', 'paragraph17', 'paragraph18', 'paragraph19', 'paragraph20',
        'paragraph21',
    ];

    public function images()
    {
        return $this->hasMany(BlogImage::class, 'event_model_id');
    }
public function featuredImage()
{
    return $this->hasOne(BlogImage::class)->where('is_featured', 1);
}

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }
}
