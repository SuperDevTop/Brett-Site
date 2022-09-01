@include('web.includes.header')
<!DOCTYPE html>
<html>
<head>

<style>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/web/style.css')}}">
html {
  font-family: sans-serif;
  line-height: 1.15;
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0); }

article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
  display: block; }

body {
  margin-top: 70px;
  background: #eeeeee;
  margin-top:70px;
  font-family: 'Varela Round', sans-serif;
}

.background-section {
  padding: 0px 0; }

.work {
  width: 100%; }

  
  .work .img {
    width: 100%;
    height: 500px;
    position: relative;
    }
    .work .img:after {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      content: '';
      z-index: -1;
      background: #000;
      opacity: .3; }
  .work .text h2 {
    font-size: 60px;
    font-weight: 200;
    color: #fff;
    text-transform: uppercase; }
    @media (max-width: 991.98px) {
      .work .text h2 {
        font-size: 40px; } }
  .work .text span {
    font-size: 12px;
    letter-spacing: 1px;
    color: rgba(0, 0, 0, 0.3);
    text-transform: uppercase;
    font-weight: 500; }

.img {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center; }


/*--------------------------------------------------------------
# Sections General
--------------------------------------------------------------*/
section {
  padding: 60px 0;
  overflow: hidden;
}

.section-bg {
  background-color: #f7fbfe;
}

.section-title {
  text-align: center;
  padding-bottom: 30px;
}

.section-title h2 {
  font-size: 32px;
  font-weight: bold;
  text-transform: uppercase;
  position: relative;
  color: #222222;
}

.section-title h2::before,
.section-title h2::after {
  content: "";
  width: 50px;
  height: 2px;
  background: #3498db;
  display: inline-block;
}

.section-title h2::before {
  margin: 0 15px 10px 0;
}

.section-title h2::after {
  margin: 0 0 10px 15px;
}

.section-title p {
  margin: 15px 0 0 0;
}




/*--------------------------------------------------------------
# About Us
--------------------------------------------------------------*/
.about .content h3 {
  font-weight: 600;
  font-size: 26px;
}

.about .content ul {
  list-style: none;
  padding: 0;
}

.about .content ul li {
  padding-left: 28px;
  position: relative;
}

.about .content ul li+li {
  margin-top: 10px;
}

.about .content ul i {
  position: absolute;
  left: 0;
  top: 2px;
  font-size: 20px;
  color: #3498db;
  line-height: 1;
}

.about .content p:last-child {
  margin-bottom: 0;
}

.about .content .btn-learn-more {
  font-family: "Raleway", sans-serif;
  font-weight: 600;
  font-size: 14px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 32px;
  border-radius: 50px;
  transition: 0.3s;
  line-height: 1;
  color: #3498db;
  -webkit-animation-delay: 0.8s;
  animation-delay: 0.8s;
  margin-top: 6px;
  border: 2px solid #3498db;
}

.about .content .btn-learn-more:hover {
  background: #3498db;
  color: #fff;
  text-decoration: none;
}

/*--------------------------------------------------------------
# Counts
--------------------------------------------------------------*/
.counts {
  padding-top: 0;
}

.counts .content {
  padding: 0;
}

.counts .content h3 {
  font-weight: 700;
  font-size: 34px;
  color: #222222;
}

.counts .content p {
  margin-bottom: 0;
}

.counts .content .count-box {
  padding: 20px 0;
  width: 100%;
}

.counts .content .count-box i {
  display: block;
  font-size: 36px;
  color: #3498db;
  float: left;
  line-height: 0;
}

.counts .content .count-box span {
  font-size: 36px;
  line-height: 30px;
  display: block;
  font-weight: 700;
  color: #222222;
  margin-left: 50px;
}

.counts .content .count-box p {
  padding: 15px 0 0 0;
  margin: 0 0 0 50px;
  font-family: "Raleway", sans-serif;
  font-size: 14px;
  color: #484848;
}

