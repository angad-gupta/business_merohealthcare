
@include('layouts.partials.header')
@include('layouts.partials.navbar')

@yield('content')

@include('layouts.partials.footer')


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

<!-- Ending of footer area -->

<!-- Starting of Product View Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    </div>
</div>
</div>
<!-- Ending of Product View Modal -->

<!-- Starting of Product View Modal -->
<div class="modal fade" id="loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="margin-right:10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

      <div class="modal-body">
          <div class="" style="">
      <div class="login-tab" style="width: 100%">
        
        <ul class="nav justify-content-center u-nav-v4-1 u-nav-primary" role="tablist" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block u-btn-outline-primary">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#login1" role="tab">{{$lang->signin}}</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#signup1" role="tab">{{$lang->signup}}</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="login1" class="tab-pane fade show active" role="tabpanel">
            <div class="login-title text-center">
              <h3>{{$lang->signin}} </h3>
            </div>

            <div class="login-form">
              <form action="{{route('user-login-submit')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="login_email1">{{$lang->doeml}}</label>
                  <input type="email" name="email" class="form-control" id="login_email1" placeholder="{{$lang->doeml}}" required>
                  
                </div>
                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="login_pwd1">{{$lang->sup}}</label>
                <input type="password" name="password" class="form-control" id="login_pwd1" placeholder="{{$lang->sup}}" required>
                <i id="pass-status" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPassword()"></i>
              </div>
                <input type="hidden" name="wish" value="1">
                <input type="hidden" name="checkout" value="{{ Request::path() == 'lab/cart' }}">
                <button type="submit" class="btn btn-default btn-block">{{$lang->sie}}</button>
                @if($sl->fcheck == 1  || $sl->gcheck == 1)
                <div class="login-social-btn-area">

                    @if($sl->fcheck ==1)
                      <a href="{{route('social-provider','facebook')}}" class="social-btn"><i class="fa fa-facebook"></i> <span>Facebook Login</span></a>
                    @endif
                    
                    @if($sl->gcheck ==1)
                      <a href="{{route('social-provider','google')}}" class="social-btn last-child"><i class="fa fa-google"></i> <span>Google Login</span></a>
                    @endif
                </div>
                @endif
              </form>

            </div>

          </div>
          <div id="signup1" class="tab-pane fade" role="tabpanel">
            <div class="login-title text-center">
              <h3>{{$lang->signup}} </h3>
            </div>
              @include('includes.form-error')
            <div class="login-form">
              <form action="{{route('user-register-submit')}}" method="POST">
                  {{csrf_field()}}

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_email1">{{$lang->doeml}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doeml}}" type="email" name="email" id="reg_email1" required>
                  </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                    <label for="reg_name1">First Name <span>*</span></label>
                    <input class="form-control" placeholder="First Name" type="text" name="firstname" id="reg_name1" required>
                </div>

                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="reg_name1">Middle Name<span></span></label>
                  <input class="form-control" placeholder="Middle Name" type="text" name="middlename" id="reg_name1" >
              </div>

              <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                <label for="reg_name1">Last Name <span>*</span></label>
                <input class="form-control" placeholder="Last Name" type="text" name="lastname" id="reg_name1" required>
            </div>
                  {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_name1">{{$lang->fname}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->fname}}" type="text" name="name" id="reg_name1" required>
                  </div> --}}

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
                        <label for="reg_name">Date of Birth <span>*</span></label>
                        <input class="form-control" placeholder="Date of Birth" type="date" name="dob" id="reg_name" required>
                    </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
                    <label for="reg_usertype">User Type <span>*</span></label>
                    <select id="reg_usertype" name="user_type" class="form-control rounded-0" id="">
                      <option>User</option>
                      {{-- <option>Business</option> --}}
                   
                    </select>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_Pnumber1">{{$lang->doph}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doph}}" type="text" name="phone" id="reg_Pnumber1" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_Padd1">{{$lang->doad}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doad}}" type="text" name="address" id="reg_Padd1" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_password1">{{$lang->sup}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->sup}}" type="password" name="password" id="reg_password1" required>
                      <i id="pass-status" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordCreate()"></i>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="confirm_password1">{{$lang->sucp}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->sucp}}" type="password" name="password_confirmation" id="confirm_password1" required>
                      <i id="pass-status" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordCreateConfirm()"></i>
                  </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                    <div class="container row">
                    <input type="checkbox" checked><h6>&nbsp;Signing up you agreed our <a href=""> Terms and condition</a></h6>
                    </div>
                  </div>
                <input type="hidden" name="wish" value="1">
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
</div>


