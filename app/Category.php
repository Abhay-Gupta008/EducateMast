<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'slug'];

    public function scopeUncategorized($query) {
        return $query->where('name', 'Uncategorized');
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
