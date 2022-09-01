<?php
namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
class DispensaryController extends Controller
{
    public function index() {
        $portal_radius = "";
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        if( isset($portal_settings[0]) ) {
            $portal_radius = $portal_settings[0]->radius;
        }

        $store_lat_long_query = "";
        $store_lat_long_query_having = "";
        if( isset($_COOKIE['cityLat']) && isset($_COOKIE['cityLng']) ) {
            if( ($_COOKIE['cityLat'] != '') && ($_COOKIE['cityLng'] != '') ) {
                $lat = $_COOKIE['cityLat'];
                $lng = $_COOKIE['cityLng'];
                $store_lat_long_query = " ((ACOS(SIN(".$lat." * PI() / 180)* SIN(stores.lat * PI() / 180)+ COS(".$lat." * PI() / 180)* COS(stores.lat * PI() / 180)* COS((".$lng." - stores.long) * PI() / 180))* 180 / PI()) * 60 * 1.1515) AS distance,  ";
                $store_lat_long_query_having = " HAVING distance<='".$portal_radius."' ";
            }
        }
        $delivery_category = DB::select('select stores.*,'.$store_lat_long_query.' stores.id as st_id, (SELECt SUM(rating) as re_rating FROM reviews WHERE store_id = st_id) as re_rating, (SELECt COUNT(*) as no_of_rating FROM reviews WHERE store_id = st_id) as no_of_rating from stores where category = "2" '.$store_lat_long_query_having.' ORDER BY id DESC');
        return view("web/dispensaries_main", compact("delivery_category"));
    }
    public function search_filters($listing_type=NULL) {
        $grid_view = "";
        if( isset($listing_type) ) {
            if( $listing_type != '' ) {
                if( $listing_type == "list" ) {
                    $grid_view = "grid_view";
                } else {
                    $grid_view = $listing_type;
                }
            }
        }

    	$portal_radius = "";
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        if( isset($portal_settings[0]) ) {
            $portal_radius = $portal_settings[0]->radius;
        }
        
        $banner_lat_long_query = "";
        $banner_lat_long_query_having = "";
        if( isset($_COOKIE['cityLat']) && isset($_COOKIE['cityLng']) ) {
            if( ($_COOKIE['cityLat'] != '') && ($_COOKIE['cityLng'] != '') ) {
                $lat = $_COOKIE['cityLat'];
                $lng = $_COOKIE['cityLng'];
                $banner_lat_long_query = " ((ACOS(SIN(".$lat." * PI() / 180)* SIN(advertisement_banners.lat * PI() / 180)+ COS(".$lat." * PI() / 180)* COS(advertisement_banners.lat * PI() / 180)* COS((".$lng." - advertisement_banners.lon) * PI() / 180))* 180 / PI()) * 60 * 1.1515) AS distance,  ";
                $banner_lat_long_query_having = " HAVING distance<='".$portal_radius."' ";
            }
        }
        
        $banners_data = DB::select('select advertisement_banners.*,'.$banner_lat_long_query.' advertisement_banners.id as st_id from advertisement_banners WHERE advertisement_banners.location = "map_page" AND lat != "" AND lon != "" '.$banner_lat_long_query_having.' ORDER BY rand() DESC ');
        
    	$all_stores = DB::select('select * from stores where status = "1" AND subscription_active = 1 ORDER BY id DESC ');
    	$all_categories = DB::select('select * from categories ORDER BY id DESC ');
    	$all_p_categories = DB::select('select * from products_categories ORDER BY name DESC ');
    	$all_amenities = DB::select('select * from amenities ORDER BY name DESC ');
        


    	return view("web/dispensaries", compact('all_stores','all_p_categories', 'all_amenities', 'all_categories',"banners_data","grid_view","portal_radius"));
    }
}