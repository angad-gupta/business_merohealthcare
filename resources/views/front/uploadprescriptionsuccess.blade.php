@extends('layouts.front')
@section('title','Upload Prescription')
@section('content')

<style>
.btn-xl {
  line-height: 1.4;
  padding: 0.92857rem 1.85714rem;
  font-size: 1.28571rem;
  border-radius: 30px !important;
}
</style>

  <div class="section-padding blog-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 g-mb-30">
          <!-- Icon Blocks -->
          <div class="media g-mb-15">
            <div class="d-flex mr-4">
              <span class="u-icon-v4 u-icon-v4-rounded-10 u-icon-v4-bg-primary g-color-white">
                <span class="u-icon-v4-inner">
                  <i class="icon-education-087 u-line-icon-pro"></i>
                </span>
              </span>
            </div>
            <div class="media-body">
              <h3 class="h5 g-color-black mb-15">Upload Prescription</h3>
              <p class="g-color-gray-dark-v4">Upload image of prescription given by your doctor.</p>
            </div>
          </div>
          <!-- End Icon Blocks -->
        </div>
      
        <div class="col-lg-4 g-mb-30">
          <!-- Icon Blocks -->
          <div class="media g-mb-15">
            <div class="d-flex mr-4">
              <span class="u-icon-v4 u-icon-v4-rounded-10 u-icon-v4-bg-primary g-color-white">
                <span class="u-icon-v4-inner">
                  <i class="icon-education-035 u-line-icon-pro"></i>
                </span>
              </span>
            </div>
            <div class="media-body">
              <h3 class="h5 g-color-black mb-15">Analyze</h3>
              <p class="g-color-gray-dark-v4">We analyze your prescription and process your order</p>
            </div>
          </div>
          <!-- End Icon Blocks -->
        </div>
      
        <div class="col-lg-4 g-mb-30">
          <!-- Icon Blocks -->
          <div class="media g-mb-15">
            <div class="d-flex mr-4">
              <span class="u-icon-v4 u-icon-v4-rounded-10 u-icon-v4-bg-primary g-color-white">
                <span class="u-icon-v4-inner">
                  <i class="icon-education-141 u-line-icon-pro"></i>
                </span>
              </span>
            </div>
            <div class="media-body">
              <h3 class="h5 g-color-black mb-15">Delivery</h3>
              <p class="g-color-gray-dark-v4">We deliver your medicine at your doorsteps.</p>
            </div>
          </div>
          <!-- End Icon Blocks -->
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-12" style="background: white; padding:1rem 3rem">

          <section class="g-py-50--md g-py-80" style="background-image: url(../../assets/img/bg/bricks--white.png);">
            <div class="container text-center">
              <h2 class="text-uppercase g-font-weight-600 g-mb-20">Sucessfully Uploaded Prescription</h2>
          
              <p class="lead g-px-100--md g-mb-40">Thank you for your order and we will be in touch with you.</p>
              <div class="text-center">
           
                <a href="{{ route('front.index')}}" class="btn u-btn-primary g-font-weight-600 g-font-size-13 text-uppercase g-rounded-25 g-py-15 g-px-30 " role="button">Back to Home</a>
                </div>
              {{-- <a href="#" class="btn btn-xl u-btn-outline-darkgray text-uppercase g-font-weight-600 g-font-size-12 g-rounded-50 g-mb-15 g-mr-30--md">Try trial version</a>
              <div class="g-hidden-md-up"></div>
              <a href="#" class="btn btn-xl u-btn-primary text-uppercase g-font-weight-600 g-font-size-12 g-rounded-50 g-mb-15">Buy full version</a>
            </div> --}}
          </section>


          {{-- <h3 class="g-color-black g-font-weight-600 text-center mb-5">Sucessfully Uploaded Prescription</h3>
          <h4 class="g-color-black g-font-weight-600 text-center mb-5">Thank you for your order.</h5>
            <h4 class="g-color-black g-font-weight-600 text-center mb-5">Our staff will be in touch with you.</h5> --}}
          {{-- <form method="POST" action="/upload-prescription-submit" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Name</label>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="name" value="" placeholder="Enter Your Name" required="">
                </div>

                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Email</label>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="email" name="email" placeholder="Enter Your Email" value="" required="">
                </div>

                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Location</label>
                    <input id="geolocation" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" placeholder="Feedback" name="location" value="" required="" onclick="$('.locationModal').modal('show');" autocomplete="off">
                    <input id="latlong" type="hidden" name="latlong" value="">
                </div>

                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Phone</label>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="phone" placeholder="Your Phone" value="" required="">
                </div>

                <div class="col-md-12 form-group g-mb-40">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Prescription</label>
                    <input type="file" name="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                </div>
            </div>

            <div class="text-center">
              
            </div>
          </form> --}}

          
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade locationModal" ng-app="locationSelector" ng-controller="LocationController" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="margin-top: 0;">
        <div class="modal-header text-center" style="border-bottom: none;padding-bottom: 0">
            <h4><strong>SET A LOCATION</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <h6 style="margin-left: 15px;">Drag the pin to your exact location</h6>
        <h6 style="margin-left: 15px;">Or, Simply type your address below.</h6>

        <div class="modal-body text-center">
            <div class="input-group g-pb-13 g-px-0 g-mb-10">
              
              <input 
                places-auto-complete size=80
                types="['geocode']"
                component-restrictions="{country:'np'}"
                on-place-changed="placeChanged()"
                id="googleLocation" 
                ng-model="address.Address" 
                class="form-control g-brd-none g-brd-bottom g-brd-black g-brd-primary--focus g-color-black g-bg-transparent rounded-0" type="text" placeholder="Select Area" autocomplete="off">
                
              <button class="btn  u-btn-neutral rounded-0" type="button" ng-click="getLocation()"><i class="fa fa-crosshairs"></i></button>
            </div>
            
            <p ng-if="error" style="color:red;text-align: left">@{{ error }}</p>

            {{-- <div ng-show="address.place">
                    Address = @{{address.place.formatted_address}}<br/>
                    Location: @{{address.place.geometry.location}}<br/>
            </div> --}}

            <ng-map center="[27.7041765,85.3044636]" zoom="15" draggable="true">
                <marker position="27.7041765,85.3044636" title="Drag Me!" draggable="true" on-dragend="dragEnd($event)"></marker>
            </ng-map>
        </div>
        <div class="modal-footer" style="border-top: none; text-align: center; display: block;">
          <button type="button" ng-disabled="!isValidGooglePlace" class="btn btn-primary" style="width:100%" ng-click="confirmLocation()">Confirm</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
  <script src="/assets/front/js/ng-map.min.js"></script>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&libraries=places"></script>
  <script src="/assets/front/js/location.js"></script>
  
@endsection