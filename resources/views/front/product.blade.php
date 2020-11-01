@extends('layouts.product')
@section('title',$product->name)
@section('styles')

<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.css">
<style>

.js-carousel.slick-initialized .js-next, .js-carousel.slick-initialized .js-prev {
    opacity: 1;
    background: transparent !important;
}

  
@media (min-width: 768px){
.col-md-4 {
-ms-flex: 0 0 33.333333%;
flex: 0 0 32.33% !important;
max-width: 33.333333%;
}
}



  
/* 
.wrapper{
  width: 400px;
  margin: 50px auto 0;
  background: #fff;
  padding: 30px 40px;
  border-radius: 3px;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.125);
} */

.wrapper .title{
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 15px;
}

.wrapper  ul{
    height: 60px;
    overflow: hidden;
    padding-left: 0px;
    margin-bottom:-1rem;
}

.wrapper  ul.active{
  height: auto;
}

.wrapper  ul li{
  margin-bottom: 5px;
  list-style: none;
  position: relative;
}

.wrapper  ul li:before{
    content: "";
    position: absolute;
    top: 8px;
    left: -12px;
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #bfbfbf;
}
 
.wrapper .toggle_btn{
  margin-top: 15px;
  font-weight: 700;
  color: #ff406c;
  cursor: pointer;
  font-size: 15px;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}

.wrapper .toggle_btn.active .fas{
  transform: rotate(180deg);
}

  hr{
    margin-top: 1rem !important;
    margin-bottom: 1rem !important;
  }

/* .glass {
  width: 300px;
  height: 300px;
  position: absolute;
  border-radius: 50%;
  cursor: none;
  

  box-shadow:
    0 0 0 7px rgba(255, 255, 255, 0.85),
    0 0 7px 7px rgba(0, 0, 0, 0.25), 
    inset 0 0 40px 2px rgba(0, 0, 0, 0.25);

  display: none;
  z-index: 1000;
} */





.u-ribbon-v1{
    border-radius:30px;
  }
  .product-name a{
        font-size:14px;
        font-weight:600;
        color:#333 !important;
      }

    .product-price{
        font-size:14px;
    }
    
    


.rounded-0 {
    border-radius: 30px !important;
}

.u-nav-v1-1.u-nav-primary .nav-link.active {
   
    background-color: #ffffff !important;
    color: #2385aa !important;
    border: 1px solid;
    border-color: #2385aa;
}

.product-details-wrapper .productDetails-size, .productDetails-color {
    padding-bottom: 5px;
}

.jssocials-share-link { border-radius: 50%; }

  .product-price{
      font-size:18px;
  }

  .product-details-wrapper .productDetails-price {
    padding: 0px 0; 
}

#wish.product-details-wrapper .productDetails-addCart-btn:hover {
          color: white !important;
          background-color: #e64b3b;
          border: 1px solid #e64b3b
        }
          


  
  


@media only screen and (max-width: 767px){
.product-image-area {
  height: 175px !important;
  width: 100%;
  padding:1.5rem;
}
}

  .js-countdown {
        font-size:15px;
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

  @media (max-width: 1024px) and (min-width: 768px){
.g-mt-1 {
  margin-top: 0px!important;
}
  }
  .product-name{
            margin-bottom:15px;
        }
 
  
  
    @media only screen and (max-width: 767px){

      
      .product-name{
          margin-bottom:10px !important;
      }
    .category-wrap .product-image-area {
        height: 175px;
        width: 100% ;
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
  height: 220px ;
  width: 100%;
  padding:1.5rem;
}
    </style>
  <style type="text/css">

.product-details-wrapper .productDetails-addCart-btn {
    display: inline-block;
    /* background-color: #0163d2; */
    border: 1px solid #0163d2;
    color: #fff;
    font-weight: 700;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    padding: 5px 15px;
    margin-top: 10px;
}

@media only screen and (max-width: 767px){
.g-font-size-16{
    font-size: 10px !important;
}
.g-font-size-15{
    font-size: 10px !important;
}
.g-mt-1 {
    margin-top: 4px!important;
}
.et-icon-alarmclock{
    font-size: 10px;
}
#card-height{
    height: 24rem !important;
}

}



  .productDetails-size span.pselected-size {
    border: 3px #2485a9 solid;
  }
    .replay-btn, .replay-btn-edit, .replay-btn-delete, .replay-btn-edit1, .replay-btn-delete1, .replay-btn-edit2, .replay-btn-delete2, .subreplay-btn, .view-replay-btn {
      color: {{$gs->colors == null ? 'gray' : $gs->colors}};
      font-weight: 700;
    }
    #comments .reply {
      padding-left: 52px;
    }
    .product-details-wrapper .productDetails-size a {
      display: inline-block;
      height: 40px;
      line-height: 40px;
      border: 1px #d9d9d9 solid;
      text-align: center;
      font-size: 12px;
      color: #4c4c4c;
      font-weight: 500;
      margin-right: 12px;
      position: relative;
      cursor: pointer;
      margin-bottom: 12px;
    }

    /* .product-details-wrapper .productDetails-size span {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border: 0px #d9d9d9 solid;
    text-align: center;
    font-size: 12px;
    color: #4c4c4c;
    font-weight: 500;
    margin-right: 12px;
    position: relative;
    cursor: pointer;
    margin-bottom: 12px;
} */

.product-image-area {
    height: 180px !important;
    width: 100%;
    padding:1.5rem;
    }

  </style>
  @if($lang->rtl == 1)
    <style>
      #comments .reply {
        padding-left: 0;
        padding-right: 52px;
      }
      .single-blog-comments-wrap.replay {margin-left: 0; margin-right: 40px;}

    
    </style>
  @endif
    
@endsection
@section('content')
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}


<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />

