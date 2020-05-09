<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Role;

class AdminController extends Controller
{
    public function store(User $user) {
        if(request()->user()->can('addAuthors')) {
            $authorRole = Role::role('author')->first();

            if ($user->hasRole('author')) {
                return abort(406);
            } else {
                return $user->roles()->attach($authorRole->id);
            }
        } else {
            return abort(403);
        }
    }
}
