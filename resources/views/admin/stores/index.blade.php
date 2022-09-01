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
            <h1 class="m-0">Stores Information</h1>
          </div>
          <div class="col-sm-6 d-flex justify-content-end">
             <a href="{{ route('admin_stores_add') }}"><button class="btn btn-info align-right">Add New Store</button></a>
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
                <h3 class="card-title"> Business Stores </h3>
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
                    <th>Store Name</th>
                    <th>Business User Name</th>
                    <th>Store Logo</th>
                    <th>Email</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
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
                        <td>{{$usersData->first_name." ".$usersData->last_name}}</td>
                        <td>
                          @if($customer->logo && $customer->logo != '')
                            <img src="{{asset('assets/img/stores/').'/'.$customer->logo}}" class="img_custom" />
                            @else
                            <img src="{{asset('assets/img/stores/default/default.png')}}" class="img_custom"/>
                          @endif
                        </td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->lat}}</td>
                        <td>{{$customer->long}}</td>
                        
                        <td>
                          
                          <a href="{{ url('admin/stores/view/'.$customer->id) }}">
                            <button class="btn btn-default" title="View"><i class="far fa-eye"></i></button>
                          </a>

                          <a href="{{ url('admin/stores/edit/'.$customer->id) }}">
                            <button class="btn btn-warning">
                              <i class="fas fa-edit" title="Edit Record"></i>
                            </button>
                          </a>

                          <a href="{{ url('admin/stores/delete/'.$customer->id) }}" onclick="return confirm('Are you sure to Delete?');">
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