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
}

/* html {
    overflow: scroll;
    overflow-x: hidden;
} */
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
  </style>
</head>
<body onload="window.print();">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Starting of Dashboard data-table area -->
                    <div class="section-padding add-product-1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div class="container text-center">
                                    <img class="text-center" src="{{url('assets/images/logo.jpg')}}" style="height:100px; width:175px; "/>
                                    
                                    </div>

                                    

                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h4>PAN : 609680496</h4>
                                                    <h2 style="text-transform:uppercase;">Order #{{$order->order_number}} [{{$order->status}}] 
                                                         @if($order->payment_status == "paid")
                                                        <span class="btn-sm btn-success" style="cursor:default">Paid</span>
                                                    @else
                                                        <span class="btn-sm btn-danger" style="cursor:default">Unpaid</span> 
                                                    @endif
                                                </h2>
                                                    
                                        </div>   
                                    </div>
                                        @include('includes.form-success')
                                        <div class="row">
                                            <div class="col-md-10" style="margin-left: 2.5%;">
                                                <div class="dashboard-content">
                                                    <div class="view-order-page" id="print">
                                                        <p class="order-date">Order Date {{date('d-M-Y',strtotime($order->created_at))}}</p>


@if($order->dp == 1)

                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5>Billing Address</h5>
                                                                    <address>
                                                                        Name: {{$order->customer_name}}<br>
                                                                        Email: {{$order->customer_email}}<br>
                                                                        Phone: {{$order->customer_phone}}<br>
                                                                        Address: {{$order->customer_address}}<br>
                                                                        {{-- {{$order->customer_city}} {{$order->customer_zip}} --}}
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>
                                                                        Payment Method
                                                                        @if($order->payment_status == "paid")
                                                                            <span class="btn-sm btn-success" style="cursor:default">Paid</span>
                                                                        @else
                                                                            <span class="btn-sm btn-danger" style="cursor:default">Unpaid</span> 
                                                                        @endif
                                                                    </h5>
                                                                    <p>{{$order->method}}</p>

                                                                    @if($order->method != "Cash On Delivery")
                                                                        @if($order->method=="Stripe")
                                                                            {{$order->method}} Charge ID: <p>{{$order->charge_id}}</p>
                                                                        @endif
                                                                        {{$order->method}} Transaction ID: <p id="ttn">{{$order->txnid}}</p>

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

