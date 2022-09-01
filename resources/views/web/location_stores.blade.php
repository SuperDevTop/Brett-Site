@include('web.includes.header');
  <div class="container-bg-home">
  <div class="tabb">
    <div class="tab-content">
      <!--first-->
      <div id="delivery" data-tab-content class="active">
        <div class="contact-1">
      
  @if( isset($store_locations) )
    @if(count($store_locations) > 0)
      @foreach ($store_locations as $key => $each_delivery)
          <div class="west-smoke-main">
            <a href="{{url('deliveries').'/'.$each_delivery->id}}"></a>
             <div class="west-all">
                <div class="west-bg">
                   <div class="somke-1">
                      @if(isset($each_delivery->logo) && $each_delivery->logo != '')
                          <img src="{{asset('assets/img/stores').'/'.$each_delivery->logo}}">
                        @else
                          <img src="{{asset('assets/img/stores/default/default.png')}}">
                      @endif
                    </div>
                   <div class="somke-2">
                      <h3>{{$each_delivery->name}}</h3>
                      <div class="satrter">
                         <span class="fa fa-star checked"></span>
                         <span class="fa fa-star checked"></span>
                         <span class="fa fa-star checked"></span>
                         <span class="fa fa-star  checked"></span>
                         <span class="fa fa-star"></span><i class="sat-left">4.3 (25)</i>
                      </div>
                      <div class="ukia-text-bg">
                         <p>Medical & Recreational</p>
                         <p><strong>Address:</strong> {{$each_delivery->address}}</p>
                      </div>
                   </div>
                   <!-- <div class="somke-3">
                      <div class="contra-icon"> 
                        <a href="#"><img src="{{asset('assets/img/web/medcal-1.jpg')}}"></a>Concentration<i class="sat-left">14 items</i><br>
                         <a href="#"><img src="{{asset('assets/img/web/medcal-2.jpg')}}"></a>Edibles<i class="sat-left">15 items</i><br>
                        <a href="#"><img src="{{asset('assets/img/web/medcal-3.jpg')}}"></a>Flower<i class="sat-left">41 items</i><br>
                         <a href="#"><img src="{{asset('assets/img/web/medcal-4.jpg')}}"></a>Vape pans<i class="sat-left">27 items</i><br>
                        <a href="#"><img src="{{asset('assets/img/web/medcal-5.jpg')}}"></a>Other<i class="sat-left">3 items</i>
                      </div>
                   </div> -->
                </div>
                <div class="free-deliver">
                   <div class="main-free">
                      <div class="free-1">
                         <span class="as-copy"><i class="fas fa-shopping-cart careti" ></i>Free delivery <span class="min-dol" >$20 | min</span></span>
                      </div>
                      <div class="free-2">
                        <?php
                          if( $each_delivery->category == "1" ) {?>
                            <a href="{{url('doctorDetails').'/'.$each_delivery->id}}">
                              <span class="hello-1">view menu</span>
                            </a>
                          <?php
                          } else if( $each_delivery->category == "2" ) {?>
                            <a href="{{url('dispensaryDetails').'/'.$each_delivery->id}}">
                              <span class="hello-1">view menu</span>
                            </a>
                          <?php
                          } else if( $each_delivery->category == "3" ) {?>
                            <a href="{{url('deliveryDetails').'/'.$each_delivery->id}}">
                              <span class="hello-1">view menu</span>
                            </a>
                          <?php
                          }
                        ?>
                      </div>
                   </div>
                </div>
             </div>
          </div>
      @endforeach
    @else
      <p style="font-weight: bold; font-size: 18px; color: red; text-align: center;">No Store Found</p>
    @endif
  @endif
<!-- boxing start end  -->

</div>


        </div>
      </div>
      <!--second-->
      <div id="pickup" data-tab-content>
      <div class="contact-1">
      <h1>amjad</h1>  
      </div>

      </div>

    </div>
  </div>
      <script>
  const tabs = document.querySelectorAll('[data-tab-target]')
  const tabContents = document.querySelectorAll('[data-tab-content]')
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const target = document.querySelector(tab.dataset.tabTarget)
      tabContents.forEach(tabContent => {
        tabContent.classList.remove('active')
      })
      tabs.forEach(tab => {
        tab.classList.remove('active')
      })
      tab.classList.add('active')
      target.classList.add('active')
      document.getElementById('hide1').style.display = "block";
  // document.getElementById('hide2').style.display = "block"; 
    })
  })
  </script>




    </div>

@include('web.includes.footer');