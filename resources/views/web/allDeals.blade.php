@include('web.includes.header');
<div class="main-do-dos">
   <div class="container">
         @if( isset($products_data) && count($products_data) > 0 )
            @foreach( $products_data as $key => $products_data_each )
            <a href="{{url('allDeals').'/'.$products_data_each->id}}">
               <div class="col-md-3" style="float: left;">
                  @if($products_data_each->cat_image && $products_data_each->cat_image != '')
                      <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/productsCategory/').'/'.$products_data_each->cat_image}}" alt="User profile picture"  style="width: 100%;">
                  @else
                      <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/productsCategory/default/default.png')}}"   style="width: 100%;" />
                  @endif
                  <p>{{$products_data_each->name}}</p>
               </div>
            @endforeach
         @endif
   </div>
</div>
@include('web.includes.footer');