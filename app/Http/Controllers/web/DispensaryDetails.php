<?php
namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
class DispensaryDetails extends Controller
{
    public function index($deliveryId) {

        $store_media = DB::select('select * from store_media WHERE store_id = "'.$deliveryId.'" ORDER BY media_name asc ');

        $store_deals = DB::select('select * from products where status = "1" AND store_id = "'.$deliveryId.'" AND deal_simple_product_status = 1 ORDER BY id DESC ');

        $products_categories = DB::select('select * from products_categories order by name ASC');
        $delivery_detail = DB::select('select * from stores where category = "2" AND id = "'.$deliveryId.'" ORDER BY id DESC ');
        if( count($delivery_detail) > 0 ) {
            $delivery_detail = $delivery_detail[0];
        }
        $current_uri = request()->segments();
        $redirect_controller_name = $current_uri[0];
        $store_products = DB::select('select products_categories.name as p_c_name , products.* from products LEFT JOIN products_categories ON products.product_category_id = products_categories.id where store_id = "'.$deliveryId.'" AND status = 1 ORDER BY id DESC ');
        $store_id = $deliveryId;
        $products_data = "";
        $logged_in_user = "";
        $logged_in_user_get = "";
        if( isset( Auth::user()->id ) && (Auth::user()->id != "") ) {
            $logged_in_user = " AND reviews.user_id != '".Auth::user()->id."' "; 
            $logged_in_user_get = " AND reviews.user_id = '".Auth::user()->id."' "; 
        }
        $products_data = DB::select('select * from reviews INNER JOIN users ON reviews.user_id = users.id '.$logged_in_user.'  AND store_id = "'.$deliveryId.'" ');

        $your_review = DB::select('select * from reviews INNER JOIN users ON reviews.user_id = users.id '.$logged_in_user_get.'  AND store_id = "'.$deliveryId.'" ');
        if( isset($your_review[0]) ) {
            $your_review = $your_review[0];
        }
        
        $sotore_folowing = "no";
        if( isset( Auth::user()->id ) && (Auth::user()->id != "") ) {
            $store_following_data = DB::select('select count(*) as following_count from followers WHERE user_id = "'.Auth::user()->id.'" AND store_id = "'.$store_id.'" ');
            if( $store_following_data[0]->following_count > 0 ) {
                $sotore_folowing = "yes";
            }
        }
        $weighted_review_rating = DB::select('select COUNT(*) as total_rating_numbers,SUM(rating) as total_rating_sum from reviews WHERE store_id = "'.$deliveryId.'" ');
        if( isset($weighted_review_rating[0]) ) {
            $weighted_review_rating = $weighted_review_rating[0];
        }

        $able_to_rate_store = false;
        $able_to_rate_store_message = "";
        if( isset(Auth::user()->id) ) {
            $user_data = DB::select('select redit_link,discord_link,created_at from users WHERE id = "'.Auth::user()->id.'" ');
            if( isset($user_data[0]) ) {
                if(isset($user_data[0]->redit_link) && $user_data[0]->redit_link != '' && $user_data[0]->redit_link != NULL ) {
                    if(isset($user_data[0]->discord_link) && $user_data[0]->discord_link != '' && $user_data[0]->discord_link != NULL ) {
                        if(isset($user_data[0]->created_at) && $user_data[0]->created_at != '' && $user_data[0]->created_at != NULL ) {
                            $now = time();
                            $your_date = strtotime($user_data[0]->created_at);
                            $datediff = $now - $your_date;
                            $days = round($datediff / (60 * 60 * 24));
                            if( $days >= 10  ) {
                                $able_to_rate_store = true;
                            } else {
                                $able_to_rate_store_message = "Your account must be active and longer than to 10 days to post review";
                            }
                        }
                    } else {
                        $able_to_rate_store_message = "Please update your <a href='".url('businessProfile')."'>profile's Discord Link</a> to upload review.";
                    }
                } else {
                    $able_to_rate_store_message = "Please update your <a href='".url('businessProfile')."'>profile's Reddit Link</a> to upload review.";
                }
            }
        }

        $product_page_menus = DB::select('select * from cms_product_pages LIMIT 1 ');
        if( isset($product_page_menus[0]) ) {
            $product_page_menus = $product_page_menus[0];
        }

        $store_amenity = array();
        if( $delivery_detail->store_amenity != '' ) {
            $store_amenity = DB::select("select * from amenities where id IN(".$delivery_detail->store_amenity.") ");
        }

        return view("web/doctorDetails", compact("delivery_detail","store_products","store_id","products_data","products_categories","sotore_folowing","your_review","redirect_controller_name","weighted_review_rating", "store_deals","store_media","able_to_rate_store_message","able_to_rate_store","product_page_menus","store_amenity"));
    }
}