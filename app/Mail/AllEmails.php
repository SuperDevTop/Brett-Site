<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AllEmails extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($sb)
    {
        $this->data = $sb;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   return $this->subject('Bud Carriage Contact Us')->view('web/mails/contactUs/index')->with(['sb' => $this->data]);
    }
}
