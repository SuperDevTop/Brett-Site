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


<div class="container-bg-home">
    
    <div class="view-bg">
      @if( isset($store_products) )
        @if(count($store_products) > 0)
            <div class="brand-1">
              <h2 style="font-size:28px;color: #306F29;">Featured Deals</h2>
            </div>
            <div class="brand-2">
              <a href="{{url('featuredDeals')}}" class="view_more_all">  View All <i class="fas fa-greater-than"></i>
              </a>
            </div> 
        @endif
      @endif
    </div>
    <div class="Services-img-cl">
      @if( isset($store_products) )
        @if(count($store_products) > 0)
          @foreach ($store_products as $key => $each_delivery)
            <div class="services-brand-1">
                  @if(isset($each_delivery->image) && trim($each_delivery->image) != '')
                      <img src="{{asset('assets/img/products').'/'.$each_delivery->image}}">
                    @else
                      <img src="{{asset('assets/img/products/default/default.png')}}">
                  @endif
                <div class="irvine">
                    <p style="margin-bottom:0px;font-size:20px;color:#000;">{{$each_delivery->name}}</p>
                    <h5 style="text-align:right;padding-right:15px;font-size: 21px;">${{$each_delivery->regular_price}}.00</h5>
                    <a href="{{url('singleDealDetails').'/'.$each_delivery->id}}">
                      <div class="order-icon-shop">
                        View Details
                      </div>
                    </a>
                </div>
            </div>
          @endforeach
        @endif
      @endif
    </div>

</div>


<div class="main-do-dos">
   <div class="container-bg-home">
