<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class Home extends Controller
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
        $store_locations = DB::select('select * from stores where status = 1 AND subscription_active = 1 AND store_location_name != ""  GROUP BY store_location_name');

    	$delivery_category = DB::select('select stores.*, '.$store_lat_long_query.'  stores.id as st_id, (SELECt SUM(rating) as re_rating FROM reviews WHERE store_id = st_id) as re_rating, (SELECt COUNT(*) as no_of_rating FROM reviews WHERE store_id = st_id) as no_of_rating from stores where category = "3" AND subscription_active = 1 '.$store_lat_long_query_having.' ORDER BY id DESC LIMIT 5 ');
    	$dispensary_category = DB::select('select stores.*,'.$store_lat_long_query.' stores.id as st_id, (SELECt SUM(rating) as re_rating FROM reviews WHERE store_id = st_id) as re_rating, (SELECt COUNT(*) as no_of_rating FROM reviews WHERE store_id = st_id) as no_of_rating from stores where category = "2" AND subscription_active = 1 '.$store_lat_long_query_having.' ORDER BY id DESC LIMIT 5 ');
    	$doctor_category = DB::select('select stores.*,'.$store_lat_long_query.' stores.id as st_id, (SELECt SUM(rating) as re_rating FROM reviews WHERE store_id = st_id) as re_rating, (SELECt COUNT(*) as no_of_rating FROM reviews WHERE store_id = st_id) as no_of_rating from stores where category = "1"  AND subscription_active = 1 '.$store_lat_long_query_having.' ORDER BY id DESC LIMIT 5 ');
    	return view("web/home", compact("delivery_category","dispensary_category","doctor_category","store_locations"));
    }
    public function indexv2() {
    
        $all_categories = DB::select('select * from categories ORDER BY id DESC ');
        $all_p_categories = DB::select('select * from products_categories ORDER BY name DESC ');
        $all_amenities = DB::select('select * from amenities ORDER BY name DESC ');

        $doctors_plan = DB::select('select * from plans WHERE status = 1 AND category_id = 1 ');
        $dispensary_plan = DB::select('select * from plans WHERE status = 1 AND category_id = 2 ');
        $delivery_plan = DB::select('select * from plans WHERE status = 1 AND category_id = 3 ');
        


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
        $all_stores = DB::select('select stores.*,'.$store_lat_long_query.' stores.id as st_id from stores where status = "1" AND subscription_active = 1 '.$store_lat_long_query_having.' ORDER BY id DESC ');
        $featured_products = DB::select('select * from products WHERE featured = 1 AND status = 1 ORDER BY RAND() DESC LIMIT 5 ');



        $portal_radius = "";
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        if( isset($portal_settings[0]) ) {
            $portal_radius = $portal_settings[0]->radius;
        }

        $store_locations = DB::select('select * from stores where status = 1 AND subscription_active = 1 AND store_location_name != ""  GROUP BY store_location_name');

        $banner_lat_long_query = "";
        $banner_lat_long_query_having = "";
        if( isset($_COOKIE['cityLat']) && isset($_COOKIE['cityLng']) ) {
            if( ($_COOKIE['cityLat'] != '') && ($_COOKIE['cityLng'] != '') ) {
                $lat = $_COOKIE['cityLat'];
                $lng = $_COOKIE['cityLng'];
                $banner_lat_long_query = " ((ACOS(SIN(".$lat." * PI() / 180)* SIN(location_banners.lat * PI() / 180)+ COS(".$lat." * PI() / 180)* COS(location_banners.lat * PI() / 180)* COS((".$lng." - location_banners.lon) * PI() / 180))* 180 / PI()) * 60 * 1.1515) AS distance,  ";
                $banner_lat_long_query_having = " HAVING distance<='".$portal_radius."' ";
            }
        }
        
        $home_location_banner = DB::select('select location_banners.*,'.$banner_lat_long_query.' location_banners.id as st_id from location_banners '.$banner_lat_long_query_having.' ORDER BY rand() DESC LIMIT 1 ');
        if( isset($home_location_banner[0]) ) {
            $home_location_banner = $home_location_banner[0];
        }


        $landing_page_about_us = DB::select('select * from cms_landing_pages WHERE id = 1');
        if( isset($landing_page_about_us[0]) ) {
            $landing_page_about_us = $landing_page_about_us[0];
        }
        $landing_page_plan_description = DB::select('select * from cms_landing_pages WHERE id = 2');
        if( isset($landing_page_plan_description[0]) ) {
            $landing_page_plan_description = $landing_page_plan_description[0];
        }

        $plan_cat_details = DB::select('select * from plan_category_details LIMIT 1 ');
        if( isset($plan_cat_details) && count($plan_cat_details) > 0 ) {
            $plan_cat_details = $plan_cat_details[0];
        }

        return view("web/homev2", compact('all_p_categories', 'all_amenities', 'all_categories',"doctors_plan","dispensary_plan","delivery_plan","plan_cat_details","all_stores","featured_products","home_location_banner","landing_page_about_us","store_locations","landing_page_plan_description"));
    }
    public function contactUs() {
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        return view("web/contactUs", compact("portal_settings") );
    }
    public static function portalSettings() {
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        return $portal_settings;
    }


    public static function footerCmsData() {
        $footer_all_data = array();
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
        return $footer_all_data;
    }

    public static function seoMetaTags($store_id) {
        $delivery_detail = DB::select('select * from stores where id = "'.$store_id.'"  LIMIT 1');
        if( count($delivery_detail) > 0 ) {
            $delivery_detail = $delivery_detail[0];
        }
        return $delivery_detail;
    }

    public static function seoMetaTagsProducts($product_id) {
        $delivery_detail = DB::select('select * from products where id = "'.$product_id.'"  LIMIT 1');
        if( count($delivery_detail) > 0 ) {
            $delivery_detail = $delivery_detail[0];
        }
        return $delivery_detail;
    }
}