@include('admin.includes.header');
@include('admin.includes.aside');
<div class="content-wrapper">
@if( isset($age_date_data->id) ) 
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
                <h3 class="card-title">AgeGate Page Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/EditAgeGateProcess/'.$age_date_data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">

                      <div class="col-4">
                        <div class="form-group">
                          <label for="status">Side Text</label>
                          <input type="text" class="form-control" id="side_text" name="side_text" placeholder="Enter Side Text"   autocomplete="off" value="{{old('side_text', $age_date_data->side_text)}}" required>
                          @error('side_text')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="status">Header</label>
                          <input type="text" class="form-control" id="header" name="header" placeholder="Enter Header"   autocomplete="off" value="{{old('header', $age_date_data->header)}}" required>
                          @error('header')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                       
                      <div class="col-4">
                        <div class="form-group">
                          <label for="status">Status</label>
                          <select class="form-control" id="status" name="status" required>
                            <option value="" <?php if($age_date_data->status!="enable" && $age_date_data->status!="disable"){echo 'selected';} ?>>Please select status</option>
                            <option value="enable" <?php if($age_date_data->status=="enable"){echo 'selected';} ?>>Enable</option>
                            <option value="disable" <?php if($age_date_data->status=="disable"){echo 'selected';} ?>>Disable</option> 
                          </select>
                          @error('status')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                  </div>
                
                  <a href="{{ route('landingPage_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Update</button>
                
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