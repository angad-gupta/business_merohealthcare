@extends('layouts.front')
@section('title','My Cart')
@section('content')
<style>
  .section-padding.product-shoppingCart-wrapper .table>tbody>tr>td {
    padding: 10px 0;
    vertical-align: middle;
    color: #555;
    font-size: 16px;
    border: none;
    text-align: center;
  }
  .product-shoppingCart-wrapper .table>tfoot>tr>td {
    padding: 10px 0;
}
.productDetails-quantity span {
    display: inline-block;
    width: 30px;
    height: 34px;
    line-height: 40px;
    border: 1px #d9d9d9 solid;
    text-align: center;
    font-size: 12px;
    color: #4c4c4c;
    font-weight: 500;
    margin-right: -5px;
    position: relative;
    margin-bottom: 0px;
}
  </style>
    <!-- Starting of ViewCart area -->
    <div class="section-padding product-shoppingCart-wrapper" style="padding-top:10px;">
        <div class="container">
            <div class="row">
              <div class="col-lg-12">
                {{-- <div class="view-cart-title">
                  <a style="color:black;" href="{{route('front.index')}}">{{ucfirst(strtolower($lang->home))}}</a>
                  <i class="fa fa-angle-right"></i>
                  <a style="color:black;" href="{{route('front.cart')}}">{{ucfirst(strtolower($lang->fht))}}</a>
                </div> --}}
              
              </div>
              <div class="col-md-12 col-sm-12">
                @include('includes.form-success')
                <header class="g-mb-20">
                  <div class="u-heading-v6-2 text-uppercase ">
                    <h2 class="h4 g-font-weight-300 g-font-size-20 btn btn-primary g-ml-15"><i class="icon-finance-100 u-line-icon-pro"></i> cart</h2>
                  </div>
                </header>
                <div class="col-md-8 g-mb-30">
                  
                <div class="g-overflow-x-scroll g-overflow-x-visible--lg">
                  <table class="text-center w-100">
                    <thead class="h6 g-brd-bottom g-brd-gray-light-v3 g-color-black">
                      <tr>
                        <th class="g-font-weight-600 text-left g-pb-20 ">Product Name</th>
                        <th class="g-font-weight-600 g-width-100 g-pb-20">Qty</th>
                        <th class="g-font-weight-600 g-width-130 g-pb-20">Unit Price</th>
                        <th class="g-font-weight-600 g-width-200 g-pb-20">Line Total</th>
                        {{-- <th class="g-font-weight-600 g-width-20 g-pb-20">Remove</th> --}}
                        <th></th>
                      </tr>
                    </thead>
              
                    <tbody>
                      @if(Session::has('cart'))
                      @foreach($products as $product)
                      @php
                        $p = App\Product::findOrFail($product['item']['id']);
                        $prod =App\Product::findOrFail($product['item']['id']);
                        $price = $product['item']['pprice'] ? $product['item']['pprice'] : $product['item']['cprice']

                      @endphp
                      <tr class="g-brd-bottom g-brd-gray-light-v3" id="del{{$product['item']['id']}}">
                        <td class="text-left g-py-5 g-px-5">
                          <img class="d-inline-block g-width-100 mr-4" src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="{{ $product['item']['name'] }}" style="height: 100px;">
                          <div class="d-inline-block align-middle">
                            <h4 class="h6 g-color-black"><a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" target="_blank">{{ ucwords(strtolower($product['item']['name'])) }}</a>
                              @if($p->vat_status == 1)
                                  <span style="font-style: italic;">*</span>
                              @endif
                          </h4>
                            <ul class="list-unstyled g-color-gray-dark-v4 g-font-size-12 g-line-height-1_6 mb-0">
                              <li>Variant: {{$p->sub_title}}</li>
                              <li>Qty: {{$p->product_quantity}}</li>
                            
                            </ul>
                          </div>
                        </td>
                        
                        <td>
                          <div class="productDetails-quantity">
                            {{-- <p>{{$lang->cquantity}}</p> --}}
                            <span class="quantity-btn reducing"><i class="fa fa-minus"></i></span>
                            <span id="qty{{$product['item']['id']}}">{{ $product['qty'] }}</span>
                            <input type="hidden" value="{{$product['item']['id']}}">    
                            <span class="quantity-btn adding"><i class="fa fa-plus"></i></span>
                            {{--<span style="padding-left: 5px; border: none; font-weight: 700; font-size: 12px;">{{ $product['item']['measure'] }}</span> --}}
                            @if(App\Product::findOrFail($product['item']['id'])->prices()->where('min_qty','<=',$product['qty'])->exists())
                            @php
                            $p = App\Product::findOrFail($product['item']['id'])->prices()->where('min_qty','<=',$product['qty'])->orderBy('min_qty','desc')->first();
                            $quotient = (int)($product['qty'] / $p->min_qty);
                            @endphp
                            @if(($quotient * $p->product_free_quantity) != 0)
                                    <h6>({{$quotient * $p->product_free_quantity}} {{$p->product_category}} Free)</h6>      
            
                            @endif
                        @endif
                          </div>
                        </td>
                        <input type="hidden" id="stock{{$product['item']['id']}}" value="{{$product['stock']}}">
                        <td class="g-color-gray-dark-v2 g-font-size-14">
                          @if($gs->sign == 0)
                          {{$curr->sign}}{{ round($price * $curr->value, 2) }}
                          @else
                          {{ round($price * $curr->value, 2) }}{{$curr->sign}}
                          @endif
                        </td>
              
                        
                        <td class="text-center g-color-black">
                          @if($gs->sign == 0)
                          {{$curr->sign}}<span id="prc{{$product['item']['id']}}">{{ round($product['price'] * $curr->value, 2) }}</span>
                          <span style="font-size:12px;color:red" id="reduced{{ $product['item']['id'] }}">
                            @if($product['item']['cprice'] != $product['item']['price']) 
                              <del>{{$curr->sign}}{{ round($price * $product['qty'] * $curr->value, 2) }}</del> 
                            @endif
                          </span>
                        @else
                          <span id="prc{{$product['item']['id']}}">{{ round($product['price'] * $curr->value, 2) }}</span>{{$curr->sign}}
                          <span style="font-size:12px;color:red" id="reduced{{ $product['item']['id'] }}">
                            @if($product['item']['cprice'] != $product['item']['price']) 
                              <del>{{ round($product['item']['cprice'] * $product['qty'] * $curr->value, 2) }}{{$curr->sign}}</del>
                            @endif
                          </span>
                        @endif
                          <br>
                        <button class="btn btn-sm btn-danger removeTest" style="border-radius:30px; position: absolute; right:5; bottom:50;"><i class="fa fa-trash" aria-hidden="true" style="cursor: pointer;" onclick="remove({{$product['item']['id']}})"></i></button>
                        </td>
                        
                      </tr>
                    
                      @endforeach

                    @else
                      <tr>
                        <td colspan="9">
                          <div class="text-center mx-auto g-max-width-645 g-mb-30 g-mt-30">
                            <h2 class="g-color-primary g-font-weight-700 g-font-size-80 g-line-height-1 text-uppercase mb-3"><i class="icon-exclamation"></i></h2>
                            <h2 class="h2 g-color-black mb-4">Empty Cart</h2>
                            <p class="lead g-color-gray-dark-v4 mb-0">Add Item in Cart</p>

                          </div>
                        </td>
                      </tr>
                    @endif
              
                    
              
                    
                    </tbody>
                  </table>
                </div>
                </div>

                <div class="col-md-4 g-mb-30">
                 
                  <div class="g-bg-gray-light-v5 g-pa-20 g-pb-20 mb-4" style="border-radius:20px;">
                      <h4 class="h6 text-uppercase mb-3 g-font-weight-600">Order Summary</h4>
                      <hr/>
                  
                      <div class="d-flex justify-content-between">
                        <span class="g-color-black">Total</span>
                        <span class="g-color-black g-font-weight-700 coupon-td" >
                          @if(Session::has('cart'))
                          {{$curr->sign}}<span class="total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span>
                          @else
                          {{$curr->sign}} 0
                          @endif

                        </span>
                      </div>


              
                    </div>

                    <div class="text-center">
                    <a class="btn u-btn-orange g-brd-2 g-brd-white g-font-size-13 g-rounded-50 g-pl-20 g-pr-15 g-py-9" href="{{route('front.index')}}">
                      <span class="align-middle u-icon-v3 g-width-16 g-height-16 g-color-black g-bg-white g-font-size-11 rounded-circle mr-3">
                        <i class="fa fa-angle-left"></i>
                      </span>
                      Shop More
                    </a>
                    <a class="btn u-btn-primary g-brd-2 g-brd-white g-font-size-13 g-rounded-50 g-pl-20 g-pr-15 g-py-9" href="{{route('front.checkout')}}">
                      Checkout
                      <span class="align-middle u-icon-v3 g-width-16 g-height-16 g-color-black g-bg-white g-font-size-11 rounded-circle ml-3">
                        <i class="fa fa-angle-right"></i>
                      </span>
                    </a>
                    </div>
                  
