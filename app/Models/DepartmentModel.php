<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'dep_category_id',
        'paragraph1',
        'paragraph2',
        'paragraph3',
        'paragraph4',
        'paragraph5',
        'paragraph6',
        'paragraph7',
        'banner',
    ];
    public function depCategory()
    {
        return $this->belongsTo(DepCategory::class);
    }
    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
    public function featuredImage()
    {
        return $this->hasOne(BlogImage::class)->where('is_featured', true);
    }
}
