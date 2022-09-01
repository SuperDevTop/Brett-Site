<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Amenities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
class AmenitiesController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = Amenities::all();
    	return view("admin/amenities/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	return view("admin/amenities/add", compact('usersData'));
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
				'name.required' => 'Categoy Name is Required!',
                'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		
		$c_image = $request->file("c_image");
		if( $c_image ) {
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/amenities/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
            $update_array = array(
	    		"name" => $request->name,
		    	"cat_image" => $img_name,
	    	);
        } else {
            $update_array = array(
	    		"name" => $request->name,
		    	"status" => $request->status
	    	);
        }
        $result_status = Amenities::insert($update_array);
		return Redirect("/admin/amenities")->with("success", "Amenity Added Successfully");
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
		
		$c_image = $request->file("c_image");
		if( $c_image ) {
            $old_image = $request->old_profile_image;
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/amenities/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
            @unlink($up_location.$old_image);

            $update_array = array(
	    		"name" => $request->name,
		    	"cat_image" => $img_name,
	    	);
        } else {
            $update_array = array(
	    		"name" => $request->name,
		    	"status" => $request->status
	    	);
        }
        $result_status = Amenities::find($customer_id)->update($update_array);
		return Redirect("/admin/amenities")->with("success", "Amenity Updated Successfully");
    }

    public function DeleteProcess($customerId) {
    	if( isset($customerId) && $customerId != "" ) {
	        Amenities::find($customerId)->delete();
	        return Redirect()->back()->with("success", "Amenity Deleted Successfully");
    	}
    }

    public function View($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = Amenities::find($customerId);
	        return view("admin/amenities/view",compact("customer_data","usersData"));
    	}
    }

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = Amenities::find($customerId);
	        return view("admin/amenities/edit",compact("customer_data","usersData"));
    	}
    }
}