.counts .content .count-box a {
  font-weight: 600;
  display: block;
  margin-top: 20px;
  color: #484848;
  font-size: 15px;
  font-family: "Poppins", sans-serif;
  transition: ease-in-out 0.3s;
}

.counts .content .count-box a:hover {
  color: #6f6f6f;
}

@media (max-width: 1024px) {
  .counts .image {
    text-align: center;
  }

  .counts .image img {
    max-width: 70%;
  }
}

@media (max-width: 667px) {
  .counts .image img {
    max-width: 100%;
  }
}


/*--------------------------------------------------------------
# Portfolio
--------------------------------------------------------------*/

.portfolio .portfolio-item {
  margin-bottom: 30px;
  display: none;
}



.portfolio .show {
  animation: .6s zoom-in;
  display: flex;
}

@keyframes zoom-in {
  0% {
   transform: scale(.1);
  } 
  100% {
    transform: none;
  }
}

.portfolio .hide {
  display: none;
}

.portfolio #portfolio-flters {
  padding: 0;
  margin: 0 auto 20px auto;
  list-style: none;
  text-align: center;
}

.portfolio #portfolio-flters li {
  cursor: pointer;
  display: inline-block;
  padding: 8px 15px 10px 15px;
  font-size: 14px;
  font-weight: 600;
  line-height: 1;
  text-transform: uppercase;
  color: #222222;
  margin-bottom: 5px;
  transition: all 0.3s ease-in-out;
  border-radius: 3px;
}

.portfolio #portfolio-flters li:hover,
.portfolio #portfolio-flters li.filter-active {
  color: #fff;
  background: #3498db;
}

.portfolio #portfolio-flters li:last-child {
  margin-right: 0;
}

.portfolio #portfolio-flters button {
  cursor: pointer;
  display: inline-block;
  padding: 8px 15px 10px 15px;
  font-size: 14px;
  font-weight: 600;
  line-height: 1;
  text-transform: uppercase;
  color: #222222;
  margin-bottom: 5px;
  transition: all 0.3s ease-in-out;
  border-radius: 3px;
}

.portfolio #portfolio-flters button:hover,
.portfolio #portfolio-flters button.filter-active {
  color: #fff;
  background: #3498db;
}

.portfolio #portfolio-flters button:last-child {
  margin-right: 0;
}

