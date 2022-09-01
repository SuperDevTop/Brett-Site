<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stores;
use App\Models\Categories;
use App\Models\SubscriptionPlans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use App\Mail\FirstEmail;

class StoreController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = Stores::all();
    	return view("admin/stores/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	$business_users = DB::select('select * from users where user_type = "business" ');
    	$amenitites = DB::select('select * from amenities ORDER BY name ');
    	$categories = DB::select('select * from categories ');
    	return view("admin/stores/add", compact("usersData", "business_users", "categories","amenitites"));
    }
	
    public function GetLoggedInUserData() {
    	return user::find( Auth::user()->id );
    }

    public function AddProcess( Request $request) {
    	$validated = $request->validate(
            [
                's_name' => 'required',
            //    'store_owner' => 'required',
                'category' => 'required',
                's_image' => 'mimes:jpg,jpeg,png',
                'phone' => 'required',
                'status' => 'required',
				'potential_customer' => 'required',
			],
			[
				's_name.required' => 'First Name is Required!',
				'category.required' => 'Category is Required!',
			//	'store_owner.required' => 'First Name is Required!',
				's_image.mimes' => 'Allowed Exensions are jpg,jpeg,png.',
				'phone.required' => 'First Name is Required!',
				'status.required' => 'First Name is Required!',
			],
		);

    	$s_name = $request->s_name;
	//	$store_owner = $request->store_owner;
		$email = $request->email;
		$address = $request->address;
		$category = $request->category;
		$description = $request->description;
		$store_amenity = $request->store_amenity;
		if( isset($store_amenity) ) {
			if( $store_amenity != '' ) {
				if( count($store_amenity) > 0 ) {
					$store_amenity =implode(",",$request->store_amenity);
				}
			}
		}
		$phone = $request->phone;
		$link_to_website = $request->link_to_website;
		$link_to_media = $request->link_to_media;
		$hours = $request->hours;
		$status = $request->status;
		$lat = $request->lat;
		$long = $request->long;
		$delivery_service = $request->delivery_service;
		$about_us = $request->about_us;

		$s_image = $request->file("s_image");
		if( $s_image ) {
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($s_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/stores/');
	        $last_image = $up_location.$img_name;
	        $statsu = $s_image->move($up_location, $img_name);
	    	$update_array = array(
	    		"name" => $s_name,
	    	//	"bussiness_user_id" => $store_owner,
	    		"email" => $email,
	    		"address" => $address,
	    		"description" => $description,
	    		"phone" => $phone,
	    		"store_amenity" => $store_amenity,
	    		"category" => $category,
	    		"link_to_website_listing_page" => $link_to_website,
	    		"link_with_social_media" => $link_to_media,
	    		"store_hours" => $hours,
	    		"logo" => $img_name,
	    		"status" => $status,
	    		"lat" => $lat,
	    		"long" => $long,
	    		"delivery_service_info" => $delivery_service,
	    		"about_us_info" => $about_us,
	    		'created_at' => Carbon::now()
	    	);
        } else {
            $update_array = array(
	    		"name" => $s_name,
	    	//	"bussiness_user_id" => $store_owner,
	    		"email" => $email,
	    		"address" => $address,
	    		"description" => $description,
	    		"store_amenity" => $store_amenity,
	    		"category" => $category,
	    		"phone" => $phone,
	    		"link_to_website_listing_page" => $link_to_website,
	    		"link_with_social_media" => $link_to_media,
	    		"store_hours" => $hours,
	    		"status" => $status,
	    		"lat" => $lat,
	    		"long" => $long,
	    		"delivery_service_info" => $delivery_service,
	    		"about_us_info" => $about_us,
	    		'created_at' => Carbon::now()
	    	);
        }

		$category_name = Categories::where('id', $category)->first()->name;

		if($category_name == 'Doctors')
		{
			$category_name = 'doctor';
		}
		else if($category_name == 'Dispensaries'){
			$category_name = 'dispensary';
		}
		else if($category_name == 'Deliveries'){
			$category_name = 'delivery';
		}

    	Stores::insert($update_array);
		$storeCounts = Stores::all()->last()->id;
		$to_email = $request->potential_customer;
		\Mail::to($to_email)->send(new FirstEmail($category_name, $storeCounts));

		return Redirect()->route('stores_listing')->with("success", "Store Added Successfully");
    }

    public function EditProcess( Request $request, $customer_id) {
    	$validated = $request->validate(
            [
                's_name' => 'required',
                's_image' => 'mimes:jpg,jpeg,png',
                'phone' => 'required',
                'status' => 'required',
			],
			[
				's_name.required' => 'First Name is Required!',
				's_image.mimes' => 'Allowed Exensions are jpg,jpeg,png.',
				'phone.required' => 'First Name is Required!',
				'status.required' => 'First Name is Required!',
			],
		);


    	$s_name = $request->s_name;
		$store_owner = $request->store_owner;
		$email = $request->email;
		$address = $request->address;
		$description = $request->description;
		$phone = $request->phone;
		$link_to_website = $request->link_to_website;
		$link_to_media = $request->link_to_media;
		$hours = $request->hours;
		$status = $request->status;
		$lat = $request->lat;
		$long = $request->long;
		$delivery_service = $request->delivery_service;
		$about_us = $request->about_us;
		$store_amenity = $request->store_amenity;
		
		if( isset($store_amenity) ) {
			if( $store_amenity != '' ) {
				if( count($store_amenity) > 0 ) {
					$store_amenity =implode(",",$request->store_amenity);
				}
			}
		}
		$s_image = $request->file("s_image");
		if( $s_image ) {
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($s_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/stores/');
	        $last_image = $up_location.$img_name;
	        $statsu = $s_image->move($up_location,$img_name);
	    	$update_array = array(
	    		"name" => $s_name,
	    		"bussiness_user_id" => $store_owner,
	    		"email" => $email,
	    		"address" => $address,
	    		"description" => $description,
	    		"phone" => $phone,
	    		"store_amenity" => $store_amenity,
	    		"link_to_website_listing_page" => $link_to_website,
	    		"link_with_social_media" => $link_to_media,
	    		"store_hours" => $hours,
	    		"logo" => $img_name,
	    		"status" => $status,
	    		"lat" => $lat,
	    		"long" => $long,
	    		"delivery_service_info" => $delivery_service,
	    		"about_us_info" => $about_us,
	    		'created_at' => Carbon::now()
	    	);
        } else {
            $update_array = array(
	    		"name" => $s_name,
	    		"bussiness_user_id" => $store_owner,
	    		"email" => $email,
	    		"address" => $address,
	    		"description" => $description,
	    		"phone" => $phone,
	    		"store_amenity" => $store_amenity,
	    		"link_to_website_listing_page" => $link_to_website,
	    		"link_with_social_media" => $link_to_media,
	    		"store_hours" => $hours,
	    		"status" => $status,
	    		"lat" => $lat,
	    		"long" => $long,
	    		"delivery_service_info" => $delivery_service,
	    		"about_us_info" => $about_us,
	    		'created_at' => Carbon::now()
	    	);
        }

        if( isset($request->plan_id) ) {
        	if( $request->plan_id != '' ) {

        		$store_details_db = DB::select('select * from stores WHERE id = "'.$customer_id.'" ');
        		$bussiness_user_id = $store_details_db[0]->bussiness_user_id;
        		
        		$selected_plan_details = DB::select('select * from plans WHERE id = "'.$request->plan_id.'" ');
		        if( isset($selected_plan_details) && count($selected_plan_details) > 0 ) {
		            $selected_plan_details = $selected_plan_details[0];
		        }
		        $time = strtotime(date("Y-m-d H:i:s"));
                $final = date("Y-m-d H:i:s", strtotime("+1 month", $time));
		        
	        	$update_array1 = array(
                    "user_id" => $bussiness_user_id,
                    "business_store_id" => $store_details_db[0]->id,
                    "payment_method" => "from_admin_panel",
                    "monthy_annual" => "monthly",
                    "processing_fee" => 0.00,
                    "plan_id" => $request->plan_id,
                    "subscription_date" => date("Y-m-d H:i:s"),
                    "subscription_start_date" => date("Y-m-d H:i:s"),
                    "subscription_end_date" => $final,
                    "status_active_deactive" => 1,
                    "plane_name" => $selected_plan_details->plane_name,
                    "price" => $selected_plan_details->price,
                    "image" => $selected_plan_details->image,
                    "description" => $selected_plan_details->description,
                    "plan_options_checkboxes" => $selected_plan_details->plan_options_checkboxes,
                    "category_id" => $selected_plan_details->category_id
                );
                DB::update(' update subscription_plans SET status_active_deactive = 0 WHERE user_id = "'.$bussiness_user_id.'" ');
                $result_status = SubscriptionPlans::insert($update_array1);
                $last_inserted_id = DB::getPdo()->lastInsertId();
                
                if( isset($last_inserted_id) && ($last_inserted_id != "") ) {
                    $data = $selected_plan_details->plan_options_checkboxes;
                    if( isset($data) && $data != "" ) {
                        $plans_data = DB::update(' update stores SET
                                                        company_name_status = 0,
                                                        show_address_status = 0,
                                                        company_logo_status = 0,
                                                        business_descripotion_status = 0,
                                                        marker_status = 0,
                                                        premium_marker_status = 0,
                                                        link_to_website_status = 0,
                                                        link_to_social_media_status = 0,
                                                        store_hours_status = 0,
                                                        reviews_on_listing_status = 0,
                                                        create_view_deals_status = 0,
                                                        phone_number_status = 0,
                                                        import_photos_status = 0,
                                                        import_videos_status = 0,
                                                        delivery_Service_description_status = 0,
                                                        about_us_information_status = 0,
                                                        subscription_active = 1
                                                    WHERE
                                                        bussiness_user_id = "'.$bussiness_user_id.'"
                                                ');
                        foreach (json_decode($data) as $key => $each_plan_option) {
                        	if( isset($bussiness_user_id) ) {
                        		echo $each_plan_option;
                        		echo "<br />";
                                if( $each_plan_option == "show_company_name" ) {
                                    DB::update(' update stores SET company_name_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "show_address" ) {
                                    DB::update(' update stores SET show_address_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "show_company_logo" ) {
                                    DB::update(' update stores SET company_logo_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "show_business_description" ) {
                                    DB::update(' update stores SET business_descripotion_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "show_markers_on_maps" ) {
                                    DB::update(' update stores SET marker_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "premium_map_icons" ) {
                                    DB::update(' update stores SET premium_marker_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "link_to_website_listing_page" ) {
                                    DB::update(' update stores SET link_to_website_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "link_with_social_media" ) {
                                    DB::update(' update stores SET link_to_social_media_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "show_store_hours" ) {
                                    DB::update(' update stores SET store_hours_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "show_review_on_listing_page" ) {
                                    DB::update(' update stores SET reviews_on_listing_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "offer_discounts_deals" ) {
                                    DB::update(' update stores SET create_view_deals_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "show_phone_number" ) {
                                    DB::update(' update stores SET phone_number_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "import_photos" ) {
                                    DB::update(' update stores SET import_photos_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "import_videos" ) {
                                    DB::update(' update stores SET import_videos_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "delivery_service_description" ) {
                                    DB::update(' update stores SET delivery_Service_description_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                } else if( $each_plan_option == "about_us_information" ) {
                                    DB::update(' update stores SET about_us_information_status = 1 WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                }
                                DB::update(' update stores SET category = "'.$selected_plan_details->category_id.'" WHERE bussiness_user_id = "'.$bussiness_user_id.'" ');
                                DB::update(' update products SET status = 0 WHERE store_id = "'.$customer_id.'" ');
                            }
                        }
                    }
                }
        	}
        }
       	
        $result_status = Stores::find($customer_id)->update($update_array);
		return Redirect()->route('stores_listing')->with("success", "Store Updated Successfully");
    }

    public function DeleteProcess($customerId) {
    	if( isset($customerId) && $customerId != "" ) {
	        Stores::find($customerId)->delete();
	        return Redirect()->back()->with("success", "Store Deleted Successfully");
    	}
    }

    public function View($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = Stores::find($customerId);
	        return view("admin/stores/view",compact("customer_data","usersData"));
    	}
    }

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {

	    	$amenitites = DB::select('select * from amenities ORDER BY name ');
	    	$categories = DB::select('select * from categories ');
	    	$plans = DB::select('select * from plans WHERE status = 1 AND price = 0 ');

	    	$subscribed_plan = DB::select('select count(*) as subscription_status from subscription_plans WHERE status_active_deactive = 1 AND business_store_id = "'.$customerId.'" ');
	    	$store_subscription_status = $subscribed_plan[0]->subscription_status;

    		$business_users = DB::select('select * from users where user_type = "business" ');
    		$customer_data = Stores::find($customerId);
	        return view("admin/stores/edit",compact("customer_data","usersData","business_users","categories","amenitites","plans","store_subscription_status"));
    	}
    }
}
