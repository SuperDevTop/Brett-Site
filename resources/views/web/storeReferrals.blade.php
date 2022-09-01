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
      <h2 style="text-align: left; margin-top: 20px;">My Referrals</h2>
      <div class="row" style=" margin-top: 30px;">
        @if( isset($referrals_data) && count($referrals_data) > 0 )
          @foreach( $referrals_data as $key => $referral )
            <div class="col-sm-3 col-lg-2 col-md-2" style="margin-left: 30px; text-align: center;">
              @if($referral->profile_photo_path && $referral->profile_photo_path != '')
                <img class="" src="{{asset('assets/img/profile/').'/'.$referral->profile_photo_path}}" alt="User profile picture" style="height: 100px;border-radius: 12px;display: block;width: 100%;">
              @else
                <img class="" style="width: 100%;" src="{{asset('assets/img/profile/default/default.png')}}"  style="height: 100px;border-radius: 12px;display: block;width: 100%;" />
              @endif
              @if($referral->selected_plan == '0')
                <p><span>{{$referral->first_name}}</span>{{$referral->last_name}}  'Customer'</p>
              @else
                 <p><span>{{$referral->first_name}}</span>{{$referral->last_name}}  'Business'</p>
              @endif
            </div>
          @endforeach
        @else
          <div class="p-5 text-center" style="display: block; margin:0 auto ">
            <h2 class="text-center text-danger">You have no referrals.</h2>
          </div>
        @endif
      </div>
    </div>
  </div>
 
@include('web.includes.footer');
</body>
</html>