.portfolio .pricing-item {
    padding: 70px 30px;
    text-align: center; }
    .portfolio .pricing-item h3 {
      font-weight: 700;
      font-size: 24px;
      margin-bottom: 30px; }
    .portfolio .pricing-item .description {
      margin-bottom: 20px; }
    .portfolio .pricing-item.active {
      background: #ffffff;
      -webkit-box-shadow: 0 10px 30px -7px rgba(0, 0, 0, 0.1);
      box-shadow: 0 10px 30px -7px rgba(0, 0, 0, 0.1);
      border-radius: 7px; }
      .portfolio .pricing-item.active h3 {
        color: #e84545; }
    .portfolio .pricing-item ul {
      text-align: left; }
      .portfolio .pricing-item ul li {
        line-height: 1.4;
        margin-bottom: 8px; }
   
    .portfolio .pricing-item:hover {
    -webkit-box-shadow: 0 25px 50px -7px rgba(0, 0, 0, 0.5);
    box-shadow: 0 25px 50px -7px rgba(0, 0, 0, 0.5); }

    .portfolio .pricing-item .buy-plan {
      position: absolute;
      left: 50%;
      width: 100px;
      margin: auto;
      margin-left: -50px;
      bottom: 30px;
    }

    .portfolio .pricing-item .buy-plan a {
      margin-left: auto;
      margin-right: auto;
    }
    
    .img-responsive {
      width: 40vw;
      height: 60vh
    }

    @media (max-width: 991.98px) {
      .img-responsive {
        width: 80vw;
        height: 60vh } }

  .center_form_container {     
    width: 60%;
    padding: 20px;
    background: #424242d6;
    position: absolute;
    top: 50%;
    left: 25%;
    margin-left: -50px;
    border: 2px solid #FFF;
    margin-top: -50px;
    border-radius: 10px;
    color: #FFF;
  }

  </style>

</head>
<?php
$banner_name = "assets/img/location_banners_adv/default/default.jpg";
if( isset($home_location_banner->cat_image) && $home_location_banner->cat_image != '' ) {
  $banner_name = "assets/img/location_banners_adv/".$home_location_banner->cat_image;
}
?>

<body>
<main>
    <section class="background-section">
      <div class="work">
        <div class="img d-flex align-items-center justify-content-center" style="background-image: url('{{asset($banner_name)}}');">
        <div class="center_form_container">
        <form action="{{url('search-filters/map')}}" class="container" method="get" >
        <!--   <h1 class="text-center mb-4 search_heading">Search Stores by</h1> -->
          
          <div class="row">
              <div class="col-md-8">
                  <input type="text" class="form-control"  name="store_name" placeholder="Search by Store Name" style="padding: 22px;">
              </div>
              <div class="col-md-4">
                  <button class="btn btn-success w-100" style="font-size: 20px;">Find Stores</button>
              </div>
          </div>
      </form>
    </div>
        </div>
      </div>
    </section>

  
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about" style="background-color: ;">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><?php echo $landing_page_about_us->title;?></h2>
        </div>

        <div class="row content" style="display: flex;">
          <div class="col-lg-6 dol-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="150">
            <img src="{{asset('assets/img/logo.jpg')}}" style="width: 100%; height: 430px;" />
          </div>

          <div class="col-lg-6 dol-md-6 col-sm-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p><?php echo $landing_page_about_us->description;?></p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->


  <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">

      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Membership</h2>
          <p>B & C provides you various memberships.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <button class="btn filter-active" onclick="filterSelection('filter-app')"> Doctors</button>
              <button class="btn" onclick="filterSelection('filter-card')"> Deliveries</button>
              <button class="btn" onclick="filterSelection('filter-web')"> Dispensaries</button>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
          @if( isset($dispensary_plan) && count($dispensary_plan) > 0 )
            @foreach( $dispensary_plan as $key => $dispensary_plans )
            <?php
            if( $key+1 <= 3 ) {?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <div class="pricing-item active">
                      
                <h3>{{$dispensary_plans->plane_name}}</h3>
                <div class="description">
                  <p>{{$dispensary_plans->description}}</p>
                </div>
                <div class="period-change mb-4 d-block">
                  <div class="price-wrap">
                    <div class="price">
                      <div>
                        <div>{{"$".$dispensary_plans->price}}</div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="d-inline-flex align-items-center text-center period-wrap">
                    <div class="d-inline-block mr-1">Per</div>
                      <div class="d-block text-left period">
                        <div>
                          <div>Month</div>
                        </div>
                      </div>
                    </div>
                </div>

                @if( isset($dispensary_plans->plan_options_checkboxes_value) && $dispensary_plans->plan_options_checkboxes_value != '' )
                        <ul class="list-unstyled mb-4">
                          <?php $each_counter = 0;?>
                          @foreach( (array)json_decode($dispensary_plans->plan_options_checkboxes_value) as $key => $plans_data )
                            <?php
                            if( $plans_data != '' && $plans_data != NULL && $plans_data != [] ) {
                            if( $key == "feature_listing_x_per_day" ) {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span>
                              <?php echo $plans_data." Feature Listing Per Day"; ?></span>
                            </li>
                            <?php
                            } else if( $key == "products_to_show" ) {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span><?php
                                echo $plans_data." Products to show";
                              ?></span></li>
                            <?php
                            } else {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span><?php
                                echo $plans_data;
                              ?></span></li>
                            <?php
                            }
                          }
                            ?>
                          @endforeach
                        </ul>
                      @endif
                
                <div class="buy-plan">               
                    <a href="{{url('buyPlan/'.$dispensary_plans->id)}}" class="btn btn-primary">Buy Plan</a>
                </div>
              </div>
            </div>
            <?php
            }?>
            @endforeach
          @endif

          @if( isset($doctors_plan) && count($doctors_plan) > 0 )
            @foreach( $doctors_plan as $key => $doctors_plans )
            <?php
            if( $key+1 <= 3 ) {?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
              <div class="pricing-item active">
                      
                <h3>{{$doctors_plans->plane_name}}</h3>
                
                <div class="description">
                  <p>{{$doctors_plans->description}}</p>
                </div>

                <div class="period-change mb-4 d-block">
                  <div class="price-wrap">
                    <div class="price">
                      <div>
                        <div>{{"$".$doctors_plans->price}}</div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="d-inline-flex align-items-center text-center period-wrap">
                    <div class="d-inline-block mr-1">Per</div>
                      <div class="d-block text-left period">
                        <div>
                          <div>Month</div>
                        </div>
                      </div>
                    </div>
                  </div>

                      @if( isset($doctors_plans->plan_options_checkboxes_value) && $doctors_plans->plan_options_checkboxes_value != '' )
                        <ul class="list-unstyled mb-4">
                          <?php $each_counter = 0;?>
                          @foreach( (array)json_decode($doctors_plans->plan_options_checkboxes_value) as $key => $plans_data )
                            <?php
                            if( $plans_data != '' && $plans_data != NULL && $plans_data != [] ) {
                            if( $key == "feature_listing_x_per_day" ) {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span>
                                <?php echo $plans_data." Feature Listing Per Day"; ?></span>
                              </li>
                            <?php
                            } else if( $key == "products_to_show" ) {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span><?php
                                echo $plans_data." Products to show";
                              ?></span></li>
                            <?php
                            } else {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span><?php
                                echo $plans_data;
                              ?></span></li>
                            <?php
                            }
                          }
                            ?>
                          @endforeach
                        </ul>
                      @endif
                
                <div class="buy-plan">
                  <a href="{{url('buyPlan/'.$doctors_plans->id)}}" class="btn btn-primary">Buy Plan</a>
                </div>

              </div>
            </div>
            <?php
            }?>
            @endforeach
          @endif

          @if( isset($delivery_plan) && count($delivery_plan) > 0 )
            @foreach( $delivery_plan as $key => $delivery_plans )
            <?php
            if( $key+1 <= 3 ) {?> 
            <div class="col-lg-4 col-md-6 portfolio-item filter-card" >
              <div class="pricing-item active">
                      
                <h3>{{$delivery_plans->plane_name}}</h3>
                <div class="description">
                  <p>{{$delivery_plans->description}}</p>
                </div>
                <div class="period-change mb-4 d-block">
                  <div class="price-wrap">
                    <div class="price">
                      <div>
                        <div>{{"$".$delivery_plans->price}}</div>
                      </div>
                    </div>
                  </div>
                  <div class="d-inline-flex align-items-center text-center period-wrap">
                    <div class="d-inline-block mr-1">Per</div>
                    <div class="d-block text-left period">
                      <div>
                        <div>Month</div>
                      </div>
                    </div>
                  </div>
                </div>
                @if( isset($delivery_plans->plan_options_checkboxes_value) && $delivery_plans->plan_options_checkboxes_value != '' )
                        <ul class="list-unstyled mb-4">
                          <?php $each_counter = 0;?>
                          @foreach( (array)json_decode($doctors_plans->plan_options_checkboxes_value) as $key => $plans_data )
                            <?php
                            if( $plans_data != '' && $plans_data != NULL && $plans_data != [] ) {
                            if( $key == "feature_listing_x_per_day" ) {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span>
                              <?php echo $plans_data." Feature Listing Per Day"; ?></span>
                            </li>
                            <?php
                            } else if( $key == "products_to_show" ) {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span><?php
                                echo $plans_data." Products to show";
                              ?></span></li>
                            <?php
                            } else {?>
                              <li class="d-flex"><span class="iconify mr-2 mt-1 " data-icon="feather:check-square"></span><span><?php
                                echo $plans_data;
                              ?></span></li>
                            <?php
                            }
                          }
                            ?>
                          @endforeach
                        </ul>
                      @endif
                
                <div class="buy-plan">
                  <a href="{{url('buyPlan/'.$doctors_plans->id)}}" class="btn btn-primary">Buy Plan</a>
                </div>
              </div>
            </div>
            <?php
            }?>
            @endforeach
          @endif
        </div>
      </div>
    </section>



    <section id="contact" class="contact">
      <div class="section-title" data-aos="fade-up">
        <h2>Contact Us</h2>
        <p>You can find your stores in this Map.</p>
      </div>
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-4">
            <a href="{{url('search-filters/list')}}" style="color: #306F29;">
              <img src="{{asset('assets/img/gallery.jpg')}}" class="img_custom" style="width:70%; margin-left: auto;
    margin-right: auto;display: block; border-radius: 50%;">
              <h2 class="text-center">Grid View</h2>
              <p class="text-center">Photo Gallery of Stores</p>
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{url('search-filters/map')}}" style="color: #306F29;">
              <img src="{{asset('assets/img/map.jpg')}}" class="img_custom " style="width:70%; margin-left: auto;
    margin-right: auto;display: block;  border-radius: 50%;">
              <h2 class="text-center">Map View</h2>
              <p class="text-center">Google Map of Stores</p>
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{url('contactUs')}}" style="color: #306F29;">
              <img src="{{asset('assets/img/contact.jpg')}}" class="img_custom text-center" style="width:70%; margin-left: auto;
    margin-right: auto;display: block;  border-radius: 50%;">
              <h2 class="text-center">Contact Us</h2>
              <p class="text-center">Have a Question.</p>
            </a>
          </div>
        </div>
      </div>
    </section>
    
