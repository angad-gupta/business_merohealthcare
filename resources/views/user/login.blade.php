@extends('layouts.front')
@section('title','Login')
@section('content')

<style>

.login-tab .nav-tabs>li.active>a, .login-tab .nav-tabs>li.active>a:focus, .login-tab .nav-tabs>li.active>a:hover {
    border-top: 0px solid #2385aa !important;
    /* box-shadow: 0px 1px 2px #2385aa; */
    /* border-top: 4px solid #e0e0e000 !important; */
}

.login-tab .nav>li>a {
    background-color: #fff;
    font-size: 14px;
    color: #666;
}



.login-tab .nav-tabs>li.active>a, .login-tab .nav-tabs>li.active>a:focus, .login-tab .nav-tabs>li.active>a:hover {
    color: #2385aa;
    cursor: default;
    font-weight: 700;
    background-color: #ffffff;
    border: none;
    font-size: 14px;
    border-bottom: 2px dashed;
    

}
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 0;
  padding-right:10px;
}

@media only screen and (max-width: 767px){
.login-tab .nav>li>a {
    font-size: 14px;
}
}

.login-tab .nav>li {
width: 49.9%;
text-align: center;
}

/* body{
  background: url('https://www.hardstyle-releases.com/wp-content/uploads/2015/12/login-bg.png');
  
} */
@-webkit-keyframes bg-scrolling-reverse {
  100% {
    background-position: 50px 50px;
  }
}
@-moz-keyframes bg-scrolling-reverse {
  100% {
    background-position: 50px 50px;
  }
}
@-o-keyframes bg-scrolling-reverse {
  100% {
    background-position: 50px 50px;
  }
}
@keyframes bg-scrolling-reverse {
  100% {
    background-position: 50px 50px;
  }
}
@-webkit-keyframes bg-scrolling {
  0% {
    background-position: 50px 50px;
  }
}
@-moz-keyframes bg-scrolling {
  0% {
    background-position: 50px 50px;
  }
}
@-o-keyframes bg-scrolling {
  0% {
    background-position: 50px 50px;
  }
}
@keyframes bg-scrolling {
  0% {
    background-position: 50px 50px;
  }
}
/* Main styles */
body {
  

  /* img size is 50x50 */
  /* background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAABnSURBVHja7M5RDYAwDEXRDgmvEocnlrQS2SwUFST9uEfBGWs9c97nbGtDcquqiKhOImLs/UpuzVzWEi1atGjRokWLFi1atGjRokWLFi1atGjRokWLFi1af7Ukz8xWp8z8AAAA//8DAJ4LoEAAlL1nAAAAAElFTkSuQmCC") repeat 0 0; */
  -webkit-animation: bg-scrolling-reverse 7s infinite;
  /* Safari 4+ */
  -moz-animation: bg-scrolling-reverse 7s infinite;
  /* Fx 5+ */
  -o-animation: bg-scrolling-reverse 7s infinite;
  /* Opera 12+ */
  animation: bg-scrolling-reverse 7s infinite;
  /* IE 10+ */
  -webkit-animation-timing-function: linear;
  -moz-animation-timing-function: linear;
  -o-animation-timing-function: linear;
  animation-timing-function: linear;


}
body::before {
  /* content: "INFINITY"; */
  font-size: 8rem;
  font-weight: 100;
  font-style: normal;
}

.card__btn-group {
  margin-top: 35px;
  text-align: center;
}

.card__btn {
  position: relative;
  width: 150px;
  height: 40px;
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: uppercase;
  text-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
  background-color: #2385aa;
  background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(54, 213, 185, 0.7));
  border: none;
  color: white;
  border-radius: 5px;
  cursor: pointer;
  overflow: hidden;
  -webkit-transition: text-shadow 0.2s;
  transition: text-shadow 0.2s;
}
.card__btn span {
  position: relative;
  z-index: 1;
}
.card__btn::after {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  background-image: linear-gradient(135deg, rgba(54, 213, 185, 0.1), #2385aa);
  opacity: 0;
  -webkit-transition: opacity 0.2s, box-shadow 0.2s;
  transition: opacity 0.2s, box-shadow 0.2s;
}
.card__btn:hover::after, .card__btn:focus::after {
  opacity: 1;
}
.card__btn:active {
  text-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
}
.card__btn:active::after {
  box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.1);
}
.card__btn:focus {
  outline: none;
}

