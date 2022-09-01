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
class ProductsController extends Controller
{
    public function index() {
        $products_data = DB::select(' select * from products_categories ');
        return view("web/allProducts", compact("products_data"));
    }
    public function allCategoryProducts($category_id) {
    	if( $category_id != '' ) {
    		$products_data = DB::select('select
    				categories.name as c_name,stores.name as st_name, products_categories.name as p_c_name, stores.name as st_name, products.* from products
    				LEFT JOIN categories ON categories.id = products.category_id
    				LEFT JOIN stores ON stores.id = products.store_id
    				LEFT JOIN products_categories ON products_categories.id = "'.$category_id.'"
    				where products.product_category_id = "'.$category_id.'" ');
        	return view("web/allCategoryProducts", compact("products_data"));
    	}
    }

    public function featuredProducts() {
        $products_data = DB::select('select * from products where products.featured = 1 AND status = 1 ');
        return view("web/featuredProducts", compact("products_data"));
    }
    public function featuredDeals() {
        $products_data = DB::select('select * from products where products.featured = 1 AND status = 1 AND deal_simple_product_status = 1 ');
        return view("web/featuredDeals", compact("products_data"));
    }

    public function searchProducts($search_name=NULL) {
        if( $search_name != '' ) {
            $products_data = DB::select('select * from products where (name LIKE "%'.$search_name.'%" || description LIKE "%'.$search_name.'%")  ORDER BY id DESC');
            return view("web/allProductsSearched", compact("products_data"));
        }
    }
}
