@include('admin.includes.header');
@include('admin.includes.aside');
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Add Customer</h1> -->
          </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Plan Categories Description</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/planCatDetailsUpdateProcess') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      
                    @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session("success")}}</strong>
                  </div>
                  @endif

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="doctor_cat_description">Doctor Plan Description</label>
                          <textarea class="form-control" id="doctor_cat_description" name="doctor_cat_description" autocomplete="off"><?php  echo $customer_data->doctor_detail;?></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="dispensary_cat_description">Dispensary Plan Description</label>
                          <textarea class="form-control" id="dispensary_cat_description" name="dispensary_cat_description" autocomplete="off"><?php  echo $customer_data->dispensary_detail;?></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="delivery_cat_description">Delivery Plan Description</label>
                          <textarea class="form-control" id="delivery_cat_description" name="delivery_cat_description" autocomplete="off"><?php  echo $customer_data->delivery_detail;?></textarea>
                        </div>
                      </div>

                  </div>
                  <button type="submit" class="btn btn-primary">Update Plan Details</button>
              </form>
            </div>
            <!-- /.card -->


          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </ection>
</div>
@include('admin.includes.footer');