.login-form {
    padding: 0px 30px 40px 30px;
}

.login-tab .nav>li {
width: 49%;
text-align: center;
}
</style>
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.css">

<section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall" data-options="{direction: &quot;reverse&quot;, settings_mode_oneelement_max_offset: &quot;150&quot;}">
  <div class="divimage dzsparallaxer--target w-100 g-bg-cover g-bg-black-opacity-0_3--after" style="height: 120%; background-image: url(https://htmlstream.com/preview/unify-v2.6.3/assets/img-temp/1920x1080/img22.jpg); transform: translate3d(0px, -86.1295px, 0px);"></div>

  <div class="container g-pt-100">
    <div class="row justify-content-between align-items-center">
      <div class="col-md-6 col-lg-6 g-mb-100">
        <!-- Content Info -->
        <div class="mb-5">
          <h1 class="g-color-white g-font-weight-600 g-font-size-50 mb-3 h2">Business Merohealthcare</h1>
          <p class="g-color-white g-font-size-18"></p>
        </div>
        {{-- <a class="btn u-btn-primary g-font-weight-500 g-font-size-12 text-uppercase g-px-25 g-py-13 mr-3" href="#">
          Our Services
          <i class="g-pos-rel g-top-minus-1 ml-2 fa fa-angle-right"></i>
        </a>
        <a class="btn u-btn-black g-font-weight-500 g-font-size-12 text-uppercase g-px-25 g-py-13" href="#">
          Our Works
          <i class="g-pos-rel g-top-minus-1 ml-2 fa fa-angle-right"></i>
        </a> --}}
        <!-- End Content Info -->
      </div>

      <div class="col-md-6 col-lg-6 g-mb-100">
        <div class="" style="">
      
          <div class="container">
              <div class="row">
                  <div class="col-12" style="padding-left:0px; padding-right:0px">
            <div class="login-tab" style="border-radius:5px;">
              <div class="card__top">
                <div class="container">
                <h5 class="text-center h4 g-mt-5" style="color: white;padding-top:5px;">Account </h5>
                </div>
              </div>
              <ul class="nav nav-tabs" style="padding:0px 30px">
                <li class="active"><a data-toggle="tab" href="#login" style="font-weight:14px;padding-left: 0px;text-align: center;">LOGIN</a></li>
                <li><a data-toggle="tab" href="#signup" style="font-weight:14px;padding-left: 0px;text-align: center;">REGISTER</a></li>
              </ul>
              
              <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                  {{-- <div class="login-title text-center">
                    <h3>{{$lang->signin}}</h3>
                  </div> --}}
                    @include('includes.form-success')
                  <div class="login-form">
                    <form action="{{route('business-login-submit')}}" method="POST">
                      {{csrf_field()}}
                      
                      <div class="card__form g-mt-10" >
                        <div class="card__input-group">
                          <input class="card__input-group-input" id="email" name="email" type="email" required="required"/>
                          <label class="card__input-group-label">Email</label>
                        </div>
          
                        <div class="card__input-group">
                          <input class="card__input-group-input" name="password" type="password" required="required"/>
                          <label class="card__input-group-label">Password</label>
                          <a class="card__view-password"></a>
          
                        </div>
                       
                    
                        
                       
                        <div class="card__btn-group">
                          <button class="card__btn" type="submit" id="loading-button"><span>Log in</span> <i class="loading-icon fa fa-spinner fa-spin hide"></i> </button>
                        </div><a class="card__link" href="{{route('user-forgot')}}" target="_blank">Forgot password?</a>
                        
                        @if($sl->fcheck == 1  || $sl->gcheck == 1)
                        <div class="">
                            @if($sl->fcheck ==1)
                          <a href="{{route('social-provider','facebook')}}" class="btn btn-block u-btn-facebook rounded text-uppercase g-py-13 g-mb-15" style="background: #3b5998">
                            <i class="mr-3 icon-social-facebook"></i>
                            <span class="">Login with</span> Facebook
                          </a>
                          @endif
                            @if($sl->gcheck ==1)
                            <a href="{{route('social-provider','google')}}" class="btn btn-block u-btn-google-plus rounded text-uppercase g-py-13 g-mb-15">
                              <i class="mr-3 icon-social-google"></i>
                              <span class="">Login with</span> Google
                            </a>
                            @endif
                        </div>
                        @endif
                      </div>
          
                      <footer class="text-center">
                        <p class="g-color-gray-dark-v5 g-font-size-13 mb-0">Don't have an account? 
                          
                          <a class="g-font-weight-600 g-color-primary" data-toggle="tab" href="#signup">Signup</a>
                        </p>
                      </footer>
                     
                    </form>
                  </div>
                </div>
                <div id="signup" class="tab-pane fade">
                  {{-- <div class="login-title text-center">
                    <h3>{{$lang->signup}}</h3>
                  </div> --}}
                    @include('includes.form-error')
                  <div class="login-form">
                    <form action="{{route('business-register-submit')}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="card__form g-mt-10">
                    
                      <div class="row">
                        <div class="col-xs-6" >
                          <div class="card__input-group">
                            <input class="card__input-group-input" type="text" name="firstname" required="required"/>
                            <label class="card__input-group-label">First Name *</label>
                          </div>
                        </div>
                        {{-- <div class="col-xs-4">
                          <div class="card__input-group">
                            <input class="card__input-group-input" type="text" name="middlename"/>
                            <label class="card__input-group-label">Middle Name</label>
                          </div>
                        </div> --}}
                        <div class="col-xs-6">
                          <div class="card__input-group">
                            <input class="card__input-group-input" type="text" name="lastname" required="required"/>
                            <label class="card__input-group-label">Last Name *</label>
                          </div>
                        </div>
                      </div>
  
                      <div class="card__input-group">
                        <input class="card__input-group-input" type="email" name="email" required="required"/>
                        <label class="card__input-group-label">Email *</label>
                      </div>
          
                  
                          <div class="card__input-group">
                            <input class="card__input-group-input" type="text" name="companyname" required="required"/>
                            <label class="card__input-group-label">Company Name *</label>
                          </div>
                      
                          <div class="row">
                            <div class="col-xs-6">
                              <div class="card__input-group">
                                <input class="card__input-group-input" type="text" name="registrationname" required="required"/>
                                <label class="card__input-group-label">Registration no. *</label>
                              </div>
                            </div>
  
                            <div class="col-xs-6">
                              <div class="card__input-group">
                                <input class="card__input-group-input" type="number" name="phone" required="required"/>
                                <label class="card__input-group-label">Phone *</label>
                              </div>
                            </div>
                          </div>
  
                          <div class="row">
                            <div class="col-xs-6">
                              <div class="card__input-group">
                                <input class="card__input-group-input" type="text" name="panvat" required="required"/>
                                <label class="card__input-group-label">PAN/VAT *</label>
                              </div>
                            </div>
  
                            <div class="col-xs-6">
                              <div class="-group">
                                <input class="card__input-group-input" type="file" name="filenames[]" multiple required="required"/>
                                <label class="">Upload Registration Certificate *</label>
                              </div>
                            </div>
                          </div>
          
                      <div class="card__input-group">
                        <input class="card__input-group-input" type="text" name="address" required="required"/>
                        <label class="card__input-group-label">Address *</label>
                      </div>
          
                      <div class="card__input-group">
                        <input class="card__input-group-input" type="date"  name="dob" required="required"/>
                        <label class="card__input-group-label" >Date of Birth (MM/DD/YYYY) *</label>
                      </div>
          
                      <div class="btn-group justified-content">
                        <label class="u-check">
                          <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="gender" value="Male" type="radio" checked="">
                          <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked rounded-0">Male</span>
                        </label>
                        <label class="u-check">
                          <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="gender" value="Female" type="radio">
                          <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked g-brd-left-none--md rounded-0">Female</span>
                        </label>
                        <label class="u-check">
                          <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="gender" value="Other" type="radio">
                          <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked g-brd-left-none--md rounded-0">Others</span>
                        </label>
                      </div>
          
                      <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
                        <select id="reg_usertype" name="user_type" class="form-control rounded-0" id="" hidden>
                          <option>Business</option>
                        </select>
                      </div>
          
                      <div class="card__input-group">
                        <input class="card__input-group-input" type="password" name="password" required="required"/>
                        <label class="card__input-group-label">Password *</label>
                        <a class="card__view-password"></a>
                      </div>
          
          
                      <div class="card__input-group">
                        <input class="card__input-group-input" type="password" name="password_confirmation" required="required"/>
                        <label class="card__input-group-label">Re-Password *</label>
                        <a class="card__view-password"></a>
                      </div>
          
                      <div class="container row">
                        <label class="form-check-inline u-check g-pl-25" style="font-weight:400; ">
                          <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" onchange="document.getElementById('send').disabled = !this.checked;" checked>
                          <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                            <i class="fa" data-check-icon=""></i>
                          </div>
                         I accept the <a href="#"> Terms and Condition</a>
                       
                        </label>
                      </div>
                      <div class="card__btn-group">
                        <button class="" type="submit" id="loading-button-register" style="padding:5px 20px;"><span>SIGN UP</span> <i class="loading-icon fa fa-spinner fa-spin hide"></i></button>
                      </div>
                    </div>
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
    </div>
  </div>