<!-- Starting of Product View Modal -->
<div class="modal fade" id="vendorloginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="margin-right:10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

      <div class="modal-body">
          <div class="" style="">
      <div class="login-tab">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#login111">{{$lang->signin}}</a></li>
          <li><a data-toggle="tab" href="#signup111">{{$lang->vendor_registration}}</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="login111" class="tab-pane fade in active">
            <div class="login-title text-center">
              <h3>{{$lang->signin}}</h3>
            </div>

            <div class="login-form">
              <form action="{{route('user-login-submit')}}" method="POST">
                          {{csrf_field()}}

                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="login_email11">{{$lang->doeml}}</label>
        <input type="email" name="email" class="form-control" id="login_email11" placeholder="{{$lang->doeml}}" required>
                </div>
                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="login_pwd11">{{$lang->sup}}</label>
            <input type="password" name="password" class="form-control" id="login_pwd_vendor" placeholder="{{$lang->sup}}" required>
            <i id="pass-status-vendor" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordVendor();"></i>    
          </div>
                <input type="hidden" name="package" value="1">
                <button type="submit" class="btn btn-default btn-block">{{$lang->sie}}</button>
                @if($sl->fcheck == 1  || $sl->gcheck == 1)
                <div class="login-social-btn-area">

                    @if($sl->fcheck ==1)
                  <a href="{{route('social-provider','facebook')}}" class="social-btn"><i class="fa fa-facebook"></i> <span>{{ $lang->facebook_login }}</span></a>
                    @endif
                    @if($sl->gcheck ==1)
                  <a href="{{route('social-provider','google')}}" class="social-btn last-child"><i class="fa fa-google"></i> <span>{{ $lang->google_login }}</span></a>
                    @endif
                </div>
                @endif
              </form>

            </div>

          </div>
          <div id="signup111" class="tab-pane fade">
            <div class="login-title text-center">
              <h3>{{$lang->vendor_registration}}</h3>
            </div>
              @include('includes.form-error')
            <div class="login-form">
              <form action="{{route('vendor.registration')}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_email11">{{$lang->doeml}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doeml}}" type="email" name="email" id="reg_email11" required>
                  </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                    <label for="reg_name11">First Name <span>*</span></label>
                    <input class="form-control" placeholder="Fist Name" type="text" name="firstname" id="reg_name11" required>
                </div>

                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="reg_name11">Middle Name <span></span></label>
                  <input class="form-control" placeholder="Middle Name" type="text" name="middlename" id="reg_name11" >
              </div>

              <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                <label for="reg_name11">Last Name <span>*</span></label>
                <input class="form-control" placeholder="Last Name" type="text" name="lastname" id="reg_name11" required>
            </div>

                  {{-- <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_name11">{{$lang->fname}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->fname}}" type="text" name="name" id="reg_name11" required>
                  </div> --}}

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
                    <label for="reg_name">Date of Birth <span>*</span></label>
                    <input class="form-control" placeholder="Date of Birth" type="date" name="dob" id="reg_name" required>
                </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_Pnumber11">{{$lang->doph}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doph}}" type="text" name="phone" id="reg_Pnumber11" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_Padd11">{{$lang->doad}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doad}}" type="text" name="address" id="reg_Padd11" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_password11">{{$lang->sup}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->sup}}" type="password" name="password" id="reg_password_vendor" required>
                      <i id="pass-status-vendor-reg" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordVendorReg();"></i> 
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="confirm_password11">{{$lang->sucp}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->sucp}}" type="password" name="password_confirmation" id="reg_password_vendor1" required>
                      <i id="pass-status-vendor-reg1" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPasswordVendorReg1();"></i> 
                    </div>
                    <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <div class="container row">
                      <input type="checkbox" checked><h6>&nbsp;Signing up you agreed our <a href=""> Terms and condition</a></h6>
                      </div>
                    </div>

                <input type="hidden" name="wish" value="1">
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
</div>

