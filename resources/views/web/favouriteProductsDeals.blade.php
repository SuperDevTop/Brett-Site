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
      <h2 style="text-align: left; margin-top: 20px;">Favourite Deals</h2>
      <div class="row" style=" margin-top: 30px;">
        @if( isset($favourite_prod_deals) && count($favourite_prod_deals) > 0 )
          @foreach( $favourite_prod_deals as $key => $view_data_main )
                  <div class="col-lg-2 col-md-2 col-sm-3" style="margin-left: 10px;">
                    <div class="row">

                      <div class="col-lg-10 col-md-10 col-sm-10 mr-0 pr-0" style="margin: auto;">
                          @if($view_data_main->image && $view_data_main->image != '')
                            <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/products/').'/'.$view_data_main->image}}" alt="User profile picture" style="height: 100px;border-radius: 12px;display: block;width: 100%;">
                            @else
                            <img class="profile-user-img img-fluid img-circle img_custom" style="width: 100%;" src="{{asset('assets/img/products/default/default.png')}}"  style="height: 100px;border-radius: 12px;display: block;width: 100%;" />
                          @endif
                      </div>

                      <div class="col-md-10" style="margin: auto;">
                        <p style="display: block;margin: 0;">
                          <strong>{{$view_data_main->name}}</strong>
                        </p>
                        <p style="word-wrap: break-word;">{{$view_data_main->description}}</p>
                      </div>
                    </div>
                  </div>                  
                  @endforeach
                  @else
                    <div class="p-5 text-center" style="display: block; margin:0 auto ">
                      <h2 class="text-center text-danger">No Favourite Item Found. Your Favourite Items will appear here.</h2> 
                    </div>
                @endif
            </div>
    </div>
  </div>
 
@include('web.includes.footer');
</body>
</html>