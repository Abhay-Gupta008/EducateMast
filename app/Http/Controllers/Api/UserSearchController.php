<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function search($user) {
        if(request()->user()->can('addAuthors')) {
            $searchResult = User::where('username', 'like', "%{$user}%")->get();
            return $searchResult;
        } else {
            return response(null, 403);
        }
    }
}
