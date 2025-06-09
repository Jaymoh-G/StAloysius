<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'static_page_id',
        'path',
        'caption',
        'section',
        'sort_order'
    ];

    public function page()
    {
        return $this->belongsTo(StaticPage::class, 'static_page_id');
    }
}