@include('admin.includes.header');
@include('admin.includes.aside');
<title>Business</title>
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
                <h3 class="card-title">Add Business User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('admin_business_add_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="f_name">First Name</label>
                          <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name"   autocomplete="off" value="{{ old('f_name') }}" required>
                          @error('f_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="l_name">Last Name</label>
                          <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('l_name') }}">
                          @error('l_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="dob">DOB</label>
                          <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Date of Birth" value="{{ old('dob') }}">
                          @error('dob')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="zipcode">Zip Code</label>
                          <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter Zip Code"  value="{{ old('zipcode') }}">
                          @error('zipcode')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="red_link">Redit Link</label>
                          <input type="text" class="form-control" id="red_link" name="red_link" placeholder="Enter Redit Link"  value="{{ old('red_link') }}">
                          @error('red_link')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="discord_link">Discord Link</label>
                          <input type="text" class="form-control" id="discord_link" name="discord_link" placeholder="Enter Discord Link"  value="{{ old('discord_link') }}">
                          @error('discord_link')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="email_address">Email Address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required autocomplete="off" value="{{ old('email') }}">
                          @error('email')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="password">password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required autocomplete="off" value="{{ old('password') }}">
                          @error('password')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="status">Status</label>
                          {{ old('status') }}
                          <select class="form-control" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                          </select>
                          @error('status')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>


                  </div>
                 
                
                  <a href="{{ route('business_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Add</button>
                
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