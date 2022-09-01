<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
class AdminEmployeeController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = DB::select('select * from users where users.user_type = "administrator" ');
    	return view("admin/administrators/index",compact("customer_all","usersData"));
    }
    public function Add() {	
    	$usersData = $this->GetLoggedInUserData();
    	return view("admin/administrators/add", compact('usersData'));
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
    	$status = $request->status;
    	$password = $request->password;
        $dob = $request->dob;
        $zipcode = $request->zipcode;
        
    	$status = User::insert([
			'first_name' => $f_name,
			'last_name' => $l_name,
            'dob' => $dob,
            'zip_code' => $zipcode,
			'email' => $email,
			'category' => 0,
			'user_type' => "administrator",
			'status' => $status,
			'password' => Hash::make($password),
			'created_at' => Carbon::now()
		]);

        $id = DB::getPdo()->lastInsertId();
        return Redirect()->route('admin_employee_listing')->with("success", "Admin/Employee User Added Successfully");
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
        if( isset($request->password) && $request->password !='' ) {
        	$update_array = array(
	    		"first_name" => $request->f_name,
		    	"last_name" => $request->l_name,
		    	"email" => $request->email,
	            'dob' => $dob,
	            'category' => 0,
	            'zip_code' => $zipcode,
	            "status" => $request->status,
		    	'password' => Hash::make($request->password)
	    	);
        } else {
        	$update_array = array(
    		"first_name" => $request->f_name,
	    	"last_name" => $request->l_name,
	    	"email" => $request->email,
            'dob' => $dob,
            'category' => 0,
            'zip_code' => $zipcode,
	    	"status" => $request->status
    	);
        }
    	
    	$result_status = User::find($customer_id)->update($update_array);
		return Redirect()->route('admin_employee_listing')->with("success", "Admin/Employee User Updated Successfully");
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
	        return view("admin/administrators/view",compact("customer_data","usersData"));
    	}
    }

    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = User::find($customerId);
	        return view("admin/administrators/edit",compact("customer_data","usersData"));
    	}
    }
}
