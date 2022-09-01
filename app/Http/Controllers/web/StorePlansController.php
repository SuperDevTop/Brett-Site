<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class StorePlansController extends Controller
{
    public function index() {
    	$doctors_plan = DB::select('select * from plans WHERE status = 1 AND category_id = 1 ');
    	$dispensary_plan = DB::select('select * from plans WHERE status = 1 AND category_id = 2 ');
    	$delivery_plan = DB::select('select * from plans WHERE status = 1 AND category_id = 3 ');

        $plan_cat_details = DB::select('select * from plan_category_details LIMIT 1 ');
        if( isset($plan_cat_details) && count($plan_cat_details) > 0 ) {
            $plan_cat_details = $plan_cat_details[0];
        }
        return view("web/planDetails", compact("doctors_plan","dispensary_plan","delivery_plan","plan_cat_details"));
    }
    public function showAllCategoryPlans($category_id) {
    	if( isset($category_id) ) {
    		$plans = DB::select('select * from plans WHERE status = 1 AND category_id = "'.$category_id.'" ');
	        return view("web/singleCategoryAllPlans", compact("plans", "category_id"));
    	} else {
    		return Redirect()->route('home');
    	}
    }
}
