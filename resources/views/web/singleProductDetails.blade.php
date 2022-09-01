@include('web.includes.header');
   <style type="text/css">
      .p_images {
             width: 100%;
             border-radius: 14px;
             border: 4px solid #CCC;
             padding: 7px;
      }
   </style>
   <div class="container">
      <div class="col-md-4 col-lg-4" style="float: left">
         @if($products_data->image && $products_data->image != '')
            <img src="{{asset('assets/img/products/').'/'.$products_data->image}}" class="p_images" style="width: 100%;" />
            @else
            <img src="{{asset('assets/img/products/default/default.jpg')}}" class="p_images" style="width: 100%;"/>
         @endif
      </div>
      <div class="col-md-8 col-lg-8" style="float: left">




            <span class="hello-1" style="width: 40%;position: absolute;right: 0%;top: 9px;">
                  <?php
                    function curPageURL() {
                         $uri = $_SERVER['REQUEST_URI'];
                        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        return $url;
                    }

                   ?>
                   <div class="row" style="align-items: flex-end;">
                      <div class="col-md-5 pr-0" style="top: -3px;">
                        <i class="fa fa-share-alt"></i>&nbsp;&nbsp;Share on
                      </div>
                      <div class="col-md-2 pl-0 text-center">
                      <a href="https://twitter.com/share?url=<?php echo curPageURL();?>" style="color:#306F29; margin: 0px !important; padding: 0px !important;" target="_blank">
                        <i class="fab fa-twitter" style="font-size: 24px;"></i>
                      </a>
                      </div>
                      <div class="col-md-2 pl-0 text-center">
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo curPageURL();?>" style="color:#306F29; margin: 0px !important; padding: 0px !important;" target="_blank">
                          <i class="fab fa-linkedin" style="font-size: 24px;"></i>
                        </a>
                      </div>
                      <div class="col-md-2 pl-0 text-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo curPageURL();?>" style="color:#306F29; margin: 0px !important; padding: 0px !important;" target="_blank">
                          <i class="fab fa-facebook" style="font-size: 24px;"></i>
                        </a>
                      </div>
                   </div>
               </span>
               <input type="hidden" name="copyURL" id="copyURL" value="<?php echo curPageURL();?>">
               <style type="text/css">
                 .copyURL {
                    width: 229px;
                    border: 1px solid;
                    padding: 10px 12px;
                    margin-right: 10px;
                    line-height: 20px;
                    height: 2.5rem;
                    border-radius: 5px;
                    border-color: #60646f;
                 }
               </style>
               <span class="hello-1 copyURL" style="width: 15%;position: absolute;right: 0;top: 60px;" onclick="copyURL();"> Copy URL </span>
               <script type="text/javascript">
                  function copyURL() {
                    var copyText = document.getElementById("copyURL");
                    copyText.select();
                    navigator.clipboard.writeText(copyText.value);
                    alert("Url copied to clipboard");
                  }
               </script>




            <h2 style="font-size: 3rem;">{{$products_data->name}}</h2>
            <p><strong>Details: </strong>{{$products_data->description}}</p>
            <p><strong>Category: </strong>{{$products_data->c_name}}</p>
            <p><strong>Store Name: </strong>{{$products_data->st_name}}</p>
            <p><strong>Price: </strong>${{$products_data->regular_price}}.00</p>
            
            <p><strong>Weight: </strong>{{$products_data->weight}}</p>
            <p><strong>Size: </strong>{{$products_data->size}}</p>
            <p><strong>Quantity: </strong>{{$products_data->quantity}}</p>


            <p><strong>created Date: </strong>{{date('Y-m-d', strtotime($products_data->updated_at))}}</p>
      </div>
      <div style="clear: both;"></div>
   </div>

@include('web.includes.footer');
