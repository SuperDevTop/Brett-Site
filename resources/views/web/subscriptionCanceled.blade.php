@include('web.includes.header');

  
<div class="row bgh">
  <div class="col-sm-4 you">
    <div class="thanks-bg">
      <h2>Subscription Cancelled</h2>
      <p><a href="#"><i class="fa fa-times" aria-hidden="true" style="color: red; font-size: 50px;"></i></a></p>
      <p>You have successfully Cancelled a plan!</p>
      Go to your <a href="{{url('businessProfile')}}"> Profile Page </a> to see the changes
    </div>
  </div>
</div>

@include('web.includes.footer');