@include('web.includes.header');
<html>
<head>
<style type="text/css">

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
    
    <div class="container">
      <h2 style="text-align: left; margin-top: 20px;">My Followers</h2>
      <div class="row" style=" margin-top: 30px;">
                @if( isset($view_data) && count($view_data) > 0 )
                  @foreach( $view_data as $key => $view_data_main )
                  <div class="col-lg-2 col-md-2 col-sm-3" style="margin-left: 10px;">
                    <div class="row">

                      <div class="col-lg-10 col-md-10 col-sm-10 mr-0 pr-0" style="margin: auto;">
                          @if($view_data_main->profile_photo_path && $view_data_main->profile_photo_path != '')
                            <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/profile/').'/'.$view_data_main->profile_photo_path}}" alt="User profile picture" style="height: 100px;border-radius: 12px;display: block;width: 100%;">
                            @else
                            <img class="profile-user-img img-fluid img-circle img_custom" style="width: 100%;" src="{{asset('assets/img/profile/default/default.png')}}"  style="height: 100px;border-radius: 12px;display: block;width: 100%;" />
                          @endif
                      </div>

                      <div class="col-md-10" style="margin: auto;">
                        <p style="display: block;margin: 0;">
                          <strong>{{$view_data_main->first_name." ".$view_data_main->last_name}}</strong>
                        </p>
                        <p style="word-wrap: break-word;">{{$view_data_main->email}}</p>
                      </div>
                    </div>
                  </div>                  
                  @endforeach
                  @else
                    <div class="p-5 text-center" style="display: block; margin:0 auto ">
                      <h2 class="text-center text-danger">Currently No one is following you.</h2> 
                    </div>
                @endif
            </div>
    </div>
  </div>
 
@include('web.includes.footer');
</body>
</html>