</section>


    <!-- Starting of Login/registration area -->

    

    
<style>
.wrapper {
  display: -webkit-box;
  display: flex;
  -webkit-box-pack: center;
          justify-content: center;
  -webkit-box-align: center;
          align-items: center;
 
}

input {
  font-family: "Montserrat", sans-serif;
}
input:focus {
  outline: none;
}

input[type="radio"] {
  display: none;
}

.card {
  margin: 10px;;
  position: relative;
  width: 500px;
 
  min-height: 760px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.03);
  overflow: hidden;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.card__top {
  position: relative;
  height: 50px;
  background-color: #2385aa;
  /* background-image: url(https://www.dnnsoftware.com/Portals/0/Images/hero-background-5-5.jpg?ver=2017-08-18-002649-533); */
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  border-top-right-radius: 5px;
    border-top-left-radius: 5px;
}
.card__top::after {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-image: linear-gradient(135deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15));
}

.card__content {
  display: -webkit-box;
  display: flex;
  position: absolute;
  top: 200px;
  right: 0;
  bottom: 0;
  left: 0;
}

.card__tab {
  position: absolute;
  top: -95px;;
  right: 0;
  bottom: 0;
  left: 0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.03);
}
.card__tab:first-child .card__tab-label {
  left: 0;
  border-radius: 0 3px 0 0;
}
.card__tab:last-child .card__tab-label {
  right: 0;
  border-radius: 3px 0 0 0;
}

