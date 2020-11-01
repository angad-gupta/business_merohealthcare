@extends('layouts.front')
@section('title','Proceed to Payment - Lab')
@section('content')
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/animate.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/custombox/custombox.min.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/progress-wizard.min.css">

<style>
    @media only screen and (max-width: 768px){
    #lab{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: transparent !important;
    padding: 2px 15px !important;
    border-radius: 30px !important;

  }

  #lab-mobile{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;

  }
  .header-middle-right-wrap li a {
    border-color: transparent !important;
    color: #ffffff;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}
.header-middle-right-wrap li:first-child a {
    padding: 0 0px 0 0;
}

}

     #lab{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;

  }
    .section-padding {
        padding: 20px 0;
    }
        .select2-selection__rendered{

        height:35px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 9px !important;
        right: 1px;
        width: 20px;
    }
    .select2-selection__arrow{
        height:35px !important;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px !important;
        user-select: none;
        -webkit-user-select: none;
    }
    .section-padding.product-shoppingCart-wrapper .table>tbody>tr>td {
        padding: 10px 0;
        vertical-align: middle;
        color: #555;
        font-size: 16px;
        border: none;
        text-align: left;
    }
    .section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
        padding: 30px 0px;
        text-align: left;
        color: #333;
    }

    .section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
        padding: 15px 0px;
        text-align: left;
        color: #333;
    }
    .product-shoppingCart-wrapper .table>tfoot>tr>td {
        padding: 10px 0;
    }
</style>
<style>
    .section-padding {
        padding: 20px 0;
    }
        .select2-selection__rendered{

        height:35px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 9px !important;
        right: 1px;
        width: 20px;
    }
    .select2-selection__arrow{
        height:35px !important;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px !important;
        user-select: none;
        -webkit-user-select: none;
    }
    .section-padding.product-shoppingCart-wrapper .table>tbody>tr>td {
        padding: 10px 0;
        vertical-align: middle;
        color: #555;
        font-size: 16px;
        border: none;
        text-align: left;
    }
    .section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
        padding: 30px 0px;
        text-align: left;
        color: #333;
    }

    .section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
        padding: 15px 0px;
        text-align: left;
        color: #333;
    }
    .product-shoppingCart-wrapper .table>tfoot>tr>td {
        padding: 10px 0;
    }

    p {
    margin-top: 0;
    margin-bottom: 0rem;
}
</style>

