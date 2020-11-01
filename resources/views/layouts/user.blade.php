<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$seo->meta_keys}}">

    <title>@yield('title','Dashboard') | {{$gs->title}}</title>
    <link href="{{asset('assets/user/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/themify-icon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/bootstrap-colorpicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/responsive.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}">

    <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line/css/simple-line-icons.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-etlinefont/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/hamburgers/hamburgers.min.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/animate.css">

        <style type="text/css">

@media only screen and (max-width: 991px) and (min-width: 768px){
.dashboard-sidebar-area, .sidebar-menu-body {
    width: 32%;
}}

@media  and (max-width: 991px) and (min-width: 768px){}
#sidebar-width,  {
    width: 36% !important;
}}
        .form-control {
        box-shadow: inset 0px 0px 0px rgba(0,0,0,.075);            
        }
        .vendor-btn {
            display: inline-block !important;
            background-color: #00b16a !important;
            color: #ffffff !important;
            padding: 8px 25px !important;
            border-radius: 30px !important;
            margin-right: 20px !important;
            cursor: pointer;
            font-weight: 500 !important;
            transition: all 0.3s;
        }
        .pac-container{
            z-index: 1050 !important;
        }
        #sidebar-menu ul li a.vendor-btn:hover {
            background-color: #333333 !important;
        }

        .profile-order-content {
            width: 350px;
            padding: 20px;
            max-height: 300px;
            position: absolute;
            left: auto;
            background: #ffffff;
            box-shadow: 0 0 5px #cccccc;
            right: 0;
            z-index: 9999 !important;
            margin-top: 20px;
        }

        #sidebar-menu ul li a.active {
    color: #fff;
    background: #31708f !important;
}
.sidebar-menu-body {
    background-color: #2385aa !important;
}
        </style>
    @include('styles.admin-design')
    @yield('styles')
