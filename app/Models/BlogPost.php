<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title','slug','content','category_id', 'paragraph1',
        'paragraph2',
        'paragraph3',
        'paragraph4',
        'paragraph5',
        'paragraph6',
        'paragraph7',];

public function category()
{
    return $this->belongsTo(Category::class);
}
public function images()
{
    return $this->hasMany(BlogImage::class);
}
// BlogPost.php
public function featuredImage()
{
    return $this->hasOne(BlogImage::class)->where('is_featured', true);
}

}
