@include('admin.includes.header');
@include('admin.includes.aside');
<div class="content-wrapper">
@if( isset($customer_data->first_name) ) 
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
                <h3 class="card-title">Administrator Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/EditAdminProfileProcess/'.$customer_data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_profile_image" value="{{$customer_data->profile_photo_path}}">
                <div class="card-body">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="f_name">First Name</label>
                          <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name"   autocomplete="off" value="{{old('f_name', $customer_data->first_name)}}" required>
                          @error('f_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="l_name">Last Name</label>
                          <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('l_name', $customer_data->last_name) }}">
                          @error('l_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="dob">DOB</label>
                          <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Date of Birth" value="{{ old('dob', date('m/d/Y', strtotime($customer_data->dob))) }}">
                          {{date('m/d/Y', strtotime($customer_data->dob))}}
                          @error('dob')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="zipcode">Zip Code</label>
                          <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter Zip Code"  value="{{ old('zipcode', $customer_data->zip_code) }}">
                          @error('zipcode')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="red_link">Redit Link</label>
                          <input type="text" class="form-control" id="red_link" name="red_link" placeholder="Enter Redit Link"  value="{{ old('red_link', $customer_data->redit_link) }}">
                          @error('red_link')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="discord_link">Discord Link</label>
                          <input type="text" class="form-control" id="discord_link" name="discord_link" placeholder="Enter Discord Link"  value="{{ old('discord_link', $customer_data->discord_link) }}">
                          @error('discord_link')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="email_address">Email Address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required autocomplete="off" value="{{ old('email', $customer_data->email) }}">
                          @error('email')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="password">password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required autocomplete="off">
                          @error('password')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="status">Status</label>

                          @php
                            $status_val = old('status', $customer_data->status);
                          @endphp

                          <select class="form-control" id="status" name="status" required>
                            <option value="1" selected="if($status_val==1){'selected'}">Active</option>
                            <option value="0" selected="if($status_val==0){'selected'}">In-Active</option>
                          </select>
                          @error('status')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="profile_image">Profile Image</label>
                          <input type="file" class="form-control" id="profile_image" name="profile_image">
                          @error('profile_image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>


                  </div>
                 
                
                  <a href="{{ route('customer_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Edit Profile</button>
                
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