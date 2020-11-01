@extends('layouts.front')
@section('title','Product Seller Login')
@section('content')

<style>
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  padding-right:10px;
}

@media only screen and (max-width: 767px){
.login-tab .nav>li>a {
    font-size: 18px;
}
}

/* body{
  background: url('https://www.hardstyle-releases.com/wp-content/uploads/2015/12/login-bg.png');
  
} */

.footer-wrap{
    margin-top: 0px;
}


.area{
    background: #2385aa;  
    background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);  
    width: 100%;
    min-height:40vh;
    
   
}

.circles{
    /* position: absolute; */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* overflow: hidden; */
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;
    
}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}



@keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 40%;
    }

}


.login-tab .nav>li {
    width: 100%;
    text-align: center;
}

</style>


    <!-- Starting of Login/registration area -->
    <div class="area" >
      <ul class="circles">
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
      </ul>
    
    <div class="section-padding login-wrap" style="background-image: #f1f1f1;">
        <div class="container">
            <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
          <div class="login-tab">
            <ul class="nav nav-tabs">
                
              
              <li class="active"><a data-toggle="tab" href="#signup" style="font-size:15px;">Product Vendor Register</a></li>
              {{-- <li ><a data-toggle="tab" href="#login" style="font-size:15px;">Product Vendor Login</a></li> --}}
            </ul>
            
            <div class="tab-content">
              
              <div id="signup" class="tab-pane fade in active">
                {{-- <div class="login-title text-center">
                  <h3>{{$lang->signup}}</h3>
                </div> --}}
                  @include('includes.form-error')
                <div class="login-form">
                  <form action="{{route('product-vendor-register-submit')}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}

                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="reg_email">{{$lang->doeml}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->doeml}}" type="email" name="email" id="reg_email" required>
                      </div>

                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Company Name <span>*</span></label>
                        <input class="form-control" placeholder="Company Name" type="text" name="firstname" id="reg_name" required>
                    </div>

                    {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_name">Middle Name <span></span></label>
                      <input class="form-control" placeholder="Middle Name" type="text" name="middlename" id="reg_name" >
                  </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                    <label for="reg_name">Last Name <span>*</span></label>
                    <input class="form-control" placeholder="Last Name" type="text" name="lastname" id="reg_name" required>
                </div> --}}
                
                      {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="reg_name">{{$lang->fname}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->fname}}" type="text" name="name" id="reg_name" required>
                      </div> --}}


                    {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Date of Birth <span>*</span></label>
                        <input class="form-control" placeholder="Date of Birth" id="datepicker" name="dob" id="reg_name" required>
                    </div>

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
                      <label for="reg_usertype">Gender <span>*</span></label>
                      <select class="form-control" id="reg_usertype" name="gender" placeholder="Select gender" class="form-control rounded-0" id="" style="height:40px;">
              
                        <option>Male</option>
                        <option>Female</option>
                        <option>Others</option>
                     
                      </select>
                    </div> --}}

                    


                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
                        {{-- <label for="reg_usertype">User Type <span>*</span></label> --}}
                        <select id="reg_usertype" name="user_type" class="form-control rounded-0" id="" hidden>
                          <option>Product Vendor</option>
                          {{-- <option>Business</option> --}}
                       
                        </select>
                      </div>
                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="reg_Pnumber">{{$lang->doph}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->doph}}" type="text" name="phone" id="reg_Pnumber" required>
                      </div>
                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="reg_Padd">{{$lang->doad}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->doad}}" type="text" name="address" id="reg_Padd" required>
                      </div>

                      {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Company Name <span>*</span></label>
                        <input class="form-control" placeholder="Company Name" type="text" name="companyname" id="reg_name" required>
                    </div> --}}

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Registration Number <span>*</span></label>
                        <input class="form-control" placeholder="Registration Number" type="text" name="registrationname" id="reg_name" required>
                    </div>

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">PAN / VAT <span>*</span></label>
                        <input class="form-control" placeholder="PAN / VAT" type="text" name="panvat" id="reg_name" required>
                    </div>

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Upload Registration Certificate<span>*</span></label>
                        <input class="form-control" placeholder="Upload Reg File" type="file" name="filenames[]" id="reg_name" multiple required>
                    </div>
                    {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Company details <span>*</span></label>
                        <input class="form-control" placeholder="Company details" type="text" name="companydetails" id="reg_name" required>
                    </div> --}}


                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="reg_password">{{$lang->sup}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->sup}}" type="password" name="password" id="reg_password" required>
                          <i id="pass-status-create" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordCreate1()"></i>
                      </div>
                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="confirm_password">{{$lang->sucp}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->sucp}}" type="password" name="password_confirmation" id="confirm_password" required>
                          <i id="pass-status-create-confirm" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordCreateConfirm1()"></i>
                        </div>

                        <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <div class="container row">

                            <label class="form-check-inline u-check g-pl-25">
                              <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" onchange="document.getElementById('send').disabled = !this.checked;" checked>
                              <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                                <i class="fa" data-check-icon=""></i>
                              </div>
                             Signing up you agreed our <a href="#"> Terms and Condition</a>
                           
                            </label>

                   
                          </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="send" class="btn btn-default" style="padding:0 48px;">{{$lang->spe}}</button>
                        </div>

                  </form>
                </div>
              </div>

              <div id="login" class="tab-pane fade in">
                {{-- <div class="login-title text-center">
                  <h3>{{$lang->signin}}</h3>
                </div> --}}
                  @include('includes.form-success')
                <div class="login-form">
                  <form action="{{route('product-vendor-login-submit')}}" method="POST">
                              {{csrf_field()}}

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="login_email">{{$lang->doeml}} *</label>
            <input type="email" name="email" class="form-control" id="login_email" placeholder="{{$lang->doeml}}" required>
                    </div>
                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="login_pwd">{{$lang->sup}} *</label>
                  <input type="password" name="password" class="form-control" id="login_pwd" placeholder="{{$lang->sup}}" required>
                  <i id="pass-status" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPassword1();"></i>
                  {{-- <input type="checkbox" onclick="myFunction()">Show --}}
                  {{-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}
                        </div>
                        <div class="text-center">
                    <button type="submit" class="btn btn-default " style="padding: 0 48px;">{{$lang->sie}}</button>
                        </div>
                    <div class="forgot-area text-center">
                      <a href="{{route('user-forgot')}}" target="_blank"  style="font-size:13px;"><i class="icon-target"></i> {{$lang->fpw}}</a>
                    </div>
                    {{-- @if($sl->fcheck == 1  || $sl->gcheck == 1)
                    <div class="login-social-btn-area">

                        @if($sl->fcheck ==1)
                      <a href="{{route('social-provider','facebook')}}" class="social-btn text-center" style="border-radius:30px;padding: 6px;"> <span><i class="icon-social-facebook"></i> {{ $lang->facebook_login }}</span></a>
                        @endif
                        @if($sl->gcheck ==1)
                      <a href="{{route('social-provider','google')}}" class="social-btn last-child text-center" style="border-radius:30px;padding: 6px;"><span><i class="icon-social-google"></i> {{ $lang->google_login }}</span></a>
                        @endif
                    </div>
                    @endif --}}
                  </form>
                </div>
              </div>

            </div>
          </div>    
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- <input id="datepicker" width="276" /> --}}
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    

    
    <!-- Ending of Login/registration area -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
function viewPassword1()
{
  var passwordInput = document.getElementById('login_pwd');
  var passStatus = document.getElementById('pass-status');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash field-icon';
    
  }
  else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye field-icon';
  }
}

function viewPasswordCreate1()
{
  var passwordInput = document.getElementById('reg_password');
  var passStatus = document.getElementById('pass-status-create');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash field-icon';
    
  }
  else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye field-icon';
  }
}

function viewPasswordCreateConfirm1()
{
  var passwordInput = document.getElementById('confirm_password');
  var passStatus = document.getElementById('pass-status-create-confirm');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash field-icon';
    
  }
  else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye field-icon';
  }
}

</script>


@endsection