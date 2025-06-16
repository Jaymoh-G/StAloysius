<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'path',
        'caption',
        'sort_order',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
