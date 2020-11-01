@extends('layouts.front')
@section('title','Appilcation Received')
@section('content')   
    <style>
        @media(min-width:320px) and (max-width:720px){
    .display-4 {
        font-size: 2.5rem;
        font-weight: 300;
        line-height: 1.2;
    }
        }

        .btn-xl {
            line-height: 1.4;
            padding: 0.92857rem 1.85714rem;
            font-size: 1.28571rem;
            border-radius: 30px !important;
        }
    </style>
   
        <section class="g-py-50--md g-py-80">
            <div class="container text-center">
              <div class="row">
                <div class="col-md-10 ml-md-auto mr-md-auto">

                  <h2 class="display-4 text-uppercase g-font-weight-600 g-mb-20">
                    <span class="g-color-primary">Success !</span>
                    
                  </h2>
          
                  <p class="lead g-mb-40">Your appilcation has been received. Thank you for your application. We will contact u soon.</p>
          
                <a class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12" href="{{route('front.index')}}"><i class="icon-home"></i> Home</a>
                  {{-- @if(Auth::guard('user')->check())
                  <a class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12" href="#"><i class="icon-user"></i> {{$lang->fh}} </a>
                  @endif --}}
                </div>
              </div>
            </div>
          </section>

          
  
        
     
   



@endsection