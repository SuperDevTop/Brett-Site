<?php $data = \App\Http\Controllers\web\Home::portalSettings();?>
<!DOCTYPE html>
<html>

<head>
  <?php
  $logo = "";
  if( isset($data[0]->favi_logo) ) {
      if( $data[0]->favi_logo ) {
      if( isset($data[0]->logo) ) {
          $logo = "assets/img/settings/".$data[0]->favi_logo;?>
          <link rel="icon" type="image/x-icon" href="{{asset($logo)}}">
          <?php
      }
    }?>
  <?php
  }
  ?>
  <meta charset='utf-8'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="canonical" href="<?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {$url = "https://";} else  {$url = "http://";}$url.= $_SERVER['HTTP_HOST'];$url.= $_SERVER['REQUEST_URI'];echo $url;?>"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/web/style.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <link href='https://fonts.googleapis.com/css?family=Raleway:600,900,400' rel='stylesheet' type='text/css'>

  <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
<?php
$uri = $_SERVER['REQUEST_URI'];
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if( (strpos($url, "deliveryDetails") !== false) || (strpos($url, "doctorDetails") !== false) || (strpos($url, "dispensaryDetails") !== false) ){
  preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $store_id);
  if( isset($store_id[0][0]) && $store_id[0][0] != "" ) {
    $seoMetaTagsData = \App\Http\Controllers\web\Home::seoMetaTags($store_id[0][0]);

    $image_section_seo = asset($logo);
    if(isset($seoMetaTagsData->seo_image) && $seoMetaTagsData->seo_image != '') {
      $image_section_seo = asset('assets/img/stores').'/'.$seoMetaTagsData->seo_image;
    } else if(isset($seoMetaTagsData->logo) && $seoMetaTagsData->logo != '') {
      $image_section_seo = asset('assets/img/stores').'/'.$seoMetaTagsData->logo;
    }

    $seo_name_title = "";
    if(isset($seoMetaTagsData->seo_title) && $seoMetaTagsData->seo_title != '') {
      $seo_name_title = $seoMetaTagsData->seo_title;
    } else if(isset($seoMetaTagsData->name) && $seoMetaTagsData->name != '') {
      $seo_name_title = $seoMetaTagsData->name;
    }

    $seo_description = "";
    if(isset($seoMetaTagsData->seo_description) && $seoMetaTagsData->seo_description != '') {
      $seo_description = $seoMetaTagsData->seo_description;
    } else if(isset($seoMetaTagsData->about_us_info) && $seoMetaTagsData->about_us_info != '') {
      $seo_description = $seoMetaTagsData->about_us_info;
    }
    ?>
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $seo_name_title;?>" />
    <meta property="og:description" content="<?php echo $seo_description;?>" />
    <meta property="og:image" content="<?php echo $image_section_seo; ?>" />
    <meta property="fb:app_id" content="494157958577410"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Bud & Carriage" />
    <meta name="twitter:title" content="<?php echo $seo_name_title;?>" />
    <meta name="twitter:description" content="<?php echo $seo_description;?>" />
    <meta name="twitter:image" content="<?php echo $image_section_seo; ?>" />
  <?php
  }
} else if( (strpos($url, "singleProductDetails") !== false) || (strpos($url, "singleDealDetails") !== false) ){
  preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $product_id);
  if( isset($product_id[0][0]) && $product_id[0][0] != "" ) {
    $seoMetaTagsData = \App\Http\Controllers\web\Home::seoMetaTagsProducts($product_id[0][0]);
    $image_section_seo = asset($logo);
    if(isset($seoMetaTagsData->seo_image) && $seoMetaTagsData->seo_image != '') {
      $image_section_seo = asset('assets/img/products').'/'.$seoMetaTagsData->seo_image;
    } else if(isset($seoMetaTagsData->image) && $seoMetaTagsData->image != '') {
      $image_section_seo = asset('assets/img/products').'/'.$seoMetaTagsData->image;
    }

    $seo_name_title = "";
    if(isset($seoMetaTagsData->seo_title) && $seoMetaTagsData->seo_title != '') {
      $seo_name_title = $seoMetaTagsData->seo_title;
    } else if(isset($seoMetaTagsData->name) && $seoMetaTagsData->name != '') {
      $seo_name_title = $seoMetaTagsData->name;
    }

    $seo_description = "";
    if(isset($seoMetaTagsData->seo_description) && $seoMetaTagsData->seo_description != '') {
      $seo_description = $seoMetaTagsData->seo_description;
    } else if(isset($seoMetaTagsData->description) && $seoMetaTagsData->description != '') {
      $seo_description = $seoMetaTagsData->description;
    }
    ?>
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $seo_name_title;?>" />
    <meta property="og:description" content="<?php echo $seo_description;?>" />
    <meta property="og:image" content="<?php echo $image_section_seo; ?>" />
    <meta property="fb:app_id" content="494157958577410"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Bud & Carriage" />
    <meta name="twitter:title" content="<?php echo $seo_name_title;?>" />
    <meta name="twitter:description" content="<?php echo $seo_description;?>" />
    <meta name="twitter:image" content="<?php echo $image_section_seo; ?>" />
  <?php
  }
}
?>

  <!-- https://www.linkedin.com/sharing/share-offsite/?url={url} -->

<style type="text/css">
  .navbar {
  color: #fff;
  background: #fff !important;
  height: 80px;
  padding: 5px 16px;
  border-radius: 0;
  border-bottom: 1px solid #eeeeee;
  box-shadow: 0 0 4px rgba(0,0,0,.1);
}
.navbar img {
  border-radius: 50%;
  width: 36px;
  height: 36px;
  margin-right: 10px;
}
.navbar .navbar-brand {
  color: white;
  background-color: #47CF73;
  justify-content: center;
  padding: 10px;
  border-radius: 5px;
  font-size: 16px;    
}
.navbar .navbar-brand:hover, .navbar .navbar-brand:focus {
  color: #fff;
}

