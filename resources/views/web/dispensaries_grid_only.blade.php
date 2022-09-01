@php
  $counter = 0;
@endphp
@if( isset($all_stores) && count($all_stores) > 0 )
  @foreach( $all_stores as $key => $each_store )
          <div class="col-md-3 mt-3" style="border: 1px solid #CCC;padding: 5px; padding-bottom: 50px;">
            <?php
            if( $each_store->company_logo_status == 1 ) {?> 
              <div class="col-md-12">
                  @if(isset($each_store->logo) && $each_store->logo != '')
                      <img src="{{asset('assets/img/stores').'/'.$each_store->logo}}" style="max-width: 50%;border-radius: 6px;margin: 20px auto;display: block;">
                    @else
                      <img src="{{asset('assets/img/stores/default/default.png')}}" style="max-width: 50%;border-radius: 6px;margin: 20px auto;display: block;">
                  @endif
              </div>
              <?php
            } else {?>
              <img src="{{asset('assets/img/stores/default/default.png')}}" style="max-width: 50%;border-radius: 6px;margin: 20px auto;display: block;">
            <?php
          }?>
            <div class="col-md-12" style="position:absolute;bottom: 8px;">
              <?php
              if( $each_store->company_name_status == 1 ) {?>
                <h5 class="store_name">{{$each_store->name}}</h5>
                <?php
              }?>

              <?php
              if( $each_store->category == 1 ) {?>
                <a href="{{url('doctorDetails').'/'.$each_store->id}}" class="btn btn-success w-100" style="background: #306F29">
                  Store Details
                </a>
              <?php
              } else if( $each_store->category == 2 ) {?>
                <a href="{{url('dispensaryDetails').'/'.$each_store->id}}" class="btn btn-success w-100" style="background: #306F29">
                  Store Details
                </a>
              <?php
              } else if( $each_store->category == 3 ) {?>
                <a href="{{url('deliveryDetails').'/'.$each_store->id}}" class="btn btn-success w-100" style="background: #306F29">
                  Store Details
                </a>
              <?php
              }
              ?>
            </div>
          </div>
  @endforeach
  @else
  
  <div class="p-5 w-100">
    <h2 class="text-center text-danger">Sorry No Stores found!</h2>
    <p class="text-center"> You can find near by your location from the top bar search location.</p>
  </div>
@endif