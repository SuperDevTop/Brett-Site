@include('web.includes.header');
  <div class="container-bg-home">
  <div class="tabb">
    <div class="tab-content">
      <div id="delivery" data-tab-content class="active">
        <div class="contact-1">
  @if( isset($delivery_category) )
    @if(count($delivery_category) > 0)
      @foreach ($delivery_category as $key => $each_delivery)
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
                </div>
                <div class="free-deliver">
                   <div class="main-free">
                      <div class="free-1">
                      </div>
                      <div class="free-2">
                        <a href="{{url('doctorDetails').'/'.$each_delivery->id}}">
                          <span class="hello-1">view menu</span>
                        </a>
                      </div>
                   </div>
                </div>
             </div>
          </div>
      @endforeach
      @else
      <div class="p-5">
        <h2 class="text-center text-danger">No Doctors Store Found.</h2>
        <p class="text-center"> You can find near by your location from the top bar search location.</p>
      </div>
    @endif
  @endif


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