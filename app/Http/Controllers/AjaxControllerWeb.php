<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
class AjaxControllerWeb extends Controller
{
    public function age_verification(Request $requestData) {
    	if( $requestData->agreed_status == 1) {
    		setcookie("age_verification", "agreed", time() + (86400 * 365), "/"); // 86400 = 1 day
    	}
    }

    public function change_claim_status(Request $requestData) {
        $claim_id = $requestData->claim_id;
        $status = $requestData->status;
        $contact_requests = DB::update('UPDATE notifications SET status = "'.$status.'" WHERE id = "'.$claim_id.'"');
    }

    public function change_user_status(Request $requestData) {
        $claim_id = $requestData->claim_id;
        $status = $requestData->status;
        $contact_requests = DB::update('UPDATE notifications SET status = "'.$status.'" WHERE id = "'.$claim_id.'"');
        $notification_requests = DB::select('select * FROM notifications WHERE id = "'.$claim_id.'" ORDER BY id');
        $notification_request = $notification_requests[0];
        $user_requests = DB::update('UPDATE users SET user_type = "business" WHERE email = "'.$notification_request->email.'"');
        $user_selects =  DB::select('select * FROM users WHERE email = "'.$notification_request->email.'"');
        $user_select = $user_selects[0];
        $store_requests = DB::update('UPDATE stores SET bussiness_user_id = "'.$user_select->id.'" WHERE id = "'.$notification_request->store_id.'"');

        DB::table('subscription_plans')->insert([
            [
                'user_id' => $user_select->id,
                'business_store_id' => $notification_request->store_id,
                'payment_method' => 'from_admin_panel',
                'processing_fee' => '0',
                'monthy_annual' => 'monthly',
                'plan_id' => '6',
                'subscription_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'subscription_start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'subscription_end_date' => Carbon::now()->addMonth()->format('Y-m-d H:i:s'),
                'status_active_deactive' => '1',
                'plane_name' => 'TIER 2',
                'price' => '0',
                'plan_options_checkboxes' =>'{"show_company_name":"Company Name","show_address":"Company Address","show_company_logo":"Company Logo","show_markers_on_maps":"Markes on Maps","premium_map_icons":"Premium Bigger Map Icon","feature_listing_x_per_day":null,"products_to_show":"3"}',
                'category_id' => '2'
               // 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               // 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }   

 //   public function

    public function productFilterationData(Request $requestData, $stor_id=NULL) {

    	$b_category = $requestData->b_category;
    	$search_p_name = $requestData->search_p_name;
    	$p_range_start1 = $requestData->p_range_start1;
    	$p_range_end = $requestData->p_range_end;
        $p_categories = $requestData->p_categories;

        $weight = $requestData->weight;
        $size = $requestData->size;
        $quantity = $requestData->quantity;
        $deal_start_date = $requestData->deal_start_date;

        $product_deal_type = $requestData->product_deal_type;
        if( $product_deal_type == "products" ) {
            $product_deal_Cond =  " AND deal_simple_product_status = 0 ";
        } else if( $product_deal_type == "deal" ) {
            $product_deal_Cond =  " AND deal_simple_product_status = 1 ";
        }

        $sort_by_prices = $requestData->sort_by_prices;

        if( isset( $sort_by_prices ) && $sort_by_prices != '' ) {
            $sort_by_prices = " ORDER BY regular_price ".$sort_by_prices." ";
        } else {
            $sort_by_prices = " ORDER BY regular_price ASC";
        }

        $deal_date = "";
        if( isset( $deal_start_date ) && $deal_start_date != '' ) {
            $deal_date = " AND start_date_time >= '".date("Y-m-d H:i:s", strtotime($deal_start_date))."' ";
        }

        if( isset( $weight ) && $weight != '' ) {
            $weight = " AND weight = '".(int)$weight."' ";
        }

        if( isset( $size ) && $size != '' ) {
            $size = " AND size = '".(int)$size."' ";
        }

        if( isset( $quantity ) && $quantity != '' ) {
            $quantity = " AND quantity = '".(int)$quantity."' ";
        }

    	if( isset( $stor_id ) && $stor_id != '' ) {
    		$stor_id = " AND store_id = '".$stor_id."' ";
    	}
    	
    	if( isset($b_category) && $b_category != '' ) {
    		$b_category = " AND category_id = '".$b_category."' ";
    	}

    	if( isset($search_p_name) && $search_p_name != '') {
    		$search_p_name = " AND (name LIKE '%".$search_p_name."%' || description LIKE '%".$search_p_name."%') ";
    	}
    	
    	if( isset($p_range_start1) && $p_range_start1 != '') {
    		$p_range_start1 = " AND regular_price >= ".$p_range_start1." ";
    	}

    	if( isset($p_range_end) && $p_range_end != '' ) {
    		$p_range_end = " AND regular_price <= ".$p_range_end." ";
    	}
        
        if( isset($p_categories) && $p_categories != '' ) {
            $p_categories = " AND product_category_id IN(".$p_categories.") ";
        }

        $store_products = DB::select("select * from products where status = 1 ".$stor_id." ".$weight." ".$size." ".$quantity." ".$b_category." ".$p_range_start1." ".$p_range_end." ".$search_p_name." ".$p_categories." ".$deal_date." ".$product_deal_Cond." ".$sort_by_prices." ");
    	$returnHTML = view('web/productsListings')->with('store_products', $store_products,'prod_deal_type', $product_deal_type)->render();
    	echo $returnHTML;
    }


    public function get_dispesary_details(Request $requestData) {
        $data = array();
        $dispensary_details = $requestData->dispensary_id;
        $store_products = DB::select("select * from stores where id = '".$dispensary_details."' ");
        $store_amenity = "";
        if( $store_products != '' ) {
            if( $store_products[0]->store_amenity ) {
                $store_amenity = DB::select("select * from amenities where id IN(".$store_products[0]->store_amenity.") ");
            }
        }
        $data['store_data'] = $store_products;
        $data['store_amenity'] = $store_amenity;
        $returnHTML = view('web/selected_dispensary_view')->with('data', $data)->render();
        $data = array();
        $data['html'] = $returnHTML;
        $data['json_store'] = $store_products;
        echo json_encode($data);
    }

    public function get_store_suggestions(Request $requestData) {
        $data = array();
        $store_name = trim($requestData->store_name);
        $search_type = trim($requestData->search_type);

        if( $search_type == "store" ) {
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

            $store_products = DB::select('select stores.*,'.$store_lat_long_query.' stores.id as st_id, (SELECt SUM(rating) as re_rating FROM reviews WHERE store_id = st_id) as re_rating, (SELECt COUNT(*) as no_of_rating FROM reviews WHERE store_id = st_id) as no_of_rating from stores where name LIKE "%'.$store_name.'%" AND status = 1 '.$store_lat_long_query_having.' ORDER BY id DESC');

            $html = "";
            if( count($store_products) > 0) {
                foreach ($store_products as $key => $store) {
                    $url = "";
                    $store_abbr_logo = "";
                    if( $store->category == 1 ) {
                        $url = url('doctorDetails').'/'.$store->id;
                        $store_abbr_logo = asset('assets/img/maps/doctor.png');
                    } else if( $store->category == 2 ) {
                        $url = url('dispensaryDetails').'/'.$store->id;
                        $store_abbr_logo = asset('assets/img/maps/dispensary_orange.png');
                    } else if( $store->category == 3 ) {
                        $url = url('deliveryDetails').'/'.$store->id;
                        $store_abbr_logo = asset('assets/img/maps/delivery.png');
                    }
                    ?>
                        <div class="row" style="margin: 0;margin-top: 5px;background: #e6ffe4;padding: 10px;margin-bottom: 5px;">
                            <div class="col-md-2">
                                <?php
                                if(isset($store->logo) && $store->logo != '') {?>
                                    <img src="<?php echo asset('assets/img/stores').'/'.$store->logo;?>"  style="width:50px;display:block;margin:0 auto;">
                                <?php
                                } else {?>
                                    <img src="<?php echo asset('assets/img/stores/default/default.png');?>" style="width: 100%;">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-8">
                                <a href="<?php echo $url;?>" class="stor_name_suggest">
                                    <h4 style="padding:0;margin:0px;"><?php echo $store->name;?></h4>
                                </a>
                                <p style="padding:0;margin:0px;font-size: 12px;">
                                    <?php echo $store->address;?>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <img src="<?php echo $store_abbr_logo;?>" style="width:35px;display:block;margin:0 auto;">
                            </div>
                        </div>
                        <hr style="margin:5px;" />
                <?php
                }
            } else {?>
                <div class="p-3 pt-2">
                    <h2 class="text-center text-danger">No results Found against the search filters.</h2>
                    <p class="text-center"> Please change the keyword to get the results.</p>
                </div>
            <?php
            }
        } else if( $search_type == "product" ) {
            $store_products = DB::select('select * from products where (name LIKE "%'.$store_name.'%" || description LIKE "%'.$store_name.'%")  ORDER BY id DESC');

            $html = "";
            if( count($store_products) > 0) {
                foreach ($store_products as $key => $store) {?>
                        <div class="row" style="margin: 0;margin-top: 5px;background: #e6ffe4;padding: 10px;margin-bottom: 5px;">
                            <div class="col-md-2">
                                <?php
                                if(isset($store->image) && $store->image != '') {?>
                                    <img src="<?php echo asset('assets/img/products').'/'.$store->image;?>"  style="width:50px;display:block;margin:0 auto;">
                                <?php
                                } else {?>
                                    <img src="<?php echo asset('assets/img/products/default/default.png');?>" style="width: 100%;">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-8">
                                <a href="<?php echo url('singleProductDetails').'/'.$store->id;?>" class="stor_name_suggest">
                                    <h4 style="padding:0;margin:0px;"><?php echo $store->name;?></h4>
                                </a>
                                <p style="padding:0;margin:0px;font-size: 12px;">
                                    <?php echo $store->description;?>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <p style="padding:0;margin:0px;font-size: 16px;">
                                    <strong>
                                        $<?php echo $store->regular_price;?>
                                    </strong>
                                </p>
                            </div>
                        </div>
                        <hr style="margin:5px;" />
                <?php
                }
            } else {?>
                <div class="p-3 pt-2">
                    <h2 class="text-center text-danger">No results Found against the search filters.</h2>
                    <p class="text-center"> Please change the keyword to get the results.</p>
                </div>
            <?php
            }
        }
    }

    public function get_dispesary_with_maps(Request $requestData) {
        $plain_search = $requestData->plain_search;
        $p_cat = $requestData->p_cat;
        $amenitites = $requestData->amenitites;
        $business_category = $requestData->business_category;
        $listing_type = $requestData->listing_type;

        $portal_radius = "";
        $portal_settings = DB::select('select * from portal_settings LIMIT 1 ');
        if( isset($portal_settings[0]) ) {
            $portal_radius = $portal_settings[0]->radius;
        }

        $distance = $requestData->distance;
        if( isset($distance) ) {
            if( $distance !=  0 ) {
                if( is_numeric($portal_radius) ) {
                    $portal_radius = $distance;
                }
            }
        }

        $store_lat_long_query = "";
        $store_lat_long_query_having = "";
        if( isset($_COOKIE['cityLat']) && isset($_COOKIE['cityLng']) ) {
            if( ($_COOKIE['cityLat'] != '') && ($_COOKIE['cityLng'] != '') ) {
                $lat = $_COOKIE['cityLat'];
                $lng = $_COOKIE['cityLng'];
                $store_lat_long_query = ", ((ACOS(SIN(".$lat." * PI() / 180)* SIN(stores.lat * PI() / 180)+ COS(".$lat." * PI() / 180)* COS(stores.lat * PI() / 180)* COS((".$lng." - stores.long) * PI() / 180))* 180 / PI()) * 60 * 1.1515) AS distance  ";
                $store_lat_long_query_having = " HAVING distance<='".$portal_radius."' ";
            }
        }

        $amenitites_cond = "";
        if( isset($amenitites) ) {
            
            if( $amenitites != '' ) {
                if( count($amenitites) > 0 ) {
                    if( trim($amenitites[0]) != "" ) {
                        $amenitites_cond = " AND ( ";
                        $daataa = "";
                        foreach ($amenitites as $key => $value) {
                            if( $key > 0 ) {
                                $daataa .= " OR FIND_IN_SET(".$value.",stores.store_amenity)";
                            } else {
                                $daataa .= " FIND_IN_SET(".$value.",stores.store_amenity)";
                            }
                        }
                        $amenitites_cond .= $daataa." )";
                    }
                }
            }
        }

        if( isset($plain_search) ) {
            if( $plain_search != '' ) {
                $plain_search = " AND stores.name LIKE '%".$plain_search."%' ";
            }
        }

        if( isset($business_category) ) {
            if( $business_category != '' && $business_category != 'all' ) {
                $business_category = " AND stores.category = '".$business_category."' ";
            } else {
                $business_category = "";
            }
        }
        if( isset($p_cat) ) {
            if( $p_cat != '' ) {
                $all_stores = DB::select('SELECT stores.* '.$store_lat_long_query.' FROM stores WHERE category = "'.$p_cat.'" AND subscription_active = 1 AND stores.status = "1" '.$amenitites_cond.' '.$business_category.' '.$plain_search.' '.$store_lat_long_query_having.' ORDER BY stores.id DESC ');
            }
        } else {
            $all_stores = DB::select('select stores.* '.$store_lat_long_query.' from stores where status = "1"  AND subscription_active = 1 '.$amenitites_cond.' '.$business_category.' '.$plain_search.' '.$store_lat_long_query_having.' ORDER BY id DESC ');
        }

        $all_categories = DB::select('select * from categories ORDER BY id DESC ');
        $all_p_categories = DB::select('select * from products_categories ORDER BY name DESC ');
        $all_amenities = DB::select('select * from amenities ORDER BY name DESC ');
        
        if( $listing_type == "grid_view" ) {
            $returnHTML = view('web/dispensaries_grid_only')->with('all_stores', $all_stores,'all_p_categories', $all_p_categories,'all_amenities', $all_amenities,'all_categories', $all_categories,)->render();
            $data = array();
            $data['html'] = $returnHTML;
            echo json_encode($data);

        } else {
            $returnHTML = view('web/dispensaries_maps_only')->with('all_stores', $all_stores,'all_p_categories', $all_p_categories,'all_amenities', $all_amenities,'all_categories', $all_categories,)->render();
            $data = array();
            $data['html'] = $returnHTML;
            echo json_encode($data);
        }
    }

    public function get_dispesary_with_grid(Request $requestData) {
        $plain_search = $requestData->plain_search;
        $p_cat = $requestData->p_cat;
        $amenitites = $requestData->amenitites;
        $business_category = $requestData->business_category;


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
                $store_lat_long_query = ", ((ACOS(SIN(".$lat." * PI() / 180)* SIN(stores.lat * PI() / 180)+ COS(".$lat." * PI() / 180)* COS(stores.lat * PI() / 180)* COS((".$lng." - stores.long) * PI() / 180))* 180 / PI()) * 60 * 1.1515) AS distance  ";
                $store_lat_long_query_having = " HAVING distance<='".$portal_radius."' ";
            }
        }

        if( isset($amenitites) ) {
            if( $amenitites != '' ) {
                $amenitites = " AND FIND_IN_SET(".$amenitites.",stores.store_amenity) ";
            }
        }

        if( isset($plain_search) ) {
            if( $plain_search != '' ) {
                $plain_search = " AND stores.name LIKE '%".$plain_search."%' ";
            }
        }

        if( isset($business_category) ) {
            if( $business_category != '' ) {
                $business_category = " AND stores.category = '".$business_category."' ";
            }
        }

        if( isset($p_cat) ) {
            if( $p_cat != '' ) {
                $all_stores = DB::select('SELECT stores.* '.$store_lat_long_query.' FROM stores WHERE category = "'.$p_cat.'" AND subscription_active = 1 AND stores.status = "1" '.$amenitites.' '.$business_category.' '.$plain_search.' '.$store_lat_long_query_having.' ORDER BY stores.id DESC ');
            }
        } else {
            $all_stores = DB::select('select stores.* '.$store_lat_long_query.' from stores where status = "1"  AND subscription_active = 1 '.$amenitites.' '.$business_category.' '.$plain_search.' '.$store_lat_long_query_having.' ORDER BY id DESC ');
        }

        $all_categories = DB::select('select * from categories ORDER BY id DESC ');
        $all_p_categories = DB::select('select * from products_categories ORDER BY name DESC ');
        $all_amenities = DB::select('select * from amenities ORDER BY name DESC ');
        $returnHTML = view('web/dispensaries_grid_only')->with('all_stores', $all_stores,'all_p_categories', $all_p_categories,'all_amenities', $all_amenities,'all_categories', $all_categories,)->render();
        $data = array();
        $data['html'] = $returnHTML;
        echo json_encode($data);
    }

    public function mark_featured_un_featured_product(Request $requestData) {
        $response = array();
        $store_id = $requestData->store_id;
        $p_id = $requestData->p_id;
        $p_status = $requestData->p_status;
        if( $p_status == 0 ) {
            $p_status = 1;
        } else if( $p_status == 1 ) {
            $p_status = 0;
        }
        if( $store_id ) {
            $total_featured = "";
            if( $p_status == 1 ) {
                $total_featured = DB::select('select COUNT(*) as total_featured from products WHERE store_id = "'.$store_id.'" AND featured = 1 ');
                if( isset($total_featured[0]->total_featured) && $total_featured[0]->total_featured > 1 ) {
                    $response['status'] = 400;
                } else {
                    if( $p_id != '' ) {
                        DB::update('UPDATE products SET featured = "'.$p_status.'" WHERE id = "'.$p_id.'" ');
                        $response['status'] = 200;
                    }    
                }
            } else if( $p_status == 0 ) {
                if( $p_id != '' ) {
                    DB::update('UPDATE products SET featured = "'.$p_status.'" WHERE id = "'.$p_id.'" ');
                    $response['status'] = 300;
                }
            }
        }
        echo json_encode($response);
    }
    public function follow_store_web($store_id) {
        $response = array();
        if( isset($store_id) && $store_id != "" ) {
            if( isset(Auth::user()->id) && Auth::user()->id != '' ) {
                $data = DB::select('SELECT * FROM followers WHERE user_id = "'.Auth::user()->id.'" AND store_id = "'.$store_id.'" ');
                if( isset($data[0]->id) ) {
                    DB::delete('DELETE FROM followers
                        WHERE
                            user_id = "'.Auth::user()->id.'"
                        AND
                            store_id = "'.$store_id.'"
                    ');
                    $response['status'] = "deleted";
                } else {
                    DB::insert('INSERT INTO followers SET
                        user_id = "'.Auth::user()->id.'",
                        store_id = "'.$store_id.'"
                    ');
                    $response['status'] = "inserted";
                }
            }
        }
        echo json_encode($response);
    }

    public function mark_fav_unfav(Request $requestData) {
        $id = $requestData->id;
        $type = $requestData->type;
        $store_id = $requestData->store_id;

        $response = array();
        if( isset($id) && $id != "" ) {
            if( Auth::check() && Auth::user()->id != '' ) {
                $data = DB::select('SELECT * FROM favourites WHERE user_id = "'.Auth::user()->id.'" AND prod_deal_id = "'.$id.'" ');
                if( isset($data[0]->id) ) {
                    DB::delete('DELETE FROM favourites
                        WHERE
                            user_id = "'.Auth::user()->id.'"
                        AND
                            prod_deal_id = "'.$id.'"
                    ');
                    $response['status'] = "deleted";
                } else {
                    DB::insert('INSERT INTO favourites SET
                        user_id = "'.Auth::user()->id.'",
                        prod_deal_id = "'.$id.'",
                        store_id = "'.$store_id.'"
                    ');
                    $response['status'] = "inserted";
                }
            }
        }
        echo json_encode($response);
    }
}
