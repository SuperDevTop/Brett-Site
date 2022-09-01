<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Stores;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Redirect;

class ProductsProfile extends Controller
{
    public function index(Request $request) {
    	
    	$business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
        if( isset($business_data[0]) ) {
            $business_data = $business_data[0];
        }

        $products_categories = DB::select('select * from products_categories order by name ASC');
        $products_data = DB::select('select * from products where user_id = "'.Auth::user()->id.'" and status = "1" ');
        if( isset($products_data) ) {
            $products_data = $products_data;
        }

        $business_data_user = DB::select('select * from users where id = "'.Auth::user()->id.'"  LIMIT 1 ');
        $banners_data = DB::select('select * from advertisement_banners where location = "user_profile" ');
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
        return view("web/storeProducts", compact("products_data","products_categories","business_data","business_data_user","check_is_active_subscription"));
    }

    public function singleProductDelete($product_id) {
    	if( isset($product_id) ) {
    		$products_data = DB::delete('DELETE from products where products.id = "'.$product_id.'" ');
    		return Redirect::back()->with("success", "Store Product Deleted Successfully");

    	}
    }

    public function singleProductDetails($product_id) {
    	if( isset($product_id) ) {
    		$products_data = DB::select('select categories.name as c_name, stores.name as st_name, products.* from products LEFT JOIN categories ON categories.id = products.category_id LEFT JOIN stores ON stores.id = products.store_id where products.id = "'.$product_id.'" ');
    		$products_data = $products_data[0];
	        return view("web/singleProductDetails", compact("products_data"));
    	}
    }

    public function singleDealDetails($product_id) {
    	if( isset($product_id) ) {
    		$products_data = DB::select('select categories.name as c_name, stores.name as st_name, products.* from products LEFT JOIN categories ON categories.id = products.category_id LEFT JOIN stores ON stores.id = products.store_id where products.id = "'.$product_id.'" ');
    		$products_data = $products_data[0];
	        return view("web/singleDealDetails", compact("products_data"));
    	}
    }

