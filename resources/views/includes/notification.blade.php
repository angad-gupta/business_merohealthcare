@php
$user_notf = App\Notification::where('user_id','!=',null)->orWhere('vendor_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get();
$order_notf = App\Notification::where('order_id','!=',null)->where('vendor_id',null)->where('is_read','=',0)->orderBy('id','desc')->get();
$prescription_notf = App\Notification::where('prescription_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get();
$product_notf = App\Notification::where('product_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get();
$conv_notf = App\Notification::where('conversation_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get();
$vendor_order_notf = App\Notification::where('order_id','!=',null)->where('vendor_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get();

// $vendor_product_notf = App\Notification::where('vendor_product_id','!=',null)->where('is_read','=',0)->orderBy('id','desc')->get();
@endphp

<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line/css/simple-line-icons.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-etlinefont/style.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line-pro/style.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-hs/style.css">

<style>
    
.scroll-box:hover {
overflow-y: scroll;
}
.scroll-box::-webkit-scrollbar {
width: .3em;
}
.scroll-box::-webkit-scrollbar,
.scroll-box::-webkit-scrollbar-thumb {
overflow:hidden ;
/* display:none; */
border-radius: 4px !important;
}
.scroll-box::-webkit-scrollbar-thumb {
background: rgba(0,0,0,.2);
}
.profile-vendor-order-content{
background: #ffffff;
box-shadow: 0 0 5px #cccccc;
padding: 20px 0;
position: absolute;
right: 0;
top: 100%;
width: 220px;
z-index: 9999 !important;
left: auto;
border-radius: 0;
margin-top: 20px;
}
</style>


<div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
<div class="profile-info dropdown">
    <div class="profile-comments" style="padding:0 10px;">
        <a class="dropdown-toggle" id="conv_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-envelope" style="font-size:25px;"></i>
            <span id="notf_conv" style="top:-20px;left:15px; background:green;">{{ $conv_notf->count() }}</span>
            <h6 style="font-size:10px; ">Message</h6>
        </a>

        <div class="profile-notifi-content dropdown-menu" style="max-height: 500px;padding:0px;border-radius:5px;">

        </div>
    </div>

    {{-- <div class="profile-comments"  style="padding:0 10px;">
        <a class="dropdown-toggle" id="vendor_product_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-bell" style="font-size:25px;"></i>
            <span id="notf_vendor_product" style="top:-20px;left:12px; background-color:#ac930f;" >{{ $vendor_product_notf->count() }}</span>
            <h6 style="font-size:10px; ">Vendor</h6>
        </a>

        <div class="profile-vendor-product-content dropdown-menu scroll-box" style="max-height: 500px;left:-300px; padding:0px;width:350px;margin-top:20px;border-radius: 5px;">

        </div>
    </div> --}}

    {{-- <div class="profile-notifi" style="padding-left: 0;">
        <a class="dropdown-toggle" id="user_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{asset('assets/admin/img/flag.png')}}" alt="flag image">
            <span id="notf_user">{{ $vendor_product_notf->count() }}</span>
        </a>

        <div class="profile-wishlist-content dropdown-menu">

        </div>
    </div> --}}

    <div class="profile-notifi"  style="padding:0 10px;">
        <a class="dropdown-toggle" id="order_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-basket-loaded" style="font-size:25px;"></i>
            <span id="notf_order" style="top:-20px;left:15px; background:#d9534f;" >{{ $order_notf->count() }}</span>
            <h6 style="font-size:10px; ">Order</h6>
        </a>

        <div class="profile-notifi-content dropdown-menu scroll-box" style="max-height: 500px; padding:0px;border-radius: 5px;">

        </div>
    </div>

    {{-- <div class="profile-comments" style="padding: 0px 10px;">
        <a class="dropdown-toggle" id="user_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-notebook" style="font-size:25px;"></i>
            <span id="notf_prescription" style="top:-20px;left:15px; background-color:purple;" >{{ $prescription_notf->count() }}</span>
            <h6 style="font-size:10px; ">Pres.</h6>
        </a>

        <div class="profile-prescription-content dropdown-menu scroll-box" style="max-height: 500px; padding:0px;border-radius: 5px;">

        </div>
    </div> --}}

    {{-- <div class="profile-comments"  style="padding:0 10px;">
        <a class="dropdown-toggle" id="vendor_order_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-medical-010 u-line-icon-pro" style="font-size:20px;"></i>
            <span id="notf_vendor_order" style="top:-17px;left:15px; background-color:#0b8eff;">{{ $vendor_order_notf->count() }}</span>
            <h6 style="font-size:10px; ">Lab </h6>
        </a>

        <div class="profile-vendor-order-content dropdown-menu scroll-box" style="max-height: 500px;padding:0px;border-radius: 5px;">

        </div>
    </div> --}}

    <div class="profile-comments"  style="padding:0 10px;">
        <a class="dropdown-toggle" id="product_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-flag" style="font-size:25px;"></i>
            <span id="notf_product" style="top:-18px;left:15px;">{{ $product_notf->count() }}</span>
            <h6 style="font-size:10px; ">Stock</h6>
        </a>

        <div class="profile-comments-content dropdown-menu" style="max-height: 500px;padding:0px;border-radius: 5px;">

        </div>
    </div>

    <div class="view-profile">
        <div class="profile__img dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-options-vertical"></i>
        </div>
        <div class="profile-content dropdown-menu" style="border-radius: 10px;margin-top:0px;    box-shadow: -18px 20px 10px #cccccc;">
           
            <a style="margin-left: 4px;" href="{{route('admin-profile')}}"><i class="icon-user"></i>Edit Profile</a>
            <a href="{{route('admin-password-reset')}}"><i class="icon-settings"></i>Change Password</a>

            <a href="{{route('admin-logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-logout"></i>Logout</a>
            <form id="logout-form" action="{{route('admin-logout')}}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
</div>
