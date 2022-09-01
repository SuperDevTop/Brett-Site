@include('web.includes.header');

<style type="text/css">
  #myTab li.nav-item {
    border: 2px solid #306f29;
    border-bottom: 0;
    width: 200px;
    text-align: center;
    font-weight: bold;
    text-transform: capitalize;
  }
  .nav-item.active, .nav-item.active a {
    background-color: #306f29;
    color: #FFF !important;
  }
  #myTab li.nav-item a {
    color: #000;
    font-weight: bold;
    font-size: 17px;
    text-transform: uppercase;
    display: block !important;
    padding: 15px 0;
  }
</style>


<?php
if( (isset($dispensary_plan) && count($dispensary_plan) > 0) || (isset($doctors_plan) && count($doctors_plan) > 0) || (isset($delivery_plan) && count($delivery_plan) > 0)  ) {?>

<div class="container">
   <ul class="nav" id="myTab" role="tablist" style="padding: 0;">
      <li class="nav-item ">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dispansaries</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Doctors </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Delivery Service</a>
      </li>
    </ul>

<div class="tab-content w-100" style="border: 2px solid #306f29;padding: 25px;border-radius: 10px;">
   
  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
      

      <?php
        if( isset($dispensary_plan) && count($dispensary_plan) > 3 ) {?>
          <div class="brand-2" style="float:right;width:18%;margin-bottom: 27px;">
            <a href="{{url('storePlans/2')}}" class="view_more_all" style="    padding: 11px;">View All Plans <i class="fas fa-greater-than"></i></a>
          </div>
          <div style="clear: both;"></div>
        <?php
        }
        ?>
      <div class="row">
       
        @if( isset($dispensary_plan) && count($dispensary_plan) > 0 )
          @foreach( $dispensary_plan as $key => $dispensary_plans )
          <?php
          if( $key+1 <= 3 ) {?>
            <div class="col-md-4 col-sm-12 pb-5">
              <div class="first-price">
                 <div class="pracing-card">
                    
                    @if($dispensary_plans->image && $dispensary_plans->image != '')
                      <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/plans/').'/'.$dispensary_plans->image}}" alt="User profile picture"  style="height: 100px;margin-bottom: 23px !important;display: block;margin: 0 76px;">
                    @endif

                    <h3 class="pricing-card-title">{{$dispensary_plans->plane_name}}</h3>
                    <p class="pricing-card-price">{{"$".$dispensary_plans->price}}</p>
                    <p>{{$dispensary_plans->description}}</p>
                    @if( isset($dispensary_plans->plan_options_checkboxes_value) && $dispensary_plans->plan_options_checkboxes_value != '' )
                      <ul class="pricing-bg-lg">
                        <?php $each_counter = 0;?>
                        @foreach( (array)json_decode($dispensary_plans->plan_options_checkboxes_value) as $key => $plans_data )
                          <?php
                          if( $plans_data != '' && $plans_data != NULL && $plans_data != [] ) {
                          if( $key == "feature_listing_x_per_day" ) {?>
                            <li><?php
                              echo "<strong>".++$each_counter."-  </strong>".$plans_data." Feature Listing Per Day";
                            ?></li>
                          <?php
                          } else if( $key == "products_to_show" ) {?>
                            <li><?php
                              echo "<strong>".++$each_counter."-  </strong>".$plans_data." Products to show";
                            ?></li>
                          <?php
                          } else {?>
                            <li><?php
                                echo "<strong>".++$each_counter."- </strong>".$plans_data;
                            ?></li>
                          <?php
                          }
                        }
                          ?>
                        @endforeach
                      </ul>
                    @endif
                 </div>
                 <div class="buy-now">
                   <div class="btn-button-lg">
                      <a href="{{url('buyPlan/'.$dispensary_plans->id)}}" class="btn-bg-cg"><button type="button" class="btn btn-warning">Buy now</button></a>
                   </div>
                 </div>
              </div>
            </div>
          <?php
          }?>
          @endforeach
        @endif

      </div>
  </div>

<!-- second tab start -->
<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

  <div class="col-md-12">
      <h2>Plan Description</h2>
      <p style="text-align: justify;">
        <?php echo $plan_cat_details->doctor_detail;?>
      </p>
   </div>

  <?php
    if( isset($doctors_plan) && count($doctors_plan) > 3 ) {?>
      <div class="brand-2" style="float:right;width:18%;margin-bottom: 27px;">
        <a href="{{url('storePlans/1')}}" class="view_more_all" style="    padding: 11px;">View All Plans <i class="fas fa-greater-than"></i></a>
      </div>
      <div style="clear: both;"></div>
    <?php
    }
  ?>
  <div class="row">
     @if( isset($doctors_plan) && count($doctors_plan) > 0 )
          @foreach( $doctors_plan as $key => $doctors_plans )
          <?php
          if( $key+1 <= 3 ) {?>
            <div class="col-md-4 col-sm-12 pb-5">
              <div class="first-price">
                 <div class="pracing-card">
                    @if($doctors_plans->image && $doctors_plans->image != '')
                      <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/plans/').'/'.$doctors_plans->image}}" alt="User profile picture"  style="height: 100px;margin-bottom: 23px !important;display: block;margin: 0 76px;">
                      @else
                      <div style="height: 100px;margin-bottom: 23px !important;display: block;margin: 0 76px;"></div>
                    @endif
                    <h3 class="pricing-card-title">{{$doctors_plans->plane_name}}</h3>
                    <p class="pricing-card-price">{{"$".$doctors_plans->price}}</p>
                    <p>{{$doctors_plans->description}}</p>
                    <?php $each_counter = 0;?>
                    @if( isset($doctors_plans->plan_options_checkboxes_value) && $doctors_plans->plan_options_checkboxes_value != '' )
                      <ul class="pricing-bg-lg">
                        @foreach( (array)json_decode($doctors_plans->plan_options_checkboxes_value) as $key => $plans_data )

                            <?php
                            if( $plans_data != '' && $plans_data != NULL && $plans_data != [] ) {
                              if( $key == "feature_listing_x_per_day" ) {?>
                                <li><?php
                                  echo "<strong>".++$each_counter."-  </strong>".$plans_data." Feature Listing Per Day";
                                ?></li>
                              <?php
                              } else if( $key == "products_to_show" ) {?>
                                <li><?php
                                  echo "<strong>".++$each_counter."-  </strong>".$plans_data." Products to show";
                                ?></li>
                              <?php
                              } else {?>
                                <li><?php
                                    echo "<strong>".++$each_counter."- </strong>".$plans_data;
                                ?></li>
                              <?php
                              }
                            }
                              ?>
                        @endforeach
                      </ul>
                    @endif
                 </div>
                 <div class="buy-now">
                   <div class="btn-button-lg">
                      <a href="{{ url('buyPlan/'.$doctors_plans->id)}}" class="btn-bg-cg"><button type="button" class="btn btn-warning">Buy now</button></a>
                   </div>
                 </div>
              </div>
            </div>
          <?php
          }?>
          @endforeach
        @endif
  </div>
</div>
<!-- third tab start -->
<div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
    
  <div class="col-md-12">
      <h2>Plan Description</h2>
      <p style="text-align: justify;">
        <?php echo $plan_cat_details->delivery_detail;?>
      </p>
   </div>

  <?php
    if( isset($delivery_plan) && count($delivery_plan) > 3 ) {?>
      <div class="brand-2" style="float:right;width:18%;margin-bottom: 27px;">
        <a href="{{url('storePlans/3')}}" class="view_more_all" style="padding: 11px;">View All Plans <i class="fas fa-greater-than"></i></a>
      </div>
      <div style="clear: both;"></div>
    <?php
    }
  ?>
  <div class="row">
    @if( isset($delivery_plan) && count($delivery_plan) > 0 )
          @foreach( $delivery_plan as $key => $delivery_plans )
          <?php
          if( $key+1 <= 3 ) {?>
            <div class="col-md-4 col-sm-12 pb-5">
              <div class="first-price">
                 <div class="pracing-card">
                    @if($delivery_plans->image && $delivery_plans->image != '')
                      <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/plans/').'/'.$delivery_plans->image}}" alt="User profile picture"  style="height: 100px;margin-bottom: 23px !important;display: block;margin: 0 76px;">
                    @endif
                    <h3 class="pricing-card-title">{{$delivery_plans->plane_name}}</h3>
                    <p class="pricing-card-price">{{"$".$delivery_plans->price}}</p>
                    <p>{{$delivery_plans->description}}</p>
                    <?php $each_counter = 0;?>
                    @if( isset($delivery_plans->plan_options_checkboxes_value) && $delivery_plans->plan_options_checkboxes_value != '' )
                      <ul class="pricing-bg-lg">
                        @foreach( (array)json_decode($delivery_plans->plan_options_checkboxes_value) as $key => $plans_data )
                            <?php
                            if( $plans_data != '' && $plans_data != NULL && $plans_data != [] ) {
                            if( $key == "feature_listing_x_per_day" ) {?>
                              <li><?php
                                echo "<strong>".++$each_counter."-  </strong>".$plans_data." Feature Listing Per Day";
                              ?></li>
                            <?php
                            } else if( $key == "products_to_show" ) {?>
                              <li><?php
                                echo "<strong>".++$each_counter."-  </strong>".$plans_data." Products to show";
                              ?></li>
                            <?php
                            } else {?>
                              <li><?php
                                  echo "<strong>".++$each_counter."- </strong>".$plans_data;
                              ?></li>
                            <?php
                            }
                          }
                            ?>
                        @endforeach
                      </ul>
                    @endif
                 </div>
                 <div class="buy-now">
                   <div class="btn-button-lg">
                      <a href="{{ url('buyPlan/'.$delivery_plans->id)}}" class="btn-bg-cg"><button type="button" class="btn btn-warning">Buy now</button></a>
                   </div>
                 </div>
              </div>
            </div>
          <?php
          }?>
          @endforeach
        @endif
  </div>
</div>

</div>

<?php
} else {?>
  <div class="p-5">
        <h2 class="text-center text-danger">No Subscription Plans Found.</h2>
        <p class="text-center"> If you are system administrator, you can add new Plans from admin panel.</p>
      </div>
<?php
}
?>

<script>
  $(function () {
    $('#myTab li:last-child a').tab('show')
  })
</script>
</div>


@include('web.includes.footer');