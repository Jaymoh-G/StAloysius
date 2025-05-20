<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     protected $fillable = [
        'title', 'category_id',
        'paragraph1', 'paragraph2', 'paragraph3', 'paragraph4',
        'image1', 'image2', 'image3'
    ];
    public function category()
{
    return $this->belongsTo(Category::class);
}
}
