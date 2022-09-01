@include('admin.includes.header');
@include('admin.includes.aside');
<div class="content-wrapper">
@if( isset($customer_data->id) ) 
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
                <h3 class="card-title">Product Page Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/EditProductPageProcess/'.$customer_data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">

                      <div class="col-4">
                        <div class="form-group">
                          <input type="text" class="form-control" id="menu" name="menu" placeholder="Enter First Name"   autocomplete="off" value="{{old('menu', $customer_data->menu)}}" required>
                          @error('menu')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <input type="text" class="form-control" id="details" name="details" placeholder="Enter First Name"   autocomplete="off" value="{{old('details', $customer_data->details)}}" required>
                          @error('details')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <input type="text" class="form-control" id="deals" name="deals" placeholder="Enter First Name"   autocomplete="off" value="{{old('deals', $customer_data->deals)}}" required>
                          @error('deals')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <input type="text" class="form-control" id="review" name="review" placeholder="Enter First Name"   autocomplete="off" value="{{old('review', $customer_data->review)}}" required>
                          @error('review')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <input type="text" class="form-control" id="media" name="media" placeholder="Enter First Name"   autocomplete="off" value="{{old('media', $customer_data->media)}}" required>
                          @error('media')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>  
                  </div>
                
                  <a href="{{ route('landingPage_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Update Products Page Menus</button>
                
              </form>
            </div>
            <!-- /.card -->


          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </ection>
    @else
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <h2>No Record Found!</h2>
          
        </div>
      </div>
    </section>
@endif
</div>
@include('admin.includes.footer');