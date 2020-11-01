@extends('layouts.front')
@section('title','Checkout - Lab')
@section('content')
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/animate.css">
                    <link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/custombox/custombox.min.css">
                    <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/progress-wizard.min.css">

<style>

.g-color-gray-dark-v2 {
    color: #777!important;
}

@media only screen and (max-width: 768px){
    #lab{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: transparent !important;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }

  #lab-mobile{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }
  .header-middle-right-wrap li a {
    border-color: transparent !important;
    color: #ffffff;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}
.header-middle-right-wrap li:first-child a {
    padding: 0 0px 0 0;
}

}

     #lab{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }

   .section-padding {
    padding: 20px 0;
}
    .select2-selection__rendered{
    
    height:35px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 9px !important;
    right: 1px;
    width: 20px;
}
  .select2-selection__arrow{
    height:35px !important;
  }
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px !important;
    user-select: none;
    -webkit-user-select: none;
}
.section-padding.product-shoppingCart-wrapper .table>tbody>tr>td {
    padding: 10px 0;
    vertical-align: middle;
    color: #555;
    font-size: 16px;
    border: none;
    text-align: left;
}
.section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
    padding: 30px 0px;
    text-align: left;
    color: #333;
}

.section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
    padding: 15px 0px;
    text-align: left;
    color: #333;
}
.product-shoppingCart-wrapper .table>tfoot>tr>td {
    padding: 10px 0;
} 

.rounded-0 {
    border-radius: 30px !important;
}

p {
    margin-top: 0;
    margin-bottom: 0rem;
    font-size:14px;
}

.section-padding.product-shoppingCart-wrapper .table>tbody>tr>td {
    padding: 10px 0;
    vertical-align: middle;
    color: #555;
    font-size: 16px;
    border: none;
    text-align: left;
    font-size: 14px;
}

.product-shoppingCart-wrapper .table>tfoot>tr:last-child>td {
    border-top: 1px solid;
    border-color: #ccc;
}

@media (min-width: 768px){
.u-info-v9-1::before {
    position: absolute;
    top: 75px;
    left: 17%;
    width: 66%;
    border-top: 1px dotted #ddd;
    content: " ";
}
}
.progress-indicator>li.completed .bubble, .progress-indicator>li.completed .bubble:after, .progress-indicator>li.completed .bubble:before {
    background-color: #2385aa;
    border-color: #2385aa;
}
.progress-indicator>li.completed, .progress-indicator>li.completed .bubble {
    color: #2385aa;
}

</style>
@if(Session::has('defaultFamily'))
{{-- @php
        $family=Session::get('defaultFamily');

@endphp --}}

