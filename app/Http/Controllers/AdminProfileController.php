<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;

class AdminProfileController extends Controller
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
        return view("admin/profile/edit",compact("customer_data","usersData"));
    }	

    public function EditProcess( Request $request, $customer_id) {
    	$validated = $request->validate(
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'profile_image' => 'mimes:jpg,jpeg,png',
                'email' => 'required|unique:users,email,'.$customer_id,
                'password' => 'required',
                // 'password' => 'required',
                'status' => 'required',
                // 'status' => 'required',
			],
			[
				'f_name.required' => 'First Name is Required!',
                'l_name.required' => 'Last Name is Required!',
                'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
                'email.required' => 'Email is Required!',
                // 'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
                // 'email.required' => 'Email is Required!',
                'email.unique' => 'Email is already Exists!',
                'password.required' => 'Password is Required!',
                'status.required' => 'Status is Required!',
			],
		);
		  
        $dob = $request->dob;
        $zipcode = $request->zipcode;
        $red_link = $request->red_link;
        $discord_link = $request->discord_link;
        
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
	    		"first_name" => $request->f_name,
		    	"last_name" => $request->l_name,
		    	"profile_photo_path" => $img_name,
		    	"email" => $request->email,
                'dob' => $dob,
                'zip_code' => $zipcode,
                'redit_link' => $red_link,
                'discord_link' => $discord_link,
		    	"status" => $request->status,
		    	"lat" => $request->lat,
		    	"long" => $request->long,
		    	'password' => Hash::make($request->password)
	    	);
        } else {
            $update_array = array(
	    		"first_name" => $request->f_name,
		    	"last_name" => $request->l_name,
		    	"email" => $request->email,
                'dob' => $dob,
                'zip_code' => $zipcode,
                'redit_link' => $red_link,
                'discord_link' => $discord_link,
		    	"status" => $request->status,
		    	"lat" => $request->lat,
		    	"long" => $request->long,
		    	'password' => Hash::make($request->password)
	    	);
        }
        $result_status = User::find($customer_id)->update($update_array);
		return Redirect("/admin/adminProfile/view")->with("success", "Profile Updated Successfully");
    }
}
