<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class DepCategory extends Model
{
  public function departments()
  {
    return $this->hasMany(DepartmentModel::class, 'dep_category_id');
  }

  // Add parent-child relationship
  public function parent()
  {
    return $this->belongsTo(DepCategory::class, 'parent_id');
  }

  public function children()
  {
    return $this->hasMany(DepCategory::class, 'parent_id');
  }

  // Get all main categories
  public static function mainCategories()
  {
    return self::where('is_main', true)->get();
  }

  // Get all subcategories for a main category
  public function subcategories()
  {
    return $this->children()->with('departments');
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
    'parent_id',
    'is_main',
  ];
}


