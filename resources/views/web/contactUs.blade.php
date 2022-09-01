@include('web.includes.header')
<style type="text/css">
.contact-form{
    background: #CCC;
    margin-top: 5%;
    margin-bottom: 5%;
    width: 70%;
}
.contact-form .form-control{
    border-radius:1rem;
}
.contact-image{
    text-align: center;
    padding-top: 45px;
}
.contact-image img{
    border-radius: 6rem;
    width: 11%;
    margin-top: -3%;
    transform: rotate(29deg);
}
.contact-form form{
    padding: 14%;
}
.contact-form form .row{
    margin-bottom: -7%;
}
.contact-form h3{
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}
.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}
.btnContactSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    background-color: #0062cc;
    border: none;
    cursor: pointer;
}
</style>
<div class="container-bg-home">
  <div class="container contact-form">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session("success")}}</strong>
              </div>
            @endif
            
            @if(session('error'))
              <div class="alert alert-dander alert-dismissible fade show" role="alert">
                <strong>{{session("error")}}</strong>
              </div>
            @endif
            
            <form action="{{ route('send-email') }}" method="post" enctype="multipart/form-data">
                @csrf
               <div class="row">
                    <div class="col-md-6"style="border-right: 3px solid #FFF;">
                        <div class="form-group">
                            <label><strong>&nbsp;First Name <span style="color: red;">*</span></strong></label>
                            <input type="text" name="txtName" class="form-control" placeholder="First Name" value="" required />
                        </div>
                        <div class="form-group">
                            <label><strong>&nbsp;Last Name</strong></label>
                            <input type="text" name="txtlName" class="form-control" placeholder="Last Name" value="" />
                        </div>
                        <div class="form-group">
                            <label><strong>&nbsp; Email <span style="color: red;">*</span></strong></label>
                            <input type="email" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
                        </div>
                        <div class="form-group">
                            <label><strong>&nbsp; Subject <span style="color: red;">*</span></strong></label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject" value="" />
                        </div>
                        <div class="form-group">
                            <label><strong>&nbsp; Message <span style="color: red;">*</span></strong></label>
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message" style="width: 100%; height: 150px;" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact w-100" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <h2 class="text-left"> Contact Us </h2>
                        <p class="text-left "><strong>Email:</strong> <?php echo $portal_settings[0]->email;?></p>
                        <p class="text-left "><strong>Phone:</strong> <?php echo $portal_settings[0]->phone;?></p>
                        <p class="text-left "><strong>Address:</strong> <?php echo $portal_settings[0]->location;?></p>
                    </div>
                </div>
            </form>
</div>
</div>
@include('web.includes.footer')