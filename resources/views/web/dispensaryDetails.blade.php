@include('web.includes.header');
<style type="text/css">
.active_menu{
   border-bottom: 3px solid #00a8a3 !important;
}
</style>
<div class="container-bj">
         <div class="foot-1">
            @if(isset($delivery_detail->logo) && $delivery_detail->logo != '')
              <img src="{{asset('assets/img/stores').'/'.$delivery_detail->logo}}" class="img-responsive">
            @else
              <img src="{{asset('assets/img/stores/default/default.png')}}">
          @endif
          </div>
         <div class="foot-2">
            <div class="heading">
               <h1>{{$delivery_detail->name}}</h1>
               <span class="text">{{$delivery_detail->address}}</span> 
            </div>
            <div class="icon-barr">
               <div class="icon-2"> <span><i class="fas fa-briefcase-medical"></i>Deliveries</span> <span><i class="fas fa-pager"></i>Medical & recreational</span> <span><i class="fas fa-shopping-cart"></i>In-store purchases only</span> </div>
               <div class="icon-3" style="width: 250px;"> <span><i class="far fa-clock"></i><br />{{$delivery_detail->store_hours}}</span> </div>
            </div>
            <div class="button" style="    width: 525px;"> <span class="hello-1"><i class="fas fa-phone"></i>{{$delivery_detail->phone}}</span> <span class="hello-1"><i class="fas fa-map"></i>{{$delivery_detail->email}}</span> </div>
         </div>
         <div class="foot-3"></div>
      </div>
       <!-- about page end -->
      <!-- tabs button-->
      <div class="top-botoom-border">
         <div class="tabbin-1">
            <div class="w3-bar w3-black">
               <button class="w3-bar-item w3-button active_menu" onclick="openCity(this,'menu')">Menu</button>
               <button class="w3-bar-item w3-button" onclick="openCity(this,'Details')">Details</button>
               <button class="w3-bar-item w3-button" onclick="openCity(this,'deals')">Deals</button>
               <button class="w3-bar-item w3-button" onclick="openCity(this,'Review')">Review</button>
               <button class="w3-bar-item w3-button" onclick="openCity(this,'Media')">Media</button>
            </div>
         </div>
      </div>
      <div class="tabinn">
         <div class="tabbin-2">
            <!--    FIRST START TABE -->
            <div id="menu" class="w3-container city">
               <div class="tab-main-pricing-one">
                  <!-- Left side and pricing menu -->
                  <div class="tab-left-pricing">
                     <div class="ries-bg">
                        <h2>Product Filters</h2>
                     </div>
                     <span></span>
                     <div class="all-product">
                        <span>Business Categories</span>
                        <br />
                        <input type="radio" value="1" name="b_category_fitler" value="1" onclick="filter_products()"> Doctor<br />
                        <input type="radio" value="2" name="b_category_fitler"  value="2" onclick="filter_products()"> Dispensary<br />
                        <input type="radio" value="3" name="b_category_fitler"  value="3" onclick="filter_products()"> Deliveries<br />
                     </div>
                     <div class="all-product">
                        <span>Price Range</span>
                        <br />
                        <input type="number" placeholder="Start Range" name="p_range_start" id="p_range_start1" onkeyup="filter_products();" value="">
                        <input type="number" placeholder="Ends Range" name="p_range_end" id="p_range_end" onkeyup="filter_products();" value="">
                     </div>
                  </div>
                  <!-- Left end side and pricing menu -->
                  <!-- Right side and pricing menu -->
                  <div class="tab-Right-pricing">
                     <!--   1 dive  -->
                     <div class="main-from-bg">
                        <div class="frim-1">
                           <form action="/action_page.php" class="secrchh">
                               <span style="    position: relative;
    display: block;
    width: 29%;"><i class="fas fa-search" style="    float: right;
    right: 13px;
    position: absolute;
    top: -5px;"></i>
                              <input type="text" id="search_p_name" name="search_p_name" onkeyup="filter_products()" placeholder="Search"><br><br></span>
                           </form>
                        </div>
                        <!-- <div class="frim-2">
                           <select>
                              <option value="volvo">Relevence</option>
                              <option value="saab">Most popular</option>
                              <option value="opel">Recent add</option>
                              <option value="audi">Lowest price</option>
                              <option value="audi">highwest price</option>
                           </select>
                        </div> -->
                     </div>
                     <script> 
                        var status = 0;
                        function filter_products() {
                           if( status == 0 ) {
                              // setTimeout(function(){
                                 var b_category = $('input[name="b_category_fitler"]:checked').val();
                                 var p_range_start1 = $('#p_range_start1').val();
                                 var p_range_end = $('#p_range_end').val();
                                 if( p_range_start1 >= 0 ) {
                                 } else {
                                    p_range_start1 = 0;
                                 }
                                 if( p_range_end >= 0 ) {
                                 } else {
                                    p_range_end = 0;
                                 }
                                 var search_p_name = $('#search_p_name').val();
                                 $(".products_listing").hide();
                                 $.ajax({
                                       url: "{{ url('product_filteration_data').'/'.$store_id }}",
                                       type:"POST",
                                       data:{
                                         "b_category": b_category,
                                         "p_range_start1": p_range_start1,
                                         "search_p_name": search_p_name,
                                         "p_range_end": p_range_end,
                                         "_token": "<?php echo csrf_token() ?>"
                                       },
                                       success:function(response){
                                           $(".products_listing").fadeIn(500);
                                           $(".products_listing").html(response);
                                           status = 0;
                                       },
                                 });
                              // }, 2000);
                              status = 1;
                           }
                        }
                     </script>
                     <!--   1 dive end  -->
                     <!--    2 div -->
                     <div class="live">
                        
                     </div>
                     
                     <div class="main-do-dos">
                        <div class="container products_listing">
                              @if( isset($store_products) && count($store_products) > 0 )
                                 @foreach( $store_products as $key => $each_store_products )
                                 <a href="{{url('singleProductDetails').'/'.$each_store_products->id}}">
                                    <div class="row mb-2">
                                       <div class="col-md-2 text-left pl-0">
                                          @if($each_store_products->image && $each_store_products->image != '')
                                             <img src="{{asset('assets/img/products/').'/'.$each_store_products->image}}" class="img_custom" style="width: 100%;" />
                                             @else
                                             <img src="{{asset('assets/img/products/default/default.jpg')}}" class="img_custom" style="width: 100%;"/>
                                          @endif
                                       </div>
                                       <div class="col-md-7">
                                          <h3>{{$each_store_products->name}}</h3>
                                          <p>{{$each_store_products->description}}</p>
                                          <p><strong>Product Category: </strong>{{$each_store_products->p_c_name}}</p>
                                       </div>
                                       <div class="col-md-3 text-right pr-0">
                                          <p style="font-weight: bold; font-size: 18px;">${{$each_store_products->regular_price}}.00</p>
                                       </div>
                                    </div>
                                 </a>
                                 @endforeach
                              @endif
                        </div>
                     </div>

                     <!-- <div class="main-do-dos">
                        <div class="dos-left">
                           <div class="indica">
                              <div class="d-1"><img src="img/columb-1.jpg"></div>
                              <div class="d-2">
                                 <span data-testid="hrd">Indica |Flower| Dosidos</span><br>
                                 <h4>Baklava - Indoor</h4>
                              </div>
                           </div>
                        </div>
                        <div class="dos-right">
                           <p><b class="dol$">$50.00</b>per 1/8 oz</p>
                        </div>
                     </div> -->
                    
                  </div>
                  <!-- Right end side and pricing menu -->
               </div>
            </div>
            <!--    FIRST END TABE -->
            <!--    SECOND START TABE -->
            <div id="Details" class="w3-container city"style="display:none">
               <div class="main-tabb-cl">
                  <div class="main-tabb-left">
                     <div class="first-time">
                        <div>
                            <h2 class="cg">Introduction</h2>
                            <p>{{$delivery_detail->about_us_info}}</p>
                           <h3 class="cg">Amenities</h3>
                           <p><a href="#"><i class="fas fa-notes-medical"></i><br>Mdical</a></p>
                            <h2 class="cg">First-Time Customers</h2>
                            <p>20% off your purchase! Use discount code <b>"SUNSET20"</b></p>
                            <p>State License<br>
                            Adult-Use Nonstorefront:C9-0000103-LIC</p>
                        </div>
                     </div>
                  </div>
                  <!-- right side  strat -->
                  <div class="main-tabb-right">
                     <div class="tm-map">
                        <div id="map_details" style="border:0; height: 300px; width: 100%;"></div>
   <script>
    function initMap_details() {
      var lat_details = "<?php echo $delivery_detail->lat;?>";
      var long_details = "<?php echo $delivery_detail->long;?>";
      
      const uluru = { lat:parseFloat(lat_details) , lng: parseFloat(long_details)};
      map = new google.maps.Map(document.getElementById('map_details'), {
        center: uluru,
        zoom: 14,
        streetView: false,
        gestureHandling: 'greedy',
        disableDefaultUI: true,
      });
        var marker = new google.maps.Marker({
          map: map,
          position: uluru,
        });
    }
    initMap_details();
