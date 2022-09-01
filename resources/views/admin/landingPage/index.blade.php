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
            <h1 class="m-0">Landing Page</h1>
          </div>
          <!-- <div class="col-sm-6 d-flex justify-content-end">
              <a href="{{ route('admin_categories_add') }}"><button class="btn btn-info align-right">Add Landing Page Details</button></a>
          </div> -->
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
                <h3 class="card-title">Landing Page Data</h3>
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
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
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
                        <td>{{$customer->title}}</td>
                        <td>{{$customer->description}}</td>
                        <td>
                          @if($customer->image_name && $customer->image_name != '')
                            <img src="{{asset('assets/img/landingPage/').'/'.$customer->image_name}}" class="img_custom" />
                            @else
                            <img src="{{asset('assets/img/landingPage/default/default.png')}}" class="img_custom"/>
                          @endif
                        </td>
                        <td>
                          <a href="{{ url('admin/landingPage/edit/'.$customer->id) }}">
                            <button class="btn btn-warning">
                              <i class="fas fa-edit" title="Edit Record"></i>
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