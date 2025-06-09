<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'banner_image',
        'meta_title',
        'meta_description',
        'section_1_title',
        'section_1_content',
        'section_2_title',
        'section_2_content',
        'section_3_title',
        'section_3_content',
        'section_4_title',
        'section_4_content',
        'section_5_title',
        'section_5_content',
        'section_6_title',
        'section_6_content',
        'section_7_title',
        'section_7_content',
        'section_8_title',
        'section_8_content',
        'section_9_title',
        'section_9_content',
        'section_10_title',
        'section_10_content',
        'last_updated_by'
    ];

    public function images()
    {
        return $this->hasMany(BlogImage::class, 'static_page_id');
    }

    public function sectionImages($section)
    {
        return $this->hasMany(BlogImage::class, 'static_page_id')
            ->where('category', 'section_' . $section)
            ->orderBy('sort_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }
}




