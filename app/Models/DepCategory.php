<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class DepCategory extends Model
{
  public function departments()
{
    return $this->hasMany(Department::class);
}
protected static function boot()
{
    parent::boot();

    static::creating(function ($depCategory) {
        $depCategory->slug = Str::slug($depCategory->name);
    });

    static::updating(function ($depCategory) {
        $depCategory->slug = Str::slug($depCategory->name);
    });
}
protected $fillable = [
        'name',
        'slug',
    ];

}
