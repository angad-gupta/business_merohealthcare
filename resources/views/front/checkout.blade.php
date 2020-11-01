@extends('layouts.front')
@section('title','Checkout')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <!-- Starting of checkOut area -->

 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<style>
   @media (min-width: 768px){
  .col-md-8 {
    -ms-flex: 0 0 50%;
    flex: 0 0 65.67%;
    max-width: 65.67%;
    }
  }

  @media (min-width: 768px){
.col-md-4 {
-ms-flex: 0 0 32.33%;
flex: 0 0 32.33%;
max-width: 32.33%;
}
}
  /* .col-md-4 {
    -ms-flex: 0 0 50%;
    flex: 0 0 33%;
    max-width: 33%;
    }
  } */
    .hide{
        display:none;
    }

.product-checkOut-wrap .form-control {
    box-shadow: none;
    border-radius: 30px !important;
    height: 30px;
}

#drop-zone {
  width: 100%;
  min-height: 150px;
  border: 1px dashed rgba(0, 0, 0, .3);
  border-radius: 5px;
  font-family: Arial;
  text-align: center;
  position: relative;
  font-size: 20px;
  color: #7E7E7E;
}
#drop-zone input {
  position: absolute;
  cursor: pointer;
  left: 0px;
  top: 0px;
  opacity: 0;
}
/*Important*/

#drop-zone.mouse-over {
  border: 3px dashed rgba(0, 0, 0, .3);
  color: #7E7E7E;
}
/*If you dont want the button*/

#clickHere {
  display: inline-block;
  cursor: pointer;
  color: white;
  font-size: 17px;
  width: 150px;
  border-radius: 4px;
  background-color: #2385aa;
  padding: 10px;
}
#clickHere:hover {
  background-color: #376199;
}
#filename {
  margin-top: 10px;
  margin-bottom: 10px;
  font-size: 14px;
  line-height: 1.5em;
}
.file-preview {
  background: #ccc;
  border: 1px solid #fff;
  box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
  display: inline-block;
  width: 60px;
  height: 60px;
  text-align: center;
  font-size: 14px;
  margin-top: 5px;
}
.closeBtn:hover {
  color: red;
  display:inline-block;
}
}
</style>

<style>

    .blog-wrap {
        background: #fff;
    }

      .form-control{
        border-radius: 30px;
      }
    #drop-zone {
      width: 100%;
      min-height: 80px;
      border: 1px dashed rgba(0, 0, 0, .3);
      border-radius: 5px;
      font-family: Arial;
      text-align: center;
      position: relative;
      font-size: 20px;
      color: #7E7E7E;
      border-radius:30px;
    }
    #drop-zone input {
      position: absolute;
      cursor: pointer;
      left: 0px;
      top: 0px;
      opacity: 0;
    }
    /*Important*/

    #drop-zone.mouse-over {
      border: 3px dashed rgba(0, 0, 0, .3);
      color: #7E7E7E;
    }
    /*If you dont want the button*/

    #clickHere {
      display: inline-block;
        cursor: pointer;
        color: white;
        font-size: 17px;
        width: 50px;
        border-radius: 4px;
        background-color: #2385aa;
        padding: 10px;
        border-radius: 30px;

    }
    #clickHere:hover {
      background-color: #376199;
    }
    #filename {
      margin-top: 10px;
      margin-bottom: 10px;
      font-size: 14px;
      line-height: 1.5em;
    }
    .file-preview {
      background: #ccc;
      border: 1px solid #fff;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
      display: inline-block;
      width: 60px;
      height: 60px;
      text-align: center;
      font-size: 14px;
      margin-top: 5px;
    }
    .closeBtn:hover {
      color: red;
      display:inline-block;
    }
    }
    </style>

 <style>


.product-checkOut-wrap .form-group {
    margin-bottom: 8px;
}

