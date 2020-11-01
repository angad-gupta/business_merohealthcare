@extends('layouts.front')
@section('title','Ask A Doctor| Enquiry')
@section('content')
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.css">

<style>
.rounded-0 {
  border-radius: 30px !important;
}

</style>

<style>


   #askdoctor{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  }

  @media only screen and (max-width: 768px){
    #askdoctor{
    font-weight: 700 !important;
    color: #fefefe ;
    background-color: white !important;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }

  #askdoctor-mobile{
    font-weight: 700 !important;
    color: white !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }

  #askdoctor-mobile-a{
    color:white !important;
  }

}
</style>


      <div class="section-padding" style="padding-top: 0px; margin-top:20px;">
    
        <div class="container">
            <div class="">
                <section class="g-flex-centered g-min-height-500 g-bg-gray-light-v5 g-py-20" style="border-radius:30px; background-image: url(../../assets/img-temp/1920x1080/img10.jpg); padding-top:0px !important;">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6 align-self-center g-py-20 text-center">
                        <img class="w-100" src="{{ $doctor->photo ? asset('assets/images/'.$doctor->photo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Doctor Image" style="border-radius:20px;" >
                      </div>
    
                      <div class="col-md-6 align-self-center g-py-20">
                    
                        <article class="h-100 g-flex-middle g-brd-left g-brd-3 g-brd-primary g-pa-20">
                            <div class="g-flex-middle-item">
                              {{-- <h4 class="h6 g-color-black g-font-weight-600 text-uppercase g-mb-10">Ask A Doctor </h4>
                              <p class="g-color-black-opacity-0_7 mb-0">You can ask about your queries about your problem / products / Medicine.</p> --}}
                              <div class="g-py-5">
                                <div class="g-mb-15">
                                  <h4 class="h5 g-color-black g-mb-5">{{$doctor->name}}</h4>
                                  <em class="d-block g-font-style-normal g-font-size-14 text-uppercase g-color-primary">{{$doctor->post}}</em>
                                </div>
        
                                <ul class="list-unstyled g-color-gray-dark-v8">
                                    <li class="g-font-size-14">
                                        <strong>NMC No:</strong> {{$doctor->nmc}}
                                      </li>
        
                                  </ul>
                             
                              </div>
                            </div>
                          </article>

                          @if(!(Auth::guard('user')->check()))
                          <div class="container g-mt-10" >
                            <a class="btn btn-primary g-rounded-50 text-center" style="background-color:#28a745;color:white;" data-toggle="modal" data-target="#loginModal">Please <i class="icon-user"></i> Login to Ask Your Queries</a>
                          </div>
                          @endif
                        
                      </div>
                    </div>

                    
                  @if(Auth::guard('user')->check())
                    <form action="{{route('user-askdoctor')}}" method="POST" >
                        {{csrf_field()}}
                        @php
                        $user = Auth::guard('user')->user();
                        @endphp
                       
                      <div class="form-group g-mb-20">
                          <div class="row">
                              <div class="col-md-6">
                                <div class="form-group g-mb-20">
                                    <label class="g-mb-10" for="inputGroup1_1" >Your Email : </label>
                                    @if(Auth::guard('user')->check())
                                    <input value="{{$user->email}}" name="email" class="form-control form-control-md rounded-0" type="email" placeholder="Enter email" required>
                                    @else
                                    <input value="{{old('email')}}" name="email" class="form-control form-control-md rounded-0" type="email" placeholder="Enter email" required>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group g-mb-20">
                                    <label class="g-mb-10" for="inputGroup1_1" >Phone Number : </label>
                                    @if(Auth::guard('user')->check())
                                    <input value="{{$user->phone }} " name="phone" class="form-control form-control-md rounded-0" type="tel" placeholder="Enter phone" required>
                                    @else
                                    <input value="{{old('phone')}}" name="phone" class="form-control form-control-md rounded-0" type="tel" placeholder="Enter phone" required>
                                    @endif
                                </div>
                            </div>
            
                          </div>
                        <label class="g-mb-10" for="inputGroup2_2">Please, write your queries:</label>
                        <textarea class="form-control form-control-md u-textarea-expandable rounded-0" name="query" style="max-height:300px;" rows="3" placeholder="Write you queries..." required>{{old('query')}}</textarea>
                        <small class="form-text text-muted g-font-size-default g-mt-10">
                        </small>
                      </div>
                      @include('includes.form-success')
    
                      <div class="row text-center g-mb-10">
                        @if($lang->rtl == 1)
                        {{-- <div class="col-md-2 col-md-offset-6 col-sm-2 col-sm-offset-4 col-xs-2 col-xs-offset-4">
                            <span style="cursor: pointer; float: right;" class="refresh_code"><i class="fa fa-refresh fa-2x" style="margin-top: 10px;"></i></span>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <img id="codeimg" src="{{url('assets/images')}}/capcha_code.png">
                        </div> --}}
                        @else
                        <div class="col-md-4 col-sm-6 col-xs-6">
                          <h4>Enter the code *</h4>
                            <img id="codeimg" src="{{url('assets/images')}}/capcha_code.png">
                            <span id="captcha" style="cursor: pointer;padding:10px;" class="refresh_code"><i class="fa fa-refresh fa-2x" style="margin-top: 10px;"></i></span>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                           
                        </div>
                        @endif
                      </div>
    
                      @if($lang->rtl == 1)
                      <div class="row">
                        <div class="col-md-4 text-center">
                            <input class="form-control rounded-0 text-center" name="codes" placeholder="{{$lang->enter_code}}" required="" type="text">
                        </div>
                      </div>
                      @else
                      <div class="row">
                      <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                              <input class="form-control rounded-0 text-center" name="codes" placeholder="{{$lang->enter_code}}" required="" type="text">
                              {{-- <input  name="contact_btn" value="{{$lang->sm}}" type="submit" style="border-radius:30px;"> --}}
                          </div>
                      </div>
                      @endif
            
                    <h6 class="text-center" style="margin-top:10px;">Complete privacy and anonymity guaranteed • Quick responses </h6>
                    <div class="text-center ">
                    <input name="doctor_email" value="{{$doctor->email}}" hidden>
                    <input name="doctor_name" value="{{$doctor->name}}" hidden>
                    <input name="doctor_id" value="{{$doctor->id}}" hidden>
                      {{-- <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button> --}}
                      <button type="submit" class="btn btn-primary" style="border-radius:30px;"><i class="icon-cursor"></i> Ask Question Securely</button>
                    
                    </div>
                </form>
                @else
                
                @endif
                </div>
                
                </section>
              </div>
          </div>
        </div>
      </div>

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
          margin: 0px;;
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
          background-color: #50c1e9;
          background-image: url(https://www.dnnsoftware.com/Portals/0/Images/hero-background-5-5.jpg?ver=2017-08-18-002649-533);
          background-repeat: no-repeat;
          background-position: center;
          background-size: cover;
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
width: 49%;
text-align: center;
}

          </style>
 

      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center" style="padding:0px;">
            
                
    <div class="section-padding login-wrap" style="padding:10px;">
      
      <div class="container">
          <div class="row">
              <div class="col-md-12" style="padding-left:0px; padding-right:0px">
        <div class="login-tab" style="border-radius:5px;">
          <div class="card__top"></div>
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#login" style="font-weight:14px;padding-left: 28px;text-align: left;">LOGIN</a></li>
            <li><a data-toggle="tab" href="#signup" style="font-weight:14px;padding-left: 28px;text-align: left;">REGISTER</a></li>
          </ul>
          
          <div class="tab-content">
            <div id="login" class="tab-pane fade in active">
              {{-- <div class="login-title text-center">
                <h3>{{$lang->signin}}</h3>
              </div> --}}
                @include('includes.form-success')
              <div class="login-form">
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

                    <input name="askdoctor" value="1" hidden/>
                   
                
                    
                   
                    <div class="card__btn-group">
                      <button class="card__btn" type="submit"><span>Log in</span></button>
                    </div><a class="card__link" href="{{route('user-forgot')}}" target="_blank">Forgot password?</a>
                    
                    @if($sl->fcheck == 1  || $sl->gcheck == 1)
                    <div class="">
                        @if($sl->fcheck ==1)
                      <a href="{{route('social-provider','facebook')}}" class="btn btn-block u-btn-facebook rounded text-uppercase g-py-13 g-mb-15" >
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
                <form action="{{route('user-register-submit')}}" method="POST">
                  {{csrf_field()}}
                <div class="card__form">
                
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
          </div>
      </div>
  </div>

            </div>
            {{-- <div class="modal-footer">
      
              <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div> --}}
          </div>
        </div>
      </div>
      


@endsection


@section('scripts')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 --}}

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



<!-- JS Implementing Plugins -->
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>

    <script>
        $('.refresh_code').click(function () {
            $.get('{{url('askdoctor/refresh_code')}}', function(data, status){
                $('#codeimg').attr("src","{{url('assets/images')}}/capcha_code.png?time="+ Math.random());
            });
        })
    </script>
    <script>
      jQuery(function(){
         jQuery('#captcha').click();
      });
      </script>

<script>

  $("#doctor").click(function() {
  $('html, body').animate({
      scrollTop: $("#alldoctor").offset().top
  }, 2000);
});



  </script>


@endsection