{{-- 
                    <h6 style="font-style:italic; color:red;">* All price subject to inclusive of VAT</h6> --}}
                  
              </div>

              </div>
            </div>
        </div>
    </div>
    <!-- Ending of ViewCart area -->

@endsection

@section('scripts')
  <script type="text/javascript">
      $(document).on("click", ".adding" , function(){
        var pid =  $(this).parent().find('input[type=hidden]').val();
        var stck = $("#stock"+pid).val();
        var qty = $("#qty"+pid).html();
        if(stck != "")
        {
          var stk = parseInt(stck);
          if(qty <= stk)
          {
             qty++;
            $("#qty"+pid).html(qty);            
          }
        }
        else{
          qty++;
          $("#qty"+pid).html(qty);      
        }
          $.ajax({
            type: "GET",
            url:"{{URL::to('/json/addbyone')}}",
            data:{id:pid},
            success:function(data){
              if(data == 0)
              {
                $.notify("{{$gs->cart_error}}","error");
              }
              else
              {
                $(".total").html((data[0] * {{$curr->value}}).toFixed(2));                        
                $(".cart-quantity").html(data[3]);
                $("#cqty"+pid).val("1");
                $("#prc"+pid).html((data[2] * {{$curr->value}}).toFixed(2));
                $("#prct"+pid).html((data[2] * {{$curr->value}}).toFixed(2));
                $("#cqt"+pid).html(data[1]);
                $("#qty"+pid).html(data[1]);
                if(data[2] == data[4]) $('#reduced'+id).html('')
                else {
                  if({{ $gs->sign == 0 }}) $('#reduced'+pid).html("<del>{{$curr->sign}}"+(data[4] * data[1] * {{ $curr->value }}).toFixed(2)+"</del>");
                  else $('#reduced'+pid).html("<del>"+(data[4] * data[1] * {{ $curr->value }}).toFixed(2)+"{{$curr->sign}}</del>");
                }
              }
            },
            error: function(data){
              qty--;
              $("#qty"+pid).html(qty); 

              if(data.responseJSON)
                $.notify(data.responseJSON.error,"error");
              else
                $.notify('Something went wrong',"error");

            }
          }); 
      });

      $(document).on("click", ".reducing" , function(e){
        var id =  $(this).parent().find('input[type=hidden]').val();
        var stck = $("#stock"+id).val();
        var qty = $("#qty"+id).html();
        qty--;
        if(qty < 1)
        {
          $("#qty"+id).html("1"); 
        }
        else{
            $("#qty"+id).html(qty);
            $.ajax({
              type: "GET",
              url:"{{URL::to('/json/reducebyone')}}",
              data:{id:id},
              success:function(data){
                  $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                  $(".cart-quantity").html(data[3]);
                  $("#cqty"+id).val("1");
                  $("#prc"+id).html((data[2] * {{$curr->value}}).toFixed(2));
                  $("#prct"+id).html((data[2] * {{$curr->value}}).toFixed(2));
                  $("#cqt"+id).html(data[1]);
                  $("#qty"+id).html(data[1]);
                  if(data[2] == data[4]) $('#reduced'+id).html('')
                  else {
                    if({{ $gs->sign == 0 }}) $('#reduced'+id).html("<del>{{$curr->sign}}"+(data[4] * data[1] * {{ $curr->value }}).toFixed(2)+"</del>");
                    else $('#reduced'+id).html("<del>"+(data[4] * data[1] * {{ $curr->value }}).toFixed(2)+"{{$curr->sign}}</del>");
                  }
              },
              error: function(data){
                qty++;
                $("#qty"+pid).html(qty); 
                
                if(data.responseJSON)
                  $.notify(data.responseJSON.error,"error");
                else
                  $.notify('Something went wrong',"error");

              }
            }); 
         }
      });
  </script>

  <script type="text/javascript">
       $(document).on("click", ".delcart" , function(){
        $(this).parent().parent().hide();
       });
  </script>
  <script>
    $('.btn-number').click(function(e){
      e.preventDefault();
      
      fieldName = $(this).attr('data-field');
      type      = $(this).attr('data-type');
      var input = $("input[name='"+fieldName+"']");
      var currentVal = parseInt(input.val());
      if (!isNaN(currentVal)) {
          if(type == 'minus') {
              
              if(currentVal > input.attr('min')) {
                  input.val(currentVal - 1).change();
              } 
              if(parseInt(input.val()) == input.attr('min')) {
                  $(this).attr('disabled', true);
              }
  
          } else if(type == 'plus') {
  
              if(currentVal < input.attr('max')) {
                  input.val(currentVal + 1).change();
              }
              if(parseInt(input.val()) == input.attr('max')) {
                  $(this).attr('disabled', true);
              }
  
          }
      } else {
          input.val(0);
      }
  });
  $('.input-number').focusin(function(){
     $(this).data('oldValue', $(this).val());
  });
  $('.input-number').change(function() {
      
      minValue =  parseInt($(this).attr('min'));
      maxValue =  parseInt($(this).attr('max'));
      valueCurrent = parseInt($(this).val());
      
      name = $(this).attr('name');
      if(valueCurrent >= minValue) {
          $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
      } else {
          alert('Sorry, the minimum value was reached');
          $(this).val($(this).data('oldValue'));
      }
      if(valueCurrent <= maxValue) {
          $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
      } else {
          alert('Sorry, the maximum value was reached');
          $(this).val($(this).data('oldValue'));
      }
      
      
  });
  $(".input-number").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
               // Allow: Ctrl+A
              (e.keyCode == 65 && e.ctrlKey === true) || 
               // Allow: home, end, left, right
              (e.keyCode >= 35 && e.keyCode <= 39)) {
                   // let it happen, don't do anything
                   return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });
      </script>
  




@endsection