<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'paragraph1',
        'paragraph2',
        'paragraph3',
        'paragraph4',
        'paragraph5',
        'paragraph6',
        'paragraph7',
        'paragraph8',
        'paragraph9',
        'paragraph10',
        'paragraph11',
        'paragraph12',
        'paragraph13',
        'paragraph14',
        'paragraph15',
        'paragraph16',
        'paragraph17',
        'paragraph18',
        'paragraph19',
        'paragraph20',
        'paragraph21'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class, 'blog_post_id');
    }

    public function featuredImage()
    {
        return $this->hasOne(BlogImage::class)->where('is_featured', true);
    }

    /**
     * Get all comments for this blog post
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get only approved comments for this blog post
     */
    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->approved();
    }

    /**
     * Get only top-level approved comments for this blog post
     */
    public function topLevelComments(): HasMany
    {
        return $this->hasMany(Comment::class)->approved()->topLevel();
    }
}

