@extends('layouts.admin')
@section('title','Lab Order Invoice - '.$order->order_number)

@section('content')

<style>
.invoice__table .table>tfoot>tr:last-child>td {
    font-size: 16px;
    border-top: 1px solid #000000;
}
</style>

    <div class="right-side">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Starting of Dashboard area -->
                    <div class="section-padding add-product-1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="add-product-box">
                                    <div class="product__header" style="border-bottom: none;">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Order Invoice <a href="{{ url()->previous()}}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Orders <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Order Invoice</p>
                                                </div>
                                            </div>
                                            @include('includes.notification')
                                        </div>   
                                    </div>
                                    <main>
                                        <div class="invoice-wrap">
                                            <div class="invoice__title">
                                                <div class="row reorder-xs">
                                                    <div class="col-sm-6">
                                                        <div class="invoice__logo text-left">
                                                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Mero Health Care" style="width:175px; height:100px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6" style="text-align:right">
                                                        {{-- @if($order->payment_status == "paid") --}}
                                                            <span class="btn-lg btn-success" style="cursor:default; border-radius:0">Paid</span>
                                                        {{-- @else
                                                            <span class="btn-lg btn-danger" style="cursor:default; border-radius:0">Unpaid</span> 
                                                        @endif --}}
                                                    </div>
                                                </div> 
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="invoice__metaInfo">
                                                        <div class="buyer">
                                                            <p>User Details</p>
                                                            <strong>{{$order->customer_name}}</strong>
                                                            <address>
                                                                {{-- {{$order->customer_address}}<br> --}}
                                                                {{$order->customer_email}}<br>
                                                                {{$order->customer_phone}}<br>
                                                            </address>
                                                        </div>

                                                        <div class="invoce__date" style="font-size:14px !important; ">
                                                            <p><strong style="font-size:14px !important; ">PAN Number</strong></p>
                                                            <strong style="font-size:14px !important; ">Invoice Number</strong>
                                                            <p>Order Date</p>
                                                            <p>Vendor</p>

                                                        </div>

                                                        <div class="invoce__number">
                                                            <p><strong>: 609680496</strong></p>
                                                            <strong>: {{sprintf("%'.08d", $order->id)}}</strong>
                                                            <p>: {{date('d-M-Y',strtotime($order->created_at))}}</p>
                                                            @php
                                                                $vendor = $order->vendor;
                                                            @endphp
                                                            
                                                            : {{ $vendor ? $vendor->name : '-'}}  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    @php
                                                        $patient = json_decode($order->customer_details);
                                                        
                                                    @endphp
                                                    <div class="invoice__metaInfo">
                                                        <div class="buyer">
                                                            <p>Patient Details</p>
                                                            <address>
                                                                <span>Name: {{$patient->name}}</span><br>
                                                                <span>Date of Birth: {{$patient->dob}}</span><br>
                                                                <span>Gender: {{$patient->gender}}</span><br>
                                                                <span>Address: {{ $order->customer_address }}</span><br>
                                                            </address>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="invoice__table">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th width="10%">#</th>
                                                                    <th>Test Name</th>
                                                                    <th>Test Cost</th>                                                                    
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $subtotal = 0;
                                                                        $tax = 0;
                                                                    @endphp 
                                                                    @foreach($items as $product)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $product->test_name }}</td>
                                                                            <td>{{ $order->currency_sign}} {{ round($product->test_price * $order->currency_value , 2) }}</td>
                                                                        </tr>
                                                                        @php
                                                                            $subtotal += $product->test_price;
                                                                        @endphp
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="2">Subtotal</td>
                                                                        <td>{{$order->currency_sign}}{{ round($subtotal * $order->currency_value, 2) }}</td>
                                                                    </tr>
                                                                  

                                                                    @if($order->discount > 0)
                                                                        <tr>
                                                                            <td colspan="2">Payment Gateway Discount ({{ $order->method }})</td>
                                                                            <td>{{$order->currency_sign}}{{ round($order->discount * $order->currency_value, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                
                                                                    @if($order->service_charge != 0)
                                                                        <tr>
                                                                            <td colspan="2">Service Fee</td>
                                                                            <td>{{ $order->currency_sign }} {{ $order->service_charge * $order->currency_value }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            Health Tax ({{$gs->lab_vat}}%)                       
                                                                        </td>
                                                                        <td>
                                                                            {{ $order->currency_sign }} {{ round($subtotal * ($gs->lab_vat/100) , 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td colspan="1"></td>
                                                                        <td>Total</td>
                                                                        <td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
                                                                    </tr>
                                                                </tfoot>         
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="invoice__orderDetails">
                                                        <p><strong>Order Details</strong></p>
                                                        
                                                        <p>Payment Method: {{$order->method}}</p>
                                                        @if($order->method != "Cash On Delivery")
                                                                    
                                                            <p>{{$order->method}} Transaction ID: {{$order->txnid}}</p>                        
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    <a class="btn  add-newProduct-btn print" href="{{route('lab-order-print',$order->id)}}" target="_blank"><i class="fa fa-print"></i> Print Invoice</a>
                                                </div>
                                            </div>
                                        </div>
                                    </main>

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
