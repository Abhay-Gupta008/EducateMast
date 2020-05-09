<?php

namespace App\Providers;

use App\Events\ContactFormSent;
use App\Events\PostCreated;
use App\Listeners\SendDiscordWebhook;
use App\Listeners\SendEmailOnPostCreate;
use App\Listeners\SendSlackNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ContactFormSent::class => [
          SendSlackNotification::class,
        ],
        PostCreated::class => [
          SendDiscordWebhook::class,
          SendEmailOnPostCreate::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
