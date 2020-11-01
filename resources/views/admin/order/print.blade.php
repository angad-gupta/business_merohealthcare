<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$seo->meta_keys}}">
    <meta name="author" content="GeniusOcean">

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
        margin: 5mm;
      }
      @media print {
        html, body {
          width: 210mm;
          height: 287mm;
        }

        /* html {
            overflow: scroll;
            overflow-y: hidden;
        } */
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
  
      .invoice__table .table>tfoot>tr>td {
      font-size: 14px;
      font-weight: 700;
      line-height: 10px;
  }

  th{
      font-size:14px !important;
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
                  @if($order->payment_status == "paid")
                      <span class="btn-lg btn-success" style="cursor:default; border-radius:0">Paid</span>
                  @else
                      <span class="btn-lg btn-danger" style="cursor:default; border-radius:0">Unpaid</span> 
                  @endif
                </div>
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="invoice__metaInfo">
                    <div class="buyer" style="width: 60%;">
                        <p>Billing Address</p>
                        <strong>{{$order->customer_name}}</strong>
                        <address>
                            {{$order->customer_address}}<br>
                            {{$order->customer_phone}}<br>
                            {{$order->customer_country}}<br>
                        </address>
                    </div>

                    <div class="invoce__date"  style="width: 20%;">
                      <p><strong style="font-size:14px;">PAN</strong></p>
                        <strong style="font-size:14px;font-weight:500;">Invoice ID</strong>
                        <p style="font-weight:500;">Order Date/Time</p>
                        <p style="font-weight:500;">Order ID</p>
                    </div>

                    <div class="invoce__number"  style="width: 20%;">
                      <p><strong>609680496</strong></p>
                        <strong style="font-weight:500;">{{sprintf("%'.08d", $order->id)}}</strong>
                        <p>{{date('d-M-Y H:i:s A',strtotime($order->created_at))}}</p>
                        <p>{{$order->order_number}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="invoice__table" style="margin-top:0px; margin-bottom:0px;">
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
                            $price = $product['item']['pprice'] ? : $product['item']['cprice'];
                            $vat = App\Product::findORFail($product['item']['id']);
                            $prod = App\Product::findORFail($product['item']['id']);
                            @endphp
                                <tr>
                                  <td >{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}
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
                                      <small style="display: block; color: #777;">({{$prod->product_quantity}})</small>
                                    </td>
                                  <td>
                                   
                                    {{$order->currency_sign}}{{ round($price  * $product['qty'] * $order->currency_value , 2) }}
                                    
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
                              <td colspan="4" style="font-weight:600;">Subtotal</td>
                              <td style="font-weight:600;">{{$order->currency_sign}}{{ round($subtotal * $order->currency_value, 2) }}</td>
                          </tr>
                          @if($subtotal > $discountedsubtotal)
                              <td colspan="4">Price Discount</td>
                              <td>- {{ $order->currency_sign }} {{ round(($subtotal - $discountedsubtotal) * $order->currency_value , 2) }}</td>
                              
                          @endif
                          @if($order->coupon_discount != null)
                          @php
                          $coupon_code = App\Coupon::where('code',$order->coupon_code)->first();
                          $sign = App\Currency::where('is_default','=',1)->first();
                          @endphp
                            <tr>
                                <td colspan="4">Coupon Discount ({{$order->coupon_code}} {{$coupon_code->type == 0 ? $coupon_code->price . "%" : $sign->sign . round(($coupon_code->price * $sign->value), 2) }})</td>
                                <td>- {{ $order->currency_sign }} {{round($order->coupon_discount * $order->currency_value, 2)}}</td>
                            </tr>
                          @endif
                          @if($order->discount > 0)
                              <tr>
                                  <td colspan="4">Payment Gateway Discount</td>
                                  <td>{{ $order->currency_sign }} {{ $order->discount * $order->currency_value }}</td>
                              </tr>
                          @endif
                          @if($order->shipping_cost != 0)
                            <tr>
                                <td colspan="4">Delivery Cost</td>
                                <td>{{ $order->currency_sign }} {{ round($order->shipping_cost * $order->currency_value , 2) }}</td>
                            </tr>
                          @endif
                          @if($order->tax != 0)
                              <tr>
                                  <td colspan="4">VAT(13%)

                                  </td>
                                  @php 
                                      $subtotal = $subtotal + $order->shipping_cost;
                                      $tax = ($subtotal / 100) * $order->tax;
                                  @endphp
                                  <td>{{ $order->currency_sign }} {{round($tax * $order->currency_value, 2)}}</td>
                              </tr>
                          @endif
                          
                          <tr>
                              <td colspan="3" ></td>
                              <td style="border-top:1px solid;">Grand Total</td>
                              <td style="border-top:1px solid;">{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="invoice__orderDetails" style="margin-top:0px;margin-bottom:0px;">
                    <p><strong style="margin-bottom:0px;font-size:14px;">Order Details</strong></p>
                    @if($order->dp == 0)
                      <p style="margin-top:5px;">Delivery Method:                                   
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

        {{-- <div class="row">
            <div class="col-sm-6">
                <div class="invoice__shipping">
                @if($order->dp == 0)
                    <p style="text-align: left;"><strong>Delivery Address</strong></p>
                    <p style="text-align: left;">{{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</p>
                    <address>
                        {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
                      
                        {{$order->customer_phone}}<br>
                        {{$order->shipping_country == null ? $order->customer_country : $order->shipping_country}}<br>
                    </address>
                @endif
                
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-sm-12">
                <div class="invoice__metaInfo" style="margin-top:5px;margin-bottom:0px;">
                    <div class="buyer" style="width: 60%;">
                        @if($order->dp == 0)
                        <p style="text-align: left;"><strong style="font-size:14px;">Delivery Address</strong></p>
                        <p style="text-align: left; font-weight:400;font-size:14px;">{{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</p>
                        <address>
                            {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
                            {{-- {{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}<br> --}}
                            {{$order->customer_phone}}<br>
                            {{$order->shipping_country == null ? $order->customer_country : $order->shipping_country}}<br>
                        </address>
                    @endif
                    </div>

                    {{-- <div class="invoce__date"  style="width: 40%;">
                        <p style="text-align: left;"><strong style="font-size:14px;"> Delivery Received By</strong></p>
                        <table>
                            <tr style="height:25px;">
                              <td style="font-weight:500;">Name </td>
                              <td><p>&nbsp;: &nbsp;________________________</p></td>
                            </tr>
                            <tr style="height:25px;">
                                <td style="font-weight:500;">Date & Time </td>
                                <td><p>&nbsp;: &nbsp;________________________</p></td>
                            </tr>
                            <tr style="height:25px;">
                                <td style="font-weight:500;">Phone </td>
                                <td><p>&nbsp;: &nbsp;________________________</p></td>
                            </tr>
                            <tr style="height:25px;">
                                <td style="font-weight:500;"> Signature </td>
                                <td><p>&nbsp;: &nbsp;________________________</p></td>
                            </tr>
                        </table>
                </div> --}}
            </div>
        </div>

    </div>

    {{-- <div class="row">
        <div class="col-sm-12" style="margin-top:50px;">
            <p><strong style="font-size:14px;"> Feedback :</strong> _______________________________________________________________________________________</p>
        </div>
    </div> --}}

    <script type="text/javascript">
      setTimeout(function () {
            window.close();
          }, 500);
    </script>
  </body>
</html>
