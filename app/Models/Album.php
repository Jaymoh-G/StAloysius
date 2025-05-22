<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'album_category_id','images'];


public function galleries()
{
    return $this->hasMany(Gallery::class);
}

  protected $casts = [
        'images' => 'array',
    ];
   public function category()
    {
        return $this->belongsTo(AlbumCategory::class, 'album_category_id');
    }
}
