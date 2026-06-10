<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'excerpt', 'featured_image_id', 'blog_category_id', 'author_id', 'published', 'published_at'];

    protected function casts(): array
    {
        return [
            'published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getContentAttribute($value)
    {
        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return '<p>' . implode('</p><p>', $decoded) . '</p>';
        }
        return $value;
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
