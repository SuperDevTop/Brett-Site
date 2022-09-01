@include('admin.includes.header');
@include('admin.includes.aside');

  <div class="content-wrapper">
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Transaction Details</h1>
          </div>
        </div>
      </div>
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row" style="display: flex; justify-content: center;">
          <div class="col-md-8">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session("success")}}</strong>
                </div>
                @endif
              <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Customer ID: </b> <a class="float-right">{{$transactions_all->user_id}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>User Complete Name: </b> <a class="float-right">{{$transactions_all->first_name." ".$transactions_all->last_name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Subscription Date: </b> <a class="float-right">{{date("d F, Y", strtotime($transactions_all->subscription_date))}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Plan Category: </b> <a class="float-right">{{$transactions_all->name}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Processing Fee: </b> <a class="float-right">${{$transactions_all->processing_fee}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Subscription Type: </b> <a class="float-right">{{$transactions_all->monthy_annual}}</a>
                  </li>
                  
                </ul>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



      <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Plan Features</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row" style="display: flex; justify-content: center;">
          <div class="col-md-8">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3">
                  @if( isset($transactions_all->plan_options_checkboxes) && ($transactions_all->plan_options_checkboxes) != '' )
                    <ul class="pricing-bg-lg">
                      <?php $each_counter = 0;?>
                      @foreach( (array)json_decode($transactions_all->plan_options_checkboxes) as $key => $plans_data )
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
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@include('admin.includes.footer');