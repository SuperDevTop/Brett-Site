@include('web.includes.header');
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
    body {
            margin-top: 80px;
            background-color: #eeeeee;
        }
.login-form {
    margin-top: 10px;
    font-family: arial;
    color: #333;

} 
.login-form a {
    text-decoration: none;
} 

.login-form h2 {
    text-align: center;
    font-size: 35px;
    margin: 10px 0px 40px;
}
.login-form input {
    width: 100%;
    border: 1px solid #ddd;
    padding: 5px 10px;
    height: 35px;
    margin: 0px 0px 20px;
    border-radius: 1px;
    box-sizing: border-box;
    font-size: 17px;
}
.login-form button {
    margin: 5px auto;
    display: table;
    font-size: 20px;
    height: 35px;
    width: 100%;
    padding: 3px 10px;
    background-color: #4CAF50;
    border: none;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
}
.login-form button:hover{
  opacity: 0.8;
}

.login-form .forget-psw {
    text-align: center;
}
.login-form .forget-psw a {
    color: #2196F3;
    text-decoration: none;
}
.social-btn button.google-btn, .social-btn button.facebook-btn {
    width: 100%;
    font-size: 18px;
    margin: 0px 0px 10px;
}
.social-btn button.google-btn{
  background-color: #26abfd;
}
.social-btn button.facebook-btn{
  background-color: #3f68be;
}
.social-btn {
    border-top: 1px solid #ddd;
    padding-top: 20px;
    margin-top: 20px;
}
.social-btn button i {
    margin-right: 5px;
    height:30px;
    font-size: 20px;
}

.social {
    width: 400px;
    margin: 0 auto;
    padding: 20px 30px 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #ffffff;
    -webkit-box-shadow: 0 25px 50px -7px rgba(0, 0, 0, 0.5);
    box-shadow: 0 25px 50px -7px rgba(0, 0, 0, 0.5);
}

.social button.google-btn, .social button.facebook-btn {
    width: 100%;
    font-size: 18px;
    margin: 0px 0px 10px;
}
.social button.google-btn{
  background-color: #26abfd;
}
.social button.facebook-btn{
  background-color: #3f68be;
}
.social {
    border-top: 1px solid #ddd;
    padding-top: 30px;
    margin-top: 30px;
}
.social button i {
    margin-right: 5px;
    font-size: 20px;
}

@media (max-width: 767px){
.login-form form {
    width: 90%;
    padding: 20px 15px 20px;
}
.social button.google-btn, .social button.facebook-btn {
    font-size: 15px;
}
} 


  </style>

</head>
<body>
<div class="login-form">
  
  <div class="social">
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session("error")}}</strong>
      </div>
    @endif
    <?php
            $data = \App\Http\Controllers\web\Home::portalSettings();
            $logo = "assets/img/web/b_c_logo_large.png";
            if( isset($data[0]->logo) ) {
                $logo = "assets/img/settings/".$data[0]->logo;
            }
          ?>
    <div style="display: block; margin: auto;">
      <img  src="{{asset($logo)}}" style="height: 200px; width: 200px; margin: auto;">
    </div>
    
    
    <form action="{{ route('signup_process') }}" method="post">
        @csrf
         @error('email')
            <div class="alert alert-danger" role="alert">
              <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <h2>SignUp</h2>
         <input type="text" class="form-control" placeholder="First Name" required name="f_name" value="{{ old('f_name') }}">

         <input type="text" class="form-control" placeholder="Last Name" required name="l_name" value="{{ old('l_name') }}">

        <input type="email" id="email" placeholder=" Enter your email" name="email" required value="{{ old('email') }}">

        <input type="password" id="password" placeholder="Enter your password" name="password" required value="{{ old('password') }}">

        <button type="submit">Sign Up</button>
          </br>
   
        <div class="forget-psw"><a href="{{ url('login') }}">already Member? Log In</a></div>
      </form>

    <div class="social-btn">
      <a href="{{ url('auth/google') }}"><button class="google-btn"><span><img style="height: 20px; width: 20px; margin-right: 10px;" src="https://www.clipartmax.com/png/middle/219-2197783_training-documents-google-logo-icon-png.png"></span>Login with Google</button></a>
    </div>

    <div class="social-btn" >
      <a href="{{ url('auth/facebook') }}"><button class="facebook-btn"><span><img style="height: 20px; width: 20px; margin-right: 10px;" src="https://www.clipartmax.com/png/small/185-1854464_facebook-logo-png-transparent-background.png"></span> Login with Facebook</button></a>
    </div>
    <div class="account-access">
      <p>Bud & Carriage respects privacy. Names and emails aren't displayed publicly, and nothing is posted to your Facebook or Google account without permission.</p>
    </div>
      <h3 class="w-singup">Why sign up?</h3>
      <img src="{{asset('assets/img/web/signup-baner.jpg')}}" style="width: 100%;">
      <ul class="">
        <li>Find the best dispensary s torefronts and see who delivers to you.</li>
        <li>Get updates about your favorite products, brands, and retailers.</li>
        <li>Leave reviews & share your experiences to help out the community.</li>
      </ul>

  </div>
</div>
</body>
</html>