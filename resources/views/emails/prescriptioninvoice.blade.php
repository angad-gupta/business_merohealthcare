@extends('layouts.email')

@section('body')

    <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">
        Hello {{ $order->name }},
    </p>
    <p>Your order #{{ $order->id }} is confirmed and will be soon on its way. </p>
    
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
        <tr> 
            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                <h2 style="font-size: 25px; font-weight: 500; line-height: 36px; color: #55555; margin: 0;"> Thank You For Your Order! </h2> 
            </td>
        </tr>
        <tr>
            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                
                <p style="text-align:center;font-size: 12px;margin-bottom: 0px;margin-top: 0px;color: #2385aa;text-transform:uppercase;">Order Number: {{ $order->id }}</p>
                <p style="text-align:center;font-size: 12px;margin-bottom: 0px;margin-top: 0px;color: #2385aa;">Order Date: {{ date('d-M-Y',strtotime($order->created_at)) }}</p>
            </td>
        </tr>
        <tr>
            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> 
                <p style="font-size: 12px;margin-bottom: 0px;margin-top: 0px;">
                    <span style="font-weight:600">{{ $order->name }}</span><br>
                    <span>{{ $order->email }}</span><br>
                    <span>{{ $order->phone }}</span><br>
                    <span>{{ $order->location }}</span><br>
                    
                </p>
            </td>
        </tr>
    </table>
    @php
        $items = json_decode($invoice->items,true);
    @endphp
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
        <tr style="padding-top: 20px;">
            <td><h4 style="margin-bottom:5px">Prescription Invoice</h4></td>
        </tr>
        <tr>
            <td align="left" >
                <table class="table" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%" style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">#</th>
                            <th width="30%" style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Item &amp; Description</th>
                            <th style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Batch No.(s)</th>
                            <th style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Expiry Date(s)</th>
                            <th width="10%" style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Rate</th>
                            <th width="8%" style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">QTY</th>
                            <th width="10%" style="border-bottom: 2px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $subtotal = 0;
                        @endphp
                        @foreach ($items as $product)
                            
                            <tr>
                                <th align="center">{{ $i++ }}</th>
                                <td align="center">
                                    
                                    {{ $product['name'] }}
                                </td>
                                <td>
                                    @if (isset($product['batch_nos']))
                                        @foreach (explode(",",$product['batch_nos']) as $item)
                                            {{ $item }}<br>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if (isset($product['batch_nos']))

                                        @foreach (explode(",",$product['exp_dates']) as $item)
                                            {{ $item }}<br>
                                        @endforeach
                                    @endif
                                </td>
                                <td align="center">{{ $invoice->currency_sign }}{{ round($product['price'] * $invoice->currency_value,2) }}</td>
                                <td align="center">{{ $product['qty'] }}</td>
                                <td align="center">{{ $invoice->currency_sign }}{{ round($product['price'] * $product['qty'] * $invoice->currency_value,2) }}</td>
                            </tr>
                            @php
                                $subtotal += $product['price'] * $product['qty'];
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
                            {{ $invoice->currency_sign }}{{ round($subtotal * $invoice->currency_value , 2) }}
                        </td>
                    </tr>

                    @if($invoice->shipping_cost != 0)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Delivery Fee                  
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                {{ $invoice->currency_sign }}{{ $invoice->shipping_cost * $invoice->currency_value }}
                            </td>
                        </tr>
                    @endif

                    @if($invoice->tax != 0)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Tax               
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                {{ $invoice->currency_sign }}{{ $invoice->tax * $invoice->currency_value }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td width="40%"></td>
                        <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            Total                       
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            {{ $invoice->currency_sign }}{{ round($invoice->amount * $invoice->currency_value , 2) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">We are coming very soon on <a target="_blank" href="https://www.apple.com/ios/app-store/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5">iOS</a> and <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5" href="https://play.google.com/store/apps?hl=en">Android</a>.</p>
        <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">                              
            Regards,<br>
            MEROHEALTHCARE Team
        </p>
        
    </table>
@endsection
