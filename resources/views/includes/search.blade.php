
<style>
    .s_item:hover{
        color:#2385aa;
    }
    
    .product-details-wrapper .productDetails-quantity span, .productDetails-quantity span {
        margin-top: 10px;
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        border: 1px #d9d9d9 solid;
        text-align: center;
        font-size: 12px;
        color: #4c4c4c;
        font-weight: 500;
        margin-right: -5px;
        position: relative;
        margin-bottom: 10px;
    }
    
    </style>
         <h6 style="text-align: center;"><b>Available Product :</b> <span style="color:#28a745">{{count($products)}}/{{count($product_count)}} Showing</span></h6>
    @forelse($products as $product)
        @php
        $product->pprice = $product->pprice ? : $product->cprice;
        $product->cprice = $product->getPrice(1);
    
        @endphp
    
    
        <li>
            <a style="text-decoration:none;" href="{{ route('front.product',[$product->id,str_slug($product->name,'-')]) }}" class="s_item">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('/assets/images/'.$product->photo) }}" style="height: 50px;width: 70px;border-radius: 30px;border: 1px solid #f1f1f1;" alt="{{$product->name}}" />
                    </div>
                    <div class="col-md-6">
                        <p class="g-font-size-12 mb-0">{{ ucwords(strtolower($product->name)) }} </p>
                        <p class="g-font-size-12 mb-0">{{ $product->sub_title }} </p>
                        <p class="g-color-gray-dark-v5 g-font-size-11 mb-0">{{ucwords(strtolower($product->company_name))}}</p>
    
                        @if($gs->sign == 0)
                            <h5 class="productDetails-price " style="font-size:12px; font-weight:600;">
                                {{-- {{$curr->sign}} --}}
                                Rs.
                                @if($product->user_id != 0)
                                    @php
    
                                        $price = $product->cprice + $gs->fixed_commission + ($product->cprice/100) * $gs->percentage_commission ;
                                    @endphp
                                    {{round($price * $curr->value,2)}}
                                @else
                                    {{round($product->cprice * $curr->value,2)}} ({{$product->product_quantity}})
                                @endif                   
                
                                @if($product->pprice != $product->cprice )
                                    <span style="font-size:12px;color:red"><del>{{$curr->sign}}{{round($product->pprice * $curr->value,2)}}</del></span> 
                                @endif
                            </h5>
                        @else
                            <h5 class="productDetails-price">
                                @if($product->user_id != 0)
                                    @php
                                        $price = $product->cprice + $gs->fixed_commission + ($product->cprice/100) * $gs->percentage_commission ;
                                    @endphp
                                    {{round($price * $curr->value,2)}} ({{$product->product_quantity}})
                                @else
                                    {{round($product->cprice * $curr->value,2)}} ({{$product->product_quantity}})
                                @endif                   
                                {{$curr->sign}}
                                @if($product->pprice != null)
                                    <span><del>{{round($product->pprice * $curr->value,2)}}{{$curr->sign}}</del></span> 
                                @endif  
                            </h5>                 
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{-- @if(!$product->requires_prescription) --}}
                            <input type="hidden" value="{{$product->id}}">
                            @php
                                $qty = $cart->getQty($product->id);
                            @endphp
                            <div class="productDetails-quantity">
                                @if($qty == 0)
                                    @if($product->stock == "0")
                                        <button class="btn btn-sm btn-primary" style="border-radius:30px; margin-top:15px;" disabled >{{$lang->dni}}</button>
    
                                    @else
                                        <button class="btn btn-sm btn-primary addcartforSearch" style="border-radius:30px !important;margin-top:15px; "><i class="icon-finance-100 u-line-icon-pro"></i> {{$lang->hcs}}</button>
                                       
                                    @endif
                                @else
                                    <span class="quantity-btn reducingforSearch" style="border-top-left-radius: 15px !important;border-bottom-left-radius: 15px !important; "><i class="fa fa-minus"></i></span>
                                    <span class="qtyforSearch">{{ $qty }}</span>   
                                    <span class="quantity-btn addingforSearch" style="border-top-right-radius: 15px !important;border-bottom-right-radius: 15px !important;"><i class="fa fa-plus"></i></span>
                                @endif
                            </div>
                        {{-- @endif --}}
                    </div>
                </div>
            </a>
        </li>
    
     
   

    @empty
        
    <h6 class="text-center">No product found!</h6>

    @endforelse

    