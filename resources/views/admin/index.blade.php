@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Marck+Script&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
<style>
    .number{
        color:#2385aa;
    }
    h4{
        color:#999;
        font-size:15px;
    }

    .title-stats .icon i {
    font-size: 30px;
    line-height: 0;
    }
    .title-stats .icon {
    color: rgba(0, 0, 0, 0.1);
    position: absolute;
    right: 20px;
    bottom: 8px;
}
 
.u-block-hover:hover .u-block-hover__additional--jump,
.u-block-hover.u-block-hover__additional--jump:hover {
  transform: translate3d(0, -10px, 0);
}



.u-shadow-v19 {
    box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.1);
}
.title-stats h4 {
    margin-bottom: 10px;
    font-weight: 300;
}
.title-stats .number {
    font-size: 22px;
    font-weight: 400;
}

/* Blue Shadow */
@-moz-keyframes blue {
  0%,
  100% {
    -moz-box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -moz-box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-webkit-keyframes blue {
  0%,
  100% {
    -webkit-box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-o-keyframes blue {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@keyframes blue {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px rgba(0, 130, 196, 0.7),
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(0, 130, 196, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-moz-keyframes yellow {
  0%,
  100% {
    -moz-box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -moz-box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-webkit-keyframes yellow {
  0%,
  100% {
    -webkit-box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    -webkit-box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@-o-keyframes yellow {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

@keyframes yellow {
  0%,
  100% {
    box-shadow: 1px 0px 19px 4px #fff503,
      inset 0px 0px 10px rgba(255, 255, 255, 0.5);
  }

  50% {
    box-shadow: 0px 0px 0px 0px rgba(255, 245, 3, 0),
      inset 0px 0px 0px rgba(255, 255, 255, 0);
  }
}

.blue {
  /* text-shadow: 0px 1px 0px #83e0f7; */
  /* background-image: -webkit-linear-gradient(top, #87e0fd, #53cbf1);
  background-image: -moz-linear-gradient(top, #87e0fd, #53cbf1);
  background-image: -o-linear-gradient(top, #87e0fd, #53cbf1);
  background-image: linear-gradient(to bottom, #87e0fd, #53cbf1); */
  -webkit-animation: blue 2s infinite;
  -moz-animation: blue 2s infinite;
  -o-animation: blue 2s infinite;
  animation: blue 4s infinite;
}
.yellow {
  text-shadow: 0px 1px 0px #faffc7;
  background-image: -webkit-linear-gradient(top, #fff966, #f3fd80);
  background-image: -moz-linear-gradient(top, #fff966, #f3fd80);
  background-image: -o-linear-gradient(top, #fff966, #f3fd80);
  background-image: linear-gradient(to bottom, #fff966, #f3fd80);
  -webkit-animation: yellow 2s infinite;
  -moz-animation: yellow 2s infinite;
  -o-animation: yellow 2s infinite;
  animation: yellow 4s infinite;
}

.title-stats {
    position: relative;
    display: block;
    background-color: #303641;
    color: #fff;
    padding: 10px 20px 20px;
    margin-bottom: 30px;
    border-radius: 25px;
    transition: .4s;
}


</style>

{{-- <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-components.css"> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>

       <div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard header items area -->
                        <div class="panel panel-default admin">
                          <div class="panel-heading admin-title">
                                <div class="product__header" style="border-bottom: none;">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title" style="display: inline-flex;">
                                                    <span><h3 style="font-family: 'Carter One', cursive;font-size:25px;background-image: linear-gradient(-260deg, #3398dc, rgba(66, 229, 248, 0.8));color:white;padding:5px;border-top-left-radius:5px;border-bottom-left-radius:5px;text-shadow:0 0 5px black;"> Business MHC</h3></span>
                                                     <span><h3 style="font-family: 'Carter One', cursive;font-size:25px;color:#d9534f;background-image: linear-gradient(-260deg, #68e7f8, rgba(66, 229, 248, 0.8));padding:5px;text-shadow: 0 0 6px white;">&nbsp;Admin</h3></span>
                                                     <span><h3 style="font-family: 'Carter One', cursive;font-size:25px;color:#108ba0;background-image: linear-gradient(-260deg, #68e7f8, rgba(66, 229, 248, 0.8));padding:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;text-shadow: 0 0 6px white;"> Dashboard</h3></span>
                                                 </div>
                                            </div>
                                              @include('includes.notification')
                                        </div>   
                                    </div>
                            </div>
                              <div class="panel-body dashboard-body" style="background-color:#eee;" >
                                  <div class="dashboard-header-area">


                                    <div class="row">
                                        <div class="col-sm-12">
                                            @include('includes.form-success')
                                            @if($activation_notify != "")
                                                <div class="alert alert-danger validation">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h3 class="text-center">{!! $activation_notify !!}</h3>
                                                </div>
                                            @endif
                                        </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <h4 class="h4 g-font-weight-200 g-mb-20" style="margin-left: 15px;font-weight:600;color:#555;">Sales</h4>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <a href="#" class="title-stats title-teal u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                <div class="icon"><i class="icon-finance-260 u-line-icon-pro" style="color:green"></i></div>
                                                @php
                                                    $sales = App\Order::where('status','completed')->sum('pay_amount');
                            
                                                @endphp
                                                <div class="counting-sec"><div style="font-size: 22px;font-weight: 400;color:#2385aa">Rs.<span class="num">{{number_format($sales)}}</span></div></div>
                                                <h4>Total Sales!</h4>
                                           
                                            </a>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <a href="{{route('admin-order-processing')}}" class="title-stats title-teal u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                <div class="icon"><i class="icon-finance-260 u-line-icon-pro" style="color:orange"></i></div>
                                                @php
                                                    $sales = App\Order::where('status','=','processing')->sum('pay_amount');
                            
                                                @endphp
                                                <div style="font-size: 22px;font-weight: 400;color:#2385aa">Rs.<span class="num">{{number_format($sales)}}</span></div>
                                                <h4>Processing Sales!</h4>
                                           
                                            </a>
                                        </div>

                                     
                                    </div>
                                  
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                    <h4 class="h4 g-font-weight-200 g-mb-20" style="margin-left: 15px;font-weight:600;color:#555;">Overview</h4>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a href="#" class="title-stats title-teal u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                            <div class="icon"><i class="icon-finance-260 u-line-icon-pro" style="color:red"></i></div>
                                            @php
                                                $sales = App\Order::where('status','declined')->sum('pay_amount');
                        
                                            @endphp
                                            <div style="font-size: 22px;font-weight: 400;color:#2385aa">Rs.<span class="num">{{number_format($sales)}}</span></div>
                                            <h4>Declined Sales!</h4>
                                       
                                        </a>
                                    </div>
                                  
                                    {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a href="{{route('admin-vendor-enquiry-index')}}" class="title-stats title-teal u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                            <div class="icon"><i class="icon-chart" style="color:#696969"></i></div>
                                            @php
                                                $payment_gateway = App\Order::where('status','=','completed')->where('method','Cash On Delivery')->get();
                                                $payment_gateway_online = App\Order::where('status','=','completed')->where('method','!=','Cash On Delivery')->get();
                                            @endphp
                                            <div style="font-size: 30px;font-weight: 400;color:#2385aa"><span class="number">{{count($payment_gateway)}}</span><span style="font-size:12px">COD</span> <span class="number"> {{count($payment_gateway_online)}}</span> <span style="font-size:12px">Online</span></div>
                                            <h4>Payment Gateway</h4>
                                       
                                        </a>
                                    </div> --}}
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a href="#" class="title-stats title-teal u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                            <div class="icon"><i class="icon-chart" style="color:#696969"></i></div>
                                            @php
                                                $cod = App\Order::where('status','=','completed')->where('method','Cash On Delivery')->sum('pay_amount');
                                                $online = App\Order::where('status','=','completed')->where('method','!=','Cash On Delivery')->sum('pay_amount');
                                            @endphp
                                            <div style="font-size: 15px;font-weight: 400;color:#2385aa">Rs.<span class="num" style="font-size:15px;">{{number_format($cod)}}</span><span style="font-size:12px; color:green"> Cash<br/></span> Rs.<span class="num" style="font-size:15px;">{{number_format($online)}}</span> <span style="font-size:12px;color:orange">Online</span></div>
                                            <h4>Payment Received</h4>
                                       
                                        </a>
                                    </div>
                              
                                    </div>
                                </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @include('includes.form-success')
                                            @if($activation_notify != "")
                                                <div class="alert alert-danger validation">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h3 class="text-center">{!! $activation_notify !!}</h3>
                                                </div>
                                            @endif
                                        </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <h4 class="h4 g-font-weight-200 g-mb-20" style="margin-left: 15px;font-weight:600;color:#555;">Products</h4>
                                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 ">
                                            <a href="{{route('admin-prod-index')}}" class="title-stats title-red u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                @php
                                                $admin_products = App\Product::where('user_id','=','0')->get();;
                                                @endphp
                                                <div class="icon"><i class="icon-finance-100 u-line-icon-pro" style="color: #2385aa"></i></div>
                                                <div class="number">{{count($admin_products)}}</div>
                                                <h4>Admin Products !</h4>
                                          
                                            </a>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <a href="{{route('admin-user-index')}}" class="title-stats title-red u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                <div class="icon"><i class="icon-people" style="color:#f56954"></i></div>
                                                <div class="number">{{count($users)}}</div>
                                                <h4>Total!</h4>
                                          
                                            </a>
                                        </div>

                                        {{-- <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                            <a href="{{route('admin-vendor-prod-index')}}" class="title-stats title-red u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                @php
                                                $vendor_products = App\Product::where('user_id','!=','0')->get();;
                                                @endphp
                                                <div class="icon"><i class="icon-finance-100 u-line-icon-pro" style="color:#ac930f"></i></div>
                                                <div class="number">{{count($vendor_products)}}</div>
                                                <h4>Vendor Products!</h4>
                                          
                                            </a>
                                        </div> --}}

                                        {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <a href="{{route('admin-prod-index')}}" class="title-stats u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                <div class="icon"><i class="icon-check" style="color:green"></i></div>
                                                <div class="number">{{count($products)}}</div>
                                                <h4>Total Products!</h4>
                                             
                                            </a>
                                        </div> --}}
                                    </div>
                                  
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                        <h4 class="h4 g-font-weight-200 g-mb-20" style="margin-left: 15px;font-weight:600;color:#555;">Purchase Orders</h4>
                                            {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <a href="{{route('admin-order-pending')}}" class="title-stats title-cyan">
                                                    <div class="icon"><i class="fa fa-usd fa-5x"></i></div>
                                                    <div class="number">{{count($pending)}}</div>
                                                    <h4>Orders Pending!</h4>
                                               
                                                </a>
                                            </div> --}}
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a href="{{route('admin-order-processing')}}" class="yellow title-stats title-orange u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background: white">
                                                    <div class="icon"><i class="fa fa-truck fa-5x" style="color:orange"></i></div>
                                                    <div class="number">{{count($processing)}}</div>
                                                    <h4><i class="fa fa-spinner fa-spin"></i>
                                                        <span class="sr-only">Loading...</span>Orders Pending! </h4>
                                        
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a href="{{route('admin-order-completed')}}" class="title-stats title-green u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background: white">
                                                    <div class="icon"><i class="fa fa-check fa-5x" style="color:green;"></i></div>
                                                    <div class="number">{{count($completed)}}</div>
                                                    <h4>Orders Completed!</h4>
                                               
                                                </a>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                 

                                  

                                  
                                </div>

                                   

                                    <div class="row">

                                        {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                            <h4 class="h4 g-font-weight-200 g-mb-20" style="margin-left: 15px;font-weight:600;color:#555;">Medicine Prescription Orders</h4>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <a href="{{route('admin-prescriptions-index')}}" class="title-stats title-orange u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background: white">
                                                        <div class="icon"><i class="fa fa-truck fa-5x" style="color:orange;"></i></div>
                                                        <div class="number">{{count($prescription_processing)}}</div>
                                                        <h4><i class="fa fa-spinner fa-spin"></i>
                                                            <span class="sr-only">Loading...</span>Orders Pending!</h4>
                                                   
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <a href="{{route('admin-prescriptions-index')}}" class="title-stats title-green u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background: white;">
                                                        <div class="icon"><i class="fa fa-check fa-5x" style="color:green;"></i></div>
                                                        <div class="number">{{count($prescription_completed)}}</div>
                                                        <h4>Orders Completed!</h4>
                                             
                                                    </a>
                                                </div>
                                            </div> --}}

                                        {{-- @php
                                        $lab_prescription_processing = App\Prescription::where('type','=','lab')->where('status','=','processing')->get();
                                       $lab_prescription_completed = App\Prescription::where('type','=','lab')->where('status','=','completed')->get();
                                        @endphp --}}
{{-- 
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                       <h4 class="h4 g-font-weight-200 g-mb-20" style="margin-left: 15px;font-weight:600;color:#555;">Lab Prescription Orders</h4>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                               <a href="{{route('admin-prescriptions-lab-index')}}" class="title-stats title-orange u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background: white">
                                                   <div class="icon"><i class="fa fa-truck fa-5x" style="color:orange;"></i></div>
                                                   <div class="number">{{count($lab_prescription_processing)}}</div>
                                                   <h4><i class="fa fa-spinner fa-spin"></i>
                                                    <span class="sr-only">Loading...</span>Orders Pending!</h4>
                                              
                                               </a>
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                               <a href="{{route('admin-prescriptions-lab-index')}}" class="title-stats title-green u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background: white">
                                                   <div class="icon"><i class="fa fa-check fa-5x" style="color: green"></i></div>
                                                   <div class="number">{{count($lab_prescription_completed)}}</div>
                                                   <h4>Orders Completed!</h4>
                                        
                                               </a>
                                           </div>
                                    </div> --}}

                               
                                      
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                        <h4 class="h4 g-font-weight-200 g-mb-20" style="margin-left: 15px;font-weight:600;color:#555;">Contacts</h4>
                                       
                   
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <a href="{{route('admin-vendor-enquiry-index')}}" class="title-stats title-teal u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                <div class="icon"><i class="fa fa-question fa-5x" style="color:#696969"></i></div>
                                                @php
                                                    $enq = App\ProviderEnquiry::all();
                                                @endphp
                                                <div class="number">{{count($enq)}}</div>
                                                <h4>Vendor Enquires!</h4>
                                           
                                            </a>
                                        </div>
                                        @if(Auth::guard('admin')->user()->isAdmin())
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <a href="{{route('admin-subs-index')}}" class="title-stats title-blue u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background-color:white; ">
                                                <div class="icon"><i class="fa fa-at fa-5x" style="color:#671414;"></i></div>
                                                <div class="number">{{count($subs)}}</div>
                                                <h4>Total Subscribers!</h4>
                                    
                                            </a>
                                        </div>
                                        @endif
                                        </div>
                                    </div> --}}

                                  
                            </div>
                        </div>
                        <!-- Ending of Dashboard header items area -->

                    <!-- Starting of Dashboard Top reference + Most Used OS area -->
                    {{-- <div class="reference-OS-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="panel panel-default admin top-reference-area">
                                    <div class="panel-heading">Top Referrals</div>
                                    <div class="panel-body">
                                        <div id="chartContainer-topReference"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="panel panel-default admin top-reference-area">
                                    <div class="panel-heading">Most Used OS</div>
                                    <div class="panel-body">
                                        <div id="chartContainer-os"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Ending of Dashboard Top reference + Most Used OS area -->
                        <!-- Starting of Dashboard header items area -->
                        {{-- <div class="panel panel-default admin">
                          <div class="panel-heading admin-title">Total Sales in Last 30 Days</div>
                              <div class="panel-body dashboard-body">
                                  <div class="dashboard-header-area">
                                    <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="padding: 0">
                        <canvas id="lineChart" style="width: 100%"></canvas>
                    </div>     
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                                        
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".num").counterUp({delay:10,time:3000});
      </script>

    
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>



    <script language="JavaScript">
        displayLineChart();
        function displayLineChart() {
            var data = {
                labels: [
                    {!! $days !!}
                ],
                datasets: [
                    {
                        label: "Prime and Fibonacci",
                        fillColor: "#3dbcff",
                        strokeColor: "#0099ff",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            {!! $sales !!}
                        ]
                    }
                ]
            };
            var ctx = document.getElementById("lineChart").getContext("2d");
            var options = {
                responsive: true
            };
            var lineChart = new Chart(ctx).Line(data, options);
        }
        </script>

<script type="text/javascript">
        var chart1 = new CanvasJS.Chart("chartContainer-topReference",
            {
                exportEnabled: true,
                animationEnabled: true,

                legend: {
                    cursor: "pointer",
                    horizontalAlign: "right",
                    verticalAlign: "center",
                    fontSize: 16,
                    padding: {
                        top: 20,
                        bottom: 2,
                        right: 20,
                    },
                },
                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        legendText: "",
                        toolTipContent: "{name}: <strong>{#percent%} (#percent%)</strong>",
                        indexLabel: "#percent%",
                        indexLabelFontColor: "white",
                        indexLabelPlacement: "inside",
                        dataPoints: [
                                @foreach($referrals as $browser)
                                    {y:{{$browser->total_count}}, name: "{{$browser->referral}}"},
                                @endforeach
                        ]
                    }
                ]
            });
        chart1.render();

        var chart = new CanvasJS.Chart("chartContainer-os",
            {
                exportEnabled: true,
                animationEnabled: true,
                legend: {
                    cursor: "pointer",
                    horizontalAlign: "right",
                    verticalAlign: "center",
                    fontSize: 16,
                    padding: {
                        top: 20,
                        bottom: 2,
                        right: 20,
                    },
                },
                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        legendText: "",
                        toolTipContent: "{name}: <strong>{#percent%} (#percent%)</strong>",
                        indexLabel: "#percent%",
                        indexLabelFontColor: "white",
                        indexLabelPlacement: "inside",
                        dataPoints: [
                            @foreach($browsers as $browser)
                                {y:{{$browser->total_count}}, name: "{{$browser->referral}}"},
                            @endforeach
                        ]
                    }
                ]
            });
        chart.render();    
</script>
@endsection