<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    // Automatically generate slug on create and update
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($eventCategory) {
            $eventCategory->slug = Str::slug($eventCategory->name);
        });

        static::updating(function ($eventCategory) {
            $eventCategory->slug = Str::slug($eventCategory->name);
        });
    }

    // Relationships
    public function events()
    {
        return $this->hasMany(EventModel::class);
    }
}
