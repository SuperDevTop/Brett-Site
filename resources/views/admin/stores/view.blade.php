@include('admin.includes.header');
@include('admin.includes.aside');

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 style="text-align: center;">Store Profile</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row" style="display: flex; justify-content: center;">
          <div class="col-md-8">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  @if($customer_data->logo && $customer_data->logo != '')
                    <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/stores/').'/'.$customer_data->logo}}" alt="User profile picture">
                    @else
                    <img class="profile-user-img img-fluid img-circle img_custom" src="{{asset('assets/img/stores/default/default.png')}}" />
                  @endif
                </div>
                <h3 class="profile-username text-center">{{$customer_data->name}}</h3>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Business User Name: </b> <a class="float-right">{{$customer_data->business_user_data->first_name." ".$customer_data->business_user_data->last_name}}</a>
                  </li>
                  
                  <li class="list-group-item">
                    <b>Store Address: </b> <a class="float-right">{{$customer_data->address}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Phone No: </b> <a class="float-right">{{$customer_data->phone}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Description: </b> <a class="float-right">{{$customer_data->description}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Website Link: </b> <a class="float-right" href="{{$customer_data->link_to_website_listing_page}}">{{$customer_data->link_to_website_listing_page}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Scial Media Link: </b> <a class="float-right" href="{{$customer_data->link_with_social_media}}">{{$customer_data->link_with_social_media}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Email Address: </b> <a class="float-right">{{$customer_data->email}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Store Hours: </b> <a class="float-right">{{$customer_data->store_hours}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status: </b> <a class="float-right">
                      @if($customer_data->status == 1)
                        <img src="{{asset('assets/img/images/tick.png')}}" title="Active" style="width: 26px;" />
                        @else
                        <img src="{{asset('assets/img/images/cross.png')}}" title="In-Active" style="width: 26px;" />
                      @endif
                    </a>
                  </li>
                  <li class="list-group-item">
                    <b>Latitude: </b> <a class="float-right">{{$customer_data->lat}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Longitude: </b> <a class="float-right">{{$customer_data->long}}</a>
                  </li>

                  <li class="list-group-item">
                    <b>Delivery Service Info: </b> <a class="float-right">{{$customer_data->delivery_service_info}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>About Us Info: </b> <a class="float-right">{{$customer_data->about_us_info}}</a>
                  </li>
                  
                </ul>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@include('admin.includes.footer');