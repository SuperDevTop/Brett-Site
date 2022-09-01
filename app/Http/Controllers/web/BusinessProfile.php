<?php
namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ReferralLink;

class BusinessProfile extends Controller
{
    public function index(Request $request) {
        if( isset(Auth::user()->id) ) {
            $user_data = DB::select('select * from users where id = "'.Auth::user()->id.'" LIMIT 1 ');
            $user_data = $user_data[0]; 
            
            if( ($user_data->email_verification_sent_status == 1) && ($user_data->email_verification_code != "") && ($user_data->email_verify_flag == 0) ) {
                return view("web/verify_email_address", compact("user_data"));
                die();
            }

            $business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
            if( isset($business_data[0]) ) {
                $business_data = $business_data[0];
            }

            $business_data_user = DB::select('select * from users where id = "'.Auth::user()->id.'"  LIMIT 1 ');
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
            
            $banners_data = DB::select('select advertisement_banners.*,'.$banner_lat_long_query.' advertisement_banners.id as st_id from advertisement_banners WHERE advertisement_banners.location = "user_profile" AND lat != "" AND lon != "" '.$banner_lat_long_query_having.' ORDER BY rand() DESC ');

            $referral_link = DB::select('SELECT * FROM referral_links WHERE code = "'.Auth::user()->id.'" LIMIT 1');

            return view("web/businessProfile", compact("business_data","business_data_user","banners_data","check_is_active_subscription","referral_link"));
        } else {
            return Redirect("login");
        }
    }

    public function EditProcess(Request $request) {
        $validated = $request->validate(
            [
                'name' => 'required',
                'profile_image' => 'mimes:jpg,jpeg,png',
                'email' => 'required',
                'email' => 'required|unique:users,email,'.Auth::user()->id,
			],
			[
				'name.required' => 'Name is Required!',
                'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
                'email.required' => 'Email is Required!',
                'email.unique' => 'Email is already Exists!',
			],
		);

        $orgDate = $request->dob;  
        $date = str_replace('/', '-', $orgDate);  

        $profile_image = $request->file("profile_image");
		if( $profile_image ) {
            $old_image = $request->old_profile_image;
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($profile_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/profile/');
	        $last_image = $up_location.$img_name;
	        $statsu = $profile_image->move($up_location,$img_name);
            @unlink($up_location.$old_image);
            $update_array = array(
	    		"first_name" => $request->name,
		    	"zip_code" => $request->zip_code,    
                "profile_photo_path" => $img_name,
		    	"dob" => date("Y-m-d H:i:s", strtotime($request->dob)),
		    	"email" => $request->email,
		    	"password" => Hash::make($request->password),
		    	"redit_link" => $request->reddit_link,
		    	"discord_link" => $request->discord_link
	    	);
        } else {
            if( trim($request->password) != "" ) {
                $update_array = array(
                    "first_name" => $request->name,
                    "zip_code" => $request->zip_code,    
                    "dob" => date("Y-m-d H:i:s", strtotime($request->dob)),
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "redit_link" => $request->reddit_link,
                    "discord_link" => $request->discord_link,
                    "profile_photo_path"=>
                );
            } else {
                $update_array = array(
                    "first_name" => $request->name,
                    "zip_code" => $request->zip_code,    
                    "dob" => date("Y-m-d H:i:s", strtotime($date)),
                    "email" => $request->email,
                    "redit_link" => $request->reddit_link,
                    "discord_link" => $request->discord_link
                );
            }
        }

        $result_status = User::find(Auth::user()->id)->update($update_array);
		return Redirect("/businessProfile")->with("success", "Profile Updated Successfully");
    }
    public function user_type_selection(Request $request, $user_type_selection) {
        if( isset($user_type_selection) && $user_type_selection != '' ) {
            if( ($user_type_selection == "business") || ($user_type_selection == "user") ) {
                if( $user_type_selection == "business" ) {
                    $query = DB::select('UPDATE users SET user_type_status = 1, user_type = "business" WHERE id = "'.Auth::user()->id.'" ');
                } else if( $user_type_selection == "user") {
                    $query = DB::select('UPDATE users SET user_type_status = 1, user_type = "business", selected_plan = 1, category_selected_status = 1 WHERE id = "'.Auth::user()->id.'" ');
                }
            } else if( ($user_type_selection == "doctor") || ($user_type_selection == "dispensary") || ($user_type_selection == "delivery") ) {
                $query = DB::select('UPDATE users SET category_selected_status = 1 WHERE id = "'.Auth::user()->id.'" ');
            }
        }
        return Redirect("/businessProfile");
    }
    
}