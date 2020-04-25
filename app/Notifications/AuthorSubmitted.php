<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class AuthorSubmitted extends Notification
{
    use Queueable;

    public $username;
    public $discordUsername;
    public $reason;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($username, $reason, $discordUsername)
    {
        $this->username = $username;
        $this->discordUsername = $discordUsername;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('EducateMast', ':ghost:')
            ->to('#website')
            ->content('Author Application Submitted by: '. $this->username.'. Discord Username: '.$this->discordUsername.' and reason: '.$this->reason);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