<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
{{-- <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-classic.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-plain.css" /> --}}
  @php
  $i=1;
  $j=1;
  $now = Carbon\Carbon::now()->format('Y/m/d h:i A');
  $product->pprice = $product->pprice ? : $product->cprice;
  $product->cprice = $product->getPrice(1);
  @endphp




   


    <!--  Starting of product description area   -->
    <div class="section-padding product-details-wrapper" style="padding-top: 20px; padding-bottom: 15px;">
      <div class="container">
        <div class="breadcrumb-box" style="margin-bottom: 15px;">
          @if($product->requires_prescription)
            <a href="{{route('front.index')}}">{{ucfirst(strtolower($lang->home))}}</a>
            <a href="javascript:;" style="cursor:default">{{$product->categories()->first()->cat_name}}</a>
            @if(count($product->subcategories) > 0)
              <a href="javascript:;" style="cursor:default">{{$product->subcategories()->first()->sub_name}}</a>
            @endif
            @if(count($product->childcategories) > 0)
              <a href="javascript:;" style="cursor:default">{{$product->childcategories()->first()->child_name}}</a>
            @endif
            <a href="{{route('front.product',['id1' => $product->id , 'id2' => str_slug($product->name,'-')])}}">{{$product->name}}</a>
            <span>{{$product->name}}</span>
          @else
            <a href="{{route('front.index')}}">{{ucfirst(strtolower($lang->home))}}</a>
            <a href="{{route('front.category',$product->categories()->first()->cat_slug)}}">{{$product->categories()->first()->cat_name}}</a>
            @if(count($product->subcategories) > 0)
              <a href="{{route('front.subcategory',$product->subcategories()->first()->sub_slug)}}">{{$product->subcategories()->first()->sub_name}}</a>
            @endif
            @if(count($product->childcategories) > 0)
              <a href="{{route('front.childcategory',$product->childcategories()->first()->child_slug)}}">{{$product->childcategories()->first()->child_name}}</a>
            @endif
            <a href="{{route('front.product',['id1' => $product->id , 'id2' => str_slug($product->name,'-')])}}">{{$product->name}}</a>
          @endif
        </div>

       
          {{-- Else Display the regular way --}}
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
           
                <div id="carousel-08-1" class="js-carousel text-center g-mb-20" data-infinite="true" data-arrows-classes="u-arrow-v1 g-absolute-centered--y g-width-35 g-height-40 g-font-size-18 g-color-gray g-bg-white g-mt-minus-10" data-arrow-left-classes="fa fa-angle-left g-left-0" data-arrow-right-classes="fa fa-angle-right g-right-0" data-nav-for="#carousel-08-2">
                  <div class="js-slide">
                  <a class="js-fancybox d-block g-pos-rel" href="javascript:;" data-fancybox="lightbox-gallery--08-1" data-src="{{asset('assets/images/'.$product->photo)}}" data-caption="{{$product->name}}" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">
                    <img class="img-fluid magniflier" style="max-height:30rem;" src="{{asset('assets/images/'.$product->photo)}}" alt="{{$product->name}}" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                    </a>
                  </div>
                  
                  @foreach($product->galleries as $gallery)
                  <div class="js-slide" >
                    <a class="js-fancybox d-block g-pos-rel" href="javascript:;" data-fancybox="lightbox-gallery--08-1" data-src="{{$gallery->photo ? asset('assets/images/gallery/'.$gallery->photo):asset('assets/images/default.png')}}" data-caption="Merohealthcare Product Gallery" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">
                      <img class="img-fluid" style="max-height:30rem;" src="{{$gallery->photo ? asset('assets/images/gallery/'.$gallery->photo):asset('assets/images/default.png')}}" alt="{{$product->name}}" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                    </a>
                  </div>
                  @endforeach
              
                </div>

                
                <div id="carousel-08-2" class="js-carousel text-center g-mx-minus-10 u-carousel-v3" data-infinite="true" data-center-mode="true" data-slides-show="4" data-is-thumbs="true" data-nav-for="#carousel-08-1">
                 <div class="js-slide g-px-10">
                    <img class="img-fluid" style="height:5rem" src="{{$product->photo ? asset('assets/images/'.$product->photo):asset('assets/images/default.png') }}" alt="{{$product->name}}">
                  </div>
                  @foreach($product->galleries as $gallery)
                  
                  <div class="js-slide g-px-10">
                    <img class="img-fluid" style="height:5rem" src="{{$gallery->photo ? asset('assets/images/gallery/'.$gallery->photo):asset('assets/images/default.png') }}" alt="{{$product->name}}">
                  </div> 
                  @endforeach
                </div>

                {{-- <div id="carousel-08-1" class="js-carousel text-center g-mb-20" data-infinite="true" data-arrows-classes="u-arrow-v1 g-absolute-centered--y g-width-35 g-height-40 g-font-size-18 g-color-gray g-bg-white g-mt-minus-10" data-arrow-left-classes="fa fa-angle-left g-left-0" data-arrow-right-classes="fa fa-angle-right g-right-0" data-nav-for="#carousel-08-2">
                  <div class="js-slide">
                    <a class="js-fancybox d-block g-pos-rel" href="javascript:;" data-fancybox="lightbox-gallery--08-1" data-src="http://localhost:8000/assets/images/1593930289mamaearth-mosquito-repellent-patches.jpg" data-caption="Lightbox Gallery" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">
                      <img class="img-fluid w-100" src="http://localhost:8000/assets/images/1593930289mamaearth-mosquito-repellent-patches.jpg" alt="Image Description">
                    </a>
                  </div>
                
                  <div class="js-slide">
                    <a class="js-fancybox d-block g-pos-rel" href="javascript:;" data-fancybox="lightbox-gallery--08-1" data-src="http://localhost:8000/assets/images/1592733037sarvottam-lito-mixed-fruit-400gm.jpg" data-caption="Lightbox Gallery" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">
                      <img class="img-fluid w-100" src="http://localhost:8000/assets/images/1593930289mamaearth-mosquito-repellent-patches.jpg" alt="Image Description">
                    </a>
                  </div>
                
                 
                </div>
                
                <div id="carousel-08-2" class="js-carousel text-center g-mx-minus-10 u-carousel-v3" data-infinite="true" data-center-mode="true" data-slides-show="4" data-is-thumbs="true" data-nav-for="#carousel-08-1">
                  <div class="js-slide g-px-10">
                    <img class="img-fluid w-100" src="http://localhost:8000/assets/images/1593930289mamaearth-mosquito-repellent-patches.jpg" alt="Image Description">
                  </div>
                
                  <div class="js-slide g-px-10">
                    <img class="img-fluid w-100" src="http://localhost:8000/assets/images/1593930289mamaearth-mosquito-repellent-patches.jpg" alt="Image Description">
                  </div>
                
    
                </div> --}}
                <br/>
               
              
              </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              @if(strlen($product->name) > 40)
                <h1 class="productDetails-header h5">{{ucwords(strtolower($product->name))}}</h1>
              @else
                <h1 class="productDetails-header h5">{{ucwords(strtolower($product->name))}}</h1>
              @endif
              {{-- <h6>Product ID: {{sprintf("%'.08d", $product->id)}}</h6> --}}
              <h6 style="font-size:13px ">{{ $product->company_name }}</h6>

              @if($product->highlights != null || $product->highlights != " " )
              <h5 style="font-weight:700; font-size:13px;"><i class="icon-fire"></i> Product Highlights:</h5>
              {{-- <h6 style="font-size:12px;">{!!$product->highlights !!}</h6> --}}
             
             @if(strlen($product->highlights) > 130)
              <div class="wrapper">
                <div class="title"></div>
                <ul>
                  <h6 style="font-size:12px; ">{!!$product->highlights !!}</h6>
                </ul>
                <div class="toggle_btn g-font-size-13">
                    <span class="toggle_text ">... more</span> <span class="arrow">
                  <i class="fas fa-angle-down"></i>
                  </span>   
                </div>
            </div>
            @else 
            <h6 style="font-size:12px; ">{!!$product->highlights !!}</h6>
            @endif


              @endif

              @if($product->user_id != 0)

                @if(isset($product->user))
                  {{-- <div class="productDetails-header-info"> --}}

                    {{-- <div class="product-headerInfo__title">
                      {{$lang->shop_name}}: <a style=" color:{{$gs->colors == null ? '#337ab7':$gs->colors}};" href="{{route('front.vendor',str_replace(' ', '-',($product->user->shop_name)))}}">{{$product->user->shop_name}}</a>
                    </div> --}}
                    {{-- @if(Auth::guard('user')->check())
                      <div class="product-headerInfo__btns">
                        @if( Auth::guard('user')->user()->favorites()->where('vendor_id','=',$product->user->id)->get()->count() > 0)
                          <a class="headerInfo__btn colored"><i class="fa fa-check"></i> {{ $lang->product_favorite }}</a>
                          @if(isset($vendor))
                          <a id="product_email" data-toggle="modal" data-target="#emailModal" style="cursor: pointer;" class="headerInfo__btn colored"><i class="fa fa-comments"></i> {{ $lang->contact_seller}}</a>
                          @endif
                        @else
                          <a style="cursor: pointer;" id="favorite" class="headerInfo__btn">
                            <input type="hidden" id="fav" value="{{$product->user->id}}">
                            <i class="fa fa-plus"></i> {{ $lang->add_seller }}
                          </a>
                        @endif
                        
                      </div>
                    @else
                      <div class="product-headerInfo__btns">
                        <a style="cursor: pointer;" class="headerInfo__btn no-wish" data-toggle="modal" data-target="#loginModal"><i class="fa fa-plus"></i> {{$lang->add_seller}}</a>
                        </div>
                      <div class="product-headerInfo__btns">
                        <a style="cursor: pointer;" class="headerInfo__btn no-wish" data-toggle="modal" data-target="#loginModal"><i class="fa fa-comments"></i> {{$lang->contact_seller}}</a>
                      </div>
                    @endif --}}


                  {{-- </div> --}}
                @endif
              @else

                {{-- Admin Contact --}}


                {{-- <div class="productDetails-header-info">
                  @if(Auth::guard('user')->check())
                    <a style="cursor: pointer;" class="headerInfo__btn no-wish" data-toggle="modal" data-target="#emailModal1"><i class="fa fa-comments"></i> {{$lang->contact_seller}}</a>
                  @else
                    <div class="product-headerInfo__btns">
                      <a style="cursor: pointer;" class="headerInfo__btn no-wish" data-toggle="modal" data-target="#emailModal1"><i class="fa fa-comments"></i> {{$lang->contact_seller}}</a>
                    </div>
                  @endif
                </div> --}}

              @endif
              @if($product->youtube != null)                    
                <div class="productVideo__title" >
                 {{$lang->watch_video}}:<a style=" color:{{$gs->colors == null ? '#337ab7':$gs->colors}};" class="fancybox" data-fancybox="" href="{{$product->youtube}}" target="__blank"><i class="fa fa-play-circle"></i></a>
                </div>

              @endif
              @if($product->type == 2)
                  <div class="productVideo__title">
                      {{$lang->platform}}{{$product->platform}}
                  </div>
                  <div class="productVideo__title">
                      {{$lang->region}}{{$product->region}}
                  </div>
                  <div class="productVideo__title">
                      {{$lang->licence_type}}{{$product->licence_type}}
                  </div>
              @endif
              @if($product->product_condition != 0)
                <div class="productDetails-header-info">

                          <div class="product-headerInfo__title">
                    {{$lang->product_condition}}: <span style="font-weight: 400;">{{ $product->product_condition == 1 ?'Used' : 'New'}}.<span>
                  </div>
                </div>
              @endif
              @if($product->ship != null)
                <div class="productDetails-header-info">

                  <div class="product-headerInfo__title" style="font-size:13px;">
                    <i class="icon-transport-069 u-line-icon-pro"></i> {{$lang->shipping_time}}: <span style="font-weight: 400;">{{ $product->ship}}.</span>
                  </div>
                </div>
              @endif
                  
              @php
                $stk = (string)$product->stock;
              @endphp

              {{-- @if($product->type == 0)
                @if($stk == "0")
                  <p class="productDetails-status" style="color: red;">
                    <i class="fa fa-times-circle-o"></i>
                    <span style="font-weight: 700;">{{$lang->dni}}</span>
                  </p>
                    @else
                  <p class="productDetails-status" style="color: green;">
                    <i class="fa fa-check-square-o"></i>
                    <span style="font-weight: 700;">{{$lang->sbg}}</span>
                  </p>
                @endif
              @endif --}}
              {{-- <p class="productDetails-reviews">
                  <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{App\Review::ratings($product->id)}}%"></div>
                  </div>
                <span>{{count($product->reviews)}} {{$lang->dttl}}</span>
              </p> --}}

              
             
              @if($similars->count() > 0)
                <div class="productDetails-size">
                  <h5 style="font-weight:700; font-size:13px;"><i class="icon-grid"></i> Available Variants: </h5>

                  @foreach($similars as $similar)
                    @if($similar->id == $product->id)
                      <span class="psize pselected-size" style="width: auto;padding: 5px;cursor:default;line-height: 27px; font-size: 12px; margin-bottom:5px; margin-right:0px;">{{$product->sub_title}}</span>
                    @else
                      <a href="{{ route('front.product',[$similar->id,str_slug($similar->name,'-')]) }}" class="psize" style="text-decoration:none;width: auto;padding: 5px; line-height: 27px; font-size: 12px; margin-right:0px; border: 3px #d9d9d9 solid; margin-bottom:5px !important;">{{ $similar->sub_title }}</a>
                    @endif
                  @endforeach
                </div>
              @endif

              <div class="productDetails-size">

                <p class="mb-0" style="font-size:13px;"><i class="icon-finance-260 u-line-icon-pro"></i> Price: </p>
               

                @if($gs->sign == 0)
                
                <div class="container row" style=" ">
                  <h5 class="productDetails-price" style="margin-bottom: 0px; padding-bottom:0px; font-size:15px;">
                    {{$curr->sign}} 
                    
                    
                    @if($product->user_id != 0)

                      @php
                      $price = $product->cprice + $gs->fixed_commission + ($product->cprice/100) * $gs->percentage_commission ;
                      @endphp
                     {{round($price * $curr->value,2)}} <em class="g-font-style-normal g-font-weight-300 g-font-size-12">/ {{$product->product_quantity}}</em>
                      @if($product->pprice != null && $product->pprice != 0  && $product->pprice > $product->cprice)
                        @php
                          $pprice = $product->pprice + $gs->fixed_commission + ($product->pprice/100) * $gs->percentage_commission ;
                            
                        @endphp
                        <span style="display:inline; color:green;"><del style="color:red;">{{$curr->sign}}{{round($pprice * $curr->value,2)}} </del> -{{ $product->discount_percent }}% </span> 
                      @endif
                    @else
                      {{round($product->cprice * $curr->value,2)}} <em class="g-font-style-normal g-font-weight-300 g-font-size-12">/ {{$product->product_quantity}}</em>
                      @if($product->pprice != null && $product->pprice != 0  && $product->pprice > $product->cprice)
                    <span style="display:inline; color:green;"> <del style="color:red;">{{$curr->sign}}{{round($product->pprice * $curr->value,2)}}</del> -{{ $product->discount_percent }}%</span> 
                      @endif

                      
                    @endif     
                    
                    

                    
                  </h5>

                  
                </div>

                @else
                  <h3 class="productDetails-price">
                    @if($product->user_id != 0)
                      @php
                      $price = $product->cprice + $gs->fixed_commission + ($product->cprice/100) * $gs->percentage_commission ;
                      @endphp
                      {{round($price * $curr->value,2)}}
                    @else
                      {{round($product->cprice * $curr->value,2)}}
                    @endif                   
                    {{$curr->sign}}
                    
                  </h3>                 
                  @endif

                  
                  
                  
              
                  
              
              @if($product->sale_from && $product->sale_from <= $now && $product->sale_to >= $now)
              <p class="mb-2" style="font-weight: 700;font-size: 13px;"><i class="icon-speedometer"></i> Discount Valid till: </p>
              <!--  Starting of countdown area   -->
                  
              {{-- <div class="js-countdown u-countdown-v3 g-line-height-1_2 g-color-black text-uppercase" > --}}
                <div class="js-countdown u-countdown-v3 g-line-height-1_2 g-color-black text-uppercase" data-end-date="{{$product->sale_to}}" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S" >
             
                <div class="d-inline-block g-mb-5">
                  <div class="js-cd-days g-font-size-16 mb-0" id="days" style="color:green;">00</div>
                  <h6 class="" style="color:green; border:0px;font-size:10px;">Days</h6>
                </div>
              
                <div class="hidden-down d-inline-block align-top g-font-size-20 g-mt-0">:</div>
              
                <div class="d-inline-block g-mx-10 g-mb-5">
                  <div class="js-cd-hours g-font-size-16 mb-0" id="hours">00</div>
                  <h6 class="" style="font-size:10px;">Hours</h6>
                </div>
              
                <div class="hidden-down d-inline-block align-top g-font-size-20 g-mt-0">:</div>
              
                <div class="d-inline-block g-mx-10 g-mb-5">
                  <div class="js-cd-minutes g-font-size-16 mb-0" id="minutes">00</div>
                  <h6 class="" style="font-size:10px;">Minutes</h6>
                </div>
              
                <div class="hidden-down d-inline-block align-top g-font-size-20 g-mt-0">:</div>
              
                <div class="d-inline-block g-mx-10 g-mb-5">
                  <div class="js-cd-seconds g-font-size-16 mb-0" id="seconds" style="color:red;">00</div>
                  <h6 class="" style="color:red;font-size:10px;">Seconds</h6>
                </div>
              </div>

          
 
                  
                  <!--  Ending of countdown area   -->
              @endif
              </div>


              <div class="productDetails-quantity" >
                <p class="mb-0" style="padding-bottom: 5px; font-size:13px;"><i class="icon-pie-chart"></i> {{$lang->cquantity}}:</p>
                {{-- <br/> --}}
               <input type="hidden" id="stock" value="{{$product->stock}}">
                {{-- <span class="quantity-btn" id="qsub"><i class="fa fa-minus"></i></span>
                <span id="qval">1</span>
                <span class="quantity-btn" id="qadd"><i class="fa fa-plus"></i></span>
                <span style="padding-left: 5px; border: none; font-weight: 700; font-size: 15px;">{{ $product->measure }}</span>  --}}
              </div>

              <div class="center">
              
                  <div class="input-group" style="width:100px;">
                      <span class="">
                          <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]" style="border-radius:0px; background-color:white; border-color:#bfbfbf; font-size: 14.5px; border-top-left-radius:10px;border-bottom-left-radius:10px; right:-1px; height:35px;">
                            <span class="glyphicon glyphicon-minus" style="color:black;"></span>
                          </button>
                      </span>
                      <input id="myqty" type="number" step="1" name="quant[2]" class="form-control input-number" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" value="1" min="1" max="100000" style="height:35px;">
                     

 
                      <span class="input-group-btn" >
                          <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]" style="border-radius:0px; background-color:white; border-color:#bfbfbf; border-top-right-radius:10px; border-bottom-right-radius:10px;">
                              <span class="glyphicon glyphicon-plus " style="color:black;"></span>
                          </button>
                      </span>
                      

                     {{-- <input type="text" id="text1" onkeypress="return IsNumeric(event);" onpaste="return false;" ondrop = "return false;" /> --}}
                      {{-- <span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span> --}}
                      
                  </div>

                  {{-- <input type="number" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');"> --}}
              
            </div>
           
            
              @if($stk == "0")
                  <a class="productDetails-addCart-btn" href="javascript:;" style="cursor: no-drop; border-radius:30px;" title="Add to cart">
                    <i class="icon-finance-100 u-line-icon-pro"></i> <span>{{$lang->dni}}</span>
                  </a>
              @else
                @if(Auth::guard('user')->check())
                  <a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;border-radius:30px;" title="Add to cart">
                    <i class="icon-finance-100 u-line-icon-pro"></i> <span>{{$lang->hcs}}</span>
                  </a>
                @else
                  <a class="productDetails-addCart-btn" href="{{route('user-login')}}" style="cursor: pointer; border-radius:30px;" title="Add to cart">
                      <i class="icon-finance-100 u-line-icon-pro"></i> <span>{{$lang->hcs}}</span>
                  </a>
                @endif
              @endif
           
           
            {{-- @endif --}}
            <input type="hidden" id="pid" value="{{$product->id}}">
          
            @php
            $user = Auth::guard('user')->user();
            @endphp

            @if(Auth::guard('user')->check())
              @if($user->user_type == 'Business')
              {{-- <a style="cursor: pointer;" class="productDetails-addCart-btn" href="/upload-prescription-business?product_id={{$product->id}}"><i class="fa fa-list"></i> <span>Business Order</span></a>   --}}
              @else
        
              
              {{-- <a style="cursor: pointer;" class="productDetails-addCart-btn no-wish" href="javascript:;" data-toggle="modal" data-target="#loginModal"><i class="fa fa-list"></i> <span>Business Order</span></a> --}}
              @endif
            @endif

            @if(Auth::guard('user')->check())
            <a style="cursor: pointer;border-radius:30px; padding:5px 10px;" id="wish" class="hovertip btn btn-danger u-icon-effect-v4--hover" href="javascript:;" id="wish"><i class="icon-heart" title="Add to wishlist"></i> <span></span></a>
        
            @else
            <a class="hovertip btn btn-danger u-icon-effect-v4--hover" style="cursor: pointer;border-radius:30px; padding:5px 10px; background-color:#f06b6b;border-color:#f06b6b;" href="{{route('user-login')}}" title="Add to wishlist"> <i class="icon-heart"></i> <span></span></a>
        @endif

     
        
        @if($product->user_id != 0)
        <h4 class="h6 g-font-size-13 g-color-primary"><b><i class="icon-puzzle"></i> Seller :</b> {{$product->user->name}}</h4>
        @endif

        @if($product->adv_price)
            
        <div class="OtcPage__combo-pack___P9Cwj g-mt-10" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
          <div class="ComboPack__combo-heading___SnepS">
            <h3 style="font-size: 13px;font-weight: 700;"><i class="icon-food-274 u-line-icon-pro"></i> Combo packs:</h3>
          </div>
          <ul class="list-unstyled">

          @foreach($product->prices as $pro)

            @php
                $product->price = $product->getTotalPrice($pro->min_qty)
            @endphp
              <li class="d-flex justify-content-start g-brd-around g-brd-gray-light-v4 g-pa-10 g-mb-minus-1 u-block-hover u-block-hover__additional--jump u-shadow-v19" style="border-radius:15px;border-radius:#ccc;">
                <div class="align-self-center g-px-10">
                  <h5 class="h6 g-font-weight-600 g-color-black g-mb-3">
                    <span class="g-mr-5 mb-0"><i class="icon-real-estate-040 u-line-icon-pro"></i> Pack of {{ $pro->min_qty }}</span>
                    {{-- <small class="g-font-size-12 g-color-blue">8k+ earned</small> --}}
                  </h5>
                  <p class="m-0">
                      @if($gs->sign == 0)
                      <h3 class="productDetails-price h5">
                        {{$curr->sign}}
                        
                        @if($product->user_id != 0)
                          @php
                          $price = $product->price + $gs->fixed_commission + ($product->price/100) * $gs->percentage_commission ;
                          @endphp
                          {{round($price * $curr->value,2)}}
                        @else
                          {{round($product->price * $curr->value,2)}}
                        @endif                   
      
                        @if($product->price != round($product->cprice*$pro->min_qty,2))
                          <span style="color:green;"><del style="color:red; font-size:14px;"> {{$curr->sign}}{{round($product->cprice *$pro->min_qty* $curr->value,2)}} </del></span>
                        @endif
                      </h1>
                    @else
                      <h3 class="productDetails-price">
                        @if($product->user_id != 0)
                          @php
                          $price = $product->price + $gs->fixed_commission + ($product->price/100) * $gs->percentage_commission ;
                          @endphp
                          {{round($price * $curr->value,2)}}
                        @else
                          {{round($product->price * $curr->value,2)}}
                        @endif                   
                        {{$curr->sign}}

                        @if($product->price != round($product->cprice*$pro->min_qty,2))
                          <span style="color:green;"><del style="color:red;">{{round($product->cprice *$pro->min_qty * $curr->value,2)}}{{$curr->sign}}</del></span>
                        @endif
                      </h1>
                    @endif
                  </p>
                </div>
                <div class="align-self-center ml-auto">
                  @if(!$product->requires_prescription)
                    @if($stk >= $pro->min_qty)
                      @if(Auth::guard('user')->check())
                        <button class="productDetails-addCart-btn" style="border-radius:30px;" onclick="addToCart({{ $pro->min_qty }})">Buy Pack</button>
                      @else 
                        <a class="productDetails-addCart-btn" style="border-radius:30px;" href="{{route('user-login')}}">Buy Pack</a>
                      @endif
                    @else
                      <button class="productDetails-addCart-btn" style="border-radius:30px;" disabled>Unavailable</button>
                    @endif
                  @endif

                  {{-- <span class="u-label u-label--sm g-bg-blue g-rounded-20 g-px-10">$25 / hr</span> --}}
                </div>
              </li>

              
            
          @endforeach
          </ul>
        </div>
      @endif





        @if($product->adv_bonus_price)
        <hr/>
          <div class="OtcPage__combo-pack___P9Cwj" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
            <div class="ComboPack__combo-heading___SnepS">
              <h3 style="font-size: 13px;font-weight: 700;">Combo Bonus packs:</h3>
            </div>
            <ul class="list-unstyled">

            @foreach($product->prices as $pro)
              @if($pro->is_bonus_price == 1)
              @php
                  $product->price = $product->getTotalPrice($pro->min_qty);
              @endphp
                <li class="d-flex justify-content-start g-brd-around g-brd-gray-light-v4 g-pa-10 g-mb-minus-1 u-block-hover u-block-hover__additional--jump u-shadow-v19 " style="border-radius:10px;">
                  <div class="align-self-center g-px-10 ">
                    <h5 class="h6 g-font-weight-600 g-color-black g-mb-3" style="font-size:12px;">
                    <span class="g-mr-5 mb-0">Pack of {{ $pro->min_qty }} Get {{$pro->product_free_quantity}} {{$pro->product_category}} Free</span>
                      {{-- <small class="g-font-size-12 g-color-blue">8k+ earned</small> --}}
                    </h5>
                    <p class="m-0">
                        @if($gs->sign == 0)
                        <h5 class="productDetails-price">
                          {{$curr->sign}}
                          
                          @if($product->user_id != 0)
                            @php
                            $price = $pro->product_bonus_price ;
                            @endphp
                            {{round($price * $curr->value,2)}}
                          @else
                            @if($product->sale_from && $product->sale_from <= $now && $product->sale_to >= $now)
                              @php
                                $discount = 1;
                                $discount = 1 - ($product->sale_percentage/100);
                              
                              @endphp
                              {{round( $discount * ($pro->product_bonus_price * $curr->value),2)}}
                            @else
                              {{round($pro->product_bonus_price * $curr->value,2)}}
                            @endif
                          @endif                   
        
                          @if($product->sale_from && $product->sale_from <= $now && $product->sale_to >= $now)
                            <span style="color:green;font-size:14px;"><del style="color:red;"> {{$curr->sign}}{{round($pro->product_bonus_price * $curr->value,2)}}</del> -{{ $product->sale_percentage }}%</span>
                          @endif
                        </h5>
                      @else
                        <h5 class="productDetails-price">
                          @if($product->user_id != 0)
                            @php
                            $price = $pro->product_bonus_price ;
                            @endphp
                            {{round($price * $curr->value,2)}}
                          @else
                            {{round($pro->product_bonus_price  * $curr->value,2)}}
                          @endif                   
                          {{$curr->sign}}

                          {{-- @if($product->price != round($product->cprice*$pro->min_qty,2))
                            <span style="color:green;font-size:14px;"><del style="color:red;">{{round($product->cprice *$pro->min_qty * $curr->value,2)}}{{$curr->sign}}</del> -{{ round(((round($product->cprice *$pro->min_qty* $curr->value,2)-round($pro->product_bonus_price * $curr->value,2))/ round($product->cprice *$pro->min_qty* $curr->value,2)) * 100,2) }}%</span>
                          @endif --}}
                        </h5>
                      @endif
                    </p>
                  </div>
                  <div class="align-self-center ml-auto">

                    @if(Auth::guard('user')->check())
                      @if($stk >= $pro->min_qty)
                        
                        <button class="productDetails-addCart-btn" onclick="addToCartBonus({{ $pro->min_qty }})" style="border-radius:30px;padding: 5px 10px;">Buy Pack</button>
                       
                      @else
                        <button class="productDetails-addCart-btn" style="border-radius:30px;padding: 5px 10px;" disabled>Unavailable</button>
                      @endif
                    @else
                    <a class="productDetails-addCart-btn" href="{{route('user-login')}}" style="border-radius:30px;padding: 5px 10px;">Buy Pack</a>
                    @endif
                  

                    {{-- <span class="u-label u-label--sm g-bg-blue g-rounded-20 g-px-10">$25 / hr</span> --}}
                  </div>
                </li>
              @endif
              
            @endforeach
            </ul>
          </div>

          
        @endif
     

     

               
           

              @if($product->size != null)
                <div class="productDetails-size">
                  <p>{{$lang->doo}}</p>
                  @foreach($size as $sz)
                  <span class="psize">{{$sz}}</span>
                  @endforeach
                </div>
              @endif
              @if($product->color != null)
                <div class="productDetails-color">
                  <p>{{$lang->colors}}</p>
                  @foreach($color as $cl)
                  <span class="pcolor" style="background: {{$cl}};">{{$cl}}</span>
                  @endforeach
                </div>
              @endif
 
              {{-- @if($product->requires_prescription)
                <a class="productDetails-addCart-btn" href="{{ Auth::guard('user')->check() ? route('user-prescriptions.index') : '/upload-prescription' }}">
                  <i class="fa fa-upload"></i> <span>Upload Prescription</span>
                </a>
              @else --}}
               
              {{-- <div class="social-sharing a2a_kit a2a_kit_size_32">
                  <a class="facebook a2a_button_facebook" href=""><i class="fa fa-facebook"></i> Share </a>
                  <a class="twitter a2a_button_twitter" href=""><i class="fa fa-twitter"></i> Tweet</a>
                  <a class="pinterest a2a_button_google_plus" href=""><i class="fa fa-pinterest"></i> Pinterest</a>
                  <a class="a2a_dd" href="https://www.addtoany.com/share" style="position: absolute; background-color: rgb(1, 102, 255); "></a>
              </div> --}}

             
              <script async src="https://static.addtoany.com/menu/page.js"></script>
            </div>

            @php
                $offers = App\Offer::orderBy('id','desc')->get();
            @endphp

            <div class="col-md-4 col-sm-4 col-xs-12">
         
              {{-- <h4 style="margin-top:2rem;" class="text-center h5"><i class="icon-share-alt"></i> Share with</h4> --}}
              {{-- <div id="shareRoundIcons" class="text-center" >

              </div> --}}
              <div class="sharethis-inline-share-buttons" data-animation="fadeIn" data-animation-delay="0" data-animation-duration="1000" style="margin-top:10px;">
                <style>
                  #st-el-3 .st-btns {
                    bottom: 56px;
                    left: 0;
                    margin: 100px auto 0;
                    max-width: 90%;
                    position: absolute;
                    right: 0;
                    text-align: center;
                    top: 10px !important;
                    z-index: 20;
                    overflow-y: auto;
                }
                </style>
              </div>
              <div class="container" style="padding-top: 20px; margin-top:20px;
              border: 1px solid;
              border-color: #cacaca;
              border-radius: 15px;
              padding-left: 30px;background-color:#fafafa;" data-animation="fadeIn" data-animation-delay="0" data-animation-duration="1000">
              <span class="u-label g-rounded-3 g-bg-primary g-mr-10 g-mb-15" style="position:absolute; left:10px;">
                <i class="fa fa-bookmark g-mr-3"></i>
                Additional Offers
              </span>

                <ul class="list-unstyled g-color-gray-dark-v4 g-mb-10 g-mt-30">
                  
                  @foreach($offers as $offer)
                  <li class="g-mb-5 g-font-size-13">
                    <i class="icon-tag g-color-primary g-mt-5 g-mr-10" style="position:absolute; left:25px;"></i>
                    <strong>{{$offer->title}}</strong> {{$offer->description}}
                  </li>
                  @endforeach
                 
                 
                </ul>

              
                </div>

             


                @php
                    $vendor_product = App\Product::where('name','=',$product->name)->where('status','=',1)->orderBy('cprice','asc')->get();
                // dd($vendor_product->count());
               @endphp

            @if($vendor_product->count() > 2)
         
            <div class="" style="margin-top:15px;"  data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                  <h6 style="font-size:13px;"><b><i class="icon-bag"></i> Available Sellers / Similar Products</b></h6>
                @foreach($vendor_product as $vp)

                  @if($vp->id == $product->id)

                  @else

                  @php
                  $name = str_replace(" ","-",$vp->name);
                   @endphp
                  <a href="{{route('front.product',['id' => $vp->id, 'slug' => str_slug($name,'-')])}})}}" >
                  <div class="media g-brd-bottom g-brd-14 g-brd-gray-light-v4 g-brd-primary--hover g-bg-white g-rounded-2 g-transition-0_3 g-pa-10 u-block-hover u-block-hover__additional--jump u-shadow-v19" style="background: #fafafa;margin-bottom:10px; border-radius:15px !important;">
                    <div class="d-flex mr-4">
                    <img class="g-width-70 g-height-70" style="border-radius:10%;" src="{{asset('assets/images/'.$vp->photo)}}" alt="{{$vp->photo}}">
                    </div>
                    <div class="media-body">
                      <blockquote class="lead g-mb-0 g-font-size-14" style="padding:5px 10px;">{{$vp->name}}</blockquote>
                      <div class="" style="padding:0px 15px;margin-top:0px;">
                      @if($vp->user_id == 0)
                      <h4 class="h6 g-font-weight-700 g-font-size-11 g-mb-0" style="padding:5px 0px; margin-top:0px;">by MHC</h4>
                      @else
                      <h4 class="h6 g-font-weight-700 g-font-size-11 g-mb-0" style="padding:5px 0px; margin-top:0px;">by {{$vp->user->name}}</h4>
                      @endif
                    
                      <em class="g-color-gray-dark-v4 g-font-style-normal g-font-size-13">
                        @if($gs->sign == 0)
                        @if($vp->user_id != 0)

                        @php
                        $price = $vp->cprice + $gs->fixed_commission + ($vp->cprice/100) * $gs->percentage_commission ;
                        @endphp
                       Rs.{{round($price * $curr->value,2)}} <em class="g-font-style-normal g-font-weight-300 g-font-size-12">/ {{$vp->product_quantity}}</em>
                        @if($vp->pprice != null && $vp->pprice != 0  && $vp->pprice > $vp->cprice)
                          @php
                            $pprice = $vp->pprice + $gs->fixed_commission + ($vp->pprice/100) * $gs->percentage_commission ;
                              
                          @endphp
                          {{-- <span style="display:inline; color:green;"><del style="color:red;">{{$curr->sign}}{{round($pprice * $curr->value,2)}} </del> -{{ $vp->discount_percent }}% </span>  --}}
                        @endif
                      @else
                        Rs.{{round($vp->cprice * $curr->value,2)}} <em class="g-font-style-normal g-font-weight-300 g-font-size-12">/ {{$vp->product_quantity}}</em>
                        @if($vp->pprice != null && $vp->pprice != 0  && $vp->pprice > $product->cprice)
                      {{-- <span style="display:inline; color:green;"> <del style="color:red;">{{$curr->sign}}{{round($vp->pprice * $curr->value,2)}}</del> -{{ $vp->discount_percent }}%</span>  --}}
                        @endif
                      @endif     
                 
                  </div>
  
                  @else
                    <h3 class="productDetails-price">
                      @if($vp->user_id != 0)
                        @php
                        $price = $vp->cprice + $gs->fixed_commission + ($vp->cprice/100) * $gs->percentage_commission ;
                        @endphp
                        {{round($price * $curr->value,2)}}
                      @else
                        {{round($vp->cprice * $curr->value,2)}}
                      @endif                   
                      {{$curr->sign}}
                      
                    </h3>                 
                    @endif    
                            
              

               
                        
                      </em>
                    </div>
                    </div>
                  </a>
               
                
                  @endif
                @endforeach
                </div>
            @endif
            </div>
          </div>
      </div>
    </div>
  



   
    <!--  Ending of product description area   -->

    <!--  Starting of product detail tab area   -->
    <div class="container g-mt-20 u-shadow-v19" style="background-color: #fafafa; border-radius:10px;">

        <div class="row">
            <div class="col-md-3" style="padding-top: 20px;" >
              <!-- Nav tabs -->
              <ul class="nav flex-column u-nav-v1-1 u-nav-primary" role="tablist" data-target="nav-1-1-primary-ver" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block rounded-0 u-btn-outline-primary g-mb-20">
                <li class="nav-item ">
                  <a class="nav-link  active" style="border-top-left-radius:30px; border-bottom-right-radius:30px;padding:3px;text-align:center;" data-toggle="tab" href="#nav-1-1-primary-ver--1" role="tab">Full Description</a>
                </li>

                @if($product['requires_prescription'])
                  {{-- No reviews --}}
                @else
                
                <li class="nav-item" >
                  <a class="nav-link " style="border-top-left-radius:30px; border-bottom-right-radius:30px; padding:3px;text-align:center;" data-toggle="tab" href="#nav-1-1-primary-ver--2" role="tab">Reviews</a>
                </li>
                @endif
              </ul>
              <!-- End Nav tabs -->
            </div>
          
            <div class="col-md-9">
              <!-- Tab panes -->
              <div id="nav-1-1-primary-ver" class="tab-content">

                
                <div class="tab-pane fade show active" id="nav-1-1-primary-ver--1" role="tabpanel">
                    @if(strlen($product->description) > 70)

                          <p {!! $lang->rtl == 1 ? 'dir="rtl"' : ''!!}>{!! $product->description !!}</p>
                      
                    @else
                          <p {!! $lang->rtl == 1 ? 'dir="rtl"' : ''!!}>{!! $product->description !!}</p>
                    
                    @endif
                
                
                </div>
          
                <div class="tab-pane fade" id="nav-1-1-primary-ver--2" role="tabpanel">
                    <div>
                        @if(Auth::guard('user')->check())

                          @if(Auth::guard('user')->user()->orders()->count() > 0)
                            <h5>{{$lang->fpr}}</h5>
                            {{-- <hr> --}}
                            @include('includes.form-success')
                            {{-- <p class="product-reviews">
                                <div class="review-star">
                                  <div class='starrr' id='star1'></div>
                                    <div>
                                        <span class='your-choice-was' style='display: none;'>
                                          {{$lang->dofpl}}: <span class='choice'></span>.
                                        </span>
                                    </div>
                                </div>
                            </p> --}}
                            <form class="product-review-form" action="{{route('front.review.submit')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{Auth::guard('user')->user()->id}}">
                                  <input type="hidden" name="rating" id="rate" value="5">
                                  <input type="hidden" name="product_id" value="{{$product->id}}">
                                  <div class="form-group">
                                    <textarea name="review" id="" rows="5" placeholder="{{$lang->suf}}" class="form-control" style="resize: vertical;border-radius:10px;" required></textarea>
                                  </div>
                              <div class="form-group text-center">
                                <input name="btn" type="submit" class="btn-review" style="border-radius:30px;" value="Submit Review">
                              </div>
                            </form>
                          @else
                            <h5>{{ $lang->product_review }}.</h5>
                          @endif
                      
                            <h5>{{$lang->dttl}}: </h5>
                        
                          @forelse($product->reviews as $review)       
                            <div class="review-rating-description">
                              <div class="row">
                                <div class="col-md-3 col-sm-3">
                                  <p>{{$review->user->name}}</p>
                                  {{-- <p class="product-reviews">
                                    <div class="ratings">
                                      <div class="empty-stars"></div>
                                      <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                    </div>
                                </p> --}}
                                  <p>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $review->review_date)->diffForHumans()}}</p>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                  <p>{{$review->review}}</p>
                                </div>
                              </div>
                            </div>
                          @empty
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>{{$lang->md}}</h5>
                                </div>
                            </div>
                          @endforelse
                          

                        @else


                            <div class="col-lg-12 pt-50">
                              <div class="blog-comments-area product">
                                <br/>
                                <h5 class="text-center">
                                  <a href="{{route('user-login')}}"><i class="icon-user"></i> {{$lang->comment_login}}</a> {{ $lang->to_review }}
                                 </h5>
                              
                              </div>
                            </div>
                          
                              <h5>{{$lang->dttl}}: </h5>
                         
                            @forelse($product->reviews as $review)       
                              <div class="review-rating-description">
                                <div class="row">
                                  <div class="col-md-3 col-sm-3">
                                    <p>{{$review->user->name}}</p>
                                    {{-- <p class="product-reviews">
                                      <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                      </div>
                                  </p> --}}
                                    <p>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $review->review_date)->diffForHumans()}}</p>
                                  </div>
                                  <div class="col-md-9 col-sm-9">
                                    <p>{{$review->review}}</p>
                                  </div>
                                </div>
                              </div>
                            @empty
                              <div class="row">
                                  <div class="col-md-12">
                                      <h6>{{$lang->md}}</h6>
                                  </div>
                              </div>
                            @endforelse
                            <hr>
                        @endif

                      </div>
              
              
              
                </div>
          
              </div>
              <!-- End Tab panes -->
            </div>
          </div>
    </div>
    <!--  Ending of product detail tab area   -->

    <br>

    {{-- @include('includes.comment-replies') --}}
    @php
      // $related = $product->childcategories()->first()->products()->where('status','=',1)->where('products.id','!=',$product->id)->distinct()->get();
      $related = collect();
      $title = $lang->amf;
      if($product->requires_prescription && $product->sub_title){
        $title = 'Alternate Brands';
        foreach($product->childcategories()->where('status',1)->get() as $cat){
          $related = $related->merge($cat->products()->where('status','=',1)->where('products.id','!=',$product->id)->where('products.sub_title',$product->sub_title)->distinct()->get());
        }

      }else{
        foreach($product->childcategories()->where('status',1)->get() as $cat){
          $related = $related->merge($cat->products()->where('status','=',1)->where('products.id','!=',$product->id)->distinct()->get());
        }
      }

      $related = $related->unique('id')->take(10);
    @endphp

    @if($related->count() > 0)
      <!--  Starting of product detail carousel area   -->

      <style>
       
        
        @media only screen and (max-width: 767px){
          #carousel-08-2{
            display:none !important;
          }
        .g-font-size-16{
            font-size: 10px !important;
        }
        .g-font-size-15{
            font-size: 10px !important;
        }
        .g-mt-1 {
            margin-top: 4px!important;
        }
        .et-icon-alarmclock{
            font-size: 10px;
        }
        
        }
        
        
        </style>

        
      <div class="section-padding productDetails-carousel-wrap">
        <div class="container">
            <div class="section-title">
                <h5 style="text-transform: uppercase;"> {{ $title }}</h5>
            </div>
            <div class="js-carousel g-pb-40" data-autoplay="true" data-slides-show="6" data-slides-scroll="1" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-45 g-height-45 g-font-size-default g-color-gray-dark-v5 g-bg-gray-light-v5 g-color-white--hover g-bg-primary--hover g-rounded-30" data-arrow-left-classes="fa fa-angle-left g-left-35x--lg g-left-15" data-arrow-right-classes="fa fa-angle-right g-right-35x--lg g-right-15" data-pagi-classes="u-carousel-indicators-v1 g-absolute-centered--x g-bottom-20 text-center" 
              data-responsive='[{
                "breakpoint": 1050,
                "settings": {
                "slidesToShow": 4
                }
            },{
                "breakpoint": 992,
                "settings": {
                "slidesToShow": 4
                  }
              }, {
                  "breakpoint": 768,
                  "settings": {
                  "slidesToShow": 2
                  }
              }, {
                  "breakpoint": 554,
                  "settings": {
                  "slidesToShow": 2
                  }
              }]'>
              
              @foreach($related as $prod)

      
              <div class="js-slide g-px-5">
              <!-- Article -->
              <div class="u-shadow-v19 u-shadow-v20--hover" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                  @php
                      $name = str_replace(" ","-",$prod->name);
                  @endphp
                  <div class="single-product-area text-center" style="margin-bottom:0px;" >
      
                    @php
                    $prod->pprice = $prod->pprice ? : $prod->cprice;
                    $prod->cprice = $prod->getPrice(1);
                    @endphp
            
                    @if($gs->sign == 0)
                      @if($prod->discount_percent != 0)
                      <div class="u-ribbon-v1 g-width-55 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-left-0 p-0" style="z-index:100;">
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
      
                    <div class="product-image-area" >
                      @if($prod->features!=null && $prod->colors!=null)
                        @php
                        $title = explode(',', $prod->features);
                        $details = explode(',', $prod->colors);
                        @endphp
                        {{-- <div class="featured-tag" style="width: 100%;">
                          @foreach(array_combine($title,$details) as $ttl => $dtl)
                          <style type="text/css">
                            span#d{{$j++}}:after {
                                border-left: 10px solid {{$dtl}};
                            }
                          </style>
                          <span id="d{{$i++}}" style="background: {{$dtl}}">{{$ttl}}</span>
                          @endforeach
                        </div> --}}
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
                        @if(Auth::guard('user')->check())
                        <input type="hidden" value="{{$prod->id}}">
                        <span class="hovertip addcart text-center" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                        </a>
                        <i class="icon-finance-100 u-line-icon-pro"></i> 
                        </span>
                    @else
                      <a class="productDetails-addCart-btn" href="{{route('user-login')}}" style="cursor: pointer;">
                          <span class="hovertip text-center" rel-toggle="tooltip" title="{{$lang->hcs}}">
                              <i class="icon-finance-100 u-line-icon-pro"></i> 
                          </span>
                      </a>
                    @endif
                      
                      </div>
      
      
      
                    </div>
                  </div>

                  
                    <div class="product-description text-center single-product-area" style="margin-top:0px;">
                      <div class="product-name" style=" font-size:14px;" ><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 65 ? substr($prod->name,0,65)."..." : ucwords(strtolower($prod->name))}}</a>
                        <p class="g-color-gray-dark-v5 g-font-size-11">{{strlen($prod->company_name) > 25 ? ucwords(strtolower(substr($prod->company_name,0,25))).'...' : ucwords(strtolower(substr($prod->company_name,0,25)))}}</p>
      
                      </div>
               
                      @if($gs->sign == 0)
                          <div class="product-price" style="font-size: 14px;">{{$curr->sign}}
                            {{round($prod->cprice * $curr->value,2)}}
                            @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                              <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>
      
                            @endif
      
                          </div>
                      @else
                          <div class="product-price" style="font-size: 14px;">
                            {{round($prod->cprice * $curr->value,2)}}
                            @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                              <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>
      
                            @endif
                            {{$curr->sign}}
                          </div>
                      @endif
                    </div>
                    </div>
              <!-- End Article -->
      
              </div>
              @endforeach
            </div>
        
        </div>
      </div>
      <!--  Ending of product detail carousel area   -->
    @endif


  

    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
{{-- 
<div class="wrapper">
    <div class="title">Show More - Show Less Accordion</div>
    <ul>
        <li>Lorem ipsum dolor sit amet.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
        <li>Lorem ipsum dolor sit.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ex?</li>
        <li>Lorem, ipsum.</li>  
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
        <li>Lorem ipsum dolor sit.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ex?</li>
        <li>Lorem, ipsum.</li>  
       <li>Lorem ipsum dolor sit.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ex?</li>
        <li>Lorem, ipsum.</li>  
       <li>Lorem ipsum dolor sit.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ex?</li>
        <li>Lorem, ipsum.</li>  
       <li>Lorem ipsum dolor sit.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ex?</li>
        <li>Lorem, ipsum.</li>  
       <li>Lorem ipsum dolor sit.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ex?</li>
        <li>Lorem, ipsum.</li>  
       <li>Lorem ipsum dolor sit.</li>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ex?</li>
        <li>Lorem, ipsum.</li>  
      
    </ul>
    <div class="toggle_btn">
        <span class="toggle_text">Show More</span> <span class="arrow">
      <i class="fas fa-angle-down"></i>
      </span>   
    </div>
</div> --}}




