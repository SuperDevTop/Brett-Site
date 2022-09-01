<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class singleDelivery extends Controller
{
    public function index($deliveryId) {
    	$delivery_detail = DB::select('select * from stores where category = "3" AND id = "'.$deliveryId.'" ORDER BY id DESC ');
    	if( count($delivery_detail) > 0 ) {
    		$delivery_detail = $delivery_detail[0];
    	}
    	return view("web/deliveryDetails", compact("delivery_detail"));
    }
}
