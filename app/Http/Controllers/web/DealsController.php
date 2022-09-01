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
class DealsController extends Controller
{
    public function index() {
        $products_data = DB::select('select * from products where products.deal_simple_product_status = 1 ');
        $favourite_deals_id = array();
        if( isset(Auth::user()->id) ) {
            $favourite_deals = DB::select('select prod_deal_id from favourites where user_id = "'.Auth::user()->id.'" ');
            if( isset($favourite_deals) ) {
                if( count($favourite_deals) > 0 ) {
                    foreach ($favourite_deals as $key => $value) {
                        array_push($favourite_deals_id, $value->prod_deal_id);
                    }
                }
            }
        }
        
        $store_products = DB::select('select * from products WHERE deal_simple_product_status = 1 AND featured = 1 AND status = 1 ORDER BY regular_price ASC ');
        return view("web/allProductsDeals", compact("products_data","favourite_deals_id","store_products"));
    }

    public function favourites(Request $request) {

        $business_data = DB::select('select * from stores where bussiness_user_id = "'.Auth::user()->id.'" LIMIT 1 ');
            if( isset($business_data[0]) ) {
                $business_data = $business_data[0];
            }

        $check_is_active_subscription = 0;
        $business_store_id = $request->session()->get("business_store_id");
        if( $business_store_id != "" ) {
            $query = DB::select('select count(*) as active_plan from subscription_plans where user_id = "'.Auth::user()->id.'"  AND business_store_id = "'.$business_store_id.'" AND status_active_deactive = 1 ORDER BY id DESC LIMIT 1 ');
            if( $query[0]->active_plan == 1 ) {
                $check_is_active_subscription = 1;
            }
        }

        $favourite_prod_deals = DB::select('select * from favourites INNER JOIN stores ON favourites.store_id = stores.id  INNER JOIN products ON favourites.prod_deal_id = products.id AND favourites.user_id = "'.Auth::user()->id.'" ');

        return view("web/favouriteProductsDeals", compact("favourite_prod_deals", "business_data","check_is_active_subscription"));
    }

}