.product-checkOut-wrap .form-control {
    box-shadow: none;
    border-radius: 0;
    height: 30px;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
}
 @media(min-width:320px) and (max-width:768px){
    #history-prescription{
      height:40px !important;
    }
    }
    </style>
    @php
        $user = Auth::guard('user')->user();
    @endphp
{{-- 
<script type="text/javascript">
    function validateForm() {
      var a = document.forms["Form"]["filenames[]"].value;
      var b = document.forms["Form"]["fileid[]"].value;

      if (a == "" && b == "") {
        alert("Please Select Prescription File");
       
        return false;
      }


    }
  </script> --}}

  {{-- <form method="post" name="Form" onsubmit="return validateForm()" action="">
    <textarea cols="30" rows="2" name="answer_a" id="a"></textarea>
    <textarea cols="30" rows="2" name="answer_b" id="b"></textarea>

    <button class="btn" type="submit">Submit</button>
  </form> --}}





    <form name="Form" action="{{ route('payment.submit') }}" method="post" id="payment_form" onsubmit="return validateForm()" enctype="multipart/form-data" >


        <div class="section-padding product-checkOut-wrap" style="padding-top:10px;">

            <div class="container">
              <header class="g-mb-20">
                <div class="u-heading-v6-2 text-uppercase ">
                  <h2 class="h4 g-font-weight-300 g-font-size-20 btn btn-primary"><i class="icon-basket-loaded"></i> checkout</h2>
                </div>
              </header>
                {{-- <h4 class="signIn-title">{{$lang->odetails}}</h4> --}}
              
                <div class="row">
                <div class="col-md-8 " style="margin-bottom: 20px;">
                
                  <div class="g-overflow-x-scroll g-overflow-x-visible--lg">
                    <table class="text-center w-100">
                      <thead class="h6 g-brd-bottom g-brd-gray-light-v3 g-color-black">
                        <tr>
                          <th class="g-font-weight-600 text-left g-pb-20">Product Name</th>
                          <th class="g-font-weight-600 g-width-80 g-pb-20">Unit Price</th>
                          <th class="g-font-weight-600 g-width-130 g-pb-20">Qty</th>
                          <th class="g-font-weight-600 g-width-80 g-pb-20">Line Total</th>
                          <th></th>
                        </tr>
                      </thead>
                
                      <tbody>
                        @php
                            $priceDiscount = 0;
                            $vat_sum = 0;
                        @endphp
                    @foreach($products as $id => $product)
                    @php
                
                        $price = $product['item']['pprice'] ? : $product['item']['cprice'];
                        $vat = App\Product::findORFail($product['item']['id']);
                     
                    @endphp
                        <tr class="g-brd-bottom g-brd-gray-light-v3">
                          <td class="text-left g-py-5 g-px-5">
                            <img class="d-inline-block g-width-100 mr-4" src="{{asset('assets/images/'.$product['item']['photo'])}}" alt="{{ $product['item']['name'] }}" style="height: 100px;">
                            <div class="d-inline-block align-middle">
                              <h4 class="h6 g-color-black"><a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" target="_blank">{{ ucwords(strtolower($product['item']['name'])) }}</a>
                                @if($vat->vat_status == 1)
                                    <span style="font-style: italic;">*</span>
                                @endif
                            </h4>
                              <ul class="list-unstyled g-color-gray-dark-v4 g-font-size-12 g-line-height-1_6 mb-0">
                                <li>Variant: {{$vat->sub_title}}</li>
                                <li>Qty: {{$vat->product_quantity}}</li>
                              
                              </ul>
                            </div>
                          </td>
                
                
                          <td class="g-color-gray-dark-v2 g-font-size-13">{{$curr->sign}}{{ round($price * $curr->value , 2) }}</td>
                
                          <td>
                            {{ $product['qty'] }}  {{ $product['item']['measure'] }}
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
                          </td>
                          <td class="text-center g-color-black">
                            @if($gs->sign == 0)
                                {{$curr->sign}}{{ round($price * $product['qty'] * $curr->value , 2) }}
                            @else
                                {{ round($price * $product['qty'] * $curr->value , 2) }}{{$curr->sign}}
                            @endif
                
                
                            @php
                                $priceDiscount += round($price * $product['qty'] * $curr->value , 2) - round($product['price'] * $curr->value , 2);
                            @endphp
                          </td>
                        </tr>
                        @php
                            if($vat->vat_status == 1){
                            $vat_price = $price * $product['qty'] * (100/($gs->vat+100)) * $curr->value;
                            $vat_sum = $vat_sum + $vat_price;
                            }
                        @endphp
                        @endforeach
                
                      
                
                      
                      </tbody>
                    </table>
                  </div>
                </div>
                
                <div class="col-md-4 g-mb-30">
                    <div class="g-bg-gray-light-v5 g-pa-20 g-pb-20 mb-4" style="border-radius:20px;">
                        <h4 class="h6 text-uppercase mb-3 g-font-weight-600">Order Summary</h4>
                        <hr/>
                
                        @if(Auth::guard('user')->user())
                        <div id="accordion-01" class="mb-4" role="tablist" aria-multiselectable="true">
                          <div id="accordion-01-heading-01" class="g-brd-y" role="tab">
                            <h5 class="g-font-weight-400 g-font-size-default mb-0">
                              <a class="g-text-underline--none--hover collapsed" style="color: #3bb18f" href="#accordion-01-body-01" data-toggle="collapse" data-parent="#accordion-01" aria-expanded="false" aria-controls="accordion-01-body-01"><i class="icon-present"></i> Coupon Code
                                <span class="ml-3 fa fa-angle-down"></span></a>
                            </h5>
                          </div>
                          <div id="accordion-01-body-01" class="collapse" role="tabpanel" aria-labelledby="accordion-01-heading-01" style="">
                            <div class="g-py-10">
                                
                                <input class="form-control" type="text" id="code" placeholder="{{$lang->ecpn}}" autocomplete="off" style="text-transform:uppercase;margin-bottom:10px;">
                                <input type="hidden" id="">
                                
                                <button id="coupon" class="btn btn-primary btn-block order-btn " type="button" style="border-radius:30px;padding: 5px 15px;font-weight:500;">{{$lang->acpn}}</button>
                             
                            </div>
                            <hr>
                        
                        </div>
                        </div>

                        @else
                        <a href="{{route('user-login')}}">Login to Use Coupon Code</a>
                        @endif
                       
                
                        <div class="d-flex justify-content-between mt-2">
                          <span class="g-color-black">Subtotal</span>
                          <span class="g-color-black g-font-weight-300">{{$curr->sign}} {{round(($totalPrice + $priceDiscount - $shipping_cost)* $curr->value,2)}}</span>
                        </div>
                        @if($priceDiscount > 0)
                            <div class="d-flex justify-content-between">
                                <span class="g-color-black">Price Discount</span>
                                <span class="g-color-black g-font-weight-300"> - {{$curr->sign}}<span>{{ $priceDiscount }}</span></span>
                            </div>
                        @endif
                  
                
                        
                          <div class="d-flex justify-content-between" id="discount" style="display: none !important;">
                            <span class="g-color-black"> {{$lang->ds}} (<span id="sign"></span>)</span>
                            <span class="g-color-black g-font-weight-300"> - {{$curr->sign}}<span id="ds"></span>
                          </div>
                    
                
                          @if($shipping_cost > 0)
                          <div class="d-flex justify-content-between" >
                            <span class="g-color-black">Delivery Charge</span>
                            <span class="g-color-black g-font-weight-300"> {{$curr->sign}}<span id="ship-cost">{{round($shipping_cost * $curr->value,2)}}</span>
                          </div>
                          @endif
                
                        <div class="d-flex justify-content-between">
                          <span class="g-color-black">Grand Total</span>
                          <span class="g-color-black g-font-weight-700 coupon-td" >{{$curr->sign}}<span id="total-cost"> {{round($totalPrice * $curr->value ,2)}}</span></span>
                        </div>
                        <hr>
                        <div class="text-center">
                          <a class="btn btn-primary g-brd-2 g-brd-white g-font-size-13 g-rounded-50 g-pl-20 g-pr-15 g-py-9" href="{{route('front.cart')}}" style="color:white;">
                              <i class="icon-finance-100 u-line-icon-pro"></i>
                         
                            View Cart
                          </a>
                          
                          </div>
                
                      </div>
{{-- 
                      <h6 style="font-style:italic; color:red;">* All price subject to inclusive of VAT</h6> --}}
                    
                    
                </div>
                </div>
                </div>

               

              
             

            <div class="container" style="margin-top:15px;">
               
              <br/>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="billing-details-area">
                            <h4 class="signIn-title">{{$lang->bdetails}}</h4>
                            <hr/>
                                {{csrf_field()}}
                                <div class="form-group" {!!$digital == 1 ? 'style="display:none;"' : ''!!}>
                                    <select class="form-control" onchange="sHipping(this)" id="shipop" name="shipping" hidden required="">
                                        <option value="shipto" selected="">{{$lang->ships}}</option>
                                        <option value="pickup">{{$lang->pickup}}</option>
                                    </select>
                                </div>

                                <div id="pick" style="display:none;">
                                    <div class="form-group">
                                        <select class="form-control" name="pickup_location">
                                            <option value="">{{$lang->pickups}}</option>
                                            @foreach($pickups as $pickup)
                                            <option value="{{$pickup->location}}">{{$pickup->location}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if(Auth::guard('user')->check())
                                    @php
                                        $user = Auth::guard('user')->user();
                                    @endphp
                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->fname}} <span>*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="{{$lang->fname}}" required="">

                                    </div>
                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->doph}}  <span>*</span></label>
                                        <input type="number" class="form-control" name="phone" value="{{$user->phone}}" placeholder="{{$lang->doph}} " required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->doeml}} <span>*</span></label>
                                        <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="{{$lang->doeml}} " required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="shippingFull_name">PAN Number </label>
                                        <input type="text" class="form-control" name="pan_number" value="{{$user->pan_vat}}" placeholder="PAN Number" >
                                    </div>
                                    <div class="form-group">
                                        <label>Address Type  <span>*</span></label>
                                        <select class="form-control" name="address_type" required>
                                            <option value="" {{ !$user->address_type ? 'selected' : '' }} disabled>Select an option</option>
                                            <option value="Home" {{ $user->address_type == 'Home' ? 'selected' : '' }}>Home</option>
                                            <option value="Office" {{ $user->address_type == 'Office' ? 'selected' : '' }}>Office</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="geolocation">{{$lang->doad}} <i style="color:red;">(Delivery Within Nepal)</i> <span>*</span> </label>
                                        <input placeholder="{{$lang->doad}} " class="form-control" name="address" id="geolocation" style="resize: vertical;" required value="{{$user->address}}" onclick="$('#model-type').val('');$('.locationModal').modal('show');" autocomplete="off" />
                                        <input id="latlong" type="hidden" name="latlong" value="{{$user->latlong}}">

                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Nearest LandMark  <span>*</span></label>
                                        <textarea placeholder="Nearest LandMark" class="form-control" name="landmark" cols="30" rows="2" style="resize: vertical;" required>{{$user->nearest_landmark}}</textarea>
                                    </div> --}}

                                    {{-- <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->doct}}  <span>*</span></label>
                                        <input type="text" class="form-control" name="city" value="{{$user->city}}" placeholder="{{$lang->doct}} " required="">
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->ctry}}  <span>*</span></label>
                                        <select class="form-control" required="" name="customer_country">
                                            <option value="Nepal" selected="selected">Nepal</option>
                                            {{-- <option value="" selected="selected" disabled>{{$lang->sctry}}</option> --}}
                                            {{-- @include('includes.countries') --}}
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->suph}} </label>
                                        <input type="text" class="form-control" name="zip" value="{{$user->zip}}" placeholder="Postal Code">
                                    </div> --}}

                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                @else
                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->fname}} <span>*</span></label>
                                        <input type="text" class="form-control" name="name" value="" placeholder="{{$lang->fname}}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->doph}}  <span>*</span></label>
                                        <input type="text" class="form-control" name="phone" value="" placeholder="{{$lang->doph}} " required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->doeml}}  <span>*</span></label>
                                        <input type="email" class="form-control" name="email" value="" placeholder="{{$lang->doeml}} " required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="shippingFull_name">PAN Number </label>
                                        <input type="text" class="form-control" name="pan_vat" value="" placeholder="PAN Number" >
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_addresss">Address Type  <span>*</span></label>
                                        <select class="form-control" name="address_type" required>
                                            <option value="" selected disabled>Select an option</option>
                                            <option value="Home">Home</option>
                                            <option value="Office">Office</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="geolocation">{{$lang->doad}}  <span>*</span> <i style="color:red;">(Delivery Within Nepal)</i></label>
                                        <input placeholder="{{$lang->doad}} " class="form-control" name="address" id="geolocation" style="resize: vertical;" onclick="$('#model-type').val('');$('.locationModal').modal('show');" autocomplete="off" />
                                        <input id="latlong" type="hidden" name="latlong" value="">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="shipping_addresss">Nearest LandMark  <span>*</span></label>
                                        <textarea placeholder="Nearest LandMark" class="form-control" name="landmark" id="shipping_addresss" cols="30" rows="2" style="resize: vertical;" required></textarea>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->doct}}  <span>*</span></label>
                                        <input type="text" class="form-control" name="city" value="" placeholder="{{$lang->doct}} " required="">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->ctry}}  <span>*</span></label>
                                        <select class="form-control" required="" name="customer_country">
                                            {{-- <option value="" disabled selected="selected">{{$lang->sctry}}</option>
                                            @include('includes.countries') --}}
                                            <option value="Nepal" selected="selected">Nepal</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="shippingFull_name">{{$lang->suph}}</label>
                                        <input type="text" class="form-control" name="zip" value="" placeholder="Postal Code">
                                    </div> --}}
                                    <input type="hidden" name="user_id" value="0">
                                @endif

                                <input type="hidden" id="shipping-cost" name="shipping_cost" value="{{round($shipping_cost * $curr->value,2)}}">
                                <input type="hidden" name="dp" value="{{$digital}}">
                                <input type="hidden" name="tax" value="{{$gs->tax}}">
                                <input type="hidden" name="totalQty" value="{{$totalQty}}">
                                <input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
                                <input type="hidden" name="coupon_code" id="coupon_code" value="">
                                <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
                                <input type="hidden" name="coupon_id" id="coupon_id" value="">
                                {{-- <div id="paypals">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="no_note" value="1">
                                    <input type="hidden" name="lc" value="UK">
                                    <input type="hidden" name="currency_code" value="{{$curr->name}}">
                                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
                                </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 colAuth-sm-12 col-xs-12" {!!$shipping_cost == 0 ? 'style="margin-top:0px;"' : ''!!}>

                        {{-- <div class="shipping-title" {!!$shipping_cost == 0 ? 'style="display:none;"' : ''!!} > --}}
                        @if(Auth::guard('user')->check())
                        <div class="shipping-title">
                            <span style="font-size:20px;">
                            {{$lang->shipss}}
                            </span>
                            <label class="form-check-inline u-check g-mr-20 mx-0 mb-0" id="ship-diff" style="top:-6px;">
                                <input class=" shippingCheck g-hidden-xs-up g-pos-abs g-top-0 g-right-0" name="shippingCheck" type="checkbox" value="check">
                                <div class="u-check-icon-radio-v7">
                                  <i class="fa" data-check-icon=""></i>
                                </div>
                              </label>


                            {{-- <label class="form-check-inline u-check g-mr-20 mx-0 mb-0" id="ship-diff">
                                <input class="shippingCheck " name="shippingCheck" type="checkbox" value="check"> {{$lang->shipss}}
                                <div class="u-check-icon-radio-v7">
                                    <i class="fa" data-check-icon=""></i>
                                  </div>
                            </label> --}}

                            <label id="pick-info" style="display: none;">
                                {{$lang->pickupss}}
                            </label>
                        </div>
                        <hr>
                        @endif

                        <div class="shipping-details-area" style="display: none;">
                            <div class="form-group">
                                <label for="shippingFull_name">{{$lang->fname}}  <span>*</span></label>
                                <input class="form-control" type="text" name="shipping_name" id="shippingFull_name" placeholder="{{$lang->fname}} ">
                            </div>
                            <div class="form-group">
                                <label for="shipingPhone_number">{{$lang->doph}}  <span>*</span></label>
                                <input class="form-control" type="number" name="shipping_phone" id="shipingPhone_number" placeholder="{{$lang->doph}} ">
                            </div>
                            <div class="form-group">
                                <label for="ship_email">{{$lang->doeml}}  <span>*</span></label>
                                <input class="form-control" type="email" name="shipping_email" id="ship_email" placeholder="{{$lang->doeml}} ">
                            </div>
                            <div class="form-group">
                                <label for="shippingFull_name">PAN Number </label>
                                <input type="text" class="form-control" name="shipping_pan_number" value="" placeholder="PAN Number">
                            </div>
                            <div class="form-group">
                                <label for="shipping_addresss">Address Type  <span>*</span></label>
                                <select class="form-control" name="shipping_address_type">
                                    <option value="" selected disabled>Select an option</option>
                                    <option value="Home">Home</option>
                                    <option value="Office">Office</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="shipping_geolocation">{{$lang->doad}}  <span>*</span> <i style="color:red;">(Delivery Within Nepal)</i></label>
                                <input placeholder="{{$lang->doad}} " class="form-control" name="shipping_address" id="shipping_geolocation" style="resize: vertical;" onclick="$('#model-type').val('shipping');$('.locationModal').modal('show');" autocomplete="off" />
                                <input id="shipping_latlong" type="hidden" name="shipping_latlong" value="">
                            </div>
                            {{-- <div class="form-group">
                                <label for="shipping_addresss">Nearest LandMark  <span>*</span></label>
                                <textarea placeholder="Nearest LandMark" class="form-control" name="shipping_landmark" id="shipping_addresss" cols="30" rows="2" style="resize: vertical;"></textarea>
                            </div> --}}
                            <div class="form-group">
                                <label for="shippingFull_name">{{$lang->ctry}}  <span>*</span></label>
                                <select class="form-control" name="shipping_country">
                                    {{-- <option value="" disabled selected="selected">{{$lang->sctry}}</option>  --}}
                                    <option value="Nepal" selected="selected">Nepal</option>
                                    {{-- @include('includes.countries') --}}
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="shipping_city">{{$lang->doct}}  <span>*</span></label>
                                <input class="form-control" type="text" name="shipping_city" id="shipping_city" placeholder="{{$lang->doct}} ">
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="shippingPostal_code">{{$lang->suph}}</label>
                                <input class="form-control" type="text" name="shipping_zip" id="shippingPostal_code" placeholder="{{$lang->suph}}">
                            </div> --}}
                        </div>
                        <div class="form-group">
                            <label for="order_notes">{{$lang->onotes}}</label>
                            <textarea class="form-control order-notes" name="order_notes" id="order_notes" cols="30" rows="5" style="resize: vertical;"></textarea>
                        </div>



                            <div class="form-group text-center">
                                <button id="proceed-payment" class="btn btn-md order-btn" type="submit" value="Proceed To Make Payment" style="border-radius:30px; font-weight:400;">Proceed To Make Payment  <span class="align-middle u-icon-v3 g-width-16 g-height-16 g-color-black g-bg-white g-font-size-11 rounded-circle ">
                                  <i class="fa fa-angle-right"></i>
                                </span> <i class="loading-icon fa fa-spinner fa-spin hide"></i> </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade locationModal" ng-app="locationSelector" ng-controller="LocationController" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="margin-top: 0;">
            <div class="modal-header text-center" style="border-bottom: none;padding-bottom: 0">
                <h4><strong>SET A LOCATION</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <h6 style="margin-left: 15px;">Drag the pin to your exact location</h6>
            <h6 style="margin-left: 15px;">Or, Simply type your address below.</h6>

            <div class="modal-body text-center">
                <input type="hidden" id="model-type" value="" />
                <div class="input-group g-pb-13 g-px-0 g-mb-10">

                    <input style="background-color:#d8f4ff !important;"
                      places-auto-complete size=80
                      types="['establishment']"
                      component-restrictions="{country:'np'}"
                      on-place-changed="placeChanged()"
                      id="googleLocation"
                      {{-- ng-model="address.Address" --}}
                      class="form-control g-brd-none g-brd-bottom g-brd-black g-brd-primary--focus g-color-black g-bg-transparent rounded-0" type="text" placeholder="Select Area" autocomplete="off">

                    <button class="btn  u-btn-neutral rounded-0" type="button" ng-click="getLocation()"><i class="fa fa-crosshairs"></i></button>
                </div>
                <p ng-if="error" style="color:red;text-align: left">@{{ error }}</p>

                <ng-map center="[27.7041765,85.3044636]" zoom="15" draggable="true">
                    <marker position="27.7041765,85.3044636" title="Drag Me!" draggable="true" on-dragend="dragEnd($event)"></marker>
                </ng-map>
            </div>
            <div class="modal-footer" style="border-top: none; text-align: center; display: block;">
              <button type="button" ng-disabled="!isValidGooglePlace" class="btn btn-primary" style="width:100%" ng-click="confirmLocation()">Confirm</button>
            </div>
          </div>
        </div>
    </div>

