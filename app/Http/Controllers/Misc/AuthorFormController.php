<?php

namespace App\Http\Controllers\Misc;

use App\AuthorSubmission;
use App\Http\Controllers\Controller;
use App\Notifications\AuthorSubmitted;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Auth;


class AuthorFormController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function show() {
        if (!Auth::user()->hasRole('admin') || Auth::user()->hasRole('Author')) {
            if (Auth::user()->author_submission == null) {
                $showForm = true;
                $alreadyStaff = false;
                return response()->view('misc.author-form.show', compact('showForm', 'alreadyStaff'));
            } else {
                $showForm = false;
                $alreadyStaff = false;
                return response()->view('misc.author-form.show', compact('showForm', 'alreadyStaff'));
            }
        } else {
            $alreadyStaff = true;
            $showForm = false;
            return response()->view('misc.author-form.show', compact('alreadyStaff', 'showForm'));
        }
    }

    public function store(Request $request) {
        if(!Auth::user()->hasRole('admin') || Auth::user()->hasRole('Author')) {
            $data = $request->validate([
                'discord_username' => ['required', 'max:50', 'min:4'],
                'reason' => ['required', 'max:700', 'min:50'],
            ]);

            AuthorSubmission::create(array_merge($data, [
                'user_id' => Auth::user()->id,
            ]));

            Notification::route('slack', env('SLACK_HOOK'))->notify(new AuthorSubmitted(Auth::user()->username, $data['reason'], $data['discord_username']));

            session()->flash('message', 'Your application has been submitted.');
            return response()->redirectTo(route('posts.index'));
        }
    }

    public function index() {
        return response()->view('misc.author-form.index');
    }
}
