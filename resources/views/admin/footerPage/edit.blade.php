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
              <form action="{{ url('admin/footerPageParentAdd') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  @if(session('success_parent'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{session("success_parent")}}</strong>
                    </div>
                  @endif

                  <div class="row">
                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Parent Menu Name</label>
                          <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Parent Menu Name"   autocomplete="off" value="{{old('p_name')}}" required>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Parent Menu URL</label>
                          <input type="text" class="form-control" id="p_url" name="p_url" placeholder="Parent Menu URL"   autocomplete="off" value="{{old('p_url')}}">
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Parent Menu Order by</label>
                          <input type="number" class="form-control" id="p_order_by" name="p_order_by" placeholder="Parent Menu Order to show"   autocomplete="off" value="{{old('p_order_by')}}">
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          
                          <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Add Parent Menu</button>
                        </div>
                      </div>

                  </div>
              </form>

              <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR #</th>
                    <th>Menu Name</th>
                    <th>Menu URL</th>
                    <th>Menu Order</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if( isset($footer_all_data) && count($footer_all_data) > 0 )
                      @php
                        $counter=0;
                      @endphp
                      @foreach( $footer_all_data as $key => $customer )
                      <tr>
                        <!-- $customer->last_name -->
                        <td>{{++$counter}}</td>
                        <td>{{$customer['parent']->name}}</td>
                        <td>{{$customer['parent']->url}}</td>
                        <td>{{$customer['parent']->order_by}}</td>
                        <td>
                          <a href="{{ url('admin/footerPageEditParent/'.$customer['parent']->id) }}">
                            <button type="button" class="btn btn-warning">
                              <i class="fas fa-edit" title="Edit Record"></i>
                            </button>
                          </a>
                          <a href="{{ url('admin/footerPageDelete/'.$customer['parent']->id) }}" onclick="return confirm('Are you sure to Delete?');">
                            <button type="button" class="btn btn-danger">
                              <i class="far fa-trash-alt" title="Delete Record"></i>
                            </button>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                  @endif
                  </tfoot>
                </table>
            </div>
            <!-- /.card -->


            <div class="card card-primary" style="margin-top: 30px;">
              <div class="card-header">
                <h3 class="card-title">Child Menus Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/footerPageChildAdd') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  @if(session('success_child'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{session("success_child")}}</strong>
                    </div>
                  @endif

                  <div class="row">

                      <div class="col-2">
                        <div class="form-group">
                          <label for="parent_menu_child">Select Parent Menu</label>
                          <select class="form-control" id="parent_menu_child" name="parent_menu_child" required>
                            <option value="">Select Parent Menu</option>
                            @if( isset($footer_all_data) && count($footer_all_data) > 0 )
                              @php
                                $counter=0;
                              @endphp
                              @foreach( $footer_all_data as $key => $customer )
                                <option value="{{$customer['parent']->id}}">{{$customer['parent']->name}}</option>
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
                          <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Child Menu Name"   autocomplete="off" value="{{old('p_name')}}" required>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label for="p_name">Child Menu URL</label>
                          <input type="text" class="form-control" id="p_url" name="p_url" placeholder="Child Menu URL"   autocomplete="off" value="{{old('p_url')}}">
                        </div>
                      </div>

                      <div class="col-2">
                        <div class="form-group">
                          <label for="p_name">Child Menu Order by</label>
                          <input type="number" class="form-control" id="p_order_by" name="p_order_by" placeholder="Child Menu Order to show"   autocomplete="off" value="{{old('p_order_by')}}">
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">
                          
                          <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Add Child Menu</button>
                        </div>
                      </div>

                  </div>
              </form>

              <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR #</th>
                    <th>Parent Menu Name</th>
                    <th>Menu Name</th>
                    <th>Menu URL</th>
                    <th>Menu Order</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if( isset($footer_all_data) && count($footer_all_data) > 0 )
                      @php
                        $counter=0;
                      @endphp
                      @foreach( $footer_all_data as $key => $customer )
                        @if( isset($customer['child']) && count($customer['child']) > 0 )
                          @foreach( $customer['child'] as $key => $child )
                            <tr>
                              <td>{{++$counter}}</td>
                              <td>{{$customer['parent']->name}}</td>
                              <td>{{$child->name}}</td>
                              <td>{{$child->url}}</td>
                              <td>{{$child->order_by}}</td>
                              <td>
                                <a href="{{ url('admin/footerPageEditChild/'.$child->id) }}">
                                  <button type="button" class="btn btn-warning">
                                    <i class="fas fa-edit" title="Edit Record"></i>
                                  </button>
                                </a>
                                <a href="{{ url('admin/footerPageDelete/'.$child->id) }}" onclick="return confirm('Are you sure to Delete?');">
                                  <button type="button" class="btn btn-danger">
                                    <i class="far fa-trash-alt" title="Delete Record"></i>
                                  </button>
                                </a>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                      @endforeach
                  @endif
                  </tfoot>
                </table>
            </div>


          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </ection>
</div>
@include('admin.includes.footer');