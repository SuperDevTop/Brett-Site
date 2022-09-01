@include('web.includes.header');

<style type="text/css">
  #map{
    width: 100%;
    max-width: 100%;
    height: 700px;
  }
  .stores_main_container {
    border: 3px solid #306F29;
    position: absolute;
    top: 15px;
    left: 81px;
    height: 667px;
    border-radius: 6px;
    background: #FFF;
    padding-bottom: 50px;
    overflow-y: scroll;
  }
  .store_name{
      color: #000;
      font-weight: 600;
      text-decoration: none !important;
    }
    .store_address {
      color: rgb(96, 100, 111);
      font-weight: normal;
    }
    .store_maps {
      text-decoration: none;
    }
    .store_maps:hover {
      text-decoration: none;
    }
    .view_store_details_sub{
      border-radius: 50px;
      width: 100%;
      background: #306f29d6 !important;
    }
    .view_store_details_sub:hover {
        background: #306F29 !important;
        color: #FFF !important;
    }
    .styling_each {
  height: 350px;
}

.select2-container--default.select2-container--focus .select2-selection--multiple{
    border: 1px solid #CCC !important;
    height: 38px !important;
}
.select2-container--default .select2-selection--multiple {
    border: 1px solid #CCC !important;
    height: 38px !important;
}
</style>

<div class="container-bg-home">
  <div class="f-container mt mb-5">
    <div class="custom-container">

      <div class="profile-setting">
        <?php
          if( isset($banners_data) && $banners_data != '' ) {
            if( count($banners_data) > 0 ) {?>
              <h4 style="text-align: center;">Advertisement banner</h4>
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                      foreach ($banners_data as $key => $each_bannner) {
                        if( $each_bannner->type == "web" && $each_bannner->location == "map_page" ) {
                          $active = "";
                          if( $key == 0 ) {
                            $active = "active";
                          }
                          ?>
                          <div class="carousel-item <?php echo $active;?>">

                            <?php
                              $banner_url = "javascript:void(0);";
                              if( $each_bannner->redirect_url != '' || $each_bannner->redirect_url != NULL ) {
                                  $banner_url = $each_bannner->redirect_url;
                              }
                            ?>
                            <a href="<?php echo $banner_url;?>">
                              <img class="d-block w-100 styling_each" src="{{asset('assets/img/advert_banners/').'/'.$each_bannner->banner_image}}" alt="First slide">
                            </a>
                          </div>
                          <?php
                        }
                      }?>
                </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <?php
            }
          }
        ?>
    </div>
  </div>
</div>
</div>

<div class="container-fluid p-0">
  <div class="container mb-4">
    <div class="row">

      <div class="col-md-12">
        <?php
        if( isset($_COOKIE['city_state_name']) ) {
          if( $_COOKIE['city_state_name'] != "" ) {?>
              <p style="text-align: center;font-size: 20px;color: #FFC107;"><strong>Marijuana Listings in: </strong><?php echo $_COOKIE['city_state_name'];?></p>
          <?php
          }
        }
        ?>
      </div>
      
      <div class="col-md-12">
        <form>

          <div class="col-md-12 p-0 text-center">   
              <!-- <label style="font-size: 18px;"><strong> Business Categories </strong></label><br /> -->
              
              <button type="button" class="bus_cats btn btn-info" onclick="filter_dispensary(this, 'all');" name="business_category" value="" id="business_category">All</button>

              <?php
              $business_cat_get = "";
              if( isset($_GET['business_cat']) && $_GET['business_cat'] != '' ) {
                $business_cat_get = $_GET['business_cat'];
              }
              ?>
              @if( isset($all_categories) && count($all_categories) > 0 )
                @foreach( $all_categories as $key => $each_cat )
                    <?php
                      $cat_class = "";
                      if($each_cat->id == 1) {
                        $cat_class = "type_doctors";
                      } else if($each_cat->id == 2) {
                        $cat_class = "type_dispensaries";
                      } else if($each_cat->id == 3) {
                        $cat_class = "type_deliveries";
                      }
                    ?>

                   <button type="button" class="bus_cats <?php echo $cat_class;?> <?php if($business_cat_get == $each_cat->id) {echo "btn btn-primary active";} else {echo "btn btn-info";} ?>" onclick="filter_dispensary(this, '{{$each_cat->id}}');" name="business_category" value="{{$each_cat->id}}" id="business_category">{{$each_cat->name}}</button>
                @endforeach
              @endif
            </div>
            <br />

          <div class="form-row">
            <div class="col-md-12 mb-4">
              <label><strong>Search Stores</strong></label>
              <?php
              $store_name_get = "";
              if( isset($_GET['store_name']) && $_GET['store_name'] != '' ) {
                $store_name_get = $_GET['store_name'];
              }
              ?>
              <input type="text" name="store_name_description" class="form-control" id="store_name_description" onkeyup="filter_dispensary();" value="<?php echo $store_name_get;?>" placeholder="Search By Store Names">
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-3">
              <label><strong>Product Categories</strong></label>
              <?php
              $product_cat_get = "";
              if( isset($_GET['product_cat']) && $_GET['product_cat'] != '' ) {
                $product_cat_get = $_GET['product_cat'];
              }
              ?>
              <select class="form-control" id="b_cat_main" onchange="filter_dispensary();">
                  <option value="">Select Product Category</option>
                  @if( isset($all_p_categories) && count($all_p_categories) > 0 )
                    @foreach( $all_p_categories as $key => $each_b_cat )
                      <option <?php if($product_cat_get == $each_b_cat->id) {echo "selected";} ?> value="{{$each_b_cat->id}}">{{$each_b_cat->name}}</option>
                    @endforeach
                  @endif
              </select>
            </div>



            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.js-example-basic-multiple').select2();
                });
            </script>

            <div class="col-md-3">
              <label><strong>Amenities</strong></label>
              <?php
              $amenity_get = "";
              if( isset($_GET['amenity']) && $_GET['amenity'] != '' ) {
                $amenity_get = $_GET['amenity'];
              }
              ?>
              <select class="form-control js-example-basic-multiple" multiple id="amenitites" onchange="filter_dispensary();">
                  @if( isset($all_amenities) && count($all_amenities) > 0 )
                    @foreach( $all_amenities as $key => $each_amenity )
                      <option <?php if($amenity_get == $each_amenity->id) {echo "selected";} ?> value="{{$each_amenity->id}}">{{$each_amenity->name}}</option>
                    @endforeach
                  @endif
              </select>
            </div>

            <div class="col-md-3">
              <label><strong> View Type </strong></label>
              <select class="form-control" id="store_view" onchange="filter_dispensary();">
                  <option value="">Select View Type</option>
                  <option value="grid_view" <?php if($grid_view == "grid_view"){echo "selected";} ?>>Grid</option>
                  <option value="map_view" <?php if($grid_view == "map"){echo "selected";} ?>>Map</option>
              </select>
            </div>

            <div class="col-md-3">
              <label><strong>Distance</strong></label>
              <select class="form-control" id="distance" name="distance" onchange="filter_dispensary();">
                <option value="10" <?php if($portal_radius = '10' ) { echo "selected"; } ?>>10 Miles</option>
                <option value="20" <?php if($portal_radius = '20' ) { echo "selected"; } ?>>20 Miles</option>
                <option value="30" <?php if($portal_radius = '30' ) { echo "selected"; } ?>>30 Miles</option>
                <option value="50" <?php if($portal_radius = '50' ) { echo "selected"; } ?>>50 Miles</option>
                <option value="100" <?php if($portal_radius = '100' ) { echo "selected"; } ?>>100 Miles</option>
                <option value="200" <?php if($portal_radius = '200' ) { echo "selected"; } ?>>200 Miles</option>
                <option value="500" <?php if($portal_radius = '500' ) { echo "selected"; } ?>>500 Miles</option>
              </select>
            </div>

          </div>
        </form>
      </div>
      <div class="col-md-6"></div>
    </div>
  </div>
