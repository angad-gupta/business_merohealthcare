@extends('layouts.user')
@section('title','Prescription Invoice - '.$prescription->id)
        
@section('content')
    <style>
        .text-bold-800{
            font-weight: 800;
        }
    </style>
    @php
        $items = json_decode($invoice->items,true);
        $total = 0;
    @endphp
    <div class="right-side">
        <div class="container-fluid">
            <!-- Starting of Dashboard area -->
            <div class="section-padding add-product-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="add-product-box">
                            <div class="product__header">
                                <div class="row reorder-xs">
                                    <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                        <div class="product-header-title">
                                            <h2>Prescription Invoice
                                                <a href="{{route('user-prescriptions.family-filter',$prescription->family_id)}}"  class="btn add-newProduct-btn" style="padding: 5px 12px;"  class="print-order-btn">
                                                    <i class="fa fa-arrow-left"></i> Back
                                                </a> 
                                            </h2>
                                            <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Prescriptions <i class="fa fa-angle-right" style="margin: 0 2px;"></i>Invoice</p>
                                        </div>
                                    </div>
                                        @include('includes.user-notification')
                                </div>   
                            </div>

                            <div class="container text-center">
                                <img class="text-center" src="{{url('assets/images/logo.jpg')}}" style="height:100px; width:175px; "/>
                                
                                </div>

                                
                            <main style="padding: 15px;">
                                
                                <div class="order-table-wrap">
                                    <h4>PAN : 609680496</h4>
                                    <div class="row">
                                        
                                        <div class="col-lg-6">
                                            
                                            <div class="table-responsive">
                                                
                                                <table class="table">
                                                    <tbody><tr class="tr-head">
                                                        <th class="order-th" width="45%">Order ID</th>
                                                        <th width="10%">:</th>
                                                        <th class="order-th" width="45%">{{$prescription->id}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="45%">Total Product</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">{{ count($items) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="45%">Total Cost</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">{{ $invoice->currency_sign }} {{ round($invoice->amount * $invoice->currency_value , 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="45%">Ordered Date</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">{{date('d-M-Y H:i:s a',strtotime($prescription->created_at))}}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th width="45%">Prescription File</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%"><a href="{{ route('user-prescriptions.file',[$prescription->id,$prescription->file]) }}" target="_blank">{{ $prescription->file }}</a></td>
                                                    </tr> --}}
                                                    <tr>
                                                        <th width="45%">Prescription File</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">
                                                            @foreach($prescription->files as $file)
                                                            <a href="{{ route('user-prescriptions.file',[$prescription->id,$file->file,$file->id]) }}" target="_blank" title="{{ $file->file }}"><i class="fa fa-picture-o" aria-hidden="true" style="font-size:25px;"></i></a>
                                                              <br/>
                                                                @endforeach
                                                            {{-- <a href="{{ route('user-prescriptions.file',[$prescription->id,$prescription->file]) }}" target="_blank">{{ $prescription->file }}</a> --}}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody><tr class="tr-head">
                                                        <th class="order-th" width="45%">Billing Address</th>
                                                        <th width="10%"></th>
                                                        <th width="45%"></th>
                                                    </tr>
                                                    <tr>
                                                        <th width="45%">Name</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">{{$prescription->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="45%">Email</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">{{$prescription->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="45%">Phone</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">{{$prescription->phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="45%">Address</th>
                                                        <th width="10%">:</th>
                                                        <td width="45%">{{$prescription->location}}</td>
                                                    </tr>
                                                    @if($prescription->additional_info)
                                                        <tr>
                                                            <th width="45%">Additional Note</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$prescription->additional_info}}</td>
                                                        </tr>
                                                    @endif
                        
                                                </tbody></table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                        
                                <br>
                                <table id="example" class="table">
                                    <h4 class="text-center">Products Ordered</h4><hr>
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Product Name</th>
                                            <th>Batch No.(s)</th>
                                            <th>Expiry Date(s)</th>
                                            <th width="8%">Quantity</th>
                                            <th width="10%">Product Price</th>
                                            <th width="10%">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td scope="row">
                                                    @if($item['id'])
                                                        <a href="{{route('front.product',['id1' => $item['id'], str_slug($item['name'],'-')])}}" target="_blank">{{ $item['name'] }}</a>
                                                    @else
                                                        {{ $item['name'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($item['batch_nos']))
                                                        @foreach (explode(",",$item['batch_nos']) as $i)
                                                            {{ $i }}<br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($item['batch_nos']))

                                                        @foreach (explode(",",$item['exp_dates']) as $i)
                                                            {{ $i }}<br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item['qty'] }}
                                                </td>
                                                <td>{{$invoice->currency_sign}} {{ round($item['price'] * $invoice->currency_value , 2) }}</td>
                                                <td>{{$invoice->currency_sign}} {{ round($item['qty'] * $item['price'] * $invoice->currency_value , 2)}}</td>
                                            </tr>
                                            @php
                                                $total += $item['qty'] * $item['price']; 
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="5%"></td>
                                            <td></td>
                                            <td width="10%"></td>

                                            <td style="width: 20%;text-align: right;" class="text-bold-800">Sub Total</td>
                                            <td width="20%"><span id="subtotal">{{$invoice->currency_sign}} {{ round($total * $invoice->currency_value , 2)}}</span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td width="5%" style="border-top: 0"></td>
                                            <td style="border-top: 0"></td>
                                            <td width="10%" style="border-top: 0"></td>

                                            <td style="width: 20%;text-align: right;border-top: 0" class="text-bold-800">Delivery Fee</td>
                                            <td width="20%" style="border-top: 0" class=" text-xs-right"> {{$invoice->currency_sign}} {{ round($invoice->shipping_cost * $invoice->currency_value , 2)}}</td>
                                        </tr>
    
                                        <tr>
                                            <td width="5%" style="border-top: 0"></td> 
                                            <td style="border-top: 0"></td>             
                                            <td width="10%" style="border-top: 0"></td>

                                            <td style="width: 20%;text-align: right;border-top: 0" class="text-bold-800">Total</td>
                                            <td width="20%" style="border-top: 0" class="text-bold-800 text-xs-right"><span id="totalAmount">{{$invoice->currency_sign}} {{ round($invoice->amount * $invoice->currency_value , 2)}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>

                                @if($invoice->note)
                                    <h5>Note:</h5>

                                    {{ $invoice->note }}
                                @endif
                            </main>
                
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ending of Dashboard area --> 
        </div>
    </div>
@endsection
