@include('web.includes.header');
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LogIn</title>
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
  margin-top: 20px;
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

    <form action="{{ route('login_process') }}" method="post">
        @csrf
         @if(session('errormessage'))
            <div class="alert alert-danger" role="alert">
              <strong>{{session("errormessage")}}</strong>
            </div>
          @endif
        <h2>Log In</h2>

        <input type="email" id="email" placeholder=" Enter your email" name="email" required value="{{ old('email') }}">

        <input type="password" id="password" placeholder="Enter your password" name="password" required value="{{ old('password') }}">

        <button type="submit">Log In</button>

        <div class="forget-psw"><a href="{{ url('signup') }}">New to B & C? SignUp</a></div>
      </form>

      <div class="social-btn">
        <a href="{{ url('auth/google') }}"><button class="google-btn"><span><img style="height: 20px; width: 20px; margin-right: 10px;" src="https://www.clipartmax.com/png/middle/219-2197783_training-documents-google-logo-icon-png.png"></span>Login with Google</button></a>
      </div>

      <div class="social-btn" >
        <a href="{{ url('auth/facebook') }}"><button class="facebook-btn"><span><img style="height: 20px; width: 20px; margin-right: 10px;" src="https://www.clipartmax.com/png/small/185-1854464_facebook-logo-png-transparent-background.png"></span> Login with Facebook</button></a>
      </div>

  </div>
</div>
</body>
</html>