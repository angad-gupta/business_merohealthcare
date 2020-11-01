@extends('layouts.admin')

@section('styles')
<style type="text/css">
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    border-top: none;
}
.add-product-box {
    box-shadow: none;
}
.add-product-1
{
    padding-bottom: 30px;
}

.tabbable-panel {
  border:1px solid #eee;
  padding: 10px;
}

.tabbable-line > .nav-tabs {
  border: none;
  margin: 0px;
}
.tabbable-line > .nav-tabs > li {
  margin-right: 2px;
}
.tabbable-line > .nav-tabs > li > a {
  border: 0;
  margin-right: 0;
  color: #737373;
}
.tabbable-line > .nav-tabs > li > a > i {
  color: #a6a6a6;
}
.tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
  border-bottom: 4px solid rgb(80,144,247);
}
.tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
  border: 0;
  background: none !important;
  color: #333333;
}
.tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
  color: #a6a6a6;
}
.tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
  margin-top: 0px;
}
.tabbable-line > .nav-tabs > li.active {
  border-bottom: 4px solid #32465B;
  position: relative;
}
.tabbable-line > .nav-tabs > li.active > a {
  border: 0;
  color: #333333;
}
.tabbable-line > .nav-tabs > li.active > a > i {
  color: #404040;
}
.tabbable-line > .tab-content {
  margin-top: -3px;
  background-color: #fff;
  border: 0;
  border-top: 1px solid #eee;
  padding: 15px 0;
}
.portlet .tabbable-line > .tab-content {
  padding-bottom: 0;
}
</style>
{{-- <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-core.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-components.css"> --}}
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-globals.css">


@endsection
        
@section('content')

<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard area -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="add-product-box">
                                    <div class="product__header"  style="border-bottom: none;">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Customer Details <a href="{{ route('admin-user-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Customers <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Customer Details
                                                </div>
                                            </div>
                                              @include('includes.notification')
                                        </div>   
                                    </div>
                                    @php
                                      $orders = App\Order::where('user_id','=',$user->id)->orderBy('id','desc')->get();
                                    @endphp

                                        <div class="">
                                            <div class="row">
                                              <div class="col-md-12">
                                                      <div class="tabbable-panel">
                                                          <div class="tabbable-line">
                                                              <ul class="nav nav-tabs ">
                                                                  <li class="active">
                                                                      <a href="#tab_default_1" data-toggle="tab" style="padding-right:35px;">
                                                                           Customer Details </a>
                                                                  </li>
                                                                  <li>
                                                                      <a href="#tab_default_2" data-toggle="tab" style="padding-right:35px;">
                                                                        Orders <span class="label label-primary" style="border-radius: 20px;"> {{count($orders)}}</span> </a>
                                                                  </li>
                                                           
                                                              </ul>
                                                              <div class="tab-content">
                                                                  <div class="tab-pane active" id="tab_default_1">
                                                                    <table class="table" style="border-color: transparent;">
                                                                        <tbody>
                                            
                                                                            <tr>
                                                                                <td width="49%" style="text-align: right;"><strong>Customer Image :</strong></td>
                                                                                <td>
                                                                                    @if($user->is_provider == 1)
                                                                                    <img style="width: 100px; height: 100px;border-radius:50%;" src="{{ $user->photo ? $user->photo:asset('assets/images/user.png')}}" alt="profile no image">
                                                                                    @else
                                                                                    <img  style="width: 100px; height: 100px;border-radius:50%;" id="adminimg" src="{{ $user->photo ? asset('assets/images/'.$user->photo):asset('assets/images/user.png')}}" alt="profile image">
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                            
                                                                         
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Customer ID#</strong></td>
                                                                            <td>{{$user->id}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Name:</strong></td>
                                                                            <td>{{$user->name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Email:</strong></td>
                                                                            <td>{{$user->email}}</td>
                                                                        </tr>
                                                                        @if($user->phone != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Phone:</strong></td>
                                                                            <td>{{$user->phone}}</td>
                                                                        </tr>
                                                                        @endif
                                            
                                                                       
                                            
                                                                        @if($user->fax != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Fax:</strong></td>
                                                                            <td>{{$user->fax}}</td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($user->address != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Address:</strong></td>
                                                                            <td>{{$user->address}}</td>
                                                                        </tr>
                                                                        @endif
                                            
                                                    
                                            
                                                                        
                                            
                                                                        @if($user->dob != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Date Of Birth:</strong></td>
                                                                            <td>{{$user->dob}}</td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($user->city != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>City:</strong></td>
                                                                            <td>{{$user->city}}</td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($user->zip != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Zip:</strong></td>
                                                                            <td>{{$user->zip}}</td>
                                                                        </tr>
                                                                        @endif

                                                                        @if($user->company_name != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Company Name:</strong></td>
                                                                            <td>{{$user->company_name}}</td>
                                                                        </tr>
                                                                        @endif

                                                                        @if($user->registration_number != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Registration Number:</strong></td>
                                                                            <td>{{$user->registration_number}}</td>
                                                                        </tr>
                                                                        @endif

                                                                        @if($user->pan_vat != "")
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>PAN / VAT Number:</strong></td>
                                                                            <td>{{$user->pan_vat}}</td>
                                                                        </tr>
                                                                        @endif

                                                                        <tr>
                                                                          <td width="49%" style="text-align: right;"><strong>Registration Certificates:</strong></td>
                                                                          <td>
                                                                            @php
                                                                              $decoded = json_decode($user->registration_file, true);
                                                                            @endphp
                                                                            @foreach((array)$decoded as $d)
                                                                                <a href="{{route('admin-businesscustomer-reg-file',[$user->id,$d])}}" target="_blank"><i class="fa fa-image" style="font-size:18px;"></i></a>
                                                                            @endforeach
                                                                          </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Joined:</strong></td>
                                                                            <td>{{$user->created_at->diffForHumans()}}</td>
                                                                        </tr>
                                                                        @if($user->is_provider == 1)
                                                                        @php 
                                                                            $social = App\SocialProvider::where('user_id','=',$user->id)->first();
                                                                    
                                                                        @endphp
                                                                        <tr>
                                                                            <td width="49%" style="text-align: right;"><strong>Social Login:</strong></td>
                                                                            @if($social->provider == 'google')
                                                                                <td>
                                                                                    <a class="u-icon-v3 g-bg-google-plus g-rounded-30x g-color-white g-color-white--hover g-mr-0 g-mb-20" style="padding:5px;border-radius:30%;" href="#!">
                                                                                        <i class="fa fa-google"></i>
                                                                                      </a>
                                                                                </td>
                                                                            @elseif(($social->provider == 'facebook')) 
                                                                            <td>
                                                                                <a class="u-icon-v3 g-bg-facebook g-rounded-30x g-color-white g-color-white--hover g-mr-15 g-mb-20" style="padding:5px;border-radius:30%;" href="#!">
                                                                                    <i class="fa fa-facebook"></i>
                                                                                  </a>
                                                                            </td>
                                                                            @endif
                                                                        </tr>
                                                                        @endif
                                            
                                                                        </tbody>
                                                                    </table>
                                            
                                                                                
                                                                        <div class="text-center">
                                                                            <input type="hidden" value="{{$user->email}}"><a style="cursor: pointer;" data-toggle="modal" data-target="#emailModal1" class="btn btn-primary email1"><i class="fa fa-send"></i> Contact Customer</a>
                                                                        </div>
                                            
                                                                      </div>
                                                                  <div class="tab-pane" id="tab_default_2">
                                                                    <div class="table-responsive" style="margin-top:20px;">
                                                                     
                                                            
                                                                        <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                      <th style="">Date</th>
                                                                                      <th style="">Invoice Number</th>
                                                                                      <th style="">Status</th>
                                                                              
                                                                                    </tr>
                                                                                </thead>
                                                            
                                                                                <tbody>
                                                                            @foreach($orders as $order)                      
                                                                                <tr role="row" class="odd">
                                                                                  <td> {{date('d M Y',strtotime($order->created_at))}} </td>
                                                                                  <td>
                                                                                    <a href="{{route('admin-order-invoice',$order->id)}}">{{sprintf("%'.08d", $order->id)}}</a>
                                                                                    <small style="display: block; color: #777; text-transform:uppercase;">[{{$order->order_number}}]</small>
                                                                                  </td>
                                                                                  <td>
                                                                                      @if($order->status == 'completed')
                                                                                    <span class="label label-success" style="border-radius: 20px;"> {{$order->status}}</span>
                                                                                    @elseif($order->status == 'pending')
                                                                                    <span class="label label-warning" style="border-radius: 20px;"> {{$order->status}}</span>
                                                                                    @elseif($order->status == 'declined')
                                                                                    <span class="label label-danger" style="border-radius: 20px;"> {{$order->status}}</span>
                                                                                    @else
                                                                                    <span class="label label-primary" style="border-radius: 20px;"> {{$order->status}}</span>
                                                                                    @endif
                                                                                </td>
                                                                                </tr>
                                                                            @endforeach
                                                                                </tbody>
                                                                            </table>
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
                    <!-- Ending of Dashboard area --> 

                    
                </div>
            </div>
        </div>


      
    </div>
@endsection

