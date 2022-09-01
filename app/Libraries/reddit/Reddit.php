<?php
namespace App\Classes;
class Reddit{
    private $ENDPOINT_STANDARD = 'http://www.reddit.com';
    private $ENDPOINT_OAUTH = 'https://oauth.reddit.com';
    private $ENDPOINT_OAUTH_AUTHORIZE = 'https://ssl.reddit.com/api/v1/authorize';
    private $ENDPOINT_OAUTH_TOKEN = 'https://ssl.reddit.com/api/v1/access_token';
    private $ENDPOINT_OAUTH_REDIRECT = 'http://localhost/reddit/aaa/PHP-OAuth2/src/OAuth2/test2/reddit.php';
    private $CLIENT_ID = 'RIT0T_k3u46Aoar-lcWNlQ';
    private $CLIENT_SECRET = 'U5ok7OcKxdFxBJMYaMy9dRrcRIfm8w';
    private $SCOPES = 'identity';
    private $access_token;
    private $token_type;
    private $auth_mode = 'basic';
    public function __construct(){
        if(isset($_COOKIE['reddit_token'])){
            $token_info = explode(":", $_COOKIE['reddit_token']); 
            $this->token_type = $token_info[0];
            $this->access_token = $token_info[1];
        } else { 
            if (isset($_GET['code'])){
                $code = $_GET["code"];
                $postvals = sprintf("code=%s&redirect_uri=%s&grant_type=authorization_code",$code,$this->ENDPOINT_OAUTH_REDIRECT);
                $token = self::runCurl($this->ENDPOINT_OAUTH_TOKEN, $postvals, null, true);
                if (isset($token->access_token)){
                    $this->access_token = $token->access_token;
                    $this->token_type = $token->token_type;
                    $cookie_time = 60 * 59 + time();
                    setcookie('reddit_token', "{$this->token_type}:{$this->access_token}", $cookie_time); 
                }
            } else {
                $state = rand();
                $urlAuth = sprintf("%s?response_type=code&client_id=%s&redirect_uri=%s&scope=%s&state=%s",$this->ENDPOINT_OAUTH_AUTHORIZE,$this->CLIENT_ID,$this->ENDPOINT_OAUTH_REDIRECT,$this->SCOPES,$state);
                header("Location: $urlAuth");
            }
        }
        $this->apiHost = $this->ENDPOINT_OAUTH;
        $this->auth_mode = 'oauth';
    }
    public function getUser(){
        $urlUser = "{$this->apiHost}/api/v1/me";
        return self::runCurl($urlUser);
    }
    private function runCurl($url, $postVals = null, $headers = null, $auth = false){
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
        
        if ($this->auth_mode == 'oauth'){
            $headers = array("Authorization: {$this->token_type} {$this->access_token}");
            $options[CURLOPT_HEADER] = false;
            $options[CURLINFO_HEADER_OUT] = false;
            $options[CURLOPT_HTTPHEADER] = $headers;
        }
        
        if ($auth){
            $options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
            $options[CURLOPT_USERPWD] = $this->CLIENT_ID . ":" . $this->CLIENT_SECRET;
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
$reddit = new reddit();
$user = $reddit->getUser();
echo "<pre>";
    print_r($user);
?>