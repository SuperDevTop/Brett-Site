<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\Plans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;

class PlansController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = Plans::all();
    	return view("admin/plans/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	$Categories_all = Categories::all();
    	return view("admin/plans/add", compact('usersData', "Categories_all"));
    }
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    
    public function AddProcess( Request $request) {

    	$validated = $request->validate(
            [
                'plan_name' => 'required',
                'plan_price' => 'required',
                'plan_description' => 'required',
                'p_category' => 'required',
                'c_image' => 'mimes:jpg,jpeg,png',
                'status' => 'required',
			],
			[
				'plan_name.required' => 'Plan name is required',
                'plan_price.required' => 'Plan Price is required',
                'plan_description.required' => 'Plan Description is required',
                'p_category.required' => 'Plan Category is required',
				'c_name.required' => 'Categoy Name is Required!',
                'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
                'status.required' => 'Status is Required!',
			],
		);

		$plan_options = array();
		if( isset($request->show_company_name) ) {
			$plan_options['show_company_name'] = "Company Name";
		}
		if( isset($request->show_address) ) {
			$plan_options['show_address'] = "Company Address";
		}
		if( isset($request->show_company_logo) ) {
			$plan_options['show_company_logo'] = "Company Logo";
		}
		if( isset($request->show_business_description) ) {
			$plan_options['show_business_description'] = "Business Address";
		}
		if( isset($request->show_markers_on_maps) ) {
			$plan_options['show_markers_on_maps'] = "Markes on Maps";
		}
		if( isset($request->premium_map_icons) ) {
			$plan_options['premium_map_icons'] = "Premium Bigger Map Icon";
		}
		if( isset($request->link_to_website_listing_page) ) {
			$plan_options['link_to_website_listing_page'] = "Link to Business Website";
		}
		if( isset($request->link_with_social_media) ) {
			$plan_options['link_with_social_media'] = "Link to Social Media";
		}
		if( isset($request->show_store_hours) ) {
			$plan_options['show_store_hours'] = "Business Hours";
		}
		if( isset($request->show_review_on_listing_page) ) {
			$plan_options['show_review_on_listing_page'] = "Reviews on Listing Page";
		}
		if( isset($request->offer_discounts_deals) ) {
			$plan_options['offer_discounts_deals'] = "Business Deals";
		}
		if( isset($request->show_phone_number) ) {
			$plan_options['show_phone_number'] = "Business Phone Number";
		}
		if( isset($request->include_photos) ) {
			$plan_options['include_photos'] = "Include Business Photos";
		}
		if( isset($request->import_photos) ) {
			$plan_options['import_photos'] = "Import Business Photos";
		}
		if( isset($request->import_videos) ) {
			$plan_options['import_videos'] = "Import Business Videos";
		}
		if( isset($request->delivery_service_description) ) {
			$plan_options['delivery_service_description'] = "Delivery Service Description";
		}
		if( isset($request->about_us_information) ) {
			$plan_options['about_us_information'] = "About Us Information";
		}
		$products_shoe_of_category = $request->x_products_to_show;
		if( isset($request->feature_listing_x_per_day) ) {
			if( $request->feature_listing_x_per_day != '' ) {
				$plan_options['feature_listing_x_per_day'] = $request->feature_listing_x_per_day;
			}
		}

		if( isset($request->x_products_to_show) ) {
			if( $request->x_products_to_show != '' ) {
				$plan_options['products_to_show'] = $request->x_products_to_show;
			}
		}
		$checked_checkbox_array = json_encode($plan_options);
		
		$feature_listing_rotation = $request->feature_listing_x_per_day;
		$products_shoe_of_category = $request->x_products_to_show;
		
		$c_image = $request->file("c_image");
		if( $c_image ) {
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/plans/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);

            $update_array = array(
	    		"plane_name" => $request->plan_name,
	    		"price" => $request->plan_price,
	    		"category_id" => $request->p_category,
	    		"feature_listing_rotation" => $feature_listing_rotation,
	    		"products_shoe_of_category" => $products_shoe_of_category,
	    		"plan_options_checkboxes_value" => $checked_checkbox_array,
	    		"plan_options_checkboxes" => $checked_checkbox_array,
	    		"description" => $request->plan_description,
		    	"image" => $img_name,
		    	"status" => $request->status
	    	);
        } else {
            $update_array = array(
	    		"plane_name" => $request->plan_name,
	    		"price" => $request->plan_price,
	    		"category_id" => $request->p_category,
	    		"feature_listing_rotation" => $feature_listing_rotation,
	    		"products_shoe_of_category" => $products_shoe_of_category,
	    		"plan_options_checkboxes_value" => $checked_checkbox_array,
	    		"plan_options_checkboxes" => $checked_checkbox_array,
	    		"image" => "",
	    		"description" => $request->plan_description,
		    	"status" => $request->status
	    	);
        }
        $result_status = Plans::insert($update_array);
		return Redirect("/admin/plans")->with("success", "Plan Added Successfully");
    }

    public function EditProcess( Request $request, $customer_id) {

    	$validated = $request->validate(
            [
                'plan_name' => 'required',
                'plan_description' => 'required',
                'c_image' => 'mimes:jpg,jpeg,png',
                'status' => 'required',
			],
			[
				'plan_name.required' => 'Plan name is required',
                'plan_description.required' => 'Plan Description is required',
                'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
                'status.required' => 'Status is Required!',
			],
		);


		$c_image = $request->file("c_image");
		if( $c_image ) {

			$old_image = $request->old_profile_image;
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/plans/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
	        @unlink($up_location.$old_image);
            $update_array = array(
	    		"plane_name" => $request->plan_name,
		    	"image" => $img_name,
	    		"description" => $request->plan_description,
		    	"status" => $request->status
	    	);
        } else {
            $update_array = array(
	    		"plane_name" => $request->plan_name,
	    		"description" => $request->plan_description,
		    	"status" => $request->status
	    	);
        }
        $result_status = Plans::find($customer_id)->update($update_array);
        return Redirect("/admin/plans")->with("success", "Plan Updated Successfully");
    }

    public function DeleteProcess($customerId) {
    	if( isset($customerId) && $customerId != "" ) {
	        Plans::find($customerId)->delete();
	        return Redirect()->back()->with("success", "Plan Deleted Successfully");
    	}
    }

    public function View($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = Plans::find($customerId);
	        return view("admin/plans/view",compact("customer_data","usersData"));
    	}
    }

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = Plans::find($customerId);
	        $Categories_all = Categories::all();
	        return view("admin/plans/edit",compact("customer_data","usersData","Categories_all"));
    	}
    }

    public function planCatDetails() {
    	$usersData = $this->GetLoggedInUserData();
        $customer_data = DB::select('select * FROM plan_category_details LIMIT 1');
		if( count($customer_data) > 0 ) {
			$customer_data = $customer_data[0];
		}
        return view("admin/planCatDetails/edit",compact("customer_data","usersData"));
    }

      public function planCatDetailsUpdateProcess(Request $request) {

        $query = "UPDATE plan_category_details SET
    		doctor_detail = '".$request->doctor_cat_description."',
	    	delivery_detail = '".$request->delivery_cat_description."',
	    	dispensary_detail = '".$request->dispensary_cat_description."'
    	";
        $admin_data = DB::update($query);
		return Redirect("/admin/planCatDetails")->with("success", "Plan Categories Description Updated Successfully!");
    }


}