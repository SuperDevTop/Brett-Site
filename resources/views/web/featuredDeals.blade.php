@include('web.includes.header');
<style type="text/css">
.main_image {
    width: auto;
    height: 200px;
    display: block;
    margin: 0 auto;
    max-width: 200px;
}
.custom_style {
   border: 2px solid #CCC;
   padding: 9px;
   margin: 32px;
   border-radius: 9px;
}
.irvine p {
  font-size: 1.5rem;
  color: #306f29;
}
</style>
<div class="main-do-dos">
   <div class="container">
      <div class="row">
         @if( isset($products_data) && count($products_data) > 0 )
            
            <div class="col-md-12">
               <h2 class="text-center"><strong> Featured Products </strong> </h2>
            </div>

            @foreach( $products_data as $key => $products_data_each )
               <div class="col-md-3 mt-3 custom_style">
                   <a href="{{url('singleProductDetails').'/'.$products_data_each->id}}">
                     @if(isset($products_data_each->image) && $products_data_each->image != '')
                         <img src="{{asset('assets/img/products').'/'.$products_data_each->image}}" class="main_image">
                       @else
                         <img src="{{asset('assets/img/products/default/default.png')}}" class="main_image">
                     @endif
                   <div class="irvine">
                       <p><strong>{{$products_data_each->name}}</strong></p>
                       <h5>${{$products_data_each->regular_price}}</h5>
                       <div class="order-icon-shop">
                         View Details
                       </div>
                   </div>
                   </a>
               </div>
            @endforeach
            @else
            <h2>No Products Found!</h2>
         @endif
      </div>
   </div>
</div>
@include('web.includes.footer');