@if(isset($checked))
<!-- Starting of Product View Modal -->
<div class="modal fade" id="checkoutModal"  data-keyboard="false" data-backdrop="static" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="margin-right:10px;">
        <a href="{{ url()->previous() }}" class="close">&times;</a>

      </div>

      <div class="modal-body">
          <div class="" style="margin: 15px;">
      <div class="login-tab">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#login11">{{$lang->signin}}</a></li>
          <li><a data-toggle="tab" href="#signup11">{{$lang->signup}}</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="login11" class="tab-pane fade in active">
            <div class="login-title text-center">
              <h3>{{$lang->signin}}</h3>
            </div>
  <div class="alert alert-danger validation">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <p class="text-center">{{ $lang->digital_login }}</p> 
  </div>
            <div class="login-form">
              <form action="{{route('user-login-submit')}}" method="POST">
                          {{csrf_field()}}

                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="login_email11">{{$lang->doeml}}</label>
        <input type="email" name="email" class="form-control" id="login_email11" placeholder="{{$lang->doeml}}" required>
                </div>
                <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                  <label for="login_pwd11">{{$lang->sup}}</label>
                <input type="password" name="password" class="form-control" id="login_pwd11" placeholder="{{$lang->sup}}" required>
                </div>
                <input type="hidden" name="wish" value="1">
                <button type="submit" class="btn btn-default btn-block">{{$lang->sie}}</button>
                @if($sl->fcheck == 1  || $sl->gcheck == 1)
                <div class="login-social-btn-area">

                    @if($sl->fcheck ==1)
                  <a href="{{route('social-provider','facebook')}}" class="social-btn"><i class="fa fa-facebook"></i> <span>{{ $lang->facebook_login }}</span></a>
                    @endif
                    @if($sl->gcheck ==1)
                  <a href="{{route('social-provider','google')}}" class="social-btn last-child"><i class="fa fa-google"></i> <span>{{ $lang->google_login }}</span></a>
                    @endif
                </div>
                @endif
              </form>

            </div>

          </div>
          <div id="signup11" class="tab-pane fade">
            <div class="login-title text-center">
              <h3>{{$lang->signup}}</h3>
            </div>
              @include('includes.form-error')
            <div class="login-form">
              <form action="{{route('user-register-submit')}}" method="POST">
                  {{csrf_field()}}

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_email11">{{$lang->doeml}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doeml}}" type="email" name="email" id="reg_email11" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_name11">{{$lang->fname}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->fname}}" type="text" name="name" id="reg_name11" required>
                  </div>

                  

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                    <label for="reg_name">Date of Birth <span>*</span></label>
                    <input class="form-control" placeholder="Date of Birth" type="date" name="dob" id="reg_name" required>
                </div>

                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}} ">
                        <label for="reg_usertype">User Type <span>*</span></label>
                        <select class="form-control rounded-0" id="">
                          <option>User</option>
                          {{-- <option>Business</option> --}}
                       
                        </select>
                      </div>
                         
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_Pnumber11">{{$lang->doph}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doph}}" type="text" name="phone" id="reg_Pnumber11" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_Padd11">{{$lang->doad}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->doad}}" type="text" name="address" id="reg_Padd11" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="reg_password11">{{$lang->sup}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->sup}}" type="password" name="password" id="reg_password11" required>
                  </div>
                  <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                      <label for="confirm_password11">{{$lang->sucp}} <span>*</span></label>
                      <input class="form-control" placeholder="{{$lang->sucp}}" type="password" name="password_confirmation" id="confirm_password11" required>
                  </div>
                <input type="hidden" name="wish" value="1">
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
</div>


@endif
                @if(isset($vendor))
      @if(Auth::guard('user')->check())
<!-- Starting of Product email Modal -->
<div class="modal vendor" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" {!! $lang->rtl == 1 ? 'style="float: left;"':'' !!}><span aria-hidden="true"><i class="ti-close"></i></span></button>
        <h4 class="modal-title" id="myModalLabel" {!! $lang->rtl == 1 ? 'dir="rtl"':'' !!}>{{$lang->new_message}}</h4>
      </div>
      <form id="emailreply"  method="POST">
        {{csrf_field()}}
      <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" readonly="" value="{{$lang->send_to}} {{$vendor->shop_name}}">
            </div>
            <div class="form-group">
                <input type="text" name="subject" id="subj" class="form-control" placeholder="{{$lang->vendor_subject}}">
            </div>
            <div class="form-group">
                <textarea name="message" id="msg" class="form-control" rows="5" placeholder="{{$lang->vendor_message}}" required=""></textarea>
            </div>
            <input type="hidden" name="email" value="{{Auth::guard('user')->user()->email}}"> 
            <input type="hidden" name="name" value="{{Auth::guard('user')->user()->name}}">
            <input type="hidden" name="user_id" value="{{Auth::guard('user')->user()->id}}">
            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
      </div>
      <div class="modal-footer">
        <button type="submit" id="emlsub" class="btn btn-default email-btn" {!! $lang->rtl == 1 ? 'style="float: left;"':'' !!}>{{$lang->vendor_send}}</button>
      </div>
       </form>
    </div>
  </div>
</div>
@endif
<!-- Ending of Product email Modal -->

@endif
<!-- Starting of Scroll to Top Area -->
<a href="#" class="scrollup">
    <i class="fa fa-angle-double-up"></i>
</a>
<!-- Ending of Scroll to Top Area -->

<!-- jQuary Library -->
{{-- <script src="{{asset('assets/front/js/all.js')}}"></script> --}}

{!! $seo->google_analytics !!}



                                @if(Session::has('subscribe'))
                                <script type="text/javascript">
                                    $.notify("{{ Session::get('subscribe') }}","success");
                                    
                                </script>
                                @endif
                                @foreach($errors->all() as $error)
                                <script type="text/javascript">
                                    $.notify("{{$error}}","error");
                                    
                                </script>                                        
                                @endforeach

