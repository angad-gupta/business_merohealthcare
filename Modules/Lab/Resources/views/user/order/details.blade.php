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
                                                    <h2>Lab Order Details <a href="{{ route('vendor-lab-order-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> <a href="{{ route('vendor-lab-order-invoice',$order->id) }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-file"></i> Invoice</a></h2>
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
                                                    {{-- @if($order->payment_status == "paid") --}}
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
                                                                    <th width="45%">Customer ID</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->user_id}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Phone</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_phone}}</td>
                                                                </tr>
                                                                {{-- 
                                                                <tr>
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
                                                                    <th width="45%">DOB</th>
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
                                                                    <td width="45%">{{$order->customer_address}} 
                                                                        @if($order->latlong)
                                                                            <a href="javascript:;" title="View in Map" data-toggle="modal" data-target="#billingLocationModal" style="font-size: 20px;"><i class="fa fa-map-marker"></i></a>
                                                                        @endif
                                                                    </td>
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
                                                    <th>Test Cost</th>
                                                    <th>Report</th>
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
                                                        <td>{{ $order->currency_sign}} {{ round($product->test_price * $order->currency_value , 2) }}</td>
                                                        
                                                        <td>
                                                            @if($product->report_file)
                                                                <a href="{{ route('vendor-lab-order-report',[$product->id,$product->report_file]) }}" target="_blank">{{ $product->report_file }}</a>
                                                                <button data-href="{{ route('vendor-lab-order-removefile',$product->id) }}" data-toggle="modal" data-target="#confirm-delete" id='deleteFile{{ $product->id }}' type="button" class="btn btn-sm" title="Remove File" style="background-color: Transparent;border: none;outline:none;color: #DA4453"><i class="fa fa-times"></i></button>
                                                            @else
                                                                <form action="{{ route('vendor-lab-order-uploadfile',$product->id) }}" method="POST" enctype="multipart/form-data" style="display:inline">
                                                                    {{ csrf_field() }}
                                                                    <input type="file" name="file" onchange="this.form.submit()" required/>

                                                                </form>
                                                            @endif
                                                        </td>

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

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Report?</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Do you want to proceed?</p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <form action="" class="btn-ok" method="POST" style="margin-left:5px;display:inline">
                        {{ csrf_field() }}
                        <button  type="submit" class="btn btn-danger" >Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal vendor" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ti-close"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">Send Email</h4>
                </div>
                <form id="emailreply">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group" style="display: none;">
                        <input type="email" class="form-control" id="eml" name="to" placeholder="Email"  value="" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Customer ID:</label>
                    <input type="name" class="form-control" name="to" placeholder="user id"  value="{{$order->user_id}}" readonly="" hidden>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" id="subj" class="form-control" placeholder="Subject" required="">
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="msg" class="form-control" rows="5" placeholder="Message *" required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" id="emlsub" class="btn btn-default email-btn">Send</button>
                </div>
                </form>
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
    <script type="text/javascript">
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('action', $(e.relatedTarget).data('href'));
        });
        $(document).on("click", ".email" , function(){
            var email = $(this).parent().find('input[type=hidden]').val();
            $("#eml").val(email);
            $(".modal-backdrop, .modal.vendor").css('background-color','rgba(0,0,0,0)');
        });

        $(document).on("submit", "#emailreply" , function(){
            var token = $(this).find('input[name=_token]').val();
            var subject = $(this).find('input[name=subject]').val();
            var message =  $(this).find('textarea[name=message]').val();
            var to = $(this).find('input[name=to]').val();
            $('#eml').prop('disabled', true);
            $('#subj').prop('disabled', true);
            $('#msg').prop('disabled', true);
            $('#emlsub').prop('disabled', true);
            $.ajax({
                type: 'post',
                url: "{{URL::to('/admin/order/email')}}",
                data: {
                    '_token': token,
                    'subject'   : subject,
                    'message'  : message,
                    'to'   : to
                    },
                success: function( data) {
                    $('#eml').prop('disabled', false);
                    $('#subj').prop('disabled', false);
                    $('#msg').prop('disabled', false);
                    $('#subj').val('');
                    $('#msg').val('');
                    $('#emlsub').prop('disabled', false);
                    if(data == 0)
                    $.notify("Oops Something went Wrong !!","error");
                    else
                    $.notify("Message Sent !!","success");
                    $('.ti-close').click();
                },
                error: function(){
                    $.notify("Oops Something went Wrong !!","error");
                    $('#eml').prop('disabled', false);
                    $('#subj').prop('disabled', false);
                    $('#msg').prop('disabled', false);
                    $('#emlsub').prop('disabled', false);
                }

            });          
            return false;
        });
    </script>
@endsection