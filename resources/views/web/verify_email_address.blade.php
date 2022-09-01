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
    .from-ordd:hover {
    background: #306F29;
    color: #FFF; 
  }
</style>

<div class="container">
  <div class="Rtunin">

    @error('email')
      <div class="alert alert-danger" role="alert">
        <span class="text-danger">{{ $message }}</span>
      </div>
    @enderror
   

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session("success")}}</strong>
      </div>
    @endif


     <div class="row bgh">
      <div class="col-md-2"></div>
      <div class="col-sm-8 you">
        <div class="thanks-bg" style="padding: 20px;">
          <h3>
            Hello {{$user_data->first_name." ".$user_data->last_name }}! <br />
            <p><a href="#"><i class="fa fa-check" aria-hidden="true"></i></a></p><br />
            Thank you for creating an account on Bud & Carriage! <br />
            <strong>Please verify your email for Bud & Carriage profile via email address you provided ({{$user_data->email}})</strong>
          </h3>

          <p> Please check your Spam & Junk Folder, Could not receive? <br />

                 <p id="demo" style="margin: 0; padding: 0"></p>
                 <script>var resendSignUpVerificationUrl = "https://bc.axcelstudio.com/resendSignUpVerification/<?php echo $user_data->email_verification_code;?>"; </script>
                 <a id="resend_text"  href="javascript:void();" onclick="resendSignUpVerification()" style="display: none;">
                   <p style="margin: 0; padding: 0">Resend Email</p>
                  </a>
                <strong>Or</strong><br />
              <a href="javascript:void(0);" onclick="show_email_box()"> Change Email Address </a><br />
          </p>
          <!-- Go to your <a href="{{url('businessProfile')}}"> Profile Page </a> to see the changes -->
          
          <form action="{{ route('changeSignUpVerification') }}" method="post" class="validation" enctype="multipart/form-data" id="change_email_address_form" data-cc-on-file="false" style="padding:10px;background: #cccccca3; display: none;">
          @csrf
            <h5>Change Email Address</h5>
            <div style="width: 61%;margin: 0 auto;display: flex;align-items: baseline;justify-content: center;">
                <input type="text" class="form-control" name="email" value="" id="email" placeholder="Email Address" required>
                <input type="hidden" name="verification_code" value="{{$user_data->email_verification_code}}">
                <button class="btn btn-success mt-3" style="width: 49%;margin-left: 10px;">Confirm Email</button>
            </div>
          </form>

           <script>
            function resendSignUpVerification() {
              setCookie("resend_email_start_datetime",new Date(),new Date(new Date().getTime() + minutes*60000))
              document.location = resendSignUpVerificationUrl;
            }
            function getCookie(cname) {
              let name = cname + "=";
              let decodedCookie = decodeURIComponent(document.cookie);
              let ca = decodedCookie.split(';');
              for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
              }
              return "";
            }

            function setCookie(cname, cvalue, exdays) {
              const d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              let expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            var get_current_time = new Date().getTime();
            // if( getCookie("resend_email_start_datetime") ) {
            //   if( getCookie("resend_email_start_datetime") != '' ) {
            //     get_current_time = getCookie("resend_email_start_datetime");
            //   }
            // }

            var minutes = 1;
            var countDownDate = new Date( get_current_time + minutes*60000);
            var x = setInterval(function() {
              var now = new Date().getTime();
              var distance = countDownDate - now;
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              document.getElementById("demo").innerHTML = '<strong>Resend Email In: </strong><span> '+seconds+'Seconds</span>';
              $("#resend_text").hide();
              if (distance < 0) {
              clearInterval(x);
              document.getElementById("demo").innerHTML = "";
              $("#demo").remove();
              $("#resend_text").show();
              }
            }, 1000);
            setCookie("resend_email_start_datetime",new Date(),new Date(new Date().getTime() + minutes*60000))
            </script>

        </div>
      </div>
      <div class="col-md-2"></div>
    </div>


   </div>
</div>

<script type="text/javascript">
  var asas = 1;
  function show_email_box() {
      if( asas == 1 ) {
        $("#change_email_address_form").show();
        asas  =0;
      } else {
        $("#change_email_address_form").hide();
        asas  =1;
      }
  }
</script>

</div>

@include('web.includes.footer');