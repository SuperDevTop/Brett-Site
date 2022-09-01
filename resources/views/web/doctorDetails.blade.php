<?php
  use Illuminate\Support\Facades\Auth;
?>
@include('web.includes.header');
<style type="text/css">
.active_menu{
   border-bottom: 3px solid #00a8a3 !important;
}

button:focus {border-top: none; border-left: none; border-right: none;background-color:orange;}
button:hover {border-top: none; border-left: none; border-right: none;background-color:orange;}
</style>

<div class="container" style="margin-top: 80px;">
  <div class="row">
    <div class="col-md-12">
      @if($errors->any())
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{$errors->first()}}</strong>
        </div>
      @endif
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
      @if(isset($delivery_detail->logo) && $delivery_detail->logo != '')
        <img src="{{asset('assets/img/stores').'/'.$delivery_detail->logo}}" style="width: 100%">
        <p style="margin-bottom: 2px;">{{$delivery_detail->name}}</p>
        <?php
          if( $delivery_detail->show_address_status == 1 ) {?>
          <p style="color: #999999; font-size: 14px;">{{$delivery_detail->address}}</p> 
        <?php
          }
        ?>

      @else
        <img src="{{asset('assets/img/stores/default/default.png')}}" style="width: 100%">
        <p style="margin-bottom: 5px;">{{$delivery_detail->name}}</p>
        <?php
          if( $delivery_detail->show_address_status == 1 ) {?>
          <p style="color: #999999; font-size: 14px;">{{$delivery_detail->address}}</p> 
        <?php
          }
        ?>
      @endif
      <div class="">
        <div class="icon-2"> <span><i class="fas fa-briefcase-medical"></i>Delivery</span> <span><i class="fas fa-pager"></i>Medical & recreational</span> <span><i class="fas fa-shopping-cart"></i>In-store purchases only </span> </div>
      </div>

      <div class="" style="margin-top:20px; width: 100%">
        <?php
          if( $delivery_detail->phone_number_status == 1 ) {?>
          <span class="hello-1" style="width: 100%">
            <i class="fas fa-phone"></i>
            {{$delivery_detail->phone}}
          </span>
        <?php
          }?>

        <span class="hello-1" style="width: 100%; margin-top: 20px;">
          <i class="fas fa-map"></i>
          {{$delivery_detail->email}}
        </span>

        <span class="hello-1" style="width: 100%; margin-top: 20px;">
                <?php
                    function curPageURL() {
                        $uri = $_SERVER['REQUEST_URI'];
                        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        return $url; // Outputs: Full URL
                    }

                   ?>
                   <div class="row" style="align-items: flex-end;"> 
                      <div class="col-md-3 text-center">
                      <a href="https://twitter.com/share?url=<?php echo curPageURL();?>" style="color:#306F29; margin: 0px !important; padding: 0px !important;" target="_blank">
                        <i class="fab fa-twitter" style="font-size: 24px;"></i>
                      </a>
                      </div>
                      <div class="col-md-3 text-center">
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo curPageURL();?>" style="color:#306F29; margin: 0px !important; padding: 0px !important;" target="_blank">
                          <i class="fab fa-linkedin" style="font-size: 24px;"></i>
                        </a>
                      </div>
                      <div class="col-md-3 text-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo curPageURL();?>" style="color:#306F29; margin: 0px !important; padding: 0px !important;" target="_blank">
                          <i class="fab fa-facebook" style="font-size: 24px;"></i>
                        </a>
                      </div>
                      <div class="col-md-3 text-center" onclick="copyURL();" style="padding-left: 0px;">
                        <i class="fa fa-share-alt" style="font-size: 21px; color: green; padding: 3px;"></i>
                      </div>
                   </div>
          </span>

          @if(Auth::check())
                <span class="hello-1" style="width: 100%; margin-top: 20px;" data-toggle="modal" data-target="#claim_modal" onclick="get_store_name_id();">
                    <i class="fas fa-exchange-alt"></i> 
                    &nbsp;&nbsp;&nbsp;Claim Your Business
                </span>
          @else
                <span class="hello-1" style="width: 100%; margin-top: 20px;" data-toggle="modal" data-target="#login_modal">
                    <i class="fas fa-exchange-alt"></i> 
                    &nbsp;&nbsp;&nbsp;Claim Your Business
                </span>
          @endif

          <div class="foot-3" style="margin: 0">
            <?php
            if( isset( Auth::user()->id ) && (Auth::user()->id != "") ) {
               if( $sotore_folowing == "yes" ) {?>
                  <button class="btn btn-success" style="width: 100%; margin-top: 20px;" onclick="follow_store(this)">Follow Us</button>
               <?php
               } else {?>
                  <button class="btn btn-light" style="width: 100%; margin-top: 20px;" onclick="follow_store(this)">Follow Us</button>
               <?php
               }
            } else {?>
               <a href="{{route('login')}}">
                  <button class="btn btn-light" style="width: 100%; margin-top: 20px;" onclick="follow_store(this)">Follow Us</button> 
               </a>
            <?php
            }
            ?>
         </div>

        <input type="hidden" name="copyURL" id="copyURL" value="<?php echo curPageURL();?>">
          <script type="text/javascript">
            function copyURL() {
              var copyText = document.getElementById("copyURL");
              copyText.select();

              var clipboard = navigator.clipboard;
              if (clipboard == undefined) {
                console.log('clipboard is undefined');
                        alert("Clipboard requires a secure origin");
                    } else {
                        clipboard.writeText(copyText.value).then(function() {
                            console.log('Copied to clipboard successfully!');
                            alert("Url copied to clipboard");
                        }, function() {
                            console.error('Unable to write to clipboard. :-(');
                        });
                    } 
                  }
          </script>
    </div>
  

         <!--Claim Modal -->
          <div class="modal fade" id="claim_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title store_name_modal" id="exampleModalLabel">Claim Your Business</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('claimStore') }}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                      @csrf
                      <input type="hidden" name="store_id" id="store_id" class="form-control" value="<?php echo $store_id;?>" />
                     <div class="row">
                          <div class="col-md-12"style="border-right: 3px solid #FFF;">
                              
                              <div class="form-group">
                                  <label>Name of Business <span style="color: red;">*
                                      <strong class="store_name_modal"></strong>
                                  </span>
                                  </label>
                              </div>

                              <div class="form-group">
                                  <label>First Name <span style="color: red;">*</span></label>
                                  <input type="text" name="txtName" class="form-control" placeholder="First Name" value="" required />
                              </div>
                              
                              <div class="form-group">
                                  <label>Last Name </label>
                                  <input type="text" name="txtlName" class="form-control" placeholder="Last Name" value="" />
                              </div>

                              <div class="form-group">
                                  <label>Email <span style="color: red;">*</span></label>
                                  <input type="email" name="txtEmail" class="form-control" placeholder="Email" value="" required />
                              </div>
                              <div class="form-group">
                                <label>Number <span style="color: red;">*</span></label>
                                  <input type="number" name="txtPhone" class="form-control" placeholder="Number" value="" required />
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Claim</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- End Claim Model -->
          
          <!-- Login Modal -->

          <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title store_name_modal" id="exampleModalLabel">LOGIN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('doctordetailslogin') }}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                      @csrf
                      <input type="hidden" name="store_id" id="store_id" class="form-control" value="<?php echo $store_id;?>" />
                     <div class="row">
                          <div class="col-md-12"style="border-right: 3px solid #FFF;">            

                              <div class="form-group">
                                  <label>Email <span style="color: red;">*</span></label>
                                  <input type="email" name="email" class="form-control" placeholder="Email" value="" required />
                              </div>
                              <div class="form-group">
                                <label>Password <span style="color: red;">*</span></label>
                                  <input type="password" name="password" class="form-control" placeholder="Password" value="" required />
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">LOGIN</button>
                  </div>
                    <div class="social-login">
                        <a href="{{ url('auth/claim/facebook') }}" class="fa fa-facebook"><span>Continue with Facebook</span></a>
                        <a href="{{ url('auth/claim/google') }}" class="fa fa-google"><span>Continue with  Google</span></a>
                      </div>
                      <div class="account-access" >
                        <span class="hello-1" data-toggle="modal" data-target="#signup_modal" data-dismiss="modal">><strong>New to Bud & Carriage? Sign up</strong></span>
                      </div>
                </form>
              </div>
            </div>
          </div>

        <!-- End Login Modal -->

        <!-- Signup Modal -->

          <div class="modal fade" id="signup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title store_name_modal" id="exampleModalLabel">LOGIN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('doctordetailssignup') }}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                      @csrf
                      <input type="hidden" name="store_id" id="store_id" class="form-control" value="<?php echo $store_id;?>" />
                     <div class="row">
                          <div class="col-md-12"style="border-right: 3px solid #FFF;">            
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="First Name" required name="f_name" value="{{ old('f_name') }}">
                              @error('f_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Last Name" required name="l_name" value="{{ old('l_name') }}">
                              @error('l_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                              <input type="email" class="form-control" id="email" placeholder="email" required="" name="email" value="{{ old('email') }}">
                              @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="password" required="" name="password"  value="{{ old('password') }}">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SIGNUP</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        <!-- End Signup Modal -->
      </div>
      <script>
         function follow_store(_this) {
               $.ajax({
                     url: "{{ url('follow_store_web').'/'.$delivery_detail->id }}",
                     type:"POST",
                     data:{
                       "_token": "<?php echo csrf_token() ?>"
                     },
                     success:function(response){
                        if( response ) {
                           var response_data = JSON.parse(response);
                           if( response_data.status == "deleted" ) {
                              $(_this).html("Follow Us");
                              $(_this).addClass("btn-light");
                              $(_this).removeClass("btn-success");
                           } else if( response_data.status == "inserted" ) {
                              $(_this).html("Following");
                              $(_this).removeClass("btn-light");
                              $(_this).addClass("btn-success");
                           }
                        }
                     },
               });
         }
      </script>
       <!-- about page end -->
    <div class="col-lg-8 col-md-8 col-sm-12">
      <!-- tabs button-->
      <div class="top-botoom-border">
         <div class="tabbin-1" style="width: 100%;">
            <div class="w3-bar">
                <?php
                  if( isset($product_page_menus) ) {?>
                      <button class="w3-bar-item w3-button active_menu" style="width: 18%;" onclick="openCity(this,'menu')"><?php echo $product_page_menus->menu;?></button>
                      <button class="w3-bar-item w3-button" style="width: 18%;" onclick="openCity(this,'Details')"><?php echo $product_page_menus->details;?></button>
                      <button class="w3-bar-item w3-button" style="width: 18%;" onclick="openCity(this,'deals')"><?php echo $product_page_menus->deals;?></button>
                      <button class="w3-bar-item w3-button" style="width: 18%;" onclick="openCity(this,'Review')"><?php echo $product_page_menus->review;?></button>
                      <button class="w3-bar-item w3-button" style="width: 18%;" onclick="openCity(this,'Media')"><?php echo $product_page_menus->media;?></button>
                    <?php
                  }
                ?>
            </div>
         </div>
      </div>
      <div class="tabinn">
         <div class="tabbin-2">
            <!--    FIRST START TABE -->
            <div id="menu" class="w3-container city">
               <div class="tab-main-pricing-one">
                  <div class="tab-left-pricing" style="padding: 10px;background: #fff;border-radius: 2px;border: 1px solid #999; width: 250px; 
                  ">
                    <div class="ries-bg" style="">
                        <span><strong>Filter by Product Name</strong></span>
                        <span style="position: relative;display: block;width: 100%;"><i class="fas fa-search" style="    float: right;right: 13px;position: absolute;top: 1px;"  onclick="filter_products()"></i>
                        <input type="text" id="search_p_name" name="search_p_name" placeholder="Search" class="form-control"></span>

                        <hr />

                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Price Range</strong></span>
                          <br />
                          <input type="number" placeholder="Start" class="form-control" name="p_range_start" id="p_range_start1" onkeyup="filter_products();" value="" style="width: 48%;float: left;margin-right: 1%;">
                          <input type="number" placeholder="End" class="form-control" name="p_range_end" id="p_range_end" onkeyup="filter_products();" value="" style="width: 48%;float: right;">
                       </div>
                       <br />
                       <hr />
                    </div>
                    <div class="ries-bg">
                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Weight</strong></span>
                          <input type="number" placeholder="Weight" class="form-control" name="weight" id="weight" onkeyup="filter_products();" value="" style="width: 100%;float: right;">
                       </div><br /><hr />
                    </div>
                    <div class="ries-bg">
                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Size</strong></span>
                          <input type="number" placeholder="Size" class="form-control" name="size" id="size" onkeyup="filter_products();" value="" style="width: 100%;float: right;">
                       </div><br /><hr />
                    </div>
                    <div class="ries-bg">
                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Quantity</strong></span>
                          <input type="number" placeholder="Quantity" class="form-control" name="quantity" id="quantity" onkeyup="filter_products();" value="" style="width: 100%;float: right;">
                       </div><br /><hr />
                    </div>
                    <div class="all-product" style="padding: 0">
                        <span style="font-weight: normal;"><strong>Filter by Product Categories</strong></span>
                        <br />
                        @if( isset($products_categories) && count($products_categories) > 0 )
                           @foreach( $products_categories as $key => $each_products_cat )
                              <input type="checkbox" class="p_cat" value="{{$each_products_cat->id}}"
                               onclick="filter_products()"> {{$each_products_cat->name}}<br />
                           @endforeach
                        @endif
                    </div>
                    <hr />
                  </div>
                  <div class="tab-Right-pricing">
                     <script> 
                        var status = 0;
                        function filter_products() {
                           
                           var p_categories = "";
                           $(".p_cat").each(function( index ) {
                              if( $(this).prop("checked") == true ) {
                                 if( p_categories != "" ) {
                                    p_categories += ",";   
                                 }
                                 p_categories += $(this).val();
                              }
                           });
                           if( status == 0 ) {
                              // setTimeout(function(){
                                 var b_category = $('input[name="b_category_fitler"]:checked').val();
                                 var p_range_start1 = $('#p_range_start1').val();
                                 var p_range_end = $('#p_range_end').val();

                                 var weight = $('#weight').val();
                                 var size = $('#size').val();
                                 var quantity = $('#quantity').val();
                                 var sort_by_prices = $('#sort_by_prices option:selected').val();

                                 
                                 if( weight >= 0 ) {
                                 } else {
                                    weight = 0;
                                 }

                                 if( size >= 0 ) {
                                 } else {
                                    size = 0;
                                 }

                                 if( quantity >= 0 ) {
                                 } else {
                                    quantity = 0;
                                 }
                                  
                                  
                                  

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
                                         "weight": weight,
                                         "size": size,
                                         "quantity": quantity,
                                         "sort_by_prices": sort_by_prices,
                                         "p_categories": p_categories,
                                         "product_deal_type": "products",
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
                     <div class="live">
                     </div>
                      <div class="row">
                        <div class="col-md-4">
                          <span style="font-weight: normal;"><strong>Sort By Prices</strong></span>
                        </div>
                        <div class="col-md-12">
                          <select class="form-control" id="sort_by_prices"  onchange="filter_products()">
                            <option value='asc'>Price low to high</option>
                            <option value='desc'>Price high to low</option>
                          </select>
                        </div>
                      </div>
                     <div class="main-do-dos" style="border-bottom: 0px;">
                          

                        <div class="container products_listing">
                              @if( isset($store_products) && count($store_products) > 0 )
                                 @foreach( $store_products as $key => $each_store_products )
                                    <div class="row mb-2" style="background: #ffd53f2e;padding: 14px;">
                                       <div class="col-md-2 text-left pl-0">
                                          @if($each_store_products->image && $each_store_products->image != '')
                                             <img src="{{asset('assets/img/products/').'/'.$each_store_products->image}}" class="img_custom" style="width: 100%;" />
                                             @else
                                             <img src="{{asset('assets/img/products/default/default.jpg')}}" class="img_custom" style="width: 100%;"/>
                                          @endif
                                       </div>
                                       <div class="col-md-7">
                                          <a href="{{url('singleProductDetails').'/'.$each_store_products->id}}" style="color: #306F29;">
                                            <h3><strong>{{$each_store_products->name}}</strong></h3>
                                          </a>
                                          <p>{{$each_store_products->description}}</p>
                                          <p>
                                            <strong>Category: </strong>{{$each_store_products->p_c_name}} <strong> | </strong> 
                                            <strong>Weight: </strong>{{$each_store_products->weight}} <strong> | </strong> 
                                            <strong>Size: </strong>{{$each_store_products->size}} <strong> | </strong>  
                                            <strong>Quantity: </strong>{{$each_store_products->quantity}}
                                          </p>

                                       </div>
                                       <div class="col-md-3 text-right pr-0">
                                          <p style="font-weight: bold; font-size: 18px;">${{$each_store_products->regular_price}}.00</p>
                                       </div>
                                    </div>
                                    <hr style="height:3px;background:#ffd53f;border:none;" />
                                 @endforeach
                              @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="Details" class="w3-container city"style="display:none">
               <div class="main-tabb-cl">
                  <div class="main-tabb-left">
                     <div class="first-time">
                        <div>
                            <h2 class="cg">Introduction</h2>
                            <?php
                            if( $delivery_detail->about_us_information_status == 1 ) {?>
                              <p>{{$delivery_detail->about_us_info}}</p>
                            <?php
                            }?>

                           <h3 class="cg">Amenities</h3>
                           <div class="row">
                               <?php
                               if( isset($store_amenity) && count($store_amenity) > 0 ) {
                                  foreach ($store_amenity as $key => $eah_amenity) {?>
                                    <div class="col-md-2">
                                      <?php
                                      if($eah_amenity->cat_image && $eah_amenity->cat_image != '') {?>
                                          <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/amenities/').'/'.$eah_amenity->cat_image}}" alt="User profile picture" style="width: 70px;display: block;margin: 0 auto; ">
                                      <?php
                                      } else {?>
                                          <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/amenities/default/default.png')}}" style="width: 70px;display: block;margin: 0 auto; " />
                                      <?php
                                      }
                                      ?>
                                      <p style="text-align: center;"> <?php echo $eah_amenity->name;?> </p>
                                    </div>
                              <?php
                               }
                             }
                               ?>
                            </div>
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
                        <?php
                        if( $delivery_detail->show_address_status == 1 ) {?>
                           <div class="text">
                              <p><strong>Address</strong></p>
                              <a href="javascript:void(0);" class="tm-contact-link">
                                 <i class="fas fa-map-marker-alt"></i>
                                 <p>{{$delivery_detail->address}}</p>
                              </a>
                           </div>
                           <?php
                        }?>

                        <div class="number-cg">
                           <?php

                           if( $delivery_detail->phone_number_status == 1 ) {?>
                              <p><strong>Phone Number</strong></p>
                              <a href="tel:{{$delivery_detail->phone}}" class="tm-contact-link"> <i class="fas fa-phone tm-contact-icon"></i>{{$delivery_detail->phone}}</a>
                              <?php
                           }?>
                        </div>
                        <!-- closed  start-->
                        <?php
                        if( $delivery_detail->store_hours_status == 1 ) {?>
                           <div class="closed" style="width: 250px;">
                              <p><strong>Store Hours</strong></p>
                      <?php
                      $hours = $delivery_detail->store_hours;
                      $monday = "";
                      $tuesday = "";
                      $wednesday = "";
                      $thursday = "";
                      $friday = "";
                      $saturday = "";
                      $sunday = "";
                      if( isset($hours) && $hours != '' && $hours != NULL ) {
                          $hours = array(json_decode($hours))[0];
                          $monday = $hours->monday_time;
                          $tuesday = $hours->tuesday_time;
                          $wednesday = $hours->wednesday_time;
                          $thursday = $hours->thursday_time;
                          $friday = $hours->friday_time;
                          $saturday = $hours->saturday_time;
                          $sunday = $hours->sunday_time;
                      }
                      if( $monday != '' && $monday != NULL ) {
                        echo "<strong>Monday: </strong>".$monday;
                        echo "<br />";
                      }

                      if( $tuesday != '' && $tuesday != NULL ) {
                        echo "<strong>Tueday: </strong>".$tuesday;
                        echo "<br />";
                      }

                      if( $wednesday != '' && $wednesday != NULL ) {
                        echo "<strong>Wednesday: </strong>".$wednesday;
                        echo "<br />";
                      }

                      if( $thursday != '' && $thursday != NULL ) {
                        echo "<strong>Thursday: </strong>".$thursday;
                        echo "<br />";
                      }

                      if( $friday != '' && $friday != NULL ) {
                        echo "<strong>Friday: </strong>".$friday;
                        echo "<br />";
                      }

                      if( $saturday != '' && $saturday != NULL ) {
                        echo "<strong>Saturday: </strong>".$saturday;
                        echo "<br />";
                      }

                      if( $sunday != '' && $sunday != NULL ) {
                        echo "<strong>Sunday: </strong>".$sunday;
                        echo "<br />";
                      }?>

                           </div>
                           <?php
                        }?>
                        <!-- closed end -->
                        <div class="main oppinment">
                           <div class="number-cg">
                              <p><strong>Email</strong></p>
                              <a href="javascript:void(0);" class="tm-contact-link"> <i class="fas fa-envelope tm-contact-icon"></i> {{$delivery_detail->email}} </a>
                           </div>
                           <?php
                           if( $delivery_detail->link_to_social_media_status == 1 ) {?>
                              <div class="number-cg">
                                 <a href="javascript:void(0);" class="tm-contact-link"> <i class="fas fa-link tm-contact-icon"></i>{{$delivery_detail->link_with_social_media}} </a>
                              </div>
                              <?php
                           }?>

                           <?php
                           if( $delivery_detail->link_to_website_status == 1 ) {?>
                              <div class="number-cg">
                                 <a href="javascript:void(0);" class="tm-contact-link"> <i class="fas fa-link tm-contact-icon"></i>{{$delivery_detail->link_to_website_listing_page}} </a>
                              </div>
                              <?php
                           }
                           ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--    THIRD START TABE -->
            <div id="deals" class="w3-container city" style="display:none">
               <div class="">
                  <div class="tab-deals">
                      <div class="showhideProducts" style="margin-top: 30px;">
                        <div class="card-header"> All Deals</div>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Crated At</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                  $i = 1;
                                @endphp
                              @foreach($store_deals as $category)
                                <tr>
                                  <th style="font-weight: normal !important;">{{$i++}}</th>
                                  <th style="font-weight: normal !important;">{{$category->name}}</th>
                                  <th style="font-weight: normal !important;">{{$category->description}}</th>
                                  <th style="font-weight: normal !important;">{{$category->image}}</th>
                                  <th style="font-weight: normal !important;">{{$category->regular_price}}</th>
                                  <th style="font-weight: normal !important;">{{$category->created_at}}</th>
                                  <th style="font-weight: normal !important;">
                                    <div class="col-sm-12">
                                      <a href="{{url('singleDealDetails').'/'.$category->id}}">
                                        <button class="btn btn-warning w-100" style="padding: 0px;font-size: 18px;">View</button>
                                      </a>
                                    </div>
                                  </th>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
                        </div>
                      </div>
                  </div>
               </div>
            </div>
            
                  <!-- FORTH START TABE -->
                  <div id="Review" class="w3-container city" style="display:none;">
                     <div class="tab-second">
                        <div class="tab-review">
                     @if(isset(Auth::user()->id))
                           <?php
                           if( $able_to_rate_store == 1 ) {
                              if( !isset($your_review->id) ) {?>
                                  <button class="btn-riew btn-info" onclick="show_form();">Write a review</button>
                                  <div class="container">
                                     <div class="row" style="margin-top:40px;">
                                        <div class="col-md-6 show_hide_form" style="margin: 0 auto; display: none;">
                                           <form action="{{ url('RatingSubmitStoreProcess') }}" method="post" enctype="multipart/form-data" class="profile-form">
                                           @csrf
                                              <input type="hidden" name="store_id" value="{{$store_id}}">
                                              <input type="hidden" name="store_category" value="{{$redirect_controller_name}}">
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
                              <?php
                             }
                           }  else {?>
                              <h2>
                                <?php
                                  echo $able_to_rate_store_message;
                                ?>
                              </h2>
                           <?php
                            }
                           ?>
                        @else
                        <p><a href="{{url('login')}}"><button class="btn btn-info"> Login to write review </button></a></p>
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
                           <style type="text/css">
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
                     <div class="col-md-12">
                        <?php
                        $total_rating_sum = $weighted_review_rating->total_rating_sum;
                        $total_rating_numbers = $weighted_review_rating->total_rating_numbers;
                        if( ($total_rating_sum >= 1) && ($total_rating_numbers >= 1) ) {?>
                           <p style="font-weight: bold;font-size: 33px;color: green;">
                              Weighted Review Rating: <span style="font-size: 50px;"><?php echo $total_rating_sum/$total_rating_numbers; ?></span>
                              <br />
                                <?php
                                $weighted_Rating = $total_rating_sum/$total_rating_numbers;
                                if( $weighted_Rating == 1 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $weighted_Rating == 2 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $weighted_Rating == 3 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $weighted_Rating == 4 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $weighted_Rating == 5 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                <?php
                                }
                                ?>
                           </p>
                        <?php
                        }
                        ?>
                     </div>
                  </div>

                  <?php
                  if( isset($your_review->id) ) {
                     if( $your_review->id != "" ) {?>
                        <h2 class="text-left"><strong style="text-align: left;">Your Review</strong></h2>
                        <div class="row" style="background: #f7f7f7;padding: 10px;border: 1px solid #CCC;border-radius:15px;">
                          <div class="col-sm-3 text-left">
                            @if($your_review->profile_photo_path && $your_review->profile_photo_path != '')
                              <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/profile/').'/'.$your_review->profile_photo_path}}" alt="User profile picture">
                              @else
                              <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/profile/default/default.png')}}" />
                            @endif

                            <div class="review-block-name"><a href="#">{{$your_review->first_name." ".$your_review->last_name}}</a></div>
                            <div class="review-block-date">{{date("d F, Y H:i:s", strtotime($your_review->created_at))}}</div>
                          </div>
                          <div class="col-sm-9 text-left">
                            <div class="review-block-rate">
                              <p class="rating_count rating_each">Rating {{$your_review->rating.".0"}}
                                <br />
                                <?php
                                if( $your_review->rating == 1 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $your_review->rating == 2 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $your_review->rating == 3 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $your_review->rating == 4 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                <?php
                                } else if( $your_review->rating == 5 ) {?>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                <?php
                                }
                                ?>
                              </p>




                              <div style="clear:both;"></div>
                            </div>
                            <div class="review-block-title" style="font-weight: bold;">{{$your_review->heading}}</div>
                            <div class="review-block-description">{{$your_review->description}}</div>
                          </div>
                        </div>
                        <?php
                     }
                  }?>

                  @if( isset($products_data) && count($products_data) > 0 )
                      <h2 class="text-left mt-4"><strong style="text-align: left;">Other Reviews</strong></h2>
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
                              <p class="rating_count rating_each">Rating {{$products_data_main->rating.".0"}}
                                <br />
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
                              <div style="clear:both;"></div>
                            </div>
                            <div class="review-block-title" style="font-weight: bold;">{{$products_data_main->heading}}</div>
                            <div class="review-block-description">{{$products_data_main->description}}</div>
                          </div>
                        </div>
                        @endforeach
                      @endif

                        </div>
                     </div>
                  </div>
                  <!-- FIFTH START TABE -->
                  <div id="Media" class="w3-container city" style="display:none">
                     <div class="tab-second-cl">
                        <div class="tab-detail">
                           <br /><br />
            <style type="text/css">
              .media_images {
                border: 2px solid #CCC;
                border-radius: 10px;
                text-align: center;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
              }
            </style>
            <div class="row">
              @if($store_media)
                @foreach($store_media as $val => $each_store)
                        <?php                          
                          $name_of_media = $each_store->media_name;
                          $info = pathinfo($name_of_media);
                          if( isset($info['extension']) && $info['extension'] != '' ) {?>
                              <div class="col-md-4 mb-4">
                              <?php
                              // pdf,mp4,mov,ogg,avi,flv,wmv
                              if( ($info['extension'] == "jpg") ||  ($info['extension'] == "jpeg") ||  ($info['extension'] == "png") ||  ($info['extension'] == "gif") ) {?>
                                <a href="{{asset('assets/img/store_media/').'/'.$name_of_media}}" target="_blank" class="media_images">
                                  <img src="{{asset('assets/img/store_media/').'/'.$name_of_media}}" style="max-width: 100%; max-height: 100%;">
                                </a>
                              <?php
                              } elseif( ($info['extension'] == "mp4") ||  ($info['extension'] == "mov") ||  ($info['extension'] == "ogg") ||  ($info['extension'] == "avi") ||  ($info['extension'] == "flv") ||  ($info['extension'] == "wmv") ) {?>
                                <video width="320" height="240" controls>
                                  <source src="{{asset('assets/img/store_media/').'/'.$name_of_media}}" type="video/<?php echo $info['extension'];?>">
                                </video>
                              <?php
                              }?>
                              </div>
                          <?php
                          }
                        ?>
                @endforeach
              @endif
              </div>
            </div>
          </div>
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




<?php
if( isset($delivery_detail->seo_title) && $delivery_detail->seo_title != '' ) {?>
  <script> 
    $("head").append("<title><?php echo $delivery_detail->seo_title;?></title>"); 
  </script>
<?php
} else if( isset($delivery_detail->name) && $delivery_detail->name != '' ) {?>
  <script> 
    $("head").append("<title><?php echo $delivery_detail->name;?></title>"); 
  </script>
<?php
} else {?>
  <script> 
    $("head").append("<title>Bud & Carriage</title>"); 
  </script>
<?php
}
?>


<?php
if( isset($delivery_detail->seo_description) && $delivery_detail->seo_description != '' ) {?>
  <script> 
    $("head").append("<meta name='description' content='<?php echo $delivery_detail->seo_description;?>' />"); 
  </script>
<?php
} else if( isset($delivery_detail->delivery_service_info) && $delivery_detail->delivery_service_info != '' ) {?>
  <script> 
    $("head").append("<meta name='description' content='<?php echo $delivery_detail->delivery_service_info;?>' />"); 
  </script>
<?php
} else {?>
  <script> 
    $("head").append("<meta name='description' content='Bud & Carriage' "); 
  </script>
<?php
}
?>


  <?php
  if( isset($delivery_detail->seo_keyword) && $delivery_detail->seo_keyword != '' ) {?>
    <script> 
      $("head").append("<meta name='keywords' content='<?php echo $delivery_detail->seo_keyword;?>' />"); 
    </script>
  <?php
  } else {?>
    <script> 
      $("head").append("<meta name='keywords' content='Bud & Carriage' "); 
    </script>
  <?php
  }
  ?>

  <script type="text/javascript">
    function get_store_name_id() {
      var store_id = $("#store_id").val();
      var store_name = $(".store_name h1").html();
      $(".store_name_modal").html(store_name+" ("+store_id+")");
    }
  </script>
@include('web.includes.footer');
