
  <!-- Starting of footer area -->
  <footer class="footer-wrap">
    <div class="subscribe-newsletter-wrap">
        <div class="container">
            <div class="row">
                @if($lang->rtl == 1)
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="subscribe-newsletter-text-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
                                <div class="subscribe-form">
                                    <form action="{{route('front.subscribe.submit')}}" method="POST">
                                        {{csrf_field()}}
                                        <button type="submit" class="subscribe-btn">{{$lang->s}}</button> 
                                        <input type="email" name="email" id="subscribe_email" placeholder="{{$lang->supl}}" required> 
                                    </form>                                
                                </div>
                            </div>
                            <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-xs-4">
                                <h4>{{$lang->ston}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="subscribe-newsletter-text-area">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5">
                                <h4>{{$lang->ston}}</h4>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-7">
                                <div class="subscribe-form">
                                    <form action="{{route('front.subscribe.submit')}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="email" name="email" id="subscribe_email" placeholder="{{$lang->supl}}" required>
                                        <button type="submit" class="subscribe-btn">{{$lang->s}}</button>  
                                    </form>                                
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="footer-top-wrap" style="background-image: url({{asset('assets/images/'.$gs->footer_background)}})">
        <div class="container">
            <div class="row">
                @if($lang->rtl == 1)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-wrap contact">
                        <h4 class="footer-title text-right">{{$lang->contact}}</h4>
                        <ul>
                        @if($gs->street != null)    
                            <li><a><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>{{$gs->street}}</span>
                            </a></li>
                        @endif
                        @if($gs->phone != null) 
                            <li><a href="tel:{{$gs->phone}}"><i class="fa fa-phone" aria-hidden="true"></i>
                                <span>{{$gs->phone}}</span>
                            </a></li>
                        @endif
                        @if($gs->email != null)
                        <li><a href="mailto:{{$gs->email}}"><i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>{{$gs->email}}</span>
                            </a></li>
                        @endif
                        @if($gs->site != null)
                            <li><a href="{{$gs->site}}"><i class="fa fa-globe" aria-hidden="true"></i>
                                <span>{{$gs->site}}</span>
                            </a></li>
                        @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-wrap">
                        <h4 class="footer-title text-right">{{$lang->lns}}</h4>
                        <ul>
                        @foreach($lblogs as $lblog)
                            <li>
                                <img height="30" width="31" src="{{asset('assets/images/'.$lblog->photo)}}" alt="footer image">
                                <span><a href="{{route('front.blogshow',$lblog->slug)}}">{{strlen($lblog->title) > 30 ? substr($lblog->title,0,30)."..." : $lblog->title}}</a></span>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-wrap information">
                        <h4 class="footer-title text-right">{{$lang->fl}}</h4>
                        <ul>
                                <li><a href="{{route('front.index')}}"><i class="fa fa-angle-double-left"></i> &nbsp;{{$lang->home}}</a></li>
                            @if($ps->f_status == 1)
                                <li><a href="{{route('front.faq')}}"><i class="fa fa-angle-double-left"></i> &nbsp;{{$lang->faq}}</a></li>
                            @endif
                            @if($ps->c_status == 1)
                                <li><a href="{{route('front.contact')}}"><i class="fa fa-angle-double-left"></i> &nbsp;{{$lang->contact}}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-wrap">
                        <h4 class="footer-title text-right">{{$lang->about}}</h4>
                        <p dir="rtl">
                            {{$gs->about}}
                        </p>
                    </div>
                </div>
            @else
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="single-footer-wrap">
                        <h4 class="footer-title">{{$lang->about}}</h4>
                        <p>
                            {{$gs->about}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="single-footer-wrap information">
                        <h4 class="footer-title">{{$lang->fl}}</h4>
                        <ul>
                                <li><a href="{{route('front.index')}}"><i class="fa fa-angle-double-right"></i> &nbsp;{{$lang->home}}</a></li>
                            @if($ps->f_status == 1)
                                <li><a href="{{route('front.faq')}}"><i class="fa fa-angle-double-right"></i> &nbsp;{{$lang->faq}}</a></li>
                            @endif
                            @if($ps->c_status == 1)
                                <li><a href="{{route('front.contact')}}"><i class="fa fa-angle-double-right"></i> &nbsp;{{$lang->contact}}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="single-footer-wrap">
                        <h4 class="footer-title">{{$lang->lns}}</h4>
                        <ul>
                        @foreach($lblogs as $lblog)
                            <li>
                                <img height="30" width="31" src="{{asset('assets/images/'.$lblog->photo)}}" alt="footer image">
                                <span><a href="{{route('front.blogshow',$lblog->slug)}}">{{strlen($lblog->title) > 30 ? substr($lblog->title,0,30)."..." : $lblog->title}}</a></span>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="single-footer-wrap contact">
                        <h4 class="footer-title">{{$lang->contact}}</h4>
                        <ul>
                        @if($gs->street != null)    
                            <li><a><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>{{$gs->street}}</span>
                            </a></li>
                        @endif
                        @if($gs->phone != null) 
                            <li><a href="tel:{{$gs->phone}}"><i class="fa fa-phone" aria-hidden="true"></i>
                                <span>{{$gs->phone}}</span>
                            </a></li>
                        @endif
                        @if($gs->email != null)
                        <li><a href="mailto:{{$gs->email}}"><i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>{{$gs->email}}</span>
                            </a></li>
                        @endif
                        @if($gs->site != null)
                            <li><a href="{{$gs->site}}"><i class="fa fa-globe" aria-hidden="true"></i>
                                <span>{{$gs->site}}</span>
                            </a></li>
                        @endif
                        </ul>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
    <div class="footer-bottom-wrap">
        <div class="container">
            <div class="row">
                @if($lang->rtl == 1)
                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                    <div class="footer-social-links">
                        <ul>
                        @if($sl->f_status == 1)
                        <li><a class="facebook" target="_blank" href="{{$sl->facebook}}">
                            <i class="fa fa-facebook"></i>
                        </a></li>
                        @endif
                        @if($sl->g_status == 1)
                        <li><a class="google" target="_blank" href="{{$sl->gplus}}">
                            <i class="fa fa-google"></i>
                        </a></li>
                        @endif
                        @if($sl->t_status == 1)
                        <li><a class="twitter" target="_blank" href="{{$sl->twitter}}">
                            <i class="fa fa-twitter"></i>
                        </a></li>
                        @endif
                        @if($sl->l_status == 1)
                        <li><a class="tumblr" target="_blank" href="{{$sl->linkedin}}">
                            <i class="fa fa-linkedin"></i>
                        </a></li>
                        @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                    <div class="footer-copyright-area">
                        {!!$gs->footer!!}
                    </div>
                </div>
                @else
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                    <div class="footer-copyright-area">
                        {!!$gs->footer!!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                    <div class="footer-social-links">
                        <ul>
                        @if($sl->f_status == 1)
                        <li><a class="facebook" target="_blank" href="{{$sl->facebook}}">
                            <i class="fa fa-facebook"></i>
                        </a></li>
                        @endif
                        @if($sl->g_status == 1)
                        <li><a class="google" href="{{$sl->gplus}}">
                            <i class="fa fa-google"></i>
                        </a></li>
                        @endif
                        @if($sl->t_status == 1)
                        <li><a class="twitter" href="{{$sl->twitter}}">
                            <i class="fa fa-twitter"></i>
                        </a></li>
                        @endif
                        @if($sl->l_status == 1)
                        <li><a class="tumblr" href="{{$sl->linkedin}}">
                            <i class="fa fa-linkedin"></i>
                        </a></li>
                        @endif
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</footer>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>