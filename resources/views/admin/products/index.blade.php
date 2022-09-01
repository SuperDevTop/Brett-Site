@include('admin.includes.header');
@include('admin.includes.aside');
<style>
.img_custom {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  padding: 0px;
  border: 2px solid #FFF;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div>
          <div class="col-sm-6 d-flex justify-content-end">
              <a href="{{ route('admin_products_add') }}"><button class="btn btn-info align-right">Add New Product</button></a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-md-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Records</h3>
              </div>
              
              <div class="card-body">

                 @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session("success")}}</strong>
                  </div>
                  @endif

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR #</th>
                    <th>Heading</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Store</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if( isset($customer_all) && count($customer_all) > 0 )
                      @php
                        $counter=0;
                      @endphp
                      @foreach( $customer_all as $key => $customer )
                      <tr>
                        <td>{{++$counter}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->description}}</td>
                        
                        <td>
                          <?php
                            if( $customer->deal_simple_product_status == 0 ) {
                              echo "Product";
                            } else if( $customer->deal_simple_product_status == 1 ) { 
                              echo "Deal";
                            }
                          ?>
                        </td>

                        <td>{{$customer->category_name}}</td>
                        <td>{{$customer->store_name}}</td>
                        <td>
                          @if($customer->image && $customer->image != '')
                            <img src="{{asset('assets/img/products/').'/'.$customer->image}}" class="img_custom" />
                            @else
                            <img src="{{asset('assets/img/categories/default/default.png')}}" class="img_custom"/>
                          @endif
                        </td>
                        <td>{{$customer->regular_price}}</td>
                        <td style="text-align:center;">
                          @if($customer->status == 1)
                            <img src="{{asset('assets/img/images/tick.png')}}" title="Active" style="width: 26px;" /> <br /> {{"active"}}
                            @else
                            <img src="{{asset('assets/img/images/cross.png')}}" title="In-Active" style="width: 26px;" /> <br /> {{"inactive"}}
                          @endif
                        </td>
                        <td>
                          <a href="{{ url('admin/products/edit/'.$customer->id) }}">
                            <button class="btn btn-warning">
                              <i class="fas fa-edit" title="Edit Record"></i>
                            </button>
                          </a>

                          <a href="{{ url('admin/products/delete/'.$customer->id) }}" onclick="return confirm('Are you sure to Delete?');">
                            <button class="btn btn-danger">
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
              <!-- /.card-body -->
            </div>
          </div>          
        </div>

      </div>
    </section>
  </div>
@include('admin.includes.footer');