.card__tab-input:checked ~ .card__tab-inner {
  display: block;
  z-index: 1;
}
.card__tab-input:checked + .card__tab-label {
  font-weight: 600;
  background-color: rgba(255, 255, 255, 0.95);
  color: #333;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.03);
}
.card__tab-input:checked + .card__tab-label::after {
  display: block;
}

.card__tab-label {
  position: absolute;
  top: -55px;
  display: block;
  height: 55px;
  width: 50%;
  padding: 15px 0 0 20px;
  font-size: 12px;
  text-transform: uppercase;
  color: white;
  word-spacing: 9999999px;
  cursor: pointer;
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}
.card__tab-label::after {
  display: none;
  content: "";
  position: absolute;
  bottom: 0;
  left: 20px;
  width: 35px;
  height: 3px;
  background-color: #2385aa;
  box-shadow: 0 0 10px #2385aa;
}

.card__tab-inner {
  display: none;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 20px;
}

.card__input-group {
  position: relative;
  margin-bottom: 15px;
}

.card__input-group-label {
  position: absolute;
  top: 23px;
  left: 0;
  font-size: 13px;
  font-weight: 400;
  text-transform: uppercase;
  color: #999;
  -webkit-transition: top 0.2s, font-size 0.2s, color 0.2s;
  transition: top 0.2s, font-size 0.2s, color 0.2s;
  pointer-events: none;
}