</head>
<body>
<div class="dashboard-wrapper">
    <div class="left-side">
        <!-- Starting of Dashboard Sidebar menu area -->
        <nav class="navbar navbar-default">
            
            <div class="container-fluid" style="padding-top:20px;">

                <a href="{{route('front.index')}}" style="font-size:25px;"><i class="icon-home"></i></a>
                <div class="navbar-right">
                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </nav>

        <div id="sidebar-width" class="dashboard-sidebar-area" >
            {{-- <img src="{{asset('assets/images/'.$gs->bimg)}}" alt=""> --}}
            {{-- <img src="{{asset('assets/images/sidebar_bg.jfif')}}" alt=""> --}}
           
            <div id="sidebar-width" class="sidebar-menu-body">
                <nav id="sidebar-menu">
                    <ul class="list-unstyled profile">
                        <li class="active">
                            <div class="row">
                                @if($lang->rtl == 1)

                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                    <a dir="rtl">{{ Auth::guard('user')->user()->name}}
                                        {{-- <span>{{ Auth::guard('user')->user()->IsVendor() ? 'Vendor' : $lang->customer }}</span></span> --}}
                                        
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            @if(Auth::guard('user')->user()->is_provider == 1)
                            <a href="{{route('user-profile')}}"> <img src="{{ Auth::guard('user')->user()->photo ? Auth::guard('user')->user()->photo:asset('assets/images/user.png')}}" alt="profile image"></a>
                                    @else
                                    <a href="{{route('user-profile')}}"> <img src="{{ Auth::guard('user')->user()->photo ? asset('assets/images/'.Auth::guard('user')->user()->photo):asset('assets/images/user.png') }}" alt="profile image"></a>
                            @endif
                                </div>
                                @else
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            @if(Auth::guard('user')->user()->is_provider == 1)
                            <a href="{{route('user-profile')}}"> <img src="{{ Auth::guard('user')->user()->photo ? Auth::guard('user')->user()->photo:asset('assets/images/user.png')}}" alt="profile image"></a>
                                    @else
                                    <a href="{{route('user-profile')}}">  <img src="{{ Auth::guard('user')->user()->photo ? asset('assets/images/'.Auth::guard('user')->user()->photo):asset('assets/images/user.png') }}" alt="profile image"></a>
                                    @endif
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="margin-top: 15px;">
                                    <a href="{{route('user-profile')}}">{{ Auth::guard('user')->user()->name}}
                                        <span>{{ Auth::guard('user')->user()->email }} </span>
                                        {{-- <span>{{ Auth::guard('user')->user()->user_type }} </span> --}}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </li>
                    </ul>
                    <ul class="list-unstyled components">
                        {{-- <li>
                            <a href="{{route('front.index')}}" target="_blank"><i class="fa fa-eye"></i>{{$lang->view_website}}</a>
                        </li> --}}
                        <li>
                            <a href="{{route('user-dashboard')}}"><i class="icon-home"></i> {{$lang->dashboard}}</a>
                        </li>
                        @if(Auth::guard('user')->user()->is_vendor == 0) 
                            {{-- <li>
                                <a href="{{route('user-family.index')}}"><i class="icon-user-follow"></i> Family</a>
                            </li> --}}

                           

                            {{-- <li>
                                <a href="{{route('user-filemanager')}}"><i class="fa fa-folder-o"></i>Prescription Files </a>
                            </li> --}}

                            <li>
                                <a href="{{route('user-wishlist')}}"><i class="icon-heart"></i> {{$lang->wish_list}}</a>
                            </li>
                            {{-- <li>
                                <a href="{{route('user-favorites')}}"><i class="fa fa-plus"></i>{{$lang->favorite_seller}}</a>
                            </li> --}}
                            {{-- <li>
                                <a href="{{route('user-messages')}}"><i class="fa fa-envelope-o"></i>{{$lang->messages}}</a>
                            </li> --}}

                            {{-- <li>
                       
                                <a href="#prescription" data-toggle="collapse" aria-expanded="false"><i class="icon-note"></i> Prescription Orders</a>
                                <ul class="collapse list-unstyled submenu" id="prescription">
                                    <li>
                                        <a href="{{route('user-prescriptions.index')}}"><i class="fa fa-angle-right"></i> Medicine Prescription</a>
                                    </li>  
                                    <li>
                                        <a href="{{route('user-lab-prescriptions.index')}}"><i class="fa fa-angle-right"></i> Lab Prescription</a>
                                    </li>  
                                   
                                </ul>
                            </li> --}}

                            <li>
                                <a href="{{route('user-orders')}}"><i class="icon-handbag" style="margin-right:0px;margin-left:0px;"></i> Purchased Orders</a>
                            </li>

                        @endif

                        {{-- @php
                        $user = Auth::guard('user')->user();
                            
                        @endphp

                        @if(Auth::guard('user')->check())
                            @if($user->user_type == 'Business')

                            <li>
                                <a href="{{route('user-businessorders.index')}}"><i class="fa fa-building-o"></i>Business Orders</a>
                            </li>
                            @else
                    
                            @endif
                        @endif --}}

                        

                        
                        {{-- @if(Auth::guard('user')->user()->is_vendor == 0) 
                            <li>
                                <a href="{{route('user-lab-order-index')}}"><i class="icon-medical-010 u-line-icon-pro"></i> Lab Orders and Reports</a>
                            </li>
                        @endif --}}
                        {{-- @if($gs->is_affilate == 1)
                            <li>
                            <a href="#affilalte" data-toggle="collapse" aria-expanded="false"><i class="fa fa-fw fa-money"></i>{{$lang->affilate_settings}}</a>
                                <ul class="collapse list-unstyled submenu" id="affilalte">
                                    <li><a href="{{route('user-wwt-index')}}"><i class="fa fa-angle-{{$lang->rtl == 1 ? 'left':'right'}}"></i> {{$lang->affilate_withdraw}}</a></li>
                                    <li><a href="{{route('user-affilate-code')}}"><i class="fa fa-angle-{{$lang->rtl == 1 ? 'left':'right'}}"></i> {{$lang->affilate_code}}</a></li>
                                </ul>
                            </li>
                        @endif --}}
                        {{-- <li>
                            <a href="{{route('user-message-index')}}"><i class="fa fa-fw fa-ticket"></i>{{$lang->support}}</a>
                        </li> --}}
                        @if(Auth::guard('user')->user()->is_vendor == 2) 
                            {{-- <li>
                                <a href="{{route('user-prod-index')}}"><i class="fa fa-fw fa-shopping-cart"></i>{{$lang->vendor_products}}</a>
                            </li>
                            <li>
                                <a href="{{route('vendor-order-index')}}"><i class="fa fa-fw fa-money"></i>{{$lang->vendor_orders}}</a>
                            </li> --}}
                            {{-- <li> --}}
                                {{-- <a href="{{route('user-lab-prod-index')}}"><i class="fa fa-fw fa-medkit"></i>{{$lang->vendor_products}}</a> --}}
                                {{-- <a href="{{route('user-lab-prod-index')}}"><i class="fa fa-fw fa-medkit"></i>Vendor Tests</a>
                            </li> --}}
                            
                            <li>
                                <a href="{{route('vendor-lab-order-index')}}"><i class="fa fa-fw fa-money"></i>{{$lang->vendor_orders}}</a>
                            </li>
                            {{-- <li>
                                <a href="{{route('user-wt-index')}}"><i class="fa fa-fw fa-list"></i>{{$lang->withdraw}}</a>
                            </li> --}}
                            <li>
                                <a href="#generalSettings" data-toggle="collapse" aria-expanded="false"><i class="fa fa-fw fa-cogs"></i> {{$lang->settings}}</a>
                                <ul class="collapse list-unstyled submenu" id="generalSettings">
                                    {{-- <li><a href="{{route('user-sl-index')}}"><i class="fa fa-angle-{{$lang->rtl == 1 ? 'left':'right'}}"></i> {{$lang->sliders}}</a></li> --}}
                                    <li><a href="{{route('user-service-location')}}"><i class="fa fa-angle-{{$lang->rtl == 1 ? 'left':'right'}}"></i> Service Locations</a></li>
                                    <li><a href="{{route('user-vendor-description')}}"><i class="fa fa-angle-{{$lang->rtl == 1 ? 'left':'right'}}"></i> Vendor Description</a></li>
                                    {{-- <li><a href="{{route('user-shop-ship')}}"><i class="fa fa-angle-{{$lang->rtl == 1 ? 'left':'right'}}"></i> {{$lang->shipping_cost}}</a></li> --}}
                                    {{-- <li><a href="{{route('user-social-index')}}"><i class="fa fa-angle-{{$lang->rtl == 1 ? 'left':'right'}}"></i> {{$lang->social_link}}</a></li>   --}}
                                </ul>
                            </li>
                        @endif

                        @if(Auth::guard('user')->user()->is_vendor == 3) 
                        <li>
                            <a href="#productvendor" data-toggle="collapse" aria-expanded="false"><i class="icon-basket-loaded"></i> Product</a>
                            <ul class="collapse list-unstyled submenu" id="productvendor">
                                <li>
                                    <a href="{{route('user-vendor-product.index')}}"><i class="fa fa-angle-right"></i> All Products</a>
                                </li>  
                            </ul>
                        </li>
                        @endif


                      

                        {{-- @if($gs->reg_vendor == 1)
                        <li class="text-center"><a href="{{route('user-package')}}" class="vendor-btn"><i class="fa fa-usd"></i>Subscription Plans</a></li>
                        @endif --}}

                    </ul>
                </nav>
            </div>
        </div>
        <!-- Ending of Dashboard Sidebar menu area -->
    </div>
    @yield('content')
