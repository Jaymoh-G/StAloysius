<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     protected $fillable = [
        'title', 'slug','dep_category_id','content','paragraph1', 'paragraph2', 'paragraph3', 'paragraph4','5','paragraph6','paragraph7',
    ];
public function depCategory()
{
    return $this->belongsTo(DepCategory::class);
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
