<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $postLink;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post, $postLink)
    {
        $this->post = $post;
        $this->postLink = $postLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.new-post-published');
    }
}
