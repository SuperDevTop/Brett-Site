<style type="text/css">
  .menu_options_link {
    border: 2px solid #CCC;
    padding: 7px;
    border-radius: 99px;
    width: 45px;
    height: 45px;
    text-align: center;
    line-height: 30px;
    color: #51864B;
    font-size: 23px;
    width: 100%;
  }
  .menu_options_link1 {
    border: 2px solid #CCC;
    padding: 7px;
    border-radius: 99px;
    width: 45px;
    height: 45px;
    text-align: center;
    line-height: 30px;
    color: #51864B;
    font-size: 23px;
  }
  .menu_options_link:hover {
    background: #306F29;
    color: #FFF;
  }
</style>
<div class="container-fluid">
  <div class="row mt-4">
      <div class="col-md-12">
        <a href="javascript:void(0);" onclick="back_to_listing();" class="btn btn-success w-100 pl-2" style="background: #306F29; text-align: left;">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Dispensaries
        </a>
      </div>
    </div>  
</div>
<script>
    function back_to_listing() {
      $(".stores_details").hide();
      $(".business_lising").fadeIn(1000);
    }
</script>



<div class="container mt-3">
    <div class="row">
          <div class="col-md-5">
              @if(isset($data['store_data'][0]->logo) && $data['store_data'][0]->logo != '')
                  <img src="{{asset('assets/img/stores').'/'.$data['store_data'][0]->logo}}" style="width: 100%;border-radius: 6px;">
                @else
                  <img src="{{asset('assets/img/stores/default/default.png')}}" style="width: 100%;border-radius: 6px;">
              @endif
          </div>
          <div class="col-md-7">  
            <h5 class="store_name">{{$data['store_data'][0]->name}}</h5>
            <p class="store_address">Dispensary . Recreational</p>

                <?php
                if( $data['store_data'][0]->category == 1 ) {?>
                  <a href="{{url('doctorDetails').'/'.$data['store_data'][0]->id}}" class="btn btn-success w-100" style="background: #306F29">
                    <i class="fa fa-eye"></i> View
                  </a>
                <?php
                } else if( $data['store_data'][0]->category == 2 ) {?>
                  <a href="{{url('dispensaryDetails').'/'.$data['store_data'][0]->id}}" class="btn btn-success w-100" style="background: #306F29">
                    <i class="fa fa-eye"></i> View
                  </a>
                <?php
                } else if( $data['store_data'][0]->category == 3 ) {?>
                  <a href="{{url('deliveryDetails').'/'.$data['store_data'][0]->id}}" class="btn btn-success w-100" style="background: #306F29">
                    <i class="fa fa-eye"></i> View
                  </a>
                <?php
                }
                ?>
            

          </div>
    </div>
    <hr />
    <style type="text/css">
      .each_class {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-size: 12px;
        word-break: break-all;
        text-align: center;
        margin-top: 5px;
        margin-bottom: 12px;
      }
    </style>

    <div class="row mt-4">
      <div class="col-md-4 each_class">
        <a href="tel:{{$data['store_data'][0]->phone}}" class="menu_options_link" title="Phone Call">
            <i class="fa fa-phone" aria-hidden="true"></i>
        </a>
        <span>Phone</span>
      </div>
      <div class="col-md-4 each_class">
        <a href="https://www.google.com/maps/dir/?api=1&destination={{$data['store_data'][0]->address}}" target="_blank" class="menu_options_link" title="Location">
            <i class="fa fa-globe" aria-hidden="true"></i>
        </a>
        <span>Location</span>
      </div>
      <div class="col-md-4 each_class">
        <a href="javascript:void(0);" class="menu_options_link" title="Reviews">
            <i class="fa fa-star" aria-hidden="true"></i>
        </a>
        <span>Reviews</span>
      </div>
      </div>
    </div>
    <hr />
    <div class="row mt-4">
      <div class="col-md-12">
          <h4><strong>Hours of operation</strong></h4>
          <?php
          $hours = $data['store_data'][0]->store_hours;
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
          <!-- <p style="width:256px;line-height:39px;margin-left:39px;">{{$data['store_data'][0]->store_hours}}</p> -->
      </div>
    </div>
    <hr />
    <div class="row mt-4">
      <div class="col-md-12">
        <h4><strong>Business Description</strong></h4>
        <p>{{$data['store_data'][0]->about_us_info}}</p>
      </div>

      <div class="col-md-12">
        <h4><strong>Delivery Service Information</strong></h4>
        <p>{{$data['store_data'][0]->delivery_service_info}}</p>
      </div>

    </div>
    <hr />
    <div class="row mt-4">
      <div class="col-md-12">
        <h4><strong>Amenities</strong></h4>
      </div>
      <?php
      $amenities_found = "";
      if( isset($data['store_amenity'])  ) {
        if( $data['store_amenity'] != '' ) {
          if( count($data['store_amenity']) > 0 ) {
              $amenities_found = "found";    
          }
        }
      }

      if( $amenities_found == 'found' ) {
        foreach ($data['store_amenity'] as $key => $each_amenity) {?>
            <div class="col-md-4 each_class">
              <img src="{{asset('assets/img/amenities').'/'.$each_amenity->cat_image}}" class="menu_options_link1" />
              <span>{{$each_amenity->name}}</span>
            </div>
        <?php
        }
      } else {?>
        <div class="col-md-12">
            <p>No Amenitites Found!</p>
        </div>
      <?php
      }

      ?>

    </div>
    <hr />
    <div class="row mt-4">
      <div class="col-md-12">
        <?php
        if( $data['store_data'][0]->category == 1 ) {?>
          <a href="{{url('doctorDetails').'/'.$data['store_data'][0]->id}}" class="btn btn-success w-100" style="background: #306F29">
            View Full Listing Page
          </a>
        <?php
        } else if( $data['store_data'][0]->category == 2 ) {?>
          <a href="{{url('dispensaryDetails').'/'.$data['store_data'][0]->id}}" class="btn btn-success w-100" style="background: #306F29">
            View Full Listing Page
          </a>
        <?php
        } else if( $data['store_data'][0]->category == 3 ) {?>
          <a href="{{url('deliveryDetails').'/'.$data['store_data'][0]->id}}" class="btn btn-success w-100" style="background: #306F29">
            View Full Listing Page
          </a>
        <?php
        }
        ?>
      </div>
    </div>

</div>
