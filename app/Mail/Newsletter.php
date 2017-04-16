<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $articles, $categories, $catCount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($articles, $categories, $catCount)
    {
        $this->articles = $articles;
        $this->categories = $categories;
        $this->catCount = $catCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('csoffice@ksu.edu')
                    ->view('mail.newsletter');
    }
}
