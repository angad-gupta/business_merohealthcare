
     <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

     <style>
@media (min-width: 768px){
.col-md-4 {
-ms-flex: 0 0 32.33%;
flex: 0 0 32.33%;
max-width: 32.33%;

}


  .col-sm-6 .col-md-6 .col-lg-6 .col-xs-6 .col-6{
    -ms-flex: 0 0 49%;
    flex: 0 0 49%;
    max-width: 49%;
    }
  }



         

    @media (min-width: 992px){
    .col-lg-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 24% ;
    }
    }

    @media (min-width: 992px){
    .col-lg-6 {
    -ms-flex: 0 0 49%;
    flex: 0 0 49%;
    max-width: 49%;
    }
    }

    /* @media (min-width: 768px){
    .col-md-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 32.33%;
    }
    } */

    @media (min-width: 768px){
    .col-md-9 {
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 74%;
    }
    }

    .col-xs-8 {
    width: 65.67%;
    }

    @media (min-width: 768px){
    .col-md-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 40.67%;
    }
    }

    /* @media (min-width: 768px){
    .col-md-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 49%;
    }
    } */


     .single-footer-wrap li:first-child {
    padding-top: 5px;
        }

            .footer-top-wrap {
            padding: 40px 0 20px 0;
        }

        .single-footer-wrap h4 {
            color: #fff;
            margin-bottom: 10px;
        }
        /* h5{
            color: wheat;
        } */
        /* span{
            font-size:13px;
        }
        p{
            font-size: 13px;
        } */

        .single-footer-wrap li {
            padding: 5px 0;
            -webkit-transition: all .4s ease;
            transition: all .4s ease;
            position: relative;
        }
    </style>

