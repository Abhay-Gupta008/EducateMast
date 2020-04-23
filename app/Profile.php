<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['bio', 'user_id', 'image'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
