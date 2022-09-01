@include('web.includes.header');
<style>
  .tabs .tab {
    display: none;
    height: auto;
    border-radius: 3px;
    padding: 20px 15px;
    color: darkslategray;
    clear: both;
}
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600); 
.ads {
  padding: 10px;
  border: 1px solid #CCC;
}
#slider {
  position: relative;
  overflow: hidden;
  margin: 0px auto 0 auto;
  border-radius: 4px;
}

#slider ul {
  position: relative;
  margin: 0;
  padding: 0;
  height: 200px;
  list-style: none;
}

#slider ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 475px;
  height: 150px;
  background: #ccc;
  text-align: center;
  line-height: 300px;
}

a.control_prev, a.control_next {
  position: absolute;
  top: 26%;
  z-index: 999;
  display: block;
  padding: 4% 3%;
  width: auto;
  height: auto;
  background: #2a2a2a;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 18px;
  opacity: 0.8;
  cursor: pointer;
}

a.control_prev:hover, a.control_next:hover {
  opacity: 1;
  -webkit-transition: all 0.2s ease;
}

a.control_prev {
  border-radius: 0 2px 2px 0;
}

a.control_next {
  right: 0;
  border-radius: 2px 0 0 2px;
}

.slider_option {
  position: relative;
  margin: 10px auto;
  width: 160px;
  font-size: 18px;
}
.banner_images_profile {
  width: 100%;
    height: 100%;
    top: 0;
    position: absolute;
    left: 0;
}
</style>
<div class="container-bg-home">

<div class="f-container mt">
    <div class="custom-container">
      <div class="tabs user-tab">
        <ul class="tabs-list">
           @include('web.includes.top_nav_business_profile')
        </ul>
      <br />
      <br />
      <br />
      <br />
      </div>

       @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{session("success")}}</strong>
        </div>
      @endif
      <div>
        <!-- follwing review-block -->
        <div class="">
          <div class="row">
                @if( isset($view_data) && count($view_data) > 0 )
                  @foreach( $view_data as $key => $view_data_main )
                  <div class="col-md-5" style="padding: 5px;border: 2px solid #306f29;margin: 5px;border-radius: 10px;">
                      <div class="row">
                          <div class="col-md-4 mr-0 pr-0">
                            @if($view_data_main->logo && $view_data_main->logo != '')
                                <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/stores/').'/'.$view_data_main->logo}}" alt="User profile picture" style="width: 103px;border-radius: 12px;display: block;width: 100%;">
                                @else
                                <img class="profile-user-img img-fluid img-circle img_custom" style="width: 100%;" src="{{asset('assets/img/stores/default/default.png')}}"  style="height: 103px;border-radius: 12px;display: block;width: 100%;" />
                              @endif
                          </div>
                          <div class="col-md-8" style="word-break: break-all;">
                            <p style="display: block;margin: 0;">
                              <?php
                              if( $view_data_main->category == 1 ) {?>
                                <a href="{{url('doctorDetails').'/'.$view_data_main->id}}" style=" color:#306F29">
                              <?php
                              } else if( $view_data_main->category == 2 ) {?>
                                <a href="{{url('dispensaryDetails').'/'.$view_data_main->id}}" style=" color:#306F29">
                              <?php
                              } else if( $view_data_main->category == 3 ) {?>
                                <a href="{{url('deliveryDetails').'/'.$view_data_main->id}}" style=" color:#306F29">
                              <?php
                              }
                              ?>
                                <strong>{{$view_data_main->name}}</strong>
                              </a>
                            </p>
                            <p><strong>Email:</strong> {{$view_data_main->email}}</p>
                            <p><strong>Address:</strong> {{$view_data_main->address}}</p>
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

      </div>
      

      </div>
    </div>
  </div>

<script>
jQuery(document).ready(function(){

  $(".tabs-list li a").click(function(e){
     e.preventDefault();
  });

  $(".tabs-list li").click(function(){
     var tabid = $(this).find("a").attr("href");
     $(".tabs-list li,.tabs div.tab").removeClass("active");   // removing active class from tab

     $(".tab").hide();   // hiding open tab
     $(tabid).show();    // show tab
     $(this).addClass("active"); //  adding active class to clicked tab

  });

});
</script>

</div>
 
@include('web.includes.footer');
<script>
jQuery(document).ready(function ($) {

  // $('#checkbox').change(function(){
  //   setInterval(function () {
  //       moveRight();
  //   }, 3000);
  // });
  
  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;
  
  $('#slider').css({ width: slideWidth, height: slideHeight });
  
  $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });


    setInterval(function () {
        moveRight();
    }, 3000);

});    

$( function() {
        $( "#datepicker" ).datepicker();
  } );
  </script>