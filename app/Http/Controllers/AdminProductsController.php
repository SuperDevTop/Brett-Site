<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class AdminProductsController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = DB::select("SELECT categories.name as category_name,stores.name as store_name, products.* FROM products LEFT JOIN stores ON products.store_id = stores.id LEFT JOIN categories ON products.category_id = categories.id");
    	return view("admin/products/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	$all_stores = DB::select("SELECT * FROM stores");
    	$all_categories = DB::select("SELECT * FROM categories");
    	$products_categories = DB::select("SELECT * FROM products_categories");
    	return view("admin/products/add", compact('usersData','all_stores','all_categories','products_categories'));
    }
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    
    public function AddProcess( Request $request) {
    	$validated = $request->validate(
            [
                'p_name' => 'required',
                'p_description' => 'required',
                'p_price' => 'required',
                'categories' => 'required',
                'stores' => 'required',
                'status' => 'required',
                'c_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'p_name.required' => 'Product Name is Required!',
				'p_description.required' => 'Product Description is Required!',
				'p_price.required' => 'Product Price is Required!',
				'categories.required' => 'Categoy is Required!',
				'stores.required' => 'Store is Required!',
                'status.required' => 'Status is Required!',
                'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		
    	$c_image = $request->file("c_image");
		if( $c_image ) {
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/products/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
            $update_array = array(
	    		"name" => $request->p_name,
	    		"regular_price" => $request->p_price,
	    		"category_id" => $request->categories,
	    		"product_category_id" => $request->product_categories,
	    		"deal_simple_product_status" => $request->type,
	    		"featured" => 0,
	    		"description" => $request->p_description,
	    		"store_id" => $request->stores,
	    		"status" => $request->status,
	    		"user_id" => Auth::User()->id,
		    	"image" => $img_name
	    	);
        } else {
            $update_array = array(
	    		"name" => $request->p_name,
	    		"regular_price" => $request->p_price,
	    		"category_id" => $request->categories,
	    		"product_category_id" => $request->product_categories,
	    		"deal_simple_product_status" => $request->type,
	    		"featured" => 0,
	    		"description" => $request->p_description,
	    		"store_id" => $request->stores,
	    		"user_id" => Auth::User()->id,
	    		"status" => $request->status
	    	);
        }
        $result_status = Products::insert($update_array);
		return Redirect("/admin/products")->with("success", "Product Added Successfully");
    }

    public function EditProcess( Request $request, $customer_id) {
    	$validated = $request->validate(
            [
                'p_name' => 'required',
                'p_description' => 'required',
                'p_price' => 'required',
                'categories' => 'required',
                'stores' => 'required',
                'status' => 'required',
                'c_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'p_name.required' => 'Product Name is Required!',
				'p_description.required' => 'Product Description is Required!',
				'p_price.required' => 'Product Price is Required!',
				'categories.required' => 'Categoy is Required!',
				'stores.required' => 'Store is Required!',
                'status.required' => 'Status is Required!',
                'c_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		
		$c_image = $request->file("c_image");
		if( $c_image ) {
            $old_image = $request->old_profile_image;
            $name_gen = hexdec( uniqid() );
	        $img_ext = strtolower($c_image->getClientOriginalExtension());
	        $img_name = $name_gen.".".$img_ext;
	        $up_location = public_path('/assets/img/products/');
	        $last_image = $up_location.$img_name;
	        $statsu = $c_image->move($up_location,$img_name);
            @unlink($up_location.$old_image);
			$update_array = array(
	    		"name" => $request->p_name,
	    		"regular_price" => $request->p_price,
	    		"category_id" => $request->categories,
	    		"featured" => 0,
	    		"deal_simple_product_status" => $request->type,
	    		"product_category_id" => $request->product_categories,
	    		"description" => $request->p_description,
	    		"store_id" => $request->stores,
	    		"status" => $request->status,
	    		"user_id" => Auth::User()->id,
		    	"image" => $img_name
	    	);
        } else {
            $update_array = array(
	    		"name" => $request->p_name,
	    		"regular_price" => $request->p_price,
	    		"deal_simple_product_status" => $request->type,
	    		"product_category_id" => $request->product_categories,
	    		"featured" => 0,
	    		"category_id" => $request->categories,
	    		"description" => $request->p_description,
	    		"store_id" => $request->stores,
	    		"status" => $request->status
	    	);
        }
        $result_status = Products::find($customer_id)->update($update_array);
		return Redirect("/admin/products")->with("success", "Product Updated Successfully");
    }

    public function DeleteProcess($customerId) {
    	if( isset($customerId) && $customerId != "" ) {
	        Products::find($customerId)->delete();
	        return Redirect()->back()->with("success", "Product Deleted Successfully");
    	}
    }

    public function View($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = Products::find($customerId);
	        return view("admin/products/view",compact("customer_data","usersData"));
    	}
    }

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	$usersData = $this->GetLoggedInUserData();
    	$products_categories = DB::select("SELECT * FROM products_categories");
    	$all_stores = DB::select("SELECT * FROM stores");
    	$all_categories = DB::select("SELECT * FROM categories");
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = Products::find($customerId);
	        return view("admin/products/edit",compact("customer_data","usersData","all_stores","all_categories","products_categories"));
    	}
    }
}
