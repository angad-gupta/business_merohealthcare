
{{-- @if($gs->hv == 1)
    
   
    <!--  Starting of featured product area   -->
    <div class="section-padding featured-product-wrap wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{$lang->featured_product}}</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product-type-tab">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#bestSeller" class="tab-1">{{$lang->bg}}</a></li>
                            <li><a data-toggle="tab" href="#topRate" class="tab-2">{{$lang->lm}}</a></li>
                            <li><a data-toggle="tab" href="#hotSale" class="tab-3">{{$lang->rds}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="bestSeller" class="tab-pane active">
                                <div class="owl-carousel featured-carousel">
                                    @php
                                        $i=1;
                                        $j=1;
                                    @endphp
                                    @foreach($fproducts as $prod)


                                        @php
                                            $name = str_replace(" ","-",$prod->name);
                                        @endphp
                                        <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="single-product-area text-center">
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
                                                    @if(Auth::guard('user')->check())
                                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @else
                                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @endif
                                                    <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                              </span>
                                                    <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><i class="fa fa-cart-plus"></i>
                              </span>
                                                    <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                              </span>
                                                </div>



                                            </div>
                                            <div class="product-description text-center">
                                                <div class="product-name">{{strlen($prod->name) > 50 ? substr($prod->name,0,50)."..." : $prod->name}}</div>
                                                <div class="product-review">
                                                    <div class="ratings">
                                                        <div class="empty-stars"></div>
                                                        <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                    </div>
                                                </div>
                                                @if($gs->sign == 0)
                                                    <div class="product-price">{{$curr->sign}}
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>

                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif

                                                        {{$curr->sign}}
                                                    </div>
                                                @endif
                                            </div>
                                        </a>


                                    @endforeach
                                </div>
                            </div>
                            <div id="topRate" class="tab-pane">
                                <div class="featured_loader"></div>
                                <div class="owl-carousel featured-carousel owl-test" style="display: none;">
                                    @php
                                        $i=1000;
                                        $j=1000;
                                    @endphp
                                    @foreach($beproducts as $prod)
                                        @php
                                            $name = str_replace(" ","-",$prod->name);
                                        @endphp
                                        <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="single-product-area text-center">
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
                                                    @if(Auth::guard('user')->check())
                                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @else
                                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @endif
                                                    <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                              </span>
                                                    <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><i class="fa fa-cart-plus"></i>
                              </span>
                                                    <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                              </span>
                                                </div>



                                            </div>
                                            <div class="product-description text-center">
                                                <div class="product-name">{{strlen($prod->name) > 50 ? substr($prod->name,0,50)."..." : $prod->name}}</div>
                                                <div class="product-review">
                                                    <div class="ratings">
                                                        <div class="empty-stars"></div>
                                                        <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                    </div>
                                                </div>
                                                @if($gs->sign == 0)
                                                    <div class="product-price">{{$curr->sign}}
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>

                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>
                                                        {{$curr->sign}}
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div id="hotSale" class="tab-pane fade">
                                <div class="featured_loader"></div>
                                <div class="owl-carousel featured-carousel owl-test" style="display: none;">
                                    @php
                                        $i=2000;
                                        $j=2000;
                                    @endphp
                                    @foreach($tproducts as $prod)
                                        @php
                                            $name = str_replace(" ","-",$prod->name);
                                        @endphp
                                        <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="single-product-area text-center">
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
                                                    @if(Auth::guard('user')->check())
                                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @else
                                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @endif
                                                    <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                              </span>
                                                    <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><i class="fa fa-cart-plus"></i>
                              </span>
                                                    <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                              </span>
                                                </div>



                                            </div>
                                            <div class="product-description text-center">
                                                <div class="product-name">{{strlen($prod->name) > 50 ? substr($prod->name,0,50)."..." : $prod->name}}</div>
                                                <div class="product-review">
                                                    <div class="ratings">
                                                        <div class="empty-stars"></div>
                                                        <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                    </div>
                                                </div>
                                                @if($gs->sign == 0)
                                                    <div class="product-price">{{$curr->sign}}
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>

                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>
                                                        {{$curr->sign}}
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--  Ending of featured product area   -->
@endif --}}

{{-- @if($gs->lb == 1)
    <!--  Starting of product banner area   -->
    <div class="product-banner-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                @foreach($imgs as $img)
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="single-banner-img">
                            <a href="{{$img->url}}" class="single-image-blog-box">
                                <img class="btbn" src="{{asset('assets//images/'.$img->photo)}}" alt="banner">

                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--  Ending of product banner area   -->
@endif --}}

{{-- @if($gs->lp == 1)
    <!--  Starting of new arrival product area   -->
    <div class="section-padding featured-product-wrap wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{$lang->new_arrival}}</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product-type-tab">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#featured1" class="tab-1">{{$lang->hot_sale}}</a></li>
                            <li><a data-toggle="tab" href="#latestSpecial1" class="tab-2">{{$lang->latest_special}}</a></li>
                            <li><a data-toggle="tab" href="#bestSeller1" class="tab-3">{{$lang->big_sale}}</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="featured1" class="tab-pane in active">
                                <div class="owl-carousel featured-carousel owl-test">
                                    @php
                                        $i=3000;
                                        $j=3000;
                                    @endphp
                                    @foreach($hproducts as $prod)
                                        @php
                                            $name = str_replace(" ","-",$prod->name);
                                        @endphp
                                        <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="single-product-area text-center">
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
                                                    @if(Auth::guard('user')->check())
                                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @else
                                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @endif
                                                    <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                              </span>
                                                    <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><i class="fa fa-cart-plus"></i>
                              </span>
                                                    <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                              </span>
                                                </div>



                                            </div>
                                            <div class="product-description text-center">
                                                <div class="product-name">{{strlen($prod->name) > 50 ? substr($prod->name,0,50)."..." : $prod->name}}</div>
                                                <div class="product-review">
                                                    <div class="ratings">
                                                        <div class="empty-stars"></div>
                                                        <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                    </div>
                                                </div>
                                                @if($gs->sign == 0)
                                                    <div class="product-price">{{$curr->sign}}
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>

                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>
                                                        {{$curr->sign}}
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                            <div id="latestSpecial1" class="tab-pane">
                                <div class="featured_loader"></div>
                                <div class="owl-carousel featured-carousel owl-test" style="display: none;">

                                    @php
                                        $i=5000;
                                        $j=5000;
                                    @endphp
                                    @foreach($lproducts as $prod)
                                        @php
                                            $name = str_replace(" ","-",$prod->name);
                                        @endphp
                                        <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="single-product-area text-center">
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
                                                    @if(Auth::guard('user')->check())
                                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @else
                                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @endif
                                                    <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                              </span>
                                                    <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><i class="fa fa-cart-plus"></i>
                              </span>
                                                    <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                              </span>
                                                </div>



                                            </div>
                                            <div class="product-description text-center">
                                                <div class="product-name">{{strlen($prod->name) > 50 ? substr($prod->name,0,50)."..." : $prod->name}}</div>
                                                <div class="product-review">
                                                    <div class="ratings">
                                                        <div class="empty-stars"></div>
                                                        <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                    </div>
                                                </div>
                                                @if($gs->sign == 0)
                                                    <div class="product-price">{{$curr->sign}}
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>

                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>
                                                        {{$curr->sign}}
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div id="bestSeller1" class="tab-pane">
                                <div class="featured_loader"></div>
                                <div class="owl-carousel featured-carousel owl-test" style="display: none;">
                                    @php
                                        $i=4000;
                                        $j=4000;
                                    @endphp
                                    @foreach($biproducts as $prod)
                                        @php
                                            $name = str_replace(" ","-",$prod->name);
                                        @endphp
                                        <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="single-product-area text-center">
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
                                                    @if(Auth::guard('user')->check())
                                                        <span class="wishlist hovertip uwish" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @else
                                                        <span class="wishlist hovertip no-wish" data-toggle="modal" data-target="#loginModal" rel-toggle="tooltip" title="{{$lang->wishlist_add}}"><i class="fa fa-heart"></i>
                                <span class="wish-number">{{App\Wishlist::where('product_id','=',$prod->id)->get()->count() }}</span>
                              </span>
                                                    @endif
                                                    <span class="wish-list hovertip wish-listt" data-toggle="modal" data-target="#myModal" rel-toggle="tooltip" title="{{$lang->quick_view}}"><i class="fa fa-eye"></i>
                              </span>
                                                    <span class="hovertip addcart" rel-toggle="tooltip" title="{{$lang->hcs}}"><i class="fa fa-cart-plus"></i>
                              </span>
                                                    <span class="hovertip compare" rel-toggle="tooltip" title="{{$lang->compare}}"><i class="fa fa-exchange"></i>
                              </span>
                                                </div>



                                            </div>
                                            <div class="product-description text-center">
                                                <div class="product-name">{{strlen($prod->name) > 50 ? substr($prod->name,0,50)."..." : $prod->name}}</div>
                                                <div class="product-review">
                                                    <div class="ratings">
                                                        <div class="empty-stars"></div>
                                                        <div class="full-stars" style="width:{{App\Review::ratings($prod->id)}}%"></div>
                                                    </div>
                                                </div>
                                                @if($gs->sign == 0)
                                                    <div class="product-price">{{$curr->sign}}
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>

                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        @if($prod->user_id != 0)
                                                            @php
                                                                $price = $prod->cprice + $gs->fixed_commission + ($prod->cprice/100) * $gs->percentage_commission ;
                                                            @endphp
                                                            {{round($price * $curr->value,2)}}
                                                        @else
                                                            {{round($prod->cprice * $curr->value,2)}}
                                                        @endif
                                                        <del class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del>
                                                        {{$curr->sign}}
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Ending of new arrival product area   -->
@endif --}}

{{-- @if($gs->pp == 1)
    <!--  Starting of countdown area   -->
    <div class="countdown-wrap wow fadeInUp" data-wow-duration="1s" style="background-image: url({{asset('assets//images/'.$gs->count_image)}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="count-down-text-wrap text-center">
                        <div class="count-down-header">
                            <h2>{{$gs->count_title}}</h2>
                            <h4>{{$gs->count_heading}}</h4>
                        </div>

                        <div class="countdown-timer-wrap">
                            <div id="clock"></div>
                        </div>

                        <div class="count-down-button">
                            <a href="{{$gs->count_link}}" class="btn btn-primary">{{$lang->shop_now}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Ending of countdown area   -->
@endif --}}
{{-- @if($gs->ftp == 1)
    <!--  Starting of video blog area   -->
    <div class="video-blog-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s" style="background-image: url({{asset('assets/images/'.$gs->vidimg)}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-text-area text-center">
                        <div class="video-header">
                            <h2>{{$lang->video_title}}</h2>
                        </div>
                        <div class="video-play-area">
                            <div class="video-play-btn">
                                <a class="fancybox" data-fancybox href="{{$gs->vid}}"><img src="{{asset('assets/front/images/video/video-play.png')}}" alt="video play"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Ending of video blog area   -->
@endif --}}

{{-- @if($gs->bs == 1)
    <!--  Starting of latest news area   -->
    <div class="section-padding latest-news-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{$lang->lns}}</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="owl-carousel latest-news-list">
                        @foreach($lblogs as $lblog)
                            <a href="{{route('front.blogshow',$lblog->slug)}}" class="single-news-list">
                                <div class="news-img">
                                    <img class="news-img" src="{{asset('assets/images/'.$lblog->photo)}}" alt="news image">
                                    <div class="news-list-meta"><span>{{date('d',strtotime($lblog->created_at))}}</span> {{date('M',strtotime($lblog->created_at))}}</div>
                                </div>
                                <div class="news-list-text">
                                    <h4 dir="{{$lang->rtl == 1 ? 'rtl':''}}">{{strlen($lblog->title) > 50 ? substr($lblog->title,0,50)."..." : $lblog->title}}</h4>
                                    <p dir="{{$lang->rtl == 1 ? 'rtl':''}}">{{substr(strip_tags($lblog->details),0,250)}}</p>
                                </div>
                                <hr/>
                                <div class="news-list-button"  dir="{{$lang->rtl == 1 ? 'rtl':''}}">
                                    <span class="news-btn">{{$lang->vd}}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Ending of latest news area   -->
@endif --}}
{{-- 
@if($gs->ts == 1)
    <!--  Starting of review carousel area   -->
    <div class="section-padding review-carousel-wrap overlay wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s" style="background-image: url({{asset('assets/images/'.$gs->cimg)}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{$lang->review_title}}</h2>
                    </div>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="owl-carousel review-carousel">
                        @foreach($ads as $ad)
                            <div class="single-review-carousel-area text-center">
                                <div class="review-carousel-profile">
                                    <img src="{{asset('assets/images/'.$ad->photo)}}" alt="review profile">
                                </div>
                                <div class="review-carousel-text">
                                    <h5 class="profile-name">{{$ad->client}}</h5>
                                    <p>{{$ad->review}}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Ending of review carousel area   -->
@endif --}}

{{-- @if($gs->bl == 1)
    <!-- Starting of client logo area -->
    <section class="section-padding client-logo-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>{{$lang->sue}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel logo-carousel">
                        @foreach($brands->chunk(10) as $brandz)
                            <ul class="logo-wrapper">
                                @foreach($brandz as $brand)
                                    <li><a href="{{$brand->url}}"><img src="{{asset('assets/images/'.$brand->photo)}}" alt="client logo"></a></li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ending of client logo area -->
@endif --}}
{{-- <script src="{{asset('assets/front/js/main.js')}}"></script> --}}
<script>
    //---------Countdown-----------
    // $('#clock').countdown('{{$gs->count_date}}', function(event) {
    //     $(this).html(event.strftime('<span class="countdown-timer-wrap"></span><span class="single-countdown-item">%w <br/><span>{{$lang->week}}</span></span> <span class="single-countdown-item">%d <br/><span>{{$lang->day}}</span></span> <span class="single-countdown-item">%H <br/><span>{{$lang->hour}}</span></span> <span class="single-countdown-item">%M <br/><span>{{$lang->minute}}</span></span> <span class="single-countdown-item">%S <br/><span>{{$lang->second}}</span></span> </span>'));
    // });
</script>