@endsection

@section('scripts')

{{-- @if($product->sale_from && $product->sale_from <= $now && $product->sale_to >= $now)
  <script type="text/javascript">
    function makeTimer() {

      var endTime = new Date("{{ $product->sale_to }}");			
        endTime = (Date.parse(endTime) / 1000);

        var now = new Date();
        now = (Date.parse(now) / 1000);

        var timeLeft = endTime - now;

        if(timeLeft<0) return;

        var days = Math.floor(timeLeft / 86400); 
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

        if (hours < "10") { hours = "0" + hours; }
        if (minutes < "10") { minutes = "0" + minutes; }
        if (seconds < "10") { seconds = "0" + seconds; }

        $("#days").html(days);
        $("#hours").html(hours);
        $("#minutes").html(minutes);
        $("#seconds").html(seconds);

    }

    setInterval(function() { makeTimer(); }, 1000);
    
  </script>
@endif --}}

<style type="text/css">
 img#imageDiv {
    height: 460px;
    width: 460px;
  }
  @media only screen and (max-width: 768px) { 

  img#imageDiv {
      height: 280px;
      width: 280px;
    }
    
      }
  @media only screen and (max-width: 767px) { 
  .product-review-carousel-img
  {
    max-width: 300px;
    margin: 30px auto;
  }
 img#imageDiv {
    height: 300px;
    width: 300px;
  }
   
    }
