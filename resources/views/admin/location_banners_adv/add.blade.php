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
                <h3 class="card-title">Add New Location Banner</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('admin_location_banner_add_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="name">Select Location</label>
                          <input type="text" class="form-control" id="name_location" name="name" placeholder="Location Name"   autocomplete="off" value="{{ old('name') }}" required>
                          @error('name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="c_image">Location Banner</label>
                          <input type="file" class="form-control" id="c_image" name="c_image" required>
                          @error('c_image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                  </div>
                  
                  <input type="hidden" name="lat" id="lat">
                  <input type="hidden" name="lng" id="lng">

                  <?php
                  $data = \App\Http\Controllers\web\Home::portalSettings();
                  if( isset($data[0]->google_api_key) ) {?>
                    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=<?php echo $data[0]->google_api_key;?>"></script>
                  <?php
                  }
                  ?>
                   <script type="text/javascript">
                    function initialize(access_from) {
                      const options = {
                        fields: ["formatted_address", "geometry", "name"],
                        strictBounds: false,
                        types: ["address"],
                        // []
                        // ["address"]
                        // ["establishment"]
                        // ["geocode"]
                        // ["(cities)"]
                        // ["(regions)"]
                      }

                      var input = document.getElementById("name_location");
                      var autocomplete = new google.maps.places.Autocomplete(input,options);
                      google.maps.event.addListener(autocomplete, 'place_changed', function () {
                        var place = autocomplete.getPlace();
                        document.getElementById('lat').value = place.geometry.location.lat();
                        document.getElementById('lng').value = place.geometry.location.lng();
                      });
                      }
                      initialize("home");
                      </script>
                
                  <a href="{{ route('location_banner_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Add Location Banner</button>
                
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