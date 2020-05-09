<?php

namespace App\Listeners;

use App\Events\ContactFormSent;
use App\Notifications\ContactFormSent as ContactFormSentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendSlackNotification implements ShouldQueue
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
    public function handle(ContactFormSent $event)
    {
        Notification::route('slack', env('SLACK_HOOK'))->notify(new ContactFormSentNotification($event->message, $event->user));
    }
}
