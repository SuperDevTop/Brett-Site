<script type="text/javascript">
    var stores = <?php echo json_encode($all_stores);?>;
    var markers = [];
    var infowindow = "";
    var map = "";
    var contentString = "";
    var store_img = "<?php echo asset('assets/img/stores');?>/";
</script>
<div class="col-md-12">
  <div id="map"></div>
</div>
<div class="col-md-3 stores_main_container">
    <div class="stores_details"></div>
    <div class="business_lising">
        @php
          $counter = 0;
        @endphp
        @if( isset($all_stores) && count($all_stores) > 0 )
          @foreach( $all_stores as $key => $each_store )
            <div class="container  mt-3">
              <div class="row">
                    <?php
                    if( $each_store->company_logo_status == 1 ) {?> 
                      <div class="col-md-5">
                          @if(isset($each_store->logo) && $each_store->logo != '')
                              <img src="{{asset('assets/img/stores').'/'.$each_store->logo}}" style="width: 100%;border-radius: 6px;">
                            @else
                              <img src="{{asset('assets/img/stores/default/default.png')}}" style="width: 100%;border-radius: 6px;">
                          @endif
                      </div>
                      <?php
                    }?>
                    <div class="col-md-7">  
                      <h5 class="store_name">{{$each_store->name}}</h5>
                      <p class="store_address">Dispensary . Recreational</p>
                      <a href="javascript:void(0);" onclick="getDispensaryDetails('<?php echo $each_store->id;?>','<?php echo $counter++;?>', 'store_clicked');" class="btn btn-success p-1 view_store_details_sub">
                          View Details
                      </a>
                    </div>
              </div>
            </div>
            <hr />
          @endforeach
          @else
          <div class="p-3 pt-5">
            <h2 class="text-center text-danger">No Store Found against the search filters.</h2>
            <p class="text-center"> You can find more stores near by your location from the top bar search location.</p>
          </div>

        @endif
    </div>
</div>
<div class="info_div"></div>
<script>
    function initMap() {
      var myMapCenter = {lat: 31.5204, lng: 74.3587};
      map = new google.maps.Map(document.getElementById('map'), {
        center: myMapCenter,
        zoom: 14,
        streetView: false,
        gestureHandling: 'greedy',
        disableDefaultUI: true,
          styles: [
              {
                  featureType: 'transit',
                  elementType: 'labels.icon',
                  stylers: [{ visibility: 'off' }]
              },
              {
                  featureType: 'poi',
                  stylers: [{ visibility: 'off' }]
              },
              // {
              //     featureType: 'road',
              //     stylers: [{ visibility: 'off' }]
              // },
          ]
      });
      // const styledMapType = new google.maps.StyledMapType(
     //    [
     //      {
     //    "featureType": "all",
     //    "stylers": [
     //      { "color": "#C0C0C0" }
     //    ]
     //  },{
     //    "featureType": "road.arterial",
     //    "elementType": "geometry",
     //    "stylers": [
     //      { "color": "#CCFFFF" }
     //    ]
     //  },{
     //    "featureType": "landscape",
     //    "elementType": "labels",
     //    "stylers": [
     //      { "visibility": "off" }
     //    ]
     //  }
     //    ],
     //    { name: "Styled Map" }
     //  );
     //  map.mapTypes.set("styled_map", styledMapType);
     //  map.setMapTypeId("styled_map");

      


      function markStore(storeInfo){
        // dispensary.png
        var img_base_url = "<?php echo asset('assets/img/maps');?>/";
        if( storeInfo.category == 1 ) {
          img_base_url += "doctor.png";
        } else if( storeInfo.category == 2 ) {
          img_base_url += "dispensary_orange.png";
        } else if( storeInfo.category == 3 ) {
          img_base_url += "delivery.png";
        } else {
          img_base_url += "dispensary.png";
        }

        if( storeInfo.marker_status == 1 ) {
          var icon = {
              url: img_base_url,
              // scaledSize: new google.maps.Size(50, 50), // scaled size
              // origin: new google.maps.Point(0,0), // origin
              // anchor: new google.maps.Point(0, 0) // anchor
          };
          var marker = new google.maps.Marker({
            map: map,
            position: {lat: parseFloat(storeInfo.lat), lng: parseFloat(storeInfo.long) },
            icon: icon,
            title: storeInfo.name
          });
          markers.push(marker);

          marker.addListener('click', function(){
            
            infowindow = new google.maps.InfoWindow({
                content: contentString,
            });
            infowindow.close();

            showStoreInfo(storeInfo,marker);

          });

        }
        
        // marker.addListener('mouseover', function(){
        //  showStoreInfo(storeInfo);
        //  infowindow.open({
        //       anchor: marker,
        //       map,
        //       shouldFocus: false,
        //     });

        // });

        // marker.addListener('mouseout', function() {
        //     infowindow.close();
        // });
      }


      // show store info in text box
      var activeInfoWindow = "";
      function showStoreInfo(storeInfo,marker){
          getDispensaryDetails(storeInfo.id);
          contentString =
          '<div id="content" style="padding: 0 0px;width:350px;">' +
            '<img src="'+store_img+storeInfo.logo+'" style="width: 100px; height: 100px;float:left; margin-right:15px;" />' +
            '<h4 id="firstHeading" class="firstHeading">'+storeInfo.name+'</h4>' +
            "<p>Dispensary . Recreational</p>"+
          "</div>";
          infowindow = new google.maps.InfoWindow({
              content: contentString,
          });
          if (activeInfoWindow) { activeInfoWindow.close();}
          infowindow.open({anchor: marker,map,shouldFocus: true});
          activeInfoWindow = infowindow;

      }
        

      // setTimeout(function(){
        stores.forEach(function(store){
          markStore(store);
        });
      // }, 3000);
        
      
    }
    function open_info_marker(param) {
      infowindow.open(map,markers[param]);
    }

  var activeInfoWindow = "";
  function getDispensaryDetails(dispensary_id, sotre_counter,calling_from) {
    $(".stores_details").hide();
    $.ajax({
      url: "{{ url('get_dispesary_details') }}",
      type:"POST",
      data:{
        "dispensary_id": dispensary_id,
        "_token": "<?php echo csrf_token() ?>"
      },
      success:function(response){
          $(".stores_details").fadeIn(1000);
          $(".stores_details").html($.parseJSON(response).html);
          $(".business_lising").hide();
          
          var storeInfo = $.parseJSON(response).json_store[0];
          contentString =
          '<div id="content" style="padding: 0 0px;width:350px;">' +
            '<img src="'+store_img+storeInfo['logo']+'" style="width: 100px; height: 100px;float:left; margin-right:15px;" />' +
            '<h4 id="firstHeading" class="firstHeading">'+storeInfo['name']+'</h4>' +
            "<p>Dispensary . Recreational</p>"+
          "</div>";
          infowindow = new google.maps.InfoWindow({
              content: contentString,
          });
          
          if (activeInfoWindow) { activeInfoWindow.close();}
          infowindow.open({anchor: markers[sotre_counter],map,shouldFocus: true});
          activeInfoWindow = infowindow;


      },  
    });
  }
</script>