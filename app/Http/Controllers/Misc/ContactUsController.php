<?php

namespace App\Http\Controllers\Misc;

use App\Events\ContactFormSent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('misc.contact-us.index');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'message' => ['max:500'],
        ]);

        $submission = Auth::user()->contact_us_submissions()->create($data);

        event(new ContactFormSent($submission->message, Auth::user()));

        return redirect(route('posts.index'))->with('message', 'Contact Form Submitted. Thank you <3!');
    }
}
