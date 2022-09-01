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
                <h3 class="card-title">Payment Method Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                @if( isset($setting_data) && count($setting_data) > 0 )
                  @foreach( $setting_data as $key => $setting_data_each )
                    <?php
                    if( $setting_data_each->method_name_static == "Stripe" ) {?>
                        <div class="card-body">
                          <h2 class="mb-3"><?php echo $setting_data_each->method_name; ?></h2>
                              <form action="{{ url('admin/EditpaymentSettingsProcess/'.$setting_data_each->id) }}" method="post" enctype="multipart/form-data">
                              @csrf
                          <div class="row">
                                
                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="method_name">Method Name</label>
                                    <input type="text" class="form-control" id="method_name" name="method_name" placeholder="Project Name"   autocomplete="off" value="{{old('method_name', $setting_data_each->method_name)}}" required>
                                    @error('method_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="method_key">API KEY</label>
                                    <input type="text" class="form-control" id="method_key" name="method_key" placeholder="Project Name"   autocomplete="off" value="{{old('method_key', $setting_data_each->method_key)}}" required>
                                    @error('method_key')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="method_secret">Secret Key</label>
                                    <input type="text" class="form-control" id="method_secret" name="method_secret" placeholder="Project Name"   autocomplete="off" value="{{old('method_secret', $setting_data_each->method_secret)}}" required>
                                    @error('method_secret')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="method_redirect_url">Redirect URL</label>
                                    <input type="text" class="form-control" id="method_redirect_url" name="method_redirect_url" placeholder="Project Name"   autocomplete="off" value="{{old('method_redirect_url', $setting_data_each->method_redirect_url)}}" required>
                                    @error('method_redirect_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="status">Status</label>

                                    <select class="form-control" id="status" name="status" required>

                                        <option value="1" <?php if($setting_data_each->status == "1"){echo "selected";} ?>>Active</option>
                                        <option value="0" <?php if($setting_data_each->status == "0"){echo "selected";} ?>>In-Active</option>

                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="fee_measurement">Processing Fee Unit</label>

                                    <select class="form-control" id="fee_measurement" name="fee_measurement" required>

                                        <option value="percentage" <?php if($setting_data_each->fee_measurement == "percentage"){echo "selected";} ?>>Percentage</option>
                                        <option value="fixed" <?php if($setting_data_each->fee_measurement == "fixed"){echo "selected";} ?>>Fixed Price</option>

                                    </select>
                                    @error('fee_measurement')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="processing_fee">Processing Fee</label>
                                    <input type="text" class="form-control" id="processing_fee" name="processing_fee" placeholder="Project Name"   autocomplete="off" value="{{old('processing_fee', $setting_data_each->processing_fee)}}" required>
                                    @error('processing_fee')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                </div>

                             

                          </div>
                             <button type="submit" class="btn btn-primary">Update <?php echo $setting_data_each->method_name_static; ?> Settings</button>
                              </form>
                        </div>
                        <hr />
                    <?php
                    }
                    ?>
                  @endforeach
                @endif
            <!-- /.card -->


          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </ection>
</div>
@include('admin.includes.footer');