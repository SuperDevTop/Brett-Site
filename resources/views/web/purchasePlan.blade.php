@include('web.includes.header');
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<style type="text/css">
    .stripe_container, .if_payment_plan_amount_is_free {
      display: none;
    }
    .container {
        margin-top: 40px;
    }
    .panel-heading {
    display: inline;
    font-weight: bold;
    }
    .flex-table {
        display: table;
    }
    .display-tr {
        display: table-row;
    }
    .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 55%;
    }
</style>

<form action="{{ route('buyPlanProcess') }}" method="post" class="validation" enctype="multipart/form-data" id="payment-form" data-cc-on-file="false">
@csrf
<div class="container">
  <div class="Rtunin">
    <h3 class="ppp" style="color: #FFF;">Order Details</h3>
      <div class="row" style="justify-content: center;">
        @if( isset($plans_data) && count($plans_data) > 0 )
          @foreach( $plans_data as $key => $dispensary_plans )
            <input type="hidden" name="plan_id" value="<?php echo $dispensary_plans->id; ?>">
            <?php
            $plane_name = $dispensary_plans->plane_name;
            $plan_price = $dispensary_plans->price;
            ?>
          @endforeach

        @endif
  
          <div class="col-sm-8">
            <div class="order-rdit">
              <div class="from-ordd">
                
                <h3 class="ppp" style="color: #FFF;">Your order</h3>

                <div class="d-flex ">  
                  <div class="tax-1"><strong>PRODUCT</strong></div>
                  <div class="task-2"><strong>TOTAL</strong></div>
                </div>
          
                <div class="d-flex lg ">  
                  <div class="tax-1"><?php echo $plane_name;?> &nbsp;&nbsp; ×1</div>
                  <div class="task-2" id="plan_total" data-plan_total="<?php echo $plan_price;?>"><strong>$<?php echo $plan_price;?></strong></div>
                </div>

                <div class="d-flex ">  
                  <div class="tax-1">Subtotal</div>
                  <div class="task-2" id="sub_total"><strong>$<?php echo $plan_price;?></strong></div>
                </div>

                <div class="d-flex ">  
                  <div class="tax-1"><span style="color: red; font-size: 20px;font-family: auto;"> * </span> Pament Method</div>
                  @if( isset($payment_methods) && count($payment_methods) > 0 )
                    @foreach( $payment_methods as $key => $p_method )
                        <div class="task-2">
                          <input type="radio" name="payment_method" onclick="add_processing_fee(this,'<?php echo $p_method->processing_fee;?>','<?php echo $plan_price;?>');" data-processing_fee="<?php echo $p_method->processing_fee;?>" data-method_key="<?php echo $p_method->method_key;?>" data-method_secret="<?php echo $p_method->method_secret;?>" value="<?php echo $p_method->method_name_static;?>"> <?php echo $p_method->method_name_static;?>
                            <br />($<?php echo $p_method->processing_fee;?>)
                        </div>
                    @endforeach
                  @endif
                </div>
                <input type="hidden" name="processing_fee" id="processing_fee" value="">
                <div class="d-flex ">  
                  <div class="tax-1">Total</div>
                  <div class="task-2" id="grand_total"><strong>$<?php echo $plan_price;?></strong></div>
                  <input type="hidden" name="grand_total_amount" id="grand_total_amount" value="0">

                  <input type="hidden" name="method_key" id="method_key" value="">
                  <input type="hidden" name="method_secret" id="method_secret" value="">
                </div>
                <div class="stripe_container">  
                    <div class='form-row row'>
                        <div class='col-md-5 form-group required'>
                            <label class='control-label'>Name on Card</label> <input
                                class='form-control' size='4' type='text'>
                        </div>
                    
                        <div class='col-md-7 form-group card required' style="border: none;">
                            <label class='control-label'>Card Number</label> <input
                                autocomplete='off' class='form-control card-num' size='20'
                                type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-md-4 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> 
                            <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                                type='text'>
                        </div>
                        <div class='col-md-4 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                type='text'>
                        </div>
                        <div class='col-xs-4 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-md-12 hide error form-group'>
                            <div class='alert-danger alert'>Fix the errors before you begin.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-lg btn-block stripe_pay_now_btn" type="submit">Pay Now</button>
                        </div>
                    </div>
                </div>

                <div class="if_payment_plan_amount_is_free">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-lg btn-block" type="submit">Pay Now</button>
                        </div>
                    </div>
                </div>


                @if (Session::has('error'))
                    <div class="alert alert-danger text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif


                <button type="button" onclick="check_pre_filled_data();" class="btn btn-primary mn confirm_p">Confirm</button> 

              </div>
            </div>
          </div>
          

   </div>
</div>

</div>

<form>


@include('web.includes.footer');

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
  var grand_total = 0;
$(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    if( grand_total <= 0 ) {
        $('form.validation').submit();
    }
    $(".stripe_pay_now_btn").prop("disabled",true);
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($("#method_key").val());
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }
  
  });
  
  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
                $(".stripe_pay_now_btn").prop("disabled",false);
        } else {
            $(".stripe_pay_now_btn").prop("disabled",true);
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});
</script>
<script>
            function add_processing_fee(_this, p_fee, plan_price) {
                grand_total = plan_price;
                if( plan_price > 0 ) {
                    var subtotal = parseFloat(plan_price) + parseFloat(p_fee);
                    $("#grand_total").html("<strong>$"+subtotal+"</strong>");
                    $("#grand_total_amount").val(subtotal);

                    $("#processing_fee").val(parseFloat(p_fee));
                    if( $(_this).val() == "Stripe" ) {
                      $(".stripe_container").show();
                      $(".confirm_p").hide();
                    } else {
                      alert("Paypal is in-progress. Comming Soon!");
                      $(".stripe_container").hide();
                      $(".confirm_p").show();
                      $(".confirm_p").attr("type","button");
                    }
                    var method_key = $(_this).data("method_key");
                    var method_secret = $(_this).data("method_secret");

                    $("#method_key").val(method_key);
                    $("#method_secret").val(method_secret);
                } else {
                    $(".confirm_p").hide();
                    $(".if_payment_plan_amount_is_free").show();
                } 

            }
            function check_pre_filled_data() {
                if (!$("input[type='radio'][name='payment_method']").is(":checked")) {
                    alert("Please select Payment Method.");
                } else {
                    $("#buy_plan").submit();
                }
            }
          </script>

