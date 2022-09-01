<?php
 
namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Redirect;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;   
class FacebookSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFB()
    {
        return Socialite::driver('facebook')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
     
            $user = Socialite::driver('facebook')->user();
      
            $finduser = User::where('social_id', $user->id)->first();
      
            if($finduser){
      
                Auth::login($finduser);
     
                return redirect('/businessProfile');
      
            }else{
                $user_exists = DB::select('select COUNT(*) as check_user_exists from users WHERE email = "'.$user->email.'" ');
                if(isset($user_exists[0]->check_user_exists) && $user_exists[0]->check_user_exists > 0 ){
                    return redirect("login")->with('errormessage','Email already Exists!');
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'social_id'=> $user->id,
                        'social_type'=> 'facebook',
                        
                        'social_type'=> 'facebook',
                        'social_type'=> 'facebook',
                        'social_type'=> 'facebook',

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
          
                    return redirect('/businessProfile');
                }
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}