@endif
    <div class="section-padding product-shoppingCart-wrapper">
        <div class="container">
            <div class="row">
              <div class="col-lg-12 g-mb-20">
                <div class="view-cart-title pull-right">
                  <a style="color:black;" href="{{route('lab.index')}}"><i class="icon-home"></i>{{ucfirst(strtolower($lang->home))}}</a>
                  <i class="fa fa-angle-right"></i>
                  <a style="color:black;" href="{{route('lab.cart')}}">Lab Test</a>
                  <i class="fa fa-angle-right"></i>
                  <a style="color:black;" href="#">Checkout</a>
                </div>
              </div>

              <div class="container">
                <ul class="progress-indicator custom-complex">
                  <li class="completed" style="font-size:14px;"> <span class="bubble"></span><i class="icon-note"></i> Book  <i class="fa fa-check-circle"></i> </li>
                  <li class="completed" style="font-size:14px;"> <span class="bubble" ></span><i class="icon-finance-100 u-line-icon-pro"></i> Checkout <i class="fa fa-check-circle"></i></li>
                  <li style="font-size:14px;"> <span class="bubble"></span><i class="icon-credit-card"></i> Purchase </li>
                </ul>
              </div>

              <div class="col-md-12 col-sm-12">
                   
                <label class="d-block g-color-gray-dark-v2 g-font-size-20" style="font-weight:600;">Test Details:</label>
          
                @include('includes.form-success') 

                <div class="card g-brd-teal g-mb-30">
                  <h3 class="card-header g-bg-primary g-brd-transparent g-color-white g-font-size-16 mb-0">
                    <i class="icon-finance-100 u-line-icon-pro g-mr-5"></i>
                    Test Details
                  </h3>
                
                  <div class="table-responsive">
                    <table class="table table-striped u-table--v1 mb-0">
                      <thead>
                        <tr>
                          <th style="padding-left:10px !important; ">Test Name</th>
                          <th class="hidden-sm">Unit Price</th>
                         
                        </tr>
                      </thead>
                
                      <tbody>
  
                        @if(Session::has('lab_cart'))
                            @include('lab::front.partials.checkout')
                          @else
                            <tr>
                              <td colspan="9"><h2 class="text-center">{{$lang->h}}</h2></td>
                            </tr>
                          @endif
                       
                 
                     
                      </tbody>
                      <tfoot style="background-color:#f3f3f3;">
  
                        @if(Session::has('lab_cart'))
                        <tr>
                          <td style="padding-left:10px">
                            <p class="g-font-size-14"> <b>Health Tax ({{$gs->lab_vat}}%):</b> </p>
                          </td>
                          <td>
                            <p class="g-font-size-14">
                             
                              <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{$health_tax_amount}}</span></b>
                             
                            </p>
                          </td>
                       
                        </tr>
                        @endif
  
                        @if(Session::has('lab_cart'))
                        <tr>
                          <td style="padding-left:10px">
                            <p class="g-font-size-14"> <b>{{$lang->vt}}:</b> </p>
                          </td>
                          <td>
                            <p class="g-font-size-14">
                              @if($gs->sign == 0)
                              <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span></b>
                              @else
                                <span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span>{{$curr->sign}}
                              @endif
                            </p>
                          </td>
                         
                        </tr>
                        @endif
  
                    
                       
                      </tfoot>
                    </table>
                  </div>
                </div>

                {{-- <div class="table-responsive">
                    <table class="table " style="width:70%">
                    <thead>
                        <tr>
                        <th colspan="4">{{$lang->cproduct}}</th>
                        <th>{{$lang->cupice}}</th>
                        </tr>
                    </thead>
                    <tbody id="testList">
                        @if(Session::has('lab_cart'))
                            @include('lab::front.partials.checkout')
                        @else
                            <tr>
                              <td colspan="9"><h2 class="text-center">{{$lang->h}}</h2></td>
                            </tr>
                        @endif
                    </tbody>
              
                    <tfoot>

                      <tr>
                          
                        <td colspan="4">
                          <b class="g-font-size-14 ">Health Tax ({{$gs->lab_vat}}%):</b> 
                        </td>
                        <td colspan="4">
                          <p class="g-font-size-14 ">
                           
                              <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{$health_tax_amount}}</span></b>
                           
                          </p>
                        </td>
                        </tr>
                   
                        <tr>
                          
                        <td colspan="4">
                          <b class="g-font-size-14 g-mb-20">{{$lang->vt}}:</b> 
                        </td>
                        <td colspan="4">
                          <p class="g-font-size-14 g-mb-20">
                            @if($gs->sign == 0)
                              <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span></b>
                            @else
                                <span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span>{{$curr->sign}}
                            @endif
                          </p>
                        </td>
                        </tr>
                    </tfoot>
                    </table>
                    
                </div> --}}
                
              </div>
              <div class="col-md-12 g-mb-30">
                <div class="container" style="background:#f1f1f1; border-radius:30px; padding:20px;">
                    <form action="/lab/confirm" method="POST">
                    {{csrf_field()}}
                
                    
                    {{-- <select name="family_id" class="form-control g-mb-20" id="selectFamily" style="width:15%; display:inline-block;border-radius:30px;">
                        <option value="" family-name="{{Auth::user()->name}}" family-dob="{{Auth::user()->dob}}" family-gender="{{Auth::user()->gender}}">Self</option>
                        @foreach(App\User::findOrFail(Auth::user()->id)->family as $fam)
                            @if(isset($family))
                                <option {{$family->id==$fam->id?'selected':''}} value="{{$fam->id}}" family-name="{{$fam->name}}" family-dob="{{$fam->dob}}" family-gender="{{$fam->gender}}">{{$fam->name}} ({{$fam->relation}})</option>
                            @else
                                <option value="{{$fam->id}}" family-name="{{$fam->name}}" family-dob="{{$fam->dob}}" family-gender="{{$fam->gender}}">{{$fam->name}} ({{$fam->relation}})</option>

                            @endif
                        @endforeach
                       
                        
                    </select> --}}
                    {{-- <span style="display:inline-block;border-radius:30px;">&nbsp;&nbsp;<a href="#modal1" data-modal-target="#modal1" data-modal-effect="fadein" class="btn btn-primary" style="border-radius:30px;"><i class="fa fa-plus"></i> Add Family Member</a> </span> --}}
                  
                    <label class="d-block g-color-gray-dark-v2 g-font-size-20 text-center"><i class="et-icon-pencil"></i> Please fill up the following information</label>
                    <hr class="g-my-10">
                    <label class="d-block g-color-gray-dark-v2 g-font-size-13">Patients Details:</label>
                    <hr class="g-my-10">
                  <div class="row">
                    <div class="col-md-4 g-mb-20">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Name</label>
                
                      <input id="name" name="name" value="{{Auth::user()->name}}" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15"  type="text" placeholder="Alexander" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">

     
                    </div>
                    </div>

                    <div class="col-md-4 g-mb-20">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Date Of Birth</label>
                        @if(isset($family))
                            <input type="date" id="dob" name="dob" {{$family->dob?'value='.$family->dob:'' }} class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-6"  type="number" min="1" placeholder="Enter Patient's dob" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">

                        @else
                            <input type="date" id="dob" name="dob" {{Auth::user()->dob?'value='.Auth::user()->dob:'' }} class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-6"  type="number" min="1" placeholder="Enter Patient's dob" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      
                        @endif
                        </div>
                    </div>
                    <div class="col-md-4 g-mb-20">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Gender</label>
                        {{-- {{dd(Session::all())}} --}}
                        @if(isset($family))
                       
                        <select id="gender" name="gender"  class="form-control" style="border-radius:30px;" required>
                                <option {{$family->gender=="Male"?'selected':'' }}>Male</option>
                                <option {{$family->gender=="Female"?'selected':'' }}>Female</option>
                                <option {{$family->gender=="Other"?'selected':'' }}>Other</option>
    
                        </select>
                        @else
                        <select id="gender" name="gender" class="form-control" style="border-radius:30px;" required>
                            <option {{Auth::user()->gender=="Male"?'selected':'' }}>Male</option>
                            <option {{Auth::user()->gender=="Female"?'selected':'' }}>Female</option>
                            <option {{Auth::user()->gender=="Other"?'selected':'' }}>Other</option>

                        </select>
                        @endif
                      </div>
                    </div>
                  </div>

                  <label class="d-block g-color-gray-dark-v2 g-font-size-13">User Details:</label>
                  <hr class="g-my-10">
                  <div class="row">
                    <div class="col-sm-4 g-mb-20">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Email Address</label>
                      <input readonly value="{{Auth::user()->email}}"  id="inputGroup6" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" name="email" type="email" placeholder="alex@gmail.com" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      </div>
                    </div>

                    <div class="col-sm-4 g-mb-20">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Phone Number</label>
                      <input name="phone" value="{{Auth::user()->phone}}" id="inputGroup7" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15"  type="text" placeholder="Phone No." required>
                      </div>
                    </div>

                    <div class="col-sm-4 g-mb-20">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Service Address</label>
                        <input id="geolocation" name="address" value="{{Auth::user()->address}}" id="inputGroup8" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="Enter your location" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true" onclick="$('.locationModal').modal('show');" autocomplete="off">
                        <input id="latlong" type="hidden" name="latlong" value="{{Auth::user()->latlong}}">
                        <small class="form-text text-muted g-font-size-default g-mt-10">
                          (We will come to visit you in this address)
                         </small>
                      </div>
                    </div>

                  </div>
                  {{-- <label class="d-block g-color-gray-dark-v2 g-font-size-13">(We will come to visit you in this address)</label> --}}
                  {{-- <hr class="g-my-10"> --}}

                  <div class="row">
                    
                    

                  </div>

                  <div class="form-group g-mb-20">
                    <label class="g-mb-10 g-color-gray-dark-v2" for="inputGroup2_2">Notes</label>
                    <textarea name="note" class="form-control form-control-md u-textarea-expandable rounded-0" rows="3" placeholder="Some Notes..."></textarea>
                    <small class="form-text text-muted g-font-size-default g-mt-10">
                     When is your preffered time to collect samples. <strong> Eg.Collect sample after 3pm</strong>
                    </small>
                  </div>

               
                  <hr class="g-mt-10 g-mb-20">
                  <div class="text-center">
                  <button class="btn u-btn-primary g-font-size-13 text-uppercase g-px-40 g-py-15" style="border-radius:30px;" type="submit" data-next-step="#step3"><i class="icon-finance-100 u-line-icon-pro"></i> Confirm Order</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
        </div>
    </div>
        
    <!-- Demo modal window -->
    <div id="modal1" class="text-left g-bg-white g-overflow-y-auto g-pa-20" style="display: none; max-width:600px!important">
      <button type="button" class="close" onclick="Custombox.modal.close();">
        <i class="hs-icon hs-icon-close"></i>
      </button>
      <h4 class="g-mb-20">Add Family Member</h4>
      <form action="{{route('lab.addFamily')}}" method="POST">
        {{csrf_field()}}
            <div class="row">
                    <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Fist name *</label>
                        <input name="firstname" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="First Name: Family/Friend member" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      </div>
                    </div>
                    <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Middle Name</label>
                        <input name="middlename" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="Middle Name : Family/Friend member"  data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      </div>
                    </div>
                    <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Last Name *</label>
                        <input name="lastname" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="Last Name : Family/Friend member"  data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      </div>
                    </div>

                    {{-- <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">dob</label>
                        <input name="dob" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15"  type="number" min="1" placeholder="dob" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      </div>
                    </div> --}}

                    <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Date Of Birth *</label>
                        <input type="date" name="dob" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15"  min="1" placeholder="Dob" required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      </div>
                    </div>


                    <div class="col-sm-12 g-mb-10">
                        <div class="form-group">
                            <label class="d-block g-color-gray-dark-v2 g-font-size-13">Gender *</label>
                            <select id="gender" name="gender" required class="form-control">
                                <option >Male</option>
                                <option >Female</option>
                                <option >Other</option>
    
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Relation *</label>
                        <input name="relation" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15"  type="text" placeholder="Mother, Father, Friend..." required="" data-msg="This field is mandatory" data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" aria-required="true">
                      </div>
                    </div>

                    <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Email</label>
                        <input type="email" name="email" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15"   placeholder="Email" required=""  data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" >
                      </div>
                    </div>

                    <div class="col-sm-12 g-mb-10">
                      <div class="form-group">
                        <label class="d-block g-color-gray-dark-v2 g-font-size-13">Phone Number</label>
                        <input type="text" name="phone" id="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15"   placeholder="Phone " required=""  data-error-class="u-has-error-v1" data-success-class="u-has-success-v1" >
                      </div>
                    </div>


                </div>
              <button class="btn u-btn-primary g-font-size-13 text-uppercase g-px-40 g-py-15" type="submit" data-next-step="#step3">Add Member</button>

      </form>
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
          <h6 style="margin-left: 15px;">Drag the pin to your exact location Or Type your address.</h6>
  
          <div class="modal-body text-center">
     
            <div class="input-group g-pb-13 g-px-0 g-mb-10">
              
              <input 
                places-auto-complete size=80
                types="['establishment']"
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
                  <marker position="27.7041765,85.3044636" title="Drag Me!" draggable="true" on-drdobnd="drdobnd($event)"></marker>
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
        $(document).ready(function(){
            $('#selectFamily').on('change',function(){
                val=$(this).val();
                name=$('#selectFamily option:selected').attr('family-name');
                dob=$('#selectFamily option:selected').attr('family-dob');
                gender=$('#selectFamily option:selected').attr('family-gender');
                $('#name').val(name);
                $('#dob').val(dob);
                $('#gender').val(gender);


                console.log(val);
            });
        })
    </script>
@endsection