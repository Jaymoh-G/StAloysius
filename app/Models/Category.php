<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public function departments()
{
    return $this->hasMany(Department::class);
}
protected static function boot()
{
    parent::boot();

    static::creating(function ($category) {
        $category->slug = Str::slug($category->name);
    });

    static::updating(function ($category) {
        $category->slug = Str::slug($category->name);
    });
}
protected $fillable = [
        'name',
        'slug', 
    ];
}
