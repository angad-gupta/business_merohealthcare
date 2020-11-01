@extends('layouts.front')
@section('title','Provider Enqiury')
@section('content')

<style>
.footer-wrap{
    margin-top: 0px;
}
input:not([type=range]), label, select, summary, textarea {
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    border-radius: 30px;
}
</style>

<div style="background: rgb(35,133,170);
background: radial-gradient(circle, rgba(35,133,170,1) 0%, rgba(148,218,233,1) 68%);">
<section class="container g-py-50">
    <div class="row g-mb-20">
      <div class="col-lg-6 g-mb-50">
        <!-- Heading -->
        <h2 class="h1 g-color-black g-font-weight-700 mb-4">How can we assist you?</h2>
        <p class="g-font-size-18 mb-0">We provide online based lab services to customers. Here u can join your lab with us. For Futher info fill the form.</p>
        <!-- End Heading -->
      </div>
      <div class="col-lg-3 align-self-end ml-auto g-mb-50">
        <div class="media">
          <div class="d-flex align-self-center">
            <span class="u-icon-v2 u-icon-size--sm g-color-white g-bg-primary rounded-circle mr-3">
                <i class="g-font-size-16 icon-communication-033 u-line-icon-pro"></i>
              </span>
          </div>
          <div class="media-body align-self-center">
            <h3 class="h6 g-color-black g-font-weight-700 text-uppercase mb-0">Phone Number</h3>
            <p class="mb-0">+977-1-5902444</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 align-self-end ml-auto g-mb-50">
        <div class="media">
          <div class="d-flex align-self-center">
            <span class="u-icon-v2 u-icon-size--sm g-color-white g-bg-primary rounded-circle mr-3">
                <i class="g-font-size-16 icon-communication-062 u-line-icon-pro"></i>
              </span>
          </div>
          <div class="media-body align-self-center">
            <h3 class="h6 g-color-black g-font-weight-700 text-uppercase mb-0">Email Address</h3>
            <p class="mb-0">info@merohealthcare.com</p>
          </div>
        </div>
      </div>
    </div>

    <form action="{{route('provider-enquiry-send')}}" method="POST" >
        {{csrf_field()}}

    <div class="row justify-content-center">
      <div class="col-md-5">
       
           
          <div class="row">
            <div class="col-md-6 form-group g-mb-20">
              <label class="g-color-gray-dark-v2 g-font-size-13">First name</label>
              <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" name="first_name" type="text" placeholder="John">
            </div>

            <div class="col-md-6 form-group g-mb-20">
              <label class="g-color-gray-dark-v2 g-font-size-13">Last name</label>
              <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" name="last_name" type="text" placeholder="Doe">
            </div>
          </div>

          <div class="g-mb-20">
            <label class="g-color-gray-dark-v2 g-font-size-13">Your email</label>
            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" name="email" type="email" placeholder="johndoe@gmail.com">
          </div>

          <div class="g-mb-20">
            <label class="g-color-gray-dark-v2 g-font-size-13">Company Name</label>
            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" name="company_name" type="text" placeholder="johndoe@gmail.com">
          </div>

          <div class="g-mb-20">
            <label class="g-color-gray-dark-v2 g-font-size-13">Phone number</label>
            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" name="phone" type="tel" placeholder="9841000000">
          </div>

        </form>
      </div>
      <div class="col-md-7">
        <div class="g-mb-40">
          <label class="g-color-gray-dark-v2 g-font-size-13">Your message</label>
          <textarea class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="12" name="message" placeholder="Hi there, I would like to ..." style="border-radius :30px;"></textarea>
        </div>

        <div class="text-center">
          <button class="btn u-btn-primary g-font-weight-600 g-font-size-13 text-uppercase rounded-3 g-py-12 g-px-35" type="submit" role="button" style="border-radius: 30px;"><i class="icon-cursor"></i> Send</button>
        </div>
      </div>
    </div>
    </form>
  </section>
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