@else
                                                        <div class="shipping-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    @if($order->shipping == "shipto")
                                                                        <h5>Delivery Address</h5>
                                                                        <address>
                Name: {{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}<br>
                Email: {{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}<br>
                Phone: {{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}<br>
                Address: {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
{{-- {{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}-{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}} --}}
                                                                        </address>
                                                                    @else
                                                                        <h5>PickUp Location</h5>
                                                                        <address>
                                                                            Address: {{$order->pickup_location}}<br>
                                                                        </address>
                                                                    @endif

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>Delivery Method</h5>
                                                                    @if($order->shipping == "shipto")
                                                                        <p>Delivery To Address</p>
                                                                    @else
                                                                        <p>Pick Up</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5>Billing Address</h5>
                                                                    <address>
                                                                        Name: {{$order->customer_name}}<br>
                                                                        Email: {{$order->customer_email}}<br>
                                                                        Phone: {{$order->customer_phone}}<br>
                                                                        Address: {{$order->customer_address}}<br>
                                                                        {{-- {{$order->customer_city}} {{$order->customer_zip}} --}}
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>
                                                                        Payment Method
                                                                       
                                                                    </h5>
                                                                    <p>{{$order->method}}</p>

                                                                    @if($order->method != "Cash On Delivery")
                                                                        @if($order->method=="Stripe")
                                                                            {{$order->method}} Charge ID: <p>{{$order->charge_id}}</p>
                                                                        @endif
                                                                        {{$order->method}} Transaction ID: <p id="ttn">{{$order->txnid}}</p> 

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
@endif
                                                        <br>
                      <div class="table-responsive">
                            <table id="example" class="table">
                                <h4 class="text-center">Products Ordered</h4><hr>
                                <thead>
                                <tr>
                                    <th width="10%">ID#</th>
                                    <th>Product Title</th>
                                    <th width="15%">Variants</th>
                                    <th width="15%">Quantity</th>
                                    <th width="20%">Product Price</th>
                                    <th width="20%">Total Price</th>
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
                                    $vat = App\Product::findOrFail($product['item']['id']);
                                    $prod = App\Product::findORFail($product['item']['id']);
                                    @endphp

                                        {{-- <tr>
                                                <td>{{ $product['item']['id'] }}</td>
                                                <td>{{strlen($product['item']['name']) > 25 ? substr($product['item']['name'],0,25).'...' : $product['item']['name']}}</td>
                                                <td>{{$product['qty']}} {{ $product['item']['measure'] }}</td>
                                                <td>{{$order->currency_sign}}{{round($product['item']['price'] * $order->currency_value,2)}}</td>
                                                <td>{{$order->currency_sign}}{{round($product['price'] * $order->currency_value,2)}}</td>

                                        </tr> --}}

                                        <tr>
                                            <td>{{ $product['item']['id'] }}</td>
                                            <td>
                                                {{strlen($product['item']['name']) > 25 ? substr($product['item']['name'],0,25).'...' : $product['item']['name']}}
                                                @if($vat->vat_status == 1)
                                                    <span style="font-style: italic;">*</span>
                                                @endif
                                                <small style="display: block; color: #777;">{{$vat->company_name}}</small>
                                            </td>
                                            <td>{{$vat->sub_title}}</td>
                                            <td>{{$product['qty']}} {{ $product['item']['measure'] }}
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
                                                {{-- {{$order->currency_sign}}{{round($product['item']['cprice'] * $order->currency_value,2)}} --}}
                                                
                                                {{$order->currency_sign}}{{ round($price * $order->currency_value , 2) }}
                                                
                                            </td>
                                            <td>
                                                {{-- {{$order->currency_sign}}{{round($product['item']['cprice'] * $product['qty'] * $order->currency_value,2)}} --}}
                                            
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
                                <tfoot>
                                    <tr>
                                        <td align="right" colspan="5" style="font-weight:600;border-top:0">
                                            Sub Total :                     
                                        </td>
                                        <td align="left" style="font-weight:600;border-top:0">
                                            {{ $order->currency_sign }} {{ round($subtotal * $order->currency_value , 2) }}
                                        </td>
                                    </tr>
                                    @if($subtotal > $discountedsubtotal)
                                        <tr>
                                            
                                            
                                            <td align="right" colspan="5" style="font-weight:600;border-top:0">
                                                Price Discount :                       
                                            </td>
                                            <td align="left" style="font-weight:600;border-top:0">
                                                - {{ $order->currency_sign }} {{ round(($subtotal - $discountedsubtotal) * $order->currency_value , 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    
                                    @if($order->coupon_code != null)
                                        <tr>
                                            
                                            
                                            <td align="right" colspan="5" style="font-weight:600;border-top:0">
                                                Discount Coupon ({{$order->coupon_code}}):                 
                                            </td>
                                            <td align="left" style="font-weight:600;border-top:0">
                                                - {{ $order->currency_sign }} {{ $order->coupon_discount * $order->currency_value }}
                                            </td>
                                        </tr>
                                    @endif

                                    @if($order->discount > 0)
                                        <tr>
                                            
                                            
                                            <td align="right" colspan="5" style="font-weight:600;border-top:0">
                                                Payment Gateway Discount : ({{ $order->method }})                  
                                            </td>
                                            <td align="left" style="font-weight:600;border-top:0">
                                                {{ $order->currency_sign }} {{ $order->discount * $order->currency_value }}
                                            </td>
                                        </tr>
                                    @endif
                
                                    @if($order->shipping_cost != 0)
                                        <tr>
                                            
                                            
                                            <td align="right" colspan="5" style="font-weight:600;border-top:0">
                                                Delivery Fee :              
                                            </td>
                                            <td align="left" style="font-weight:600;border-top:0">
                                                {{ $order->currency_sign }} {{ $order->shipping_cost * $order->currency_value }}
                                            </td>
                                        </tr>
                                    @endif
                
                                    @if($order->tax != 0)
                                        <tr>
                                            
                                            
                                            <td align="right" colspan="5" style="font-weight:600;border-top:0">
                                                VAT (13%) :              
                                            </td>
                                            <td align="left" style="font-weight:600;border-top:0">
                                                {{ $order->currency_sign }} {{ $order->tax * $order->currency_value }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        
                                        
                                        <td align="right" colspan="5" style="font-weight:600;border-top:0">
                                           Grand Total :                      
                                        </td>
                                        <td align="left" style="font-weight:600;border-top:0">
                                            {{ $order->currency_sign }} {{ round($order->pay_amount * $order->currency_value , 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th colspan="5" class="text-right"></th>
                                        <th>
                                         
                                        </th>
                                    </tr>
            
                                       <tr id="" style="color:red;">
                                        <th colspan="5" class="text-right g-font-weight-500" style="font-style: italic;font-weight:400;">Taxable Amount :</th>
                                        <th class="g-font-weight-500" style="font-style: italic;font-weight:400;">
                                            &nbsp;&nbsp;{{$curr->sign}}<span id="">{{round((($vat_sum)/1.13) * $curr->value,2)}}</span>
                                        </th>
                                    </tr>
            
                                  
            
                                    @if($gs->vat != 0)
                                    <tr id="" style="color:red;">
                                        <th colspan="5" class="text-right" style="font-style: italic;font-weight:400;">VAT({{$gs->vat}}%):</th>
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
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- Ending of Dashboard data-table area -->
            </div>
<!-- ./wrapper -->
<!-- ./wrapper -->

<script type="text/javascript">
setTimeout(function () {
        window.close();
      }, 500);
</script>
</body>
</html>
