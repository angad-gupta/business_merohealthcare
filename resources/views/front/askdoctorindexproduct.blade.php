@extends('layouts.front')
@section('title','Ask Doctor')
@section('content')

<style>
.rounded-0 {
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

  <div class="section-padding">
    <div class="container">

        <div class="shortcode-html">
            <section class="g-flex-centered g-min-height-500 g-bg-gray-light-v5 g-py-20" style="border-radius:30px; background-image: url(../../assets/img-temp/1920x1080/img10.jpg);">
              <div class="container u-bg-overlay__inner">
                <div class="row">
                  

                  <div class="col-md-6 align-self-center g-py-20 text-center">
                    <img class="w-100 rounded-circle" src="/assets/doctor.jpeg" alt="Iamge Description" style="width:150px !important; height:150px;" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                  </div>

                  <div class="col-md-6 align-self-center g-py-20">

                    <article class="h-100 g-flex-middle g-brd-left g-brd-3 g-brd-primary g-pa-20">
                        <div class="g-flex-middle-item">
                          {{-- <h4 class="h6 g-color-black g-font-weight-600 text-uppercase g-mb-10">Coaching &amp; Planning</h4>
                          <p class="g-color-black-opacity-0_7 mb-0">Now that your brand is all dressed up and ready to party.</p> --}}
                          <div class="g-py-5">
                            <div class="g-mb-15">
                              <h4 class="h5 g-color-black g-mb-5">Dr. Ranjan Kunwar</h4>
                              <em class="d-block u-info-v1-2__item g-font-style-normal g-font-size-14 text-uppercase g-color-primary">MBBS</em>
                            </div>
    
                            <ul class="list-unstyled g-color-gray-dark-v8">
                                <li class="g-font-size-14">
                                    <strong>NMC No:</strong> 19178
                                  </li>
    
                                {{-- <li class="g-font-size-14">
                                  <strong>Email:</strong> something@example.com
                                </li> --}}
                                {{-- <li class="g-font-size-12">
                                  <strong>Mobile:</strong> +977 9803256987
                                </li> --}}
                              </ul>
                         
                          </div>
                        </div>
                      </article>

                    
                  </div>
                </div>

                <form action="{{route('user-askdoctor-product')}}" method="POST" >
                    {{csrf_field()}}

                    @php
                    $user = Auth::guard('user')->user();
                        
                    @endphp

                   
                  <div class="form-group g-mb-20">
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group g-mb-20">
                                <label class="g-mb-10" for="inputGroup1_1" >Your Email : </label>
                                @if(Auth::guard('user')->check())
                                <input id="inputGroup1_1" value="{{$user->email}}" name="email" class="form-control form-control-md rounded-0" type="email" placeholder="Enter email" required>
                                @else
                                <input id="inputGroup1_1" value=" " name="email" class="form-control form-control-md rounded-0" type="email" placeholder="Enter email" required>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group g-mb-20">
                                <label class="g-mb-10" for="inputGroup1_1" >Phone Number : </label>
                                @if(Auth::guard('user')->check())
                                <input id="inputGroup1_1" value="{{$user->phone }} " name="phone" class="form-control form-control-md rounded-0" type="tel" placeholder="Enter phone" required>
                                @else
                                <input id="inputGroup1_1" value="" name="phone" class="form-control form-control-md rounded-0" type="tel" placeholder="Enter phone" required>
                                @endif
                            </div>
                        </div>
        
                      </div>
                    <label class="g-mb-10" for="inputGroup2_2">What is your question ?</label>
                    
                    
                    @if($product)
                    <textarea id="inputGroup2_3" class="form-control form-control-md u-textarea-expandable rounded-0" name="query" style="max-height:200px;" rows="3" placeholder="Write you queries..." required>Want to Know about this {{$product->name}} product?</textarea>
                    @else
                    <textarea id="inputGroup2_3" class="form-control form-control-md u-textarea-expandable rounded-0" name="query" style="max-height:200px;" rows="3" placeholder="Write you queries..." required></textarea>
                    @endif
                    <small class="form-text text-muted g-font-size-default g-mt-10">
                          {{-- <strong>Note:</strong> expands on focus. --}}
                    </small>
                  </div>

                  @include('includes.form-success')

                  <div class="row text-center g-mb-10">
                    @if($lang->rtl == 1)
                    <div class="col-md-2 col-md-offset-6 col-sm-2 col-sm-offset-4 col-xs-2 col-xs-offset-4">
                        <span style="cursor: pointer; float: right;" class="refresh_code"><i class="fa fa-refresh fa-2x" style="margin-top: 10px;"></i></span>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <img id="codeimg" src="{{url('assets/images')}}/capcha_code.png">
                    </div>
                    @else
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <img id="codeimg" src="{{url('assets/images')}}/capcha_code.png">
                        <span id="captcha" style="cursor: pointer; padding:10px;" class="refresh_code"><i class="fa fa-refresh fa-2x" style="margin-top: 10px;"></i></span>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                       
                    </div>
                    @endif
                </div>

                  @if($lang->rtl == 1)
                  <div class="row">
                    <div class="col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6 col-xs-8 col-xs-offset-4">
                        <input class="form-control rounded-0" name="codes" placeholder="{{$lang->enter_code}}" required="" type="text">
                    </div>
                  </div>
                  @else
                  <div class="row">
                  <div class="col-md-4 col-sm-6 col-xs-8">

                          <input class="form-control rounded-0" name="codes" placeholder="{{$lang->enter_code}}" required="" type="text">
                          {{-- <input  name="contact_btn" value="{{$lang->sm}}" type="submit" style="border-radius:30px;"> --}}
                      </div>
                  </div>
                  @endif
        
                <h6 class="text-center">Complete privacy and anonymity guaranteed • Quick responses </h6>
                <div class="text-center ">
             
                  {{-- <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button> --}}
                  <button type="submit" class="btn btn-primary" style="border-radius:30px;"><i class="icon-cursor"></i> Ask Question </button>
                
                </div>

                <input name="product_id" value="{{$product->id}}" hidden/>
            </form>
            
              </div>

              
            </section>

            
          </div>
        
       
        

        
      </div>
    </div>
  </div>


  <div class="shortcode-scripts">
    <!-- JS Implementing Plugins -->
    <script  src="/frontend-assets/main-assets/assets/vendor/appear.js"></script>

    <!-- JS Unify -->
    <script  src="/frontend-assets/main-assets/assets/js/components/hs.onscroll-animation.js"></script>

    <!-- JS Plugins Init. -->
    <script >
      $(document).ready(function () {
        // initialization of scroll animation
        $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');
      });
    </script>
  </div>

@endsection

@section('js')
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
  <script src="/assets/front/js/ng-map.min.js"></script>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&libraries=places"></script>
  <script src="/assets/front/js/location.js"></script>
  
@endsection

@section('scripts')
    <script>
        $('.refresh_code').click(function () {
            $.get('{{url('contact/refresh_code')}}', function(data, status){
                $('#codeimg').attr("src","{{url('assets/images')}}/capcha_code.png?time="+ Math.random());
            });
        })
    </script>
    <script>
      jQuery(function(){
         jQuery('#captcha').click();
      });
      </script>
@endsection