<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;

class PortalSetting extends Controller
{
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    public function View() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_data = $this->GetAdminData();
        return view("admin/profile/view",compact("customer_data","usersData"));
    }
    public function GetAdminData() {
    	$admin_data = DB::select('select * from users where user_type = "administrator" LIMIT 1 ');
    	$customer_data = User::find($admin_data[0]->id);
    	return $customer_data;
    }

    public function Edit() {
    	$usersData = $this->GetLoggedInUserData();
	    $customer_data = $this->GetAdminData();
	    $setting_data = DB::select('select * from portal_settings ORDER BY id DESC LIMIT 1');
	    $setting_data = $setting_data[0];
        
        return view("admin/portalSettings/edit",compact("setting_data","customer_data","usersData"));
    }	

    public function EditProcess( Request $request, $customer_id) {
    	$validated = $request->validate(
            [
                'profile_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		$reviews_status = 0;
    	if( isset($request->review_status) && $request->review_status != '' ) {
    		$reviews_status = $request->review_status;
    	}


        $footer_image = $request->file("footer_image");
        if( $footer_image ) {
            $old_image = $request->old_footer_image;
            $name_gen = hexdec( uniqid() );
            $img_ext = strtolower($footer_image->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $up_location = public_path('/assets/img/settings/');
            $last_image = $up_location.$img_name;
            $statsu = $footer_image->move($up_location,$img_name);
            @unlink($up_location.$old_image);
            $query = "UPDATE portal_settings SET
                footer_logo =  '".$img_name."'
                WHERE id = '".$customer_id."'
            ";
            $admin_data = DB::update($query);
        }

        $favi_logo = $request->file("favi_logo");
        if( $favi_logo ) {
            $old_image = $request->old_favi_logo;
            $name_gen = hexdec( uniqid() );
            $img_ext = strtolower($favi_logo->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $up_location = public_path('/assets/img/settings/');
            $last_image = $up_location.$img_name;
            $statsu = $favi_logo->move($up_location,$img_name);
            @unlink($up_location.$old_image);
            $query = "UPDATE portal_settings SET
                favi_logo =  '".$img_name."'
                WHERE id = '".$customer_id."'
            ";
            $admin_data = DB::update($query);
        }

        $profile_image = $request->file("profile_image");
		if( $profile_image ) {
            $old_image = $request->old_profile_image;
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($profile_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/settings/');
	        $last_image = $up_location.$img_name;
	        $statsu = $profile_image->move($up_location,$img_name);
            @unlink($up_location.$old_image);
            $query = "UPDATE portal_settings SET
	    		logo =  '".$img_name."'
		    	WHERE id = '".$customer_id."'
	    	";
            $admin_data = DB::update($query);
        }



        $query = "UPDATE portal_settings SET
    		project_name = '".$request->p_name."',
	    	phone = '".$request->phone."',
	    	email = '".$request->email."',
	    	location = '".$request->location."',
            google_api_key =  '".$request->google_api_key."',
	    	reviews_show_hide_status = 1,

            under_footer_logo_text =  '".$request->under_footer_logo_text."',
            copyright_text =  '".$request->copyright_text."',

            discord_link = '".$request->discord_link."',
            reddit_link = '".$request->reddit_link."',
            radius = '".$request->radius."',
	    	updated_at = '".date("Y-m-d H:i:s")."'
	    	WHERE id = '".$customer_id."'
    	";
        $admin_data = DB::update($query);
		return Redirect("/admin/portalSettings")->with("success", "Portal Settings Updated Successfully!");
    }

    public static function portalSettings() {
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        return $portal_settings;
    }
}
