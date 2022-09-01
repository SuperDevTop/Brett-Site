<?php
namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Reddit;

class RedditDiscord extends Controller
{
	public function discordAuthenticate() {
		define('OAUTH2_CLIENT_ID', '935889846596145173');
		define('OAUTH2_CLIENT_SECRET', 'SdljvxuFqW50NEEyAuQXqowKeeDD57jb');
		session_start();

		$params = array(
		    'client_id' => OAUTH2_CLIENT_ID,
		    'redirect_uri' => 'https://budandcarriage.com/discord',
		    'response_type' => 'code',
		    'scope' => 'identify',
		);

		return Redirect("https://discord.com/api/oauth2/authorize?". http_build_query($params));
	}
    public function discord() {
    	define('OAUTH2_CLIENT_ID', '935889846596145173');
		define('OAUTH2_CLIENT_SECRET', 'SdljvxuFqW50NEEyAuQXqowKeeDD57jb');
		session_start();
		if(isset($_GET['code'])) {
		  $token = $this->apiRequest("https://discord.com/api/oauth2/token", array(
		    "grant_type" => "authorization_code",
		    'client_id' => OAUTH2_CLIENT_ID,
		    'client_secret' => OAUTH2_CLIENT_SECRET,
		    'redirect_uri' => 'https://budandcarriage.com/discord',
		    'code' => $_GET['code']
		  ));
		  if( isset($token->error) ) {
		  	return Redirect("/businessProfile")->with("error", "Sorry! Access Token is not valid anymore");
		  } else {
		  	  	$_SESSION['access_token'] = $token->access_token;
				$user = $this->apiRequest("https://discord.com/api/users/@me");
				DB::update(' update users SET discord_link = "'.$user->username."#".$user->discriminator.'" WHERE id = "'.Auth::user()->id.'" ');
				return Redirect("/businessProfile")->with("success", "Discord Profile Link Updated Successfully.");	
		  }
		} else {
			return Redirect("/businessProfile")->with("error", "Sorry! Access Code is required.");
		}
    }
    public function apiRequest($url, $post=FALSE, $headers=array()) {
	  $ch = curl_init($url);
	  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	  $response = curl_exec($ch);
	  if($post)
	    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	  $headers[] = 'Accept: application/json';
	  if(isset($_SESSION['access_token']) && $_SESSION['access_token'] != '')
	    $headers[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	  $response = curl_exec($ch);
	  return json_decode($response);
	}
	public function redditAuthenticate() {
		return Redirect("https://ssl.reddit.com/api/v1/authorize?response_type=code&client_id=RIT0T_k3u46Aoar-lcWNlQ&redirect_uri=https://budandcarriage.com/reddit&scope=identity&state=".rand());
	}
	public function reddit() {
        session_start();
        if (isset($_GET['code'])){
	        $code = $_GET["code"];
	        $postvals = sprintf("code=%s&redirect_uri=%s&grant_type=authorization_code",$code,"https://budandcarriage.com/reddit");
	        $token = $this->runCurl("https://ssl.reddit.com/api/v1/access_token", $postvals, null, true, null);
	        $_SESSION['token_type_reddit'] = "";
	        $_SESSION['access_token_reddit'] = "";

	        if (isset($token->access_token)){
	            $_SESSION['access_token_reddit'] = $token->access_token;
	            $_SESSION['token_type_reddit'] = $token->token_type;
	        }
        	$data = $this->runCurl("https://oauth.reddit.com/api/v1/me","", null, true, "oauth");
        	if( isset($data->subreddit->url) && $data->subreddit->url != '' ) {
        		$link_reddit = "https://www.reddit.com".$data->subreddit->url;
        		DB::update(' update users SET redit_link = "'.$link_reddit.'" WHERE id = "'.Auth::user()->id.'" ');
				return Redirect("/businessProfile")->with("success", "Reddit Profile Link Updated Successfully.");	
        	} else {
        		return Redirect("/businessProfile")->with("error", "Something Went Wrong, Please try again.");
        	}
	    } else {
	        return Redirect("/businessProfile")->with("error", "Sorry! Access Code is required.");
	    }
    }

	public function runCurl($url, $postVals = null, $headers = null, $auth = false,$auth_mode=null){
        $ch = curl_init($url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 10
        );
        
        if (!empty($_SERVER['HTTP_USER_AGENT'])){
            $options[CURLOPT_USERAGENT] = $_SERVER['HTTP_USER_AGENT'];
        }
        
        if ($postVals != null){
            $options[CURLOPT_POSTFIELDS] = $postVals;
            $options[CURLOPT_CUSTOMREQUEST] = "POST";
        }
        
        if ($auth_mode == 'oauth'){
        	$headers = array("Authorization: {$_SESSION['token_type_reddit']} {$_SESSION['access_token_reddit']}");
            $options[CURLOPT_HEADER] = false;
            $options[CURLINFO_HEADER_OUT] = false;
            $options[CURLOPT_HTTPHEADER] = $headers;
        }
        
        if ($auth){
            $options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
            $options[CURLOPT_USERPWD] = "RIT0T_k3u46Aoar-lcWNlQ:U5ok7OcKxdFxBJMYaMy9dRrcRIfm8w";
            $options[CURLOPT_SSLVERSION] = 4;
            $options[CURLOPT_SSL_VERIFYPEER] = false;
            $options[CURLOPT_SSL_VERIFYHOST] = 2;
        }
        
        curl_setopt_array($ch, $options);
        $apiResponse = curl_exec($ch);
        $response = json_decode($apiResponse);
        
        //check if non-valid JSON is returned
        if ($error = json_last_error()){
            $response = $apiResponse;    
        }
        curl_close($ch);
        
        return $response;
    }
}
