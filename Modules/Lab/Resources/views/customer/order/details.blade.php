@extends('layouts.user')
@section('title','Lab Order Details - '.$order->order_number)
        
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
                                    <div class="product__header" style="border-bottom: none;">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Lab Order Details <a href="{{ route('user-lab-order-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> <a href="{{ route('user-lab-order-invoice',$order->id) }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-file"></i> Invoice</a></h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i>Lab Orders <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Order Details</p>
                                                </div>
                                            </div>
                                            @include('includes.user-notification')
                                        </div>   
                                    </div>
                                    <main>

                                        @include('includes.form-success')

                                        <div class="order-table-wrap">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="tr-head">
                                                                    <th class="order-th" width="45%">Order ID</th>
                                                                    <th width="10%">:</th>
                                                                    <th class="order-th" width="45%">{{$order->order_number}}</th>
                                                                </tr>
                                                                <tr class="tr-head">
                                                                    <th width="45%">Provided By</th>
                                                                    <th width="10%">:</th>
                                                                    <th width="45%">
                                                                        @php
                                                                            $vendor = $order->vendor;
                                                                        @endphp
                                                                        {{ $vendor ? $vendor->name : '-'}} 
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Total Tests</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->totalQty}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Total Cost</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->currency_sign}} {{ round($order->pay_amount * $order->currency_value , 2) }}</td>
                                                                </tr>
                                                                {{-- <tr>
                                                                    <th width="45%">Test Timing</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->timing }}</td>
                                                                </tr> --}}
                                                                <tr>
                                                                    <th width="45%">Ordered Date</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($order->created_at))}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Payment Method</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->method}}</td>
                                                                </tr>

                                                                @if($order->method != "Cash On Delivery")
                                                                    
                                                                    <tr>
                                                                        <th width="45%">{{$order->method}} Transaction ID</th>
                                                                        <th width="10%">:</th>
                                                                        <td width="45%">{{$order->txnid}}</td>
                                                                    </tr>                         
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6" style="text-align:right">
                                                    {{-- @if($order->payment_status == "completed") --}}
                                                        <span class="btn-lg btn-success" style="cursor:default; border-radius:0">Paid</span>
                                                    {{-- @else
                                                        <span class="btn-lg btn-danger" style="cursor:default; border-radius:0">Unpaid</span> 
                                                    @endif --}}
                                                </div>
                                            </div>
        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="tr-head">
                                                                    <th class="order-th" width="45%">User Details</th>
                                                                    <th width="10%"></th>
                                                                    <th width="45%"></th>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Name</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Email</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_email}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Phone</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_phone}}</td>
                                                                </tr>

                                                                {{-- <tr>
                                                                    <th width="45%">Address</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_address}}</td>
                                                                </tr> --}}
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        @php
                                                            $patient = json_decode($order->customer_details);
                                                            
                                                        @endphp
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="tr-head">
                                                                    <th class="order-th" width="45%">Patient Details</th>
                                                                    <th width="10%"></th>
                                                                    <th width="45%"></th>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Name</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$patient->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Date of Birth</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$patient->dob}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Gender</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$patient->gender}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Address</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_address}}</td>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <br>
                                        <table id="example" class="table">
                                            <h4 class="text-center">Tests Booked</h4><hr>
                                            <thead>
                                                <tr>
                                                    <th width="10%">#</th>
                                                    <th>Test Name</th>
                                                    <th>Report</th>
                                                    <th>Test Cost</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                @endphp
                                                @foreach($items as $product)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $product->test_name }}</td>
                                                        
                                                        <td>
                                                            @if($product->report_file)
                                                                <a class="btn btn-primary" href="{{ route('user-lab-order-report',[$product->id,$product->report_file]) }}" target="_blank" title="View {{ $product->report_file }}" style="border-radius: 30px;padding: 0px 10px;"><i class="icon-eye"></i> View Report </a>
                                                                <a class="btn btn-success" href="{{ route('user-lab-order-report',[$product->id,$product->report_file]) }}" target="_blank" title="Download {{ $product->report_file }}" download style="border-radius: 30px;padding: 0px 10px;"><i class="fa fa-download"></i> </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ $order->currency_sign}} {{ round($product->test_price * $order->currency_value , 2) }}</td>

                                                    </tr>
                                                    @php
                                                        $subtotal += $product->test_price;
                                                    @endphp
                                                @endforeach


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td align="right" colspan="3" style="font-weight:800;">
                                                        Sub Total                       
                                                    </td>
                                                    <td align="left" style="font-weight:800;">
                                                        {{ $order->currency_sign }} {{ round($subtotal * $order->currency_value , 2) }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" colspan="3" style="font-weight:800;border-top:0">
                                                        Health Tax({{$gs->lab_vat}}%)                       
                                                    </td>
                                                    <td align="left" style="font-weight:800;border-top:0">
                                                        {{ $order->currency_sign }} {{ round($subtotal * ($gs->lab_vat/100) , 2) }}
                                                    </td>
                                                </tr>
                                                

                                                @if($order->discount > 0)
                                                    <tr>
                                                        
                                                        
                                                        <td align="right" colspan="3" style="font-weight:800;border-top:0">
                                                            Payment Gateway Discount ({{ $order->method }})                  
                                                        </td>
                                                        <td align="left" style="font-weight:800;border-top:0">
                                                            {{ $order->currency_sign }} {{ $order->discount * $order->currency_value }}
                                                        </td>
                                                    </tr>
                                                @endif
                            
                                                @if($order->service_charge != 0)
                                                    <tr>
                                                        
                                                        
                                                        <td align="right" colspan="3" style="font-weight:800;border-top:0">
                                                            Service Fee                  
                                                        </td>
                                                        <td align="left" style="font-weight:800;border-top:0">
                                                            {{ $order->currency_sign }} {{ $order->service_charge * $order->currency_value }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    
                                                    
                                                    <td align="right" colspan="3" style="font-weight:800;border-top:0">
                                                        Total                       
                                                    </td>
                                                    <td align="left" style="font-weight:800;border-top:0">
                                                        {{ $order->currency_sign }} {{ round($order->pay_amount * $order->currency_value , 2) }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </main>
                                    <hr>
                                    
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

@section('scripts')

    <script type="text/javascript">
        $('#example').dataTable( {
            "ordering": false,
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : false,
            'responsive'  : true
        } );
    </script>
    
@endsection