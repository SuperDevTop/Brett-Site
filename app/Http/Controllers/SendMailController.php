<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\TestMail;

class SendMailController extends Controller
{
    //
    public function sendEmail() {

        $to_email = "david.bayne.yo@gmail.com";

        \Mail::to($to_email)->send(new TestMail);

        if(Mail::failures() != 0) {
            return "<p> Success! Your E-mail has been sent.</p>";
        }

        else {
            return "<p> Failed! Your E-mail has not sent.</p>";
        }
    }
}