<script type="text/javascript">
 $(".ss").keyup(function() {
    var search = $(this).val();
    if(search == ""){
        $(".header-searched-item-list-wrap").hide();
    }
    else {
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/suggest')}}",
                data:{search:search},
                success:function(data){
                    if(!$.isEmptyObject(data))
                    {
                        $(".header-searched-item-list-wrap").show();
                        $(".header-searched-item-list-wrap ul").html("");
                        // var arr = $.map(data, function(el) {
                        //     return el 
                        // });
                        // for(var k in arr)
                        // {
                        //     var x = arr[k]['name'];
                        //     var p = x.length  > 50 ? x.substring(0,50)+'...' : x;
                            
                        //     $(".header-searched-item-list-wrap ul").append('<li><a href="{{url('/')}}/product/'+arr[k]['id']+'/'+arr[k]['name']+'">'+p+'</a></li>');
                        // }
                        // console.log(data);
                        $(".header-searched-item-list-wrap ul").append(data.html);

                    }
                    else{
                        $(".header-searched-item-list-wrap").hide();
                    }
                }
              }) 
        
    }
 });
</script>     

<script type="text/javascript">
  $(".ss").keyup(function() {
     var search = $(this).val();
     if(search == ""){
         $(".header-searched-item-list-wrap-mobile").hide();
     }
     else {
      console.log("hello1st");
         $.ajax({
                 type: "GET",
                 url:"{{URL::to('/json/mobilesuggest')}}",
                 data:{search:search},
                 success:function(data){
                     if(!$.isEmptyObject(data))
                     {
                         $(".header-searched-item-list-wrap-mobile").show();
                         $(".header-searched-item-list-wrap-mobile ul").html("");
                         // var arr = $.map(data, function(el) {
                         //     return el 
                         // });
                         // for(var k in arr)
                         // {
                         //     var x = arr[k]['name'];
                         //     var p = x.length  > 50 ? x.substring(0,50)+'...' : x;
                             
                         //     $(".header-searched-item-list-wrap ul").append('<li><a href="{{url('/')}}/product/'+arr[k]['id']+'/'+arr[k]['name']+'">'+p+'</a></li>');
                         // }
                         console.log(data);
                         $(".header-searched-item-list-wrap-mobile ul").append(data.html);
 
                     }
                     else{
                         $(".header-searched-item-list-wrap-mobile").hide();
                         console.log('unsucess');
                     }
                 }
               }) 
         
     }
  });
 </script>   

<script type="text/javascript">
function remove(id) {
    $("#del"+id).hide();
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/removecart')}}",
                data:{id:id},
                success:function(data){
                    $(".empty").html("");
                    $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                    $(".cart-quantity").html(data[2]);
                    $(".cart").html("");
                    if(data[1] == null)
                    {
                        $(".total").html("0.00");
                        $(".cart-quantity").html("0");
                        $(".empty").html("{{$lang->h}}");
                    }

                        var arr = $.map(data[1], function(el) {
                        return el });
                        for(var k in arr)
                        {
                            var x = arr[k]['item']['name'];
                            var p = x.length  > 45 ? x.substring(0,45)+'...' : x;
                            var measure = arr[k]['item']['measure'] != null ? arr[k]['item']['measure'] : "";
                            $(".cart").append(
                            '<div class="single-myCart">'+
            '<p class="cart-close" onclick="remove('+arr[k]['item']['id']+')"><i class="fa fa-close"></i></p>'+
                            '<div class="cart-img">'+
                    '<img src="{{ asset('assets/images/') }}/'+arr[k]['item']['photo']+'" alt="Product image">'+
                            '</div>'+
                            '<div class="cart-info">'+
        '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                        '<p>{{$lang->cquantity}}: <span id="cqt'+arr[k]['item']['id']+'">'+arr[k]['qty']+'</span> '+measure+'</p>'+
                        @if($gs->sign == 0)
                        '<p>{{$curr->sign}}<span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span></p>'+
                        @else
                        '<p><span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span>{{$curr->sign}}</p>'+
                        @endif
                        '</div>'+
                        '<div class="cart-info">'+
    '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                    '<p>{{$lang->cquantity}}: '+arr[k]['qty']+' '+measure+'</p>'+
                    @if($gs->sign == 0)
                    '<p>{{$curr->sign}}'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</p>'+
                    @else
                    '<p>'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'{{$curr->sign}}</p>'+
                    @endif
                    '</div>'+
                    '</div>');
                    }                            
                                                
                  },
            error: function(data){
              
                $.notify('Something went wrong',"error");

            }
          }); 

}
</script>

