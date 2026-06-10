<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'route_name', 'content', 'meta_title', 'meta_description', 'published'];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'published' => 'boolean',
        ];
    }
}
