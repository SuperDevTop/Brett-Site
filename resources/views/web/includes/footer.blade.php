

        <!-- main pitcher reponsive -->
  <div class="main-pictcher">
    <div class="pitcher-ios">
      <div class="pitcher-1">
        <div class="id-pic">
          <pitcer class=androd><img src="{{asset('assets/img/web/og.png')}}"></pitcer>
          <pitcer class=androd-1><img src="{{asset('assets/img/web/lo1.png')}}"></pitcer>
        </div>
      </div>
      <div class="pitcher-2">
        <h2 style="padding-left: 15px;">Get plugged in with the Bud & Carriage Discord & Reddit Profiles</h2>
          <div class="ptc-button">

            <?php
              $data = \App\Http\Controllers\web\Home::portalSettings();
              $discord_url = "javascript:void(0);";
              $reddit_url = "javascript:void(0);";
              if( isset($data[0]->discord_link) ) {
                  $discord_url = $data[0]->discord_link;
              }
              if( isset($data[0]->reddit_link) ) {
                  $reddit_url = $data[0]->reddit_link;
              }
            ?>

            <a href="<?php echo $discord_url;?>" style="font-size:25px;" target="_blank">
              <img src="{{asset('assets/img/discord.png')}}" style="width: 50px;">
              Discord
            </a>
            <a href="<?php echo $reddit_url;?>" style="font-size:25px;" target="_blank">
              <img src="{{asset('assets/img/reddit.png')}}" style="width: 40px;">
              Reddit
            </a>

          </div>
      </div>
    </div>
  </div>
  <!-- footer start-->
  <div class="footer-border">
    <div class="footer-main">
      <div class="footer-bg-1">
        <div class="classic-foot" style="margin-top: 30px;">

          <?php
            $logo = "assets/img/web/b_c_logo_large.png";
            if( isset($data[0]->footer_logo) ) {
                $logo = "assets/img/settings/".$data[0]->footer_logo;
            }
          ?>
          <a href="{{url('home')}}">
            <img src="{{asset($logo)}}" class="weed-map-img">
          </a>
          <?php
            $under_footer_logo_text = "";
            if( isset($data[0]->under_footer_logo_text) ) {
                $under_footer_logo_text = $data[0]->under_footer_logo_text;
            }
          ?>
          <p class="text-img"><?php echo $under_footer_logo_text;?></p>
        </div>
      </div>
      <?php
        $data_footer_menus = \App\Http\Controllers\web\Home::footerCmsData();
      ?>
        @if( isset($data_footer_menus) && count($data_footer_menus) > 0 )
        @php
          $counter=0;
        @endphp
        @foreach( $data_footer_menus as $key => $customer )
          @if( isset($customer['child']) && count($customer['child']) > 0 )
          <div class="footer-bg-2">
              <div class="footer-heloo">
                <?php
                if( $customer['parent']->url != '' ) {?>
                    <a href="{{$customer['parent']->url}}" target="_blank">
                      <h3>{{$customer['parent']->name}}</h3>
                    </a>
                <?php
                } else {?>
                  <a href="javascript:void(0)">
                    <h3>{{$customer['parent']->name}}</h3>
                  </a>
                <?php
                }
              ?>
            @foreach( $customer['child'] as $key => $child )
              <?php
                if( $child->url != '' ) {?>
                    <a href="{{$child->url}}" target="_blank">
                      <p>{{$child->name}}</p>
                    </a>
                <?php
                } else {?>
                  <a href="javascript:void(0);">
                    <p>{{$child->name}}</p>
                  </a>
                <?php
                }
              ?>
            @endforeach
          @endif
          </div>
            </div>
        @endforeach
    @endif

    </div>
  </div>
  <!-- footer end -->
  <!-- copyrit -->
  <div class="copyright-bg">
    <?php
      $copyright_text = "";
      if( isset($data[0]->copyright_text) ) {
          $copyright_text = $data[0]->copyright_text;
      }
    ?>
    <p> <?php echo $copyright_text;?> </p>
  </div>

  
  <script type="text/javascript">
      
      function agreed() {
          $.ajax({
            url: "{{ url('ajax_age_verification') }}",
            type:"POST",
            data:{
              "agreed_status": 1,
              "_token": "<?php echo csrf_token() ?>"
            },
            success:function(response){
                $("#main_age_verify").hide(700);
            },
           });
      }
      function not_agreed() {
          $("#error").html("<p>Sorry your age is not confirmed!</p>");
      }
  </script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style type="text/css">
    .main_contaoerm {
      background: #306f29e0;
      position: fixed;
      left: 50%;
      transform: translate(-50%, 0);
      bottom: 9px;
      color: #FFF;
      padding: 10px;
      border-radius: 10px; 
      display: none;
    }
  </style>
  <div class="container main_contaoerm">
      <div class="row">

          <div class="col-md-8">
            <h3 style="font-family: Raleway;"><strong>We use cookies to improve your experience</strong></h3>
            <p style="font-family: Raleway;">By continuing you agree to our privacy policy and terms of use.</p>
          </div>
          <div class="col-md-3">
            <button class="btn btn-success text-center float-right" onclick="make_cookie_cache();" style="padding: 18px;margin-top: 6px;">OK</button>
          </div>
      </div>
  </div>

  <script>
    function make_cookie_cache() {
        setCookie('cookie_accepted', 1 , 365);
        $(".main_contaoerm").hide();
    }
    if( !getCookie("cookie_accepted") ) {
        $(".main_contaoerm").show(1000)
    }
  </script>

</body>
</html>