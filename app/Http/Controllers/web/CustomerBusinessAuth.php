<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\ReferralRelationship;
use App\Models\ReferralLink;

use Illuminate\Support\Facades\Mail;
use App\Mail\SignupEmailVerification;

class CustomerBusinessAuth extends Controller
{
    public function signup(Request $request) {

        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

    	return view("web/signup");
    }
    
    public function verifyEmailAddress($verification_code) {
        if( isset($verification_code) ) {
            if( $verification_code != '' ) {
                $user_store_data = DB::select('select * from users WHERE email_verification_code = "'.$verification_code.'" AND email_verify_flag = 0 AND email_verification_sent_status = 1 ');
                if( count($user_store_data) > 0 ) {
                    $user_data = $user_store_data[0];
                    if( ($user_data->email_verification_sent_status == 1) && ($user_data->email_verification_code != "") && ($user_data->email_verify_flag == 0) ) {
                        return view("web/verify_email_address", compact("user_data"));
                    }
                }
            }
        }
    }

    public function emailVerificationCode($verification_code) {
        if( isset($verification_code) ) {
            if( $verification_code != '' ) {
                $user_store_data = DB::select('select * from users WHERE email_verification_code = "'.$verification_code.'" AND email_verify_flag = 0 AND email_verification_sent_status = 1 ');
                if( count($user_store_data) > 0 ) {
                    $user_store_data = $user_store_data[0];
                    
                    $status = DB::update('UPDATE users
                        SET
                            email_verification_sent_status = "0",
                            email_verification_code = NULL,
                            email_verify_flag = "1",
                            user_type_status = "1",
                            category_selected_status = "1",
                            selected_plan = "1"
                        WHERE
                            email_verification_code = "'.$verification_code.'"
                    ');

                   $credentials_business = array(
                        "email" => $user_store_data->email,
                        "password" => $user_store_data->password_tmp,  
                        "user_type" => 'business'
                    );
                    $credentials_customer = array(
                        "email" => $user_store_data->email,
                        "password" => $user_store_data->password_tmp,  
                        "user_type" => 'customer'
                    );

                    if (Auth::attempt($credentials_business)) {
                        $this->makePlanSessionData(Auth::user()->id);
                        return Redirect("businessProfile")->with('success','Successfully Signed Up!');
                    } else if (Auth::attempt($credentials_customer)) {
                        $this->makePlanSessionData(Auth::user()->id);
                        return Redirect("businessProfile")->with('success','Successfully Signed Up!');
                    } else {
                        return redirect("login")->with('errormessage','Wrong Credentials!');
                    }
                    // return Redirect("businessProfile")->with('success','Email successfully Verified');    
                }
                
            }
        }
    }


    public function resendSignUpVerification($code) {
        if( isset($code) ) {
            if( $code != '' ) {
                $getusers = DB::select('SELECT * FROM users WHERE email_verification_code = "'.$code.'"  ');
                $getusers = $getusers[0];
                \mail::to($getusers->email)->send(new \App\Mail\SignUpMailVerification($getusers->email_verification_code));
                return Redirect("/verifyEmailAddress/".$getusers->email_verification_code)->with('success','Verification email is Re-sent.');
            }   
        }
    }
    public function changeSignUpVerification(Request $formData) {

        if( isset($formData->verification_code) && $formData->verification_code != '' ) {
                 $email = $formData->email;
                 $validated = $formData->validate(
                    [
                        'email' => 'required|unique:users'
                    ],
                    [
                        'email.required' => 'Email is Required!',
                        'email.unique' => 'Email is already Exists!',
                    ]
                );

                $selected_plan_details = DB::select('UPDATE users SET email = "'.$email.'" WHERE email_verification_code = "'.$formData->verification_code.'"  ');
                $verification_code = $formData->verification_code;
                \mail::to($email)->send(new \App\Mail\SignUpMailVerification($verification_code));
                return Redirect("/verifyEmailAddress/".$verification_code)->with('success','Email address changed & Verification email is sent.');
        }
    }

    public function relationship($data, $formData)
    {
        return ReferralRelationship::create([
            'referral_link_id' => $data['user_id'],
            'user_email' => $formData['email'],
        ]);
    }

    public function referral($data) {
        return ReferralLink::create([
            'user_id' => $data,
            'code' => $data,
        ]);
    }

    public function signupProcess(Request $formData) {
        $referrer = ReferralLink::whereCode(session()->pull('referrer'))->first();
        

        $validated = $formData->validate(
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
            ],
            [
                'f_name.required' => 'First Name is Required!',
                'l_name.email' => 'Last Name is not correct!',
                'email.required' => 'Email is Required!',
                'email.unique' => 'Email is already Exists!',
                'password.required' => 'Password is Required!',
            ],
        );

        $f_name = $formData->f_name;
        $l_name = $formData->l_name;
        $email = $formData->email;
        $password = $formData->password;
        $store_id = $formData->store_id;

        $verification_code = $this->getRandomString();

    	$RegisterData = array(
    		"first_name" => $f_name,
			"last_name" => $l_name,
            "last_name" => $l_name,
            "category" => 0,
            
            "email_verification_sent_status" => 1,
            "email_verification_code" => $verification_code,
            "email_verify_flag" => 0,

			"email" => $email,
            "status" => 1,
			"password" => Hash::make($password),
            "password_tmp" => $password

    	);

        \mail::to($email)->send(new \App\Mail\SignUpMailVerification($verification_code));
        
        $id = User::create($RegisterData)->id;

        
        if(!is_null($referrer)) 
        {
            $relation = $this->relationship($referrer, $formData); 
        }
        
        if( $id ) {
            $query = 'INSERT INTO stores SET
                bussiness_user_id = "'.$id.'",
                status = "1"
            ';
            $result_status = DB::insert($query);
            return Redirect()->back();
        }
        $referral = $this->referral($id);
        
    }