<script type="text/javascript">
$(document).on("click", ".wish-listt" , function(){
    var max = '';
    var pid = $(this).parent().find('input[type=hidden]').val();
    $("#myModal .modal-content").html('');
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/quick')}}",
                data:{id:pid},
                success:function(data){
                    $("#myModal .modal-content").append(''+
                        '<div class="modal-header">'+
                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                        '</div>'+
                        '<div class="modal-body">'+
                        '<div class="row">'+
                        '<div class="col-md-3 col-sm-12">'+
                        '<div class="product-review-details-img">'+
            '<img src="{{asset('assets/images/')}}/'+data[0]+'" alt="Product image">'+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-9 col-sm-12">'+
                        '<div class="product-review-details-description">'+
                        '<h3>'+data[1]+'</h3>'+
                        '<p class="modal-product-review">'+
                        '<i class="fa fa-star"></i>'+
                        '</p>'+
                        '<div class="product-price">'+
                        '<div class="single-product-price">'+
                         @if($gs->sign == 0)
                        '{{$curr->sign}}'+data[2]+' <span>{{$curr->sign}}'+data[3]+'</span> '+
                        @else
                        ''+data[2]+'{{$curr->sign}} <span>'+data[3]+'{{$curr->sign}}</span> '+
                        @endif
                        '</div>'+
                        '<div class="product-availability">'+

                        '</div>'+
                        ' </div>'+
                        '<div class="product-review-description">'+
                        '<h4>{{$lang->dol}}</h4>'+
                        '<p style="text-align:justify;">'+data[4]+'</p>'+
                        '</div>'+
                        '<div class="product-size">'+
                        '</div>'+
                        '<div class="product-color">'+
                        '</div>'+
                        '<div class="product-quantity">'+
                        '</div>'+
                        '</div>'+   
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '<div class="modal-footer">'+
                        '</div>');

                        if(data[5] == "0")
                        {
                            if(data[9] == 0)
                            {
                                 $(".product-availability").append(''+
                                '{{$lang->availability}} '+
                                '<span style="color:red;">'+
                                '<i class="fa fa-times-circle-o"></i> '+
                                '{{$lang->dni}}'+
                                '</span>'
                                );                                   
                            }

                        }
                        else
                        {
                        // $(".empty").html("");
                        // $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                        //  $(".cart-quantity").html(data[2]);
                        var arr = $.map(data[1], function(el) {
                        return el });
                        $(".cart").html("");
                        for(var k in arr)
                        {
                            var x = arr[k]['item']['name'];
                            var p = x.length  > 45 ? x.substring(0,45)+'...' : x;
                            var measure = arr[k]['item']['measure'] != null ? arr[k]['item']['measure'] : "";
                            $(".cart").append(
                              '<div class="single-myCart">'+
            '<p class="cart-close" onclick="remove('+arr[k]['item']['id']+')"><i class="fa fa-close"></i></p>'+
                            '<div class="cart-img">'+
                    '<img src="{{ asset('assets/images/') }}/'+arr[k]['item']['photo']+'" alt="Product image">'+
                            '</div>'+
                            '<div class="cart-info">'+
        '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                        '<p>{{$lang->cquantity}}: <span id="cqt'+arr[k]['item']['id']+'">'+arr[k]['qty']+'</span> '+measure+'</p>'+
                        @if($gs->sign == 0)
                        '<p>{{$curr->sign}}<span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span></p>'+
                        @else
                        '<p><span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span>{{$curr->sign}}</p>'+
                        @endif
                        '</div>'+
                        '</div>');
                          }
                        $.notify("{{$gs->cart_success}}","success");
                        }
                      },error: function(data){
              
                          $.notify('Something went wrong',"error");

                      }
              }); 
        return false;
    });

    $(document).on("click", ".addcartforSearch" , function(){
        
        var pid = $(this).parent().parent().find('input[type=hidden]').val();
        var quantityDiv = $(this).parent();

        $.ajax({
            type: "GET",
            url:"{{URL::to('/json/addcart')}}",
            data:{id:pid},
            success:function(data){
                if(data == 0)
                {
                    $.notify("{{$gs->cart_error}}","error");
                }
                else
                {
                    var qty = 1;

                    $(".empty").html("");
                    $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                    $(".cart-quantity").html(data[2]);
                    var arr = $.map(data[1], function(el) {
                        return el 
                    });
                    $(".cart").html("");
                    for(var k in arr)
                    {
                        if(arr[k]['item']['id'] == pid) qty = arr[k]['qty'];

                        var x = arr[k]['item']['name'];
                        var p = x.length  > 45 ? x.substring(0,45)+'...' : x;
                        var measure = arr[k]['item']['measure'] != null ? arr[k]['item']['measure'] : "";
                        $(".cart").append(
                            '<div class="single-myCart">'+
                                '<p class="cart-close" onclick="remove('+arr[k]['item']['id']+')"><i class="fa fa-close"></i></p>'+
                                '<div class="cart-img">'+
                                    '<img src="{{ asset('assets/images/') }}/'+arr[k]['item']['photo']+'" alt="Product image">'+
                                '</div>'+
                                '<div class="cart-info">'+
                                    '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                                    '<p>{{$lang->cquantity}}: <span id="cqt'+arr[k]['item']['id']+'">'+arr[k]['qty']+'</span> '+measure+'</p>'+
                                    @if($gs->sign == 0)
                                    '<p>{{$curr->sign}}<span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span></p>'+
                                    @else
                                    '<p><span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span>{{$curr->sign}}</p>'+
                                    @endif
                                '</div>'+
                            '</div>'
                        );
                    }
                    
                    quantityDiv.html(
                        '<span class="quantity-btn reducingforSearch"><i class="fa fa-minus"></i></span>'+
                        '<span class="qtyforSearch">'+qty+'</span>'+
                        '<span class="quantity-btn addingforSearch"><i class="fa fa-plus"></i></span>'
                    );
                    $.notify("{{$gs->cart_success}}","success");
                }
            },
            error: function(data){
              if(data.responseJSON)
                $.notify(data.responseJSON.error,"error");
              else
                $.notify('Something went wrong',"error");

            }
            
        }); 
        return false;
    });

    $(document).on("click", ".addingforSearch" , function(e){
        e.preventDefault()
        var pid =  $(this).parent().parent().find('input[type=hidden]').val();
        var qty = $(this).parent().find(".qtyforSearch").html();
        var quantityDiv = $(this).parent();

        $.ajax({
            type: "GET",
            url:"{{URL::to('/json/addbyone')}}",
            data:{id:pid},
            success:function(data){
                if(data == 0)
                {
                    $.notify("{{$gs->cart_error}}","error");
                }
                
                else
                {
                    $(".total").html((data[0] * {{$curr->value}}).toFixed(2));                        
                    $(".cart-quantity").html(data[3]);
                    $("#cqty"+pid).val("1");
                    $("#prc"+pid).html((data[2] * {{$curr->value}}).toFixed(2));
                    $('.cart-info').find("#prct"+pid).html((data[2] * {{$curr->value}}).toFixed(2));
                    $('.cart-info').find("#cqt"+pid).html(data[1]);
                    quantityDiv.find(".qtyforSearch").html(data[1]);
                }
            },
            error: function(data){
              if(data.responseJSON)
                $.notify(data.responseJSON.error,"error");
              else
                $.notify('Something went wrong',"error");

            }
        }); 
    });

    $(document).on("click", ".reducingforSearch" , function(e){
        e.preventDefault()
        
        var id =  $(this).parent().parent().find('input[type=hidden]').val();
        var qty = $(this).parent().find(".qtyforSearch").html();
        var quantityDiv = $(this).parent();
        qty--;
        if(qty < 1)
        {
            remove(id);
            quantityDiv.html('<button class="btn btn-sm btn-primary addcartforSearch">Add to Cart</button>');
        }
        else{
         
            $.ajax({
                type: "GET",
                url:"{{URL::to('/json/reducebyone')}}",
                data:{id:id},
                success:function(data){
                    $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                    $(".cart-quantity").html(data[3]);
                    $("#cqty"+id).val("1");
                    $("#prc"+id).html((data[2] * {{$curr->value}}).toFixed(2));
                    
                    $('.cart-info').find("#prct"+id).html((data[2] * {{$curr->value}}).toFixed(2));
                    $('.cart-info').find("#cqt"+id).html(data[1]);
                    quantityDiv.find(".qtyforSearch").html(data[1]);
                    
                },
                error: function(data){
                  if(data.responseJSON)
                    $.notify(data.responseJSON.error,"error");
                  else
                    $.notify('Something went wrong',"error");

                }
            }); 
        }
    });
    </script>
    <script>
    $(document).on("click", ".removecart" , function(e){
        $(".addToMycart").show();
    });
    </script>
    <script>
      var size = "";
      var colorss = "";
      $(document).on("click", ".msize" , function(){
        $('.msize').removeClass('mselected-size');
        $(this).addClass('mselected-size');
        size = $(this).html();
      });

      $(document).on("click", ".mcolor" , function(){
        $('.mcolor').removeClass('mselected-color');
        $(this).addClass('mselected-color');
        colorss = $(this).html();
      });
     $(document).on("click", "#maddcart" , function(){
        var qty = $("#mqty").val();
        if(qty < 1)
        {
            $.notify("{{$gs->invalid}}","error");
        }
        else
        {
          var pid = $("#mid").val();
            $.ajax({
                type: "GET",
                url:"{{URL::to('/json/addnumcart')}}",
                data:{id:pid,qty:qty,size:size,color:colorss},
                success:function(data){
                  if(data == 0)
                  {
                    $(".product-size").append(
                    '<p>{{$lang->doo}}</p>'
                    );
                    for(var size in data[6])
                    $(".product-size").append(
                    '<span style="cursor:pointer;" class="msize">'+data[6][size]+'</span> '
                    );
                  }
                  
                  if(data[8] != null)
                  {
                      var x = arr[k]['item']['name'];
                      var p = x.length  > 45 ? x.substring(0,45)+'...' : x;
                      var measure = arr[k]['item']['measure'] != null ? arr[k]['item']['measure'] : "";
                      $(".cart").append(
                      '<div class="single-myCart">'+
                        '<p class="cart-close" onclick="remove('+arr[k]['item']['id']+')"><i class="fa fa-close"></i></p>'+
                        '<div class="cart-img">'+
                          '<img src="{{ asset('assets/images/') }}/'+arr[k]['item']['photo']+'" alt="Product image">'+
                        '</div>'+
                        '<div class="cart-info">'+
                          '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                          '<p>{{$lang->cquantity}}: <span id="cqt'+arr[k]['item']['id']+'">'+arr[k]['qty']+'</span> '+measure+'</p>'+
                          @if($gs->sign == 0)
                          '<p>{{$curr->sign}}<span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span></p>'+
                          @else
                          '<p><span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span>{{$curr->sign}}</p>'+
                          @endif
                        '</div>'+
                        '<div class="cart-info">'+
                          '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                          '<p>{{$lang->cquantity}}: '+arr[k]['qty']+' '+measure+'</p>'+
                          @if($gs->sign == 0)
                          '<p>{{$curr->sign}}'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</p>'+
                          @else
                          '<p>'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'{{$curr->sign}}</p>'+
                          @endif
                        '</div>'+
                      '</div>');
                  }
                  $.notify("{{$gs->cart_success}}","success");
                },
                error: function(data){
                  if(data.responseJSON)
                    $.notify(data.responseJSON.error,"error");
                  else
                    $.notify('Something went wrong',"error");

                }
            }); 
        }
        return false;
    });
