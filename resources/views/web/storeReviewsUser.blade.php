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


<style>
.btn-grey{
    background-color:#D8D8D8;
  color:#FFF;
}
.rating-block{
  background-color:#FAFAFA;
  border:1px solid #EFEFEF;
  padding:15px 15px 20px 15px;
  border-radius:3px;
}
.bold{
  font-weight:700;
}
.padding-bottom-7{
  padding-bottom:7px;
}


.review-block-name{
  font-size:12px;
  margin:10px 0;
}
.review-block-date{
  font-size:12px;
}
.review-block-rate{
  font-size:13px;
  margin-bottom:15px;
}
.review-block-title{
  font-size:15px;
  font-weight:700;
  margin-bottom:10px;
}
.review-block-description{
  font-size:13px;
}
.rating_count {
  background: #dadada;
    display: inline-block;
    padding: 5px;
    border-radius: 8px;
    font-weight: bold;
    font-size: 15px;
}
.rating_each {
    width: 226px;
    border-radius: 50px;
    text-align: center;
    line-height: 24px;
    font-weight: bold;
    font-size: 18px;
    background: #306f29;
    color: #FFF;
    float: right;
    padding: 2px;
}
</style>
    <div class="row">
      <div class="col-sm-12">
        <div class="">
           <div class="row">

            @if( isset($products_data) && count($products_data) > 0 )
                @foreach( $products_data as $key => $products_data_main )
                <div class="col-md-5 m-4" style="background: #f7f7f7;padding: 10px;border: 1px solid #CCC;border-radius:15px;">
                  <div class="row">
                    <div class="col-sm-3" style="border-right: 2px solid #CCC;text-align: center;font-weight: bold;word-break: break-word;">
                      @if($products_data_main->logo && $products_data_main->logo != '')
                        <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/stores/').'/'.$products_data_main->logo}}" alt="User profile picture" style="width:170px">
                        @else
                        <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/profile/default/default.png')}}" style="width:170px" />
                      @endif

                      <div class="review-block-rate">
                        <div class="review-block-name" style="font-size: 15px;margin: 0;"><a href="#" style="color: #306F29">{{$products_data_main->name}}</a></div>
                      </div>

                    </div>
                    <div class="col-sm-8">

                       <p class="rating_count rating_each w-100">{{$products_data_main->rating.".0"}}
                            <?php
                            if( $products_data_main->rating == 1 ) {?>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                            <?php
                            } else if( $products_data_main->rating == 2 ) {?>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                            <?php
                            } else if( $products_data_main->rating == 3 ) {?>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                            <?php
                            } else if( $products_data_main->rating == 4 ) {?>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                            <?php
                            } else if( $products_data_main->rating == 5 ) {?>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                            <?php
                            }
                            ?>
                        </p>
                      <div class="review-block-title" style="color: #306f29;font-size: 20px;">{{$products_data_main->heading}}</div>
                      <div class="review-block-description">{{$products_data_main->description}}</div>
                    </div>
                  </div>
                  </div>
                  @endforeach
                  @else
                  <div class="review-block">
                    <div class="p-5 text-center" style="display: block; margin:0 auto ">
                      <h2 class="text-center text-danger">No Reviews found</h2>
                    </div>
                  </div>
                @endif

      </div>
    </div>
    
    </div> <!-- /container -->

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