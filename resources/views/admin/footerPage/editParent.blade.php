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
                <h3 class="card-title">Parent Menus Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/footerPageParentEdit/'.$footer_parent->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="row">
                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Parent Menu Name</label>
                          <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Parent Menu Name"   autocomplete="off" value="{{$footer_parent->name}}" required>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Parent Menu URL</label>
                          <input type="text" class="form-control" id="p_url" name="p_url" placeholder="Parent Menu URL"   autocomplete="off" value="{{$footer_parent->url}}">
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Parent Menu Order by</label>
                          <input type="number" class="form-control" id="p_order_by" name="p_order_by" placeholder="Parent Menu Order to show"   autocomplete="off" value="{{$footer_parent->order_by}}">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          
                          <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Add Parent Menu</button>
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