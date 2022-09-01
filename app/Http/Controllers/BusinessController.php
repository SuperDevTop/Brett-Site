<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
class BusinessController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = DB::select('select users.*, categories.name as c_name  from users LEFT JOIN categories ON users.category = categories.id where users.user_type = "business" ');
    	return view("admin/business/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	return view("admin/business/add", compact('usersData'));
    }
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    
    public function AddProcess( Request $request) {
    	$validated = $request->validate(
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'status' => 'required',
			],
			[
				'f_name.required' => 'First Name is Required!',
                'l_name.required' => 'Last Name is Required!',
                'email.required' => 'Email is Required!',
                'email.unique' => 'Email is already Exists!',
                'password.required' => 'Password is Required!',
                'status.required' => 'Status is Required!',
			],
		);

    	$f_name = $request->f_name;
    	$l_name = $request->l_name;
    	$email = $request->email;
    	$lat = $request->lat;
    	$long = $request->long;
    	$status = $request->status;
    	$password = $request->password;


        
        $dob = $request->dob;
        $zipcode = $request->zipcode;
        $red_link = $request->red_link;
        $discord_link = $request->discord_link;

    	$status = User::insert([
			'first_name' => $f_name,
			'last_name' => $l_name,

            'dob' => $dob,
            'zip_code' => $zipcode,
            'redit_link' => $red_link,
            'discord_link' => $discord_link,
            


			'email' => $email,
			'lat' => $lat,
			'long' => $long,
			'user_type' => "business",
			'status' => $status,
			'password' => Hash::make($password),
			'created_at' => Carbon::now()
		]);

        $id = DB::getPdo()->lastInsertId();
        $query = 'INSERT INTO stores SET
            bussiness_user_id = "'.$id.'",
            category = 0,
            status = "1"
        ';
        $result_status = DB::insert($query);
		return Redirect()->route('business_listing')->with("success", "BUsiness User Added Successfully");
    }

    public function EditProcess( Request $request, $customer_id) {
    	$validated = $request->validate(
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required|unique:users,email,'.$customer_id,
                'password' => 'required',
                'status' => 'required',
			],
			[
				'f_name.required' => 'First Name is Required!',
                'l_name.required' => 'Last Name is Required!',
                'email.required' => 'Email is Required!',
                'email.unique' => 'Email is already Exists!',
                'password.required' => 'Password is Required!',
                'status.required' => 'Status is Required!',
			],
		);
        
        $dob = $request->dob;
        $zipcode = $request->zipcode;
        $red_link = $request->red_link;
        $discord_link = $request->discord_link;

    	$update_array = array(
    		"first_name" => $request->f_name,
	    	"last_name" => $request->l_name,
	    	"email" => $request->email,
            'dob' => $dob,
            
            'zip_code' => $zipcode,
            'redit_link' => $red_link,
            'discord_link' => $discord_link,
	    	"status" => $request->status,
	    	"lat" => $request->lat,
	    	"long" => $request->long,
	    	'password' => Hash::make($request->password)
    	);
    	$result_status = User::find($customer_id)->update($update_array);
		return Redirect()->route('business_listing')->with("success", "Business User Updated Successfully");
    }

    public function DeleteProcess($customerId) {
    	if( isset($customerId) && $customerId != "" ) {
	        User::find($customerId)->delete();
	        return Redirect()->back()->with("success", "Business User Deleted Successfully");
    	}
    }

    public function View($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = User::find($customerId);
	        return view("admin/business/view",compact("customer_data","usersData"));
    	}
    }

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = User::find($customerId);
	        return view("admin/business/edit",compact("customer_data","usersData"));
    	}
    }
}