.card__input-group-input {
  position: relative;
  width: 100%;
  height: 40px;
  margin: 10px 0 0;
  font-size: 13px;
  font-weight: 400;
  /* text-transform: uppercase; */
  border: none;
  border-bottom: 1px solid #e7ebec;
  -webkit-transition: border-color 0.2s;
  transition: border-color 0.2s;
}
.card__input-group-input::-moz-selection {
  background-color: #2385aa;
  color: white;
}
.card__input-group-input::selection {
  background-color: #2385aa;
  color: white;
}
.card__input-group-input:focus, .card__input-group-input:valid {
  border-color: #2385aa;
}
.card__input-group-input:focus + .card__input-group-label, .card__input-group-input:valid + .card__input-group-label{
  top: -8px;
  font-size: 12px;
  color: #2385aa;
}
.card__input-group-input[type="password"] ~ .card__view-password {
  opacity: 0.6;
}

.card__view-password {
  position: absolute;
  top: 50%;
  right: 0;
  width: 20px;
  height: 15px;
  margin-top: -3px;
  cursor: pointer;
  background-color: transparent;
  border: none;
  background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMTIiIHZpZXdCb3g9IjAgMCAyMCAxMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTkuNzkzOSA2LjEzNDc4TDIwIDUuNzk4MzdMMTkuNzkzOSA1LjQ2MThDMTkuNzU5NCA1LjQwNTYyIDE4LjkzMDIgNC4wNjczOCAxNy4zMTk1IDIuNzI2MjlDMTUuMTc3MSAwLjk0MjgwNiAxMi42NTMzIDAgMTAuMDIwNSAwQzcuMzg4NSAwIDQuODU4NDIgMC45NDIzMDMgMi43MDM4MiAyLjcyNDk1QzEuMDgzODQgNC4wNjUzNyAwLjI0NTM0NCA1LjQwMjYgMC4yMTA0NjMgNS40NTg5NUwwIDUuNzk4MzdMMC4yMTA0NjMgNi4xMzc4QzAuMjQ1MzQ0IDYuMTk0MTUgMS4wODM4NCA3LjUzMTM4IDIuNzAzODIgOC44NzE4QzQuODU4NDIgMTAuNjU0NCA3LjM4ODUgMTEuNTk2NyAxMC4wMjA1IDExLjU5NjdDMTIuNjUzMyAxMS41OTY3IDE1LjE3NzEgMTAuNjUzOSAxNy4zMTk1IDguODcwNDZDMTguOTMwMiA3LjUyOTM3IDE5Ljc1OTQgNi4xOTExMyAxOS43OTM5IDYuMTM0NzhaTTE2LjQ2MTIgNy45MDg4N0MxNC41MzQgOS41MDEzNSAxMi4zNjcgMTAuMzA4NyAxMC4wMjA1IDEwLjMwODdDNy42NzMyNSAxMC4zMDg3IDUuNDk5MiA5LjUwMDg0IDMuNTU4OTIgNy45MDczNkMyLjU1NTQgNy4wODMyOSAxLjg3NTA1IDYuMjQ4ODIgMS41NDE4MyA1Ljc5ODM3QzEuODc1MjEgNS4zNDc2IDIuNTU1NTcgNC41MTMyOSAzLjU1ODkyIDMuNjg5MjJDNS40OTkyIDIuMDk1OTEgNy42NzMwOSAxLjI4NzkzIDEwLjAyMDUgMS4yODc5M0MxMi4zNjcgMS4yODc5MyAxNC41MzM4IDIuMDk1NCAxNi40NjEyIDMuNjg3NzFDMTcuNDYwMiA0LjUxMzEzIDE4LjEzNDcgNS4zNDg3NyAxOC40NjM0IDUuNzk4MzdDMTguMTM0MyA2LjI0ODE0IDE3LjQ2IDcuMDgzNzkgMTYuNDYxMiA3LjkwODg3WiIgZmlsbD0iIzc1RTJDRiIvPjxwYXRoIGQ9Ik0xMC4wMDEzIDEuOTI4ODhDNy44Njc2MiAxLjkyODg4IDYuMTMxNzYgMy42NjQ3NCA2LjEzMTc2IDUuNzk4MzdDNi4xMzE3NiA3LjkzMjAxIDcuODY3NjIgOS42Njc4NyAxMC4wMDEzIDkuNjY3ODdDMTIuMTM0OSA5LjY2Nzg3IDEzLjg3MDggNy45MzIwMSAxMy44NzA4IDUuNzk4MzdDMTMuODcwOCAzLjY2NDc0IDEyLjEzNDkgMS45Mjg4OCAxMC4wMDEzIDEuOTI4ODhaTTEwLjAwMTMgOC4zNzk5NEM4LjU3NzgzIDguMzc5OTQgNy40MTk2OSA3LjIyMTgxIDcuNDE5NjkgNS43OTgzN0M3LjQxOTY5IDQuMzc0OTQgOC41Nzc4MyAzLjIxNjgxIDEwLjAwMTMgMy4yMTY4MUMxMS40MjQ3IDMuMjE2ODEgMTIuNTgyOCA0LjM3NDk0IDEyLjU4MjggNS43OTgzN0MxMi41ODI4IDcuMjIxODEgMTEuNDI0NyA4LjM3OTk0IDEwLjAwMTMgOC4zNzk5NFoiIGZpbGw9IiM3NUUyQ0YiLz48L3N2Zz4=);
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 1;
  -webkit-transition: opacity 0.2s;
  transition: opacity 0.2s;
}
.card__view-password:hover {
  opacity: 1 !important;
}
.card__view-password:focus {
  outline: none;
}