    public function getRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }


    public function login(Request $formData) {
        return view("web/login");
    }

    public function loginProcess(Request $formData) {

        $validated = $formData->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email is Required!',
                'email.email' => 'Email is not correct!',
                'password.required' => 'Password is Required!',
            ],
        );
        
        $credentials_business = array(
            "email" => $formData->email,
            "password" => $formData->password,  
            "user_type" => 'business'
        );
        $credentials_customer = array(
            "email" => $formData->email,
            "password" => $formData->password,  
            "user_type" => 'customer'
        );

        if (Auth::attempt($credentials_business)) {
            $this->makePlanSessionData(Auth::user()->id, $formData);
            return Redirect("businessProfile")->with('success','Successfully Signed Up!');
        } else if (Auth::attempt($credentials_customer)) {
            $this->makePlanSessionData(Auth::user()->id, $formData);
            return Redirect("businessProfile")->with('success','Successfully Signed Up!');
        } else {
            return redirect("login")->with('errormessage','Wrong Credentials!');
        }
    }

    public function doctordetailslogin(Request $formData) {

        $validated = $formData->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email is Required!',
                'email.email' => 'Email is not correct!',
                'password.required' => 'Password is Required!',
            ],
        );
        
        $credentials_business = array(
            "email" => $formData->email,
            "password" => $formData->password,  
            "user_type" => 'business'
        );
        $credentials_customer = array(
            "email" => $formData->email,
            "password" => $formData->password,  
            "user_type" => 'customer'
        );

        if (Auth::attempt($credentials_business)) {
            $this->makePlanSessionData(Auth::user()->id, $formData);
            return Redirect::back();
            // return Redirect("businessProfile")->with('success','Successfully Signed Up!');
        } else if (Auth::attempt($credentials_customer)) {
            $this->makePlanSessionData(Auth::user()->id, $formData);
            return Redirect::back();
            // return Redirect("businessProfile")->with('success','Successfully Signed Up!');
        } 
        // else {
        //     return redirect("login")->with('errormessage','Wrong Credentials!');
        // }
    }

    public function doctordetailssignup(Request $formData) {

        $validated = $formData->validate(
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
            ],
            [
                'f_name.required' => 'First Name is Required!',
                'l_name.email' => 'Last Name is not correct!',
                'email.required' => 'Email is Required!',
                'email.unique' => 'Email is already Exists!',
                'password.required' => 'Password is Required!',
            ],
        );

        $f_name = $formData->f_name;
        $l_name = $formData->l_name;
        $email = $formData->email;
        $password = $formData->password;

        $verification_code = $this->getRandomString();

    	$RegisterData = array(
    		"first_name" => $f_name,
			"last_name" => $l_name,
            "last_name" => $l_name,
            "category" => 0,
            
            "email_verification_sent_status" => 1,
            "email_verification_code" => $verification_code,
            "email_verify_flag" => 0,

			"email" => $email,
            "status" => 1,
			"password" => Hash::make($password),
            "password_tmp" => $password

    	);

        \mail::to($email)->send(new \App\Mail\SignUpMailVerification($verification_code));
            
    	$id = User::create($RegisterData)->id;
        if( $id ) {
            $status = DB::update('UPDATE stores
                        SET
                            bussiness_user_id = "'.$id.'",
                            status = "1"
                        WHERE
                            id = "'.$store_id.'"
                    ');
            $referral = $this->referral($id);
            return Redirect("/verifyEmailAddress/".$verification_code);
        }
    }

    public function makePlanSessionData($user_id) {
        if( $user_id && $user_id != '' ) {
            $user_store_data = DB::select('select * from stores WHERE bussiness_user_id = "'.$user_id.'" ');
            if( isset($user_store_data) && count($user_store_data) > 0 ) {
                $user_store_data = $user_store_data[0];
                session()->put('business_store_id', $user_store_data->id);
            }

            $selected_plan_details = DB::select('select * from subscription_plans WHERE user_id = "'.$user_id.'" AND status_active_deactive = 1 ');
            if( isset($selected_plan_details) && count($selected_plan_details) > 0 ) {
                $selected_plan_details = $selected_plan_details[0];
                $data = $selected_plan_details->plan_options_checkboxes;
                if( isset($data) && $data != "" ) {
                    session()->put('plan_data', json_decode($data));
                }
            }
        }
    }

    protected function credentials($credentials)
    {
        return ['email' => $credentials['email'], 'password' => $credentials['password'], "user_type" => 'customer'];
    }


    public function SignOutProcess() {
        Session::flush();
        Auth::logout();
        return Redirect('home');
    }
}
