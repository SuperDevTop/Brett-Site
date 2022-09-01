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
class PaymentMethodSettingsController extends Controller
{
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    public function View() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_data = $this->GetAdminData();
        return view("admin/profile/view",compact("customer_data","usersData"));
    }
    public function GetAdminData() {
    	$admin_data = DB::select('select * from users where user_type = "administrator" LIMIT 1 ');
    	$customer_data = User::find($admin_data[0]->id);
    	return $customer_data;
    }

    public function Edit() {
    	$usersData = $this->GetLoggedInUserData();
	    $customer_data = $this->GetAdminData();
	    $setting_data = DB::select('select * from payment_method_settings');
        return view("admin/paymentSettings/edit",compact("setting_data","customer_data","usersData"));
    }	

    public function EditProcess( Request $request, $customer_id) {

    	$method_name = $request->method_name;
		$method_key = $request->method_key;
		$method_secret = $request->method_secret;
		$method_redirect_url = $request->method_redirect_url;
		$status = $request->status;
		$fee_measurement = $request->fee_measurement;
		$processing_fee = $request->processing_fee;

		$query = "UPDATE payment_method_settings SET
    		method_name = '".$method_name."',
	    	method_key = '".$method_key."',
	    	method_secret = '".$method_secret."',
	    	method_redirect_url = '".$method_redirect_url."',
	    	status = '".$status."',
	    	fee_measurement = '".$fee_measurement."',
	    	processing_fee = '".$processing_fee."'
	    	WHERE id = '".$customer_id."'
    	";
        $admin_data = DB::update($query);
		return Redirect("/admin/paymentSettings")->with("success", "Payment Settings Updated Successfully!");
    }
}
