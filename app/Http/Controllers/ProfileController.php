<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $profile = $user->profile;
        return response()->view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $profile = $user->profile;
        Gate::authorize('update', $profile);
        return response()->view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Gate::authorize('update', $user->profile);

        $validatedData = $this->validator($request);

        $profile = Profile::findOrFail($user->profile->id);

        $profile->update([
            'bio' => $validatedData['bio'],
        ]);

        $user->update([
            'name' => $validatedData['name']
        ]);

        $user->save();

        $profile->save();

        $this->storeImage($profile, $request);

        session()->flash("message", "Your profile has been updated");

        return response()->redirectTo(route('profiles.show', [$user->username]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function validator(Request $request) {
        return $request->validate([
            'name' => ['required', 'max:255', 'min:5', 'string'],
            'bio' => ['required', 'max:255', 'string', 'min:5'],
            'image' => ['sometimes', 'image', 'file', 'max:5000'],
        ]);
    }

    public function storeImage(Profile $profile, Request $request) {
        if ($request->hasFile('image')) {
            $profile->update([
                'image' => $request->image->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage/'.$profile->image))->fit(100, 100);
            $image->save();
        }
    }
}
