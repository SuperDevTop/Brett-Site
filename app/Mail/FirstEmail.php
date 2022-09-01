<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($category_name, $id)
    {
        //
        $this->category_name = $category_name;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = "https://budandcarriage.com/".$this->category_name."Details/".$this->id;
        return $this->from("ino@budandcarriage.com")->view('email-template')->with([
            'address' => $address
        ]);
    }
}
