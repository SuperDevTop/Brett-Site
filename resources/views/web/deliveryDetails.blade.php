@include('web.includes.header');

    

<div class="container-bj">
   
         <div class="foot-1">
            @if(isset($delivery_detail->logo) && $delivery_detail->logo != '')
              <img src="{{asset('assets/img/stores').'/'.$delivery_detail->logo}}" class="img-responsive">
            @else
              <img src="{{asset('assets/img/stores/default/default.png')}}">
          @endif
          </div>
         <div class="foot-2">
            <div class="heading">
               <h1>{{$delivery_detail->name}}</h1>
               <span class="text">{{$delivery_detail->address}}</span> 
            </div>
            <div class="icon-barr">
               <div class="icon-2"> <span><i class="fas fa-briefcase-medical"></i>Deliveries</span> <span><i class="fas fa-pager"></i>Medical & recreational</span> <span><i class="fas fa-shopping-cart"></i>In-store purchases only </span> </div>
               <div class="icon-3" style="width: 250px;"> <span><i class="far fa-clock"></i><br />{{$delivery_detail->store_hours}}</span> </div>
            </div>
            <div class="button" style="    width: 525px;"> <span class="hello-1"><i class="fas fa-phone"></i>{{$delivery_detail->phone}}</span> <span class="hello-1"><i class="fas fa-map"></i>{{$delivery_detail->email}}</span> </div>
         </div>
         <div class="foot-3"></div>
      </div>
       <!-- about page end -->
      <!-- tabs button-->
      <div class="top-botoom-border">
         <div class="tabbin-1">
            <div class="w3-bar w3-black">
               <button class="w3-bar-item w3-button" onclick="openCity('menu')">Menu</button>
               <button class="w3-bar-item w3-button" onclick="openCity('Details')">Details</button>
               <button class="w3-bar-item w3-button" onclick="openCity('deals')">Deals</button>
               <button class="w3-bar-item w3-button" onclick="openCity('Review')">Review</button>
               <button class="w3-bar-item w3-button" onclick="openCity('Media')">Media</button>
            </div>
         </div>
      </div>
      <div class="tabinn">
         <div class="tabbin-2">
            <!--    FIRST START TABE -->
            <div id="menu" class="w3-container city">
               <div class="tab-main-pricing-one">
                  <!-- Left side and pricing menu -->
                  <div class="tab-left-pricing">
                     <div class="ries-bg">
                        <h2>Categories</h2>
                     </div>
                     <span></span>
                     <div class="all-product">
                        <span>All-Product</span>
                        <a href="#">Gear</a>
                        <a href="#">Concentrates</a>
                        <a href="#">Edibles</a>
                        <a href="#">Flower</a>
                        <a href="#">Topicals</a>
                     </div>
                     <div class="all-product">
                        <span>Brand</span><br>
                        <p><input type="checkbox"> Brand verified<i class="fas fa-check-circle"></i></p>
                     </div>
                     <div class="all-product">
                        <span>Effects</span>
                        <p><input type="checkbox"> Brand verified</p>
                        <p><input type="checkbox"> new fied</p>
                        <p><input type="checkbox"> Brand verified</p>
                        <p><input type="checkbox"> qulity poor</p>
                        <p><input type="checkbox"> Brand verified</p>
                        <p class="gren-color">See All Effects</p>
                     </div>
                     <div class="all-product">
                        <span>Price Range</span>
                        <p><input type="radio" checked="check"> Any</p>
                        <p><input type="radio"> Under $25</p>
                        <p><input type="radio"> 25$</p>
                        <p><input type="radio"> $50</p>
                        <p><input type="radio"> $100</p>
                        <p><input type="radio"> $100</p>
                     </div>
                     <div class="all-product">
                        <span>Weight</span>
                        <p><input type="radio" checked="check"> Any</p>
                        <p><input type="radio"> Under $25</p>
                        <p><input type="radio"> 25$</p>
                        <p><input type="radio"> $50</p>
                        <p><input type="radio"> $100</p>
                        <p><input type="radio"> $100</p>
                     </div>
                  </div>
                  <!-- Left end side and pricing menu -->
                  <!-- Right side and pricing menu -->
                  <div class="tab-Right-pricing">
                     <!--   1 dive  -->
                     <div class="main-from-bg">
                        <div class="frim-1">
                           <form action="/action_page.php" class="secrchh">
                              <span style="    position: relative;
    display: block;
    width: 29%;"><i class="fas fa-search" style="    float: right;
    right: 13px;
    position: absolute;
    top: -5px;"></i>
                              <input type="text" id="fname" name="fname" placeholder="Search"><br><br></span>
                           </form>
                        </div>
                        <div class="frim-2">
                           <select>
                              <option value="volvo">Relevence</option>
                              <option value="saab">Most popular</option>
                              <option value="opel">Recent add</option>
                              <option value="audi">Lowest price</option>
                              <option value="audi">highwest price</option>
                           </select>
                        </div>
                     </div>
                     <!--   1 dive end  -->
                     <!--    2 div -->
                     <div class="live">
                        <div class="result225">
                           <p>225 result found</p>
                        </div>
                        
                     </div>
                     
                     <div class="main-do-dos">
                        <div class="dos-left">
                           <div class="indica">
                              <p>No Products Found</p>
                           </div>
                        </div>
                        <div class="dos-right">
                          
                        </div>
                     </div>

                     <!-- <div class="main-do-dos">
                        <div class="dos-left">
                           <div class="indica">
                              <div class="d-1"><img src="img/columb-1.jpg"></div>
                              <div class="d-2">
                                 <span data-testid="hrd">Indica |Flower| Dosidos</span><br>
                                 <h4>Baklava - Indoor</h4>
                              </div>
                           </div>
                        </div>
                        <div class="dos-right">
                           <p><b class="dol$">$50.00</b>per 1/8 oz</p>
                        </div>
                     </div> -->
                    
                  </div>
                  <!-- Right end side and pricing menu -->
               </div>
            </div>
            <!--    FIRST END TABE -->
            <!--    SECOND START TABE -->
            <div id="Details" class="w3-container city"style="display:none">
               <div class="main-tabb-cl">
                  <div class="main-tabb-left">
                     <div class="first-time">
                        <div>
                            <h2 class="cg">Introduction</h2>
                            <p>{{$delivery_detail->about_us_info}}</p>
                           <h3 class="cg">Amenities</h3>
                           <p><a href="#"><i class="fas fa-notes-medical"></i><br>Mdical</a></p>
                            <h2 class="cg">First-Time Customers</h2>
                            <p>20% off your purchase! Use discount code <b>"SUNSET20"</b></p>
                            <p>State License<br>
                            Adult-Use Nonstorefront:C9-0000103-LIC</p>
                        </div>
                     </div>
                  </div>
                  <!-- right side  strat -->
                  <div class="main-tabb-right">
                     <div class="tm-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3401.8970545673737!2d74.31998361500781!3d31.49951335532364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391905927ee24a51%3A0xc85fc90e9d3b00be!2sAXCEL!5e0!3m2!1sen!2s!4v1616482759866!5m2!1sen!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                     </div>
                     <div class="border-map-below">
                        <div class="text">
                           <a href="tel:080-090-0110" class="tm-contact-link">
                              <i class="fas fa-map-marker-alt"></i>
                              <p>{{$delivery_detail->address}}</p>
                           </a>
                        </div>
                        <div class="number-cg">
                           <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-phone tm-contact-icon"></i>{{$delivery_detail->phone}}</a>
                        </div>
                        <!-- closed  start-->
                        <div class="closed" style="width: 250px;">
                           {{$delivery_detail->store_hours}}
                        </div>
                        <!-- closed end -->
                        <div class="main oppinment">
                           <div class="number-cg">
                              <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-envelope tm-contact-icon"></i> {{$delivery_detail->email}} </a>
                           </div>
                           <div class="number-cg">
                              <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-link tm-contact-icon"></i>{{$delivery_detail->link_with_social_media}} </a>
                           </div>

                           <div class="number-cg">
                              <a href="tel:080-090-0110" class="tm-contact-link"> <i class="fas fa-link tm-contact-icon"></i>{{$delivery_detail->link_to_website_listing_page}} </a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--    THIRD START TABE -->
            <div id="deals" class="w3-container city" style="display:none">
               <div class="tab-Deals-bg">
                  <div class="tab-deals">
                     <a href="#"><img src="img/doller-2.png"></a>
                     <h2>No Deals Available</h2>
                     <span>There are currently no deals available, please check<br> back again at a later time!</span>
                  </div>
               </div>
            </div>
            <!-- FORTH START TABE -->
            <div id="Review" class="w3-container city" style="display:none">
               <div class="tab-second">
                  <div class="tab-review">
                     <h2>Be the first to review!</h2>
                     <h3>Be the first to review Marijuana Doctor-Englewood and<br> share your experience with the Bud & Carriage community.</h3>
                     <button class="btn-riew">Write a review</button>
                  </div>
               </div>
            </div>
            <!-- FIFTH START TABE -->
            <div id="Media" class="w3-container city" style="display:none">
               <div class="tab-second-cl">
                  <div class="tab-detail">
                     <h2>Be the first to review!</h2>
                     <p>This business hasn't uploaded any photos or videos yet. Click
                        <br> below to learn more about this business.
                     </p>
                     <button class="btn-detail-2">view detail</button>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script>
         function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("city");
            for(i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
         }
      </script>



@include('web.includes.footer');