<div class="brand-1">
              <h2 style="font-size:28px;color: #306F29;">All Deals</h2>
            </div>
      <div id="menu" class="w3-container city">
               <div class="tab-main-pricing-one">
                  <div class="tab-left-pricing" style="padding: 10px;background: #a7abb340;border-radius: 10px;border: 2px solid #000;">
                    <div class="ries-bg">
                        <span><strong>Filter by Product Name</strong></span>
                        <span style="position: relative;display: block;width: 100%;"><i class="fas fa-search" style="    float: right;right: 13px;position: absolute;top: 1px;"  onclick="filter_products()"></i>
                        <input type="text" id="search_p_name" name="search_p_name" placeholder="Search" class="form-control"></span>

                        <hr />

                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Price Range</strong></span>
                          <br />
                          <input type="number" placeholder="Start" class="form-control" name="p_range_start" id="p_range_start1" onkeyup="filter_products();" value="" style="width: 48%;float: left;margin-right: 1%;">
                          <input type="number" placeholder="End" class="form-control" name="p_range_end" id="p_range_end" onkeyup="filter_products();" value="" style="width: 48%;float: right;">
                       </div>
                       <br />
                       <hr />
                    </div>

                    <div class="ries-bg">
                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Deal Start Date</strong></span>
                          <br />
                          <input type="date" placeholder="deal start date" class="form-control" name="deal_start_date" id="deal_start_date" onkeyup="filter_products();" value="" style="width: 100%;float: left;margin-right: 1%;">
                       </div>
                       <br />
                       <hr />
                    </div>

                    <div class="ries-bg">
                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Weight</strong></span>
                          <input type="number" placeholder="Weight" class="form-control" name="weight" id="weight" onkeyup="filter_products();" value="" style="width: 100%;float: right;">
                       </div><br /><hr />
                    </div>
                    <div class="ries-bg">
                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Size</strong></span>
                          <input type="number" placeholder="Size" class="form-control" name="size" id="size" onkeyup="filter_products();" value="" style="width: 100%;float: right;">
                       </div><br /><hr />
                    </div>
                    <div class="ries-bg">
                        <div class="all-product">
                          <span style="font-weight: normal;"><strong>Filter by Quantity</strong></span>
                          <input type="number" placeholder="Quantity" class="form-control" name="quantity" id="quantity" onkeyup="filter_products();" value="" style="width: 100%;float: right;">
                       </div><br /><hr />
                    </div>
                    <div class="all-product" style="padding: 0">
                        <span style="font-weight: normal;"><strong>Filter by Product Categories</strong></span>
                        <br />
                        @if( isset($products_categories) && count($products_categories) > 0 )
                           @foreach( $products_categories as $key => $each_products_cat )
                              <input type="checkbox" class="p_cat" value="{{$each_products_cat->id}}"
                               onclick="filter_products()"> {{$each_products_cat->name}}<br />
                           @endforeach
                        @endif
                    </div>
                    <hr />
                  </div>
                  <div class="tab-Right-pricing">
                     <script> 
                        var status = 0;
                        function filter_products() {
                           
                           var p_categories = "";
                           $(".p_cat").each(function( index ) {
                              if( $(this).prop("checked") == true ) {
                                 if( p_categories != "" ) {
                                    p_categories += ",";   
                                 }
                                 p_categories += $(this).val();
                              }
                           });
                           if( status == 0 ) {
                              // setTimeout(function(){
                                 var b_category = $('input[name="b_category_fitler"]:checked').val();
                                 var p_range_start1 = $('#p_range_start1').val();
                                 var p_range_end = $('#p_range_end').val();

                                 var weight = $('#weight').val();
                                 var size = $('#size').val();
                                 var quantity = $('#quantity').val();
                                 var sort_by_prices = $('#sort_by_prices option:selected').val();

                                 var deal_start_date = $('#deal_start_date').val();
                                 
                                 if( weight >= 0 ) {
                                 } else {
                                    weight = 0;
                                 }

                                 if( size >= 0 ) {
                                 } else {
                                    size = 0;
                                 }

                                 if( quantity >= 0 ) {
                                 } else {
                                    quantity = 0;
                                 }
                                  
                                 if( p_range_start1 >= 0 ) {
                                 } else {
                                    p_range_start1 = 0;
                                 }
                                 if( p_range_end >= 0 ) {
                                 } else {
                                    p_range_end = 0;
                                 }
                                 var search_p_name = $('#search_p_name').val();
                                 $(".products_listing").hide();
                                 $.ajax({
                                       url: "{{ url('deal_filteration_data').'/' }}",
                                       type:"POST",
                                       data:{
                                         "b_category": b_category,
                                         "p_range_start1": p_range_start1,
                                         "search_p_name": search_p_name,
                                         "weight": weight,
                                         "size": size,
                                         "quantity": quantity,
                                         "deal_start_date": deal_start_date,
                                         "sort_by_prices": sort_by_prices,
                                         "p_categories": p_categories,
                                         "product_deal_type": "deal",
                                         "p_range_end": p_range_end,
                                         "_token": "<?php echo csrf_token() ?>"
                                       },
                                       success:function(response){
                                           $(".products_listing").fadeIn(500);
                                           $(".products_listing").html(response);
                                           status = 0;
                                       },
                                 });
                              // }, 2000);
                              status = 1;
                           }
                        }
                     </script>
                     <div class="live">
                     </div>
                      <div class="row">
                        <div class="col-md-4">
                          <span style="font-weight: normal;"><strong>Sort By Prices</strong></span>
                        </div>
                        <div class="col-md-12">
                          <select class="form-control" id="sort_by_prices"  onchange="filter_products()">
                            <option value='asc'>Price low to high</option>
                            <option value='desc'>Price high to low</option>
                          </select>
                        </div>
                      </div>
                     <div class="main-do-dos" style="border-bottom: 0px;">
                          

                        <div class="container products_listing">
                              @if( isset($store_products) && count($store_products) > 0 )
                                 @foreach( $store_products as $key => $each_store_products )
                                    <div class="row mb-2" style="background: #ffd53f2e;padding: 14px;">
                                       <div class="col-md-2 text-left pl-0">
                                          @if($each_store_products->image && $each_store_products->image != '')
                                             <img src="{{asset('assets/img/products/').'/'.$each_store_products->image}}" class="img_custom" style="width: 100%;" />
                                             @else
                                             <img src="{{asset('assets/img/products/default/default.jpg')}}" class="img_custom" style="width: 100%;"/>
                                          @endif
                                       </div>
                                       <div class="col-md-8">
                                          <a href="{{url('singleProductDetails').'/'.$each_store_products->id}}" style="color: #306F29;">
                                            <h3><strong>{{$each_store_products->name}}</strong></h3>
                                          </a>

                                          <style type="text/css">
                      .fav_icon_ {
                        color: #000;
                      }
                      .fav_icon_:hover {
                        color: #FFC107 !important;
                      }
                      .fav_icon_active {
                        color: #FFC107 !important;
                      }
                    </style>  
                    <?php
                    $active_Class = "";
                    if( Auth::check() && Auth::user()->id != '' ) {
                      if( in_array($each_store_products->id, $favourite_deals_id) ) {
                        $active_Class = "fav_icon_active";
                      }
                      ?>
                      <i class="fa fa-heart fav_icon_ fav_un_fav_main <?php echo $active_Class;?>" onclick="mark_fav_un_fav(this, '<?php echo $each_store_products->id;?>','<?php echo $each_store_products->store_id;?>', 'deals');" style="cursor: pointer;" aria-hidden="true"></i>
                    <?php
                    }
                    ?>
                  </p>

                                          <p>{{$each_store_products->description}}</p>
                                          <p>
                                            <strong>Weight: </strong>{{$each_store_products->weight}} <strong> | </strong> 
                                            <strong>Size: </strong>{{$each_store_products->size}} <strong> | </strong>  
                                            <strong>Quantity: </strong>{{$each_store_products->quantity}}
                                          </p>

                                       </div>
                                       <div class="col-md-2 text-right pr-0">
                                          <p style="font-weight: bold; font-size: 18px;">${{$each_store_products->regular_price}}.00</p>
                                       </div>
                                    </div>
                                    <hr style="height:3px;background:#ffd53f;border:none;" />
                                 @endforeach
                              @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>

