<?php
namespace App\Http\Controllers\web;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

/*
use Socialite;
use Auth;
*/


  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('businessProfile');
       
            }else{
                $user_exists = DB::select('select COUNT(*) as check_user_exists from users WHERE email = "'.$user->email.'" ');
                if(isset($user_exists[0]->check_user_exists) && $user_exists[0]->check_user_exists > 0 ){
                    return redirect("login")->with('errormessage','Email already Exists!');
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => encrypt('weedmaps_facebook_details')
                    ]);
                    $query = 'INSERT INTO stores SET
                        bussiness_user_id = "'.$newUser->id.'",
                        status = "1"
                    ';
                    $result_status = DB::insert($query);

                    $user_store_data = DB::select('select * from stores WHERE bussiness_user_id = "'.$newUser->id.'" ');
                    if( isset($user_store_data) && count($user_store_data) > 0 ) {
                        $user_store_data = $user_store_data[0];
                        session()->put('business_store_id', $user_store_data->id);
                    }

                    Auth::login($newUser);
                    return redirect()->intended('businessProfile');
                }
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}