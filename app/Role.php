<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable =['id', 'name'];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function scopeRole($query, $roleName) {
        return $query->where('name', $roleName);
    }

}
