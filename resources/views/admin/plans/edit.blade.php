@include('admin.includes.header');
@include('admin.includes.aside');
<div class="content-wrapper">
@if( isset($customer_data->plane_name) ) 
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
                <h3 class="card-title">Edit Plan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/EditPlansProcess/'.$customer_data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_profile_image" value="{{$customer_data->image}}">
                <div class="card-body">
                  <div class="row">
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="plan_name">Name</label>
                          <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Enter First Name"   autocomplete="off" value="{{ old('plan_name',$customer_data->plane_name) }}" required>
                          @error('plan_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="plan_description">Description</label>
                          <input type="text" class="form-control" id="plan_description" name="plan_description" placeholder="Enter First Name"   autocomplete="off" value="{{ old('plan_description',$customer_data->description) }}" required>
                          @error('plan_description')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="status">Status</label>
                          <select class="form-control" id="status" name="status" required>
<option value="1" <?php if($customer_data->status=="1"){echo 'selected';} ?>>Active</option>
<option value="0" <?php if($customer_data->status=="0"){echo 'selected';} ?>>In-Active</option>

                          </select>
                          @error('status')
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
            
              @php
                $plans_data = $customer_data->plan_options_checkboxes;
                $plans_array = json_decode($plans_data);

                $show_company_name = "";
                $show_address = "";
                $show_company_logo = "";
                $show_business_description = "";
                $show_markers_on_maps = "";
                $premium_map_icons = "";
                $link_to_website_listing_page = "";
                $link_with_social_media = "";
                $show_store_hours = "";
                $show_review_on_listing_page = "";
                $offer_discounts_deals = "";
                $show_phone_number = "";
                $include_photos = "";
                $import_photos = "";
                $import_videos = "";
                $delivery_service_description = "";
                $about_us_information = "";
                $feature_listing_x_per_day = "";
                $x_products_to_show = "";
                if( isset($plans_array->company_name) && $plans_array->company_name != '' ) {$show_company_name = "checked";$show_company_value = "show_company_name";}
                if( isset($plans_array->show_address) && $plans_array->show_address != '' ) {$show_address = "checked"; $show_address_value = "show_address";}
                if( isset($plans_array->show_company_logo) && $plans_array->show_company_logo != '' ) {$show_company_logo = "checked"; $show_company_logo_value = "show_company_logo";}
                if( isset($plans_array->show_business_description) && $plans_array->show_business_description != '' ) {$show_business_description = "checked"; $show_business_description_value = "show_business_description";}
                if( isset($plans_array->show_markers_on_maps) && $plans_array->show_markers_on_maps != '' ) {$show_markers_on_maps = "checked"; $show_markers_on_maps_value = "show_markers_on_maps";}
                if( isset($plans_array->premium_map_icons) && $plans_array->premium_map_icons != '' ) {$premium_map_icons = "checked"; $premium_map_icons_value = "premium_map_icons";}
                if( isset($plans_array->link_to_website_listing_page) && $plans_array->link_to_website_listing_page != '' ) {$link_to_website_listing_page = "checked"; $link_to_website_listing_page_value = "link_to_website_listing_page";}
                if( isset($plans_array->link_with_social_media) && $plans_array->link_with_social_media != '' ) {$link_with_social_media = "checked"; $link_with_social_media_value = "link_with_social_media";}
                if( isset($plans_array->show_store_hours) && $plans_array->show_store_hours != '' ) {$show_store_hours = "checked"; $show_store_hours_value = "show_store_hours";}
                if( isset($plans_array->show_review_on_listing_page) && $plans_array->show_review_on_listing_page != '' ) {$show_review_on_listing_page = "checked"; $show_review_on_listing_page_value = "show_review_on_listing_page";}
                if( isset($plans_array->offer_discounts_deals) && $plans_array->offer_discounts_deals != '' ) {$offer_discounts_deals = "checked"; $offer_discounts_deals_value = "offer_discounts_deals";}
                if( isset($plans_array->show_phone_number) && $plans_array->show_phone_number != '' ) {$show_phone_number = "checked"; $show_phone_number_value = "show_phone_number";}
                if( isset($plans_array->include_photos) && $plans_array->include_photos != '' ) {$include_photos = "checked"; $include_photos_value = "include_photos";}
                if( isset($plans_array->import_photos) && $plans_array->import_photos != '' ) {$import_photos = "checked"; $import_photos_value = "import_photos";}
                if( isset($plans_array->import_videos) && $plans_array->import_videos != '' ) {$import_videos = "checked"; $import_videos_value = "import_videos";}
                if( isset($plans_array->delivery_service_description) && $plans_array->delivery_service_description != '' ) {$delivery_service_description = "checked"; $delivery_service_description_value = "delivery_service_description";}
                if( isset($plans_array->about_us_information) && $plans_array->about_us_information != '' ) {$about_us_information = "checked"; $about_us_information_value = "about_us_information";}
              @endphp
              


                  <a href="{{ route('plans_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Update Plan</button>
                
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