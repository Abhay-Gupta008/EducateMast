<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['bio', 'user_id', 'image'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function profile_image() {
        if ($this->image != null) {
            return 'storage/'.$this->image;
        } else {
            return 'img/no_image_available.svg';
        }
    }
}
