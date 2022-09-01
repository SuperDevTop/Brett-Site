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

<div class="container">
  
  <?php
  $plan_name = "";
  if( $category_id == 1 ) {
    $plan_name = "Doctors";
  } else if( $category_id == 2 ) {
    $plan_name = "Dispensaries";
  } else if( $category_id == 3 ) {
    $plan_name = "Deliveries";
  }?>

  <div class="row">
    <div class="col-md-12 p-5">
      <h2 class="text-center" style="color: #306f29;font-weight: bold;font-size: 39px;"><?php echo $plan_name;?> Subscription Plans</h2>
    </div>
  </div>
  
  <div class="row">
  <?php
  if( (isset($plans) && count($plans) > 0) ) {?>
       
          @if( isset($plans) && count($plans) > 0 )
            @foreach( $plans as $key => $dispensary_plans )
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
            @endforeach
          @endif
  <?php
  } else {?>
      <div class="p-5 w-100">
        <h2 class="text-center text-danger">No Subscription Plans Found.</h2>
        <p class="text-center"> If you are system administrator, you can add new Plans from admin panel.</p>
      </div>
  <?php
  }
  ?>
  </div>
</div>

<script>
  $(function () {
    $('#myTab li:last-child a').tab('show')
  })
</script>
</div>


@include('web.includes.footer');