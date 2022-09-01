@include('web.includes.header');
<html>
<head>
<style type="text/css">

  .profile {
      float: left;
      margin: auto;
      margin-top: 20px;
      padding: 20px 30px 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
      background-color: #ffffff;
  }

  .profile input {
    border: none;
  }
  
  .profile select {
    border: none;
  }

  .profile textarea {
    border: none;
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
    
    <div class="container">
      <h2 style="text-align: left; margin-top: 20px;">My Produsts</h2>
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
        <form  action="{{ url('AddProductsProcess') }}" method="post" enctype="multipart/form-data" class="profile-form">
          <h1 style="text-align: center;font-weight: 200; color: #999999; margin-top: 20px;">Add Products</h1>
          @csrf
          <div class="profile" >
          
            <div class="row">
              <div class="col-lg-12">
                <textarea rows="2" name="product_info" cols="50" placeholder="Product Details" class="form-control w-100" required></textarea>
                @error('product_info')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
              
            <div class="row">
              <div class="col-lg-12 col-md-6 col-sm-6 mb-2" style="border: none; display: none;">
                <select class="form-control" name="category" required style="border: none;">
                  <option value="">Business Category</option>
                  <option value="3">Delivery Driver</option>
                  <option value="1">Doctor</option>
                  <option value="2">Dispensary</option>
                </select>
              </div>
              <div class="col-lg-12 col-md-6 col-sm-6 mb-2" style="border: none;">
                <select class="form-control" name="p_category" required style=" border: none;">
                  <option value="">Product Category</option>
                  @if(isset($products_categories) && count($products_categories) > 0)
                    @foreach($products_categories as $each_p_cat)
                      <option value="{{$each_p_cat->id}}">{{$each_p_cat->name}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              
              <div class="col-lg-12 col-md-3 col-sm-4 mb-1">
                <input type="text" class="form-control w-100" name="product_name" value="" placeholder="Product Name" required>
              </div>
              
              <div class="col-lg-12 col-md-3 col-sm-4mb-1">
                <input type="number" step="0.01" class="form-control w-100" id="price" name="price" value="" placeholder="Price" required>
              </div>

              <div class="col-lg-12 col-md-3 col-sm-4 mb-1">
                <input type="number" step="0.01" class="form-control w-100" id="weight" name="weight" value="" placeholder="Weight">
              </div>
        
              <div class="col-lg-12 col-md-3 col-sm-4 mb-1">
                <input type="number" class="form-control w-100" id="size" name="size" value="" placeholder="Size">
              </div>

              <div class="col-lg-12 col-md-3 col-sm-4mb-1">
                <input type="number" class="form-control w-100" id="quantity" name="quantity" value="" placeholder="Quantity">
              </div>

              <div class="col-lg-12 col-md-3 col-sm-4 mb-1">
                <input type="file" style="display: none;" id="profile_image" name="profile_image" class=" w-100" value="" placeholder="" style="padding: 5px;">
                <label class="form-control w-100" style="border: none; text-align: cneter;" for="profile_image">Add Image</label>
              </div>

            </div>

            <div class="row">                  
              
                <button class="btn btn-success w-100" style="padding: 6px !important;"> Add Product </button>
              
            </div>
          </div>
        </form>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
          <div><h1 style="text-align: center;font-weight: 200; color: #999999; margin-top: 20px;">All Products</h1></div>
            <table style="margin-top: 30px;" class="table">
              <thead>
                <tr>
                  <th style="text-align:center; font-weight: bold;">#</th>
                  <th style="text-align:center;font-weight: bold;">Name</th>
                  <th style="text-align:center; font-weight: bold;">Description</th>
                  <th style="text-align:center; font-weight: bold;">Image</th>
                  <th style="text-align:center;; font-weight: bold;">Price</th>
                  <th style="text-align:center; font-weight: bold;">Action</th>
                </tr>
              </thead>
              <tbody>
                <style type="text/css">
                  .main_image {
                    width: 100px;
                  }
                </style>
                @php
                  $i = 1;
                @endphp
               <?php
                if( count($products_data) > 0 ) {?>
              @foreach($products_data as $category)
                <tr>
                  <th style="font-weight: normal !important; text-align:center;">{{$i++}}</th>
                  <th style="font-weight: normal !important; text-align:center;">{{$category->name}}</th>
                  <th style="font-weight: normal !important; text-align:center;">{{$category->description}}</th>
                  <th style="font-weight: normal !important; align-item: center; jusify-content: center;">
                                
                  @if($category->image && $category->image != '')
                    <img src="{{asset('assets/img/products/').'/'.$category->image}}" alt="User profile picture" style="width: 100px;height: 100px;display: block;margin: auto; ">
                  @else
                                    
                  @endif
                  </th>
                  <th style="font-weight: normal !important; text-align:center;">{{$category->regular_price}}</th>
                  <th style="font-weight: normal !important;">
                    <div class="col-sm-12" style="display: flex;justify-content: space-around;align-items: center;">
                    <?php
                    if( $category->featured == 0  ) {?>
                      <button class="btn btn-success " style="width: 100px;" onclick="mark_featured_un_featured('<?php echo $category->store_id;?>','<?php echo $category->id;?>','<?php echo $category->featured;?>');">Mark</button>
                      <?php
                        } else {?>
                        <button class="btn btn-success" style="width: 100px;"  onclick="mark_featured_un_featured('<?php echo $category->store_id;?>','<?php echo $category->id;?>','<?php echo $category->featured;?>');">Featured</button>
                    <?php
                      }
                    ?>
                    </div>

                    <div class="col-sm-12">
                      <div style="margin: auto; text-align: center;"> 
                        <a href="{{url('singleProductDetails').'/'.$category->id}}" style="color: green;">
                          <i class="fa fa-eye"></i>
                        </a>
                          |
                        <a href="{{url('productsEdit').'/'.$category->id}}" style="color: orange;">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                          |
                        <a href="{{url('singleProductDelete').'/'.$category->id}}" style="color: red;">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                    </div>
                  </th>
                </tr>
                @endforeach
                <?php
                } else {?>
                <tr>
                  <td style="font-weight: normal !important;" colspan="100">
                    <div class="p-5 text-center" style="display: block; margin:0 auto ">
                      <h2 class="text-center text-danger">No Produts Found.</h2>
                      <p class="text-center"> You can add new products from the Add Form.</p>
                    </div>
                  </td>
                </tr>
                <?php
                }?>
              </tbody>
            </table>
          </div>
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

</script>
 
@include('web.includes.footer');
</body>
</html>