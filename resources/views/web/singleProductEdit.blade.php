@include('web.includes.header');
<style>
  .tabs .tab {
    display: none;
    height: auto;
    border-radius: 3px;
    padding: 20px 15px;
    color: darkslategray;
    clear: both;
}
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600); 
.ads {
  padding: 10px;
  border: 1px solid #CCC;
}
#slider {
  position: relative;
  overflow: hidden;
  margin: 0px auto 0 auto;
  border-radius: 4px;
}

#slider ul {
  position: relative;
  margin: 0;
  padding: 0;
  height: 200px;
  list-style: none;
}

#slider ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 475px;
  height: 150px;
  background: #ccc;
  text-align: center;
  line-height: 300px;
}

a.control_prev, a.control_next {
  position: absolute;
  top: 26%;
  z-index: 999;
  display: block;
  padding: 4% 3%;
  width: auto;
  height: auto;
  background: #2a2a2a;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 18px;
  opacity: 0.8;
  cursor: pointer;
}

a.control_prev:hover, a.control_next:hover {
  opacity: 1;
  -webkit-transition: all 0.2s ease;
}

a.control_prev {
  border-radius: 0 2px 2px 0;
}

a.control_next {
  right: 0;
  border-radius: 2px 0 0 2px;
}

.slider_option {
  position: relative;
  margin: 10px auto;
  width: 160px;
  font-size: 18px;
}
.banner_images_profile {
  width: 100%;
    height: 100%;
    top: 0;
    position: absolute;
    left: 0;
}
button {
  border: none !important;
  padding: 5px !important;
  font-size: 1rem !important;

}
</style>
<div class="container-bg-home">

