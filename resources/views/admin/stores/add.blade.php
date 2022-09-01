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
                <h3 class="card-title">Add Store</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('admin_stores_add_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="s_name">Store Name</label>
                          <input type="text" class="form-control" id="s_name" name="s_name" placeholder="Enter First Name"   autocomplete="off" value="{{ old('f_name') }}" required>
                          @error('s_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="store_owner">Category</label>
                          <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            @if(isset($categories) && count($categories) > 0)
                              @foreach($categories as $each_category)
                                <option value="{{$each_category->id}}">{{$each_category->name}}</option>
                              @endforeach
                            @endif
                          </select>
                          @error('category')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="store_amenity">Amenities</label>
                          <select class="form-control multi_selection" multiple id="store_amenity" name="store_amenity[]">
                            @if(isset($amenitites) && count($amenitites) > 0)
                              @foreach($amenitites as $each_amenitites)
                                <option value="{{$each_amenitites->id}}">{{$each_amenitites->name}}</option>
                              @endforeach
                            @endif
                          </select>
                          @error('store_amenity')
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
                          <label for="s_image">Store Image</label>
                          <input type="file" class="form-control" id="s_image" name="s_image">
                          @error('s_image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('description') }}">
                          @error('description')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="phone">Store Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('phone') }}">
                          @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="link_to_website">Link to Website</label>
                          <input type="text" class="form-control" id="link_to_website" name="link_to_website" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('link_to_website') }}">
                          @error('link_to_website')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="link_to_media">Link to Social Media</label>
                          <input type="text" class="form-control" id="link_to_media" name="link_to_media" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('link_to_media') }}">
                          @error('link_to_media')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="hours">Hours</label>
                          <textarea class="form-control" id="hours" name="hours">{{ old('hours') }}</textarea>
                          @error('hours')
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

                      <div class="col-4">
                        <div class="form-group">
                          <label for="lat">Latitude</label>
                          <input type="text" class="form-control" id="lat" name="lat" placeholder="Enter Latitude" autocomplete="off" value="{{ old('lat') }}">
                          @error('lat')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="long">Longitude</label>
                          <input type="text" class="form-control" id="long" name="long" placeholder="Enter Longitude" autocomplete="off" value="{{ old('long') }}">
                          @error('long')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="delivery_service">Delivery Service Service Info</label>
                          <textarea class="form-control" id="delivery_service" name="delivery_service">{{ old('delivery_service') }}</textarea>
                          @error('delivery_service')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="about_us">About Us Info</label>
                          <textarea class="form-control" id="about_us" name="about_us">{{ old('about_us') }}</textarea>
                          @error('about_us')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="potential_customer">Potential Customer</label>
                          <input type="email" class="form-control" id="potential_customer" name="potential_customer">{{ old('potential_customer') }}</input>
                          @error('potential_customer')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                  </div>
                 
                
                  <a href="{{ route('stores_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Add Store</button>
                
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