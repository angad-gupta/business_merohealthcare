@extends('layouts.admin')

@section('content')


<style>
    .invoice__table .table>tfoot>tr:last-child>td {
        font-size: 16px;
        border-top: 1px solid #000000;
    }

    .invoice__table .table>tfoot>tr>td {
    font-size: 14px;
    font-weight: 700;
    line-height: 10px;
}
</style>
<style>
    .product-btn:last-child {
    margin-bottom: 10px;
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
                                                        <b>Status :</b> 
                                                        @if($order->status == 'completed')
                                                        <span class="btn btn-success" style="border-radius: 5px;"><i class="fa fa-check" aria-hidden="true"></i> {{$order->status}}</span>
                                                        @elseif($order->status == 'pending')
                                                        <span class="btn btn-warning" style="border-radius: 5px;"><i class="fa fa-question" aria-hidden="true"></i> {{$order->status}}</span>
                                                        @elseif($order->status == 'declined')
                                                        <span class="btn btn-danger" style="border-radius: 5px;"><i class="fa fa-close" aria-hidden="true"></i> {{$order->status}}</span>
                                                        @else
                                                        <span class="btn btn-primary" style="border-radius: 5px;"> <i class="fa fa-spinner fa-spin"> </i> {{$order->status}}</span>
                                                        @endif
                                                        @if($order->payment_status == "paid")
                                                            <span class="btn btn-success" style="cursor:default; border-radius:0;border-radius: 5px;" ><i class="fa fa-check" aria-hidden="true"></i> Paid</span>
                                                        @else
                                                            <span class="btn btn-danger" style="cursor:default; border-radius:0;border-radius: 5px;"><i class="fa fa-close" aria-hidden="true"></i> Unpaid</span> 
                                                        @endif
                                                        
                                                    
                                                        @if($order->delivery_received_by)
                                                            <span class="btn btn-success" id="deliveryButton" style="cursor:default; border-radius:0;border-radius: 5px;" ><i class="fa fa-check" aria-hidden="true"></i> Delivery Email Sent</span>
                                                        @else
                                                        <span class="btn btn-warning" id="deliveryButton" style="cursor:default; border-radius:0;border-radius: 5px;" ><i class="fa fa-close" aria-hidden="true"></i> Delivery Email Not Yet Sent</span>
                                                        @endif
                                                    </div>
                                                </div> 
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="invoice__metaInfo">
                                                        <div class="buyer">
                                                            <p>Billing Address</p>
                                                            <strong>{{$order->customer_name}}</strong>
                                                            <address>
                                                                {{$order->customer_address}}<br>
                                                                {{$order->customer_phone}}<br>
                                                                {{$order->customer_country}}<br>
                                                            </address>
                                                        </div>

                                                        
                                                        <div class="invoce__date">
                                                            <p style="font-size:14px; "><strong style="font-size:14px; ">PAN Number</strong></p>
                                                            <strong style="font-size:14px; ">Invoice Number</strong>
                                                            <p>Order Date/Time</p>
                                                            <p>Order ID</p>
                                                        </div>

                                                        <div class="invoce__number">
                                                            <p><strong>609680496</strong></p>
                                                            <strong>{{sprintf("%'.08d", $order->id)}}</strong>
                                                            <p>{{date('d-M-Y H:i:s A',strtotime($order->created_at))}}</p>
                                                            <p>{{$order->order_number}}</p>
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
                                                                    <th>Product</th>
                                                                    <th>Variant</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Line Total</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $subtotal = 0;
                                                                        $discountedsubtotal = 0;
                                                                        $tax = 0;
                                                                        $vat_sum = 0;
                                                                    @endphp                                   
                                                                    @foreach($cart->items as $product)
                                                                    @php
                                                                        $price = $product['item']['pprice'] ? $product['item']['pprice'] : $product['item']['cprice'];
                                                                        $vat = App\Product::findORFail($product['item']['id']);
                                                                        $prod = App\Product::findORFail($product['item']['id']);
                                                                    @endphp
                                                                        <tr>
                                                                            <td><a target="_blank" href="{{route('front.product',['id1' => $product['item']['id'], str_slug($product['item']['name'],'-')])}}">{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}</a>
                                                                                @if($vat->vat_status == 1)
                                                                                *
                                                                                @endif
                                                                                <small style="display: block; color: #777;">{{$prod->company_name}}</small>
                                                                            </td>
                                                                            <td>{{$prod->sub_title}}</td>
                                                                            <td>
                                                                               
                                                                                {{$order->currency_sign}}{{ round($price * $order->currency_value , 2) }}
                                                                                
                                                                            </td>
                                                                            <td>
                                                                                {{$product['qty']}} {{ $product['item']['measure'] }}
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
                                                                                <small style="display: block; color: #777;">({{$vat->product_quantity}})</small>
                                                                            </td>
                                                                            <td>
                                                                                
                                                                                  {{$order->currency_sign}}{{ round($price * $product['qty'] * $order->currency_value , 2) }}
                                                                     
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
                                                                <tfoot>
                                                                  

                                                                    <tr>
                                                                        <td colspan="4">Subtotal</td>
                                                                        <td>{{$order->currency_sign}}{{ round($subtotal * $order->currency_value, 2) }}</td>
                                                                    </tr>
                                                                    @if($subtotal > $discountedsubtotal)
                                                                        <td colspan="4">Price Discount</td>
                                                                        <td>- {{ $order->currency_sign }}{{ round(($subtotal - $discountedsubtotal) * $order->currency_value , 2) }}</td>
                                                                        
                                                                    @endif
                                                                    @if($order->coupon_discount != null)
                                                                    @php
                                                                    $coupon_code = App\Coupon::where('code',$order->coupon_code)->first();
                                                                    $sign = App\Currency::where('is_default','=',1)->first();
                                                                    @endphp
                                                                    <tr>
                                                                        <td colspan="4">Coupon Code ({{$order->coupon_code}} {{$coupon_code->type == 0 ? $coupon_code->price . "%" : $sign->sign . round(($coupon_code->price * $sign->value), 2) }})</td>
                                                                        <td>- {{ $order->currency_sign }}{{round($order->coupon_discount * $order->currency_value, 2)}}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($order->discount > 0)
                                                                        <tr>
                                                                            <td colspan="4">Payment Gateway Discount</td>
                                                                            <td>{{ $order->currency_sign }}{{ $order->discount * $order->currency_value }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if($order->shipping_cost != 0)
                                                                    <tr>
                                                                        <td colspan="4">Delivery Cost</td>
                                                                        <td>{{ $order->currency_sign }}{{ round($order->shipping_cost * $order->currency_value , 2) }}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($order->tax != 0)
                                                                        <tr>
                                                                            <td colspan="4">VAT(13%)</td>
                                                                            @php 
                                                                                $subtotal = $subtotal + $order->shipping_cost;
                                                                                $tax = ($subtotal / 100) * $order->tax;
                                                                            @endphp
                                                                            <td>{{ $order->currency_sign }}{{round($tax * $order->currency_value, 2)}}</td>
                                                                        </tr>
                                                                    @endif
                                                                    
                                                                    <tr>
                                                                        <td colspan="3"></td>
                                                                        <td>Grand Total</td>
                                                                        <td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th colspan="4" class="text-right"></th>
                                                                        <th>
                                                                         
                                                                        </th>
                                                                    </tr>
                                
                                                                       <tr id="" style="color:red;">
                                                                        <th colspan="4" class="text-right g-font-weight-500" style="font-style: italic;font-weight:400;">Taxable Amount :</th>
                                                                        <th class="g-font-weight-500" style="font-style: italic;font-weight:400;">
                                                                            &nbsp;&nbsp;{{$curr->sign}}<span id="">{{round((($vat_sum)/1.13) * $curr->value,2)}}</span>
                                                                        </th>
                                                                    </tr>
                                
                                                                  
                                
                                                                    @if($gs->vat != 0)
                                                                    <tr id="" style="color:red;">
                                                                        <th colspan="4" class="text-right" style="font-style: italic;font-weight:400;">VAT({{$gs->vat}}%):</th>
                                                                        <th style="font-style: italic;font-weight:400;">
                                                                            &nbsp;&nbsp;{{$curr->sign}}<span id="">{{round((($vat_sum)/1.13) * 0.13 * $curr->value,2)}}</span>
                                                                        </th>
                                                                    </tr>
                                                                    @endif

                                                                 
                                                                </tfoot>         
                                                            </table>
                                                            <h6 style="font-style:italic; color:red;">* All price subject to inclusive of VAT</h6>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                  <thead>
                                                                    <tr>
                                                                      <th>Delivery Received By </th>
                                                                      <th>Delivery Date & Time</th>
                                                                    
                                                                    </tr>
                                                                  </thead>
                                                              
                                                                  <tbody>
                                                                    <tr>
                                                                        <td style="{{$order->delivery_received_by ? 'background:#7ff17f' : 'background:#ffeac4'}}">{{$order->delivery_received_by ? $order->delivery_received_by : 'Not Yet'}}</td>
                                                                        <td style="{{$order->delivery_received_by ? 'background:#7ff17f' : 'background:#ffeac4'}}">{{$order->delivery_datetime ? date('d M Y h:i A',strtotime($order->delivery_datetime)) : 'Not Yet'}}</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                                <a style="cursor: pointer;" class="btn btn-warning product-btn email deliveryEmail"  data-toggle="modal" data-target="#deliveryEmailModal"><i class="fa fa-send"></i> Send Delivery Email</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="invoice__orderDetails">
                                                        <p><strong>Order Details</strong></p>
                                                        @if($order->dp == 0)

                                                            <p>Delivery Method:
                                                                @if($order->shipping == "pickup")
                                                                    Pick Up
                                                                @else
                                                                Deliver To Address
                                                                @endif
                                                            </p>
                                                        @endif
                                                        <p>Payment Method: {{$order->method}}</p>
                                                        @if($order->method != "Cash On Delivery")
                                                            
                                                            <p>Transaction ID: {{$order->txnid}}</p>                         
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                @if($order->dp == 0)
                                                    <div class="invoice__shipping">
                                                        <p style="text-align: left;"><strong>Delivery Address</strong></p>
                                                        <p style="text-align: left;">{{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</p>
                                                        <address>
                                                            {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
                                                            {{$order->customer_phone}}<br>
                                                            {{-- {{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}<br> --}}
                                                            {{$order->shipping_country == null ? $order->customer_country : $order->shipping_country}}<br>
                                                        </address>
                                                    </div>
                                                @endif
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    <a class="btn  add-newProduct-btn print" href="{{route('admin-order-print',$order->id)}}" target="_blank"><i class="fa fa-print"></i> Print Invoice Only</a>
                                                    <a class="btn  add-newProduct-btn print" href="{{route('admin-order-print-details',$order->id)}}" target="_blank" style="background-color:#337ab7"><i class="fa fa-print"></i> Print Invoice With Details</a>
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

    <div class="modal fade" id="deliveryEmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Delivery Email Send</h4>
                </div>
                <div class="modal-body">
                <form class="" action="{{route('admin-order-delivery',$order->id)}}" method="POST" >
                        {{ csrf_field() }}
                      
                        <div class="form-group">
                          <label for="exampleInputEmail1">Delivery Received By :</label>
                          <input type="name" name="delivery_received_by" class="form-control" placeholder="Enter Delivery Received By">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Date & Time :</label>
                          <input type="datetime-local" name="delivery_datetime" class="form-control" id="exampleInputPassword1" placeholder="Date Time">
                        </div>
                        <div class="modal-footer" style="text-align: center;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-success btn-ok" type="submit">Send</button>
                        </div>
                    </form>
                    
                </div>
               
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>
    $("#deliveryButton").click(function() {
    $('html,body').animate({
        scrollTop: $(".deliveryEmail").offset().top},
        'slow');
    });
</script>
@endsection