</script>
<script>
$(document).on("click", ".removecart" , function(e){
    $(".addToMycart").show();
});
</script>
<script>
var size = "";
var colorss = "";
$(document).on("click", ".msize" , function(){
 $('.msize').removeClass('mselected-size');
 $(this).addClass('mselected-size');
 size = $(this).html();
});

$(document).on("click", ".mcolor" , function(){
 $('.mcolor').removeClass('mselected-color');
 $(this).addClass('mselected-color');
 colorss = $(this).html();
});
 $(document).on("click", "#maddcart" , function(){
    var qty = $("#mqty").val();
    if(qty < 1)
    {
        $.notify("{{$gs->invalid}}","error");
    }
    else
    {
    var pid = $("#mid").val();
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/addnumcart')}}",
                data:{id:pid,qty:qty,size:size,color:colorss},
                success:function(data){
                    if(data == 0)
                    {
                    $.notify("{{$gs->cart_error}}","error");
                    }
                    
                    else{
                    $(".empty").html("");
                    $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                    $(".cart-quantity").html(data[2]);
                    var arr = $.map(data[1], function(el) {
                    return el });
                    $(".cart").html("");
                    for(var k in arr)
                    {
                        var x = arr[k]['item']['name'];
                        var p = x.length  > 45 ? x.substring(0,45)+'...' : x;
                        var measure = arr[k]['item']['measure'] != null ? arr[k]['item']['measure'] : "";
                        $(".cart").append(
                        '<div class="single-myCart">'+
        '<p class="cart-close" onclick="remove('+arr[k]['item']['id']+')"><i class="fa fa-close"></i></p>'+
                        '<div class="cart-img">'+
                '<img src="{{ asset('assets/images/') }}/'+arr[k]['item']['photo']+'" alt="Product image">'+
                        '</div>'+
                        '<div class="cart-info">'+
    '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                    '<p>{{$lang->cquantity}}: '+arr[k]['qty']+' '+measure+'</p>'+
                    @if($gs->sign == 0)
                    '<p>{{$curr->sign}}'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</p>'+
                    @else
                    '<p>'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'{{$curr->sign}}</p>'+
                    @endif
                    '</div>'+
                    '</div>');
                      }
                    $.notify("{{$gs->cart_success}}","success");
                    $("#mqty").val("1");
                    }
                  },
            error: function(data){
              if(data.responseJSON)
                $.notify(data.responseJSON.error,"error");
              else
                $.notify('Something went wrong',"error");

            }
          }); 
    }
 });
