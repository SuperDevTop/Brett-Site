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
                <h3 class="card-title">Portal Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/EditPortalProfileProcess/'.$setting_data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_profile_image" value="{{$setting_data->logo}}">
                <div class="card-body">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="p_name">Project Name</label>
                          <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Project Name"   autocomplete="off" value="{{old('p_name', $setting_data->project_name)}}" required>
                          @error('p_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="phone">Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required autocomplete="off" value="{{ old('phone', $setting_data->phone) }}">
                          @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="email_address">Email Address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required autocomplete="off" value="{{ old('email', $setting_data->email) }}">
                          @error('email')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="location">Complete Address</label>
                          <input type="text" class="form-control" id="location" name="location" placeholder="Address" required autocomplete="off" value="{{ old('location', $setting_data->location) }}">
                          @error('location')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="radius">Radius</label>
                          {{ old('radius') }}
                          <select class="form-control" id="radius" name="radius">
                            <option value="10" <?php if( $setting_data->radius = '10' ) { echo "selected"; } ?>>10 Miles</option>
                            <option value="20" <?php if( $setting_data->radius = '20' ) { echo "selected"; } ?>>20 Miles</option>
                            <option value="30" <?php if( $setting_data->radius = '30' ) { echo "selected"; } ?>>30 Miles</option>
                            <option value="50" <?php if( $setting_data->radius = '50' ) { echo "selected"; } ?>>50 Miles</option>
                            <option value="100" <?php if( $setting_data->radius = '100' ) { echo "selected"; } ?>>100 Miles</option>
                            <option value="200" <?php if( $setting_data->radius = '200' ) { echo "selected"; } ?>>200 Miles</option>
                            <option value="500" <?php if( $setting_data->radius = '500' ) { echo "selected"; } ?>>500 Miles</option>
                          </select>
                          @error('radius')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="google_api_key">Google API Key</label>
                          <input type="text" class="form-control" id="google_api_key" name="google_api_key" placeholder="Google API Key"   autocomplete="off" value="{{old('google_api_key', $setting_data->google_api_key)}}" required>
                          @error('google_api_key')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <label for="under_footer_logo_text">Under Footer Logo Text</label>
                          <textarea style="height: 100px;" class="form-control" id="under_footer_logo_text" name="under_footer_logo_text">{{$setting_data->under_footer_logo_text}}</textarea>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <label for="copyright_text">Footer Copyright Text</label>
                          <textarea style="height: 100px;" class="form-control" id="copyright_text" name="copyright_text">{{$setting_data->copyright_text}}</textarea>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <label for="discord_link">Discord Link</label>
                          <input type="text" class="form-control" id="discord_link" name="discord_link" placeholder="Discord URL"   autocomplete="off" value="{{old('discord_link', $setting_data->discord_link)}}">
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <label for="reddit_link">Reddit Link</label>
                          <input type="text" class="form-control" id="reddit_link" name="reddit_link" placeholder="Discord URL"   autocomplete="off" value="{{old('reddit_link', $setting_data->reddit_link)}}">
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="profile_image">Project Logo</label>
                          <input type="file" class="form-control" id="profile_image" name="profile_image">
                          @error('profile_image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <img class="img_responsive" src="{{asset('assets/img/settings/').'/'.$setting_data->logo}}" alt="User profile picture" style="width: 200px;">
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="footer_image">Footer Logo</label>
                          <input type="file" class="form-control" id="footer_image" name="footer_image">
                        </div>
                        <img class="img_responsive" src="{{asset('assets/img/settings/').'/'.$setting_data->footer_logo}}" alt="User profile picture" style="width: 200px;">
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="favi_logo">Favicon Logo</label>
                          <input type="file" class="form-control" id="favi_logo" name="favi_logo">
                        </div>
                        <img class="img_responsive" src="{{asset('assets/img/settings/').'/'.$setting_data->favi_logo}}" alt="User profile picture" style="width: 200px;">
                      </div>

                  </div>
                  <button type="submit" class="btn btn-primary">Update Portal Settings</button>
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