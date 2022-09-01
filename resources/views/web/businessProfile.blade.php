@include('web.includes.header');
<html>
<head>
<style type="text/css">

  .profile {
      float: left;
      margin: auto;
      margin-top: 50px;
      padding: 20px 30px 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
      background-color: #ffffff;
  }

  .referral {
      float: right;
      margin: auto;
      margin-top: 50px;
      padding: 20px 30px 20px;
      border: 1px solid lightblue;
      border-radius: 5px;
      box-sizing: border-box;
      background-color: #ffffff;
  }

} 
</style>
</head>

<body>
  <div class="container" style="overflow: hidden; margin-bottom: 200px;">
  <div style="margin-top: 55px; display: block; border-bottom:1px solid #eeeeee; height: 50px; overflow: hidden;">
    <div class="tabs">
      <ul class="tabs-list">
        @include('web.includes.top_nav_business_profile')
      </ul>
    </div>
  </div>
  <h2 style="text-align: left; margin-top: 20px;">My Profile</h2>
  <div class="row">
    <div class="col-lg-8 col-md-7 col-sm-12">
      <div class="profile">

          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>{{session("error")}}</strong>
            </div>
          @endif
        <form action="{{ url('EditBusinessProfileProcess') }}" method="post" enctype="multipart/form-data" class="profile-form">
        @csrf
        <div class="row">
            <input type="hidden" name="old_profile_image" value="{{$business_data_user->profile_photo_path}}">

            <div class="col-md-12">
              <div>
                <input type="file" id="profile_image" name="profile_image" value="" style="display: none;">
                <p style="color: #555555;">Profile photo</p>
                  @if($business_data_user->profile_photo_path && $business_data_user->profile_photo_path != '')
                    <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/profile/').'/'.$business_data_user->profile_photo_path}}" alt="User profile picture" style="width: 100px;height: 100px;display: block;margin: 0;border-radius: 50px; float: left;">
                    @error('profile_image')<span class="text-danger">{{ $message }}</span>@enderror
                    <label for="profile_image" style="color: #999999; float: right; margin-top: 30px; cursor: pointer;">Edit</label>
                  @else
                    <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/profile/default/default.png')}}" style="width: 100px; height: 100px; display: block;margin: 0;border-radius: 50px; float: left;" />
                    @error('profile_image')<span class="text-danger">{{ $message }}</span>@enderror
                    <label for="profile_image" style="color: #999999; float: right; margin-top: 30px; cursor: pointer;">Add</label>
                  @endif
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-5">
                  <div class="row">
                    <div class="col-md-12" style="border-bottom: 1px solid #999999; display: block;">
                      <div style="float: left; margin-top: 30px;" >
                        <label style="color: #555555;">Name</label>
                          <input type="text" name="name"  class="w-100" style="font-size: 12px; border: none; padding: 5px; color:#999999;" placeholder="Name" value="{{old('name',$business_data_user->first_name)}}" required>
                          @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                    </div>
                    <div class="col-md-12" style="border-bottom: 1px solid #999999; display: block;">
                      <div style="color: #999999; float: left; margin-top: 10px;" >
                        <label style="color: #555555;">Zip Code</label>
                          <input type="text" name="zip_code"  class="w-100" style="font-size: 12px; border: none; padding: 5px; color:#999999;" placeholder="Zip Code" value="{{old('zip_code',$business_data_user->zip_code)}}" required>
                          @error('zip_code')<span class="text-danger">{{ $message }}</span>@enderror
                        </tr>
                      </div>
                    </div>
                    <div class="col-md-12" style="border-bottom: 1px solid #999999; display: block;">
                      <div style="color: #999999; float: left; margin-top: 10px;" >
                        
                        <label style="color: #555555;">Date of Birth</label>
                        <input type="text" id="datepicker" name="dob" style="display: block; border: none; padding: 3px;" class="w-100" value="{{old('dob',date('d/m/Y', strtotime($business_data_user->dob)))}}">

                      </div>
                    </div>
                    <div class="col-md-12" style="border-bottom: 1px solid #999999; display: block;">
                      <div style="color: #999999; float: left; margin-top: 10px;" >
                        <input type="text" name="email" placeholder="Email" style="display: none;"  value="{{old('email',$business_data_user->email)}}">
                        <label style="color: #555555;">Email</label>
                        <p style="font-size: 12px;">{{$business_data_user->email}}</p>
                      </div>
                    </div>

                    <input type="password" name="password" style="display: none;" class="w-100" placeholder="Password">

                  </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-7">
                  <div class="col-md-12 mb-3" >
                    <a target="_blank" href="{{ url('redditAuthenticate') }}"><input type="text" name="reddit_link" class="w-100" style="border: none;" value="{{old('reddit_link',$business_data_user->redit_link)}}" placeholder="Click here to add your Reddit link" readonly></a>
                  </div>
                  <div class="col-md-12 mb-3" >
                    <a target="_blank" href="{{ url('discordAuthenticate') }}"><input type="text" name="discord_link"  class="w-100" style="border: none;" value="{{old('discord_link',$business_data_user->discord_link)}}" placeholder="Click here to add your Discord link" readonly></a>
                  </div>
                  <div class="col-md-12 mb-3">
                      <button class="btn btn-success" style="float: right;"> Save changes</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </form>
    </div>
    </div>
    <div class="col-lg-4 col-md-5 col-sm-12">
      <div class="referral">
        <h4 style="margin-bottom: 20px;">Share your link</h4>
        <p style="margin-bottom: 20px;"> Copy your personal referral link and share it with your friends and followers </p>
        <p style="word-break: break-all;"><a href="{{ auth()->user()->getReferrals()->link }}">{{auth()->user()->getReferrals()->link}}</a> </p>
      </div>
    </div>
  </div>
</div>
 
@include('web.includes.footer');
</body>
</html>