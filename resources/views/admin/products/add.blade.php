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
                <h3 class="card-title">Add New Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('admin_products_add_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="p_name">Product Name</label>
                          <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Enter First Name"   autocomplete="off" value="{{ old('p_name') }}" required>
                          @error('p_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="p_description">Product Description</label>
                          <textarea class="form-control" id="p_description" name="p_description" required>{{ old('p_description') }}</textarea>
                          @error('p_description')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <label for="p_price">Product Price</label>
                          <input type="number" class="form-control" id="p_price" name="p_price" placeholder="Enter Product Price"   autocomplete="off" value="{{ old('p_price') }}" required>
                          @error('p_price')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="product_categories"> Product Category</label>
                          <select class="form-control" id="product_categories" name="product_categories" required>
                            <option value="">Select Product Category</option>
                            @if(isset($products_categories) && count($products_categories) > 0)
                              @foreach($products_categories as $each_cat)
                                <option value="{{$each_cat->id}}">{{$each_cat->name}}</option>
                              @endforeach
                            @endif
                          </select>
                          @error('product_categories')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="type">Type</label>
                          <select class="form-control" id="type" name="type">
                            <option value="0">Product</option>
                            <option value="1">Deal</option>
                          </select>
                        </div>
                      </div>

                      
                      <div class="col-4">
                        <div class="form-group">
                          <label for="categories">Business Category</label>
                          <select class="form-control" id="categories" name="categories">
                            <option value="">Select Category</option>
                            @if(isset($all_categories) && count($all_categories) > 0)
                              @foreach($all_categories as $each_cat)
                                <option value="{{$each_cat->id}}">{{$each_cat->name}}</option>
                              @endforeach
                            @endif
                          </select>
                          @error('categories')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>


                      <div class="col-4">
                        <div class="form-group">
                          <label for="stores">Store</label>
                          <select class="form-control" id="stores" name="stores">
                            <option value="">Select Store</option>
                            @if(isset($all_stores) && count($all_stores) > 0)
                              @foreach($all_stores as $each_cat)
                                <option value="{{$each_cat->id}}">{{$each_cat->name."(".$each_cat->id.")"}}</option>
                              @endforeach
                            @endif
                          </select>
                          @error('stores')
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
                          <label for="c_image">Product Image</label>
                          <input type="file" class="form-control" id="c_image" name="c_image">
                          @error('c_image')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                  </div>
                 
                
                  <a href="{{ route('products_listing') }}"><button type="button" class="btn btn-warning">Back</button></a>
                  <button type="submit" class="btn btn-primary">Add Product</button>
                
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