    public function productEdit(Request $request) {


    	$business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
        if( isset($business_data[0]) ) {
            $business_data = $business_data[0];
        }

        $products_categories = DB::select('select * from products_categories order by name ASC');
        $products_data = DB::select('select * from products where user_id = "'.Auth::user()->id.'" and status = "1" ');
        if( isset($products_data) ) {
            $products_data = $products_data;
        }

        $business_data_user = DB::select('select * from users where id = "'.Auth::user()->id.'"  LIMIT 1 ');
        $banners_data = DB::select('select * from advertisement_banners where location = "user_profile" ');
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


    	if( isset($request->id) && $request->id != '' && $request->id != 0 && $request->id != NULL ) {
    		$store_id = session()->get("business_store_id");
    		if( isset($store_id) && $store_id != '' ) {
	    		$products_data = DB::select('select * from products where id = "'.$request->id.'" AND store_id = "'.session()->get("business_store_id").'" ');
	    		if( isset($products_data) && count($products_data) > 0 ) {
	    			$products_data = (Array)$products_data[0];
	    		} else {
	    			$products_data = array();
	    		}
	    		$product_id = $request->id;
		        return view("web/singleProductEdit", compact("products_data","products_data","products_categories","business_data","business_data_user","check_is_active_subscription","product_id"));
		    }
    	}
	}
    public function EditProcess(Request $request) {
    	$validated = $request->validate(
            [
                'category' => 'required',
                'product_name' => 'required',
                'product_info' => 'required',
                'price' => 'required',
                'profile_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'category.required' => 'Category is Required!',
				'product_name.required' => 'Product Name is Required!',
				'product_info.required' => 'Product Details is Required!',
				'price.required' => 'Price is Required!',
                'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);

    	$seo_title = $request->seo_title;
		$seo_keyword = $request->seo_keyword;
		$seo_description = $request->seo_description;

		$product_id = $request->product_id;
		$result_status = DB::select("SELECT id FROM stores WHERE bussiness_user_id = '".Auth::user()->id."' ");
		if( isset($product_id) && $product_id != '' ) {

			$seo_image_name = "";
			$seo_image = $request->file("seo_image");
			if( $seo_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($seo_image->getClientOriginalExtension());
		        $seo_image_name = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/products/');
		        $last_image = $up_location.$seo_image_name;
		        $statsu = $seo_image->move($up_location,$seo_image_name);
		        $query = 'UPDATE products SET
			    		seo_image_name = "'.$seo_image_name.'"
			    	WHERE
			    		id = "'.$product_id.'"
		        ';
		        $result_status1 = DB::update($query);
	        } 

			$profile_image = $request->file("profile_image");
			if( $profile_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($profile_image->getClientOriginalExtension());
		        $img_name = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/products/');
		        $last_image = $up_location.$img_name;
		        $statsu = $profile_image->move($up_location,$img_name);
	            @unlink($up_location.$old_image);
	            $query = 'UPDATE products SET
			        	name = "'.$request->product_name.'",
			    		category_id = "'.$request->category.'",
			    		store_id = "'.$result_status[0]->id.'",
			    		user_id = "'.Auth::user()->id.'",
			    		weight = "'.$request->weight.'",
			    		size = "'.$request->size.'",
			    		quantity = "'.$request->quantity.'",
			    		description = "'.$request->product_info.'",
			    		
			    		seo_title = "'.$seo_title.'",
			    		seo_keyword = "'.$seo_keyword.'",
			    		seo_description = "'.$seo_description.'",

			    		product_category_id = "'.$request->p_category.'",
			    		image = "'.$img_name.'",
			    		featured = 0,
			    		status = "1",
			    		regular_price = "'.$request->price.'",
			    		discount_price = "'.$request->price.'",
			    		discount_status = "0",
			    		created_at = "'.date('Y-m-d H:i:s').'"
			    	WHERE
			    		id = "'.$product_id.'"
		        ';
		        $result_status1 = DB::update($query);
	        } else {
	        	$query = 'UPDATE products SET
			        	name = "'.$request->product_name.'",
			    		category_id = "'.$request->category.'",
			    		store_id = "'.$result_status[0]->id.'",
			    		user_id = "'.Auth::user()->id.'",
			    		description = "'.$request->product_info.'",
			    		featured = 0,
			    		weight = "'.$request->weight.'",
			    		size = "'.$request->size.'",

			    		seo_title = "'.$seo_title.'",
			    		seo_keyword = "'.$seo_keyword.'",
			    		seo_description = "'.$seo_description.'",

			    		quantity = "'.$request->quantity.'",
			    		product_category_id = "'.$request->p_category.'",
			    		status = "1",
			    		regular_price = "'.$request->price.'",
			    		discount_price = "'.$request->price.'",
			    		discount_status = "0",
			    		created_at = "'.date('Y-m-d H:i:s').'"
			    	WHERE
			    		id = "'.$product_id.'"
		        ';
		        $result_status1 = DB::update($query);
	        }
			return Redirect("/products")->with("success", "Product Updated Successfully");
		}
	}
	public function AddProcess(Request $request) {

		$validated = $request->validate(
            [
                'category' => 'required',
                'product_name' => 'required',
                'product_info' => 'required',
                'price' => 'required',
                'profile_image' => 'mimes:jpg,jpeg,png',
			],
			[
				'category.required' => 'Category is Required!',
				'product_name.required' => 'Product Name is Required!',
				'product_info.required' => 'Product Details is Required!',
				'price.required' => 'Price is Required!',
                'profile_image.mimes' => 'Required Image Extensions are .jpg, .jpeg, .png',
			],
		);
		
		$seo_title = $request->seo_title;
		$seo_keyword = $request->seo_keyword;
		$seo_description = $request->seo_description;

		$result_status = DB::select("SELECT id FROM stores WHERE bussiness_user_id = '".Auth::user()->id."' ");
		if( isset($result_status[0]->id) ) {

			$seo_image_name = "";
			$seo_image = $request->file("seo_image");
			if( $seo_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($seo_image->getClientOriginalExtension());
		        $seo_image_name = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/products/');
		        $last_image = $up_location.$seo_image_name;
		        $statsu = $seo_image->move($up_location,$seo_image_name);
	        } 

			$profile_image = $request->file("profile_image");
			if( $profile_image ) {
	            $old_image = $request->old_profile_image;
	            $name_gen = hexdec( uniqid() );
		        $img_ext = strtolower($profile_image->getClientOriginalExtension());
		        $img_name = $name_gen.".".$img_ext;
		        $up_location = public_path('/assets/img/products/');
		        $last_image = $up_location.$img_name;
		        $statsu = $profile_image->move($up_location,$img_name);
	            @unlink($up_location.$old_image);
	            $query = 'INSERT INTO products SET
			        	name = "'.$request->product_name.'",
			    		category_id = "'.$request->category.'",
			    		store_id = "'.$result_status[0]->id.'",
			    		user_id = "'.Auth::user()->id.'",
			    		
			    		seo_image_name = "'.$seo_image_name.'",
			    		seo_title = "'.$seo_title.'",
			    		seo_keyword = "'.$seo_keyword.'",
			    		seo_description = "'.$seo_description.'",

			    		weight = "'.$request->weight.'",
			    		size = "'.$request->size.'",
			    		quantity = "'.$request->quantity.'",

			    		description = "'.$request->product_info.'",
			    		product_category_id = "'.$request->p_category.'",
			    		image = "'.$img_name.'",
			    		featured = 0,
			    		status = "1",
			    		regular_price = "'.$request->price.'",
			    		discount_price = "'.$request->price.'",
			    		discount_status = "0",
			    		created_at = "'.date('Y-m-d H:i:s').'"
		        ';
	        } else {
	        	$query = 'INSERT INTO products SET
			        	name = "'.$request->product_name.'",
			    		category_id = "'.$request->category.'",
			    		store_id = "'.$result_status[0]->id.'",
			    		user_id = "'.Auth::user()->id.'",
			    		description = "'.$request->product_info.'",
			    		featured = 0,
			    		
			    		seo_image_name = "'.$seo_image_name.'",
			    		seo_title = "'.$seo_title.'",
			    		seo_keyword = "'.$seo_keyword.'",
			    		seo_description = "'.$seo_description.'",

			    		weight = "'.$request->weight.'",
			    		size = "'.$request->size.'",
			    		quantity = "'.$request->quantity.'",
			    		product_category_id = "'.$request->p_category.'",
			    		status = "1",
			    		regular_price = "'.$request->price.'",
			    		discount_price = "'.$request->price.'",
			    		discount_status = "0",
			    		created_at = "'.date('Y-m-d H:i:s').'"
		        ';
	        }
	        $result_status = DB::insert($query);
			return Redirect("/products")->with("success", "Product Added Successfully");
		} else {
			return Redirect("/home");
		}
	}
}
