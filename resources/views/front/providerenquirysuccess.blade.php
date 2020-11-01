@extends('layouts.front')
@section('title','Provider Enqiury Success')
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

<section class="g-py-50--md g-py-80">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-10 ml-md-auto mr-md-auto">

          <h2 class="display-4 text-uppercase g-font-weight-600 g-mb-20">
            <span class="g-color-primary">Success !</span>
            
          </h2>
  
          <p class="lead g-mb-40">We received your enquiry.We will be in touch with you.Thank you.</p>
  
          <a class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12" href="{{route('front.index')}}" style="border-radius: 30px;"><i class="icon-home"></i> Home</a>
          {{-- @if(Auth::guard('user')->check())
          <a class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12" href="#"><i class="icon-user"></i> {{$lang->fh}} </a>
          @endif --}}
        </div>
      </div>
    </div>
  </section>


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