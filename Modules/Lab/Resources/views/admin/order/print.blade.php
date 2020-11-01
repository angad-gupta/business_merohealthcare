<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$seo->meta_keys}}">

    <title>{{$gs->title}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('assets/print/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/print/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/print/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/print/css/style.css')}}">
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
          <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}"> 
    <style type="text/css">
      @page { size: auto;  margin: 0mm; }
      @page {
        size: A4;
        margin: 0;
      }
      @media print {
        html, body {
          width: 210mm;
          height: 287mm;
        }

        html {
            overflow: scroll;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar {
            width: 0px;  /* remove scrollbar space */
            background: transparent;  /* optional: just make scrollbar invisible */
        }
      }
    </style>
    <style>
        .invoice__table .table>tfoot>tr:last-child>td {
            font-size: 16px;
            border-top: 1px solid #000000;
        }
        </style>
  </head>
  <body onload="window.print();">
    <div class="invoice-wrap">
        <div class="invoice__title">
            <div class="row reorder-xs">
                <div class="col-sm-6">
                    <div class="invoice__logo text-center">
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
                    <div class="buyer" style="width: 60%;">
                        <p>User Details</p>
                        <strong>{{$order->customer_name}}</strong>
                        <address>
                            {{-- {{$order->customer_address}}<br> --}}
                            {{$order->customer_email}}<br>
                            {{$order->customer_phone}}<br>
                        </address>
                    </div>

                    <div class="invoce__date"  style="width: 20%;">
                        <p><strong style="font-size:14px !important; ">PAN Number</strong></p>
                        <strong style="font-size:14px !important; ">Invoice ID</strong>
                        <p>Order Date</p>
                        <p>Vendor</p>
                    </div>

                    <div class="invoce__number"  style="width: 20%;">
                        <p><strong>: 609680496</strong></p>
                        <strong>: {{sprintf("%'.08d", $order->id)}}</strong>
                        <p>: {{date('d-M-Y',strtotime($order->created_at))}}</p>
                        @php
                            $vendor = $order->vendor;
                        @endphp
                        
                       : {{ $vendor ? $order->vendor->name : '-'}} 
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


    </div>

    <script type="text/javascript">
      setTimeout(function () {
            window.close();
          }, 500);
    </script>
  </body>
</html>
