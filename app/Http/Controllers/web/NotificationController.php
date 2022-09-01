<?php

namespace App\Http\Controllers\web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Redirect;

class NotificationController extends Controller
{
    public function claimStore(Request $requestData) {

    	$update_array = array(
    		"store_id" => $requestData->store_id,
            "name" => $requestData->txtName." ".$requestData->txtlName,
            "email" => $requestData->txtEmail,
            "phone" => $requestData->txtPhone
        );

        

        $status = Notification::insert($update_array);
        
        if($status) {
        	return Redirect::back()->withErrors(['message' => 'Your Request is Sent to Administrator.']);
        } else {
            return Redirect::back()->withErrors(['message' => 'Sorry Your Request is not Sent to Administrator. please try again.']);
        }
    }
}
