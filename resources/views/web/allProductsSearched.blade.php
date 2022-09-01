<style type="text/css">
.each_product {
    border: 2px solid #306f29;
    margin: 10px;
    padding: 10px;
    border-radius: 10px;
}
.each_product img.profile-user-img.img-fluid.img-circle {
    height: 150px;
    width: 150px !important;
    margin: 0 auto;
    display: block;
    border-radius: 50%;
}
</style>
@include('web.includes.header');
<div class="main-do-dos">
   <div class="container">
         @if( isset($products_data) && count($products_data) > 0 )
            @foreach( $products_data as $key => $products_data_each )
            <a href="{{url('singleProductDetails').'/'.$products_data_each->id}}">
               <div class="col-md-3 each_product" style="float: left;">
                  @if($products_data_each->image && $products_data_each->image != '')
                      <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/products/').'/'.$products_data_each->image}}" alt="User profile picture"  style="width: 100%;">
                  @else
                      <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/products/default/default.jpg')}}"   style="width: 100%;" />
                  @endif
                  <hr />
                  <p style="color:#323232;font-weight:600;font-size:26px;">{{$products_data_each->name}}</p>
                  <p style="color:#323232;font-weight:600;font-size:18px;text-align: right;">${{$products_data_each->regular_price}}.00</p>
                  <div style="width:100%;display:flex;justify-content:space-between;align-items:baseline;">
                     
                  </div>
               </div>
            @endforeach
            @else
            <div class="p-5">
              <h2 class="text-center text-danger">No Products Found!</h2>
              <p class="text-center"> You can find near by your location from the top bar search location.</p>
            </div>
         @endif
   </div>
</div>
@include('web.includes.footer');