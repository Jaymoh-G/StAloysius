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
    'paragraph1', 'paragraph2', 'paragraph3', 'paragraph4', 'paragraph5',
    'paragraph6', 'paragraph7', 'paragraph8', 'paragraph9', 'paragraph10',
    'paragraph11', 'paragraph12', 'paragraph13', 'paragraph14', 'paragraph15',
    'paragraph16', 'paragraph17', 'paragraph18', 'paragraph19', 'paragraph20', 'paragraph21',
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
