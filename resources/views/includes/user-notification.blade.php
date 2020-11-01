      @php
        $conv_notf = App\UserNotification::where('user_id','=',Auth::guard('user')->user()->id)->where('is_read','=',0)->orderBy('id','desc')->get();
        $order_notf = App\Notification::where('order_id','!=',null)->where('vendor_id',Auth::guard('user')->user()->id)->where('is_read','=',0)->orderBy('id','desc')->get();

      @endphp       
      <style>
            .profile-comments span, .profile-notifi span, .profile-wishlist span {
            position: absolute;
            right: 0px;
            top: -9px;
            height: 20px;
            width: 20px;
            line-height: 20px;
            border-radius: 100%;
            background: #f14c49;
            color: #ffffff;
            font-size: 10px;
            text-align: center;
        }

    @media(min-width:320px) and (max-width:768px){
        #home{
            display: none !important;
        }
    }

    @media only screen and (max-width: 767px){
    .profile-info {
        margin-bottom: 20px;
        justify-content: flex-end ;
    }
    }
    </style>                         

                                            <div class="col-lg-4 col-md-7 col-sm-7 col-xs-12">
                                                
                                                <div class="profile-info dropdown">
                                                  

                                                    <div class="profile-comments" style="padding: 0 10px;">

                                                    <a id="home" href="{{route('front.index')}}">
                                                            <i class="icon-home" style="font-size: 24px;"></i>
                                                            
                                                        </a>

                                                        {{-- <a class="dropdown-toggle" id="conv_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-envelope" style="font-size:28px;"></i>
                                                            <span id="notf_conv" style="right:0;" style="background:#f14c49 !important;">{{ $conv_notf->count() }}</span>
                                                        </a> --}}

                                                        <div class="profile-notifi-content dropdown-menu">
                                                            
                                                        </div>
                                                    </div>

                                                    @if(Auth::guard('user')->user()->IsVendor()) 
                                                    <div class="profile-notifi" style="padding-left: 0;">
                                                        <a class="dropdown-toggle" id="order_notf" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-bell" style="font-size: 24px;
                                                            padding: 10px;
                                                            position: relative;
                                                            top: 2px;
                                                            right: -3px;
                                                           "></i>
                                                            <span id="notf_order">{{ $order_notf->count() }}</span>
                                                        </a>

                                                        <div class="profile-order-content dropdown-menu">
                                                        
                                                        </div>
                                                    </div>
                                                @endif

                                                    <div class="view-profile">
                                                        <div class="profile__img dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            {{-- @if(Auth::guard('user')->user()->is_provider == 1)
                                                                    <img src="{{ Auth::guard('user')->user()->photo ? Auth::guard('user')->user()->photo:asset('assets/images/user.png')}}" alt="profile image">
                                                                    @else
                                                                    <img src="{{ Auth::guard('user')->user()->photo ? asset('assets/images/'.Auth::guard('user')->user()->photo):asset('assets/images/user.png') }}" alt="profile image">
                                                            @endif 
                                                            <span>{{Auth::guard('user')->user()->name}}</span>  --}}
                                                           <span style="font-size:22px;"> <i class="icon-options-vertical"></i></span>
                                                        </div>
                                                        <div class="profile-content dropdown-menu">
                                                            <h5>{{$lang->welcome}}</h5>
                                                            <a style="margin-left: 4px;" href="{{route('user-profile')}}"><i class="icon-user"></i>{{$lang->edit}}</a>
                                                            <a href="{{route('user-reset')}}"><i class="icon-wrench"></i>{{$lang->reset}}</a>

                                                            <a href="{{route('user-logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-logout"></i>{{$lang->logout}}</a>
                                                            <form id="logout-form" action="{{route('user-logout')}}" method="POST" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>