</style>

<script type="text/javascript">

  function productGallery(file){
    var image = $("#"+file).attr('src');
    $('#imageDiv').attr('src',image);
    $('.zoomImg').attr('src',image);
  }


    // var size = $(this).html();
    // $('#size').val(size);

    $('#star1').starrr({
        rating: 5,
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#rate').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });

</script>

<script type="text/javascript">
    var sizes = "";
    var colors = "";
    var stock = $("#stock").val();

  //   $(document).on("click", ".psize" , function(){
  //    $('.psize').removeClass('pselected-size');
  //    $(this).addClass('pselected-size');
  //    sizes = $(this).html();
  // });

    $(document).on("click", ".pcolor" , function(){
     $('.pcolor').removeClass('pselected-color');
     $(this).addClass('pselected-color');
     colors = $(this).html();
  });

    $(document).on("click", "#qsub" , function(){
         var qty = $("#qval").html();
         qty--;
         if(qty < 1)
         {
         $("#qval").html("1");            
         }
         else{
         $("#qval").html(qty);
         }
    });
    $(document).on("click", "#qadd" , function(){
        var qty = $("#qval").html();
        if(stock != "")
        {
        var stk = parseInt(stock);
          if(qty < stk)
          {
             qty++;
             $("#qval").html(qty);               
          }

        }
        else{
         qty++;
         $("#qval").html(qty);          
        }

    });

    $(document).on("click", "#addcrt" , function(){
      var qty = document.getElementById("myqty").value;
      $(".empty").html("");
      addToCart(qty);

    });

    function addToCart(qty){
      var pid = $("#pid").val();

      $.ajax({
          type: "GET",
          url:"{{URL::to('/json/addnumcart')}}",
          data:{id:pid,qty:qty,size:sizes,color:colors},
          success:function(data){
              if(data == 0)
              {
                $.notify("{{$gs->cart_error}}","error");
              }
              else{
                $(".empty").html("");
                $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                $(".cart-quantity").html(data[2]);
                var arr = $.map(data[1], function(el) {
                return el 
              });
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
                    '<p>{{$lang->cquantity}}: '+arr[k]['qty']+' '+measure+'</p>'+
                    @if($gs->sign == 0)
                    '<p>{{$curr->sign}}'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</p>'+
                    @else
                    '<p>'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'{{$curr->sign}}</p>'+
                    @endif
                    '</div>'+
                    '</div>');
                }
                $.notify("{{$gs->cart_success}}","success");
                $("#qval").html("1");
              }
          },
          error: function(data){
            if(data.responseJSON)
                $.notify(data.responseJSON.error,"error");
            else
              $.notify('Something went wrong',"error");

          }
      }); 
    }

    function addToCartBonus(qty){
      var pid = $("#pid").val();
      
      $.ajax({
          type: "GET",
          url:"{{URL::to('/json/addnumcartBonus')}}",
          data:{id:pid,qty:qty,size:sizes,color:colors},
          success:function(data){
              if(data == 0)
              {
                $.notify("{{$gs->cart_error}}","error");
              }
              else{
                $(".empty").html("");
                $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
         
                $(".cart-quantity").html(data[2]);
                var arr = $.map(data[1], function(el) {
                return el 
              });
              console.log(arr);
              console.log('af');
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
                    '<p>{{$lang->cquantity}}: '+arr[k]['qty']+' '+measure+'</p>'+
                    @if($gs->sign == 0)
                    '<p>{{$curr->sign}}'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</p>'+
                    
                    @else
                    '<p>'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'{{$curr->sign}}</p>'+
                    @endif
                    '</div>'+
                    '</div>');
                    
                }
                $.notify("{{$gs->cart_success}}","success");
                $("#qval").html("1");
              }
          },
          error: function(data){
            if(data.responseJSON)
                $.notify(data.responseJSON.error,"error");
            else
              $.notify('Something went wrong',"error");

          }
      }); 
    }

