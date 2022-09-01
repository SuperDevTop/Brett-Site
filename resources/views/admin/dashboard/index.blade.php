@include('admin.includes.header');
@include('admin.includes.aside');
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <a href="{{ route('stores_listing') }}">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-store"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Stores</span>
                  <span class="info-box-number">{{$stores_count->store_count}}</span>
                </div>
              </div>  
            </a>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <a href="{{ route('business_listing') }}">
              <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Business Users</span>
                  <span class="info-box-number">{{$b_users_count->b_users_count}}</span>
                </div>
              </div>  
            </a>
          </div>
          
          <div class="col-12 col-sm-6 col-md-4">
            <a href="{{ route('customer_listing') }}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Users</span>
                  <span class="info-box-number">{{$c_users_count->c_users_count}}</span>
                </div>
              </div>
            </a>
          </div>


          <div class="col-12 col-sm-6 col-md-4">
            <a href="{{ route('categories_listing') }}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-object-group"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Categories</span>
                  <span class="info-box-number">{{$categories_count->categories_count}}</span>
                </div>
              </div>
            </a>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <a href="{{ route('plans_listing') }}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-th"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Subscription</span>
                  <span class="info-box-number">{{$subscription_count->subscription_count}}</span>
                </div>
              </div>
            </a>
          </div>
          
          <div class="col-12 col-sm-8 col-md-4">
            <a href="{{ route('products_listing') }}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Products</span>
                  <span class="info-box-number">{{$product_count->product_count}}</span>
                </div>
              </div>
            </a>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Contact Requests
                  <a href="{{ route('contact_request') }}">
                    (View All)
                  </a>
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>SR#</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                      @if( isset($contact_requests) && count($contact_requests) > 0 )
                        @php
                          $counter=0;
                        @endphp
                        @foreach( $contact_requests as $key => $customer )
                        <tr>
                          <td>{{++$counter}}</td>
                          <td>{{$customer->name}}</td>
                          <td>{{$customer->email}}</td>
                          <td>{{$customer->subject}}</td>
                          <td>{{$customer->message}}</td>
                          <td><?php echo date("Y-m-d H:i:s", strtotime($customer->created_at));?></td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('admin.includes.footer');