</main>
<script type="text/javascript">
  var search_type = "location";
  function showSearchFeild(feild_name) {
    if( feild_name == "location" ) {
      $(".search_by_location").fadeIn(1000);
      $(".search_by_store").hide();
      search_type = "location";
    } 
    else if( (feild_name == "store") || (feild_name == "product") ) {
      if( feild_name == "store") {
        search_type = "store";
      } 
      else if( feild_name == "product") {
        search_type = "product";
      }
      $(".search_by_store").fadeIn(1000);
      $(".search_by_location").hide();
      }
    }

   function search_store_product() {
    if( search_type == "store" ) {
      $("#product_store_form").submit();
      } 
    else if( search_type == "product" ) {
      window.location.href = "<?php echo url('searchProducts');?>/"+$.trim($("#store_product_text_field").val());
      }
    }
  function get_store_suggestions(store_name) {
    if( $.trim(store_name) != '' ) {
      $.ajax({
        url: "{{ url('get_store_suggestions') }}",
        type:"POST",
        data:{
          "store_name": store_name,
          "search_type": search_type,
          "_token": "<?php echo csrf_token() ?>"
        },
        success:function(response){
          $(".search_suggestions").slideDown();
          $(".search_suggestions").html(response);
        },  
      });
    }
  }
</script>
<script type="text/javascript">
filterSelection("filter-app")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("portfolio-item");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

var btnContainer = document.getElementById("portfolio-flters");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("filter-active");
    current[0].className = current[0].className.replace(" filter-active", "");
    this.className += " filter-active";
  });
}
</script>

  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

<script src="assets/js/main.js"></script>

  </body>

@include('web.includes.footer');

</html>