<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'album_category_id',
        'cover_image',
    ];

    public function category()
    {
        return $this->belongsTo(AlbumCategory::class, 'album_category_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'album_id');
    }
}





