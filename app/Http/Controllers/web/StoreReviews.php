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
class StoreReviews extends Controller
{
    public function index(Request $request) {
    	if(  isset(Auth::user()->id) ) {	
	    	$result_status = DB::select("SELECT * FROM stores WHERE bussiness_user_id = '".Auth::user()->id."' ");
			if( isset($result_status[0]->id) ) {
				$products_data = DB::select('select * from reviews INNER JOIN users ON reviews.user_id = users.id AND store_id = "'.$result_status[0]->id.'" ');
				$view_data = array();
		        if( isset($products_data) ) {	
		            $products_data = (array)$products_data;
		            $users_in = "";
		        }

		        $business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
		        if( isset($business_data[0]) ) {
		            $business_data = $business_data[0];
		        }

		        $weighted_review_rating = DB::select('select COUNT(*) as total_rating_numbers,SUM(rating) as total_rating_sum from reviews WHERE store_id = "'.$result_status[0]->id.'" ');
		        if( isset($weighted_review_rating[0]) ) {
		            $weighted_review_rating = $weighted_review_rating[0];
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

		        return view("web/storeReviews", compact("products_data","weighted_review_rating","business_data","check_is_active_subscription","business_data_user"));
		    } else {
		    	$products_data = DB::select('select stores.logo,stores.name, reviews.* from reviews INNER JOIN stores ON reviews.store_id = stores.id AND user_id = "'.Auth::user()->id.'" ');
				$view_data = array();
		        if( isset($products_data) ) {	
		            $products_data = (array)$products_data;
		        }
		        $banners_data = DB::select('select * from advertisement_banners where location = "user_profile" ');
		        return view("web/storeReviewsUser", compact("products_data","banners_data"));
		    }
		} else {
			return redirect("/home/");
		}
    }
    public function SubmitStoreRating(Request $request) {
    	$products_data = DB::insert(
    			'INSERT INTO reviews SET
	        	user_id = "'.Auth::user()->id.'",
	    		store_id = "'.$request->store_id.'",
	    		heading = "'.$request->rating_heading.'",
	    		description = "'.$request->rating_detail.'",
	    		rating = "'.$request->rating_number.'",
	    		created_at = "'.date('Y-m-d H:i:s').'"'
    	);
    	return Redirect("/".$request->store_category."/".$request->store_id);
    }
}
