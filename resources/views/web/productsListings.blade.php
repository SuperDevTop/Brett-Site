<div class="main-do-dos" style="border-bottom: 0px;">
   <div class="container">
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

                    <?php
                    if( $each_store_products->deal_simple_product_status == 1  ) {?>
                      <a href="{{url('singleDealDetails').'/'.$each_store_products->id}}" style="color: #306F29;">
                    <?php
                    } else {?>
                      <a href="{{url('singleProductDetails').'/'.$each_store_products->id}}" style="color: #306F29;">
                    <?php
                    }
                    ?>
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

                      $favourite_deals_id = array();
                      if( isset(Auth::user()->id) ) {
                          $favourite_deals = DB::select('select prod_deal_id from favourites where user_id = "'.Auth::user()->id.'" ');
                          if( isset($favourite_deals) ) {
                              if( count($favourite_deals) > 0 ) {
                                  foreach ($favourite_deals as $key => $value) {
                                      array_push($favourite_deals_id, $value->prod_deal_id);
                                  }
                              }
                          }
                      }

                      if( in_array($each_store_products->id, $favourite_deals_id) ) {
                        $active_Class = "fav_icon_active";
                      }
                      ?>
                      <!-- <i class="fa fa-heart fav_icon_ fav_un_fav_main <?php //echo $active_Class;?>" onclick="mark_fav_un_fav(this, '<?php //echo $each_store_products->id;?>','<?php //echo $each_store_products->store_id;?>', 'deals');" style="cursor: pointer;" aria-hidden="true"></i> -->
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
            @else
            <div class="p-5" style="border: 1px solid #CCC;">
              <h2 class="text-center text-danger">No Result Found!</h2>
              <p class="text-center"> Change your filter criteria to get the results.</p>
            </div>
         @endif
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