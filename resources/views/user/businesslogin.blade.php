@extends('layouts.front')
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

</style>

    <!-- Starting of Login/registration area -->

    
    <div class="section-padding login-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
          <div class="login-tab">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#login" style="font-size:18px;">{{$lang->signin}}</a></li>
              <li><a data-toggle="tab" href="#signup" style="font-size:18px;">{{$lang->signup}}</a></li>
            </ul>
            
            <div class="tab-content">
              <div id="login" class="tab-pane fade in active">
                <div class="login-title text-center">
                  <h3>Business {{$lang->signin}}</h3>
                </div>
                  @include('includes.form-success')
                <div class="login-form">
                  <form action="{{route('business-login-submit')}}" method="POST">
                              {{csrf_field()}}

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="login_email">{{$lang->doeml}}</label>
            <input type="email" name="email" class="form-control" id="login_email" placeholder="{{$lang->doeml}}" required>
                    </div>
                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="login_pwd">{{$lang->sup}}</label>
                  <input type="password" name="password" class="form-control" id="login_pwd" placeholder="{{$lang->sup}}" required>
                  <i id="pass-status" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPassword1();"></i>
                  {{-- <input type="checkbox" onclick="myFunction()">Show --}}
                  {{-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}
                        </div>
                    <button type="submit" class="btn btn-default btn-block">{{$lang->sie}}</button>
                    <div class="forgot-area text-right">
                      <a href="{{route('user-forgot')}}" target="_blank">{{$lang->fpw}}</a>
                    </div>
                    @if($sl->fcheck == 1  || $sl->gcheck == 1)
                    {{-- <div class="login-social-btn-area">

                        @if($sl->fcheck ==1)
                      <a href="{{route('social-provider','facebook')}}" class="social-btn"><i class="fa fa-facebook"></i> <span>{{ $lang->facebook_login }}</span></a>
                        @endif
                        @if($sl->gcheck ==1)
                      <a href="{{route('social-provider','google')}}" class="social-btn last-child"><i class="fa fa-google"></i> <span>{{ $lang->google_login }}</span></a>
                        @endif
                    </div> --}}
                    @endif
                  </form>
                </div>
              </div>
              <div id="signup" class="tab-pane fade">
                <div class="login-title text-center">
                  <h3>Create a new  Business Account
                       {{-- {{$lang->signup}} --}}
                    </h3>
                </div>
                  @include('includes.form-error')
                <div class="login-form">
                  <form action="{{route('business-register-submit')}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}

                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="reg_email">{{$lang->doeml}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->doeml}}" type="email" name="email" id="reg_email" required>
                      </div>

                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">First Name <span>*</span></label>
                        <input class="form-control" placeholder="First Name" type="text" name="firstname" id="reg_name" required>
                    </div>

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_name">Middle Name <span></span></label>
                      <input class="form-control" placeholder="Middle Name" type="text" name="middlename" id="reg_name" >
                  </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                    <label for="reg_name">Last Name <span>*</span></label>
                    <input class="form-control" placeholder="Last Name" type="text" name="lastname" id="reg_name" required>
                </div>
                
                      {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                          <label for="reg_name">{{$lang->fname}} <span>*</span></label>
                          <input class="form-control" placeholder="{{$lang->fname}}" type="text" name="name" id="reg_name" required>
                      </div> --}}

                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Date of Birth <span>*</span></label>
                        <input class="form-control" placeholder="Date of Birth" type="date" name="dob" id="reg_name" required>
                    </div>


                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
                        <label for="reg_usertype">Gender <span>*</span></label>
                        <select id="reg_usertype" name="gender" placeholder="Select gender" class="form-control rounded-0" id="">
                            {{-- <option >Select Gender</option> --}}
                          <option>Male</option>
                          <option>Female</option>
                          <option>Others</option>
                       
                        </select>
                      </div>

                    
                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Company Name <span>*</span></label>
                        <input class="form-control" placeholder="Company Name" type="text" name="companyname" id="reg_name" required>
                    </div>

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
                        <input class="form-control" placeholder="Company Name" type="file" name="filename" id="reg_name" required>
                    </div>


                    

                    

                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                        <label for="reg_name">Company details <span>*</span></label>
                        <input class="form-control" placeholder="Company details" type="text" name="companydetails" id="reg_name" required>
                    </div>

                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
                        <label for="reg_usertype">User Type <span>*</span></label>
                        <select id="reg_usertype" name="user_type" class="form-control rounded-0" id="">
                          {{-- <option>User</option> --}}
                          <option selected>Business</option>
                       
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
                          <input type="checkbox" checked><h6>&nbsp;Signing up you agreed our <a href=""> Terms and condition</a></h6>
                          </div>
                        </div>

                        

                    <button type="submit" class="btn btn-default btn-block">{{$lang->spe}}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>    
                </div>
            </div>
        </div>
    </div>

    
    

    
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