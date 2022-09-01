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
                <h3 class="card-title">Add New Plan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('admin_plans_add_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">

                      <div class="col-4">
                        <div class="form-group">
                          <label for="plan_name">Name</label>
                          <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Enter First Name"   autocomplete="off" value="{{ old('plan_name') }}" required>
                          @error('plan_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="plan_price">Price</label>
                          <input type="number" class="form-control" id="plan_price" name="plan_price" placeholder="Enter First Name"   autocomplete="off" value="{{ old('plan_price') }}" required>
                          @error('plan_price')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="plan_description">Description</label>
                          <input type="text" class="form-control" id="plan_description" name="plan_description" placeholder="Enter First Name"   autocomplete="off" value="{{ old('plan_description') }}" required>
                          @error('plan_description')
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
                          <label for="p_category">Category</label>
                          <select class="form-control" id="p_category" name="p_category">
                            <option value="">Select Category</option>
                            @if(isset($Categories_all) && count($Categories_all) > 0)
                              @foreach($Categories_all as $each_cat)
                                <option value="{{$each_cat->id}}">{{$each_cat->name}}</option>
                              @endforeach
                            @endif
                          </select>
                          @error('p_category')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="c_image">Image</label>
                          <input type="file" class="form-control" id="c_image" name="c_image">
                          @error('c_image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>




                  </div>
            
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Plan Options </h3>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="show_address" name="show_address"  value="show_address">
                          <label for="show_address" class="custom-control-label"> Show Address </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="show_company_logo" name="show_company_logo"  value="show_company_logo">
                          <label for="show_company_logo" class="custom-control-label"> Show Company Logo </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="show_business_description" name="show_business_description"  value="show_business_description">
                          <label for="show_business_description" class="custom-control-label"> Show Business Description </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="show_markers_on_maps" name="show_markers_on_maps"  value="show_markers_on_maps">
                          <label for="show_markers_on_maps" class="custom-control-label"> Show marker on Maps </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="premium_map_icons" name="premium_map_icons"  value="premium_map_icons">
                          <label for="premium_map_icons" class="custom-control-label"> Premium Map Icons </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="link_to_website_listing_page" name="link_to_website_listing_page"  value="link_to_website_listing_page">
                          <label for="link_to_website_listing_page" class="custom-control-label"> Link to Website on Listing Page </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="link_with_social_media" name="link_with_social_media"  value="link_with_social_media">
                          <label for="link_with_social_media" class="custom-control-label"> Link to Social Media Pages </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  

                  <div class="row">
                    
                  


                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="show_store_hours" name="show_store_hours"  value="show_store_hours">
                          <label for="show_store_hours" class="custom-control-label"> Show Store Hours </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="show_review_on_listing_page" name="show_review_on_listing_page"  value="show_review_on_listing_page">
                          <label for="show_review_on_listing_page" class="custom-control-label"> Show Reviews on Listing Page </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="offer_discounts_deals" name="offer_discounts_deals"  value="offer_discounts_deals">
                          <label for="offer_discounts_deals" class="custom-control-label"> Offer Discounts & Deals </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="show_phone_number" name="show_phone_number"  value="show_phone_number">
                          <label for="show_phone_number" class="custom-control-label"> Phone Number </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    
                    
                  </div>

                  <div class="row">
                    
                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="include_photos" name="include_photos"  value="include_photos">
                          <label for="include_photos" class="custom-control-label"> Include Photos </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="import_photos" name="import_photos"  value="import_photos">
                          <label for="import_photos" class="custom-control-label"> Import Photos </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="import_videos" name="import_videos"  value="import_videos">
                          <label for="import_videos" class="custom-control-label"> Import Videos </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="delivery_service_description" name="delivery_service_description"  value="delivery_service_description">
                          <label for="delivery_service_description" class="custom-control-label"> Show Delivery Service Description </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    
                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input  checkboxes_plans" type="checkbox" id="about_us_information" name="about_us_information"  value="about_us_information">
                          <label for="about_us_information" class="custom-control-label"> Show About Us Information </label>
                          <input type="hidden" class="checked_text" name="checked_checkbox_array[]" value="">
                        </div>
                      </div>
                    </div>
                    
                  </div>

                  <hr />

                  <div class="row">
                      
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label for="feature_listing_x_per_day">Feature Listing on Rotation (x per Day)</label>
                        <input type="number" class="form-control" id="feature_listing_x_per_day" name="feature_listing_x_per_day" placeholder="3">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="x_products_to_show">No. of Products show of any category</label>
                        <input type="number" class="form-control" id="x_products_to_show" name="x_products_to_show" placeholder="3">
                        <small>For Unlimited Products type 0 </small>
                      </div>
                    </div>

                  </div>
                  <hr />
              </div>

            </div>

            <a href="{{ route('plans_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
            <button type="submit" class="btn btn-primary">Add Plan</button>
          
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

  <script>
    $(document).on('change', '.checkboxes_plans', function() {
  $( ".checkboxes_plans" ).each(function( index ) {
      if( $(this).is(":checked") ) {
          var span_value = $(this).parents(".custom-checkbox").find("label").text();
          $(this).parents(".custom-checkbox").find(".checked_text").val(span_value);
      }
  });
  });
  </script>