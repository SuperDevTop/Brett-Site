<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\CmsLandingPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Redirect;

class CmsfooterPageController extends Controller
{
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }

    
    public function footerPageChildAdd ( Request $request) {
    	$parent_menu_child = $request->parent_menu_child;
    	$p_name = $request->p_name;
    	$p_url = $request->p_url;
    	$p_order_by = $request->p_order_by;
    	$footer_parent = DB::insert(' INSERT INTO footer_cms SET
    		name = "'.$p_name.'",
    		url = "'.$p_url.'",
    		parent_child_relation = "'.$parent_menu_child.'",
    		order_by = "'.$p_order_by.'"
    	');
    	return Redirect("/admin/footerPage")->with("success_child", "Child Menu Added Successfully");
    }

    public function footerPageParentAdd ( Request $request) {
    	$p_name = $request->p_name;
    	$p_url = $request->p_url;
    	$p_order_by = $request->p_order_by;
    	$footer_parent = DB::insert(' INSERT INTO footer_cms SET
    		name = "'.$p_name.'",
    		url = "'.$p_url.'",
    		parent_child_relation = "0",
    		order_by = "'.$p_order_by.'"
    	');
    	return Redirect("/admin/footerPage")->with("success_parent", "Parent Menu Added Successfully");
    }

    public function footerPageParentEdit ( Request $request,$menu_id) {
    	if( $menu_id != '' ) {
	    	$p_name = $request->p_name;
	    	$p_url = $request->p_url;
	    	$p_order_by = $request->p_order_by;
	    	$footer_parent = DB::insert(' UPDATE footer_cms SET
	    		name = "'.$p_name.'",
	    		url = "'.$p_url.'",
	    		parent_child_relation = "0",
	    		order_by = "'.$p_order_by.'"
	    		WHERE id = "'.$menu_id.'"
	    	');
	    	return Redirect("/admin/footerPage")->with("success_parent", "Parent Menu Updated Successfully");
	    }
    }

    public function footerPageChildEdit ( Request $request,$menu_id) {
    	if( $menu_id != '' ) {
    		$parent_menu_child = $request->parent_menu_child;
	    	$p_name = $request->p_name;
	    	$p_url = $request->p_url;
	    	$p_order_by = $request->p_order_by;
	    	$footer_parent = DB::insert(' UPDATE footer_cms SET
	    		name = "'.$p_name.'",
	    		url = "'.$p_url.'",
	    		parent_child_relation = "'.$parent_menu_child.'",
	    		order_by = "'.$p_order_by.'"
	    		WHERE id = "'.$menu_id.'"
	    	');
	    	return Redirect("/admin/footerPage")->with("success_child", "Child Menu Updated Successfully");
	    }
    }
   
    public function EditProcess( Request $request, $customer_id) {
		$c_image = $request->file("page_image");
		if( $c_image ) {
			$old_image = $request->old_profile_image;
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/footerPage/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
            @unlink($up_location.$old_image);

            $update_array = array(
	    		"title" => $request->title,
		    	"image_name" => $img_name,
		    	"description" => $request->description
	    	);
        } else {
            $update_array = array(
	    		"title" => $request->title,
		    	"description" => $request->description
	    	);
        }
        $result_status = CmsLandingPage::find($customer_id)->update($update_array);
        return Redirect("/admin/footerPage")->with("success", "Landing Page Data Updated Successfully");
    }
    public function Edit() {
    	$footer_all_data = array();
    	$usersData = $this->GetLoggedInUserData();
	    $footer_parent = DB::select(' select * from footer_cms WHERE parent_child_relation = 0 ORDER BY order_by ASC');
        if( isset($footer_parent) && count($footer_parent) > 0 ) {
        	foreach ($footer_parent as $key => $value) {
        		$footer_all_data[$key]['parent'] = $value;
        		$footer_childs = DB::select(' select * from footer_cms WHERE parent_child_relation = "'.$value->id.'" ORDER BY order_by ASC');
		        if( isset($footer_childs) && count($footer_childs) > 0 ) {
		        	foreach ($footer_childs as $key_child => $value_child) {
		        		$footer_all_data[$key]['child'][$key_child] = $value_child;
		        	}
		        }
        	}
        }
        // dd($footer_all_data);
        return view("admin/footerPage/edit",compact("footer_all_data","usersData"));
    }

    public function EditParent($menu_id) {
    	$footer_all_data = array();
    	$usersData = $this->GetLoggedInUserData();
	    $footer_parent = DB::select(' select * from footer_cms WHERE id = "'.$menu_id.'" ');
	    if( isset($footer_parent) && count($footer_parent) > 0 ) {
	    	$footer_parent = $footer_parent[0];
	    }
        return view("admin/footerPage/editParent",compact("footer_parent","usersData"));
    }

    public function EditChild($menu_id) {
    	$footer_all_data = array();
    	$usersData = $this->GetLoggedInUserData();
    	
    	$footer_parent_all = DB::select(' select * from footer_cms WHERE parent_child_relation = "0" ');
    	$footer_parent = DB::select(' select * from footer_cms WHERE id = "'.$menu_id.'" ');
	    if( isset($footer_parent) && count($footer_parent) > 0 ) {
	    	$footer_parent = $footer_parent[0];
	    }
        return view("admin/footerPage/editChild",compact("footer_parent","usersData","footer_parent_all"));
    }

    public function footerPageDelete($menu_id) {
    	if( $menu_id != '' ) {
    		DB::delete('DELETE from footer_cms where id = "'.$menu_id.'" ');
    		return Redirect::back()->with("success", "Store Product Deleted Successfully");
    	}
    }
}
