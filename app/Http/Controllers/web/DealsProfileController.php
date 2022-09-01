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

class DealsProfileController extends Controller
{
    public function index(Request $request) {
    	
    	$business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
        if( isset($business_data[0]) ) {
            $business_data = $business_data[0];
        }

        $products_categories = DB::select('select * from products_categories order by name ASC');
        $products_data = DB::select('select * from products where user_id = "'.Auth::user()->id.'" and status = "1" AND deal_simple_product_status = 1 ');
        if( isset($products_data) ) {
            $products_data = $products_data;
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
        return view("web/storeDeals", compact("products_data","products_categories","business_data","business_data_user","check_is_active_subscription"));
    }

    public function singleProductDetails($product_id) {
    	if( isset($product_id) ) {
    		$products_data = DB::select('select categories.name as c_name, stores.name as st_name, products.* from products LEFT JOIN categories ON categories.id = products.category_id LEFT JOIN stores ON stores.id = products.store_id where products.id = "'.$product_id.'" ');
    		$products_data = $products_data[0];
	        return view("web/singleProductDetails", compact("products_data"));
    	}
    }

    public function EditProcess(Request $request) {
		if(isset($request->store_id)){
			$validated = $request->validate(
	            [
	                'Bname' => 'required',
	                'addres' => 'required',
	                'phone' => 'required',
	                'delivery_service_info' => 'required',
	                'about_us_info' => 'required',
	                'profile_image' => 'mimes:jpg,jpeg,png',
				],
				[
					'Bname.required' => 'Store Name is Required!',
					'addres.required' => 'Address is Required!',
					'phone.required' => 'Phone is Required!',
					'delivery_service_info.required' => 'Service Info is Required!',
					'about_us_info.required' => 'Store info is Required!',
	                'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
				],
			);

	        $profile_image = $request->file("profile_image");
			if( $profile_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($profile_image->getClientOriginalExtension());
		        $img_name = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/stores/');
		        $last_image = $up_location.$img_name;
		        $statsu = $profile_image->move($up_location,$img_name);
	            @unlink($up_location.$old_image);
	            $query = 'UPDATE stores SET
			        	logo = "'.$img_name.'",
			    		name = "'.$request->Bname.'",
			    		address = "'.$request->addres.'",
			    		phone = "'.$request->phone.'",
			    		link_to_website_listing_page = "'.$request->website.'",
			    		email = "'.$request->email.'",
			    		delivery_service_info = "'.$request->delivery_service_info.'",
			    		about_us_info = "'.$request->about_us_info.'",
			    		radius = "'.$request->radius.'",
			    		link_with_social_media = "'.$request->link_with_social_media.'",
			    		store_hours = "'.$request->store_hours.'"
		        	where
		        		id = "'.$request->store_id.'"
		        		';
	        } else {
	        	$query = 'UPDATE stores SET
			    		name = "'.$request->Bname.'",
			    		address = "'.$request->addres.'",
			    		phone = "'.$request->phone.'",
			    		link_to_website_listing_page = "'.$request->website.'",
			    		email = "'.$request->email.'",
			    		delivery_service_info = "'.$request->delivery_service_info.'",
			    		about_us_info = "'.$request->about_us_info.'",
			    		radius = "'.$request->radius.'",
			    		link_with_social_media = "'.$request->link_with_social_media.'",
			    		store_hours = "'.$request->store_hours.'"
		        	where
		        		id = "'.$request->store_id.'"
		        		';

	        }
	        $result_status = DB::update($query);
			return Redirect("/storeProfile")->with("success", "Store Profile Updated Successfully");
		} else {
			return Redirect("/home");
		}
	}

	public function AddProcess(Request $request) {
		$validated = $request->validate(
            [
                'category' => 'required',
                'product_name' => 'required',
                'product_info' => 'required',
                'price' => 'required',
                'profile_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'category.required' => 'Category is Required!',
				'product_name.required' => 'Product Name is Required!',
				'product_info.required' => 'Product Details is Required!',
				'price.required' => 'Price is Required!',
                'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		$seo_title = $request->seo_title;
		$seo_keyword = $request->seo_keyword;
		$seo_description = $request->seo_description;
		$result_status = DB::select("SELECT id FROM stores WHERE bussiness_user_id = '".Auth::user()->id."' ");
		if( isset($result_status[0]->id) ) {

			$seo_image_name = "";
			$seo_image = $request->file("seo_image");
			if( $seo_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($seo_image->getClientOriginalExtension());
		        $seo_image_name = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/products/');
		        $last_image = $up_location.$seo_image_name;
		        $statsu = $seo_image->move($up_location,$seo_image_name);
	        } 

			$profile_image = $request->file("profile_image");
			if( $profile_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($profile_image->getClientOriginalExtension());
		        $img_name = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/products/');
		        $last_image = $up_location.$img_name;
		        $statsu = $profile_image->move($up_location,$img_name);
	            @unlink($up_location.$old_image);
	            $query = 'INSERT INTO products SET
			        	name = "'.$request->product_name.'",
			    		category_id = "'.$request->category.'",
			    		store_id = "'.$result_status[0]->id.'",
			    		user_id = "'.Auth::user()->id.'",
			    		description = "'.$request->product_info.'",
			    		deal_simple_product_status = 1,

			    		weight = "'.$request->weight.'",
			    		size = "'.$request->size.'",

			    		seo_image_name = "'.$seo_image_name.'",
			    		seo_title = "'.$seo_title.'",
			    		seo_keyword = "'.$seo_keyword.'",
			    		seo_description = "'.$seo_description.'",

			    		quantity = "'.$request->quantity.'",
			    		start_date_time = "'.$request->start_date_time.'",
			    		end_date_time = "'.$request->end_date_time.'",

			    		product_category_id = "'.$request->p_category.'",
			    		image = "'.$img_name.'",
			    		featured = 0,
			    		status = "1",
			    		regular_price = "'.$request->price.'",
			    		discount_price = "'.$request->price.'",
			    		discount_status = "0",
			    		created_at = "'.date('Y-m-d H:i:s').'"
		        ';
	        } else {
	        	$query = 'INSERT INTO products SET
			        	name = "'.$request->product_name.'",
			    		category_id = "'.$request->category.'",
			    		store_id = "'.$result_status[0]->id.'",
			    		user_id = "'.Auth::user()->id.'",
			    		description = "'.$request->product_info.'",
			    		featured = 0,
			    		product_category_id = "'.$request->p_category.'",
			    		deal_simple_product_status = 1,
			    		weight = "'.$request->weight.'",
			    		size = "'.$request->size.'",

			    		seo_image_name = "'.$seo_image_name.'",
			    		seo_title = "'.$seo_title.'",
			    		seo_keyword = "'.$seo_keyword.'",
			    		seo_description = "'.$seo_description.'",

			    		quantity = "'.$request->quantity.'",
			    		start_date_time = "'.$request->start_date_time.'",
			    		end_date_time = "'.$request->end_date_time.'",
			    		status = "1",
			    		regular_price = "'.$request->price.'",
			    		discount_price = "'.$request->price.'",
			    		discount_status = "0",
			    		created_at = "'.date('Y-m-d H:i:s').'"
		        ';

	        }
	        $result_status = DB::update($query);
			return Redirect("/storeDeals")->with("success", "Product Added Successfully");
		} else {
			return Redirect("/home");
		}
	}
}
