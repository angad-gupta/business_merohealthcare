@extends('layouts.user')
@section('content')   

<link rel="shortcut icon" href="/frontend-assets/main-assets/favicon.ico">
  <!-- Google Fonts -->
  
  <!-- CSS Global Compulsory -->
  
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line/css/simple-line-icons.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-etlinefont/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/hamburgers/hamburgers.min.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/animate.css">
  <!-- CSS Unify -->


  <!-- CSS Customization -->


<style>
.title-stats {
    position: relative;
    display: block;
    background-color: #303641;
    color: #777;
    padding: 10px 20px 20px;
    margin-bottom: 30px;
    border-radius: 5px;
    transition: .4s;
}

.title-stats .icon {
    color: #2385aa;
    position: absolute;
    right: 5px;
    bottom: 8px;
}
.title-stats:hover {color: #2385aa;}

.title-stats .icon i {
    font-size: 80px;
    line-height: 0;
}

h4{
    width:80%;
}

h4{
    font-size: 15px;
}

.title-stats .icon i {
    font-size: 57px;
    line-height: 0;
    position: relative;
    top: -13px;
    right: 8px;

}
.title-stats{
    border-radius:20px;
    background: #f9f9f9 !important;

}

</style>



        <div class="right-side">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard header items area -->
                        <div class="panel panel-default admin">
                            <div class="panel-heading admin-title">
                                <div class="product__header" style="border-bottom: none;">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    @if(Auth::guard('user')->user()->is_vendor == 2) 
                                                    <h2 style="font-size: 25px;">Lab Vendor Dashboard </h2>
                                                    @elseif(Auth::guard('user')->user()->is_vendor == 3)
                                                    <h2 style="font-size: 25px;">Product Vendor Dashboard</h2>
                                                    @else
                                                    <h2 style="font-size: 25px;font-weight:300;">{{$user->name}}'s Dashboard </h2>
                                                    @endif
                                                </div>
                                            </div>
                                              @include('includes.user-notification')
                                        </div>   
                                    </div></div>

                                

                            <div class="panel-body dashboard-body">
                                <div class="dashboard-header-area">
                                    
                                        @include('includes.form-success')
                                        
                                        {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <a class="title-stats title-indigo">
                                                <div class="icon"><i class="fa fa-money fa-5x"></i></div>
                                                <div style="font-size: 38px; font-weight: 600;">{{$currency_sign->sign}} <span>{{number_format($user->affilate_income * $currency_sign->value,2)}}</span></div>
                                                <h4>{{$lang->affilate_bonus}}</h4>
                                            </a>
                                        </div> --}}
                                        @if(Auth::guard('user')->user()->is_vendor == 2) 
                                        <div class="row">
                                           
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <a class="title-stats title-purple" href="{{route('vendor-lab-order-index')}}" style="background:transparent;    border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-medical-010 u-line-icon-pro fa-5x"></i></div>
                                                    <div class="number">{{ Modules\Lab\Entities\LabOrder::where('vendor_id','=',$user->id)->count() }}</div>
                                                    <h4>Total Lab Orders</h4>
                                                   

                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <a  class="title-stats title-blue" style="background:transparent;    border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-check fa-5x"></i></div>
                                                    <div style="font-size: 38px; font-weight: 600;">{{$currency_sign->sign}} {{ number_format(Modules\Lab\Entities\LabOrder::where('user_id','=',$user->id)->where('status','completed')->sum('pay_amount')  * $currency_sign->value,2) }}</div>
                                                    <h4>{{$lang->total_earning}}</h4>
                                                  

                                                </a>
                                            </div>
                                        </div>

                                        @elseif(Auth::guard('user')->user()->is_vendor == 3)
                                        <div class="row">
                                           
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <a class="title-stats title-purple" href="{{route('user-vendor-product.index')}}" style="background:transparent; border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-basket-loaded u-line-icon-pro fa-5x"></i></div>
                                                    <div class="number">{{ App\Product::where('user_id','=',$user->id)->count() }}</div>
                                                    <h4>Total Product </h4>
                                                   

                                                </a>
                                            </div>
                       
                                        </div>

                                        @else

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <h2 class="h4" style="color:#555; margin-left:15px;font-weight:600;">Wishlist</h2>
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                  
                                                    <a href="{{route('user-wishlist')}}" class="title-stats title-red" style="background:#ffd5d5 !important;border: 1px solid;
                                                    border-color: #e3e3e3;">
                                                        <div class="icon"><i class="icon-medical-022 u-line-icon-pro fa-5x"></i></div>
                                                        <div class="number">{{count($wishes)}}</div>
                                                        <h4>{{$lang->favorite_product}}</h4>
                                                        {{-- <span class="title-view-btn">{{$lang->view_all}}</span> --}}
                                                    </a>
                                                </div>
                                           </div>

                                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                            <h2 class="h4" style="color:#555; margin-left:15px;font-weight:600;">Purchased Order</h2>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            
                                                <a href="{{route('user-orders')}}" class="title-stats title-cyan" style="background:#ffeed0 !important; border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-transport-069 u-line-icon-pro fa-5x"></i></div>
                                                    <div class="number">{{$process}} </div>
                                                    <h4>{{$lang->order_processing}}</h4>
                                                    {{-- <span class="title-view-btn">{{$lang->view_all}}</span> --}}
                                                </a>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a href="{{route('user-orders')}}" class="title-stats title-green" style="background:#d3f3d3 !important;border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-check fa-5x"></i></div>
                                                    <div class="number">{{$complete}}</div>
                                                    <h4>{{$lang->order_completed}}</h4>
                                                    {{-- <span class="title-view-btn">{{$lang->view_all}}</span> --}}
                                                </a>
                                            </div>
                                            </div>

                                           
                                           {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <h2 class="h4" style="color:#555; margin-left:15px;font-weight:600;">Family</h2>
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                  
                                                    <a href="{{route('user-family.index')}}" class="title-stats title-red" style="background:#ffd9ff !important;border: 1px solid;
                                                    border-color: #e3e3e3;">
                                                        <div class="icon"><i class="icon-user-follow fa-5x"></i></div>
                                                        <div class="number">{{count($family)}}</div>
                                                        <h4>Family Member(s)</h4>
                                                       
                                                    </a>
                                                </div>
                                           </div> --}}
                                           {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <h2 class="h4" style="color:#555; margin-left:15px;font-weight:600;">Prescription Files</h2>
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                  
                                                    <a href="{{route('user-filemanager')}}" class="title-stats title-red" style="background:#baffff !important;border: 1px solid;
                                                    border-color: #e3e3e3;">
                                                        <div class="icon"><i class="fa fa-folder-o fa-5x"></i></div>
                                                        <div class="number">{{count($files)}}</div>
                                                        <h4>All Prescription Files</h4>
                                                        
                                                    </a>
                                                </div>
                                           </div> --}}
{{-- 
                                           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <h2 class="h4" style="color:#555; margin-left:15px;font-weight:600;">Messages</h2>
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                  
                                                    <a href="{{route('user-messages')}}" class="title-stats title-red" style="background:transparent;border: 1px solid;
                                                    border-color: #e3e3e3;">
                                                        <div class="icon"><i class="fa fa-envelope-o fa-5x"></i></div>
                                                        <div class="number">{{count($message)}}</div>
                                                        <h4>Message(s)</h4>
                                                    
                                                    </a>
                                                </div>
                                           </div> --}}
                                           
                                        </div>

                                        <div class="row">
                                       
                                            {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                                <h2 class="h4" style="color:#555; margin-left:15px;font-weight:600;">Lab Orders</h2>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                                <a class="title-stats title-purple" href="{{route('user-lab-order-index')}}" style="background:#ffeed0 !important;    border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-medical-010 u-line-icon-pro fa-5x"></i></div>
                                                    <div class="number">{{ Modules\Lab\Entities\LabOrder::where('user_id','=',$user->id)->where('status','processing')->count() }}</div>
                                                    <h4>{{$lang->order_processing}}</h4>
                                                  

                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a  class="title-stats title-blue" href="{{route('user-lab-order-index')}}" style="background:#d3f3d3 !important;    border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-check fa-5x"></i></div>
                                                    <div class="number">{{ Modules\Lab\Entities\LabOrder::where('user_id','=',$user->id)->where('status','completed')->count() }}</div>
                                                    <h4>{{$lang->order_completed}} </h4>
                                                  

                                                </a>
                                            </div>
                                        </div> --}}
                                        </div>
{{-- 
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                            <h2 class="h4" style="color:#555; margin-left:15px;font-weight:600;">Prescription Orders</h2>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                                <a class="title-stats title-purple" href="{{route('user-prescriptions.index')}}" style="background:#ffeed0 !important;    border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-medical-099 u-line-icon-pro fa-5x"></i></div>
                                                    <div class="number">{{ App\Prescription::where('user_id','=',$user->id)->where('status','processing')->count() }}</div>
                                                    <h4>{{$lang->order_processing}}</h4>
                                                   

                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a  class="title-stats title-blue" href="{{route('user-prescriptions.index')}}" style="background:#d3f3d3 !important;    border: 1px solid;
                                                border-color: #e3e3e3;">
                                                    <div class="icon"><i class="icon-check fa-5x"></i></div>
                                                    <div class="number">{{ App\Prescription::where('user_id','=',$user->id)->where('status','completed')->count() }}</div>
                                                    <h4>{{$lang->order_completed}}</h4>
                                               

                                                </a>
                                            </div>
                                            </div>
                                        </div>
                                         --}}
                                      
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Ending of Dashboard header items area -->


                    </div>
                </div>
            </div>
        </div>

@endsection