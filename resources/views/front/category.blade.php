
@extends('layouts.front')

@section('title',$cat->cat_name.' - Shop Category')

@section('content')

@php
$i=1;
$j=1;
$now = Carbon\Carbon::now()->format('Y/m/d h:i A');

@endphp

<style>
  .product-name a{
        font-size:14px;
        color:#333 !important;
      }
  .product-price{
    font-size:12px;
    font-weight:600;
  }

.section-padding{
  padding:20px 0px;
}
  .product-price{
    font-size:14px;
  }

.js-countdown {
      font-size:10px;
    }

  .g-color-black{
    color: 555 !important;
  }

@media only screen and (max-width: 1200px) and (min-width: 992px){
.category-wrap .product-image-area {
    width: 100%;
    height: 220px;
}
}

@media only screen and (max-width: 991px) and (min-width: 768px){
.category-wrap .product-image-area {
    width: 100%;
    height: 200px;
}
}


  @media only screen and (max-width: 767px){
    .product-name{
        margin-bottom: 10px !important;
      }
      
  .category-wrap .product-image-area {
      height: 175px;
      width: 100%;
  }
  .js-countdown {
      font-size:12px !important;
    }
  }
  
  .gallery-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 2;
      opacity: 0;
      transition: all .4s ease-in;
  }
  
  .product-hover-area {
      position: absolute;
      width: 101%;
      left: 0;
      bottom: -15%;
      opacity: 0;
      visibility: hidden;
      z-index: 3;
      -webkit-transition: all .4s ease-in;
      transition: all .4s ease-in;
      z-index: 36;
  }
  
  .single-product-area {
      border: 0px solid #e0e0e0;
      box-shadow: 0 0 0px 0px #dedede;
      display: block;
      -webkit-transform: perspective(1px) translateZ(0);
      transform: perspective(1px) translateZ(0);
      position: relative;
      overflow: hidden;
      -webkit-transition: all .3s ease-in;
      transition: all .3s ease-in;
      margin-bottom: 30px;
  }
  .product-image-area {
    height: 180px !important;
    width: 100% !important;
    padding:1.5rem;
    }
  </style>
  @php
  $i=1;
  $j=1;
  @endphp

    <!-- Starting of Section title overlay area -->
    <div class="title-overlay-wrap overlay" style="background-image: url({{asset('assets/images/'.$gs->bgimg)}});">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h1>{{$cat->cat_name}}</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- Ending of Section title overlay area -->

    <!-- Starting of product category area -->
    <div class="section-padding product-category-wrap">
        <div class="container">
          
            <div class="row">

                @include('includes.catalog')

                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                  <h1 class="h4">{{$cat->cat_name}}</h1>
                  <div class="container" style="margin: 10px;">
                    @foreach($cat->subs()->where('status','=',1)->orderBy('sub_name')->get() as $subcategory)
                    <a class="u-tags-v1 g-color-cyan g-brd-around g-brd-cyan g-bg-cyan-opacity-0_1 g-bg-cyan--hover g-color-white--hover g-rounded-50 g-py-4 g-px-15 g-mr-5 g-mb-7" style="padding-top:5px; padding-bottom:5px;" href="{{route('front.subcategory',$subcategory->sub_slug)}}">{{ $subcategory->sub_name }}</a>
                    @endforeach
                  </div>
                    <div class="category-wrap">
                        <div class="row">
                          @forelse($cats as $prod)
                            @php
                            $prod->pprice = $prod->pprice ? : $prod->cprice;
                            $prod->cprice = $prod->getPrice(1);
                            @endphp
                            {{-- If This product belongs to vendor then apply this --}}
                            @if($prod->user_id != 0)

                              {{-- check  If This vendor status is active --}}
                              @if($prod->user->is_vendor == 3)
                                @php
                                  $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                @endphp

                                @if(isset($max))  
                                  @if($max > $price)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="width:50%;">
                                        @php
                                            $name = str_replace(" ","-",$prod->name);
                                        @endphp
                                        <div class="single-product-area text-center" style="margin-bottom:0px;">
                                          <div class="product-image-area">
                                            @if($prod->features!=null && $prod->colors!=null)
                                              @php
                                              $title = explode(',', $prod->features);
                                              $details = explode(',', $prod->colors);
                                              @endphp
                                              <div class="featured-tag" style="width: 100%;">
                                                @foreach(array_combine($title,$details) as $ttl => $dtl)
                                                  <style type="text/css">
                                                    span#d{{$j++}}:after {
                                                        border-left: 10px solid {{$dtl}};
                                                    }
                                                  </style>
                                                  <span id="d{{$i++}}" style="background: {{$dtl}}">{{$ttl}}</span>
                                                @endforeach
                                              </div>
                                            @endif
                                            <img src="{{asset('assets/images/'.$prod->photo)}}" alt="featured product">
                                            @if($prod->youtube != null)
                                            <div class="product-hover-top">
                                              <span class="fancybox" data-fancybox href="{{$prod->youtube}}"><i class="fa fa-play-circle"></i></span>
                                            </div>
                                            @endif

                                            <div class="gallery-overlay"></div>
                                            <div class="gallery-border"></div>
                                            <div class="product-hover-area">
                                              <input type="hidden" value="{{$prod->id}}">
                                              {{-- @if(Auth::guard('user')->check())
                                                <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="icon-heart"></i>
                                                          <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                                                        </span>
                                              @else
                                                <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="icon-heart"></i>
                                                          <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                                                        </span>
                                              @endif
                                              <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                                              </span> --}}
                                              <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                                              </a>
                                              <i class="icon-finance-100 u-line-icon-pro"></i> 
                                              </span>
                                              {{-- <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                                              </span> --}}
                                            </div>
                                          </div>
                                        </div>

                                          <div class="product-description text-center single-product-area" style="margin-top:0px;">
                                            <div class="product-name">
                                              <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 38 ? substr($prod->name,0,38)."..." : $prod->name}}</a>
                                            </div>
                                            {{-- <div class="product-review">
                                              <div class="ratings">
                                                  <div class="empty-stars"></div>
                                                  <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                              </div>
                                            </div> --}}
                                            
                                            @if($gs->sign == 0)
                                                <div class="product-price">{{$curr->sign}}
                                                  {{round($price * $curr->value,2)}}
                                                  @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                                                    @php
                                                      $pprice = $prod->pprice + $gs->fixed_commission + ($prod->pprice/100) * $gs->percentage_commission ;
                                                        
                                                    @endphp   
                                                    <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>
                                                  @endif

                                                </div>
                                            @else
                                                <div class="product-price">
                                                  {{round($price * $curr->value,2)}}
                                                  @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice)
                                                    @php
                                                      $pprice = $prod->pprice + $gs->fixed_commission + ($prod->pprice/100) * $gs->percentage_commission ;
                                                        
                                                    @endphp 
                                                    <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                                                  @endif
                                                  {{$curr->sign}}
                                                </div>
                                            @endif
                                          </div>
                                        

                                    </div>
                                  @endif
                                @else                  
                                 
                              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 " style="width: 50%;" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                                <div class="u-shadow-v19 u-shadow-v20--hover">
                                @php
                                    $name = str_replace(" ","-",$prod->name);
                                @endphp
                                <div class="single-product-area text-center" style="margin-bottom:0px;" >
                                  <div class="product-image-area">
                                    @if($prod->features!=null && $prod->colors!=null)
                                      @php
                                      $title = explode(',', $prod->features);
                                      $details = explode(',', $prod->colors);
                                      @endphp
                                      <div class="featured-tag" style="width: 100%;">
                                        @foreach(array_combine($title,$details) as $ttl => $dtl)
                                        <style type="text/css">
                                          span#d{{$j++}}:after {
                                              border-left: 10px solid {{$dtl}};
                                          }
                                        </style>
                                        <span id="d{{$i++}}" style="background: {{$dtl}}">{{$ttl}}</span>
                                        @endforeach
                                      </div>
                                    @endif
                                    <img src="{{asset('assets/images/'.$prod->photo)}}" alt="{{$prod->name}}">
                                    @if($prod->youtube != null)
                                      <div class="product-hover-top">
                                        <span class="fancybox" data-fancybox href="{{$prod->youtube}}"><i class="fa fa-play-circle"></i></span>
                                      </div>
                                    @endif

                                    <div class="gallery-overlay"></div>
                                    <div class="gallery-border"></div>
                                    <div class="product-hover-area">
                                      <input type="hidden" value="{{$prod->id}}">
                                      {{-- @if(Auth::guard('user')->check())
                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="icon-heart"></i>
                                          <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                                        </span>
                                      @else
                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="icon-heart"></i>
                                          <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                                        </span>
                                      @endif
                                      <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                                      </span> --}}
                                      <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                                      </a>
                                      <i class="icon-finance-100 u-line-icon-pro"></i> 
                                      </span>
                                    
                                      {{-- <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                                      </span> --}}
                                    </div>



                                  </div>
                                  @if($gs->sign == 0)
                                  @if($prod->discount_percent != 0)
                                  <div class="u-ribbon-v1 g-width-55 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-left-0 p-0" style="z-index:100;border-radius:30px;">
                                    <span class="d-block g-color-white g-py-15 g-line-height-0_8" style="padding: 1px;">{{ $prod->discount_percent }}%
                                      <small class="g-font-size-12">save</small>
                                    </span>
                                  </div>
                                  @endif
                                @endif
        
                                  @if($prod->sale_from && $prod->sale_from <= $now && $prod->sale_to >= $now)
                                      <div class="u-ribbon-v1 g-width-35 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-right-0 p-0" style="z-index:100;border-radius:0px;">
                                        <div class="js-countdown u-countdown-v3" data-end-date="{{$prod->sale_to}}" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S" style="margin-top:5px;">
                                          <span class="d-block g-bg-primary g-color-white g-py-5">
                                            <i class="et-icon-alarmclock u-icon-effect-v4--hover g-font-size-16" title="Offers time"></i>
                                          </span>
        
                                          <span class="d-block g-bg-white g-color-primary g-py-5">
                                            <div class="d-inline-block" style="font-weight:600; font-size:14px; color:red;">
                                              <div class="js-cd-days mb-0" id="dayss">00</div>
                                            </div>
                                            D
                                          </span>
                                        
                                          <span class="d-block g-bg-primary g-color-white g-py-5">
                                            <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                                              <div class="js-cd-hours mb-0" id="hourss">00 H</div>
                                            </div>
                                            H
                                          </span>
        
                                          <span class="d-block g-bg-white g-color-primary g-py-5">
                                            <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                                              <div class="js-cd-minutes mb-0" id="minutess">00 M</div>
                                            </div>
                                            M
                                          </span>
        
                                          <span class="d-block g-bg-primary g-color-white g-py-5">
                                            <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                                              <div class="js-cd-seconds mb-0" id="secondss">00 </div>
                                            </div>
                                            S
                                          </span>
                                        </div>
                                      </div>
                                      @endif

                                </div>
                                  <div class="product-description text-center single-product-area" style="margin-top:0px;">
                                    <div class="product-name" style="margin-bottom: 15px;"><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 38 ? substr($prod->name,0,38)."..." : ucwords(strtolower($prod->name))}}</a>
                                      <p class="g-color-gray-dark-v5 g-font-size-11">{{ucwords(strtolower($prod->company_name))}}</p>

                                    </div>
                                    {{-- <div class="product-review">
                                                          <div class="ratings">
                                                              <div class="empty-stars"></div>
                                                              <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                          </div>
                                    </div> --}}
                                    {{-- <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                                      <i class="icon-finance-100 u-line-icon-pro"></i> 
                                    </a>
                                    </span> --}}
                                    @if($gs->sign == 0)
                                        <div class="product-price">{{$curr->sign}}
                                          {{round($prod->cprice * $curr->value,2)}}
                                          @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                                            <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                                          @endif

                                        </div>
                                    @else
                                        <div class="product-price">
                                          {{round($prod->cprice * $curr->value,2)}}
                                          @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                                            <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                                          @endif
                                          {{$curr->sign}}
                                        </div>
                                    @endif
                                  </div>
                                
                              </div>
                              </div>
                                @endif
                              @endif

                            @else


                              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 " style="width: 50%;" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                                <div class="u-shadow-v19 u-shadow-v20--hover">
                                @php
                                    $name = str_replace(" ","-",$prod->name);
                                @endphp
                                <div class="single-product-area text-center" style="margin-bottom:0px;" >
                                  <div class="product-image-area">
                                    @if($prod->features!=null && $prod->colors!=null)
                                      @php
                                      $title = explode(',', $prod->features);
                                      $details = explode(',', $prod->colors);
                                      @endphp
                                      <div class="featured-tag" style="width: 100%;">
                                        @foreach(array_combine($title,$details) as $ttl => $dtl)
                                        <style type="text/css">
                                          span#d{{$j++}}:after {
                                              border-left: 10px solid {{$dtl}};
                                          }
                                        </style>
                                        <span id="d{{$i++}}" style="background: {{$dtl}}">{{$ttl}}</span>
                                        @endforeach
                                      </div>
                                    @endif
                                    <img src="{{asset('assets/images/'.$prod->photo)}}" alt="{{$prod->name}}">
                                    @if($prod->youtube != null)
                                      <div class="product-hover-top">
                                        <span class="fancybox" data-fancybox href="{{$prod->youtube}}"><i class="fa fa-play-circle"></i></span>
                                      </div>
                                    @endif

                                    <div class="gallery-overlay"></div>
                                    <div class="gallery-border"></div>
                                    <div class="product-hover-area">
                                      <input type="hidden" value="{{$prod->id}}">
                                      {{-- @if(Auth::guard('user')->check())
                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="icon-heart"></i>
                                          <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                                        </span>
                                      @else
                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="icon-heart"></i>
                                          <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                                        </span>
                                      @endif
                                      <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                                      </span> --}}
                                      <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                                      </a>
                                      <i class="icon-finance-100 u-line-icon-pro"></i> 
                                      </span>
                                    
                                      {{-- <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                                      </span> --}}
                                    </div>



                                  </div>
                                  @if($gs->sign == 0)
                                  @if($prod->discount_percent != 0)
                                  <div class="u-ribbon-v1 g-width-55 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-left-0 p-0" style="z-index:100;border-radius:30px;">
                                    <span class="d-block g-color-white g-py-15 g-line-height-0_8" style="padding: 1px;">{{ $prod->discount_percent }}%
                                      <small class="g-font-size-12">save</small>
                                    </span>
                                  </div>
                                  @endif
                                @endif
        
                                  @if($prod->sale_from && $prod->sale_from <= $now && $prod->sale_to >= $now)
                                      <div class="u-ribbon-v1 g-width-35 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-right-0 p-0" style="z-index:100;border-radius:0px;">
                                        <div class="js-countdown u-countdown-v3" data-end-date="{{$prod->sale_to}}" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S" style="margin-top:5px;">
                                          <span class="d-block g-bg-primary g-color-white g-py-5">
                                            <i class="et-icon-alarmclock u-icon-effect-v4--hover g-font-size-16" title="Offers time"></i>
                                          </span>
        
                                          <span class="d-block g-bg-white g-color-primary g-py-5">
                                            <div class="d-inline-block" style="font-weight:600; font-size:14px; color:red;">
                                              <div class="js-cd-days mb-0" id="dayss">00</div>
                                            </div>
                                            D
                                          </span>
                                        
                                          <span class="d-block g-bg-primary g-color-white g-py-5">
                                            <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                                              <div class="js-cd-hours mb-0" id="hourss">00 H</div>
                                            </div>
                                            H
                                          </span>
        
                                          <span class="d-block g-bg-white g-color-primary g-py-5">
                                            <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                                              <div class="js-cd-minutes mb-0" id="minutess">00 M</div>
                                            </div>
                                            M
                                          </span>
        
                                          <span class="d-block g-bg-primary g-color-white g-py-5">
                                            <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                                              <div class="js-cd-seconds mb-0" id="secondss">00 </div>
                                            </div>
                                            S
                                          </span>
                                        </div>
                                      </div>
                                      @endif

                                </div>
                                  <div class="product-description text-center single-product-area" style="margin-top:0px;">
                                    <div class="product-name" style="margin-bottom: 15px;"><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 38 ? substr($prod->name,0,38)."..." : ucwords(strtolower($prod->name))}}</a>
                                      <p class="g-color-gray-dark-v5 g-font-size-11">{{ucwords(strtolower($prod->company_name))}}</p>

                                    </div>
                                    {{-- <div class="product-review">
                                                          <div class="ratings">
                                                              <div class="empty-stars"></div>
                                                              <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                          </div>
                                    </div> --}}
                                    {{-- <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                                      <i class="icon-finance-100 u-line-icon-pro"></i> 
                                    </a>
                                    </span> --}}
                                    @if($gs->sign == 0)
                                        <div class="product-price">{{$curr->sign}}
                                          {{round($prod->cprice * $curr->value,2)}}
                                          @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                                            <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                                          @endif

                                        </div>
                                    @else
                                        <div class="product-price">
                                          {{round($prod->cprice * $curr->value,2)}}
                                          @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                                            <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                                          @endif
                                          {{$curr->sign}}
                                        </div>
                                    @endif
                                  </div>
                                
                              </div>
                              </div>

                            @endif

                           @empty
                           <div class="col-md-12">
                            <div class="text-center">
                              <h2 class="h1 g-color-black g-font-weight-600 mb-2"><i class="icon-exclamation"></i> Sorry</h2>
                              <p class="lead mb-5"> No product available or within selected price range !</p>
                            </div>
                           </div>
                          @endforelse
                    
                        </div>

                        @if(isset($min) || isset($max))
                            <div class="row">
                                <div class="col-md-12 text-center"> 
                                    {!! $cats->appends(['min' => $min, 'max' => $max])->links() !!}               
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12 text-center"> 
                                    {!! $cats->links() !!}               
                                </div>
                            </div>
                        @endif
                    </div>
                </div>              
            </div>
        </div>
    </div>
    <!-- Ending of product category area -->
