@extends('layouts.email')

@section('body')
        
    <p style="font-size: 14px; font-weight: 500; line-height: 24px; color: #333333;">
        Hello {{ $order->customer_name }},
    </p>
    <p>Your lab order #<b>{{ $order->order_number }}</b> is confirmed. The concerned laboratory customer representative will call you shortly for further processing.</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
    <tr> 
        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
            <h2 style="font-size: 25px; font-weight: 500; line-height: 36px; color: #55555; margin: 0;"> Thank You For Your Order! </h2> 
        </td>
    </tr>
        <tr>
            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                
                <p style="text-align:center;font-size: 12px;margin-bottom: 0px;margin-top: 0px;color: #2385aa;text-transform:uppercase;">Order Number: {{ $order->order_number }}</p>
                <p style="text-align:center;font-size: 12px;margin-bottom: 0px;margin-top: 0px;color: #2385aa;">Order Date: {{ date('d-M-Y',strtotime($order->created_at)) }}</p>
            </td>
        </tr>
        <tr>
            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> 
                <p style="font-size: 12px;margin-bottom: 0px;margin-top: 0px;">
                    <span style="font-weight:800">{{ $order->customer_name }}</span><br>
                    <span>{{ $order->customer_email }}</span><br>
                    {{-- <span>{{ $order->customer_address }}</span><br> --}}
                    <span>{{ $order->customer_phone }}</span>
                    
                </p>
            </td>
        </tr>
        <tr>
            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> 
                <p style="font-size: 12px;margin-bottom: 0px;margin-top: 0px;">
                    @php
                        $patient = json_decode($order->customer_details);
                        
                    @endphp
                    <span style="font-weight:800">Patient Details</span><br>
                    <span>Name: {{$patient->name}}</span><br>
                    {{-- <span>Age: {{$patient->age ? $patient->age: $patient->dob}}</span><br> --}}
                    <span>Gender: {{$patient->gender}}</span><br>
                    {{-- <span>Address: {{$patient->service_address.", ".$patient->service_city}}</span><br> --}}
                </p>
            </td>
        </tr>
    </table>
    @php
        $items = $order->items;
    @endphp
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
        <tr style="padding-top: 20px;">
            <td><h4 style="margin-bottom:5px">Invoice</h4></td>
        </tr>
        <tr>
            <td align="left" >
                <table class="table" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%" style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">#</th>
                            <th style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Item &amp; Description</th>
                            <th width="20%" style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $subtotal = 0;
                        @endphp
                        @foreach ($items as $product)
                            
                            <tr>
                                <th width="5%" align="center">{{ $i++ }}</th>
                                <td align="center">
                                    {{ $product->test_name }}</a>
                                </td>
                                <td width="20%" align="center">{{ $order->currency_sign }}{{ round($product->test_price * $order->currency_value,2) }}</td>
                            </tr>
                            @php
                                $subtotal += $product->test_price;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left" style="padding-top: 20px;">
                
                <table class="table" cellspacing="0" cellpadding="0" border="0" width="100%">
                    
                    <tr>
                        <td width="40%"></td>
                        <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            Sub Total                       
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            {{ $order->currency_sign }}{{ round($subtotal * $order->currency_value , 2) }}
                        </td>
                    </tr> 

                    @if($order->discount > 0)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Payment Gateway Discount ({{ $order->method }})                   
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                {{ $order->currency_sign }} {{ $order->discount * $order->currency_value }}
                            </td>
                        </tr>
                    @endif

                    @if($order->service_charge != 0)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Service Charge                 
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                {{ $order->currency_sign }}{{ $order->service_charge * $order->currency_value }}
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            Health Tax ({{$gs->lab_vat}}%)                       
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            {{ $order->currency_sign }} {{ round($subtotal * ($gs->lab_vat/100) , 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td width="40%"></td>
                        <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            Total                       
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            {{ $order->currency_sign }}{{ round($order->pay_amount * $order->currency_value , 2) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="padding-top: 20px;">
            <td align="left"><h4 style="margin-bottom:5px">Payment:</h4></td>
        </tr>    
        <tr>
            
            <td>
                <p style="margin: 10px 0;">Payment Method: 
                    {{ $order->method }}
                    @if($order->txnid)
                        <br>TransactionId: {{ $order->txnid }}
                    @endif
                </p>
            </td>
        </tr>

        <p style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">We are coming very soon on <a target="_blank" href="https://www.apple.com/ios/app-store/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5">iOS</a> and <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5" href="https://play.google.com/store/apps?hl=en">Android</a>.</p>
        <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">                              
        Regards,<br>
        MEROHEALTHCARE Team
        </p>
        
    </table>
@endsection
