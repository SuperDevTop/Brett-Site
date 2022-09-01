<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPlans;
use App\Models\ReferralRelationship;

class BuyPlans extends Controller
{
    public function index($plan_id) {
        if( Auth::user() ) {
            $plans_data = DB::select(' select * from subscription_plans WHERE user_id = "'.Auth::user()->id.'" and status_active_deactive = 1 ');
            if( isset($plans_data) && count($plans_data) > 0 ) {
                return view( "web/alreadyPurchasePlan", compact("plans_data") );
            } else {
                $payment_methods = DB::select('select * from payment_method_settings WHERE status = 1 ');
                $plans_data = DB::select('select * from plans WHERE id = "'.$plan_id.'" AND status = 1 ');
                return view("web/purchasePlan", compact("plans_data","payment_methods"));
            }
        } else {
            return Redirect("login");
        } 
    }
    public function buyPlanProcess(Request $request) {
        $id = Auth::user()->id;
        $referrals = DB::select(' select * from referral_relationships WHERE referral_link_id = "'.Auth::user()->id.'" ');
        $business_store_id = $request->session()->get("business_store_id");
        if( $business_store_id != "" ) {
            $plan_id = @$request->plan_id;
            if( isset($plan_id) && $plan_id != '' ) {
                $selected_plan_details = DB::select('select * from plans WHERE id = "'.$plan_id.'" ');
                if( isset($selected_plan_details) && count($selected_plan_details) > 0 ) {
                    $selected_plan_details = $selected_plan_details[0];
                }
                $time = strtotime(date("Y-m-d H:i:s"));
                $final = date("Y-m-d H:i:s", strtotime("+1 month", $time));

                $final_amount_to_charge = $request->grand_total_amount;
                $payment_confirmed = 0;

                if( $final_amount_to_charge > 0 ) {
                    Stripe\Stripe::setApiKey($request->method_secret);
                    $charg_confirm = Stripe\Charge::create ([
                            "amount" => 100 * $request->grand_total_amount*(10-count($referrals))/10,
                            "currency" => "USD",
                            "source" => $request->stripeToken,
                            "description" => "Bud & Carriage Subscription Payment." 
                    ]);
                    if( isset( $charg_confirm->id ) ) {
                        if( $charg_confirm->id != "" ) {
                            if( isset( $charg_confirm->captured ) ) {
                                if( $charg_confirm->captured == 1 ) {
                                    $payment_confirmed = 1;
                                    $request->processing_fee = $request->processing_fee;
                                } else {
                                    Session::flash('error', 'Sorry Payment was Declined.');
                                    return back();
                                }
                            } else {
                                Session::flash('error', 'Sorry Payment was Declined.');
                                return back();
                            }
                        } else {
                            Session::flash('error', 'Sorry Payment was Declined.');
                            return back();
                        }
                    } else {
                        Session::flash('error', 'Sorry Payment was Declined.');
                        return back();
                    }
                } else if( $final_amount_to_charge == 0 ) {
                    $payment_confirmed = 1;
                    $request->processing_fee = 0;
                }

                if( $payment_confirmed == 1 ) {
                    
                    $update_array = array(
                        "user_id" => Auth::user()->id,
                        "business_store_id" => $business_store_id,
                        "payment_method" => $request->payment_method,
                        "monthy_annual" => "monthly",
                        "processing_fee" => $request->processing_fee,
                        "plan_id" => $plan_id,
                        "subscription_date" => date("Y-m-d H:i:s"),
                        "subscription_start_date" => date("Y-m-d H:i:s"),
                        "subscription_end_date" => $final,
                        "status_active_deactive" => 1,
                        "plane_name" => $selected_plan_details->plane_name,
                        "price" => $selected_plan_details->price,
                        "image" => $selected_plan_details->image,
                        "description" => $selected_plan_details->description,
                        "plan_options_checkboxes" => $selected_plan_details->plan_options_checkboxes,
                        "category_id" => $selected_plan_details->category_id
                    );

                    $result_status = SubscriptionPlans::insert($update_array);
                    $last_inserted_id = DB::getPdo()->lastInsertId();
                    if( isset($last_inserted_id) && ($last_inserted_id != "") ) {
                        $data = $selected_plan_details->plan_options_checkboxes;
                        if( isset($data) && $data != "" ) {
                            $plans_data = DB::update(' update stores SET
                                                            company_name_status = 0,
                                                            show_address_status = 0,
                                                            company_logo_status = 0,
                                                            business_descripotion_status = 0,
                                                            marker_status = 0,
                                                            premium_marker_status = 0,
                                                            link_to_website_status = 0,
                                                            link_to_social_media_status = 0,
                                                            store_hours_status = 0,
                                                            reviews_on_listing_status = 0,
                                                            create_view_deals_status = 0,
                                                            phone_number_status = 0,
                                                            import_photos_status = 0,
                                                            import_videos_status = 0,
                                                            delivery_Service_description_status = 0,
                                                            about_us_information_status = 0,
                                                            subscription_active = 1
                                                        WHERE
                                                            bussiness_user_id = "'.Auth::user()->id.'"
                                                    ');

                            foreach (json_decode($data) as $key => $each_plan_option) {
                                if( isset(Auth::user()->id) ) {
                                    if( $key == "company_name" ) {
                                        DB::update(' update stores SET company_name_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "show_address" ) {
                                        DB::update(' update stores SET show_address_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "show_company_logo" ) {
                                        DB::update(' update stores SET company_logo_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "show_business_description" ) {
                                        DB::update(' update stores SET business_descripotion_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "show_markers_on_maps" ) {
                                        DB::update(' update stores SET marker_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "premium_map_icons" ) {
                                        DB::update(' update stores SET premium_marker_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "link_to_website_listing_page" ) {
                                        DB::update(' update stores SET link_to_website_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "link_with_social_media" ) {
                                        DB::update(' update stores SET link_to_social_media_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "show_store_hours" ) {
                                        DB::update(' update stores SET store_hours_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "show_review_on_listing_page" ) {
                                        DB::update(' update stores SET reviews_on_listing_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "offer_discounts_deals" ) {
                                        DB::update(' update stores SET create_view_deals_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "show_phone_number" ) {
                                        DB::update(' update stores SET phone_number_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "import_photos" ) {
                                        DB::update(' update stores SET import_photos_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "import_videos" ) {
                                        DB::update(' update stores SET import_videos_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "delivery_service_description" ) {
                                        DB::update(' update stores SET delivery_Service_description_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    } else if( $key == "about_us_information" ) {
                                        DB::update(' update stores SET about_us_information_status = 1 WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    }
                                    DB::update(' update stores SET category = "'.$selected_plan_details->category_id.'" WHERE bussiness_user_id = "'.Auth::user()->id.'" ');
                                    DB::update(' update products SET status = 0 WHERE store_id = "'.$business_store_id.'" ');

                                   DB::update('update users SET selected_plan = 1 WHERE id = "'.Auth::user()->id.'" ');

                                }
                            }
                            $request->session()->put('plan_data', $data);
                        }

                        Session::flush();
                        Auth::logout();
                        return Redirect("/subscription/thankyou")->with("success", "You have Successfully Subscribe the Plan! ");
                    } else {
                        return Redirect("/subscription/error")->with("error", "You Could not made transaction ");
                    }
                }

            }
        }
    }
    public function thankyou() {
        return view("web/purchaseSuccess");
    }
    public function error() {   
    }
    public function subscription_cancel_process(Request $request) {
        $plan_id = $request->plan_id;
        if( isset($plan_id) && ($plan_id != '') ) {
            $plans_data = DB::update(' update subscription_plans SET status_active_deactive = 0 WHERE user_id = "'.Auth::user()->id.'" and status_active_deactive = 1 ');
            $plans_data = DB::update(' update stores SET subscription_active = 0 WHERE bussiness_user_id = "'.Auth::user()->id.'"');
            if( $plans_data ) {
                echo "success";
            }   
        }
    }
    public function subscription_canceled() {
        return view("web/subscriptionCanceled");
    }
}