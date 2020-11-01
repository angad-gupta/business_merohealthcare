
<style>
    .category_nav{
        padding:1rem;
        
    }
    .header-menu-wrap li a.active {
    color: black;
}
    </style>
<body>
    @if($gs->is_loader == 1)
    <div id="cover"></div>
    @endif
@if($gs->is_subscribe == 1)
@if(isset($visited))
    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->subscribe_image)}}">
    </div>
    <!--  Starting of subscribe-pre-loader Area   -->
    <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
        <div class="subscribePreloader__thumb" style="background-image: url({{asset('assets/images/'.$gs->subscribe_image)}});">
            <span class="preload-close"><i class="fa fa-close"></i></span>
            <div class="subscribePreloader__text text-center">
                <h1>{{$gs->subscribe_title}}</h1>
                <p>{{$gs->subscribe_text}}</p>
                <form action="{{route('front.subscribe.submit')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" name="email" id="" placeholder="{{$lang->supl}}" required="">
                        <button type="submit">{{$lang->s}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Ending of subscribe-pre-loader Area   -->

@endif
@endif
    <!--  Starting of header area   -->
    <header class="header-wrap">
        <div class="header-support-part">
            <div class="header-top-area">
                <div class="container">
                @if($lang->rtl == 1)

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="header-top-right-wrap text-left">
                                <ul>
                                    @if($ps->is_currency == 1)
                                    <li><a style="cursor: pointer;">
                                    @if(Session::has('currency')) 
                                    @php
                                    $cur_name = App\Currency::findOrFail(Session::get('currency'));
                                    @endphp
                                        {{$cur_name->sign}} {{$cur_name->name}}
                                    @else
                                    @php
                                    $cur_name = App\Currency::where('is_default','=',1)->first();
                                    @endphp
                                        {{$cur_name->sign}} {{$cur_name->name}}
                                    @endif
                                    <i class="fa fa-angle-down"></i></a>
                                        <ul style="box-shadow: none;">
                                            @php
                                            $cur_names = App\Currency::all();
                                            @endphp
                                            @foreach($cur_names as $cn)
                                             <li style="width: 100%"><a style="display: block; border-left: none; float: right; padding: 0 15px;" href="{{route('front.curr',$cn->id)}}">
                                                {{$cn->name}}</a>
                                             </li>                                           
                                            @endforeach

                                        </ul>
                                    </li>
                                    @endif

                                    @if($gs->is_language == 1)
                                    <li class="language"><a style="cursor: pointer;"><i class="fa fa-globe"></i>
                                    @if(Session::has('language')) 
                                    @php
                                    $langlang = App\Language::findOrFail(Session::get('language'));
                                    @endphp
                                        {{$langlang->language}}
                                    @else
                                    @php
                                    $langlang = App\Language::findOrFail(1);
                                    @endphp
                                        {{$langlang->language}}
                                    @endif
                                    <i class="fa fa-angle-down"></i></a>
                                        <ul style="box-shadow: none;">
                                            @php
                                            $languages = App\Language::all();
                                            @endphp
                                            @foreach($languages as $ln)
                                             <li style="width: 100%"><a style="display: block; float: right;; padding: 0 15px;" href="{{route('front.lang',$ln->id)}}">
                                                {{$ln->language}}</a>
                                             </li>                                           
                                            @endforeach

                                        </ul>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="header-top-left-wrap">
                                <ul>
                                    @if($gs->email != null)
                                    <li id="front-top-mail"><a style="padding-right: 0;"><i class="fa fa-envelope"></i> {{$gs->email}}</a></li>
                                    @endif
                                    @if($gs->phone != null)
                                    <li><a><i class="fa fa-phone"></i> {{$gs->phone}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>


                    @else

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="header-top-left-wrap">
                                <ul>
                                    @if($gs->email != null)
                                    <li id="front-top-mail"><a style="padding-left: 0;"><i class="fa fa-envelope"></i> {{$gs->email}}</a></li>
                                    @endif
                                    @if($gs->phone != null)
                                    <li><a><i class="fa fa-phone"></i> {{$gs->phone}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="header-top-right-wrap text-right">
                                <ul>
                                    @if($ps->is_currency == 1)
                                    <li><a style="cursor: pointer;">
                                    @if(Session::has('currency')) 
                                    @php
                                    $cur_name = App\Currency::findOrFail(Session::get('currency'));
                                    @endphp
                                        {{$cur_name->sign}} {{$cur_name->name}}
                                    @else
                                    @php
                                    $cur_name = App\Currency::where('is_default','=',1)->first();
                                    @endphp
                                        {{$cur_name->sign}} {{$cur_name->name}}
                                    @endif
                                    <i class="fa fa-angle-down"></i></a>
                                        <ul style="box-shadow: none;">
                                            @php
                                            $cur_names = App\Currency::all();
                                            @endphp
                                            @foreach($cur_names as $cn)
                                             <li style="display: block;"><a style="display: block; border-right: none;" href="{{route('front.curr',$cn->id)}}">
                                                {{$cn->name}}</a>
                                             </li>                                           
                                            @endforeach

                                        </ul>
                                    </li>
                                    @endif

                                    @if($gs->is_language == 1)
                                    <li class="language"><a style="cursor: pointer;"><i class="fa fa-globe"></i>
                                    @if(Session::has('language')) 
                                    @php
                                    $langlang = App\Language::findOrFail(Session::get('language'));
                                    @endphp
                                        {{$langlang->language}}
                                    @else
                                    @php
                                    $langlang = App\Language::findOrFail(1);
                                    @endphp
                                        {{$langlang->language}}
                                    @endif
                                    <i class="fa fa-angle-down"></i></a>
                                        <ul style="box-shadow: none;">
                                            @php
                                            $languages = App\Language::all();
                                            @endphp
                                            @foreach($languages as $ln)
                                             <li><a style="display: block;" href="{{route('front.lang',$ln->id)}}">
                                                {{$ln->language}}</a>
                                             </li>                                           
                                            @endforeach

                                        </ul>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                @endif
                </div>
            </div>
            <div class="header-middle-area">
                <div class="container">
                    <div class="row">

                    @if($lang->rtl == 1)
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="header-middle-right-wrap text-left">
                                <ul>
                                <li>
                                @if(Auth::guard('user')->check())
                                    <a href="{{route('user-wishlists')}}"><span>{{$lang->wishlists}}</span> <i class="fa fa-heart"></i></a>
                                @else
                                    <a style="cursor: pointer;" class="no-wish" data-toggle="modal" data-target="#loginModal"><span>{{$lang->wishlists}}</span> <i class="fa fa-heart"></i></a>
                                @endif
                                </li>
                                    <li>
                                        @if(Auth::guard('user')->check())
                                            <a style="text-transform: uppercase" href="{{route('user-dashboard')}}">
                                                <i class="fa fa-user"></i> <span>{{$lang->fh}}</span>
                                            </a>
                                        @else
                                            <a style="text-transform: uppercase" href="{{route('user-login')}}">
                                                <i class="fa fa-user"></i> <span>{{$lang->signinup}}</span>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="myCart"><a href="javascript:void(0)"> <i class="fa fa-cart-plus"></i></a> <span class="cart-quantity">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                                        <div class="addToMycart">
                                            <div class="cart">
                                            @if(Session::has('cart'))
                                            @foreach(Session::get('cart')->items as $product)
                                            <div class="single-myCart">
                                                <p class="cart-close" onclick="remove({{$product['item']['id']}})"><i class="fa fa-close"></i></p>
                                                <div class="cart-img">
                                                    <img src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="Product image">
                                                </div>
                                                <div class="cart-info">
                                                    <a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" style="color: black; padding: 0 0;"><h5>{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}</h5></a>
                                                <p>{{$lang->cquantity}}: <span id="cqt{{$product['item']['id']}}">{{$product['qty']}}</span> <span>{{ $product['item']['measure'] }}</span></p>
                                                <p>
                                                @if($gs->sign == 0)
                                                    {{$curr->sign}}<span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>
                                                @else
                                                    <span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>{{$curr->sign}}
                                                @endif
                                                </p>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif                                            
                                            </div>
                                            <h5 class="empty">{{ Session::has('cart') ? '' :$lang->h }}</h5>
                                            <hr/>
                                            <h4 class="text-left">{{$lang->vt}}
                                            @if($gs->sign == 0)                                                   
                                             {{$curr->sign}}<span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>
                                            @else
                                             <span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>{{$curr->sign}}
                                            @endif
                                         </h4>
                                            <div class="addMyCart-btns">
                                                <a href="{{route('front.cart')}}" class="black-btn">{{$lang->vdn}}</a>
                                                <a href="{{route('front.checkout')}}" class="black-btn">{{$lang->gt}}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="myCart1"><a href="javascript:void(0)"> <i class="fa fa-cart-plus"></i></a> <span class="cart-quantity">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                                        <div class="addToMycart1">
                                            <div class="cart">
                                            @if(Session::has('cart'))
                                            @foreach(Session::get('cart')->items as $product)
                                            <div class="single-myCart">
                                                <p class="cart-close" onclick="remove({{$product['item']['id']}})"><i class="fa fa-close"></i></p>
                                                <div class="cart-img">
                                                    <img src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="Product image">
                                                </div>
                                                <div class="cart-info">
                                                    <a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" style="color: black; padding: 0 0;"><h5>{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}</h5></a>
                                                <p>{{$lang->cquantity}}: <span id="cqt{{$product['item']['id']}}">{{$product['qty']}}</span> <span>{{ $product['item']['measure'] }}</span></p>
                                                <p>
                                                @if($gs->sign == 0)
                                                    {{$curr->sign}}<span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>
                                                @else
                                                    <span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>{{$curr->sign}}
                                                @endif
                                                </p>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif                                            
                                            </div>
                                            <h5 class="empty">{{ Session::has('cart') ? '' :$lang->h }}</h5>
                                            <hr/>
                                            <h4 class="text-left">{{$lang->vt}} 
                                                @if($gs->sign == 0)
                                                {{$curr->sign}}<span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>
                                                @else
                                                <span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>{{$curr->sign}}
                                                @endif
                                            </h4>
                                            <div class="addMyCart-btns">
                                                <a href="{{route('front.cart')}}" class="black-btn">{{$lang->vdn}}</a>
                                                <a href="{{route('front.checkout')}}" class="black-btn">{{$lang->gt}}</a>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="circle-li"><a href="{{route('front.compare')}}"><i class="fa fa-exchange"></i></a> <span class="compare-quantity">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
                                    </li>
                                    @if($gs->reg_vendor == 1)
                                        <li class="sell-btn">
                                            @if(Auth::guard('user')->check())
                                            <a href="{{route('user-dashboard')}}">{{$lang->sale}}</a>
                                            @else
                                            <a style="cursor: pointer;" data-toggle="modal" data-target="#vendorloginModal">{{$lang->sale}}</a>
                                            @endif
                                        </li>
                                    @endif
                                    <li class="mobile-search"><a href="javascript:void(0)"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="header-middle-left-wrap">
                                <div class="logo">
                                    <a href="{{route('front.index')}}">
                                    <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Logo">
                                    </a>
                                    @if($gs->reg_vendor == 1)
                                        <span class="sell-btn">
                                            @if(Auth::guard('user')->check())
                                            <a href="{{route('user-dashboard')}}">{{$lang->sale}}</a>
                                            @else
                                            <a style="cursor: pointer;" data-toggle="modal" data-target="#vendorloginModal">{{$lang->sale}}</a>
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="header-middle-left-wrap">
                                <div class="logo">
                                    <a href="{{route('front.index')}}">
                                        <img src="{{asset('assets/images/'.$gs->logo)}}" alt="Logo">
                                    </a>
                                    @if($gs->reg_vendor == 1)
                                        <span class="sell-btn">
                                            @if(Auth::guard('user')->check())
                                            <a href="{{route('user-dashboard')}}">{{$lang->sale}}</a>
                                            @else
                                            <a style="cursor: pointer;" data-toggle="modal" data-target="#vendorloginModal">{{$lang->sale}}</a>
                                            @endif
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="header-middle-right-wrap text-right">
                                <ul>
                                <li>
                                @if(Auth::guard('user')->check())
                                    <a href="{{route('user-wishlists')}}"><i class="fa fa-heart"></i> <span>{{$lang->wishlists}}</span></a>
                                @else
                                    <a style="cursor: pointer;" class="no-wish" data-toggle="modal" data-target="#loginModal"><i class="fa fa-heart"></i> <span>{{$lang->wishlists}}</span></a>
                                @endif
                                </li>
                                    <li>
                                        @if(Auth::guard('user')->check())
                                            <a style="text-transform: uppercase" href="{{route('user-dashboard')}}">
                                                <i class="fa fa-user"></i> <span>{{$lang->fh}}</span>
                                            </a>
                                        @else
                                            <a style="text-transform: uppercase" href="{{route('user-login')}}">
                                                <i class="fa fa-user"></i> <span>{{$lang->signinup}}</span>
                                            </a>
                                        @endif
                                    </li>




                                    <li class="myCart"><a href="javascript:void(0)"> <i class="fa fa-cart-plus"></i></a> <span class="cart-quantity">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                                        <div class="addToMycart">
                                            <div class="cart">
                                            @if(Session::has('cart'))
                                            @foreach(Session::get('cart')->items as $product)
                                            <div class="single-myCart">
                                                <p class="cart-close" onclick="remove({{$product['item']['id']}})"><i class="fa fa-close"></i></p>
                                                <div class="cart-img">
                                                    <img src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="Product image">
                                                </div>
                                                <div class="cart-info">
                                                    <a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" style="color: black; padding: 0 0;"><h5>{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}</h5></a>
                                                <p>{{$lang->cquantity}}: <span id="cqt{{$product['item']['id']}}">{{$product['qty']}}</span> <span>{{ $product['item']['measure'] }}</span></p>
                                                <p>
                                                @if($gs->sign == 0)
                                                    {{$curr->sign}}<span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>
                                                @else
                                                    <span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>{{$curr->sign}}
                                                @endif
                                                </p>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif                                            
                                            </div>
                                            <h5 class="empty">{{ Session::has('cart') ? '' :$lang->h }}</h5>
                                            <hr/>
                                            <h4 class="text-right">{{$lang->vt}}
                                            @if($gs->sign == 0)                                                   
                                             {{$curr->sign}}<span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>
                                            @else
                                             <span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>{{$curr->sign}}
                                            @endif
                                         </h4>
                                            <div class="addMyCart-btns">
                                                <a href="{{route('front.cart')}}" class="black-btn">{{$lang->vdn}}</a>
                                                <a href="{{route('front.checkout')}}" class="black-btn">{{$lang->gt}}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="myCart1"><a href="javascript:void(0)"> <i class="fa fa-cart-plus"></i></a> <span class="cart-quantity">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                                        <div class="addToMycart1">
                                            <div class="cart">
                                            @if(Session::has('cart'))
                                            @foreach(Session::get('cart')->items as $product)
                                            <div class="single-myCart">
                                                <p class="cart-close" onclick="remove({{$product['item']['id']}})"><i class="fa fa-close"></i></p>
                                                <div class="cart-img">
                                                    <img src="{{ asset('assets/images/'.$product['item']['photo']) }}" alt="Product image">
                                                </div>
                                                <div class="cart-info">
                                                    <a href="{{ route('front.product',[$product['item']['id'],str_slug($product['item']['name'],'-')]) }}" style="color: black; padding: 0 0;"><h5>{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}</h5></a>
                                                <p>{{$lang->cquantity}}: <span id="cqt{{$product['item']['id']}}">{{$product['qty']}}</span> <span>{{ $product['item']['measure'] }}</span></p>
                                                <p>
                                                @if($gs->sign == 0)
                                                    {{$curr->sign}}<span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>
                                                @else
                                                    <span id="prct{{$product['item']['id']}}">{{round($product['price'] * $curr->value , 2) }}</span>{{$curr->sign}}
                                                @endif
                                                </p>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif                                            
                                            </div>
                                            <h5 class="empty">{{ Session::has('cart') ? '' :$lang->h }}</h5>
                                            <hr/>
                                            <h4 class="text-right">{{$lang->vt}} 
                                                @if($gs->sign == 0)
                                                {{$curr->sign}}<span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>
                                                @else
                                                <span class="total">{{ Session::has('cart') ? round(Session::get('cart')->totalPrice * $curr->value , 2) : '0.00' }}</span>{{$curr->sign}}
                                                @endif
                                            </h4>
                                            <div class="addMyCart-btns">
                                                <a href="{{route('front.cart')}}" class="black-btn">{{$lang->vdn}}</a>
                                                <a href="{{route('front.checkout')}}" class="black-btn">{{$lang->gt}}</a>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="circle-li"><a href="{{route('front.compare')}}"><i class="fa fa-exchange"></i></a> <span class="compare-quantity">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
                                    </li>
                                    @if($gs->reg_vendor == 1)
                                        <li class="sell-btn">
                                            @if(Auth::guard('user')->check())
                                            <a href="{{route('user-dashboard')}}">{{$lang->sale}}</a>
                                            @else
                                            <a style="cursor: pointer;" data-toggle="modal" data-target="#vendorloginModal">{{$lang->sale}}</a>
                                            @endif
                                        </li>
                                    @endif
                                    <li class="mobile-search"><a href="javascript:void(0)"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    @endif


                        <div class="col-lg-12">
                            <div class="header-search-box mobile">
                                    <div class="search-close">
                                    <i class="fa fa-times"></i>
                                </div>
                                <form action="{{route('front.search')}}" method="GET">
                                    <input type="text" class="ss" id="search_product" name="product" placeholder="{{$lang->ec}}" required>
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="header-bottom-area">
            <div class="container">
                <div class="row">
                      
                </div>
                    {{-- @if($lang->rtl == 1)
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2">
                        <div class="header-search-box text-left">
                            <form action="{{route('front.search')}}" method="GET">
                                <button type="submit"><i class="fa fa-search"></i></button>
                                <input type="text" class="ss" id="header_search" name="product" placeholder="{{$lang->ec}}" required>
                            </form>
                        </div>
                        <div class="header-searched-item-list-wrap" style="display: none;">
                            <ul>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                        <div class="header-menu-wrap">
                            <ul>
                                <li><a href="{{route('front.index')}}">{{$lang->home}}</a></li>
                                <li><a href="{{route('front.promotions')}}" style="text-transform: uppercase">Promotions</a></li>
                                <li><a href="{{route('front.blog')}}">{{$lang->blog}}</a></li>
                                @if($ps->f_status == 1)
                                <li><a href="{{route('front.faq')}}">{{$lang->faq}}</a></li>
                                @endif
                                @if($ps->c_status == 1)
                                <li><a href="{{route('front.contact')}}">{{$lang->contact}}</a></li>
                                @endif
                                @if(count($pages) > 0)
                            <li><a style="cursor: pointer;">{{$lang->others}} <i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        @foreach($pages as $pg)
                                        <li><a href="{{route('front.page',$pg->slug)}}">{{strtoupper($pg->title)}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="mobileSlickMenuActive"></div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                        <div class="header-bottom-left-wrap">
                        <h5><i class="fa fa-angle-down"></i> {{$lang->all_categories}} <i class="fa fa-bars"></i></h5>
                            <ul>
                            @foreach($categories->sortBy('priority_no') as $category)
                                <li><a href="{{route('front.category',$category->cat_slug)}}">
                                    @if($category->photo != null)
                                    <img src="{{asset('assets/images/'.$category->photo)}}" alt="">
                                    @else
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                    {{ $category->cat_name }} <i class="{{count($category->subs) > 0 ? 'fa fa-angle-left':''}}"></i>
                                </a>
                                    @if(count($category->subs) > 0)
                                    <ul>
                                        <li>{{ $category->cat_name }}</li> 
                                    @foreach($category->subs()->where('status','=',1)->orderBy('priority_no')->get() as $subcategory)                                                   
                                        <li><a href="{{route('front.subcategory',$subcategory->sub_slug)}}">{{$subcategory->sub_name}} <i class="{{ count($subcategory->childs) > 0 ? 'fa fa-angle-left' : ''}}"></i></a>
                                        @if(count($subcategory->childs) > 0)
                                            <ul>
                                                <li>{{$subcategory->sub_name}}</li>
                                            @foreach($subcategory->childs()->where('status','=',1)->orderBy('priority_no')->get() as $childcategory)
                                                <li><a href="{{route('front.childcategory',$childcategory->child_slug)}}">{{$childcategory->child_name}}</a></li>
                                            @endforeach    

                                            </ul>
                                        @endif
                                        </li>
                                @endforeach
                                    </ul>
                                </li>
                                    @endif
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mobileMenuActive"></div>
                @else --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                        <div class="header-bottom-left-wrap">
                        <h5><i class="fa fa-bars"></i> {{ $lang->all_categories }} <i class="fa fa-angle-down"></i></h5>
                            <ul>
                            @foreach($categories->sortBy('priority_no') as $category)
                                <li><a href="{{route('front.category',$category->cat_slug)}}">
                                    @if($category->photo != null)
                                    <img src="{{asset('assets/images/'.$category->photo)}}" alt="">
                                    @else
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                    {{ $category->cat_name }} <i class="{{count($category->subs) > 0 ? 'fa fa-angle-right':''}}"></i>
                                </a>
                                    @if(count($category->subs) > 0)
                                    <ul>
                                        <li>{{ $category->cat_name }}</li> 
                                        @foreach($category->subs()->where('status','=',1)->orderBy('priority_no')->get() as $subcategory)                                                   
                                        <li><a href="{{route('front.subcategory',$subcategory->sub_slug)}}">{{ $subcategory->sub_name}} <i class="{{ count($subcategory->childs) > 0 ? 'fa fa-angle-right' : ''}}"></i></a>
                                            @if(count($subcategory->childs) > 0)
                                            <ul>
                                                <li>{{$subcategory->sub_name}}</li>
                                                @foreach($subcategory->childs()->where('status','=',1)->orderBy('priority_no')->get() as $childcategory)
                                                    <li><a href="{{route('front.childcategory',$childcategory->child_slug)}}">{{ $childcategory->child_name }}</a></li>
                                                @endforeach    

                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif

                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mobileMenuActive"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                        <div class="header-menu-wrap">
                            <ul>
                                <li><a href="{{route('front.index')}}">{{$lang->home}}</a></li>
                                <li><a href="{{route('front.promotions')}}" style="text-transform: uppercase">Promotions</a></li>
                                <li><a href="{{route('front.blog')}}">{{$lang->blog}}</a></li>
                                @if($ps->f_status == 1)
                                <li><a href="{{route('front.faq')}}">{{$lang->faq}}</a></li>
                                @endif
                                @if($ps->c_status == 1)
                                <li><a href="{{route('front.contact')}}">{{$lang->contact}}</a></li>
                                @endif
                                @if(count($pages) > 0)
                            <li><a style="cursor: pointer;">{{$lang->others}} <i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        @foreach($pages as $pg)
                                        <li><a href="{{route('front.page',$pg->slug)}}">{{strtoupper($pg->title)}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2">
                        <div class="header-search-box text-right">
                            <form action="{{route('front.search')}}" method="GET">
                                <input type="text" class="ss" id="header_search" name="product" placeholder="{{$lang->ec}}" required autocomplete="off">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="header-searched-item-list-wrap" style="display: none;">
                            <ul>

                            </ul>
                        </div>
                    </div>
                    <div class="mobileSlickMenuActive"></div>
                {{-- @endif --}}

                </div>
            </div>
        </div>
        <div class="header-bottom-area" style="background:white">
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-menu-wrap" >
                            <ul class="category_nav" >
                            @foreach($categories->sortBy('priority_no') as $category)
                           
                            <li><a href="{{route('front.category',$category->cat_slug)}}" style="cursor: pointer;"> {{ $category->cat_name }} <i class="{{count($category->subs) > 0 ? 'fa fa-angle-down':''}}"></i> </a>
                                <ul>
                                    @foreach($pages as $pg)
                                    <li><a href="{{route('front.page',$pg->slug)}}">{{strtoupper($pg->title)}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                            </ul>
                        </div>

                </div>
            </div>
        </div>
    </header>

    
            @php
            $i=1;
            $j=1;
            @endphp