@endsection

@section('scripts')


<script type="text/javascript">
        $("#sortby").change(function () {
        var sort = $("#sortby").val();
        window.location = "{{url('/category')}}/{{$cat->cat_slug}}/"+sort;
    });
</script>


<script type="text/javascript">
            $("#ex2").slider({});
        $("#ex2").on("slide", function(slideRange) {
            var totals = slideRange.value;
            var value = totals.toString().split(',');
            $("#price-min").val(value[0]);
            $("#price-max").val(value[1]);
        });
</script>

<script>
  $(document).on("click", ".addcart" , function(){
      var pid = $(this).parent().find('input[type=hidden]').val();
          $.ajax({
                  type: "GET",
                  url:"{{URL::to('/json/addcart')}}",
                  data:{id:pid},
                  success:function(data){
                      if(data == 0)
                      {
                          $.notify("{{$gs->cart_error}}","error");
                      }
                      else
                      {
                      $(".empty").html("");
                      $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                      $(".cart-quantity").html(data[2]);
                      var arr = $.map(data[1], function(el) {
                      return el });
                      $(".cart").html("");
                      for(var k in arr)
                      {
                          var x = arr[k]['item']['name'];
                          var p = x.length  > 45 ? x.substring(0,45)+'...' : x;
                          var measure = arr[k]['item']['measure'] != null ? arr[k]['item']['measure'] : "";
                          $(".cart").append(
                          '<div class="single-myCart">'+
          '<p class="cart-close" onclick="remove('+arr[k]['item']['id']+')"><i class="fa fa-close"></i></p>'+
                          '<div class="cart-img">'+
                  '<img src="{{ asset('assets/images/') }}/'+arr[k]['item']['photo']+'" alt="Product image">'+
                          '</div>'+
                          '<div class="cart-info">'+
      '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                      '<p>{{$lang->cquantity}}: <span id="cqt'+arr[k]['item']['id']+'">'+arr[k]['qty']+'</span> '+measure+'</p>'+
                      @if($gs->sign == 0)
                      '<p>{{$curr->sign}}<span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span></p>'+
                      @else
                      '<p><span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span>{{$curr->sign}}</p>'+
                      @endif
                      '</div>'+
                      '</div>');
                        }
                      $.notify("{{$gs->cart_success}}","success");
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
  <script>
  $(document).on("click", ".removecart" , function(e){
      $(".addToMycart").show();
  });
  </script>
 

 <script  src="{{asset('frontend-assets/main-assets/assets/vendor/jquery.countdown.min.js')}}"></script>

 <!-- JS Unify -->
 <script  src="{{asset('frontend-assets/main-assets/assets/js/components/hs.countdown.js')}}"></script>
 
 <!-- JS Plugins Init. -->
 <script >
   $(document).on('ready', function () {
     // initialization of countdowns
     var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
       yearsElSelector: '.js-cd-years',
       monthElSelector: '.js-cd-month',
       daysElSelector: '.js-cd-days',
       hoursElSelector: '.js-cd-hours',
       minutesElSelector: '.js-cd-minutes',
       secondsElSelector: '.js-cd-seconds'
     });
   });
 </script>




@endsection