<script type="text/javascript">
  function mark_fav_un_fav(_this,id,store_id, type) {
    if( id && type && store_id ) {
        $.ajax({
          url: "{{ url('mark_fav_unfav') }}",
          type:"POST",
          data:{
            "id": id,
            "type": type,
            "store_id": store_id,
            "_token": "<?php echo csrf_token() ?>"
          },
          success:function(response){
            var data = JSON.parse(response);
            if( data.status ) {
              if( data.status == "inserted" ) {
                  $(_this).addClass("fav_icon_active");
              } else {
                  $(_this).removeClass("fav_icon_active");
              }
            }
          },  
        });
    }
  }
</script>
      <?php
      /*
          @if( isset($products_data) && count($products_data) > 0 )
            @foreach( $products_data as $key => $products_data_each )
               <div class="col-md-3 each_product" style="float: left;">
                  @if($products_data_each->image && $products_data_each->image != '')
                      <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/products/').'/'.$products_data_each->image}}" alt="User profile picture"  style="width: 100%;">
                  @else
                      <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/products/default/default.jpg')}}"   style="width: 100%;" />
                  @endif
                  <hr />
                  <p style="color:#323232;font-weight:600;font-size:26px;">
                    <a href="{{url('singleDealDetails').'/'.$products_data_each->id}}" style="color: #306F29;">
                      {{$products_data_each->name}}
                    </a>
                    <style type="text/css">
                      .fav_icon_ {
                        color: #000;
                      }
                      .fav_icon_:hover {
                        color: #FFC107 !important;
                      }
                      .fav_icon_active {
                        color: #FFC107 !important;
                      }
                    </style>  
                    <?php
                    $active_Class = "";
                    if( Auth::check() && Auth::user()->id != '' ) {
                      if( in_array($products_data_each->id, $favourite_deals_id) ) {
                        $active_Class = "fav_icon_active";
                      }
                      ?>
                      <i class="fa fa-heart fav_icon_ fav_un_fav_main <?php echo $active_Class;?>" onclick="mark_fav_un_fav(this, '<?php echo $products_data_each->id;?>','<?php echo $products_data_each->store_id;?>', 'deals');" style="cursor: pointer;" aria-hidden="true"></i>
                    <?php
                    }
                    ?>
                    <script type="text/javascript">
                      function mark_fav_un_fav(_this,id,store_id, type) {
                        if( id && type && store_id ) {
                            $.ajax({
                              url: "{{ url('mark_fav_unfav') }}",
                              type:"POST",
                              data:{
                                "id": id,
                                "type": type,
                                "store_id": store_id,
                                "_token": "<?php echo csrf_token() ?>"
                              },
                              success:function(response){
                                var data = JSON.parse(response);
                                if( data.status ) {
                                  if( data.status == "inserted" ) {
                                      $(_this).addClass("fav_icon_active");
                                  } else {
                                      $(_this).removeClass("fav_icon_active");
                                  }
                                }
                              },  
                            });
                        }
                      }
                    </script>
                  </p>



                  <p style="color:#323232;font-weight:600;font-size:18px;text-align: right;">${{$products_data_each->regular_price}}.00</p>
                  <div style="width:100%;display:flex;justify-content:space-between;align-items:baseline;">
                  </div>
               </div>
            @endforeach
            @else
            <div class="p-5">
              <h2 class="text-center text-danger">No Deals Found!</h2>
              <p class="text-center"> You can find near by your location from the top bar search location.</p>
            </div>
         @endif
         <?php
         */
         ?>
   </div>
</div>
@include('web.includes.footer');