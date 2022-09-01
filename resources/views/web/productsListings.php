<div class="main-do-dos">
   <div class="container">
         @if( isset($store_products) && count($store_products) > 0 )
            @foreach( $store_products as $key => $each_store_products )
            <a href="{{url('singleProductDetails').'/'.$each_store_products->id}}">
               <div class="row mb-2">
                  <div class="col-md-2 text-left pl-0">
                     @if($each_store_products->image && $each_store_products->image != '')
                        <img src="{{asset('assets/img/products/').'/'.$each_store_products->image}}" class="img_custom" style="width: 100%;" />
                        @else
                        <img src="{{asset('assets/img/products/default/default.png')}}" class="img_custom" style="width: 100%;"/>
                     @endif
                  </div>
                  <div class="col-md-7">
                     <h3>Heading Here</h3>
                     <p>{{$each_store_products->description}}</p>
                  </div>
                  <div class="col-md-3 text-right pr-0">
                     <p style="font-weight: bold; font-size: 18px;">${{$each_store_products->regular_price}}.00</p>
                  </div>
               </div>
            </a>
            @endforeach
         @endif
   </div>
</div>