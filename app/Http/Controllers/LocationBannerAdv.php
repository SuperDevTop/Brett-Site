<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LocationBanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
class LocationBannerAdv extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = LocationBanner::all();
    	return view("admin/location_banners_adv/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	return view("admin/location_banners_adv/add", compact('usersData'));
    }
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    
    public function AddProcess( Request $request) {
    	$validated = $request->validate(
            [
                'name' => 'required',
                'c_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'name.required' => 'Location is Required!',
                'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		
        $lat = $request->lat;
        $lng = $request->lng;

		$c_image = $request->file("c_image");
		if( $c_image ) {
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/location_banners_adv/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
            $update_array = array(
	    		"name" => $request->name,
		    	"cat_image" => $img_name,
                "lat" => $lat,
                "lon" => $lng
	    	);
        } else {
            $update_array = array(
	    		"name" => $request->name,
		    	"status" => $request->status,
                "lat" => $lat,
                "lon" => $lng
	    	);
        }
        $result_status = LocationBanner::insert($update_array);
		return Redirect("/admin/location_banners")->with("success", "Location Banners Added Successfully");
    }

    public function EditProcess( Request $request, $customer_id) {
    	$validated = $request->validate(
            [
                'name' => 'required',
                'c_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'name.required' => 'Categoy Name is Required!',
                'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		
        $lat = $request->lat;
        $lng = $request->lng;

		$c_image = $request->file("c_image");
		if( $c_image ) {
            $old_image = $request->old_profile_image;
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/location_banners_adv/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
            @unlink($up_location.$old_image);

            $update_array = array(
	    		"name" => $request->name,
		    	"cat_image" => $img_name,
                "lat" => $lat,
                "lon" => $lng
	    	);
        } else {
            $update_array = array(
	    		"name" => $request->name,
		    	"status" => $request->status,
                "lat" => $lat,
                "lon" => $lng
	    	);
        }
        $result_status = LocationBanner::find($customer_id)->update($update_array);
		return Redirect("/admin/location_banners")->with("success", "Location Banners Updated Successfully");
    }

    public function DeleteProcess($customerId) {
    	if( isset($customerId) && $customerId != "" ) {
	        LocationBanner::find($customerId)->delete();
	        return Redirect()->back()->with("success", "Location Banners Deleted Successfully");
    	}
    }

    public function View($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = LocationBanner::find($customerId);
	        return view("admin/location_banners_adv/view",compact("customer_data","usersData"));
    	}
    }

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = LocationBanner::find($customerId);
	        return view("admin/location_banners_adv/edit",compact("customer_data","usersData"));
    	}
    }
}