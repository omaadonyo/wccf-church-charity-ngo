<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'parent_id', 'label', 'url', 'route_name', 'target', 'sort_order'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function getResolvedUrl(): string
    {
        if ($this->route_name && $this->route_name !== 'custom') {
            $route = \Illuminate\Support\Facades\Route::getRoutes()->getByName($this->route_name);
            if ($route) return route($this->route_name);
            return url('/' . $this->route_name);
        }
        return $this->url ?? '#';
    }
}