<div class="g-bg-primary">
    <div class="container g-py-20">
      <div class="row justify-content-center">
        <div class="col-md-4 mx-auto g-py-20">
          <!-- Media -->
          <div class="media">
            <i class="d-flex g-color-white g-font-size-40 g-pos-rel g-top-3 mr-4 icon-real-estate-048 u-line-icon-pro"></i>
            <div class="media-body">
              <span class="d-block g-color-white g-font-weight-500 g-font-size-17 text-uppercase"  style="font-size:15px;">Free Delivery</span>
              <span class="d-block g-color-white-opacity-0_8" style="font-size:13px;">On purchase over NPR 500 (inside Kathmandu Valley only)<br>
                Npr 150-Npr 300 delivery charge will be added for delivery outside valley. Outside valley delivery charge price are subjected by delivery place and purchase quantity.
                 </span>
            </div>
          </div>
          <!-- End Media -->
        </div>
  
        <div class="col-md-4 mx-auto g-brd-x--md g-brd-white-opacity-0_3 g-py-20">
          <!-- Media -->
          <div class="media">
            <i class="d-flex g-color-white g-font-size-40 g-pos-rel g-top-3 mr-4 icon-real-estate-040 u-line-icon-pro"></i>
            <div class="media-body">
              <span class="d-block g-color-white g-font-weight-500 g-font-size-17 text-uppercase" style="font-size:15px;">Inclusive Of VAT</span>
              <span class="d-block g-color-white-opacity-0_8" style="font-size:13px;">Prices are inclusive of VAT for product marked by symbol * on the product name.
             </span>
            </div>
          </div>
          <!-- End Media -->
        </div>
  
        <div class="col-md-4 mx-auto g-py-20">
          <!-- Media -->
          <div class="media">
            <i class="d-flex g-color-white g-font-size-40 g-pos-rel g-top-3 mr-4 icon-present"></i>
            <div class="media-body text-left">
              <span class="d-block g-color-white g-font-weight-500 g-font-size-17 text-uppercase" style="font-size:15px;">Get 5% Additional Discount </span>
            <span class="d-block g-color-white-opacity-0_8" style="font-size:13px;">Sign up and get additional 5% discount on your first purchase using (MERO) code.</span>
            <a href="{{route('front.discount.offers')}}" style="color: #7ef725;">Read More</a>
            </div>
          </div>
          <!-- End Media -->
        </div>
      </div>
    </div>
  </div>


  
   <footer class="">
      {{-- <div class="subscribe-newsletter-wrap">
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
      </div> --}}
      <div class="footer-top-wrap" style="background-image: url({{asset('assets/images/'.$gs->footer_background)}})">
          <div class="container">
              <div class="row">
                  @if($lang->rtl == 1)
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="single-footer-wrap contact">
                          <h5 class="footer-title text-right" style="color:wheat;">{{$lang->contact}}</h5>
                          <ul>
                          @if($gs->street != null)    
                              <li><a ><i class="fa fa-map-marker" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->street}}</span>
                              </a></li>
                          @endif
                          @if($gs->phone != null) 
                              <li><a href="tel:{{$gs->phone}}"><i class="fa fa-phone" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->phone}}</span>
                              </a></li>
                          @endif
                          @if($gs->email != null)
                          <li><a href="mailto:{{$gs->email}}"><i class="fa fa-envelope" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->email}}</span>
                              </a></li>
                          @endif
                          @if($gs->site != null)
                              <li><a href="{{$gs->site}}"><i class="fa fa-globe" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->site}}</span>
                              </a></li>
                          @endif
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="single-footer-wrap">
                          <h5 class="footer-title text-right" style="color:wheat;">{{$lang->lns}}</h5>
                          <ul>
                          @foreach($lblogs as $lblog)
                              <li>
                                  {{-- <img height="30" width="31" src="{{asset('assets/images/'.$lblog->photo)}}" alt="footer image"> --}}
                                  <span><a href="{{route('front.blogshow',$lblog->slug)}}" style="font-size:13px;">{{strlen($lblog->title) > 30 ? substr($lblog->title,0,30)."..." : $lblog->title}}</a></span>
                              </li>
                          @endforeach
                                <li>See more</li>
                          </ul>
                      </div>
                  </div>
                  {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="single-footer-wrap information">
                          <h5 class="footer-title text-right" style="color:wheat;">Quick Links</h5>
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
                  </div> --}}
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="single-footer-wrap">
                          <h5 class="footer-title text-right" style="color:wheat;">{{$lang->about}}</h5>
                          <p dir="rtl" style="text-align: justify; font-size:13px;">
                              {{$gs->about}}
                          </p>
                      </div>
                  </div>
              @else
                  <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="single-footer-wrap">
                          <h5 class="footer-title" style="color:wheat;">{{$lang->about}}</h5>
                          <p style="text-align: justify; font-size:13px;">
                              {{$gs->about}}
                          </p>
                      </div>
                  </div>
                
                  <div class="col-lg-3 col-md-3 col-sm-6">
                      <div class="single-footer-wrap contact">
                          <h5 class="footer-title" style="color:wheat;">{{$lang->contact}}</h5>
                          <ul>
                          @if($gs->street != null)    
                              <li><a href="{{route('front.contact')}}" style="font-size:13px;"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->street}}</span>
                              </a></li>
                          @endif
                          @if($gs->phone != null) 
                              <li><a href="tel:{{$gs->phone}}" style="font-size:13px;"><i class="fa fa-phone" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->phone}}</span>
                              </a></li>
                          @endif
                          @if($gs->email != null)
                          <li><a href="mailto:{{$gs->email}}" style="font-size:13px;"><i class="fa fa-envelope" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->email}}</span>
                            </a></li>
                          @endif
                          @if($gs->site != null)
                              <li><a href="{{$gs->site}}" style="font-size:13px;"><i class="fa fa-globe" aria-hidden="true"></i>
                                  <span style="font-size:13px;">{{$gs->site}}</span>
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
                              <i class="fa fa-instagram"></i>
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
                      <div class="footer-copyright-area" style="font-size:13px; color:wheat;">
                          {!!$gs->footer!!} | Powered By Incube <a href="https://www.incubeweb.com/" style="color:#28a745"> Incube</a>
                      </div>
                  </div>
                  @else
                  <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                      <div class="footer-copyright-area" style="font-size:13px; color:wheat;">
                          {!!$gs->footer!!} | Powered By <a href="https://www.incubeweb.com/" style="color:#28a745"> Incube</a>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                      <div class="footer-social-links">
                          <ul>
                          @if($sl->f_status == 1)
                          <li><a class="facebook" target="_blank" href="{{$sl->facebook}}" style="border-radius:30px;">
                              <i class="fa fa-facebook"></i>
                          </a></li>
                          @endif
                          @if($sl->g_status == 1)
                          <li><a class="google" target="_blank" href="{{$sl->gplus}}" style="border-radius:30px;">
                              <i class="fa fa-instagram"></i>
                          </a></li>
                          @endif
                          @if($sl->t_status == 1)
                          <li><a class="twitter" target="_blank" href="{{$sl->twitter}}" style="border-radius:30px;">
                              <i class="fa fa-twitter"></i>
                          </a></li>
                          @endif
                          @if($sl->l_status == 1)
                          <li><a class="tumblr" target="_blank" href="{{$sl->linkedin}}" style="border-radius:30px;">
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
     </main>
  
         @if (Session::has('success'))
         <div class="container">
             <div class="row">
               <div>
                 <div data-notify="container" class="col-xs-11 col-sm-4 alert alert-success alert-dismissible fade show" role="alert" data-notify-position="bottom-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; bottom: 20px; right: 10px; animation-iteration-count: 1;">
                   <button type="button" class="close u-alert-close--light" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                   <h4 class="h5">
                     <i class="fa fa-check-circle"></i>
                     Success
                   </h4>
                   <p>{{Session::get('success')}}</p>              
               </div>
           </div>
           </div>
         </div>
         @endif
         {{-- {{dd(Session::get('error'))}} --}}
        
         @if (Session::has('error'))
         <div class="container">
             <div class="row">
               <div>
                 <div data-notify="container" class="col-xs-11 col-sm-4 alert alert-danger alert-dismissible fade show" role="alert" data-notify-position="bottom-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; bottom: 20px; right: 10px; animation-iteration-count: 1;">
                   <button type="button" class="close u-alert-close--light" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                   <h4 class="h5">
                     <i class="fa fa-check-circle"></i>
                     Oops
                   </h4>
                    <p>{{Session::get('error')}}</p>              

               </div>
           </div>
           </div>
         </div>
         @endif
     
         <!-- JS Global Compulsory -->
         <script src="/frontend-assets/main-assets/assets/vendor/jquery/jquery.min.js"></script>
        <script src="{{asset('assets/user/js/notify.js')}}"></script>

        {{-- <script src="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.js"></script> --}}

         <script src="/frontend-assets/main-assets/assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
         <script src="/frontend-assets/main-assets/assets/vendor/popper.min.js"></script>
         <script src="/frontend-assets/main-assets/assets/vendor/bootstrap/bootstrap.min.js"></script>
     
         <!-- JS Implementing Plugins -->
         {{-- <script src="/frontend-assets/main-assets/assets/js/components/hs.popup.js"></script> --}}
         <script src="/frontend-assets/main-assets/assets/vendor/appear.js"></script>
         <script src="/frontend-assets/main-assets/assets/vendor/slick-carousel/slick/slick.js"></script>
         <script src="/frontend-assets/main-assets/assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
     
         <!-- JS Unify -->
         <script src="/frontend-assets/main-assets/assets/js/hs.core.js"></script>
         <script src="/frontend-assets/main-assets/assets/js/components/hs.header.js"></script>
          <script src="/frontend-assets/main-assets/assets/js/components/hs.dropdown.js"></script>
         <script src="/frontend-assets/main-assets/assets/js/helpers/hs.hamburgers.js"></script>
         <script src="/frontend-assets/main-assets/assets/js/components/hs.scroll-nav.js"></script>
         <script src="/frontend-assets/main-assets/assets/js/helpers/hs.height-calc.js"></script>
         <script src="/frontend-assets/main-assets/assets/js/components/hs.carousel.js"></script>
         <script src="/frontend-assets/main-assets/assets/js/components/hs.go-to.js"></script>
     
         <!-- JS Customization -->
         <script src="/frontend-assets/main-assets/assets/js/custom.js"></script>
         <script  src="/frontend-assets/main-assets/assets/js/components/hs.tabs.js"></script>
         <script  src="/frontend-assets/main-assets/assets/vendor/custombox/custombox.min.js"></script>

        <!-- JS Unify -->
        <script  src="/frontend-assets/main-assets/assets/js/components/hs.modal-window.js"></script>

        <!-- JS Plugins Init. -->
        <script >
        $(document).on('ready', function () {
            // initialization of popups
            $.HSCore.components.HSModalWindow.init('[data-modal-target]');
        });
        </script>

         <script>
                $(document).on('ready', function () {
                  // initialization of carousel
                  $('#carousel5').on('click', '.js-thumb', function (e) {
                    e.stopPropagation();
                    var i = $(this).data('slick-index');
          
                      $('#carousel5').slick('slickGoTo', i);
                    
                  });
                 $('.js-mega-menu').HSMegaMenu();
          
                   $.HSCore.components.HSHeader.init($('#js-header'));
          
                  $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
                    afterOpen: function () {
                      $(this).find('input[type="search"]').focus();
                    }
                  });
          
                  $.HSCore.components.HSCarousel.init('.js-carousel');
          
                  // initialization of header
                  $.HSCore.components.HSHeader.init($('#js-header'));
                  $.HSCore.helpers.HSHamburgers.init('.hamburger');
          
                  // initialization of header height offset
                  $.HSCore.helpers.HSHeightCalc.init();
          
                  // initialization of go to section
                  $.HSCore.components.HSGoTo.init('.js-go-to');
                });
          
          
                $(window).on('load', function() {
                  // initialization of HSScrollNav
                  $.HSCore.components.HSScrollNav.init($('#js-scroll-nav'), {
                    duration: 700
                  });
                });
              </script>

               <!-- JS Implementing Plugins -->
       
        <script  src="/frontend-assets/main-assets/assets/js/components/hs.onscroll-animation.js"></script>

        <!-- JS Plugins Init. -->
        <script >
            $(document).on('ready', function () {
            // initialization of scroll animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');
            });
        </script>

     

    
        @yield('js')
         <!-- JS Plugins Init. -->
       
       </body>
     </html>
     