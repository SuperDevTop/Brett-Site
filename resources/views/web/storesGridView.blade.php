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
    .styling_each {
  height: 350px;
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
                        if( $each_bannner->type == "web" && $each_bannner->location == "grid_page" ) {
                          $active = "";
                          if( $key == 0 ) {
                            $active = "active";
                          }
                          ?>
                          <div class="carousel-item <?php echo $active;?>">
                            <img class="d-block w-100 styling_each" src="{{asset('assets/img/advert_banners/').'/'.$each_bannner->banner_image}}" alt="First slide">
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
        <h2>Filters</h2>
      </div>
    </div>
    <div class="row">

      <div class="col-md-12">
        <?php
        if( isset($_COOKIE['city_state_name']) ) {
          if( $_COOKIE['city_state_name'] != "" ) {?>
              <p><strong>Marijuana Listings</strong> in: <?php echo $_COOKIE['city_state_name'];?></p>
          <?php
          }
        }
        ?>
      </div>
      
      <div class="col-md-9">
        <form>

          <div class="col-md-12 p-0">
              <label style="font-size: 18px;"><strong>Business Categories</strong></label><br />
              @if( isset($all_categories) && count($all_categories) > 0 )
                @foreach( $all_categories as $key => $each_cat )
                  <input type="radio" onchange="filter_dispensary();" name="b_cat_main" id="b_cat_main" value="{{$each_cat->id}}"> {{$each_cat->name}} <br />
                @endforeach
              @endif
            </div>
            <br />

          <div class="form-row">
            <!-- <div class="col-md-4">
              <label>Business Categories</label>
              <select class="form-control" id="business_category" onchange="filter_dispensary();">
                  <option value="">Select Business Category</option>
                  @if( isset($all_categories) && count($all_categories) > 0 )
                    @foreach( $all_categories as $key => $each_cat )
                      <option value="{{$each_cat->id}}">{{$each_cat->name}}</option>
                    @endforeach
                  @endif
              </select>
            </div> -->
            <div class="col-md-4">
              <label>Product Categories</label>
              <select class="form-control" id="p_cat" onchange="filter_dispensary();">
                  <option value="">Select Product Category</option>
                  @if( isset($all_p_categories) && count($all_p_categories) > 0 )
                    @foreach( $all_p_categories as $key => $each_b_cat )
                      <option value="{{$each_b_cat->id}}">{{$each_b_cat->name}}</option>
                    @endforeach
                  @endif
              </select>
            </div>
            <div class="col-md-4">
              <label>Amenities</label>
              <select class="form-control" id="amenitites" onchange="filter_dispensary();">
                  <option value="">Select Amenity</option>
                  @if( isset($all_amenities) && count($all_amenities) > 0 )
                    @foreach( $all_amenities as $key => $each_amenity )
                      <option value="{{$each_amenity->id}}">{{$each_amenity->name}}</option>
                    @endforeach
                  @endif
              </select>
            </div>

            <div class="col-md-4">
              <label>Plain Search</label>
              <input type="text" name="store_name_description" class="form-control" id="store_name_description" onkeyup="filter_dispensary();">
            </div>

          </div>
        </form>
      </div>
      <div class="col-md-6"></div>
    </div>
  </div>

  <div class="container main_store_container">
    <div class="row ajax_load" style="position: relative;" ></div>
  </div>
</div>    
@include('web.includes.footer');
<script>
function filter_dispensary() {
  var plain_search = $('#store_name_description').val();
  var p_cat = $('input[name="b_cat_main"]:checked').val();
  var amenitites= $("#amenitites option:selected").val();
  var business_category= $("#business_category option:selected").val();

  $.ajax({
    url: "{{ url('get_dispesary_with_grid') }}",
    type:"POST",
    data:{
      "p_cat": p_cat,
      "plain_search": plain_search,
      "amenitites": amenitites,
      "business_category": business_category,
      "_token": "<?php echo csrf_token() ?>"
    },
    success:function(response){
        $(".ajax_load").html($.parseJSON(response).html);
        initMap();
    },  
  });

}
filter_dispensary();
</script>