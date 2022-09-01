<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
class LoginAuth extends Controller
{
  	public function index() {
  		return view("admin/login/index");
  	}
    public function LoginProcess(Request $formData) {

    	$validated = $formData->validate(
              [
                  'email' => 'required|email',
                  'password' => 'required',
  			],
  			[
  				'email.required' => 'Email is Required!',
  				'email.email' => 'Email is not correct!',
                  'password.required' => 'Password is Required!',
  			],
  		);

         $credentials = array(
            "email" => $formData->email,
            "password" => $formData->password,
            "user_type" => 'administrator',
        );

        // $credentials = $formData->only('email', 'password');
        if (Auth::attempt($credentials)) {
        	return redirect()->intended('admin/dashboard')->withSuccess('Signed in');
        } else {
        	return redirect("admin")->with('errormessage','Wong Credentials!');
        }
    }

   //  public function RegisterProcess() {
   //  	$RegisterData = array(
   //  		"first_name" => "Nafees",
			// "last_name" => "Khan",
			// "email" => "business3@gmail.com",
			// "lat" => "31.570633686306582",
			// "long" => "74.38119196931275",
			// "status" => "1",
			// "user_type" => "business",
			// "password" => Hash::make("business3"),
   //  	);
   //  	User::create($RegisterData);
   //  }


    


    public function AdminDashboard() {
    	$usersData = user::find(Auth::user()->id);
      $stores_count = DB::select('select COUNT(*) as store_count FROM stores where status = "1"')[0];
      $b_users_count = DB::select('select COUNT(*) as b_users_count FROM users where status = "1" AND user_type = "business" ')[0];
      $c_users_count = DB::select('select COUNT(*) as c_users_count FROM users where status = "1" AND user_type = "customer" ')[0];
      $categories_count = DB::select('select COUNT(*) as categories_count FROM categories where status = "1"')[0];
      $subscription_count = DB::select('select COUNT(*) as subscription_count FROM subscription_plans where status_active_deactive = "1" ')[0];
      $product_count = DB::select('select COUNT(*) as product_count FROM products where status = "1" ')[0];

      $contact_requests = DB::select('select * FROM contact_us_queries ORDER BY id LIMIT 15');
    	return view("admin/dashboard/index", compact("usersData","stores_count","b_users_count","c_users_count","categories_count","subscription_count","product_count","contact_requests"));
    }

    public function AllContactRequests() {
      $usersData = user::find(Auth::user()->id);
      $contact_requests = DB::select('select * FROM contact_us_queries ORDER BY id');
      return view("admin/contactRequests/index", compact("usersData","contact_requests"));
    }

    public function SignOutProcess() {
        Session::flush();
        Auth::logout();
        return Redirect('admin');
    }
}