.card__btn-group {
  margin-top: 35px;
  text-align: center;
}

.card__btn {
  position: relative;
  width: 150px;
  height: 40px;
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: uppercase;
  text-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
  background-color: #2385aa;
  background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(54, 213, 185, 0.7));
  border: none;
  color: white;
  border-radius: 5px;
  cursor: pointer;
  overflow: hidden;
  -webkit-transition: text-shadow 0.2s;
  transition: text-shadow 0.2s;
}
.card__btn span {
  position: relative;
  z-index: 1;
}
.card__btn::after {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  background-image: linear-gradient(135deg, rgba(54, 213, 185, 0.1), #2385aa);
  opacity: 0;
  -webkit-transition: opacity 0.2s, box-shadow 0.2s;
  transition: opacity 0.2s, box-shadow 0.2s;
}
.card__btn:hover::after, .card__btn:focus::after {
  opacity: 1;
}
.card__btn:active {
  text-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
}
.card__btn:active::after {
  box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.1);
}
.card__btn:focus {
  outline: none;
}

.card__link {
  display: block;
  margin: 30px 0;
  font-size: 12px;
  font-weight: bold;
  text-align: center;
  text-transform: uppercase;
  text-decoration: none;
  color: #2385aa;
  -webkit-transition: color 0.2s;
  transition: color 0.2s;
}
.card__link:hover, .card__link:focus {
  color: #36d5b9;
}
.card__link:active {
  color: #2ac7ac;
}
.card__link:focus {
  outline: none;
}


