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

class StoreProfile extends Controller
{
    public function index(Request $request) {
        $amenities = DB::select('select * from amenities ORDER BY name asc ');
        $business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
        if( isset($business_data[0]) ) {
            $business_data = $business_data[0];
        }
        $store_media = DB::select('select * from store_media WHERE store_id = "'.$business_data->id.'" ORDER BY media_name asc ');

        $check_is_active_subscription = 0;
        $business_store_id = $request->session()->get("business_store_id");
        if( $business_store_id != "" ) {
            $query = DB::select('select count(*) as active_plan from subscription_plans where user_id = "'.Auth::user()->id.'"  AND business_store_id = "'.$business_store_id.'" AND status_active_deactive = 1 ORDER BY id DESC LIMIT 1 ');
            if( $query[0]->active_plan == 1 ) {
                $check_is_active_subscription = 1;
            }
        }

        return view("web/storeProfile", compact("business_data","amenities","store_media","check_is_active_subscription"));
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
	                'store_location' => 'required',
	                'profile_image' => 'mimes:jpg,jpeg,png',
	                array(
					    'upload_media.*'  => 'mimes:jpg,jpeg,png,gif,csv,txt,pdf,mp4,mov,ogg,avi,flv,wmv | max:20000'
					  ) 
				],
				[
					'Bname.required' => 'Store Name is Required!',
					'addres.required' => 'Address is Required!',
					'phone.required' => 'Phone is Required!',
					'delivery_service_info.required' => 'Delivery Service Info is Required!',
					'store_location.required' => 'Store Location is Required!',
					'about_us_info.required' => 'Store Description is Required!',
	                'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
	                'upload_media.mimes' => 'Media Extensions are jpg,jpeg,png,gif,csv,txt,pdf,mp4,mov,ogg,avi,flv,wmv',
				],
			);

			if($request->hasfile('upload_media')) {
		        foreach($request->file('upload_media') as $file)
		        {
		            $name_gen = hexdec( uniqid() );
			        $img_ext = strtolower($file->getClientOriginalExtension());
			        $img_name = $name_gen.".".$img_ext;
			        $up_location = public_path('/assets/img/store_media/');
			        $last_image = $up_location.$img_name;
			        $statsu = $file->move($up_location,$img_name);
			        $query = 'INSERT INTO store_media SET
			         	store_id = "'.$request->store_id.'",
			    		media_name = "'.$img_name.'"
		        	';
		        	$store_media = DB::update($query);
		        }
		    }


			$amenitites = $request->amenitites;
			if( isset($amenitites) ) {
				if( count($amenitites) > 0 ) {
					$amenitites = implode(",",$amenitites);
				}
			}

			$store_lat = $request->store_lat;
			$store_lng = $request->store_lng;
			$store_location_name = $request->store_location_name;


			$array_timing = array(
				"monday_time" => $request->monday_time,
				"tuesday_time" => $request->tuesday_time,
				"wednesday_time" => $request->wednesday_time,
				"thursday_time" => $request->thursday_time,
				"friday_time" => $request->friday_time,
				"saturday_time" => $request->saturday_time,
				"sunday_time" => $request->sunday_time
			);
			$timing = json_encode($array_timing);

			$seo_title = $request->seo_title;
			$seo_description = $request->seo_description;
			$seo_keyword = $request->seo_keyword;
			$seo_image = $request->seo_image;

			$img_name_seo = "";
			$seo_image = $request->file("seo_image");
			if( $seo_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($seo_image->getClientOriginalExtension());
		        $img_name_seo = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/stores/');
		        $last_image = $up_location.$img_name_seo;
		        $statsu = $seo_image->move($up_location,$img_name_seo);
	            // @unlink($up_location.$old_image);
	        }


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
	            $query = "UPDATE stores SET
	            		logo = '".$img_name."',
			    		name = '".$request->Bname."',
			    		address = '".$request->addres."',
			    		phone = '".$request->phone."',
			    		store_amenity = '".$amenitites."',
			    		link_to_website_listing_page = '".$request->website."',
			    		email = '".$request->email."',
			    		stores.lat = '".$store_lat."',
			    		stores.long = '".$store_lng."',
			    		
			    		seo_title = '".$seo_title."',
			    		seo_description = '".$seo_description."',
			    		seo_keyword = '".$seo_keyword."',
			    		seo_image = '".$img_name_seo."',

			    		store_location_name = '".$store_location_name."',
			    		store_location = '".$request->store_location."',
			    		delivery_service_info = '".htmlspecialchars($request->delivery_service_info)."',
			    		about_us_info = '".htmlspecialchars($request->about_us_info)."',
			    		radius = '".$request->radius."',
			    		link_with_social_media = '".$request->link_with_social_media."',
			    		store_hours = '".$timing."'
		        	where
		        		id = '".$request->store_id."' ";
	        } else {
	        	$query = "UPDATE stores SET
			    		name = '".$request->Bname."',
			    		address = '".$request->addres."',
			    		phone = '".$request->phone."',
			    		store_amenity = '".$amenitites."',
			    		link_to_website_listing_page = '".$request->website."',
			    		email = '".$request->email."',
			    		stores.lat = '".$store_lat."',
			    		stores.long = '".$store_lng."',
			    		
			    		seo_title = '".$seo_title."',
			    		seo_description = '".$seo_description."',
			    		seo_keyword = '".$seo_keyword."',
			    		seo_image = '".$img_name_seo."',

			    		store_location_name = '".$store_location_name."',
			    		store_location = '".$request->store_location."',
			    		delivery_service_info = '".htmlspecialchars($request->delivery_service_info)."',
			    		about_us_info = '".htmlspecialchars($request->about_us_info)."',
			    		radius = '".$request->radius."',
			    		link_with_social_media = '".$request->link_with_social_media."',
			    		store_hours = '".$timing."'
		        	where
		        		id = '".$request->store_id."' ";

	        }
	        $result_status = DB::update($query);
			return Redirect("/storeProfile")->with("success", "Store Profile Updated Successfully");
		} else {
			return Redirect("/home");
		}
	}

	public function storeByLocationName(Request $request, $locationName) {
		$locationName = trim($locationName);
		if( isset($locationName) ){
			if( $locationName != '' ) {
				$store_locations = DB::select('select * from stores where status = 1 AND subscription_active = 1 AND store_location_name != "" AND store_location_name LIKE "%'.$locationName.'%" ');
    			return view("web/location_stores", compact("store_locations"));
			}
		}
	}
	public function storeGridView() {
		$all_categories = DB::select('select * from categories ORDER BY id DESC ');
        $all_p_categories = DB::select('select * from products_categories ORDER BY name DESC ');
        $all_amenities = DB::select('select * from amenities ORDER BY name DESC ');

        $portal_radius = "";
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        if( isset($portal_settings[0]) ) {
            $portal_radius = $portal_settings[0]->radius;
        }


		$store_lat_long_query = "";
        $store_lat_long_query_having = "";
        if( isset($_COOKIE['cityLat']) && isset($_COOKIE['cityLng']) ) {
            if( ($_COOKIE['cityLat'] != '') && ($_COOKIE['cityLng'] != '') ) {
                $lat = $_COOKIE['cityLat'];
                $lng = $_COOKIE['cityLng'];
                $store_lat_long_query = " ((ACOS(SIN(".$lat." * PI() / 180)* SIN(stores.lat * PI() / 180)+ COS(".$lat." * PI() / 180)* COS(stores.lat * PI() / 180)* COS((".$lng." - stores.long) * PI() / 180))* 180 / PI()) * 60 * 1.1515) AS distance,  ";
                $store_lat_long_query_having = " HAVING distance<='".$portal_radius."' ";
            }
        }

        $all_stores = DB::select('select stores.*,'.$store_lat_long_query.' stores.id as st_id from stores where status = "1" AND subscription_active = 1 '.$store_lat_long_query_having.' ORDER BY id DESC ');

    	$portal_radius = "";
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        if( isset($portal_settings[0]) ) {
            $portal_radius = $portal_settings[0]->radius;
        }
        
        $banner_lat_long_query = "";
        $banner_lat_long_query_having = "";
        if( isset($_COOKIE['cityLat']) && isset($_COOKIE['cityLng']) ) {
            if( ($_COOKIE['cityLat'] != '') && ($_COOKIE['cityLng'] != '') ) {
                $lat = $_COOKIE['cityLat'];
                $lng = $_COOKIE['cityLng'];
                $banner_lat_long_query = " ((ACOS(SIN(".$lat." * PI() / 180)* SIN(advertisement_banners.lat * PI() / 180)+ COS(".$lat." * PI() / 180)* COS(advertisement_banners.lat * PI() / 180)* COS((".$lng." - advertisement_banners.lon) * PI() / 180))* 180 / PI()) * 60 * 1.1515) AS distance,  ";
                $banner_lat_long_query_having = " HAVING distance<='".$portal_radius."' ";
            }
        }
        
        $banners_data = DB::select('select advertisement_banners.*,'.$banner_lat_long_query.' advertisement_banners.id as st_id from advertisement_banners WHERE advertisement_banners.location = "grid_page" AND lat != "" AND lon != "" '.$banner_lat_long_query_having.' ORDER BY rand() DESC ');
        

        return view("web/storesGridView", compact('all_p_categories', 'all_amenities', 'all_categories',"all_stores","banners_data"));
	}
}