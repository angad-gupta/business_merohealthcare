@extends('layouts.email')

@section('body')

    <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">
        Hello {{ $order->customer_name }},
    </p>
    <p>Your order #<b>{{ $order->order_number }}</b> is confirmed and will be soon on its way. Your expected date of delivery will be within 3 working days* from the date of order.</p>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
        <tr> 
            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                <h2 style="font-size: 25px; font-weight: 500; line-height: 36px; color: #55555; margin: 0;"> Thank You For Your Order! </h2> 
            </td>
        </tr>
        <tr>
            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                
                <p style="text-align:center;font-size: 14px;margin-bottom: 0px;margin-top: 0px;color: #2385aa;text-transform:uppercase;">Order Number: {{ $order->order_number }}</p>
                <p style="text-align:center;font-size: 14px;margin-bottom: 0px;margin-top: 0px;color: #2385aa;">Order Date: {{ date('d-M-Y',strtotime($order->created_at)) }}</p>
            </td>
        </tr>
        <tr>
            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> 
                <p style="font-size: 13px;margin-bottom: 0px;margin-top: 0px;">
                    <span style="font-weight:600">{{ $order->customer_name }}</span><br>
                    <span>{{ $order->customer_email }}</span><br>
                    <span>{{ $order->customer_phone }}</span><br>
                    <span>{{ $order->customer_address }}</span><br>
                    {{-- <span>{{ $order->customer_city }}-{{ $order->customer_zip }}</span><br> --}}
                    {{-- @if($billing->company)
                        <br><span>{{ $billing->company }}</span>
                    @endif --}}
                    
                </p>
            </td>
        </tr>
       
    </table>
    @php
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
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
                            <th width="5%" style="border-bottom: 1px solid #e3ebf3;border-top: 1px solid #e3ebf3;">#</th>
                            <th width="40%" style="border-bottom: 1px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Item &amp; Description</th>
                            <th width="15%" style="border-bottom: 1px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Variant</th>
                            <th width="15%" style="border-bottom: 1px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Rate</th>
                            <th width="5%" style="border-bottom: 1px solid #e3ebf3;border-top: 1px solid #e3ebf3;">QTY</th>
                            <th width="20%" style="border-bottom: 1px solid #e3ebf3;border-top: 1px solid #e3ebf3;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $subtotal = 0;
                            $discountedsubtotal = 0;
                            $vat_sum = 0;
                            
                        @endphp
                        @foreach ($cart->items as $product)
                            @php  
                            $price = $product['item']['pprice'] ? : $product['item']['cprice'];                        
                            $vat = App\Product::findOrFail($product['item']['id']);
                            $prod = App\Product::findORFail($product['item']['id']);
                            @endphp
                            <tr>
                                <th width="5%" align="center">{{ $i++ }}</th>
                                <td width="40%" align="center">
                                    <a target="_blank" href="{{ route('front.product',['id1' => $product['item']['id'], str_slug($product['item']['name'],'-')])}}">{{ $product['item']['name'] }}</a>
                                    @if($vat->vat_status == 1)
                                        <span style="font-style: italic;">*</span>
                                    @endif
                                </td>

                                <td width="15%" align="center">
                                    {{$vat->sub_title}}
                                </td>

                                <td width="15%" align="center">
                         
                                    {{$order->currency_sign}}{{ round($price * $order->currency_value , 2) }}
                                  
                                </td>
                                <td width="5%" align="center">
                                    {{ $product['qty'] }}
                                    @if(App\Product::findOrFail($product['item']['id'])->prices()->where('min_qty','<=',$product['qty'])->exists())
                                    @php
                                    $p = App\Product::findOrFail($product['item']['id'])->prices()->where('min_qty','<=',$product['qty'])->orderBy('min_qty','desc')->first();
                                    $quotient = (int)($product['qty'] / $p->min_qty);
                                    @endphp
                                    @if(($quotient * $p->product_free_quantity) != 0)
                                        <span style="width:70px;">
                                            + {{$quotient * $p->product_free_quantity}} {{$p->product_category}} Free             
                                        </span> 
                                    @endif
                                    @endif
                                    <small style="display: block; color: #777;">({{$prod->product_quantity}})</small>
                                </td>
                                <td width="20%" align="center">
                                   
                                    
                                        @if($gs->sign == 0)
                                        {{$order->currency_sign}}{{ round($price * $product['qty'] * $order->currency_value , 2) }}
                                        @else
                                            {{ round($price * $product['qty'] * $order->currency_value , 2) }}{{$order->currency_sign}}
                                        @endif
                                  
                                </td>
                            </tr>
                            @php
                                $subtotal += $product['qty'] * $price;
                                $discountedsubtotal += $product['price'];
                            @endphp
                        @php
                        if($order->coupon_code != null){
                            $coupon_dis = App\Coupon::where('code',$order->coupon_code)->first();
                        }
                        // dd($product);
                        if($vat->vat_status == 1){
                            if($order->coupon_code){
                                //percentage discount
                                if($coupon_dis->type == 0){
                                  $vat_price = ($product['price'] * (1 - ($coupon_dis->price / 100) )) * $curr->value;
                                  $vat_sum = $vat_sum + $vat_price;
                                }
                                //price discount
                                // elseif($coupon_dis->type == 1){
                                //   $vat_price = $product['price'] * $curr->value;
                                //   $vat_sum = $vat_sum + $vat_price;
                                // }
                                //  dd($vat_sum);
                            }
                            else{
                                $vat_price = $product['price'] * $curr->value;
                                $vat_sum = $vat_sum + $vat_price;
                                // dd($vat_sum);
                            }
                        }
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
                    @if($subtotal > $discountedsubtotal)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Discount                       
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                - {{ $order->currency_sign }}{{ round(($subtotal - $discountedsubtotal) * $order->currency_value , 2) }}
                            </td>
                        </tr>
                    @endif
                    
                    @if($order->coupon_code != null)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Discount Coupon ({{$order->coupon_code}})                   
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                - {{ $order->currency_sign }}{{ $order->coupon_discount * $order->currency_value }}
                            </td>
                        </tr>
                    @endif

                    @if($order->discount > 0)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Payment Gateway Discount ({{ $order->method }})                  
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                {{ $order->currency_sign }}{{ $order->discount * $order->currency_value }}
                            </td>
                        </tr>
                    @endif

                    @if($order->shipping_cost != 0)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Delivery Fee                  
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                {{ $order->currency_sign }}{{ $order->shipping_cost * $order->currency_value }}
                            </td>
                        </tr>
                    @endif

                    @if($order->tax != 0)
                        <tr>
                            <td width="40%"></td>
                            <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                Tax               
                            </td>
                            <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                {{ $order->currency_sign }}{{ $order->tax * $order->currency_value }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td width="40%"></td>
                        <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            Grand Total                       
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            {{ $order->currency_sign }}{{ round($order->pay_amount * $order->currency_value , 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="40%"></td>
                        <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                               
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                           
                        </td>
                    </tr>

                       <tr style="color:red;">
                        <td width="40%"></td>
                        <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            Taxable Amount :                   
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            &nbsp;&nbsp;{{$curr->sign}}<span id="">{{round((($vat_sum)/1.13) * $curr->value,2)}}</span>
                        </td>
                    </tr>

                  

                    @if($gs->vat != 0)
                    <tr style="color:red;">
                        <td width="40%"></td>
                        <td width="40%" align="right" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            VAT({{$gs->vat}}%):                  
                        </td>
                        <td width="20%" align="left" style="font-weight:800;border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                            &nbsp;&nbsp;{{$curr->sign}}<span id="">{{round((($vat_sum)/1.13) * 0.13 * $curr->value,2)}}</span>
                        </td>

                    </tr>
                    @endif
                </table>
                <p style="font-style:italic; color:red;font-size:13px;">* All price subject to inclusive of VAT</p>
            </td>
        </tr>
        
        <tr style="padding-top: 20px;">
            <td align="left"><h4 style="margin-bottom:5px">Delivery & Payment:</h4></td>
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
        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">We are coming very soon on <a target="_blank" href="https://www.apple.com/ios/app-store/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5">iOS</a> and <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5" href="https://play.google.com/store/apps?hl=en">Android</a>.</p>
        <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">                              
            Regards,<br>
            MEROHEALTHCARE Team
        </p>
        
    </table>
@endsection
