<?php

namespace App\Http\Controllers\web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AllEmails;
use App\Http\Controllers\Controller;
use App\Models\ContactUsQuery;
use Illuminate\Support\Facades\DB;
class mailController extends Controller
{
    public function sendEmail() {
        $portal_settings = DB::select('select * from portal_settings LIMIT 1');
        if( isset($portal_settings) ) {
            $portal_settings = $portal_settings[0];
        }
         
        $to_email = $portal_settings->email;
        Mail::to($to_email)->send(new AllEmails($_POST));
        if(Mail::failures() != 0) {


            $update_array = array(
                "name" => $_POST['txtName']." ".$_POST['txtlName'],
                "email" => $_POST['txtEmail'],
                "subject" => $_POST['subject'],
                "message" => $_POST['txtMsg']
            );
            ContactUsQuery::insert($update_array);
            return Redirect("/contactUs/")->with("success", "Success! Your E-mail has been sent");
        } else {
            return Redirect("/contactUs/")->with("error", "Failed! Your E-mail has not sent");
        }
    }

}
