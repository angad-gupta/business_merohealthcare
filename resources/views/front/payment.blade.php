@extends('layouts.front')
@section('title','Proceed to Payment')
@section('content')

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

.hide{
    display:none;
}

.radio-tile-group {
  display: -webkit-box;
  display: flex;
  flex-wrap: wrap;
  -webkit-box-pack: center;
          justify-content: center;
}
.radio-tile-group .input-container {
  position: relative;
  height: 6rem;
  width: 6rem;
  margin: 0.5rem;

}
.radio-tile-group .input-container .radio-button {
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  margin: 0;
  cursor: pointer;
}
.radio-tile-group .input-container .radio-tile {
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-direction: column;
  -webkit-box-align: center;
          align-items: center;
  -webkit-box-pack: center;
          justify-content: center;
  width: 100%;
  height: 100%;
  border: 1px solid lightgray;
  border-radius: 10px;
  padding: 1rem;
  -webkit-transition: -webkit-transform 300ms ease;
  transition: -webkit-transform 300ms ease;
  transition: transform 300ms ease;
  transition: transform 300ms ease, -webkit-transform 300ms ease;
}
.radio-tile-group .input-container .icon svg {
  fill: #2385aa;
  width: 3rem;
  height: 3rem;
}
.radio-tile-group .input-container .radio-tile-label {
  text-align: center;
  font-size: 0.6rem;
  font-weight: 600;
  text-transform: capitalize;
  letter-spacing: 1px;
  color: gray;
}
.radio-tile-group .input-container .radio-button:checked + .radio-tile {
  background-color: #2385aa;
  border: 2px solid #2385aa;
  color: white;
  -webkit-transform: scale(1.1, 1.1);
          transform: scale(1.1, 1.1);
}
.radio-tile-group .input-container .radio-button:checked + .radio-tile .icon svg {
  fill: white;
  background-color: #2385aa;
}
.radio-tile-group .input-container .radio-button:checked + .radio-tile .radio-tile-label {
  color: white;
  background-color: #2385aa;
}

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
    .box{

        padding: 20px;
        display: none;
        margin-top: 20px;
    }
    .Cash{ background: #f7f7f7 }

    @media (min-width: 1200px){
    .container {
        max-width: 1168px;
        }
    }

</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.css">


 <!-- Starting of checkOut area -->
    @php
        $user = $order->user;
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $products = $cart->items;
    @endphp
    <div>

        <div class="section-padding product-checkOut-wrap" style="padding-top:10px;">
            <div class="container">
              <header class="g-mb-20">
                <div class="u-heading-v6-2 text-uppercase ">
                  <h2 class="h4 g-font-weight-300 g-font-size-20 btn btn-primary"><i class="icon-finance-260 u-line-icon-pro"></i> Payment</h2>
                </div>
              </header>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                  
                        <div class="g-overflow-x-scroll g-overflow-x-visible--lg">
                            <table class="text-center w-100">
                              <thead class="h6 g-brd-bottom g-brd-gray-light-v3 g-color-black">
                                <tr>
                                  <th class="g-font-weight-600 text-left g-pb-20">Product Name</th>
                                  <th class="g-font-weight-600 g-width-80 g-pb-20">Unit Price</th>
                                  <th class="g-font-weight-600 g-width-50 g-pb-20">Qty</th>
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

                                $price = $product['item']['pprice'] ? $product['item']['pprice']: $product['item']['cprice'];
                                $vat = App\Product::findORFail($product['item']['id']);

                            @endphp
                                <tr class="g-brd-bottom g-brd-gray-light-v3">
                                  <td class="text-left g-py-5 g-px-5">
                                    <img class="d-inline-block g-width-100 mr-4" src="{{asset('assets/images/'.$product['item']['photo'])}}" alt="{{ $product['item']['name'] }}">
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
                                        //   $vat_price = $product['price'] - $coupon_dis->price * $curr->value;
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
                          </div>




                          <div class="container" style="margin-bottom:20px;" id="billDetail">
                        <h4 class="signIn-title" style="margin-top: 10px">{{$lang->bdetails}}</h4>
                        <span>{{ $order->customer_name }}</span><br>
                        <span>{{ $order->customer_email }}</span><br>
                        <span>{{ $order->customer_phone }}</span><br>
                        {{-- <span>{{ $order->customer_landmark }}</span><br> --}}
                        <span>{{ $order->customer_address }}</span><br>
                        {{-- <span>{{ $order->customer_city }}</span><br> --}}
                        <span>{{ $order->customer_country }}</span><br>
                          </div>
                    </div>

                    @php
                        $esewa = App\PaymentGateway::where('title','=','Esewa')->get();
                        $khalti = App\PaymentGateway::where('title','=','Khalti')->get();
                        $fonepay = App\PaymentGateway::where('title','=','FonePay')->get();
                        $imepay = App\PaymentGateway::where('title','=','IMEPay')->get();
                        $iPay = App\PaymentGateway::where('title','=','iPay')->first();
                    @endphp


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                        <div class="g-bg-gray-light-v5 g-pa-20 g-pb-20 mb-4" style="border-radius:20px;">
                            <h4 class="h6 text-uppercase mb-3 g-font-weight-600">Order Summary</h4>
                            <hr/>
                            <div class="d-flex justify-content-between mt-2">
                              <span class="g-color-black">Subtotal</span>
                              <span class="g-color-black g-font-weight-300">{{$curr->sign}} {{round(($order->pay_amount + $priceDiscount + $order->coupon_discount - $order->shipping_cost)* $curr->value,2)}}</span>
                            </div>
                            @if($priceDiscount > 0)
                                <div class="d-flex justify-content-between">
                                    <span class="g-color-black">Price Discount</span>
                                    <span class="g-color-black g-font-weight-300"> - {{$order->currency_sign}}<span>{{ $priceDiscount }}</span></span>
                                </div>
                            @endif


                            @if($order->coupon_code)

                                @php
                                    $coupon_code = App\Coupon::where('code',$order->coupon_code)->first();
                                    $sign = App\Currency::where('is_default','=',1)->first();
                                @endphp

                              <div class="d-flex justify-content-between" id="discount">
                                <span class="g-color-black"> {{$lang->ds}} (<span id="sign">{{ $order->coupon_code }} {{$coupon_code->type == 0 ? $coupon_code->price . "%" : $sign->sign . round(($coupon_code->price * $sign->value), 2) }}</span>)</span>
                                <span class="g-color-black g-font-weight-300"> - {{$order->currency_sign}}<span id="ds">{{ $order->coupon_discount }}</span></span>
                              </div>

                            @endif


                              @if($order->shipping_cost > 0)
                              <div class="d-flex justify-content-between" >
                                <span class="g-color-black">Delivery Charge</span>
                                <span class="g-color-black g-font-weight-300"> {{$order->currency_sign}}<span id="ship-cost">{{round($order->shipping_cost * $order->currency_value,2)}}</span>
                              </div>
                              @endif

                            <div class="d-flex justify-content-between">
                              <span class="g-color-black">Grand Total</span>
                              <span class="g-color-black g-font-weight-700 coupon-td"> {{$order->currency_sign}}<span id="total-cost">{{round($order->pay_amount * $order->currency_value ,2)}}</span></span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span class="g-color-black">Taxable Amount</span>
                                <span class="g-color-black g-font-weight-700 coupon-td"> {{$curr->sign}}<span id="">{{round((($vat_sum)/1.13) * $curr->value,2)}}</span></span>
                              </div>

                              <div class="d-flex justify-content-between">
                                <span class="g-color-black">VAT({{$gs->vat}}%)</span>
                                <span class="g-color-black g-font-weight-700 coupon-td"> {{$curr->sign}}<span id="">{{round((($vat_sum)/1.13) * 0.13 * $curr->value,2)}}</span></span>
                              </div>

                          </div>


                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="">
                        <h4 class="signIn-title text-center" >Payment Options</h4>

                        <div class="container" style="border-radius:30px;">
                            <div class="radio-tile-group" name="method" id="paymentMethod" >
                                {{-- <div class="input-container">
                                    <input id="Cash" class="radio-button" type="radio" name="radio" value="Cash" />
                                    <div class="radio-tile">
                                      <div class="icon walk-icon">

                                        <img style="width:40px" src="https://www.chemstar.com/wp-content/uploads/2017/09/service-round-icon-02-delivery.png"/>
                                      </div>
                                      <label for="cod" class="radio-tile-label" >Cash On Delivery</label>
                                    </div>
                                  </div> --}}

                                  <div class="input-container">
                                    <input id="Bank" class="radio-button" type="radio" name="radio" value="Bank" />
                                    <div class="radio-tile">
                                      <div class="icon walk-icon">
                                        <img style="width:40px" src="http://icons.iconarchive.com/icons/graphicloads/folded/256/bank-folded-icon.png"/>
                                      </div>
                                      <label for="cod" class="radio-tile-label">Bank </label>
                                    </div>
                                </div>

                            @if($khalti[0]->status == '1')
                              <div class="input-container">
                                <input id="walk" class="radio-button" type="radio" name="radio" value="Khalti" />
                                <div class="radio-tile">
                                  <div class="icon walk-icon">

                                    <img style="width:40px" src="https://lh3.googleusercontent.com/vtoxj9t4UWl6qxWUPGpv7ndJuJs_W3UTnQYpBwJ7xBMuRJ2TE6d71NrwWU6Nkbq0Zs8"/>
                                  </div>
                                  <label for="walk" class="radio-tile-label">Khalti</label>
                                </div>
                              </div>
                            @endif

                            @if($esewa[0]->status == '1')
                              <div class="input-container">
                                <input id="bike" class="radio-button" type="radio" name="radio" value="Esewa"/>
                                <div class="radio-tile">
                                  <div class="icon bike-icon">
                                    <img style="width:40px" src="https://myngch.com/frontend/assets/images/esewa_logo.png"/>
                                  </div>
                                  <label for="bike" class="radio-tile-label">E-sewa</label>
                                </div>
                              </div>
                            @endif

                            @if($fonepay[0]->status == '1')
                              <div class="input-container">
                                <input id="drive" class="radio-button" type="radio" name="radio" value="FonePay"/>
                                <div class="radio-tile">
                                  <div class="icon car-icon">
                                    <img style="width:40px" src="https://media-exp1.licdn.com/dms/image/C510BAQE-gVAYFB4FUg/company-logo_200_200/0?e=2159024400&v=beta&t=oJy0sDDwzrx3cH5KCmGMYsy7FotUix4drGCTJX4kfAA"/>
                                  </div>
                                  <label for="drive" class="radio-tile-label">fone pay</label>
                                </div>
                              </div>
                              @endif

                              @if($imepay[0]->status == '1')
                              <div class="input-container">
                                <input id="fly" class="radio-button" type="radio" name="radio" value="IMEPay" />
                                <div class="radio-tile">
                                  <div class="icon fly-icon">
                                    <img src="https://www.merohealthcare.com/assets/images/1597057079117688840_355124495888664_8627824190237150414_n.jpg"/>
                                  </div>
                                  <label for="fly" class="radio-tile-label">IME Pay</label>
                                </div>
                              </div>
                              @endif

                              @if($iPay->status)
                              <div class="input-container">
                                <input id="iPay" class="radio-button" type="radio" name="radio" value="iPay" />
                                <div class="radio-tile">
                                  <div class="icon fly-icon">
                                    <img src="https://www.merohealthcare.com/assets/images/1599126542107-1079686_transparent-visa-mastercard-png-visa-and-mastercard-logo.png"/>
                                  </div>
                                  <label for="iPay" class="radio-tile-label">iPay</label>
                                </div>
                              </div>
                              @endif
                            </div>
                          </div>





{{--
                        @if($product['item']['requires_prescription'])
                        <div class="form-group">
                            <label>{{$lang->cup}} <span>*</span></label>
                            <select name="method" id="paymentMethod" class="form-control" required="">
                                <option value="" disabled selected="">{{$lang->cup}}</option> --}}
                                {{-- @if($gs->pcheck != 0)
                                    <option value="Paypal" discount="0">{{$lang->pp}}</option>
                                @endif
                                @if($gs->scheck != 0)
                                    <option value="Stripe" discount="0">{{$lang->app}}</option>
                                @endif --}}
                                {{-- @if($gs->ccheck != 0)
                                    <option value="Cash" discount="0">{{$lang->dolpl}}</option>
                                @endif --}}

                                {{-- @foreach($gateways as $gt)
                                    <option value="{{$gt->title}}" discount="{{ $gt->discount }}">
                                        {{$gt->title}} {{ $gt->discount > 0 ? '('.$gt->discount_text.')' : ''}}
                                    </option>
                                @endforeach --}}
{{--
                            </select>

                            <div class="Cash box" >
                                 <h4 >Get Discounts on online Payment </h4>
                                 <br/>
                                 <img src="https://blog.khalti.com/wp-content/uploads/2019/09/%E0%A4%A0%E0%A5%82%E0%A4%B2%E0%A5%8B-%E0%A4%A6%E0%A4%B6%E0%A5%88%E0%A4%81%E0%A4%95%E0%A5%8B-%E0%A4%A0%E0%A5%82%E0%A4%B2%E0%A5%8B-%E0%A4%A7%E0%A4%AE%E0%A4%BE%E0%A4%95%E0%A4%BE_Order-online-at-thulo.com-and-pay-with-Khalti-and-get-cashback-instantly.jpg" style="height:120px;"/>
                                 <img src="https://www.agmwebhosting.com/blog/wp-content/uploads/2020/01/Instant-cashback-blog-740x414.png" style="height:120px;"/>
                                 <img src="https://www.offerayo.com/wp-content/uploads/2019/09/miniso-10_-3-outlets-fonepay.png" style="height:120px;"/>
                            </div>
                        </div>

                        @else --}}


                            {{-- <label>{{$lang->cup}} <span>*</span></label> --}}
                            {{-- <select name="method" id="paymentMethod" class="form-control" required="">
                                <option value="" disabled selected="">{{$lang->cup}}</option> --}}
                                {{-- @if($gs->pcheck != 0)
                                    <option value="Paypal" discount="0">{{$lang->pp}}</option>
                                @endif
                                @if($gs->scheck != 0)
                                    <option value="Stripe" discount="0">{{$lang->app}}</option>
                                @endif --}}
                                {{-- @if($gs->ccheck != 0)
                                    <option value="Cash" discount="0">{{$lang->dolpl}}</option>
                                @endif

                                @foreach($gateways as $gt)
                                    <option value="{{$gt->title}}" discount="{{ $gt->discount }}">
                                        {{$gt->title}} {{ $gt->discount > 0 ? '('.$gt->discount_text.')' : ''}}
                                    </option>
                                @endforeach

                            </select>
                         --}}

                         <div id="gateway" style="display: none;"></div>

                        <div class="text-center" style="margin-top: 20px;">
                            <div class="form-group">
                                <button class="btn btn-md order-btn"  id="pay-btn" type="button" disabled title="Proceed to make Purchase" style="border-radius:30px;"><i class="icon-check"></i> <span class="btn-txt"> Proceed</span> <i class="loading-icon fa fa-spinner fa-spin hide"></i></button>
                            </div>

                        </div>

                        <div class="Bank box" style="background: white;" id="scrollto" >
                          <div class="col-md-6">
                          <img src="https://www.merohealthcare.com/assets/images/1600940568Screen%20Shot%202020-09-24%20at%2015.27.06.png"/>
                          </div>
                          <div class="col-md-6">
                          <h6 style="font-weight:700; ">Please deposit the amount in bank details given below </h6>


                            <li class="media g-brd-around g-brd-gray-light-v4 g-pa-20 g-mb-minus-1" style="border-radius:30px;">
                               <div class="d-flex g-mt-2 g-mr-15">
                                 <img class="g-width-75 g-height-80 " src="https://www.collegenp.com/uploads/2018/12/Sanima-Bank.jpg" alt="Image Description">
                               </div>
                               <div class="media-body" >
                                 <div class="d-flex justify-content-between">
                                   <strong class="g-color-teal">Sanima Bank</strong>
                                   {{-- <span class="align-self-center small text-nowrap g-color-lightred">56 min ago</span> --}}
                                 </div>
                                 <span class="d-block"><strong>Account name : </strong> Web Health Company Pvt Ltd</span>
                                 <span class="d-block"><strong>AC. No.</strong> 909010020000028</span>
                                 <span class="d-block"><strong>Branch : </strong> Head Office</span>
                               </div>
                             </li>

                             <div class="container" style="margin-top:10px;">

                              <p><b>Payment Ways:</b><br/>1. Pay through online bank transfer. <br/>2. Or, Bank voucher deposit to nearest branch.</p>
                              <i><b>Note: Show your transfer/voucher receipt after the delivery.</b></i>
                             </div>
                          </div>

                       </div>


                            {{-- <div class="Cash box" >
                                 <h6 style="font-weight:700;">Get Discounts on online Payment </h6>
                                 <br/>



                                  <div class="row">
                                    <div class="col-md-4 g-mb-30">
                                      <a class="js-fancybox" href="javascript:;" data-fancybox="lightbox-gallery" data-src="https://blog.khalti.com/wp-content/uploads/2019/09/Dashain-Bela-Sastodeal-Mela-in-association-with-Khalti_Pay-via-Khalti.png" data-caption="Lightbox Gallery" data-speed="500" data-is-infinite="true" data-slideshow-speed="5000">
                                        <img class="img-fluid" src="https://blog.khalti.com/wp-content/uploads/2019/09/Dashain-Bela-Sastodeal-Mela-in-association-with-Khalti_Pay-via-Khalti.png" alt="Image Description">
                                      </a>
                                    </div>

                                    <div class="col-md-4 g-mb-30">
                                      <a class="js-fancybox" href="javascript:;" data-fancybox="lightbox-gallery" data-src="https://www.agmwebhosting.com/blog/wp-content/uploads/2020/01/Instant-cashback-blog-740x414.png" data-caption="Lightbox Gallery" data-is-infinite="true" data-slideshow-speed="5000">
                                        <img class="img-fluid" src="https://www.agmwebhosting.com/blog/wp-content/uploads/2020/01/Instant-cashback-blog-740x414.png" alt="Image Description">
                                      </a>
                                    </div>

                                    <div class="col-md-4 g-mb-30">
                                      <a class="js-fancybox" href="javascript:;" data-fancybox="lightbox-gallery" data-src="https://techlekh.com/wp-content/uploads/2019/06/payment-partners.png" data-caption="Lightbox Gallery" data-speed="500" data-is-infinite="true" data-slideshow-speed="5000">
                                        <img class="img-fluid" src="https://techlekh.com/wp-content/uploads/2019/06/payment-partners.png" alt="Image Description">
                                      </a>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-4 g-mb-30">
                                      <a class="js-fancybox" href="javascript:;" data-fancybox="lightbox-gallery" data-src="https://i.pinimg.com/originals/2f/53/c3/2f53c3f763a609b56f901b8af2b3133a.png" data-caption="Lightbox Gallery" data-speed="500" data-is-infinite="true" data-slideshow-speed="5000">
                                        <img class="img-fluid" src="https://i.pinimg.com/originals/2f/53/c3/2f53c3f763a609b56f901b8af2b3133a.png" alt="Image Description">
                                      </a>
                                    </div>
                                    <div class="col-md-4 g-mb-30">
                                        <a class="js-fancybox" href="javascript:;" data-fancybox="lightbox-gallery" data-src="https://i2.wp.com/techsathi.com/wp-content/uploads/2019/05/IME-Pay-Reward-Points.jpg?fit=2763%2C1672&ssl=1" data-caption="Lightbox Gallery" data-speed="500" data-is-infinite="true" data-slideshow-speed="5000">
                                          <img class="img-fluid" src="https://i2.wp.com/techsathi.com/wp-content/uploads/2019/05/IME-Pay-Reward-Points.jpg?fit=2763%2C1672&ssl=1" alt="Image Description">
                                        </a>
                                      </div>


                                  </div>


                            </div> --}}


                        {{-- @endif
                             --}}

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bank Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="https://www.merohealthcare.com/assets/images/1600940568Screen%20Shot%202020-09-24%20at%2015.27.06.png"/>
            <h6 style="font-weight:700; ">Please deposit the amount in bank details given below </h6>


            <li class="media g-brd-around g-brd-gray-light-v4 g-pa-20 g-mb-minus-1" style="border-radius:15px;">
               <div class="d-flex g-mt-2 g-mr-15">
                 <img class="g-width-75 g-height-80 " src="https://www.collegenp.com/uploads/2018/12/Sanima-Bank.jpg" alt="Image Description">
               </div>
               <div class="media-body" >
                 <div class="d-flex justify-content-between">
                   <strong class="g-color-teal">Sanima Bank</strong>
                   {{-- <span class="align-self-center small text-nowrap g-color-lightred">56 min ago</span> --}}
                 </div>
                 <span class="d-block"><strong>Account name : </strong> Web Health Company Pvt Ltd</span>
                 <span class="d-block"><strong>AC. No.</strong> 909010020000028</span>
                 <span class="d-block"><strong>Branch : </strong> Head Office</span>

               </div>
             </li>
             <div class="container" style="margin-top:10px;">

              <p><b>Payment Ways:</b><br/>1. Pay through online bank transfer. <br/>2. Or, Bank voucher deposit to nearest branch.</p>
              <i><b>Note: Show your transfer/voucher receipt after the delivery.</b></i>
             </div>



          </div>
          <div class="text-center" style="padding:10px;">
            <button type="button" class="btn btn-primary btn-block text-center" data-dismiss="modal">Got It</button>

          </div>
        </div>
      </div>
    </div>



<!-- Ending of product shipping form -->

@endsection

@section('scripts')
    <script src="https://khalti.com/static/khalti-checkout.js"></script>

    <script>
      $('input[name="radio"]').change(function() {
   if($(this).is(':checked') && $(this).val() == 'Bank') {
           $('#myModal').modal('show');
   }
});

// $(document).ready(function () {

//     $('html, body').animate({
//         scrollTop: $('#billDetail').offset().top
//     }, 'slow');
// });
    </script>

    <script type="text/javascript">
        var total = {{ $order->pay_amount }};
        var id = '{{ $order->order_number }}';
        // var discount = option.attr('discount');
        // $('#total-cost').html((total - discount).toFixed(2))
        $("#paymentMethod").on('click',function(){

            var option = $('input[name="radio"]:checked', this);
            var discount = option.attr('discount');
            var gateway = option.val();

            // $('#total-cost').html((total - discount).toFixed(2))
            $('#pay-btn').attr('disabled','disabled');

            if(discount > 0){

                $("#gatewaydiscount").show("slow");
                $("#gatewayds").text(discount);

            }else{
                $("#gatewaydiscount").hide();

                $("#gatewayds").text(0);
            }

            // $('#total-cost').html((total - discount).toFixed(2))

            if(gateway == 'Bank'){
                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');


                var btn = document.getElementById("pay-btn");
                btn.onclick = function (e) {
                    e.preventDefault();
                    var form = '<form action="/checkout/{{$order->order_number}}/gateway/bank" method="POST">{{ csrf_field() }}</form>';
                    $(form).appendTo('body').submit();
                }
                return;
            }
            else if(gateway == 'Cash'){
                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');


                var btn = document.getElementById("pay-btn");
                btn.onclick = function (e) {
                    e.preventDefault();
                    var form = '<form action="/checkout/{{$order->order_number}}/gateway/cod" method="POST">{{ csrf_field() }}</form>';
                    $(form).appendTo('body').submit();
                }
                return;
            }
            else if(gateway == 'FonePay'){
                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');

                var btn_fonepay = document.getElementById("pay-btn");
                btn_fonepay.onclick = function (e) {
                    e.preventDefault();
                    $('#pay-btn').attr('disabled','disabled');

                    $('#overlay').css('display','block');
                    $.ajax({
                        type: "POST",
                        url:"/checkout/"+id+"/gateway/fonepay",
                        data:{_token: "{{ csrf_token() }}"},
                        success:function(result){
                            location.href = result.url;
                            $('#pay-btn').removeAttr('disabled');
                        },
                        error: function(data){
                            $('#pay-btn').removeAttr('disabled');

                            $.notify("Something went wrong.","error");
                        }
                    });
                }
            }
            else if(gateway == 'Esewa'){

                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');

                var btn_esewa = document.getElementById("pay-btn");
                btn_esewa.onclick = function (e) {
                    e.preventDefault();
                    $('#overlay').css('display','block');
                    $('#pay-btn').attr('disabled','disabled');

                    $.ajax({
                        type: "POST",
                        url:"/checkout/"+id+"/gateway/esewa",
                        data:{_token: "{{ csrf_token() }}"},
                        success:function(result){
                            var html = '<form action="'+result.url+'" method="POST">'+
                                    '  <input type="hidden" name="tAmt" value="'+result.tAmt+'">'+
                                    '  <input type="hidden" name="amt" value="'+result.amt+'">'+
                                    '  <input type="hidden" name="txAmt" value="'+result.txAmt+'">'+
                                    '  <input type="hidden" name="psc" value="'+result.psc+'">'+
                                    '  <input type="hidden" name="pdc" value="'+result.pdc+'">'+
                                    '  <input type="hidden" name="scd" value="'+result.scd+'">'+
                                    '  <input type="hidden" name="pid" value="'+result.pid+'">'+
                                    '  <input type="hidden" name="su" value="'+result.su+'">'+
                                    '  <input type="hidden" name="fu" value="'+result.fu+'">'+
                                    '</form>';

                            jQuery(html).appendTo('body').submit();
                            $('#pay-btn').removeAttr('disabled');
                        },
                        error: function(data){
                            $('#pay-btn').removeAttr('disabled');

                            $.notify("Something went wrong.","error");
                        }
                    });
                }
            }
            else if(gateway == 'IMEPay'){
                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');

                var btn_imepay = document.getElementById("pay-btn");
                btn_imepay.onclick = function (e) {
                    e.preventDefault();
                    $('#overlay').css('display','block');
                    $('#pay-btn').attr('disabled','disabled');

                    $.ajax({
                        type: "POST",
                        url:"/checkout/"+id+"/gateway/imepay",
                        data:{_token: "{{ csrf_token() }}"},
                        success:function(result){
                            var html = '<form action="'+result.url+'" method="POST">'+
                                    '  <input type="hidden" name="TokenId" value="'+result.TokenId+'">'+
                                    '  <input type="hidden" name="MerchantCode" value="'+result.MerchantCode+'">'+
                                    '  <input type="hidden" name="RefId" value="'+result.RefId+'">'+
                                    '  <input type="hidden" name="TranAmount" value="'+result.TranAmount+'">'+
                                    '  <input type="hidden" name="Method" value="'+result.Method+'"></input>'+
                                    '  <input type="hidden" name="RespUrl" value="'+result.RespUrl+'"></input>'+
                                    '  <input type="hidden" name="CancelUrl" value="'+result.CancelUrl+'"></input>'+
                                    '</form>';
                            jQuery(html).appendTo('body').submit();
                            $('#pay-btn').removeAttr('disabled');
                        },
                        error: function(data){
                            $('#pay-btn').removeAttr('disabled');

                            $.notify("Something went wrong.","error");
                        }
                    });
                }
            }
            else if(gateway == 'Khalti'){
                $.ajax({
                    type: "POST",
                    url:"/checkout/"+id+"/gateway/khalti",
                    data:{_token: "{{ csrf_token() }}"},
                    success:function(data){
                        $('#gateway').html(data);
                        $("#gateway").show();
                        $('#pay-btn').removeAttr('disabled');
                    },
                    error: function(data){
                        $('#gateway').html('');
                        $.notify("Something went wrong.","error");
                    }
                });
            }
            else if(gateway == 'iPay'){
                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');


                var btn = document.getElementById("pay-btn");
                btn.onclick = function (e) {
                    e.preventDefault();
                    var form = '<form action="/checkout/{{$order->order_number}}/gateway/card" method="POST">{{ csrf_field() }}</form>';
                    $(form).appendTo('body').submit();
                }
                return;
            }
            else
                $.notify('Select a valid payment gateway.','error')
        });

        var showErrors=function(response){


            if(response.message){
                $.notify(response.message,"error");
            }
            else if(response.error){
                $.notify(response.error,"error");
            }
        }

    </script>

<script>
    // $(document).ready(function(){
    //     $("select").change(function(){
    //         $(this).find("option:selected").each(function(){
    //             var optionValue = $(this).attr("value");
    //             if(optionValue){
    //                 $(".box").not("." + optionValue).hide();
    //                 $("." + optionValue).show();
    //             } else{
    //                 $(".box").hide();
    //             }
    //         });
    //     }).change();
    // });


    $(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
    </script>

         <!-- JS Implementing Plugins -->
         <script  src="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.js"></script>

         <!-- JS Unify -->
         <script  src="/frontend-assets/main-assets/assets/js/components/hs.popup.js"></script>

         <!-- JS Plugins Init. -->
         <script >
           $(document).on('ready', function () {
             // initialization of popups
            //  $.HSCore.components.HSPopup.init('.js-fancybox');
           });
         </script>

<script>
    $(document).ready(function(){
      $(".order-btn").on("click", function(){
        $(".loading-icon").removeClass("hide");
        $(".order-btn").attr("disabled", true);
        $(".btn-txt").text("Processing");
      });
    });
    </script>

    <script>
      $('input:radio[name="radio"]').on('change.firstChange',
    function () {
        $('#changes')[0].innerHTML += 'first ';
        $('input:radio[name="radio"]').off('change.firstChange');
        $('html, body').animate({
            scrollTop: $("#scrollto").offset().top
        }, 1500);
    }
);
$('input:radio[name="radio"]').on('change.allChanges',
    function () {
        $('#changes')[0].innerHTML += 'changed ';
    }
);
      </script>
@endsection

