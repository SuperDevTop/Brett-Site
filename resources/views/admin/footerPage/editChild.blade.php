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
                <h3 class="card-title">Child Menus Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/footerPageChildEdit/'.$footer_parent->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="row">

                      <div class="col-2">
                        <div class="form-group">
                          <label for="parent_menu_child">Parent Menu</label>
                          <select class="form-control" id="parent_menu_child" name="parent_menu_child" required>
                            <option value="">Select Parent Menu</option>
                            @if( isset($footer_parent_all) && count($footer_parent_all) > 0 )
                              
                              @foreach( $footer_parent_all as $key => $customer )
                                <option <?php if( $footer_parent->parent_child_relation == $customer->id ) {echo "selected";}?> value="{{$customer->id}}">{{$customer->name}}</option>
                              @endforeach
                          @endif
                          </select>
                          @error('status')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Child Menu Name</label>
                          <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Child Menu Name"   autocomplete="off" value="{{$footer_parent->name}}" required>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Child Menu URL</label>
                          <input type="text" class="form-control" id="p_url" name="p_url" placeholder="Child Menu URL"   autocomplete="off" value="{{$footer_parent->url}}">
                        </div>
                      </div>

                      <div class="col-2">
                        <div class="form-group">
                          <label for="p_name">Child Menu Order by</label>
                          <input type="number" class="form-control" id="p_order_by" name="p_order_by" placeholder="Child Menu Order to show"   autocomplete="off" value="{{$footer_parent->order_by}}">
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Update Child Menu</button>
                        </div>
                      </div>

                  </div>
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