<style>



    .radio-tile-group {
      display: -webkit-box;
      display: flex;
      flex-wrap: wrap;
      -webkit-box-pack: center;
              justify-content: center;
    }
    .radio-tile-group .input-container {
      position: relative;
      height: 7rem;
      width: 7rem;
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
      border: 1px solid #2385aa;
      border-radius: 5px;
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
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #2385aa;
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

        .section-padding.product-shoppingCart-wrapper img {
    height: auto;
    max-width: 100%;
}

@media (min-width: 768px){
.u-info-v9-1::before {
    position: absolute;
    top: 75px;
    left: 17%;
    width: 66%;
    border-top: 1px dotted #ddd;
    content: " ";
}
}
.progress-indicator>li.completed .bubble, .progress-indicator>li.completed .bubble:after, .progress-indicator>li.completed .bubble:before {
    background-color: #2385aa;
    border-color: #2385aa;
}
.progress-indicator>li.completed, .progress-indicator>li.completed .bubble {
    color: #2385aa;
}

    </style>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.css">


<div class="section-padding product-shoppingCart-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 g-mb-20">
                <div class="view-cart-title pull-right">
                    <a style="color:black;" href="{{route('lab.index')}}"><i class="icon-home"></i>{{ucfirst(strtolower($lang->home))}}</a>
                    <i class="fa fa-angle-right"></i>
                    <a style="color:black;" href="{{route('lab.cart')}}">Lab Test</a>
                    <i class="fa fa-angle-right"></i>
                    <a style="color:black;" href="{{route('lab.checkout')}}">Checkout</a>
                    <i class="fa fa-angle-right"></i>
                    <a style="color:black;" >Payment</a>
                </div>
                @include('includes.form-success')

            </div>

            <div class="col-md-4 col-sm-12">

                <label class="d-block g-font-size-20" style="text-transform:uppercase;font-weight:600;">Order Number: {{ $order->order_number }}</label>
                <hr class="g-my-10">

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="4" style="color:#555;">{{$lang->cproduct}}</th>
                                <th style="color:#555;">{{$lang->cupice}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td colspan="4">
                                    <p class="product-name-header" style="font-size:14px;" title="{{ $product->test_name }}">{{strlen($product->test_name) > 30 ? substr($product->test_name,0,30).'...' : $product->test_name}}</a></p>

                                </td>

                                <td>
                                    @if($gs->sign == 0)
                                    <p class="product-name-header" style="font-size:14px;">&nbsp;&nbsp;{{$order->currency_sign}}{{ round($product->test_price * $order->currency_value, 2) }}</p>
                                    @else
                                        {{ round($product->test_price * $order->currency_value, 2) }}{{$order->currency_sign}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot style="background-color:#f3f3f3;">
                            <tr id="gatewaydiscount" style="display: none;">
                                <th colspan="4">Payment Gateway Discount:</th>
                                <th>
                                    @if($gs->sign == 0)
                                    - {{$order->currency_sign}}<span id="gatewayds">0</span>
                                    @else
                                    - <span id="gatewayds">0</span>{{$order->currency_sign}}
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4"><h4 style="font-size:14px;font-weight:600; ">Health Tax ({{$gs->lab_vat}}%):</h4></th>
                                <th >

                                        <h4 style="font-size:14px;font-weight:600; "> {{$order->currency_sign}}<span class="lab-total">{{$health_tax_amount}}</span></h4>

                                </th>
                            </tr>

                            <tr>
                                <th colspan="4"><h4 style="font-size:14px;font-weight:600; ">{{$lang->vt}}: </h4></th>
                                <th >
                                    @if($gs->sign == 0)
                                        <h4 style="font-size:14px;font-weight:600; "> {{$order->currency_sign}}<span class="lab-total">{{round($order->pay_amount * $order->currency_value, 2)}}</span></h4>
                                    @else
                                        <span class="lab-total">{{round($order->pay_amount * $order->currency_value, 2)}}</span>{{$order->currency_sign}}
                                    @endif
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <p class="g-font-size-17 g-mb-20"><b>{{$lang->vt}}:</b>
                    @if($gs->sign == 0)
                        {{$order->currency_sign}}<span class="lab-total">{{round($order->pay_amount * $order->currency_value, 2)}}</span>
                    @else
                        <span class="lab-total">{{round($order->pay_amount * $order->currency_value, 2)}}</span>{{$order->currency_sign}}
                    @endif --}}
                </div>
{{--
                <hr style="margin-top:2px; margin-bottom:10px;"> --}}

                        <h4 class="signIn-title">{{$lang->bdetails}}</h4>
                        <span>{{ $order->customer_name }}</span><br>
                        <span>{{ $order->customer_email }}</span><br>
                        <span>{{ $order->customer_phone }}</span><br>
                        {{-- <span>{{ $order->customer_landmark }}</span><br> --}}
                        <span>{{ $order->customer_address }}</span><br>
                        {{-- <span>{{ $order->customer_city }}</span><br> --}}
                        <span>{{ $order->customer_country }}</span><br>

            </div>
            <div class="col-md-8 col-sm-12">

                {{-- <label class="d-block g-color-gray-dark-v2 g-font-size-20">Payment Options</label>
                <hr class="g-my-10">

                <div class="form-group">
                    <label>{{$lang->cup}} <span>*</span></label>
                    <select name="method" id="paymentMethod" class="form-control" required="">
                        <option value="" disabled selected="">{{$lang->cup}}</option>

                        @if($gs->ccheck != 0)
                                        <option value="Cash" discount="0">{{$lang->dolpl}}</option>
                        @endif

                        @foreach($gateways as $gt)
                            <option value="{{$gt->title}}" discount="{{ $gt->discount }}">
                                {{$gt->title}} {{ $gt->discount > 0 ? '('.$gt->discount_text.')' : ''}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="Cash box" >
                    <h4 >Get Discounts on online Payment </h4>
                    <br/>
                    <img src="https://blog.khalti.com/wp-content/uploads/2019/09/%E0%A4%A0%E0%A5%82%E0%A4%B2%E0%A5%8B-%E0%A4%A6%E0%A4%B6%E0%A5%88%E0%A4%81%E0%A4%95%E0%A5%8B-%E0%A4%A0%E0%A5%82%E0%A4%B2%E0%A5%8B-%E0%A4%A7%E0%A4%AE%E0%A4%BE%E0%A4%95%E0%A4%BE_Order-online-at-thulo.com-and-pay-with-Khalti-and-get-cashback-instantly.jpg" style="height:120px;"/>
                    <img src="https://www.agmwebhosting.com/blog/wp-content/uploads/2020/01/Instant-cashback-blog-740x414.png" style="height:120px;"/>
                    <img src="https://www.offerayo.com/wp-content/uploads/2019/09/miniso-10_-3-outlets-fonepay.png" style="height:120px;"/>
               </div>


                <div id="gateway" style="display: none;"></div>

                <div class="text-right">
                    <div class="form-group">
                        <button class="btn btn-md order-btn" id="pay-btn" type="button" disabled>Pay</button>
                    </div>

                </div> --}}


                            {{-- <hr style="margin-top:2px; margin-bottom:10px;"> --}}
                            {{-- <h5 class="signIn-title text-center">Select Payment Options</h5> --}}

                            <div class="container">
                              <ul class="progress-indicator custom-complex">
                                <li class="completed" style="font-size:14px;"> <span class="bubble"></span><i class="icon-note"></i> Book  <i class="fa fa-check-circle"></i> </li>
                                <li class="completed" style="font-size:14px;"> <span class="bubble" ></span><i class="icon-finance-100 u-line-icon-pro"></i> Checkout <i class="fa fa-check-circle"></i></li>
                                <li class="completed" style="font-size:14px;"> <span class="bubble"></span><i class="icon-credit-card"></i> Purchase <i class="fa fa-check-circle"></i></li>
                              </ul>
                            </div>

                            @php
                                $esewa = App\PaymentGateway::where('title','=','Esewa')->get();
                                $khalti = App\PaymentGateway::where('title','=','Khalti')->get();
                                $fonepay = App\PaymentGateway::where('title','=','FonePay')->get();
                                $imepay = App\PaymentGateway::where('title','=','IMEPay')->get();
                                $iPay = App\PaymentGateway::where('title','=','iPay')->first();

                            @endphp
                                <h4 class="signIn-title text-center" >Payment Options</h4>
                                <div class="container" style="border-radius:30px;">
                                    <div class="radio-tile-group" name="method" id="paymentMethod" >
    
    
    
                                        <div class="input-container">
                                            <input id="Cash" class="radio-button" type="radio" name="radio" value="Cash" />
                                            <div class="radio-tile">
                                              <div class="icon walk-icon">
    
                                                <img src="https://www.chemstar.com/wp-content/uploads/2017/09/service-round-icon-02-delivery.png"/>
                                              </div>
                                              <label for="cod" class="radio-tile-label">Cash On Delivery</label>
                                            </div>
                                          </div>
    
                                    @if($khalti[0]->status == '1')
                                      <div class="input-container">
                                        <input id="walk" class="radio-button" type="radio" name="radio" value="Khalti" />
                                        <div class="radio-tile">
                                          <div class="icon walk-icon">
    
                                            <img src="https://lh3.googleusercontent.com/vtoxj9t4UWl6qxWUPGpv7ndJuJs_W3UTnQYpBwJ7xBMuRJ2TE6d71NrwWU6Nkbq0Zs8"/>
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
                                            <img src="https://myngch.com/frontend/assets/images/esewa_logo.png"/>
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
                                            <img src="https://media-exp1.licdn.com/dms/image/C510BAQE-gVAYFB4FUg/company-logo_200_200/0?e=2159024400&v=beta&t=oJy0sDDwzrx3cH5KCmGMYsy7FotUix4drGCTJX4kfAA"/>
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
                                      @if($iPay->status == '1')
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

                              <div id="gateway" style="display: none;"></div>

                              <div class="text-center" style=" margin-top: 20px;">
                                  <div class="form-group">
                                      <button class="btn btn-md u-btn-primary g-font-size-14 order-btn"  id="pay-btn" type="button" disabled title="Proceed to make Purchase" style="border-radius:30px;"><i class="icon-check"></i> Proceed</button>
                                  </div>

                              </div>

                                  <div class="Cash box" style="border-radius:30px;" >
                                       <h4 >Get Discounts on online Payment </h4>
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


                                  </div>

            </div>
        </div>
        {{-- <div class="text-center">
                <p class="g-font-size-20">Your order is successful!!</p>

        </div> --}}
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://khalti.com/static/khalti-checkout.js"></script>

    <script type="text/javascript">
        var total = {{ $order->pay_amount }};
        var id = '{{ $order->order_number }}';

        $("#paymentMethod").on('click',function(){

            // var option = $('option:selected', this);
            var option = $('input[name="radio"]:checked', this);
            var discount = option.attr('discount');
            var gateway = option.val();

            $('#pay-btn').attr('disabled','disabled');

            if(discount > 0){

                $("#gatewaydiscount").show("slow");
                $("#gatewayds").text(discount);

            }else{
                $("#gatewaydiscount").hide();

                $("#gatewayds").text(0);
            }

            // $('.lab-total').html((total - discount).toFixed(2))

            if(gateway == 'FonePay'){
                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');

                var btn_fonepay = document.getElementById("pay-btn");
                btn_fonepay.onclick = function (e) {
                    e.preventDefault();
                    $('#pay-btn').attr('disabled','disabled');

                    $('#overlay').css('display','block');
                    $.ajax({
                        type: "POST",
                        url:"/lab/payment/"+id+"/gateway/fonepay",
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

            else if(gateway == 'Cash'){
                $('#pay-btn').removeAttr('disabled');
                $('#gateway').html('');

                var btn = document.getElementById("pay-btn");
                btn.onclick = function (e) {
                    e.preventDefault();
                    var form = '<form action="/lab/payment/{{$order->order_number}}/gateway/cod" method="POST">{{ csrf_field() }}</form>';
                    $(form).appendTo('body').submit();
                }
                return;
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
                        url:"/lab/payment/"+id+"/gateway/esewa",
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
                        url:"/lab/payment/"+id+"/gateway/imepay",
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
                    url:"/lab/payment/"+id+"/gateway/khalti",
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
                    var form = '<form action="/lab/payment/{{$order->order_number}}/gateway/ipay" method="POST">{{ csrf_field() }}</form>';
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
    $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();
    });
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
              $.HSCore.components.HSPopup.init('.js-fancybox');
            });
          </script>
@endsection