.navbar .nav-item span {
  position: relative;
  top: 3px;
}
.navbar .navbar-nav > a {
  color: #efe5ff;
  padding: 8px 15px;
  font-size: 14px;    
}
.navbar .navbar-nav > a:hover, .navbar .navbar-nav > a:focus {
  color: #fff;
  text-shadow: 0 0 4px rgba(255,255,255,0.3);
}
.navbar .navbar-nav > a > i {
  display: block;
  text-align: center;
}
.navbar .dropdown-item i {
  font-size: 16px;
  min-width: 22px;
}
.navbar .dropdown-item .material-icons {
  font-size: 21px;
  line-height: 16px;
  vertical-align: middle;
  margin-top: -2px;
}
.navbar .nav-item.open > a, .navbar .nav-item.open > a:hover, .navbar .nav-item.open > a:focus {
  color: #fff;
  background: none !important;
}
.navbar .dropdown-menu {
  margin-left:-200px
  border-radius: 1px;
  border-color: #e5e5e5;
  box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.navbar .dropdown-menu a {
  color: #777 !important;

  padding: 8px 20px;
  line-height: normal;
  font-size: 15px;
}
.navbar .dropdown-menu a:hover, .navbar .dropdown-menu a:focus {
  color: #333 !important;
  background: transparent !important;
}
.navbar .navbar-nav .active a, .navbar .navbar-nav .active a:hover, .navbar .navbar-nav .active a:focus {
  color: #fff;
  text-shadow: 0 0 4px rgba(255,255,255,0.2);
  background: transparent !important;
}
.navbar .navbar-nav .user-action {
  padding: 9px 15px;
  font-size: 15px;
}
.navbar .navbar-toggle {
  border-color: #fff;
}
.navbar .navbar-toggle .icon-bar {
  background: #fff;
}
.navbar .navbar-toggle:focus, .navbar .navbar-toggle:hover {
  background: transparent;
}
.navbar .navbar-nav .open .dropdown-menu {
  background: #faf7fd;
  border-radius: 1px;
  border-color: #faf7fd;
  box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.navbar .divider {
  background-color: #e9ecef !important;
}

</style>

</head>

<body>

<!-- menu start -->

  <?php  
    if( isset($_COOKIE["age_verification"]) ) {
    } else {?>
      <main id="main_age_verify">
        <article class="box">
          <div class="box-left">
          <p class="descri">Get plugged in with the Bud & Carriage, It is all about Weed
          </p>
          </div>
          <div class="box-right" id="error">
            <h3>Age Verification</h3>
            <p>By clicking enter, I certify that I am over the age of 21 and will comply with the above statement.</p>
            <a href="#" class="btn btn-alpha" onclick="agreed();" id="refresh-page">ENTER</a>
            <p class="decor-line"><span>Or</span></p>
            <a href="#" class="btn btn-beta" onclick="not_agreed();" id="reset-session">EXIT</a>
          </div>
          </div>
        </article>
        <div class="overlay-verify"></div>
      </main>
    <?php
    }

  ?>
  <?php
  if( isset($data[0]->google_api_key) ) {?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=<?php echo $data[0]->google_api_key;?>"></script>
  <?php
  }
  ?>

  <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
      <?php
        $logo = "assets/img/web/b_c_logo_large.png";
        if( isset($data[0]->logo) ) {
          $logo = "assets/img/settings/".$data[0]->logo;
        }
        $user = "assets/img/user.png";
      ?>

      <a href="{{url('home')}}"><img src="{{asset($logo)}}" alt="" class="" style="width:80px;height: 80px;"></a>   
      <ul class="nav mr-auto"><li class="nav-item"></li></ul>
      <!-- Collection of nav links, forms, and other content for toggling -->
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a href="{{url('search-filters/map?store=deliveries')}}" class="nav-link ">Deliveries</a>
        </li>
        <li class="nav-item">
          <a href="{{url('search-filters/map?store=dispensaries')}}" class="nav-link ">Dispensaries</a>
        </li>
        <li class="nav-item">
          <a href="{{url('search-filters/map?store=doctors')}}" class="nav-link ">Doctors</a>
        </li>
        <li class="nav-item">
          <a href="{{url('allProducts')}}" class="nav-link ">Products</a>
        </li>
        <li class="nav-item">
          <a href="{{url('allDeals')}}" class="nav-link ">Deals</a>
        </li>
      </ul>

        @if(Auth::check() )
        <div class=" nav ml-auto dropdown">
          
          <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action"><img src="{{asset($user)}}" class="avatar" alt="Avatar"></a>
          
          <div class="dropdown-menu" style="margin-left:-100px">
            <a href="{{ url('businessProfile') }}" class="dropdown-item"><i class="fa fa-user-o"></i>Profile</a>
            <a href="{{url('storePlans')}}" class="dropdown-item"><i class="fa fa-list-ol"></i> Business Plans</a>
            <div class="divider dropdown-divider"></div>

           
            <div class="divider dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a>
          </div>
        </div>
        @else
        <ul class="nav ml-auto" style="margin-top: -40px">
          <li class="nav-item" style="color: #111">
            <a class="nav-link" href="{{ route('signup') }}" style="color: black; font-size: 15px;"><span class="fas fa-user"></span> Sign Up</a>
          </li>
          <li class="nav-item" style="color: #111">
            <a class="nav-link" href="{{ route('login') }}" style="color: black; font-size: 15px;"><span class="fas fa-sign-in-alt"></span> Login</a>
          </li>
        </ul>

        @endif
  </nav>

  </body>
</html>

<!--  menu end -->