input[type=date]:required:invalid::-webkit-datetime-edit {
    color: transparent;
}
input[type=date]:focus::-webkit-datetime-edit {
    color: black !important;
}

input:-webkit-autofill { +label { @extend .active; } } }

  </style>





<div class="wrapper" style="display: none;">
  <div class="card">
    <div class="card__top"></div>
    <div class="card__content">
      <div class="card__tab">
        <input class="card__tab-input" id="tab-1" type="radio" name="card-tab" checked="checked"/>
        <label class="card__tab-label" for="tab-1" style="color: #555;font-weight:400;">Login</label>
      
        
        <div class="card__tab-inner">
          @include('includes.form-success')
          <form action="{{route('user-login-submit')}}" method="POST">
            {{csrf_field()}}
            
            <div class="card__form" >
              <div class="card__input-group">
                <input class="card__input-group-input" id="email" name="email" type="email" required="required"/>
                <label class="card__input-group-label">Email</label>
              </div>

              <div class="card__input-group">
                <input class="card__input-group-input" name="password" type="password" required="required"/>
                <label class="card__input-group-label">Password</label>
                <a class="card__view-password"></a>

              </div>
             
          
              
             
              <div class="card__btn-group">
                <button class="card__btn" type="submit"><span>Log in</span></button>
              </div><a class="card__link" href="{{route('user-forgot')}}" target="_blank">Forgot password?</a>
              
              @if($sl->fcheck == 1  || $sl->gcheck == 1)
              <div class="">
                  @if($sl->fcheck ==1)
                <a href="{{route('social-provider','facebook')}}" class="btn btn-block u-btn-facebook rounded text-uppercase g-py-13 g-mb-15">
                  <i class="mr-3 icon-social-facebook"></i>
                  <span class="">Login with</span> Facebook
                </a>
                @endif
                  @if($sl->gcheck ==1)
                  <a href="{{route('social-provider','google')}}" class="btn btn-block u-btn-google-plus rounded text-uppercase g-py-13 g-mb-15" >
                    <i class="mr-3 icon-social-google"></i>
                    <span class="">Login with</span> Google
                  </a>
                  @endif
              </div>
              @endif
            </div>

            <footer class="text-center">
              <p class="g-color-gray-dark-v5 g-font-size-13 mb-0">Don't have an account? <a class="g-font-weight-600 g-color-primary" id="register">Signup</a>
              </p>
            </footer>
           
          </form>
      
         

        </div>


      </div>

    
      <div class="card__tab">
        <input class="card__tab-input" id="tab-2" type="radio" name="card-tab"/>
        <label class="card__tab-label" for="tab-2" style="color: #555;font-weight:400;">Register</label>
        <div class="card__tab-inner">
          <form action="{{route('user-register-submit')}}" method="POST">
            {{csrf_field()}}
          <div class="card__form">
            @include('includes.form-error')
            <div class="row">
              <div class="col-xs-6">
                <div class="card__input-group">
                  <input class="card__input-group-input" type="text" name="firstname" required="required"/>
                  <label class="card__input-group-label">First Name *</label>
                </div>
              </div>
              {{-- <div class="col-xs-4">
                <div class="card__input-group">
                  <input class="card__input-group-input" type="text" name="middlename"/>
                  <label class="card__input-group-label">Middle Name</label>
                </div>
              </div> --}}
              <div class="col-xs-6">
                <div class="card__input-group">
                  <input class="card__input-group-input" type="text" name="lastname" required="required"/>
                  <label class="card__input-group-label">Last Name *</label>
                </div>
              </div>
            </div>

            <div class="card__input-group">
              <input class="card__input-group-input" type="email" name="email" required="required"/>
              <label class="card__input-group-label">Email *</label>
            </div>
            <div class="card__input-group">
              <input class="card__input-group-input" type="number" name="phone" required="required"/>
              <label class="card__input-group-label">Phone *</label>
            </div>


            <div class="card__input-group">
              <input class="card__input-group-input" type="text" name="address" required="required"/>
              <label class="card__input-group-label">Address *</label>
            </div>

            <div class="card__input-group">
              <input class="card__input-group-input" type="date"  name="dob" required="required"/>
              <label class="card__input-group-label" >Date of Birth (MM/DD/YYYY) *</label>
            </div>

            <div class="btn-group justified-content">
              <label class="u-check">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="gender" value="Male" type="radio" checked="">
                <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked rounded-0">Male</span>
              </label>
              <label class="u-check">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="gender" value="Female" type="radio">
                <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked g-brd-left-none--md rounded-0">Female</span>
              </label>
              <label class="u-check">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="gender" value="Other" type="radio">
                <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked g-brd-left-none--md rounded-0">Others</span>
              </label>
            </div>

            <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
              <select id="reg_usertype" name="user_type" class="form-control rounded-0" id="" hidden>
                <option>Customer</option>
              </select>
            </div>

            <div class="card__input-group">
              <input class="card__input-group-input" type="password" name="password" required="required"/>
              <label class="card__input-group-label">Password *</label>
              <a class="card__view-password"></a>
            </div>


            <div class="card__input-group">
              <input class="card__input-group-input" type="password" name="password_confirmation" required="required"/>
              <label class="card__input-group-label">Re-Password *</label>
              <a class="card__view-password"></a>
            </div>

            <div class="container row">
              <label class="form-check-inline u-check g-pl-25" style="font-weight:400; ">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" onchange="document.getElementById('send').disabled = !this.checked;" checked>
                <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon=""></i>
                </div>
               I accept the <a href="#"> Terms and Condition</a>
             
              </label>
            </div>
            <div class="card__btn-group">
              <button class="card__btn" type="submit"><span>Sign up</span></button>
            </div>
          </div>
          </form>
        </div>
      </div>

      
    </div>
  </div>
