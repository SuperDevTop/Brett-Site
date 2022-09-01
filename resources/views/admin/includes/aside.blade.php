<!-- SIDE BAR STARTS -->
<?php
  $data = \App\Http\Controllers\PortalSetting::portalSettings();
  $logo = "assets/img/web/b_c_logo_large.png";
  if( isset($data[0]->logo) ) {
      $logo = "assets/img/settings/".$data[0]->logo;
  }
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin_dashboard') }}" class="brand-link">
      <img src="{{asset($logo)}}" alt="Bud and Carriage Logo" class="brand-image elevation-3">
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/img/profile').'/'.$usersData->profile_photo_path}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block">{{$usersData->first_name.' '.$usersData->last_name}}</a>
        </div>
      </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
              <li class="nav-item">
                <a href="{{ route('admin_dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('customer_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/customer' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-user"></i>
                  <p>Users</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('business_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/business' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-users"></i>
                  <p>Business Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin_employee_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/admin_employee' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-users"></i>
                  <p>Admins/Employees</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('stores_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/stores' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-home"></i>
                  <p>Stores/Businesses</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('categories_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/categories' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-object-group"></i>
                  <p>Business User Category</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('admin_advertiements') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/banners' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-object-group"></i>
                  <p>Banner Advertisements</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('amenities_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/amenities' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-object-group"></i>
                  <p>Business Amenitites</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('location_banner_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/location_banners' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-object-group"></i>
                  <p>Homepage Location Banners</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('claim_listing') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/claimListing' ){{ 'active' }}@endif">
                  <i class="nav-icon fa fa-object-group"></i>
                  <p>Claim Store Requests</p>
                </a>
              </li>

              @php
              $parent_class = "";
              $display_sub_ul = "";
              if( (request()->segment(1).'/'.request()->segment(2) == 'admin/products') || (request()->segment(1).'/'.request()->segment(2) == 'admin/productsCategory') )
              {
                $parent_class = "menu-is-opening menu-open";
                $display_sub_ul = "display: block;";
              }
              @endphp

              <li class="nav-item {{$parent_class}}" >
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>Products <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview" style="{{$display_sub_ul}}">
                  <li class="nav-item">
                    <a href="{{ url('admin/productsCategory') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/productsCategory' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ url('admin/products') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/products' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>

                </ul>
              </li>


              @php
              $parent_class = "";
              $display_sub_ul = "";
              if( (request()->segment(1).'/'.request()->segment(2) == 'admin/adminProfile') || (request()->segment(1).'/'.request()->segment(2) == 'admin/portalSettings') )
              {
                $parent_class = "menu-is-opening menu-open";
                $display_sub_ul = "display: block;";
              }
              @endphp

              <li class="nav-item {{$parent_class}}" >
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>Settings <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview" style="{{$display_sub_ul}}">
                  <li class="nav-item">
                    <a href="{{ url('admin/adminProfile/view/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/adminProfile' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Profile</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ url('admin/portalSettings') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/portalSettings' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Portal Settings</p>
                    </a>
                  </li>

                </ul>
              </li>

              @php
              $parent_class = "";
              $display_sub_ul = "";
              if( (request()->segment(1).'/'.request()->segment(2) == 'admin/paymentSettings') ||  (request()->segment(1).'/'.request()->segment(2) == 'admin/transactions') )
              {
                $parent_class = "menu-is-opening menu-open";
                $display_sub_ul = "display: block;";
              }
              @endphp
              <li class="nav-item {{$parent_class}}" >
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-dollar-sign"></i> 
                  <p>Payments <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview" style="{{$display_sub_ul}}">
                  <li class="nav-item">
                    <a href="{{ url('admin/transactions/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/transactions' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Transactions</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/paymentSettings/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/paymentSettings' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payment methods</p>
                    </a>
                  </li>
                </ul>
              </li>


              @php
              $parent_class_subscription = "";
              $display_sub_ul_subscription = "";
              if( (request()->segment(1).'/'.request()->segment(2) == 'admin/plans') || (request()->segment(1).'/'.request()->segment(2) == 'admin/planCatDetails') )
              {
                $parent_class_subscription = "menu-is-opening menu-open";
                $display_sub_ul_subscription = "display: block;";
              }
              @endphp

              <li class="nav-item {{$parent_class_subscription}}" >
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-signal"></i>
                  <p>Subscriptions <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview" style="{{$display_sub_ul_subscription}}">

                  <li class="nav-item">
                    <a href="{{ url('admin/planCatDetails/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/planCatDetails' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Plans Categories Detail</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('admin/plans/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/plans' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Plans</p>
                    </a>
                  </li>
                </ul>
              </li>

              @php
              $parent_class_subscription = "";
              $display_sub_ul_subscription = "";
              if( (request()->segment(1).'/'.request()->segment(2) == 'admin/landingPage') || (request()->segment(1).'/'.request()->segment(2) == 'admin/productPage') || (request()->segment(1).'/'.request()->segment(2) == 'admin/footerPage') )
              {
                $parent_class_subscription = "menu-is-opening menu-open";
                $display_sub_ul_subscription = "display: block;";
              }
              @endphp

              <li class="nav-item {{$parent_class_subscription}}" >
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-globe"></i>
                  <p>CMS <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview" style="{{$display_sub_ul_subscription}}">
                  <li class="nav-item">
                    <a href="{{ url('admin/landingPage/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/landingPage' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Landing Page</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/productPage/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/productPage' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Product Page</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/footerPage/') }}" class="nav-link @if( request()->segment(1).'/'.request()->segment(2) == 'admin/footerPage' ){{ 'active' }}@endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Footer</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin_logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Logout</p>
                </a>
              </li>

            </ul>
        </nav>
    </div>
</aside>