<!-- Ending of product shipping form -->

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">
  $('.category-multiple').select2({
    placeholder: 'Select a Prescription file'
  });
</script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
    <script src="/assets/front/js/ng-map.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&libraries=places"></script>
    <script src="/assets/front/js/location.js"></script>
    @if($user)
        <script>
            $('.selectFamily').select2({
                width: '100%'
            });
        </script>
    @endif

    @if(count($errors->checkoutForm) > 0)
        <script>
            $(document).ready(function(){
                $.notify("Please provide all the Information.","error");
            });

        </script>
    @endif
    <script type="text/javascript">

        $("#coupon").click( function () {
            val = $("#code").val();
            discount = parseFloat($("#coupon_discount").val());
            $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/coupon')}}",
                    data:{code:val},
                    success:function(data){
                        if(data == 0)
                        {
                            $.notify("{{$gs->no_coupon}}","error");
                            $("#code").val("");
                        }
                        else if(data == 2)
                        {
                            $.notify("{{$gs->coupon_already}}","error");
                            $("#code").val("");
                        }
                        else
                        {
                            var shipcost = parseFloat($("#shipping-cost").val());

                            $("#coupon_code").val(data[1]);
                            $("#coupon_id").val(data[3]);
                            $("#coupon_discount").val(data[2]);
                            $("#discount").show("slow");
                            $("#ds").html(data[2]);
                            var total = parseFloat($("#total-cost").html());
                            $('#total-cost').html((data[0]+shipcost).toFixed(2))
                            // $("#ftotal").show("slow");
                            $("#sign").html(data[4]);
                            var x = $("#shipop").val();
                            // var y = data[0];
                            // $("#ft").html(y.toFixed(2));
                            $("#grandtotal").val(y);
                            $.notify("{{$gs->coupon_found}}","success");
                            $("#code").val("");
                            // $("#coupon-click1").hide();
                            // $("#coupon-click2").show();

                        }
                    },
                    error: function(data){
                        if(data.responseJSON)
                            $.notify(data.responseJSON.error,"error");
                        else
                            $.notify('Something went wrong',"error");

                    }
            });
            return false;
        });
    </script>

    <script type="text/javascript">

        function sHipping(val) {
            var shipcost = parseFloat($("#ship-cost").html());
            var totalcost = parseFloat($("#total-cost").html());
            // var finalcost = parseFloat($("#ft").html());
            var total = 0;
            var ft = 0;
            // var ck = $("#ft").html();
            if (val.value == "shipto") {

                total = shipcost + totalcost;
                $("#pick").hide();
                $("#ship-diff").show();
                $("#pick-info").hide();
                $("#shipshow").show();
                $("#shipping-cost").val(shipcost);
                $("#total-cost").html(total);
                $("#grandtotal").val(total);
                $("#shipto").find("input").prop('required',true);
                $("#pick").find("select").prop('required',false);
            }

            if (val.value == "pickup") {

                total = totalcost - shipcost;
                $("#pick").show();
                $("#pick-info").show();
                $("#ship-diff").hide();
                $("#shipshow").hide();
                $("#shipping-cost").val('0');
                $("#total-cost").html(total.toFixed(2));
                $("#grandtotal").val(total.toFixed(2));
                $("#shipto").find("input").prop('required',false);
                $("#pick").find("select").prop('required',true);

            }
        }
        $(document).on('click','#coupon-click1',function(){
            $('.coupon-code .form').slideToggle();
        });
        $(document).on('click','#coupon-click2',function(){
            $('.coupon-code .form').slideToggle();
        });

        $(document).on('change','.shippingCheck',function(){
            if(this.checked) {
                $(".shipping-details-area").show();
            }
            else
            {
                $(".shipping-details-area").hide();

            }
        });


    </script>


    @if(isset($checked))
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#checkoutModal').modal('show');
        });

    </script>
    @endif

    <script type="text/javascript">

        // $(document).ready(function() {

        //  if (document.form.filename.value == "" && document.form.fileid.value="") {
        //     document.getElementById("textbox1").required = true;
        //   }
        // });



        $(document).ready(function() {





          $(".btn-success").click(function(){
              var html = $(".clone").html();
              $(".increment").after(html);
          });

          $("body").on("click",".btn-danger",function(){
              $(this).parents(".control-group").remove();
          });





});





      </script>
{{-- 
<script>
    var dropZoneId = "drop-zone";
      var buttonId = "clickHere";
      var mouseOverClass = "mouse-over";
    var dropZone = $("#" + dropZoneId);
     var inputFile = dropZone.find("input");
     var finalFiles = {};
    $(function() {



      var ooleft = dropZone.offset().left;
      var ooright = dropZone.outerWidth() + ooleft;
      var ootop = dropZone.offset().top;
      var oobottom = dropZone.outerHeight() + ootop;

      document.getElementById(dropZoneId).addEventListener("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.addClass(mouseOverClass);
        var x = e.pageX;
        var y = e.pageY;

        if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
          inputFile.offset({
            top: y - 15,
            left: x - 100
          });
        } else {
          inputFile.offset({
            top: -400,
            left: -400
          });
        }

      }, true);

      if (buttonId != "") {
        var clickZone = $("#" + buttonId);

        var oleft = clickZone.offset().left;
        var oright = clickZone.outerWidth() + oleft;
        var otop = clickZone.offset().top;
        var obottom = clickZone.outerHeight() + otop;

        $("#" + buttonId).mousemove(function(e) {
          var x = e.pageX;
          var y = e.pageY;
          if (!(x < oleft || x > oright || y < otop || y > obottom)) {
            inputFile.offset({
              top: y - 15,
              left: x - 160
            });
          } else {
            inputFile.offset({
              top: -400,
              left: -400
            });
          }
        });
      }

      document.getElementById(dropZoneId).addEventListener("drop", function(e) {
        $("#" + dropZoneId).removeClass(mouseOverClass);
      }, true);


      inputFile.on('change', function(e) {
        finalFiles = {};
        $('#filename').html("");
        var fileNum = this.files.length,
          initial = 0,
          counter = 0;

        $.each(this.files,function(idx,elm){
           finalFiles[idx]=elm;
        });

        for (initial; initial < fileNum; initial++) {
          counter = counter + 1;
          $('#filename').append('<div id="file_'+ initial +'"><span class="fa-stack fa-lg"><i class="fa fa-file fa-stack-1x "></i><strong class="fa-stack-1x" style="color:#FFF; font-size:12px; margin-top:2px;">' + counter + '</strong></span> ' + this.files[initial].name + '&nbsp;&nbsp;<span class="fa fa-times-circle fa-lg closeBtn" onclick="removeLine(this)" title="remove"></span></div>');
        }
      });



    })

    function removeLine(obj)
    {
      inputFile.val('');
      var jqObj = $(obj);
      var container = jqObj.closest('div');
      var index = container.attr("id").split('_')[1];
      container.remove();

      delete finalFiles[index];
  
    }

      </script> --}}

      <script>
        $(document).ready(function(){
          $("#proceed-payment").on("click", function(){
            var $this = $(this);
            $(".loading-icon").removeClass("hide");
            // $("#proceed-payment").attr("disabled", true);
            $(".btn-txt").text("Processing");
            setTimeout(function() {
              $(".loading-icon").addClass("hide");
            }, 2000);
          });
        });
        </script>
@endsection
