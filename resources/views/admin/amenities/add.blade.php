@include('admin.includes.header');
@include('admin.includes.aside');
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                <h3 class="card-title">Add New Amenity</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('admin_amenities_add_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Amenity Name"   autocomplete="off" value="{{ old('name') }}" required>
                          @error('name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="c_image">Amenity Image</label>
                          <input type="file" class="form-control" id="c_image" name="c_image">
                          @error('c_image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                  </div>
                 
                
                  <a href="{{ route('amenities_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Add Amenity</button>
                
              </form>
            </div>
            <!-- /.card -->


          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
@include('admin.includes.footer');