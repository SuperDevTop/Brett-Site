@include('web.includes.header');
<html>
<head>
<style type="text/css">

  .profile {
      float: left;
      width: 40%;
      margin: auto;
      margin-top: 50px;
      padding: 20px 30px 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
      background-color: #ffffff;
  }

} 
</style>
</head>
  <body>
    <div class="container" style="overflow: hidden; margin-bottom: 200px;">
      
      <div style="margin-top: 55px; display: block; border-bottom:1px solid #eeeeee; height: 50px; overflow: hidden;">
        <div class="tabs">
          <ul class="tabs-list">
            @include('web.includes.top_nav_business_profile')
          </ul>
        </div>
      </div>
      
      <h2 style="text-align: left; margin-top: 20px;">My Store Profile</h2>
      <form action="{{ url('EditStoreProfileProcess') }}" method="post" enctype="multipart/form-data" class="profile-form">
          @csrf
          <input type="hidden" name="old_profile_image" value="{{$business_data->logo}}">
          <input type="hidden" name="store_id" value="{{$business_data->id}}">
          <input type="hidden" id="store_location_name" name="store_location_name" value="<?php echo $business_data->store_location;?>" />
          <input type="hidden" id="store_lat" name="store_lat" value="<?php echo $business_data->lat;?>"  />
          <input type="hidden" id="store_lng" name="store_lng" value="<?php echo $business_data->long;?>"  />
        <div class="row">
        <!-- First Section -->
        <div class="profile">
          @if(session('errormessage'))
            <div class="alert alert-danger" role="alert">
              <strong>{{session("errormessage")}}</strong>
            </div>
          @endif
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8 mb-3">
                  @if($business_data->logo && $business_data->logo != '')
                    <img style="height: 100px; width: 100px; border-radius: 50%;" src="{{asset('assets/img/stores/').'/'.$business_data->logo}}" alt="User profile picture" style="width: 200px;height: 200px;display: block;margin: 0 auto;margin-bottom: 18px;border-radius: 10px;">
                    @else
                    <img style="height: 100px; width: 100px; border-radius: 50%;" src="{{asset('assets/img/stores/default/default.png')}}" style="width: 200px;height: 200px;display: block;margin: 0 auto;margin-bottom: 18px;border-radius: 10px;" />
                  @endif
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                  <input type="file" style="display:none;" id="profile_image" name="profile_image" value="" class="w-100">
                  <label for="profile_image" style="float:right; margin-top: 40px;">Edit</label>
                  @error('profile_image')<span class="text-danger">{{ $message }}</span>@enderror
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">Business Name</label>
                  <input type="text" name="Bname" placeholder="Business Name" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('Bname',$business_data->name)}}"  class="w-100">
                  @error('Bname')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">Business Address</label>
                  <input type="text" name="addres" id="business_address" placeholder="Address" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('addres',$business_data->address)}}"  class="w-100">
                  @error('addres')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: none;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">Business Location</label>
                  <input type="text" name="store_location" id="store_location" placeholder="Store City" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('store_location',$business_data->store_location)}}"  class="w-100">
                  @error('store_location')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">Business Phone</label>
                  <input type="text" name="phone" id="phone" placeholder="Business Phone" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('phone',$business_data->phone)}}"  class="w-100">
                  @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">My Store Site</label>
                  <input type="text" name="website" id="website" placeholder="Website Link" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('website',$business_data->link_to_website_listing_page)}}"  class="w-100">
                  @error('website')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">Business Email</label>
                  <input type="text" name="email" id="email" placeholder="Email" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('email',$business_data->email)}}"  class="w-100">
                  @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

          </div>
        </div>  
        <!-- First Section -->

        <!-- Second Section -->
        <div style="width: 50%; margin-top:50px; border: 1px solid #eeeeee;">
          <div class="row" style="padding: 20px;">
            
              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">Radius</label>
                  <input type="text" name="radius" id="radius" placeholder="Radius" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('radius',$business_data->radius)}}"  class="w-100">
                  @error('radius')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                <div style="float: left; margin-top: 30px;" >
                  <label style="color: #555555;">Link with Social Media</label>
                  <input type="text" name="link_with_social_media" id="link_with_social_media" placeholder="Link to social media site" style="font-size: 12px; border: none; padding: 5px; color:#999999;" value="{{old('link_with_social_media',$business_data->link_with_social_media)}}"  class="w-100">
                  @error('link_with_social_media')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                  <label style="color: #555555;">Delivery Service</label>
                  <textarea rows="5" name="delivery_service_info" cols="50" placeholder="Delivery Service Info Description" class="w-100">{{old('delivery_service_info',$business_data->delivery_service_info)}}</textarea>
                  @error('delivery_service_info')<span class="text-danger">{{ $message }}</span>@enderror
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3" style="border-bottom: 1px solid #999999; display: block;">
                  <label style="color: #555555;">About Us</label>
                  <textarea rows="5" name="about_us_info" cols="50" placeholder="About Store Description" class="w-100">{{old('about_us_info',$business_data->about_us_info)}}</textarea>
                  @error('about_us_info')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
          </div>

          <span style="display: none;">
          <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab" style="padding: 30px;">
            <div class="container">
              
              <div class="row label_input_verticle_center">
                <div class="col-md-3 text-right"><strong>SEO Title</strong></div>
                <div class="col-md-7 text-left">
                    <input type="text" name="seo_title" placeholder="SEO Title" class="form-control" value="<?php echo $business_data->seo_title;?>">
                </div>
              </div>

              <div class="row label_input_verticle_center">
                <div class="col-md-3 text-right"><strong>SEO Description</strong></div>
                <div class="col-md-7 text-left">
                    <textarea rows="4" name="seo_description" cols="50" class="form-control" spellcheck="true" placeholder="SEO Description"> <?php echo $business_data->seo_description;?></textarea>
                </div>
              </div>

              <div class="row label_input_verticle_center">
                <div class="col-md-3 text-right"><strong>SEO Keyword</strong></div>
                <div class="col-md-7 text-left">
                    <input type="text" name="seo_keyword" placeholder="SEO Keyword" class="form-control" value="<?php echo $business_data->seo_keyword;?>">
                </div>
              </div>

              <div class="row label_input_verticle_center">
                <div class="col-md-3 text-right"><strong>SEO Image</strong></div>
                <div class="col-md-7 text-left">
                    <input type="file" id="seo_image" name="seo_image" class="form-control" style="padding: 3px;">
                    @if($business_data->seo_image && $business_data->seo_image != '')
                      <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/stores/').'/'.$business_data->seo_image}}" alt="User profile picture" style="width: 200px;height: 200px;display: block;margin: 0 auto;margin-bottom: 18px;border-radius: 10px;">
                      @else
                      <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/stores/default/default.png')}}" style="width: 200px;height: 200px;display: block;margin: 0 auto;margin-bottom: 18px;border-radius: 10px;" />
                    @endif
                </div>
              </div>


            </div>
          </div>
        </span>
        
          <?php
                    $url = "";
                    if( $business_data->category == 3 ) {
                      $url = "deliveryDetails"."/".$business_data->id;
                    } else if( $business_data->category == 2 ) {
                      $url = "dispensaryDetails"."/".$business_data->id;
                    } else if( $business_data->category == 1 ) {
                      $url = "doctorDetails"."/".$business_data->id;
                    }
                  ?>
        </div>
        <!-- End Second Section -->

        <div class="col-lg-12" style="margin-top: 50px;">
            <style type="text/css">
                ul#myTab {
                    padding-bottom: 0;
                    border-bottom: 0;
                }
                .img_custom {
                    width: 25px;
                    height: 25px;
                }
                . {
                    display: flex;
                    align-items: baseline;
                }
            </style>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                      Add Hours
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Add Amenities
                    </a>
                </li>
                <?php
                if($business_data->import_photos_status == 1 || $business_data->import_videos_status == 1) {?>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                          Add Media
                        </a>
                    </li>
            <?php
                }?>
            </ul>

            <div class="tab-content" id="myTabContent" style="padding:10px;border: 2px solid #CCC;border-radius: 15px;padding: 0;">
                <!-- Service Time -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="container" style="margin-top: 20px;">
                    <?php
                    $hours = $business_data->store_hours;
                    $monday = "";
                    $tuesday = "";
                    $wednesday = "";
                    $thursday = "";
                    $friday = "";
                    $saturday = "";
                    $sunday = "";
                    if( isset($hours) && $hours != '' && $hours != NULL ) {
                        $hours = json_decode($hours);
                        $monday = $hours->monday_time;
                        $tuesday = $hours->tuesday_time;
                        $wednesday = $hours->wednesday_time;
                        $thursday = $hours->thursday_time;
                        $friday = $hours->friday_time;
                        $saturday = $hours->saturday_time;
                        $sunday = $hours->sunday_time;
                    }
                    ?>

                        <div class="row ">

                            <div class="col-md-6 text-left">
                                <span><strong>MONDAY:</strong></span><input type="text" name="monday_time" style="border: none; width: 200px;" placeholder="09:00AM - 09:00PM" value="<?php echo $monday;?>">
                            </div>

                            <div class="col-md-6 text-left">
                                <span><strong>TUESDAY:</strong></span><input type="text" name="tuesday_time" style="border: none; width: 200px;" placeholder="09:00AM - 09:00PM"  value="<?php echo $tuesday;?>">
                            </div>

                            <div class="col-md-6 text-left">
                                <span><strong>WEDNESDAY:</strong></span><input type="text" name="wednesday_time" style="border: none; width: 200px;" placeholder="09:00AM - 09:00PM"  value="<?php echo $wednesday;?>">
                            </div>

                            
                            <div class="col-md-6 text-left">
                                <span><strong>THURSDAY:</strong></span><input type="text" name="thursday_time" style="border: none; width: 200px;" placeholder="09:00AM - 09:00PM"  value="<?php echo $thursday;?>">
                            </div>

                            <div class="col-md-6 text-left">
                                <span><strong>FRIDAY:</strong></span><input type="text" name="friday_time" style="border: none; width: 200px;" placeholder="09:00AM - 09:00PM"  value="<?php echo $friday;?>">
                            </div>

                            <div class="col-md-6 text-left">
                                <span><strong>SATURDAY:</strong></span><input type="text" name="saturday_time" style="border: none; width: 200px;" placeholder="OFF"  value="<?php echo $saturday;?>">
                            </div>

                            <div class="col-md-6 text-left">
                                <span><strong>SUNDAY:</strong></span><input type="text" name="sunday_time" style="border: none; width: 200px;" placeholder="OFF"  value="<?php echo $sunday;?>">
                            </div>
                        </div>
                    </div>
                    @error('store_hours')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                 <!-- End Service Time -->

                  <!-- Service Amenities -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="padding: 12px;">
                <div class="row form-inline">
                    <?php
                    $stored_amenity_exploded = "";
                    if( isset($business_data->store_amenity) ) {
                        if( $business_data->store_amenity != '' ) {
                            $stored_amenity_exploded = explode(",",$business_data->store_amenity);
                        } 

                    }
                    ?>
                    @if($amenities)
                        @foreach($amenities as $val => $amenitiy)
                        <div class="col-md-6 mb-3" style="display:flex; flex-direction:column; justify-content:center;    align-items: center;">
                            <span><?php
                            
                            if( $stored_amenity_exploded != '' &&  in_array($amenitiy->id, $stored_amenity_exploded) ) {?>
                                <input type="checkbox" name="amenitites[]" checked style="width: 22px;height: 22px;" value="{{$amenitiy->id}}">  
                            <?php
                            } else {?>
                                <input type="checkbox" name="amenitites[]" style="width: 22px;height: 22px;" value="{{$amenitiy->id}}">  
                            <?php
                            }
                            ?></span>{{$amenitiy->name}}
                        </div>
                        @endforeach
                    @endif
                </div>
                </div>
                <!-- End Service Amenitis -->
                
            <!--Media Section -->
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab" style="padding: 30px;">
                
                <input type="file" multiple name="upload_media[]" id="upload_media" />
                @error('upload_media')<span class="text-danger">{{ $message }}</span>@enderror

                <br /><br />
                <style type="text/css">
                .media_images {
                    border: 2px solid #CCC;
                    border-radius: 10px;
                    text-align: center;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                </style>
                <div class="row">
                @if($store_media)
                    @foreach($store_media as $val => $each_store)
                            <?php                          
                            $name_of_media = $each_store->media_name;
                            $info = pathinfo($name_of_media);
                            if( isset($info['extension']) && $info['extension'] != '' ) {?>
                                <div class="col-md-4 mb-4">
                                <?php
                                // pdf,mp4,mov,ogg,avi,flv,wmv
                                if( ($info['extension'] == "jpg") ||  ($info['extension'] == "jpeg") ||  ($info['extension'] == "png") ||  ($info['extension'] == "gif") ) {?>
                                    <a href="{{asset('assets/img/store_media/').'/'.$name_of_media}}" target="_blank" class="media_images">
                                    <img src="{{asset('assets/img/store_media/').'/'.$name_of_media}}" style="max-width: 100%; max-height: 100%;">
                                    </a>
                                <?php
                                } elseif( ($info['extension'] == "mp4") ||  ($info['extension'] == "mov") ||  ($info['extension'] == "ogg") ||  ($info['extension'] == "avi") ||  ($info['extension'] == "flv") ||  ($info['extension'] == "wmv") ) {?>
                                    <video width="320" height="240" controls>
                                    <source src="{{asset('assets/img/store_media/').'/'.$name_of_media}}" type="video/<?php echo $info['extension'];?>">
                                    </video>
                                <?php
                                }?>
                                </div>
                            <?php
                            }
                            ?>
                    @endforeach
                @endif
                </div>
            </div>
            <!-- End Media Section-->
            </div>

            <div style="display: block; margin:auto; margin-top: 50px; text-align: center;">
                <div style="display: block; margin: auto; align-item: center; text-align: center;">
                    <button class="btn btn-success" style="padding: 15px; margin: 15px;"> <i class="fa fa-save"></i> Update Store Information </button>
                    <a class="btn btn-success t" href="{{url($url)}}" target="_blank" style="padding: 15px;color: #FFF !important; margin: 15px;">  <i class="fa fa-eye"></i>  View Store</a>
                </div>
            </div>
        </div>
      </form>
    </div>
  </body>
</html>