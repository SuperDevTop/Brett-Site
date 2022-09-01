<?php
namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
class Doctors extends Controller
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
    	
    	$delivery_category = DB::select('select stores.*,'.$store_lat_long_query.' stores.id as st_id, (SELECt SUM(rating) as re_rating FROM reviews WHERE store_id = st_id) as re_rating, (SELECt COUNT(*) as no_of_rating FROM reviews WHERE store_id = st_id) as no_of_rating from stores where category = "1" '.$store_lat_long_query_having.' ORDER BY id DESC');
    	return view("web/doctors", compact("delivery_category"));
    }
}