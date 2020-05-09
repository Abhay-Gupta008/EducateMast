<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDiscordWebhook implements ShouldQueue
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
        $data = [
            'content' => '<@&704662202526859324> '.$event->post->title.'
'.$event->postLink
        ];
        $url = 'https://discordapp.com/api/webhooks/707290137574244352/1TddkMVlR-KKjDZ4qE5mNNhu7g-1wg7fQQY0jbDXlO9RrQs6wmaTTt6ZU77SjstelDqQ';
        $ch = curl_init($url);
        $postString = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
