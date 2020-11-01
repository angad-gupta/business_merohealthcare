@extends('layouts.admin')
        
@section('content')
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
                                                    <h2>Order Details <a href="{{ route('admin-order-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> <a href="{{ route('admin-order-invoice',$order->id) }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-file"></i> Invoice</a></h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Orders <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Order Details</p>
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
                                                                    <th class="order-th" width="45%" style="text-transform: uppercase;">{{$order->order_number}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Total Product</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->totalQty}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Total Cost</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Ordered Date/Time</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($order->created_at))}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Payment Method</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->method}}</td>
                                                                </tr>
                                                                @if($order->method != "Cash On Delivery")
                                                                    @if($order->method=="Stripe")
                                                                        <tr>
                                                                            <th width="45%">{{$order->method}} Charge ID</th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->charge_id}}</td>
                                                                        </tr>                        
                                                                    @endif
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
        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="tr-head">
                                                                    <th class="order-th" width="45%">Billing Address</th>
                                                                    <th width="10%"></th>
                                                                    <th width="45%">
                                                                        @if($order->customer_latlong)
                                                                            <a href="javascript:;" title="View in Map" data-toggle="modal" data-target="#billingLocationModal" style="font-size: 20px;"><i class="fa fa-map-marker"></i></a>
                                                                        @endif

                                                                    </th>
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
                                                                @if($order->customer_pan_number)
                                                                    <tr>
                                                                        <th width="45%">PAN Number</th>
                                                                        <th width="10%">:</th>
                                                                        <td width="45%">{{$order->customer_pan_number}}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <th width="45%">Address Type</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_address_type}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Address</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_address}}</td>
                                                                </tr>
                                                                {{-- <tr>
                                                                    <th width="45%">Nearest LandMark</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_landmark}}</td>
                                                                </tr> --}}
                                                                <tr>
                                                                    <th width="45%">Country</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_country}}</td>
                                                                </tr>
                                                                {{-- <tr>
                                                                    <th width="45%">City</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->customer_city}}</td>
                                                                </tr> --}}
                                                                @if($order->customer_zip)
                                                                    <tr>
                                                                        <th width="45%">Postal Code</th>
                                                                        <th width="10%">:</th>
                                                                        <td width="45%">{{$order->customer_zip}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($order->coupon_code != null)
                                                                @php
                                                                    $coupon_code = App\Coupon::where('code',$order->coupon_code)->first();
                                                                    $sign = App\Currency::where('is_default','=',1)->first();
                                                                @endphp
                                                                <tr>
                                                                    <th width="45%">Coupon Code</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->coupon_code}} {{$coupon_code->type == 0 ? $coupon_code->price . "%" : $sign->sign . round(($coupon_code->price * $sign->value), 2) }}</td>
                                                                </tr>
                                                                @endif
                                                                {{-- @if($order->coupon_discount != null)
                                                                <tr>
                                                                    <th width="45%">Coupon Discount</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{round($order->coupon_discount * $order->currency_value,1) }}</td>
                                                                </tr>
                                                                @endif --}}
                                                                @if($order->affilate_user != null)
                                                                <tr>
                                                                    <th width="45%">Affilate User</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->affilate_user}}</td>
                                                                </tr>
                                                                @endif
                                                                @if($order->affilate_charge != null)
                                                                <tr>
                                                                    <th width="45%">Affilate Charge</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$order->affilate_charge}}</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @if($order->dp == 0)
                                                    <div class="col-lg-6">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr class="tr-head">
                                                                        <th class="order-th" width="45%"><strong>Delivery Address</strong></th>
                                                                        <th width="10%"></th>
                                                                        <td width="45%">
                                                                            @if($order->shipping_latlong)
                                                                                <a href="javascript:;" title="View in Map" data-toggle="modal" data-target="#shippingLocationModal" style="font-size: 20px;"><i class="fa fa-map-marker"></i></a>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @if($order->shipping == "pickup")
                                                                        <tr>
                                                                            <th width="45%"><strong>Pickup Location:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->pickup_location}}</td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <th width="45%"><strong>Name:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td>{{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th width="45%"><strong>Email:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th width="45%"><strong>Phone:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}</td>
                                                                        </tr>
                                                                        @if($order->shipping_pan_number)
                                                                            <tr>
                                                                                <th width="45%">PAN Number</th>
                                                                                <th width="10%">:</th>
                                                                                <td width="45%">{{$order->shipping_pan_number ? $order->shipping_pan_number: $order->customer_pan_number}}</td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <th width="45%">Address Type</th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_address_type ? $order->shipping_address_type: $order->customer_address_type}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th width="45%"><strong>Address:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}</td>
                                                                        </tr>
                                                                        {{-- <tr>
                                                                            <th width="45%">Nearest LandMark</th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_landmark ? $order->shipping_landmark: $order->customer_landmark}}</td>
                                                                        </tr> --}}
                                                                        <tr>
                                                                            <th width="45%"><strong>Country:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_country == null ? $order->customer_country : $order->shipping_country}}</td>
                                                                        </tr>
                                                                        {{-- <tr>
                                                                            <th width="45%"><strong>City:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th width="45%"><strong>Postal Code:</strong></th>
                                                                            <th width="10%">:</th>
                                                                            <td width="45%">{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}</td>
                                                                        </tr> --}}
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="order-table-wrap" style="margin:auto;">

                                        <h3 style="font-size:22px; ">Precription files Attached</h3>

                                                                                        
                                                <table class="table table-striped">
                                                    <tr>
                                                    <th>S/No.</th>
                                                    <th>Prescriptions Files</th>
                                                    </tr>

                                                    @foreach ($order->files as $file)
                                                    <tr>
                                                    <td>
                                                        {{ $loop->iteration}}
                                                    </td>

                                                  <td>
                                                    
                                                    <a href="{{ route('admin-prescriptionorder-file',[$order->id,$file->file,$file->id]) }}" target="_blank"><img src="<?php echo asset("storage/prescriptions/$file->file")?>" style="height:40px;width:40px;border-radius:10px;" alt="{{$file->file}}" title="{{$file->file}}"/> {{ $file->file}}</a>
                                                    <br/>  
                                                
                                                  </td>
                                                    </tr>

                                                  @endforeach   
                                                </table>


                                       
                                        </div>

                                        <div class="" style="padding-left:30px;">

                                        <h3 style="font-size:22px;">Notes</h3>
                                            @if($order->order_note)
                                            <p>{{$order->order_note}}</p>
                                            @else
                                            <p>No Notes Found.</p>

                                            @endif
    
                                        
                                            </div>
                                        
                                        <br>
                                        <div class="order-table-wrap" style="margin-left: 10px;">
                                        <table id="example" class="table">
                                            <h4 class="text-center">Products Ordered</h4><hr>
                                            <thead>
                                                <tr>
                                                    <th width="10%">Product ID#</th>
                                                    {{-- <th>Shop Name</th> --}}
                                                    {{-- <th>Status</th> --}}
                                                    <th>Product Title</th>
                                                    <th>Variant</th>
                                                    <th>Product Price</th>
                                                    <th width="10%">Quantity</th>
                                                    <th width="20%">Total Price</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $discountedsubtotal = 0;
                                                    $vat_sum = 0;
                                                @endphp
                                                @foreach($cart->items as $key => $product)
                                                @php
                                                    $price = $product['item']['pprice'] ? $product['item']['pprice'] : $product['item']['cprice'];
                                                    $vat = App\Product::findORFail($product['item']['id']);
                                                    $prod = App\Product::findORFail($product['item']['id']);
                                                @endphp
                                                

                                                    <tr>
                                                        <input type="hidden" value="{{$key}}">
                                                        <td>{{ $product['item']['id'] }}</td>
                                                        
                                                        <td>
                                                            <input type="hidden" value="{{ $product['license'] }}">
                                                            <a target="_blank" href="{{route('front.product',['id1' => $product['item']['id'], str_slug($product['item']['name'],'-')])}}">{{strlen($product['item']['name']) > 60 ? substr($product['item']['name'],0,60).'...' : $product['item']['name']}}</a>
                                                            @if($vat->vat_status == 1)
                                                                *
                                                            @endif
                                                            @if($product['license'] != '')
                                                                <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" class="btn btn-info product-btn" id="license" style="padding: 5px 12px;"><i class="fa fa-eye"></i> View License</a>
                                                            @endif
                                                            <small style="display: block; color: #777;">{{$prod->company_name}}</small>
                                                        </td>
                                                        <td>{{$prod->sub_title}}</td>

                                                        <td>
                                                            {{-- @if($vat->vat_status == 1)
                                                            {{$order->currency_sign}}{{ round($product['item']['cprice'] * $order->currency_value , 2) }}
                                                            @else --}}
                                                            {{$order->currency_sign}}{{ round($price * $order->currency_value , 2) }}
                                                            {{-- @endif --}}
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
                                                            {{-- @if($vat->vat_status == 1)
                                                               {{$order->currency_sign}}{{ round($product['item']['cprice'] * $product['qty'] * (100/($gs->vat+100)) * $order->currency_value , 2) }}
                                                              @else --}}
                                                                 {{$order->currency_sign}}{{ round($price * $product['qty'] * $order->currency_value , 2) }}
                                                            {{-- @endif --}}
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
                                                {{-- @if($gs->vat != 0)
                                                <tr>
                                                    <td align="right" colspan="4" style="font-weight:800;">
                                                        VAT({{$gs->vat}}%):                  
                                                    </td>
                                                    <td align="left" style="font-weight:800;">
                                                        {{$order->currency_sign}}<span id="">{{round($vat_sum * ($gs->vat/100) ,2)}}
                                                    </td>
                                                </tr>
                                                @endif --}}

                                                <tr>
                                                    <td align="right" colspan="5" style="font-weight:800;border-top:0">
                                                        Sub Total :                   
                                                    </td>
                                                    <td align="left" style="font-weight:800;border-top:0">
                                                        {{ $order->currency_sign }} {{ round($subtotal * $order->currency_value , 2) }}
                                                    </td>
                                                </tr>
                                                @if($subtotal > $discountedsubtotal)
                                                    <tr>
                                                        
                                                        
                                                        <td align="right" colspan="5" style="font-weight:800;border-top:0">
                                                            Price Discount :                      
                                                        </td>
                                                        <td align="left" style="font-weight:800;border-top:0">
                                                            - {{ $order->currency_sign }} {{ round(($subtotal - $discountedsubtotal) * $order->currency_value , 2) }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                
                                                @if($order->coupon_code != null)
                                                    <tr>
                                                        @php
                                                        $coupon_code = App\Coupon::where('code',$order->coupon_code)->first();
                                                        $sign = App\Currency::where('is_default','=',1)->first();
                                                        @endphp
                                                        
                                                        <td align="right" colspan="5" style="font-weight:800;border-top:0">
                                                            Coupon Code ({{$order->coupon_code}} {{$coupon_code->type == 0 ? $coupon_code->price . "%" : $sign->sign . round(($coupon_code->price * $sign->value), 2) }}) :                 
                                                        </td>
                                                        <td align="left" style="font-weight:800;border-top:0">
                                                            - {{ $order->currency_sign }} {{ $order->coupon_discount * $order->currency_value }}
                                                        </td>
                                                    </tr>
                                                @endif

                                                @if($order->discount > 0)
                                                    <tr>
                                                        
                                                        
                                                        <td align="right" colspan="5" style="font-weight:800;border-top:0">
                                                            Payment Gateway Discount ({{ $order->method }}) :                 
                                                        </td>
                                                        <td align="left" style="font-weight:800;border-top:0">
                                                            {{ $order->currency_sign }} {{ $order->discount * $order->currency_value }}
                                                        </td>
                                                    </tr>
                                                @endif
                            
                                                @if($order->shipping_cost != 0)
                                                    <tr>
                                                        
                                                        
                                                        <td align="right" colspan="5" style="font-weight:800;border-top:0">
                                                            Delivery Fee :                  
                                                        </td>
                                                        <td align="left" style="font-weight:800;border-top:0">
                                                            {{ $order->currency_sign }} {{ $order->shipping_cost * $order->currency_value }}
                                                        </td>
                                                    </tr>
                                                @endif
                            
                                                @if($order->tax != 0)
                                                    <tr>
                                                        
                                                        
                                                        <td align="right" colspan="5" style="font-weight:800;border-top:0">
                                                            VAT(13%) :               
                                                        </td>
                                                        <td align="left" style="font-weight:800;border-top:0">
                                                            {{ $order->currency_sign }} {{ $order->tax * $order->currency_value }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td align="right" colspan="5" style="font-weight:800;border-top:0">
                                                        Grand Total :                    
                                                    </td>
                                                    <td align="left" style="font-weight:800;border-top:0">
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
                                    </main>
                                    <hr>
                                    <div class="text-center">
                                        <input type="hidden" value="{{$order->customer_email}}">
                                        <a style="cursor: pointer;" class="btn btn-success product-btn email" data-toggle="modal" data-target="#emailModal"class="btn btn-success email"><i class="fa fa-send"></i> Send Email</a>

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
                 <div id="map1" style="height: 500px"></div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-neutral" data-dismiss="modal" aria-label="Close">OK</button>
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

    <div class="modal fade" id="shippingLocationModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="margin-top: 0;">
            <div class="modal-header text-center" style="border-bottom: none;padding-bottom: 0">
                <h4><strong>Shipping Location</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
    
            <div class="modal-body text-center">
                {{-- <iframe src="https://www.google.com/maps?ll=27.6698788,85.3288006&t=&z=17&ie=UTF8&iwloc=&output=embed" 
                 height="450" frameborder="0" style="width: 100%;" allowfullscreen=""></iframe> --}}
                 <div id="map2" style="height: 500px"></div>
                
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
                    <h4 class="modal-title text-center" id="myModalLabel">License Key</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">The Licenes Key is :  <span id="key"></span> <a id="license-edit" style="cursor: pointer;">Edit License</a><a id="license-cancel" style="cursor: pointer; display: none;">Cancel</a></p>
                    <form method="POST" action="{{route('admin-order-license',$order->id)}}" id="edit-license" style="display: none;">
                        {{csrf_field()}}
                        <input type="hidden" name="license_key" id="license-key" value="">
                        <div class="form-group text-center">
                    <input type="text" name="license" placeholder="Enter New License Key" style="width: 40%;" required=""><input type="submit" name="submit" class="btn btn-primary" style="border-radius: 0; padding: 2px; margin-bottom: 2px;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
            var myLatLng1 = JSON.parse('<?php echo $order->customer_latlong ?>');
            var myLatLng2 = null;

            if('<?php echo $order->shipping_latlong ?>')
                myLatLng2 = JSON.parse('<?php echo $order->shipping_latlong ?>');

            var map = new google.maps.Map(document.getElementById('map1'), {
                zoom: 17,
                center: myLatLng1
            });
    
            var marker = new google.maps.Marker({
                position: myLatLng1,
                map: map,
                title: '{{ $order->customer_address }}'
            });

            if(myLatLng2){
                
                var map = new google.maps.Map(document.getElementById('map2'), {
                    zoom: 17,
                    center: myLatLng2
                });
        
                var marker = new google.maps.Marker({
                    position: myLatLng2,
                    map: map,
                    title: '{{ $order->shipping_address }}'
                });
            }
        }
    </script>

    @if($order->customer_latlong || $order->shipping_latlong)
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&callback=initMap">
        </script>
    @endif
{{-- 
    <script>
          $('#deliveryEmailModal').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script> --}}

    <script>
        $("#deliveryButton").click(function() {
        $('html,body').animate({
            scrollTop: $(".deliveryEmail").offset().top},
            'slow');
    });

    </script>
@endsection