</script>


    <script>
        $(document).on("click", "#wish" , function(){
            var pid = $("#pid").val();
            $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/wish')}}",
                    data:{id:pid},
                    success:function(data){
                        if(data == 1)
                        {
                            $.notify("{{$gs->wish_success}}","success");
                        }
                        else {
                            $.notify("{{$gs->wish_error}}","error");
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
        $(document).on("click", "#favorite" , function(){
          $("#favorite").hide();
            var pid = $("#fav").val();
            $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/favorite')}}",
                    data:{id:pid},
                    success:function(data){
                      $('.product-headerInfo__btns').html('<a class="headerInfo__btn colored"><i class="fa fa-check"></i> {{ $lang->product_favorite }}</a>');
                    },
                    error: function(data){
                      if(data.responseJSON)
                        $.notify(data.responseJSON.error,"error");
                      else
                        $.notify('Something went wrong',"error");

                    }
              }); 

        });
    </script>



<script type="text/javascript">
//*****************************COMMENT******************************  
        $("#cmnt").submit(function(){
          var uid = $("#user_id").val();
          var pid = $("#product_id").val();
          var cmnt = $("#txtcmnt").val();
          $("#txtcmnt").prop('disabled', true);
          $('.btn blog-btn comments').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('json/comment')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'uid'   : uid,
                'pid'   : pid,
                'cmnt'  : cmnt
                  },
            success: function(data) {
              $("#comments").prepend(
                    '<div id="comment'+data[3]+'">'+
                        '<div class="row single-blog-comments-wrap">'+
                            '<div class="col-lg-12">'+
                              '<h4><a class="comments-title">'+data[0]+'</a></h4>'+
                                '<div class="comments-reply-area">'+data[1]+'</div>'+
                                 '<p id="cmntttl'+data[3]+'">'+data[2]+'</p>'+
                                '<div class="replay-form">'+
                    '<p class="text-right"><input type="hidden" value="'+data[3]+'"><button class="replay-btn">{{$lang->reply_button}} <i class="fa fa-reply-all"></i></button><button class="replay-btn-edit">{{$lang->edit_button}} <i class="fa fa-edit"></i></button><button class="replay-btn-delete">{{$lang->remove}} <i class="fa fa-trash"></i></button>'+
                    '</p>'+'<form action="" method="POST" class="comment-edit">'+
                                      '{{csrf_field()}}'+
                                '<input type="hidden" name="comment_id" value="'+data[3]+'">'+
                                      '<div class="form-group">'+
                            '<textarea rows="2" id="editcmnt'+data[3]+'" name="text" class="form-control"'+ 
                            'placeholder="{{$lang->edit_comment}}" style="resize: vertical;" required=""></textarea>'+
                                      '</div>'+
                                      '<div class="form-group">'+
                    '<button type="submit" class="btn btn-no-border hvr-shutter-out-horizontal">{{$lang->update_comment}}</button>&nbsp;'+
                        '<button type="button" class="btn btn-no-border hvr-shutter-out-horizontal cancel">{{$lang->cancel_edit}}</button>'+
                                      '</div>'+
                                    '</form>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                      '</div>');
                    $("#comment"+data[3]).append('<div id="replies'+data[3]+'" style="display: none;"></div>');
                     $("#replies"+data[3]).append('<div class="rapper" style="display: none;"></div>');
                     $("#replies"+data[3]).append('<form action="" method="POST" class="reply" style="display: none;">'+
                      '{{csrf_field()}}'+
                      '<input type="hidden" name="comment_id" id="comment_id'+data[3]+'" value="'+data[3]+'">'+
                      '<input type="hidden" name="user_id" id="user_id'+data[4]+'" value="'+data[4]+'">'+
                        '<div class="form-group">'+
                          '<textarea rows="2" name="text" id="txtcmnt'+data[3]+'" class="form-control"'+ 'placeholder="{{$lang->write_reply}}" required="" style="resize: vertical;"></textarea>'+
                        '</div>'+
                      '<div class="form-group">'+
                        '<button type="submit" class="btn btn-no-border hvr-shutter-out-horizontal">{{$lang->reply_button}}</button>'+
                      '</div>'+'</form>');                      
                      
                      



                    
                      //-----------Replay button details-----------
              if (data[5] > 1){
                $("#cmnt-text").html("{{ $lang->comments }}(<span id='cmnt_count'>"+ data[5]+"</span>)");
              }
              else{
                $("#cmnt-text").html("{{ $lang->comment }} (<span id='cmnt_count'>"+ data[5]+"</span>)");              
              }
              $("#txtcmnt").prop('disabled', false);
              $("#txtcmnt").val("");
              $('.btn blog-btn comments').prop('disabled', false);
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
//*****************************COMMENT ENDS******************************  
</script>

<script type="text/javascript">

//***************************** REPLY TOGGLE******************************
          $(document).on("click", ".replay-form p button.view-replay-btn" , function(){
          var id = $(this).parent().next().find('input[name=comment_id]').val();
          $("#replies"+id+" .rapper").show();
          $("#replies"+id).show();
          });

          $(document).on("click", ".replay-form p button.replay-btn, .replay-form p button.subreplay-btn" , function(){
          var id = $(this).parent().find('input[type=hidden]').val();
          $("#replies"+id).show();
          $("#replies"+id).find('.reply').show();
          $("#replies"+id).find('.reply textarea').focus();
          });
//*****************************REPLY******************************  
          $(document).on("submit", ".reply" , function(){
          var uid = $(this).find('input[name=user_id]').val();
          var cid = $(this).find('input[name=comment_id]').val();
          var rpl = $(this).find('textarea').val();
          $(this).find('textarea').prop('disabled', true);
          $('.btn btn-no-border hvr-shutter-out-horizontal').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('json/reply')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'uid'   : uid,
                'cid'   : cid,
                'rpl'  : rpl
                  },
            success: function(data) {
              $("#replies"+cid).prepend('<div id="reply'+data[3]+'">'+
                        '<div class="row single-blog-comments-wrap replay">'+
                            '<div class="col-lg-12">'+
                              '<h4><a class="comments-title">'+data[0]+'</a></h4>'+
                                '<div class="comments-reply-area">'+data[1]+'</div>'+
                                 '<p id="rplttl'+data[3]+'">'+data[2]+'</p>'+
                                '<div class="replay-form">'+
                    '<p class="text-right"><input type="hidden" value="'+cid+'"><button class="subreplay-btn">{{$lang->reply_button}} <i class="fa fa-reply-all"></i></button><button class="replay-btn-edit1">{{$lang->edit_button}} <i class="fa fa-edit"></i></button><button class="replay-btn-delete1">{{$lang->remove}} <i class="fa fa-trash"></i></button></p>'+
                                    '<form action="" method="POST" class="reply-edit">'+
                                      '{{csrf_field()}}'+
                                  '<input type="hidden" name="reply_id" value="'+data[3]+'">'+
                                      '<div class="form-group">'+
                                    '<textarea rows="2" id="editrpl'+data[3]+'" name="text" class="form-control"'+ 'placeholder="{{$lang->edit_reply}}"  style="resize: vertical;" required=""></textarea>'+
                                      '</div>'+
                                      '<div class="form-group">'+
                                      '<button type="submit" class="btn btn-no-border hvr-shutter-out-horizontal">'+'{{$lang->update_comment}}</button>&nbsp;'+
                                      '<button type="button" class="btn btn-no-border hvr-shutter-out-horizontal cancel">{{$lang->cancel_edit}}</button>'+
                                      '</div>'+
                                    '</form>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '</div>');
                      //-----------REPLY button details-----------
              $("#txtcmnt"+cid).prop('disabled', false);
              $("#txtcmnt"+cid).val("");
              $('.btn btn-no-border hvr-shutter-out-horizontal').prop('disabled', false);
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
//*****************************REPLY ENDS******************************  

</script>



<script>

  $(document).on("click", ".replay-btn-edit" , function(){
          var id = $(this).parent().find('input[type=hidden]').val();
          var txt = $("#cmntttl"+id).html(); 
          $(this).parent().parent().parent().find('.comment-edit textarea').val(txt);
          $(this).parent().parent().parent().find('.comment-edit').toggle();
  });
  $(document).on("click", ".cancel" , function(){
          $(this).parent().parent().hide();
  });
  //*****************************SUB REPLY******************************  
          $(document).on("submit", ".comment-edit" , function(){
          var cid = $(this).find('input[name=comment_id]').val();
          var text = $(this).find('textarea').val();
           $(this).find('textarea').prop('disabled', true);
          $('.hvr-shutter-out-horizontal').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('json/comment/edit')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'cid'   : cid,
                'text'  : text
                  },
            success: function(data) {
              $("#cmntttl"+cid).html(data);
              $("#editcmnt"+cid).prop('disabled', false);
              $("#editcmnt"+cid).val("");
              $('.hvr-shutter-out-horizontal').prop('disabled', false);
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
  $(document).on("click", ".replay-btn-delete" , function(){
              var id = $(this).parent().next().find('input[name=comment_id]').val();
              $("#comment"+id).hide();
              var count = parseInt($("#cmnt_count").html());
              count--;
              if(count <= 1)
              {
              $("#cmnt-text").html("COMMENT (<span id='cmnt_count'>"+ count+"</span>)");
              }
              else
              {
              $("#cmnt-text").html("COMMENTS (<span id='cmnt_count'>"+ count+"</span>)");
              }
     $.ajax({
            type: 'get',
            url: "{{URL::to('json/comment/delete')}}",
            data: {'id': id}
        }); 
  });
</script>


<script type="text/javascript">
  $(document).on("click", ".replay-btn-edit1" , function(){
          var id = $(this).parent().parent().parent().find('.reply-edit input[name=reply_id]').val();
          var txt = $("#rplttl"+id).html(); 
          $(this).parent().parent().parent().find('.reply-edit textarea').val(txt);
          $(this).parent().parent().parent().find('.reply-edit').toggle();
          var txt = $("#cmntttl"+id).html(); 
  });

  //*****************************SUB REPLY******************************  
          $(document).on("submit", ".reply-edit" , function(){
          var cid = $(this).find('input[name=reply_id]').val();
          var text = $(this).find('textarea').val();
           $(this).find('textarea').prop('disabled', true);
          $('.hvr-shutter-out-horizontal').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('json/reply/edit')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'cid'   : cid,
                'text'  : text
                  },
            success: function(data) {
              $("#rplttl"+cid).html(data);
              $("#editrpl"+cid).prop('disabled', false);
              $("#editrpl"+cid).val("");
              $('.hvr-shutter-out-horizontal').prop('disabled', false);
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
  $(document).on("click", ".replay-btn-delete1" , function(){
              var id = $(this).parent().next().find('input[name=reply_id]').val();
              $("#reply"+id).hide();
     $.ajax({
            type: 'get',
            url: "{{URL::to('json/reply/delete')}}",
            data: {'id': id}
        }); 
  });
</script>

<script >
    $(document).on('ready', function () {
      // initialization of tabs
      $.HSCore.components.HSTabs.init('[role="tablist"]');
    });

    $(window).on('resize', function () {
      setTimeout(function () {
        $.HSCore.components.HSTabs.init('[role="tablist"]');
      }, 200);
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

<script type="text/javascript">
  var specialKeys = new Array();
  specialKeys.push(8); //Backspace
  function IsNumeric(e) {
      var keyCode = e.which ? e.which : e.keyCode
      var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
      document.getElementById("error").style.display = ret ? "none" : "inline";
      return ret;
  }
</script>

<script type="text/javascript">
  function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script src="jquery.js"></script>
<script src="jssocials.min.js"></script>
<script>
    $("#shareRoundIcons").jsSocials({
      showLabel: false,
      showCount: false,
        shares: ["facebook", "whatsapp", "twitter", "linkedin", "email"]
    });
</script>

<script>
$(function() {

  var native_width = 0;
  var native_height = 0;
  var mouse = {x: 0, y: 0};
  var magnify;
  var cur_img;

  var ui = {
    magniflier: $('.magniflier')
  };

  // Add the magnifying glass
  if (ui.magniflier.length) {
    var div = document.createElement('div');
    div.setAttribute('class', 'glass');
    ui.glass = $(div);

    $('body').append(div);
  }

  
  // All the magnifying will happen on "mousemove"

  var mouseMove = function(e) {
    var $el = $(this);

    // Container offset relative to document
    var magnify_offset = cur_img.offset();

    // Mouse position relative to container
    // pageX/pageY - container's offsetLeft/offetTop
    mouse.x = e.pageX - magnify_offset.left;
    mouse.y = e.pageY - magnify_offset.top;
    
    // The Magnifying glass should only show up when the mouse is inside
    // It is important to note that attaching mouseout and then hiding
    // the glass wont work cuz mouse will never be out due to the glass
    // being inside the parent and having a higher z-index (positioned above)
    if (
      mouse.x < cur_img.width() &&
      mouse.y < cur_img.height() &&
      mouse.x > 0 &&
      mouse.y > 0
      ) {

      magnify(e);
    }
    else {
      ui.glass.fadeOut(100);
    }

    return;
  };

  var magnify = function(e) {

    // The background position of div.glass will be
    // changed according to the position
    // of the mouse over the img.magniflier
    //
    // So we will get the ratio of the pixel
    // under the mouse with respect
    // to the image and use that to position the
    // large image inside the magnifying glass

    var rx = Math.round(mouse.x/cur_img.width()*native_width - ui.glass.width()/2)*-1;
    var ry = Math.round(mouse.y/cur_img.height()*native_height - ui.glass.height()/2)*-1;
    var bg_pos = rx + "px " + ry + "px";
    
    // Calculate pos for magnifying glass
    //
    // Easy Logic: Deduct half of width/height
    // from mouse pos.

    // var glass_left = mouse.x - ui.glass.width() / 2;
    // var glass_top  = mouse.y - ui.glass.height() / 2;
    var glass_left = e.pageX - ui.glass.width() / 2;
    var glass_top  = e.pageY - ui.glass.height() / 2;
    //console.log(glass_left, glass_top, bg_pos)
    // Now, if you hover on the image, you should
    // see the magnifying glass in action
    ui.glass.css({
      left: glass_left,
      top: glass_top,
      backgroundPosition: bg_pos
    });

    return;
  };

  $('.magniflier').on('mousemove', function() {
    ui.glass.fadeIn(200);
    
    cur_img = $(this);

    var large_img_loaded = cur_img.data('large-img-loaded');
    var src = cur_img.data('large') || cur_img.attr('src');

    // Set large-img-loaded to true
    // cur_img.data('large-img-loaded', true)

    if (src) {
      ui.glass.css({
        'background-image': 'url(' + src + ')',
        'background-repeat': 'no-repeat'
      });
    }

    // When the user hovers on the image, the script will first calculate
    // the native dimensions if they don't exist. Only after the native dimensions
    // are available, the script will show the zoomed version.
    //if(!native_width && !native_height) {

      if (!cur_img.data('native_width')) {
        // This will create a new image object with the same image as that in .small
        // We cannot directly get the dimensions from .small because of the 
        // width specified to 200px in the html. To get the actual dimensions we have
        // created this image object.
        var image_object = new Image();

        image_object.onload = function() {
          // This code is wrapped in the .load function which is important.
          // width and height of the object would return 0 if accessed before 
          // the image gets loaded.
          native_width = image_object.width;
          native_height = image_object.height;

          cur_img.data('native_width', native_width);
          cur_img.data('native_height', native_height);

          //console.log(native_width, native_height);

          mouseMove.apply(this, arguments);

          ui.glass.on('mousemove', mouseMove);
        };


        image_object.src = src;
        
        return;
      } else {

        native_width = cur_img.data('native_width');
        native_height = cur_img.data('native_height');
      }
    //}
    //console.log(native_width, native_height);

    mouseMove.apply(this, arguments);

    ui.glass.on('mousemove', mouseMove);
  });

  ui.glass.on('mouseout', function() {
    ui.glass.off('mousemove', mouseMove);
  });

});
</script>

<script type="text/javascript">
  $(".ss").keyup(function() {
     var search = $(this).val();
     if(search == ""){
         $(".header-searched-item-list-wrap-mobile").hide();
     }
     else {
      console.log("hello1st");
         $.ajax({
                 type: "GET",
                 url:"{{URL::to('/json/mobilesuggest')}}",
                 data:{search:search},
                 success:function(data){
                     if(!$.isEmptyObject(data))
                     {
                         $(".header-searched-item-list-wrap-mobile").show();
                         $(".header-searched-item-list-wrap-mobile ul").html("");
                         // var arr = $.map(data, function(el) {
                         //     return el 
                         // });
                         // for(var k in arr)
                         // {
                         //     var x = arr[k]['name'];
                         //     var p = x.length  > 50 ? x.substring(0,50)+'...' : x;
                             
                         //     $(".header-searched-item-list-wrap ul").append('<li><a href="{{url('/')}}/product/'+arr[k]['id']+'/'+arr[k]['name']+'">'+p+'</a></li>');
                         // }
                         console.log(data);
                         $(".header-searched-item-list-wrap-mobile ul").append(data.html);
 
                     }
                     else{
                         $(".header-searched-item-list-wrap-mobile").hide();
                         console.log('unsucess');
                     }
                 }
               }) 
         
     }
  });
 </script> 

 <script> 
 $(".toggle_btn").click(function(){
  $(this).toggleClass("active");
 $(".wrapper ul").toggleClass("active");
 
 if($(".toggle_btn").hasClass("active")){
   $(".toggle_text").text("less");
 }
 else{
   $(".toggle_text").text("... more");
 }
});
</script> 
<script src="/frontend-assets/main-assets/assets/js/components/hs.popup.js"></script>
<script src="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.js"></script>

<!-- JS Plugins Init. -->
<script >
  $(document).on('ready', function () {
    // initialization of popups
    // $.HSCore.components.HSPopup.init('.js-fancybox');

    // initialization of carousel
    // $.HSCore.components.HSCarousel.init('.js-carousel');
  });
</script>

@endsection