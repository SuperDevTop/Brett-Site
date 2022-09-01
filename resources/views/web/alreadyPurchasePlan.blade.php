@include('web.includes.header');

<div class="container">
  <div class="Rtunin">
<div class="row">
          <div class="col-sm-12">
            <div class="order-rdit">
              
              <div class="from-ordd">
                      

                @if( isset($plans_data) && count($plans_data) > 0 )
          @foreach( $plans_data as $key => $dispensary_plans )

          <h3 class="ppp" style="color: #FFF;padding-bottom: 11px;">You already purchased a Plan
              <button class="btn btn-danger float-right" onclick="confirm_cancel('<?php echo $dispensary_plans->id;?>')"> Cancel Subscription </button>
          </h3>

          <div class="col-md-6 col-sm-6 pb-5">


            <div class="first-price">
               <div class="pracing-card">
                    
                  @if($dispensary_plans->image && $dispensary_plans->image != '')
                    <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/plans/').'/'.$dispensary_plans->image}}" alt="User profile picture"  style="height: 100px;margin-bottom: 23px !important;display: block;margin: 2px 152px;">
                  @endif
                  <?php
                  $plane_name = $dispensary_plans->plane_name;
                  $plan_price = $dispensary_plans->price;
                  ?>
                  <h3 class="pricing-card-title">{{$dispensary_plans->plane_name}}</h3>
                  <p>{{$dispensary_plans->description}}</p>
                  @if( isset($dispensary_plans->plan_options_checkboxes) && $dispensary_plans->plan_options_checkboxes != '' )
                    <ul class="pricing-bg-lg">
                      <?php $each_counter = 0;?>
                      @foreach( json_decode($dispensary_plans->plan_options_checkboxes) as $key => $plans_data )
                        <?php
                        if( $key == "feature_listing_x_per_day" ) {?>
                          <li><?php
                            echo "<strong>".++$each_counter."-  </strong>".$plans_data." Feature Listing Per Day";
                          ?></li>
                        <?php
                        } else if( $key == "x_products_to_show" ) {?>
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
                        ?>
                      @endforeach
                    </ul>
                  @endif
               </div>
            </div>
          </div>
          @endforeach
        @endif

            
              </div>
            </div>
          </div>

   </div>
</div>

</div>


@include('web.includes.footer');
<script type="text/javascript">
  function confirm_cancel(plan_id) {
      if( plan_id ) {
          var confirmation = confirm("Are you sure to cancel subscription.");
          if( confirmation ) {
              $.ajax({
                url: "{{ url('subscription_cancel_process') }}",
                type:"POST",
                data:{
                  "plan_id": plan_id,
                  "_token": "<?php echo csrf_token() ?>"
                },
                success:function(response){
                    if( response && response == "success" ) {
                        document.location = "{{ url('subscription_canceled') }}";
                    }
                },  
              });
          }
      }
  }
</script>