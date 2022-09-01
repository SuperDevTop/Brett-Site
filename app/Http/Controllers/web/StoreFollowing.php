<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Stores;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class StoreFollowing extends Controller
{
    public function index(Request $request) {
    	if( isset(Auth::user()->id) ) {	
	    	$result_status = DB::select("SELECT id FROM stores WHERE bussiness_user_id = '".Auth::user()->id."' ");
			if( isset($result_status[0]->id) ) {
				$products_data = DB::select('select user_id from followers where store_id = "'.$result_status[0]->id.'" ');
				$view_data = array();

				$business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
		        if( isset($business_data[0]) ) {
		            $business_data = $business_data[0];
		        }

				$business_data_user = DB::select('select * from users where id = "'.Auth::user()->id.'"  LIMIT 1 ');
		        $banners_data = DB::select('select * from advertisement_banners where location = "user_profile" ');
		        if( isset($business_data_user[0]) ) {
		            $business_data_user = $business_data_user[0];
		        }

		        $check_is_active_subscription = 0;
		        $business_store_id = $request->session()->get("business_store_id");
		        if( $business_store_id != "" ) {
		            $query = DB::select('select count(*) as active_plan from subscription_plans where user_id = "'.Auth::user()->id.'"  AND business_store_id = "'.$business_store_id.'" AND status_active_deactive = 1 ORDER BY id DESC LIMIT 1 ');
		            if( $query[0]->active_plan == 1 ) {
		                $check_is_active_subscription = 1;
		            }
		        }

		        if( isset($products_data) ) {	
		            $products_data = (array)$products_data;
		            if( count($products_data) > 0 ) {

		            }
		            $users_in = "";
		            foreach ($products_data as $key => $folowers_user) {
		            	if( $folowers_user->user_id != '' ) {
		            		if( $key == 0) {
		            			$users_in = "'".$folowers_user->user_id."'";
		            		} else {
		            			$users_in .= ",'".$folowers_user->user_id."'";
		            		}
		            		
		            	}
		            	if( $users_in != '' ) {
		            		$result_status = DB::select("SELECT * FROM users WHERE id IN(".$users_in.") ");
		            		array_push($view_data, $result_status[0]);
		            	}
		            	
		            }
		        }
		        return view("web/storeFollowing", compact("view_data","business_data","check_is_active_subscription","business_data_user"));
			} else {
				$view_data = array();
				$result_status = DB::select("SELECT COUNT(id) as user_found FROM users WHERE id = '".Auth::user()->id."' ");
				if( isset($result_status) ) {
					$result_status = $result_status[0];
					if( $result_status->user_found ) {
						$products_data = DB::select('select store_id from followers where user_id = "'.Auth::user()->id.'" ');
				        if( isset($products_data) ) {	
				            $products_data = (array)$products_data;
				            if( count($products_data) > 0 ) {}
				            $store_id = "";
				            foreach ($products_data as $key => $folowers_user) {
				            	if( $folowers_user->store_id != '' ) {
				            		if( $key == 0) {
				            			$store_id = "'".$folowers_user->store_id."'";
				            		} else {
				            			$store_id .= ",'".$folowers_user->store_id."'";
				            		}
				            	}
				            	if( $store_id != '' ) {
				            		$result_status = DB::select("SELECT * FROM stores WHERE id IN(".$store_id.") ");
				            		array_push($view_data, $result_status[0]);
				            	}
				            }
				        }
					}  else {
						return redirect("/home/");
					}
				}
				return view("web/storeFollowingUser", compact("view_data"));
			}
		} else {
			return redirect("/home/");
		}
    }
}
