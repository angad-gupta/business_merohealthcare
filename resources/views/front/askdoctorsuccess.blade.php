@extends('layouts.front')
@section('title','Ask Doctor')
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
    <style>


      #askdoctor{
       font-weight: 700 !important;
       color: #fefefe !important;
       background-color: #2385aa ;
       padding: 2px 15px !important;
       border-radius: 30px !important;
     }
   
     @media only screen and (max-width: 768px){
       #askdoctor{
       font-weight: 700 !important;
       color: #fefefe ;
       background-color: white !important;
       padding: 2px 15px !important;
       border-radius: 30px !important;
     
     }
   
     #askdoctor-mobile{
       font-weight: 700 !important;
       color: white !important;
       background-color: #2385aa ;
       padding: 2px 15px !important;
       border-radius: 30px !important;
     
     }
   
     #askdoctor-mobile-a{
       color:white !important;
     }
   
   }
   </style>
   
        <section class="g-py-50--md g-py-80">
            <div class="container text-center">
              <div class="row">
                <div class="col-md-10 ml-md-auto mr-md-auto">

                  <h2 class="display-4 text-uppercase g-font-weight-600 g-mb-20">
                    <span class="g-color-primary">Success !</span>
                    
                  </h2>
          
                  <p class="lead g-mb-40">Your queries have been sent. Check your mail box eventually to for reply.Thank you.</p>
          
                  <a class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12" href="{{route('front.index')}}" style="border-radius: 30px;"><i class="icon-home"></i> Home</a>
              
                </div>
              </div>
            </div>
          </section>

          
  
        
     
   



@endsection