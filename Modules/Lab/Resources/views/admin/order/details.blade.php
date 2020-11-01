@extends('layouts.admin')
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
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Lab Order Details <a href="{{ route('lab-order-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> <a href="{{ route('lab-order-invoice',$order->id) }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-file"></i> Invoice</a></h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i>Lab Orders <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Order Details</p>
                                                </div>
                                            </div>
                                            @include('includes.notification')
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
                                                                    <th width="45%">Vendor</th>
                                                                    <th width="10%">:</th>
                                                                    <th width="45%">
                                                                        @php
                                                                            $vendor = $order->vendor;
                                                                        @endphp
                                                                        @if($vendor)
                                                                            <a href="/admin/vendors/{{$vendor->id }}/show" target="_blank">{{ $vendor->name}}</a>
                                                                        @else
                                                                            {{$order->vendor->name}}
                                                                        @endif
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
                                                    {{-- @if($order->status == "completed") --}}
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
                                                                    <th width="45%">Date Of Birth</th>
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
                                                                    <td width="45%">{{ $order->customer_address }} 
                                                                        @if($order->latlong)
                                                                            <a href="javascript:;" title="View in Map" data-toggle="modal" data-target="#billingLocationModal" style="font-size: 20px;"><i class="fa fa-map-marker"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Note</th>
                                                                    <th width="10%">:</th>
                                                                    @if($order->note)
                                                                    <td width="45%">{{$order->note}}</td>
                                                                    @else
                                                                    <td width="45%" style="color:green;">No Notes Found.</td>
                                                                    @endif
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
                                                        <td><a href="{{ route('lab-order-report',[$product->id,$product->report_file]) }}" target="_blank">{{ $product->report_file ? : '-' }}</a></td>
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
                                                        Health Tax ({{$gs->lab_vat}}%)                       
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
                                    <div class="text-center">
                                        <input type="hidden" value="{{$order->customer_email}}">
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#emailModal"class="btn btn-success email"><i class="fa fa-send"></i> Send Email</a>
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

    <div class="modal fade" id="billingLocationModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="margin-top: 0;">
            <div class="modal-header text-center" style="border-bottom: none;padding-bottom: 0">
                <h4><strong>Billing Location</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
    
            <div class="modal-body text-center">
                {{-- <iframe src="https://www.google.com/maps?ll=27.6698788,85.3288006&t=&z=17&ie=UTF8&iwloc=&output=embed" 
                 height="450" frameborder="0" style="width: 100%;" allowfullscreen=""></iframe> --}}
                 <div id="map" style="height: 500px"></div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-neutral" data-dismiss="modal" aria-label="Close">OK</button>
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

    <script>

        function initMap() {
            var myLatLng = JSON.parse('<?php echo $order->latlong ?>');
          
  
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: myLatLng
            });
    
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '{{ $order->customer_address }}'
            });
        }
    </script>

    @if($order->latlong)
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&callback=initMap">
        </script>
    @endif
    
@endsection