</div>




<script>

'use strict';

let viewPassBtns = document.querySelectorAll('.card__view-password');

viewPassBtns.forEach(function (viewPassBtn) {

  viewPassBtn.onclick = function () {
    let passInput = this.parentNode.querySelector('.card__input-group-input');
    let currType = passInput.getAttribute('type');

    if (currType === 'password') {
      passInput.setAttribute('type', 'text');
    } else {
      passInput.setAttribute('type', 'password');
    }

  };

});
  </script>

    {{-- <input id="datepicker" width="276" /> --}}
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',

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

{{-- <script>
  jQuery(function(){
     jQuery('#refresh').click();
  });
  </script> --}}

<script>
  $(document). ready(function() {
  $('#register'). click(function() {
  $('input[type="radio"]'). not(':checked'). prop("checked", true);
  });
  });
  </script>

<script>
  $(document).ready(function(){
    $("#loading-button").on("click", function(){
      var $this = $(this);
      $(".loading-icon").removeClass("hide");
      // $("#proceed-payment").attr("disabled", true);
      $(".btn-txt").text("Processing");
      setTimeout(function() {
        $(".loading-icon").addClass("hide");
      }, 2000);
    });
  });
  </script>

<script>
  $(document).ready(function(){
    $("#loading-button-register").on("click", function(){
      var $this = $(this);
      $(".loading-icon").removeClass("hide");
      // $("#proceed-payment").attr("disabled", true);
      $(".btn-txt").text("Processing");
      setTimeout(function() {
        $(".loading-icon").addClass("hide");
      }, 10000);
    });
  });
  </script>

<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>

@endsection