</div>

@if($lang->rtl == 1)
<style type="text/css">
#sidebar-menu ul.profile a {text-align: right;}
    ul.profile li.active img {
        margin-left: -10px;
    }
.components a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
    right: auto;
    left: 20px;
    }
#sidebar-menu ul li a {
    text-align: right;
    direction: rtl;
}
#sidebar-menu ul li a i.fa {margin-right: 0;margin-left: 5px;}
</style>
@endif
<script src="{{asset('assets/user/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/user/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/user/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/user/js/jquery.canvasjs.min.js')}}"></script>
<script src="{{asset('assets/user/js/bootstrap-colorpicker.js')}}"></script>
<script src="{{asset('assets/user/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/user/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/user/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/user/js/notify.js')}}"></script>
<script src="{{asset('assets/user/js/main.js')}}"></script>
<script src="{{asset('assets/user/js/user-main.js')}}"></script>

@if(Auth::guard('user')->user()->IsVendor()) 
    <script>
        setInterval(function(){
            $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/vendor/order/notf')}}",
                    success:function(data){
                        $("#notf_order").html(data);
                    }
            }); 
        }, 5000);
    </script>
@endif

<script type="text/javascript">
        $(document).on("click", ".email2" , function(){
        $(".modal-backdrop, .modal.vendor").css('background-color','rgba(0,0,0,0)');
    });
    $(document).ready(function(){
        setInterval(function(){
                $.ajax({
                        type: "GET",
                        url:"{{URL::to('/json/conv/notf')}}",
                        success:function(data){
                            $("#notf_conv").html(data);
                        }
                }); 
        }, 5000);
        
        
    });
            $(document).on("click", "#conv_notf" , function(){
                $("#notf_conv").html('0');
                $('.profile-notifi-content').load('{{URL::to('conv/notf')}}');
            });

            $(document).on("click", "#order_notf" , function(){
                $("#notf_order").html('0');
                $('.profile-order-content').load('{{URL::to('vendor/order/notf')}}');
            });
            $(document).on("click", "#conv_clear" , function(){

                $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/conv/notf/clear')}}"
                }); 
            });
            $(document).on("click", "#order_clear" , function(){

                $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/vendor/order/notf/clear')}}"
                }); 
            });
</script>
@yield('scripts')
</body>
</html>
