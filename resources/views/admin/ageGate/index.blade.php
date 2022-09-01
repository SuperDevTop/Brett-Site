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
            <h1 class="m-0">Age Gate Popup</h1>
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
                <h3 class="card-title">Age Gate Page Menus</h3>
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
                    <th>Side Text</th>
                    <th>Header</th> 
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if( isset($age_gate) && count($age_gate) > 0 )
                      @php
                        $counter=0;
                      @endphp
                      @foreach( $age_gate as $key => $age_gate )
                      <tr>
                        <td>{{++$counter}}</td> 
                        <td>{{$age_gate->side_text}}</td>
                        <td>{{$age_gate->header}}</td> 
                        <td style="text-align:center;">
                          @if($age_gate->status == "enable")
                            <img src="{{asset('assets/img/images/tick.png')}}" title="Enable" style="width: 26px;" /> <br /> {{"Enable"}}
                            @else
                            <img src="{{asset('assets/img/images/cross.png')}}" title="Disable" style="width: 26px;" /> <br /> {{"Disable"}}
                          @endif
                        </td> 
                        <td>
                          <a href="{{ url('admin/age_gate/edit/'.$age_gate->id) }}">
                            <button class="btn btn-warning">
                              <i class="fas fa-edit" title="Edit Record"></i>
                            </button>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                  @endif
                  </tbody>
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