</script>
<script>
    $(document).on("click", ".lwish" , function(){
        var pid = $(this).parent().find('input[type=hidden]').val();
        window.location = "{{url('user/wishlist/product/')}}/"+pid;
        return false;
    });
</script>

<script>
    $(document).on("click", ".uwish" , function(){
        var pid = $(this).parent().find('input[type=hidden]').val();
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/wish')}}",
                data:{id:pid},
                success:function(data){
                    if(data == 1)
                    {
                        $.notify("{{$gs->wish_success}}","success");
                    }
                    else {
                        $.notify("{{$gs->wish_error}}","error");
                    }
                  }
                  ,
            error: function(data){
                $.notify('Something went wrong',"error");

            }
          }); 

        return false;
    });
</script>

<script>
    $(document).on("click", ".no-wish" , function(){
    return false;
    });
</script>
<script type="text/javascript">
    $(document).on("submit", "#emailreply" , function(){
      var token = $(this).find('input[name=_token]').val();
      var subject = $(this).find('input[name=subject]').val();
      var message =  $(this).find('textarea[name=message]').val();
      var email = $(this).find('input[name=email]').val();
      var name = $(this).find('input[name=name]').val();
      var user_id = $(this).find('input[name=user_id]').val();
      var vendor_id = $(this).find('input[name=vendor_id]').val();
      $('#subj').prop('disabled', true);
      $('#msg').prop('disabled', true);
      $('#emlsub').prop('disabled', true);
      $.ajax({
        type: 'post',
        url: "{{URL::to('/vendor/contact')}}",
        data: {
            '_token': token,
            'subject'   : subject,
            'message'  : message,
            'email'   : email,
            'name'  : name,
            'user_id'   : user_id,
            'vendor_id'  : vendor_id
        },
        success: function() {
          $('#subj').prop('disabled', false);
          $('#msg').prop('disabled', false);
          $('#subj').val('');
          $('#msg').val('');
          $('#emlsub').prop('disabled', false);
          $.notify("Message Sent !!","success");
          $('.ti-close').click();
        },
        error: function(data){
            $.notify('Something went wrong',"error");

        }
      });          
      return false;
    });
