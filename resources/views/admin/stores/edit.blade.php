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
                <h3 class="card-title">Edit Store</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/EditStoresProcess/'.$customer_data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="s_name">Store Name</label>
                          <input type="text" class="form-control" id="s_name" name="s_name" placeholder="Enter First Name"   autocomplete="off" value="{{ old('f_name',$customer_data->name) }}" required>
                          @error('s_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <!-- 
                      <div class="col-4">
                        <div class="form-group">
                          <label for="store_owner">Store Owner</label>
                          <select class="form-control" id="store_owner" name="store_owner" required>
                            <option value="">Select Store Owner</option>
                            @if(isset($business_users) && count($business_users) > 0)
                              @foreach($business_users as $each_user)
                                @if($customer_data->bussiness_user_id == $each_user->id)
                                  <option selected value="{{$each_user->id}}">{{$each_user->first_name." ".$each_user->last_name}}</option>
                                  @else
                                  <option value="{{$each_user->id}}">{{$each_user->first_name." ".$each_user->last_name}}</option>
                                @endif
                                
                              @endforeach
                            @endif
                          </select>
                          @error('store_owner')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div> -->
<!-- 
                      <div class="col-4">
                        <div class="form-group">
                          <label for="address"></label>
                          <input type="text" class="form-control" id="address" name="address" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('address') }}">
                          @error('address')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div> -->

                      <div class="col-4">
                        <div class="form-group">
                          <label for="store_owner">Category</label>
                          <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            @if(isset($categories) && count($categories) > 0)
                              @foreach($categories as $each_category)
                                <?php
                                if( $each_category->id == $customer_data->category ) {?>
                                    <option selected value="{{$each_category->id}}">{{$each_category->name}}</option>
                                <?php
                                } else {?>
                                    <option value="{{$each_category->id}}">{{$each_category->name}}</option>
                                <?php
                                }
                                ?>
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
                          <label for="plan_id">Business Free Plans</label>
                          <?php
                          echo $store_subscription_status;
                          ?>
                          <select class="form-control" id="plan_id" name="plan_id">
                            <option value="">Select Subscription Plan</option>
                            @if(isset($plans) && count($plans) > 0)
                              @foreach($plans as $plan)
                                <?php
                                  if($store_subscription_status == "1") {?>
                                      <option value="{{$plan->id}}" selected>{{$plan->plane_name}}</option>
                                  <?php
                                  } else {?>
                                      <option value="{{$plan->id}}">{{$plan->plane_name}}</option>
                                  <?php
                                  }
                                ?>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>



                      <div class="col-4">
                        <div class="form-group">
                          <label for="store_amenity">Amenities</label>
                          <select class="form-control multi_selection" multiple id="store_amenity"  name="store_amenity[]">
                            @if(isset($amenitites) && count($amenitites) > 0)
                              @foreach($amenitites as $each_amenitites)
                                <?php
                                if( in_array($each_amenitites->id, explode(",",$customer_data->store_amenity)) ) {?>
                                    <option selected value="{{$each_amenitites->id}}">{{$each_amenitites->name}}</option>
                                <?php
                                } else {?>
                                    <option value="{{$each_amenitites->id}}">{{$each_amenitites->name}}</option>
                                <?php
                                }
                                ?>
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
                          <label for="address">Address</label>
                          <input type="text" class="form-control" id="address" name="address" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('address',$customer_data->address) }}">
                          @error('address')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="email_address">Email Address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required autocomplete="off" value="{{ old('email',$customer_data->email) }}">
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
                          <input type="text" class="form-control" id="description" name="description" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('description',$customer_data->description) }}">
                          @error('description')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="phone">Store Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('phone',$customer_data->phone) }}">
                          @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="link_to_website">Link to Website</label>
                          <input type="text" class="form-control" id="link_to_website" name="link_to_website" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('link_to_website',$customer_data->link_to_website_listing_page) }}">
                          @error('link_to_website')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="link_to_media">Link to Social Media</label>
                          <input type="text" class="form-control" id="link_to_media" name="link_to_media" placeholder="Enter Last Name" required autocomplete="off" value="{{ old('link_to_media',$customer_data->link_with_social_media) }}">
                          @error('link_to_media')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="hours">Hours</label>
                          <textarea class="form-control" id="hours" name="hours" style="height: 100px;">{{ old('hours',$customer_data->store_hours) }}</textarea>
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
                          <input type="text" class="form-control" id="lat" name="lat" placeholder="Enter Latitude" autocomplete="off" value="{{ old('lat',$customer_data->lat) }}">
                          @error('lat')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="long">Longitude</label>
                          <input type="text" class="form-control" id="long" name="long" placeholder="Enter Longitude" autocomplete="off" value="{{ old('long',$customer_data->long) }}">
                          @error('long')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="delivery_service">Delivery Service Service Info</label>
                          <textarea class="form-control" id="delivery_service" name="delivery_service">{{ old('delivery_service',$customer_data->delivery_service_info) }}</textarea>
                          @error('delivery_service')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="about_us">About Us Info</label>
                          <textarea class="form-control" id="about_us" name="about_us">{{ old('about_us',$customer_data->about_us_info) }}</textarea>
                          @error('about_us')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>



                  </div>
                 
                
                  <a href="{{ route('stores_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Update Store</button>
                
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