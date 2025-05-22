<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumCategory extends Model
{
      protected $table = 'album_categories'; // ✅ Explicit table name

    protected $fillable = ['name', 'slug'];
    public function albums()
    {
        return $this->hasMany(Album::class, 'album_category_id');
    }
}