</script>

<script>
    $(document).on("click", ".compare" , function(){
      var pid = $(this).parent().find('input[type=hidden]').val();
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/compare')}}",
                data:{id:pid},
                success:function(data){
                    if(data[0] == 0)
                    {
                        $('.compare-quantity').html(data[1]);
                        $.notify("{{$gs->compare_success}}","success");
                    }
                    else {
                        $.notify("{{$gs->compare_error}}","error");
                    }
                },
                error: function(data){
                    $.notify('Something went wrong',"error");

                }
          }); 
      return false;
    });
    $(document).on("click", ".compare-remove" , function(){
        var id = $(this).parent().find('input[type=hidden]').val();
        $(this).parent().parent().hide('slow');
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/removecompare')}}",
                data:{id:id},
                success:function(data){
                        $.notify("{{$gs->compare_remove}}","success");
                        $('.compare-quantity').html(data[1]);
                    if(data[0] == 1)
                    {
                      $('.container-fluid').html('<h2 class="text-center">{{$lang->no_compare}}</h2>')
                    }
                },
                error: function(data){
                    $.notify('Something went wrong',"error");

                }
            });
    });
    $(document).on("click", ".clear-btn" , function(){
        $('.compare-content-wrap').hide('slow');
        $('.container-fluid').html('<h2 class="text-center">{{$lang->no_compare}}</h2>');
        $('.compare-quantity').html('0');
        $.ajax({
                type: "GET",
                url:"{{URL::to('/json/clearcompare')}}",
            });
        return false;
    });

$(document).on("click", "#product_email" , function(){
    $(".modal-backdrop, .modal.vendor").css('background-color','rgba(0,0,0,0)');
});
</script>

<script>
  function viewPassword()
  {
    var passwordInput = document.getElementById('login_pwd1');
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

  function viewPasswordVendor()
  {
    var passwordInput = document.getElementById('login_pwd_vendor');
    var passStatus = document.getElementById('pass-status-vendor');
   
    if (passwordInput.type == 'password'){
      passwordInput.type='text';
      passStatus.className='fa fa-eye-slash field-icon';
      
    }
    else{
      passwordInput.type='password';
      passStatus.className='fa fa-eye field-icon';
    }
  }
  
  function viewPasswordCreate()
  {
    var passwordInput = document.getElementById('reg_password1');
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

  function viewPasswordVendorReg()
  {
    var passwordInput = document.getElementById('reg_password_vendor');
    var passStatus = document.getElementById('pass-status-vendor-reg');
   
    if (passwordInput.type == 'password'){
      passwordInput.type='text';
      passStatus.className='fa fa-eye-slash field-icon';
      
    }
    else{
      passwordInput.type='password';
      passStatus.className='fa fa-eye field-icon';
    }
  }

  function viewPasswordVendorReg1()
  {
    var passwordInput = document.getElementById('reg_password_vendor1');
    var passStatus = document.getElementById('pass-status-vendor-reg1');
   
    if (passwordInput.type == 'password'){
      passwordInput.type='text';
      passStatus.className='fa fa-eye-slash field-icon';
      
    }
    else{
      passwordInput.type='password';
      passStatus.className='fa fa-eye field-icon';
    }
  }
  
  
  function viewPasswordCreateConfirm()
  {
    var passwordInput = document.getElementById('confirm_password1');
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
@if($gs->is_talkto == 1)
    <!--Start of Tawk.to Script-->
    {!! $gs->talkto !!}
    <!--End of Tawk.to Script-->
@endif

@yield('scripts')

</body>
</html>
