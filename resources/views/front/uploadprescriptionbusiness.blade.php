@extends('layouts.front')
@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

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
                          <h3 class="h5 g-color-black mb-15">Upload Prescription </h3>
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
                  <h3 class="g-color-black g-font-weight-600 text-center mb-5">Send your Business Details</h3>
                  <form method="POST" action="{{route('business-order')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6 form-group g-mb-20">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Name *</label>
                        <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="name" value="{{$user->name}}" placeholder="Enter Your Name" required="">
                        </div>
        
                        <div class="col-md-6 form-group g-mb-20">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Email *</label>
                            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="email" name="email" placeholder="Enter Your Email" value="{{$user->email}}" required="">
                        </div>
        
                        <div class="col-md-6 form-group g-mb-20">
                          <label class="g-color-gray-dark-v2 g-font-size-13">Address *</label>
                          <input id="geolocation" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" placeholder="Feedback" name="address" value="{{$user->address}}" required="" onclick="$('.locationModal').modal('show');" autocomplete="off">
                          <input id="latlong" type="hidden" name="latlong" value="">
                      </div>
      
                        <div class="col-md-6 form-group g-mb-20">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Phone *</label>
                            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="phone" placeholder="Your Phone" value="{{$user->phone}}" required="">
                        </div>

                        <div class="col-md-6 form-group g-mb-20">
                          <label class="g-color-gray-dark-v2 g-font-size-13">Company Name *</label>
                          <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="company_name" placeholder="Company name" value="{{$user->company_name}}" required="">
                      </div>

                        <div class="col-md-6 form-group g-mb-20">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Company PAN / VAT *</label>
                            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="pan_vat" placeholder="Pan / Vat" value="{{$user->pan_vat}}" required="">
                        </div>
                        

                        <div class="col-md-6 form-group g-mb-20">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Registration Number *</label>
                            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="reg_no" placeholder="Registration Number" value="{{$user->registration_number}}" required="">
                        </div>

                        <div class="col-md-6 form-group g-mb-20">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Quantity *</label>
                            <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="quantity" placeholder="Quantity" value="" required="">
                        </div>

                        <div class="col-md-6 form-group g-mb-20">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Product Name *</label>
                            <input hidden class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="product_id" placeholder="Quantity" value="{{$product->id}}" required="">

                            <h4>{{$product->name}}</h4>
                        </div>

                        {{-- <div class="col-md-6 form-group g-mb-40">
                            <label class="g-color-gray-dark-v2 g-font-size-13">Registration Certificate</label>
                            <input type="file" name="reg_certificate_file" class="form-control-file" id="exampleInputFile" value="{{$user->registration_file}}" aria-describedby="fileHelp" required="" > 

                        </div> --}}
    {{-- <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small> --}}

                      
                       <div class="col-md-6 form-group g-mb-20">
                        <label class="g-font-size-13" style="color:red;">Prescription Required (Can be Multiple File) *</label>
                    <div class="input-group control-group increment" >
                      <input type="file" name="filename[]" class="form-control" style="height:3rem;" required>
                      <div class=""> 
                        <button class="btn btn-success" type="button" style="border-radius:0px; height:3rem;"><i class="fa fa-plus"></i> Add</button>
                      </div>
                    </div>
                    <div class="clone hide">
                      <div class="control-group input-group" style="margin-top:10px; border-radius: 0px;">
                        <input type="file" name="filename[]" class="form-control" style="height:3rem;">
                        <div class=""> 
                          <button class="btn btn-danger" type="button" style="border-radius:0px; height:3rem;"><i class="fa fa-close" ></i> Remove</button>
                        </div>
                      </div>
                    </div>
                       </div>

                    </div>
      
                    <div class="text-center">
                      <button class="btn u-btn-primary g-font-weight-600 g-font-size-13 text-uppercase g-rounded-25 g-py-15 g-px-30" type="submit" role="button">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
    </div>
</div>



{{-- <div class="container">

  <h3 class="jumbotron">Laravel Multiple File Upload</h3>
<form method="post" action="{{route('prescription-multiple-files')}}" enctype="multipart/form-data">
{{csrf_field()}}

      <div class="input-group control-group increment" >
        <input type="file" name="filename[]" class="form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
        </div>
      </div>
      <div class="clone hide">
        <div class="control-group input-group" style="margin-top:10px">
          <input type="file" name="filename[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

</form>        
</div> --}}

<div class="modal fade locationModal" ng-app="locationSelector" ng-controller="LocationController" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top: 0;">
      <div class="modal-header text-center" style="border-bottom: none;padding-bottom: 0">
          <h4><strong>SET A LOCATION</strong></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
          </button>
      </div>
      <h6 style="margin-left: 15px;">Drag the pin to your exact location Or, </h6>
        <h6 style="margin-left: 15px;">Simply type your address below.</h6>

      <div class="modal-body text-center">
          <div class="input-group g-pb-13 g-px-0 g-mb-10">
            
            <input 
              places-auto-complete size=80
              types="['establishment']"
              component-restrictions="{country:'np'}"
              on-place-changed="placeChanged()"
              id="googleLocation" 
              ng-model="address.Address" 
              class="form-control g-brd-none g-brd-bottom g-brd-black g-brd-primary--focus g-color-black g-bg-transparent rounded-0" type="text" placeholder="Select Area" autocomplete="off" style="background-color:#d8f4ff !important;">
              
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


<script type="text/javascript">
    
  $(document).ready(function() {

    $(".btn-success").click(function(){ 
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click",".btn-danger",function(){ 
        $(this).parents(".control-group").remove();
    });

  });

</script>
@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
  <script src="/assets/front/js/ng-map.min.js"></script>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&libraries=places"></script>
  <script src="/assets/front/js/location.js"></script>

@endsection