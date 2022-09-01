@include('web.includes.header');

<div class="container-bg-home">
    
    <div class="view-bg">
      @if( isset($delivery_category) )
        @if(count($delivery_category) > 0)
            <div class="brand-1">
              <h2>Delivery Services</h2>
            </div>
            <div class="brand-2"><p><a href="{{url('deliveries')}}">  View All <i class="fas fa-greater-than"></i></p></a></div> 
        @endif
      @endif
    </div>
    <div class="Services-img-cl">
      @if( isset($delivery_category) )
        @if(count($delivery_category) > 0)
          @foreach ($delivery_category as $key => $each_delivery)
            <div class="services-brand-1">
                <a href="{{url('deliveryDetails').'/'.$each_delivery->id}}">
                  @if(isset($each_delivery->logo) && $each_delivery->logo != '')
                      <img src="{{asset('assets/img/stores').'/'.$each_delivery->logo}}">
                    @else
                      <img src="{{asset('assets/img/stores/default/default.png')}}">
                  @endif
                </a>
                <div class="irvine">
                    <p>{{$each_delivery->address}}</p>
                    <h5>{{$each_delivery->name}}</h5>
                    <p>Medical & Recreational</p>
                    <span class="fa fa-star checkeed"></span>
                    <span class="fa fa-star checkeed"></span>
                    <span class="fa fa-star checkeed"></span>
                    <span class="fa fa-star checkeed"></span>
                    <span class="fa fa-star">4.7(687)</span>
                    <div class="order-icon-shop">
                      <a href="#"><i class="fas fa-cart-plus"></i>order delivery</a>
                    </div>
                </div>
            </div>
          @endforeach
        @endif
      @endif
    </div>


    <div class="view-bg">
      @if( isset($dispensary_category) )
        @if(count($dispensary_category) > 0)
            <div class="brand-1">
              <h2>Dispensary</h2>
            </div>
            <div class="brand-2"><p><a href="{{url('dispensaries')}}">  View All <i class="fas fa-greater-than"></i></p></a></div> 
         @endif
      @endif
    </div>
    <div class="Services-img-cl">
      @if( isset($dispensary_category) )
        @if(count($dispensary_category) > 0)
          @foreach ($dispensary_category as $key => $each_delivery)
            <div class="services-brand-1">
              <a href="{{url('dispensaryDetails').'/'.$each_delivery->id}}">
                @if(isset($each_delivery->logo) && $each_delivery->logo != '')
                    <img src="{{asset('assets/img/stores').'/'.$each_delivery->logo}}">
                  @else
                    <img src="{{asset('assets/img/stores/default/default.png')}}">
                @endif
              </a>
              <div class="irvine">
                  <p>{{$each_delivery->address}}</P>
                  <h5>{{$each_delivery->name}}</h5>
                  <p>Medical & Recreational</p>
                  <span class="fa fa-star checkeed"></span>
                  <span class="fa fa-star checkeed"></span>
                  <span class="fa fa-star checkeed"></span>
                  <span class="fa fa-star checkeed"></span>
                  <span class="fa fa-star">4.7(687)</span>
                  <div class="order-icon-shop">
                    <a href="#"><i class="fas fa-cart-plus"></i>order delivery</a>
                  </div>
              </div>
            </div>
          @endforeach
        @endif
      @endif
    </div>


    <div class="view-bg">
      @if( isset($doctor_category) )
        @if(count($doctor_category) > 0)
            <div class="brand-1">
              <h2>Doctors</h2>
            </div>
            <div class="brand-2"><p><a href="{{url('doctors')}}">  View All <i class="fas fa-greater-than"></i></p></a></div> 
        @endif
      @endif
    </div>
    <div class="Services-img-cl">
      @if( isset($doctor_category) )
        @if(count($doctor_category) > 0)
          @foreach ($doctor_category as $key => $each_delivery)
            <div class="services-brand-1">
              <a href="{{url('doctorDetails').'/'.$each_delivery->id}}">
                @if(isset($each_delivery->logo) && $each_delivery->logo != '')
                    <img src="{{asset('assets/img/stores').'/'.$each_delivery->logo}}">
                  @else
                    <img src="{{asset('assets/img/stores/default/default.png')}}">
                @endif
              </a>
              <div class="irvine">
                  <p>{{$each_delivery->address}}</p>
                  <h5>{{$each_delivery->name}}</h5>
                  <p>Medical & Recreational</p>
                  
                  <?php
                  $total_rating_sum = $each_delivery->re_rating;
                  $total_rating_numbers = $each_delivery->no_of_rating;
                  if( ($total_rating_sum >= 1) && ($total_rating_numbers >= 1) ) {
                     $total_rating = $total_rating_sum/$total_rating_numbers;
                     if( $total_rating >= 1 && $total_rating < 2 ) {?>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                     <?php
                     } else if( $total_rating >= 2 && $total_rating < 3 ) {?>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                     <?php
                     } else if( $total_rating >= 3 && $total_rating < 4 ) {?>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                     <?php
                     } else if( $total_rating >= 4 && $total_rating < 5 ) {?>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star"></span>
                     <?php
                     } else if( $total_rating >= 5 && $total_rating < 6 ) {?>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                        <span class="fa fa-star checkeed"></span>
                     <?php
                     }?>
                     <span style="font-size: 20px;"><strong><?php echo $total_rating;?>.00</strong>(<?php echo $total_rating_numbers;?>)</span>
                     <?php
                  }
                  ?>
                  <div class="order-icon-shop">
                    <a href="#"><i class="fas fa-cart-plus"></i>order delivery</a>
                  </div>
              </div>
            </div>
          @endforeach
        @endif
      @endif
    </div>

</div>

<div class="bitcher-border-btm">
  <div class="browser-bg-main">
    <div class="section-browser"></div>
  </div>
</div>


@if( isset($store_locations) )
  @if(count($store_locations) > 0)
    <div class="borw-bg-clr" style="margin-bottom: 332px;">
      <div class="count-category-hd">
        <h2>Browse by Locations</h2>
      </div>
      <div class="row">
        @foreach ($store_locations as $key => $each_location)
          <div class="col-md-2">
            <a href="{{url('storeLocation').'/'.$each_location->store_location_name}}" style="color: #000; text-decoration: underline; font-size: 18px;">{{$each_location->store_location_name}}</a>
          </div>
        @endforeach
      </div>
    </div>
  @endif
@endif

@include('web.includes.footer');