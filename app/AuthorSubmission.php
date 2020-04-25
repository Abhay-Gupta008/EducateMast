<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorSubmission extends Model
{
    protected $fillable = ['discord_username', 'reason', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
