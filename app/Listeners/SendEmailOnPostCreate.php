<?php

namespace App\Listeners;

use App\Mail\NewPostPublished;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailOnPostCreate implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        foreach(User::all() as $user) {
            if ($user->profile->receive_emails) {
                Mail::to($user)->send(new NewPostPublished($event->post, $event->postLink));
            }
        }
    }
}