</div> 
<div class="container-fluid main_store_container">
 <div class="row ajax_load" style="position:relative; height: 30" ></div>
  </div>
<style type="text/css">
  .activebusinesscat {
    background: #306f29 !important;
    color: #FFF !important;
    border: 1px solid #FFF;
}
</style>


<script type="text/javascript">
  var element_store_type = "";
  var store_type_js = "";
</script>


<?php
  if( isset($_GET['store']) && $_GET['store'] != '' ) {?>
    <script type="text/javascript">
        element_store_type =  $('.'+"<?php echo "type_".$_GET['store']; ?>");
    </script>
  <?php 
  }

  if( isset($_GET['store']) && $_GET['store'] != '' ) {
      if( $_GET['store'] == "deliveries" ) {?>
        <script type="text/javascript">
            store_type_js =  3;
        </script>
      <?php
      } else if( $_GET['store'] == "dispensaries" ) {?>
        <script type="text/javascript">
            store_type_js =  2;
        </script>
      <?php
      } else if( $_GET['store'] == "doctors" ) {?>
        <script type="text/javascript">
            store_type_js =  1;
        </script>
      <?php
      }
  }





  $previou_string = "";
  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if( $actual_link != '' ) {
    $exploded = explode("search-filters",$actual_link);
    if( isset($exploded[0])  ) {
      if( $exploded[0] != '' ) {
        $previou_string = $exploded[0]."search-filters/";
      }
    }
  }
?>

@include('web.includes.footer');
<script>
var business_cat_val = "";
var business_category = "";
function filter_dispensary(_this, business_cat_val) {
  

    
  var distance = $('#distance option:selected').val();
  var plain_search = $('#store_name_description').val();
  var p_cat = $('#b_cat_main option:selected').val();
  var amenitites= $("#amenitites").val();
  var listing_type = $("#store_view option:selected").val();

  var atach_url = "map";
  if( listing_type != '' ) {
    if( listing_type == "grid_view" ) {
      $(".main_store_container").removeClass("container-fluid");
      $(".main_store_container").addClass("container");
      // atach_url = "<?php echo $previou_string;?>"+"list";
    } else {
      $(".main_store_container").addClass("container-fluid");
      $(".main_store_container").removeClass("container");
      // atach_url = "<?php echo $previou_string;?>"+"map";
    }
  } else {
    // atach_url = "<?php echo $previou_string;?>"+"map";
  }

  var new_url = atach_url;
  // window.history.pushState("data","Title",new_url);

  if( business_cat_val ) {
    if( business_cat_val != '' ) {
      if( business_cat_val != 'undefined' ) {
        business_category = business_cat_val;  
        $(".bus_cats").removeClass("activebusinesscat");
        $(_this).addClass("activebusinesscat");
      }
    }
  }
  $.ajax({
    url: "{{ url('get_dispesary_with_maps') }}",
    type:"POST",
    data:{
      "p_cat": p_cat,
      "plain_search": plain_search,
      "amenitites": amenitites,
      "distance": distance,
      "listing_type": listing_type,
      "business_category": business_category,
      "_token": "<?php echo csrf_token() ?>"
    },
    success:function(response){
        $(".ajax_load").html($.parseJSON(response).html);
        initMap();
    },  
  });

}

// console.log($(element_store_type));
// console.log(store_type_js);


filter_dispensary($(element_store_type),store_type_js);
</script>