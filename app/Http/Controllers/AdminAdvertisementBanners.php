<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\AdvertisementBanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;

class AdminAdvertisementBanners extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = AdvertisementBanner::all();
    	return view("admin/banners/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	return view("admin/banners/add", compact('usersData'));
    }
    public function AddProcess( Request $request) {

        $embed_code = $request->embed_code;
        $banner_location = $request->banner_location;
        if( isset($embed_code) && $embed_code != '' ) {
            $update_array = array(
                "location" => $banner_location,
                "third_party_code" => $embed_code,
                "type" => 'third_party'
            );
        } else {
            $validated = $request->validate(
                [
                    'c_image' => 'required|mimes:jpg,jpeg,png',
                ],
                [
                    'c_image.required' => 'Banner Image is Required!',
                    'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
                ],
            );

            $lat = $request->lat;
            $lng = $request->lng;
            $name = $request->name;
            $url = $request->url;

            $c_image = $request->file("c_image");
            if( $c_image ) {
                $name_gen = hexdec( uniqid() );
                $img_ext = strtolower($c_image->getClientOriginalExtension());
                $img_name = $name_gen.".".$img_ext;
                $up_location = public_path('/assets/img/advert_banners/');
                $last_image = $up_location.$img_name;
                $statsu = $c_image->move($up_location,$img_name);
                $update_array = array(
                    "banner_image" => $img_name,
                    "location" => $banner_location,
                    "type" => 'web',
                    "lat" => $lat,
                    "redirect_url" => $url,
                    "lon" => $lng,
                    "location_name" => $name
                );
            } else {
                $update_array = array(
                    "location" => $banner_location,
                    "type" => 'web',
                    "lat" => $lat,
                    "redirect_url" => $url,
                    "lon" => $lng,
                    "location_name" => $name
                );
            }
        }
        $result_status = AdvertisementBanner::insert($update_array);
		return Redirect("/admin/banners")->with("success", "Banner Added Successfully");
    }
    

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = AdvertisementBanner::find($customerId);
            return view("admin/banners/edit",compact("customer_data","usersData"));
    	}
    }
    public function EditProcess( Request $request, $customer_id) {
		$embed_code = $request->embed_code;
        $banner_location = $request->banner_location;
        if( isset($embed_code) && $embed_code != '' ) {
            $update_array = array(
                "location" => $banner_location,
                "third_party_code" => $embed_code,
                "banner_image" => "",
                "type" => 'third_party'
            );
        } else {

            $lat = $request->lat;
            $lng = $request->lng;
            $name = $request->name;
            $url = $request->url;
    		$c_image = $request->file("c_image");
            $banner_location = $request->banner_location;
    		if( $c_image ) {
                $old_image = $request->old_profile_image;
                $name_gen = hexdec( uniqid() );
    	        $img_ext = strtolower($c_image->getClientOriginalExtension());
    	        $img_name = $name_gen.".".$img_ext;
    	        $up_location = public_path('/assets/img/advert_banners/');
    	        $last_image = $up_location.$img_name;
    	        $statsu = $c_image->move($up_location,$img_name);
                @unlink($up_location.$old_image);
                $update_array = array(
    		    	"banner_image" => $img_name,
                    "location" => $banner_location,
                    "third_party_code" => "",
                    "type" => 'web',
                    "lat" => $lat,
                    "redirect_url" => $url,
                    "lon" => $lng,
                    "location_name" => $name
    	    	);
            } else {
                $update_array = array(
                    "location" => $banner_location,
                    "third_party_code" => "",
                    "type" => 'web',
                    "lat" => $lat,
                    "lon" => $lng,
                    "redirect_url" => $url,
                    "location_name" => $name
                );
            }
        }
        $result_status = AdvertisementBanner::find($customer_id)->update($update_array);
		return Redirect("/admin/banners")->with("success", "Banner Updated Successfully");
    }

    public function DeleteProcess($customerId) {
    	if( isset($customerId) && $customerId != "" ) {
	        AdvertisementBanner::find($customerId)->delete();
	        return Redirect()->back()->with("success", "Business Deleted Successfully");
    	}
    }

    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
}
