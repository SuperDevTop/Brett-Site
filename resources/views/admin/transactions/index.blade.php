@include('admin.includes.header');
@include('admin.includes.aside');
<style>
.img_custom {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  padding: 0px;
  border: 2px solid #FFF;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transactions</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-md-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Transaction Records</h3>
              </div>
              
              <div class="card-body">
                <style type="text/css">
                  .plan_transaction {
                      list-style: none;
                  }
                </style>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR #</th>
                    <th>Plan Name</th>
                    <th>Plan Category</th>
                    <th>Price</th>
                    <th>Processing Fee</th>
                    <th>Payment Method</th>
                    <th>Period</th>
                    <th>Plan Details</th>
                    <th>Subscription Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if( isset($transactions_all) && count($transactions_all) > 0 )
                      @php
                        $counter=0;
                      @endphp
                      @foreach( $transactions_all as $key => $transaction )
                      <tr>
                        <td>{{++$counter}}</td>
                        <td>{{$transaction->plane_name}}</td>
                        <td>{{$transaction->name}}</td>
                        <td>{{$transaction->price}}</td>
                        <td>{{$transaction->processing_fee}}</td>
                        <td>{{$transaction->payment_method}}</td>
                        <td>{{$transaction->monthy_annual}}</td>
                        <td>
                          @if( isset($transaction->plan_options_checkboxes) && ($transaction->plan_options_checkboxes) != '' )
                            <ul class="pricing-bg-lg">
                              <?php $each_counter = 0;?>
                                @foreach( (array)json_decode($transaction->plan_options_checkboxes) as $key => $plans_data )
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
                        </td>
                        <td>{{$transaction->subscription_date}}</td>
                        <td>
                          <a href="{{ url('admin/transactions/view/'.$transaction->id) }}">
                            <button class="btn btn-default">
                              <i class="fas fa-eye" title="View Transaction"></i>
                            </button>
                          </a>
                        </td>

                      </tr>
                      @endforeach
                  @endif
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>          
        </div>

      </div>
    </section>
  </div>
@include('admin.includes.footer');