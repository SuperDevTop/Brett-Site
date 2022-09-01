  @include('admin.includes.header');
  @include('admin.includes.aside');
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Claim Store Requests</h1>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
         

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              
              <!-- TABLE: LATEST ORDERS -->
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Claim Store Listing</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                      <tr>
                        <th>SR#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Store Details</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Claim Date</th>
                      </tr>
                      </thead>
                      <tbody>
                        @if( isset($complete_data) && count($complete_data) > 0 )
                          @php
                            $counter=0;
                          @endphp
                          @foreach( $complete_data as $key => $customer )
                          <tr>
                            <td>{{++$counter}}</td>
                            <td>{{$customer['claim_data']->name}}</td>
                            <td>{{$customer['claim_data']->email}}</td>
                            <td>{{$customer['claim_data']->phone}}</td>
                            <td>
                              
                              <strong>Store Name: </strong> {{$customer['store_data']->name}}<br />
                              <strong>Store Address: </strong>{{$customer['store_data']->address}}<br />
                              <strong>Store Email: </strong>{{$customer['store_data']->email}}<br />
                              <strong>Store Phone: </strong>{{$customer['store_data']->phone}}<br />

                            </td>
                            <td>
                              <strong>
                              <?php
                                if( $customer['claim_data']->status == 0 ) {
                                  echo "<p class='text-danger'>Pending</p>";
                                } else if( $customer['claim_data']->status == 1 ) {
                                  echo "<p class='text-info'>Verified</p>";
                                } else if( $customer['claim_data']->status == 2 ) {
                                  echo "<p class='text-success'>Approved & Transferred</p>";
                                }
                              ?>
                              </strong>
                            </td>
                            <td>
                              <?php
                                if( $customer['claim_data']->status == 0 ) {?>
                                  <button class="btn btn-info" onclick="chengeStatus(1, <?php echo $customer['claim_data']->id;?>);">Verify</button>
                                <?php } else if( $customer['claim_data']->status == 1 ) {?>
                                  <button class="btn btn-success" onclick="chengeUser(2, <?php echo $customer['claim_data']->id ?>);">Transfer</button>
                                <?php } else if( $customer['claim_data']->status == 2 ) {
                                  echo "N/A";
                                }
                              ?>
                            </td>
                            <td><?php echo date("Y-m-d H:i:s", strtotime($customer['claim_data']->created_at));?></td>
                          </tr>
                          @endforeach
                      @endif
                      </tbody>
                    </table>
                  </div>
                  <script type="text/javascript">
                    function chengeUser(status, claim_id) {
                        var confirmation = confirm("Do you really want to change the status?");
                        if( confirmation ) {
                          $.ajax({
                             url: "{{ url('change_user_status').'/' }}",
                             type:"POST", 
                             data:{
                               "status": status,
                               "claim_id": claim_id,
                               "_token": "<?php echo csrf_token() ?>"
                             },
                             success:function(response){
                                 document.location.reload();
                             },
                        });
                      }                    
                    }
                    function chengeStatus(status, claim_id) {
                        var confirmation = confirm("Do you really want to change the status?");
                        if( confirmation ) {
                          $.ajax({
                             url: "{{ url('change_claim_status').'/' }}",
                             type:"POST",
                             data:{
                               "status": status,
                               "claim_id": claim_id,
                               "_token": "<?php echo csrf_token() ?>"
                             },
                             success:function(response){
                                 document.location.reload();
                             },
                        });
                    }                    
                    }
                    
                  </script>
                  <script type="text/javascript">
                    
                  </script>
                  <!-- /.table-responsive -->
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  @include('admin.includes.footer');