<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
      use HasFactory;

    protected $fillable = ['name', 'type', 'image', 'testimony', 'rating', 'slug'];
    protected static function booted()
{
    static::creating(function ($testimonial) {
        $testimonial->slug = Str::slug($testimonial->name);
    });

    static::updating(function ($testimonial) {
        $testimonial->slug = Str::slug($testimonial->name);
    });
}

}