</script>

































                     </div>
                     <div class="border-map-below">
                        <div class="text">
                           <a href="tel:080-090-0110" class="tm-contact-link">
                              <i class="fas fa-map-marker-alt"></i>
                              <p>{{$delivery_detail->address}}</p>
                           </a>
                        </div>
                        <div class="number-cg">
                           <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-phone tm-contact-icon"></i>{{$delivery_detail->phone}}</a>
                        </div>
                        <!-- closed  start-->
                        <div class="closed" style="width: 250px;">
                           {{$delivery_detail->store_hours}}
                        </div>
                        <!-- closed end -->
                        <div class="main oppinment">
                           <div class="number-cg">
                              <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-envelope tm-contact-icon"></i> {{$delivery_detail->email}} </a>
                           </div>
                           <div class="number-cg">
                              <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-link tm-contact-icon"></i>{{$delivery_detail->link_with_social_media}} </a>
                           </div>

                           <div class="number-cg">
                              <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-link tm-contact-icon"></i>{{$delivery_detail->link_to_website_listing_page}} </a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--    THIRD START TABE -->
            <div id="deals" class="w3-container city" style="display:none">
               <div class="tab-Deals-bg">
                  <div class="tab-deals">
                     <a href="#"><img src="img/doller-2.png"></a>
                     <h2>No Deals Available</h2>
                     <span>There are currently no deals available, please check<br> back again at a later time!</span>
                  </div>
               </div>
            </div>
            <!-- FORTH START TABE -->
            <div id="Review" class="w3-container city" style="display:none">
               <div class="tab-second">
                  <div class="tab-review">
               @if(isset(Auth::user()->id))
                     <button class="btn-riew btn-info" onclick="show_form();">Write a review</button>
                     <div class="container">
                        <div class="row" style="margin-top:40px;">
                           <div class="col-md-6 show_hide_form" style="margin: 0 auto; display: none;">
                              <form action="{{ url('RatingSubmitStoreProcess') }}" method="post" enctype="multipart/form-data" class="profile-form">
                              @csrf
                                 <input type="hidden" name="store_id" value="{{$store_id}}">
                                 <input type="text" class="form-control mb-2 w-100" name="rating_heading" placeholder="Review Heading" required>
                                 <textarea class="form-control mb-2 w-100" name="rating_detail" placeholder="Review Descriptions" required></textarea>
                                 <select class="form-control mb-2 w-100" name="rating_number" required>
                                    <option value="">Select Rating</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                 </select>
                                 <button class="btn-info"> Submit Review </button>
                              </form>
                           </div>
                        </div>
                     </div>
                  @else
                  <p><a href="{{url('login')}}">Login to write review</a></p>
               @endif
                  <script> 
                        var sss = 0;
                        function show_form() {
                           if( sss == 0 ) {
                              $(".show_hide_form").slideDown();
                              sss = 1;
                           } else {
                              $(".show_hide_form").slideUp();
                              sss = 0;
                           }
                        }
                     </script>   


            @if( isset($products_data) && count($products_data) > 0 )
                @foreach( $products_data as $key => $products_data_main )
                  <div class="row" style="background: #f7f7f7;padding: 10px;border: 1px solid #CCC;border-radius:15px;">
                    <div class="col-sm-3 text-left">
                      @if($products_data_main->profile_photo_path && $products_data_main->profile_photo_path != '')
                        <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/profile/').'/'.$products_data_main->profile_photo_path}}" alt="User profile picture">
                        @else
                        <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/profile/default/default.png')}}" />
                      @endif

                      <div class="review-block-name"><a href="#">{{$products_data_main->first_name." ".$products_data_main->last_name}}</a></div>
                      <div class="review-block-date">{{date("d F, Y H:i:s", strtotime($products_data_main->created_at))}}</div>
                    </div>
                    <div class="col-sm-9 text-left">
                      <div class="review-block-rate">
                        @for($start=1; $start<=5; $start++)
                            @if( $products_data_main->rating >= $start )
                              <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                              </button>
                            @else
                              <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                              </button>
                            @endif
                        @endfor

                        <p class="rating_count">{{$products_data_main->rating.".0"}}</p>
                      </div>
                      <div class="review-block-title" style="font-weight: bold;">{{$products_data_main->heading}}</div>
                      <div class="review-block-description">{{$products_data_main->description}}</div>
                    </div>
                  </div>
                    <hr style="width:100%;height:10px;background:white;"/>
                  @endforeach
                  @else
                    <div class="p-5">
                      <h2 class="text-center text-danger">No Reviews found.</h2>
                    </div>
                @endif

        



                  </div>
               </div>
            </div>
            <!-- FIFTH START TABE -->
            <div id="Media" class="w3-container city" style="display:none">
               <div class="tab-second-cl">
                  <div class="tab-detail">
                     <h2>Be the first to review!</h2>
                     <p>This business hasn't uploaded any photos or videos yet. Click
                        <br> below to learn more about this business.
                     </p>
                     <button class="btn-detail-2">view detail</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         function openCity(_this, cityName) {
            $("button.w3-bar-item.w3-button").removeClass("active_menu");
            $(_this).addClass("active_menu");
            var i;
            var x = document.getElementsByClassName("city");
            for(i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
         }
      </script>



@include('web.includes.footer');