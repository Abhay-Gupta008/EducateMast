<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Role;

class AdminController extends Controller
{

    public function adminStore(User $user) {
        if(request()->user()->can('addAdmins')) {
            $adminRole = Role::role('admin')->first();

            if ($user->hasRole('admin')) {
                return abort(406);
            } else {
                return $user->roles()->attach($adminRole->id);
            }
        } else {
            return abort(403);
        }
    }

    public function authorStore(User $user) {
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

    public function trustedStore(User $user) {
        if(request()->user()->can('addTrusted')) {
            $trustedRole = Role::role('trusted')->first();

            if ($user->hasRole('trusted')) {
                return abort(406);
            } else {
                return $user->roles()->attach($trustedRole->id);
            }
        } else {
            return abort(403);
        }
    }
}