<div class="f-container mt">
    <div class="custom-container">
      <div class="tabs user-tab">
        <ul class="tabs-list">
           @include('web.includes.top_nav_business_profile')
        </ul>
      <br />
      <br />
      <br />
      <br />
      </div>

       @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{session("success")}}</strong>
        </div>
      @endif
      <div>
        <form  action="{{ url('EditProductProcess') }}" method="post" enctype="multipart/form-data" class="profile-form">
          <h1 style="text-align: center;font-weight: bold;color: #306F29;">Edit Product</h1>
            @csrf
            <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
            <div class="product-detail" style="width: 63%;margin: 0 auto;padding: 10px;border: 2px solid #306f29;border-radius: 10px;">
              <?php
              if( isset($products_data) && count($products_data) > 0 ) {?>
              <div class="row">
                <div class="col-md-12">
                  <textarea rows="4" name="product_info" cols="50" placeholder="Product Details" class="form-control w-100" value="<?php echo $products_data['description'];?>" required><?php echo $products_data['description'];?></textarea>
                  @error('product_info')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="row">
                  <div class="col-md-6 mb-3">
                      <select class="form-control" name="category" required style="margin-right: 2px; border: 1px solid #000">
                        <option value="">Business Category</option>
                        <option value="3" <?php if( $products_data['category_id'] == 3 ) { echo "selected";}?>>Delivery Driver</option>
                        <option value="1" <?php if( $products_data['category_id'] == 1 ) { echo "selected";}?>>Doctor</option>
                        <option value="2" <?php if( $products_data['category_id'] == 2 ) { echo "selected";}?>>Dispensary</option>
                      </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <select class="form-control" name="p_category" required style=" border: 1px solid #000">
                        <option value="">Product Category</option>
                        @if(isset($products_categories) && count($products_categories) > 0)
                          @foreach($products_categories as $each_p_cat)
                            <option <?php if( $products_data['product_category_id'] == $each_p_cat->id ) { echo "selected";}?> value="{{$each_p_cat->id}}">{{$each_p_cat->name}}</option>
                          @endforeach
                        @endif
                      </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <input type="text" class="form-control w-100" name="product_name" value="<?php echo $products_data['name'];?>"  placeholder="Product Name" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <input type="number" class="form-control w-100" id="price" name="price" value="<?php echo $products_data['regular_price'];?>"  placeholder="Price" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <input type="number" class="form-control w-100" id="weight" name="weight" value="<?php echo $products_data['weight'];?>"  placeholder="weight">
                  </div>

                  <div class="col-md-6 mb-3">
                    <input type="number" class="form-control w-100" id="size" name="size" value="<?php echo $products_data['size'];?>"  placeholder="size">
                  </div>

                  <div class="col-md-6 mb-3">
                    <input type="number" class="form-control w-100" id="quantity" name="quantity" value="<?php echo $products_data['quantity'];?>"  placeholder="quantity">
                  </div>

                  <div class="col-md-6">
                      <input type="file" id="profile_image" name="profile_image"   placeholder="" style="padding: 5px; width: 100%;">
                      <?php
                      if(isset($products_data['image']) && $products_data['image'] != ''){?>
                          <img src="{{asset('assets/img/products').'/'.$products_data['image']}}" class="main_image">
                      <?php
                      } else {?>
                          <img src="{{asset('assets/img/products/default/default.png')}}" class="main_image">
                      <?php
                      }
                      ?>
                  </div>

                  <span style="display: none;">
                    <style type="text/css">
                      .main_image {
                        width: 100px;
                        margin-bottom: 20px;
                      }
                    </style>
                    <h1 style="text-align: center;font-weight: bold;color: #306F29; width: 100%;"> Product SEO Meta </h1>
                    <div class="col-md-6">
                        <input type="text" name="seo_title" placeholder="SEO Title" class="form-control w-100" value="<?php echo $products_data['seo_title'];?>">
                        <input type="text" name="seo_keyword" placeholder="SEO Keyword" class="form-control w-100" value="<?php echo $products_data['seo_keyword'];?>">
                        <input type="file" id="seo_image" name="seo_image" class="form-control w-100" style="padding: 3px;">
                        <?php
                        if(isset($products_data['seo_image_name']) && $products_data['seo_image_name'] != ''){?>
                          <a href="{{asset('assets/img/products').'/'.$products_data['seo_image_name']}}" target="_blank">
                            <img src="{{asset('assets/img/products').'/'.$products_data['seo_image_name']}}" class="main_image">
                          </a>
                        <?php
                        } else {?>
                            <img src="{{asset('assets/img/products/default/default.png')}}" class="main_image">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-6 label_input_verticle_center">
                        <textarea rows="4" name="seo_description" cols="50" class="form-control w-100" style="min-height: 134px;" spellcheck="true" placeholder="SEO Description"><?php echo $products_data['seo_description'];?></textarea>
                    </div>
                  </span>

              </div>

              <div class="row">                  
                  <div class="col-md-12">
                      <button class="btn btn-success w-100" style="padding: 6px !important;"> Update Store Product </button>
                  </div>
              </div>
              <?php
              } else {?>
                <div class="p-3 pt-5">
                  <h2 class="text-center text-danger">No Store Product Found.</h2>
                  <span class="text-center" style="display: block">Sorry! This product is not belong to your store.</span>
                </div>
              <?php
              }?>
            </div>
        </form>

      </div>
      

      </div>
    </div>
  </div>

<script>
  function mark_featured_un_featured(store_id, p_id, p_status) {
    if( store_id ) {
        var ajax_hit = "";
        if( p_status == 1 ) {
              Swal.fire({
                title: 'Do you want to remove this product from featured?',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
              }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {
                    $.ajax({
                    url: "{{ url('mark_featured_un_featured_product') }}",
                    type:"POST",
                    data:{
                      "store_id": store_id,
                      "p_id": p_id,
                      "p_status": p_status,
                      "_token": "<?php echo csrf_token() ?>"
                    },
                    success:function(response){
                        var data = $.parseJSON(response);
                        if( data.status == 400 ) {
                            Swal.fire(
                              'Error!',
                              'Please Upgrade your Business Plan, Your Purchased Business plan can only mark 2 product as Featured.',
                              'warning'
                            );
                        } else  if( data.status == 300 ) {
                            Swal.fire(
                              'Success!',
                              'Product Removed from Featured',
                              'danger'
                            );
                            setTimeout(function(){
                              document.location.reload();
                            }, 2000);
                        } else  if( data.status == 200 ) {
                            Swal.fire(
                              'Success!',
                              'Product marked as Featured',
                              'success'
                            );
                            setTimeout(function(){
                              document.location.reload();
                            }, 2000);
                        }
                    },  
                  });
                }
              })
        } else {
            $.ajax({
              url: "{{ url('mark_featured_un_featured_product') }}",
              type:"POST",
              data:{
                "store_id": store_id,
                "p_id": p_id,
                "p_status": p_status,
                "_token": "<?php echo csrf_token() ?>"
              },
              success:function(response){
                  var data = $.parseJSON(response);
                  if( data.status == 400 ) {
                      Swal.fire(
                        'Error!',
                        'Please Upgrade your Business Plan, Your Purchased Business plan can only mark 2 product as Featured.',
                        'warning'
                      );
                  } else  if( data.status == 300 ) {
                      Swal.fire(
                        'Success!',
                        'Product Removed from Featured',
                        'danger'
                      );
                      setTimeout(function(){
                        document.location.reload();
                      }, 1000);
                  } else  if( data.status == 200 ) {
                      Swal.fire(
                        'Success!',
                        'Product marked as Featured',
                        'success'
                      );
                      setTimeout(function(){
                        document.location.reload();
                      }, 1000);
                  }
              },  
            });
        }
    }
  }
jQuery(document).ready(function(){

  $(".tabs-list li a").click(function(e){
     e.preventDefault();
  });

  $(".tabs-list li").click(function(){
     var tabid = $(this).find("a").attr("href");
     $(".tabs-list li,.tabs div.tab").removeClass("active");   // removing active class from tab

     $(".tab").hide();   // hiding open tab
     $(tabid).show();    // show tab
     $(this).addClass("active"); //  adding active class to clicked tab

  });

});
</script>

</div>
 
@include('web.includes.footer');
<script>
jQuery(document).ready(function ($) {

  // $('#checkbox').change(function(){
  //   setInterval(function () {
  //       moveRight();
  //   }, 3000);
  // });
  
  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;
  
  $('#slider').css({ width: slideWidth, height: slideHeight });
  
  $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });


    setInterval(function () {
        moveRight();
    }, 3000);

});    

$( function() {
        $( "#datepicker" ).datepicker();
  } );
  </script>