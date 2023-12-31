<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function($user) {
            $userRole = Role::role('user')->first();
            $user->roles()->attach($userRole->id);
            Profile::create([
                'bio' => 'Hello there, I use EducateMast',
                'user_id' => $user->id,
            ]);
        });
    }

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roleName) {
        $role = Role::role($roleName)->first();

        return $this->roles->contains($role->id);
    }

    public function canPost() {
        return $this->hasRole('Admin') || $this->hasRole("Author");
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function author_submission() {
        return $this->hasOne(AuthorSubmission::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function badges() {
        $badges = '';
        if ($this->hasRole('admin')) {
            $badges = $badges.'<span class="badge badge-primary mr-2">Admin</span>';
        }

        if ($this->hasRole('author')) {
            $badges = $badges.'<span class="badge badge-secondary mr-2">Author</span>';
        }

        if ($this->hasRole('trusted')) {
            $badges = $badges.'<span class="badge badge-warning mr-2">Trusted</span>';
        }

        return $badges;
    }

    public function contact_us_submissions() {
        return $this->hasMany(ContactUsSubmissions::class);
    }

}
