@extends('layouts.front')
@section('title','Payment Sucessful')
@section('content')   
    <style>
        @media(min-width:320px) and (max-width:720px){
    .display-4 {
        font-size: 2.5rem;
        font-weight: 300;
        line-height: 1.2;
    }
        }
    </style>
        <!-- Starting of Account Dashboard area -->
    {{-- <div class="section-padding featured-product-wrap wow fadeInUp"> --}}
        {{-- 
            <div class="row">
                <div class="col-md-12 text-center" style="padding: 20px 0;">
                        {!! $gs->order_title !!}
                        {!! $gs->order_text !!}

                        <a href="{{route('front.index')}}" style="text-transform: uppercase; font-size: 20px;" class="button style-10"><i class="icon-home"></i> Home &nbsp;&nbsp;</a>
                        
                        @if(Auth::guard('user')->check())
                            <a href="{{route('user-dashboard')}}" style="text-transform: uppercase; font-size: 20px;" class="button style-10"><i class="icon-user"></i> {{$lang->fh}}</a>
                        @endif
                        
                </div>
            </div>
        </div> --}}
        <section class="g-py-50--md g-py-80">
            <div class="container text-center">
              <div class="row">
                <div class="col-md-10 ml-md-auto mr-md-auto">

                  <h2 class="display-4 text-uppercase g-font-weight-600 g-mb-20">
                    <span class="g-color-primary">THANK YOU FOR YOUR ORDER!</span>
                    
                  </h2>
          
                  <p class="lead g-mb-40">Your Order Has been Confirmed. We will be in touch with you.</p>
          
                  <a class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12" style="border-radius: 30px" href="/"><i class="icon-home"></i> Home</a>
                  @if(Auth::guard('user')->check())
                  <a class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12" style="border-radius: 30px" href="/user/dashboard"><i class="icon-user"></i> {{$lang->fh}} </a>
                  @endif
                </div>
              </div>
            </div>
          </section>

          
  
        
     
   



@endsection