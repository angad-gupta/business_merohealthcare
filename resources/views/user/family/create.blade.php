@extends('layouts.user')
@section('title','Upload Prescription')

@section('styles')
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<style>
  .gj-datepicker-bootstrap [role=right-icon] button .gj-icon, .gj-datepicker-bootstrap [role=right-icon] button .material-icons {
      position: absolute;
      font-size: 21px;
      top: 9px;
      left: 9px;
      color: white;
  }  
      .gj-datepicker-bootstrap [role=right-icon] button {
  width: 38px;
  position: relative;
  border: 0px solid white;
  }

  </style> 
  <style>
    .invalid-feedback{
      color: red
    }

    @media(min-width:320px) and (max-width:768px){
    #history-prescription{
      height:40px !important;
    }
    }
  </style>
  <style>

    .form-control{
      border-radius:30px !important; 
       }
  
  #drop-zone {
    width: 100%;
    min-height: 80px;
    border: 1px dashed rgba(0, 0, 0, .3);
    border-radius: 5px;
    font-family: Arial;
    text-align: center;
    position: relative;
    font-size: 20px;
    color: #7E7E7E;
  }
  #drop-zone input {
    position: absolute;
    cursor: pointer;
    left: 0px;
    top: 0px;
    opacity: 0;
  }
  /*Important*/
  
  #drop-zone.mouse-over {
    border: 3px dashed rgba(0, 0, 0, .3);
    color: #7E7E7E;
  }
  /*If you dont want the button*/
  
  #clickHere {
    display: inline-block;
    cursor: pointer;
    color: white;
    font-size: 17px;
    width: 150px;
    border-radius: 4px;
    background-color: #2385aa;
    padding: 10px;
  }
  #clickHere:hover {
    background-color: #376199;
  }
  #filename {
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.5em;
  }
  .file-preview {
    background: #ccc;
    border: 1px solid #fff;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
    display: inline-block;
    width: 60px;
    height: 60px;
    text-align: center;
    font-size: 14px;
    margin-top: 5px;
  }
  .closeBtn:hover {
    color: red;
    display:inline-block;
  }
  }
  </style>

<style>

  .blog-wrap {
      background: #fff;
  }
  
    .form-control{
      border-radius: 30px;
    }
  #drop-zone {
    width: 100%;
    min-height: 80px;
    border: 1px dashed rgba(0, 0, 0, .3);
    border-radius: 5px;
    font-family: Arial;
    text-align: center;
    position: relative;
    font-size: 20px;
    color: #7E7E7E;
    border-radius:30px;
  }
  #drop-zone input {
    position: absolute;
    cursor: pointer;
    left: 0px;
    top: 0px;
    opacity: 0;
  }
  /*Important*/
  
  #drop-zone.mouse-over {
    border: 3px dashed rgba(0, 0, 0, .3);
    color: #7E7E7E;
  }
  /*If you dont want the button*/
  
  #clickHere {
    display: inline-block;
      cursor: pointer;
      color: white;
      font-size: 17px;
      width: 50px;
      border-radius: 4px;
      background-color: #2385aa;
      padding: 10px;
      border-radius: 30px;
  
  }
  #clickHere:hover {
    background-color: #376199;
  }
  #filename {
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.5em;
  }
  .file-preview {
    background: #ccc;
    border: 1px solid #fff;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
    display: inline-block;
    width: 60px;
    height: 60px;
    text-align: center;
    font-size: 14px;
    margin-top: 5px;
  }
  .closeBtn:hover {
    color: red;
    display:inline-block;
  }
  }
  </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  @if(Session::has('defaultFamily'))
    @php
            $family=Session::get('defaultFamily');

    @endphp

  @endif
  <div class="right-side">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Starting of Dashboard area -->
            <div class="section-padding add-product-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="add-product-box">
                          <div class="product__header"  style="border-bottom: none;">
                              <div class="row reorder-xs">
                                  <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                      <div class="product-header-title">
                                          <h2>Upload Prescription <a href="http://localhost:8000/user/family" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                          <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> My Prescriptions <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Add
                                      </div>
                                  </div>
                                    @include('includes.user-notification')
                              </div>   
                          </div>
                          <hr>
                          <div>
                            
                            @include('includes.form-success')

        
                            <!-- Tab panes -->
                            <div class="tab-content">

                              <div class="tab-pane fade active in" id="digital">
                                <form class="form-horizontal" action="{{route('user-prescriptions.store')}}" method="POST" enctype="multipart/form-data"  id="form2">

                                    {{ csrf_field() }}

                                    <div class="form-group">
                                      <label class="control-label col-sm-4" for="title">Prescription Type*</label>
                                      <div class="col-sm-6">
                                        <select class="form-control" name="type">
                                          <option value="medicine" disabled>Select your prescription type</option>
                                          <option value="medicine">Medicine</option>
                                          <option value="lab">Lab</option>
                                         
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-sm-4" for="title"> Order Title*</label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Title" required="" type="text" >
                                        @if ($errors->has('title'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('title') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                                      
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-sm-4" > Delivery Location *</label>
                                      <div class="col-sm-6" for="geolocation">
                                        <input class="form-control" name="location" id="geolocation" placeholder="Enter Delivery Location" value="{{ old('location') ? : Auth::guard('user')->user()->address }}" required="" type="text" onclick="$('.locationModal').modal('show');" autocomplete="off">
                                        <input id="latlong" type="hidden" name="latlong" value="{{ old('latlong') ? : Auth::guard('user')->user()->latlong }}">
                                        
                                        @if ($errors->has('location'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('location') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                                      
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-sm-4" for="phone"> Contact No. *<span></span></label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="phone" id="phone" value="{{ old('phone') ? : Auth::guard('user')->user()->phone }}" placeholder="Enter Contact No." required="" type="text" >
                                        @if ($errors->has('phone'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('phone') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-sm-4">This Prescription is for:</label>
                                      <div class="col-sm-6">
                                        <select name="family" class="form-control" id="selectFamily" style="width: 50%; display: inline-block;">
                                            <option value="">Self</option>
                                            @foreach(App\User::findOrFail(Auth::user()->id)->family as $fam)
                                                @if(isset($family))
                                                    <option {{ $family->id == $fam->id ? 'selected' : '' }} value="{{$fam->id}}" >{{$fam->name}} ({{$fam->relation}})</option>
                                                @else
                                                    <option value="{{ $fam->id }}" {{ old('family') == $fam->id ? 'selected' : '' }}>{{$fam->name}} ({{$fam->relation}})</option>

                                                @endif
                                            @endforeach
                                        </select> 
                                        <span style="display:inline-block">&nbsp;&nbsp;<a href="javascript:;" data-toggle="modal" data-target="#add-family" data-modal-effect="fadein" class="btn btn-primary" style="border-radius:30px;"><i class="fa fa-plus"></i> Add Family Member</a> </span>
                                        @if ($errors->has('family'))
                                          <br>
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('family') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="form-group" id="file">
                                      <label class="control-label col-sm-4" for="edit_profile_photo">Select File *</label>
                                      <div class="col-sm-6">

                                        <h5>Select from previous Prescription</h5>
                                        <select id="history-prescription" name="fileid[]" class="form-control category-multiple" multiple="multiple" style="height:180px">
                                          {{-- <option value="" {{ (count($product['family']) == 0 || in_array('',$product['family'])) ? 'selected' : '' }}>Self</option> --}}
                                          {{-- @foreach($user->family as $fam)
                                              <option value="{{$fam->id}}" {{ in_array($fam->id,$product['family']) ? 'selected' : '' }}>{{$fam->name}} ({{$fam->relation}})</option>
                  
                                          @endforeach --}}

                                          {{-- @foreach($prescriptions as $prescription)
                                            @if($prescription->status == 'active')
                                                
                                               <option value="{{$prescription->id}}" >{{$prescription->created_at->format('m/d/Y')}} {{$prescription->file}} </option>
                                            @endif
                                          @endforeach --}}


                                          @foreach($prescriptions as $prescription)
                                          @if($prescription->status == 'active')
                                              @if($prescription->family_id == $family->id )
                                              <option value="{{$prescription->id}}" >{{date('d M Y',strtotime($prescription->created_at))}} | {{$prescription->title}} </option>
                                             @else
                                             {{-- <option value="{{$prescription->id}}" >{{$prescription->created_at->format('m/d/Y')}} {{$prescription->file}} </option> --}}
                                             @endif
                                          @endif
                                        @endforeach
                                        

                                          {{-- @foreach($prescriptions as $prescription)
                                            @foreach($prescription->files as $file)
                                            <option value="{{$file->id}}" >{{$file->file}} </option>
                                            @endforeach
                                      @endforeach --}}
                                          
                                      </select>    
                                        <label class="g-color-gray-dark-v2 g-font-size-13"> Or, Select New Prescription (Can be Multiple)</label>
                                        
                                        <div id="drop-zone">

                        
                                          <span class="u-icon-v4 u-icon-v4-rounded-10 u-icon-v4-bg-primary g-color-white" style="margin-top:7px; border-radius:30px;">
                                          <div id="clickHere" style="margin-top: 15px;"><i class="icon-docs"></i>
                                            <input type="file" name="filenames[]" id="file" multiple />
                                          </div>
                                          </span>
                                          <span style="font-size:14px;">Or, Drop files here</span>
                                          <h6 class="">File type: jpeg,jpg,png,pdf</h6>
                                          <div id='filename'></div>
                                        </div>

                                        {{-- <input type="file" name="filename[]" class="form-control" multiple> --}}
                                          {{-- <div class="input-group control-group increment" >
                                            
                                            <div class=""> 
                                              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                            </div>
                                          </div>
                                          <div class="clone hide">
                                            <div class="control-group input-group" style="margin-top:10px">
                                              <input type="file" name="filename[]" class="form-control">
                                              <div class="" > 
                                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                              </div>
                                            </div>
                                          </div> --}}
                                          <p>File type: jpeg,jpg,png,pdf</p>

                                          {{-- <input type="file" id="uploadFile" class="hidden" name="file" value="">
                                          <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> Upload File</button>
                                          
                                           --}}
                                          {{-- @if ($errors->has('file'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('file') }}</strong>
                                              </span>
                                          @endif --}}
                                         

                                      </div>
                                      
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-sm-4" for="additional_info">Additional Information <span></span></label>
                                      <div class="col-sm-6">
                                        <textarea class="form-control" name="additional_info" id="additional_info" placeholder="Enter Additional Information (if any)">{{ old('additional_info') }}</textarea>
                                        @if ($errors->has('additional_info'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('additional_info') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                                      
                                    </div>

                                    {{-- <div class="form-group">
                                      <label class="control-label col-sm-4"></label>
                                      <div class="col-sm-6">
                                        <div class="checkbox2">
                                          <input type="checkbox" id="reminderCheck" name="reminderCheck" value="1"> 
                                          <label for="check11">Add Reminder</label>
                                        </div>
                                      </div>          
                                    </div> 
                                    <div id="reminderSection"  style="display: none;">
                                      
                                      
                                      <div class="form-group">
                                        <label class="control-label col-sm-4">Duration*<span>(Repeated after every 'x' days)</span></label>
                                        <div class="col-sm-6" style="display: inline-flex;">
                                            <input class="form-control reminderCheck" name="duration" placeholder="Duration in days" type="number" value="" min="1">
                                        </div>
                                      </div>
                                    </div> --}}

                                    <hr>
                                    <div class="add-product-footer">
                                        <button name="add_product_btn" type="submit" class="btn add-product_btn">Submit</button>
                                    </div>
                                </form>
                              </div>

                            </div>

                          </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Ending of Dashboard area --> 
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="add-family" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel">Add new Member</h4>
            </div>
            <div class="modal-body">

              <form class="form-horizontal" action="{{route('user-family.store')}}" method="POST" id="form2">

                {{ csrf_field() }}

                <div class="form-group">
                  <label class="control-label col-sm-4"> First Name *<span></span></label>
                  <div class="col-sm-6">
                    <input class="form-control" name="firstname" value="{{ old('name') }}" placeholder="First Name" required="" type="text" >
                    @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>
                  
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4"> Middle Name <span></span></label>
                  <div class="col-sm-6">
                    <input class="form-control" name="middlename" value="{{ old('name') }}" placeholder="Middle Name"  type="text" >
                    @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>
                  
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">Last Name *<span></span></label>
                  <div class="col-sm-6">
                    <input class="form-control" name="lastname" value="{{ old('name') }}" placeholder="Last Name"  type="text" >
                    @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>
                  
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4"> Date of Birth *<span></span></label>
                  <div class="col-sm-6">
                      <input class="form-control" id="dob" name="dob" value="{{ old('dob') }}" placeholder="YYYY-MM-DD" required="" >
                      {{-- @if ($errors->has('age'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('age') }}</strong>
                      </span>
                      @endif --}}
                  </div>
                  
              </div>

                {{-- <div class="form-group">
                    <label class="control-label col-sm-4"> Age *<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="age" value="{{ old('age') }}" placeholder="Age" required="" type="number" min="1">
                      @if ($errors->has('age'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('age') }}</strong>
                        </span>
                      @endif
                    </div>
                    
                </div> --}}

                <div class="form-group">
                    <label class="control-label col-sm-4"> Gender *<span></span></label>
                    <div class="col-sm-6">
                      <select class="form-control" name="gender" required="" >
                        <option value="" {{ !old('gender') ? 'selected' : '' }} disabled>Choose an option</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                      </select>
                      @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                      @endif
                    </div>
                    
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4"> Relation *<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="relation" value="{{ old('relation') }}" placeholder="Relation" required="" type="text">
                      @if ($errors->has('relation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('relation') }}</strong>
                        </span>
                      @endif
                    </div>
                    
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">Email<span></span></label>
                  <div class="col-sm-6">
                    <input class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"  type="text" >
                  
                  </div>
                  
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">Phone Number<span></span></label>
                  <div class="col-sm-6">
                    <input class="form-control" name="phone" value="{{ old('phone') }}" placeholder="phone number"  type="text" >
                
                  </div>
                  
                </div>

                <hr>
                <div class="add-product-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                  <button name="add_product_btn" type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
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
        <h6 style="margin-left: 15px; font-size:18px;">Drag the pin to your exact location</h6>
        <h6 style="margin-left: 15px; font-size:18px;">Or, Simply type your address below.</h6>

        <div class="modal-body text-center">
          <div class="input-group g-pb-13 g-px-0 g-mb-10" style="display:inline-flex;">
            
            <input 
              places-auto-complete size=80
              types="['establishment']"
              component-restrictions="{country:'np'}"
              on-place-changed="placeChanged()"
              id="googleLocation" 
              ng-model="address.Address" 
              class="form-control g-brd-none g-brd-bottom g-brd-black g-brd-primary--focus g-color-black g-bg-transparent rounded-0" type="text" placeholder="Select Area" autocomplete="off" style="background-color:#d8f4ff;">
              
            <button class="btn  u-btn-neutral rounded-0" type="button" ng-click="getLocation()"><i class="fa fa-crosshairs"></i></button>
          </div>
          <br/>
          
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

@section('scripts')


<script type="text/javascript">

  function uploadclick(){
      $("#uploadFile").click();
      $("#uploadFile").change(function(event) {
          readURL(this);
          $("#uploadTrigger").html($("#uploadFile").val());
      });

  }

  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
          }
          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#reminderCheck").change(function() {
      if(this.checked) {
          $("#reminderSection").show();
          $('.reminderCheck').attr('required','required')
      }
      else
      {
          $("#reminderSection").hide();
          $('.reminderCheck').removeAttr('required')

      }
  });
</script>

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

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
<script src="/assets/front/js/ng-map.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&libraries=places"></script>
<script src="/assets/front/js/location.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">
  $('.category-multiple').select2({
    placeholder: 'Select a Prescription file'
  });
</script>

<script>
  var dropZoneId = "drop-zone";
    var buttonId = "clickHere";
    var mouseOverClass = "mouse-over";
  var dropZone = $("#" + dropZoneId);
   var inputFile = dropZone.find("input");
   var finalFiles = {};
  $(function() {
    
  
    
    var ooleft = dropZone.offset().left;
    var ooright = dropZone.outerWidth() + ooleft;
    var ootop = dropZone.offset().top;
    var oobottom = dropZone.outerHeight() + ootop;
   
    document.getElementById(dropZoneId).addEventListener("dragover", function(e) {
      e.preventDefault();
      e.stopPropagation();
      dropZone.addClass(mouseOverClass);
      var x = e.pageX;
      var y = e.pageY;
  
      if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
        inputFile.offset({
          top: y - 15,
          left: x - 100
        });
      } else {
        inputFile.offset({
          top: -400,
          left: -400
        });
      }
  
    }, true);
  
    if (buttonId != "") {
      var clickZone = $("#" + buttonId);
  
      var oleft = clickZone.offset().left;
      var oright = clickZone.outerWidth() + oleft;
      var otop = clickZone.offset().top;
      var obottom = clickZone.outerHeight() + otop;
  
      $("#" + buttonId).mousemove(function(e) {
        var x = e.pageX;
        var y = e.pageY;
        if (!(x < oleft || x > oright || y < otop || y > obottom)) {
          inputFile.offset({
            top: y - 15,
            left: x - 160
          });
        } else {
          inputFile.offset({
            top: -400,
            left: -400
          });
        }
      });
    }
  
    document.getElementById(dropZoneId).addEventListener("drop", function(e) {
      $("#" + dropZoneId).removeClass(mouseOverClass);
    }, true);
  
  
    inputFile.on('change', function(e) {
      finalFiles = {};
      $('#filename').html("");
      var fileNum = this.files.length,
        initial = 0,
        counter = 0;
  
      $.each(this.files,function(idx,elm){
         finalFiles[idx]=elm;
      });
  
      for (initial; initial < fileNum; initial++) {
        counter = counter + 1;
        $('#filename').append('<div id="file_'+ initial +'"><span class="fa-stack fa-lg"><i class="fa fa-file fa-stack-1x "></i><strong class="fa-stack-1x" style="color:#FFF; font-size:12px; margin-top:2px;">' + counter + '</strong></span> ' + this.files[initial].name + '&nbsp;&nbsp;<span class="fa fa-times-circle fa-lg closeBtn" onclick="removeLine(this)" title="remove"></span></div>');
      }
    });
  
  
  
  })
  
  function removeLine(obj)
  {
    inputFile.val('');
    var jqObj = $(obj);
    var container = jqObj.closest('div');
    var index = container.attr("id").split('_')[1];
    container.remove(); 
  
    delete finalFiles[index];
    //console.log(finalFiles);
  }
  
  </script>
<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>  
<script>
  $(function() {
     $( "#dob" ).datepicker({ 
          dateFormat: 'yy-mm-dd',
         yearRange: '1950:c+1' ,
         changeMonth: true,
         changeYear: true,
         minDate: new Date(1950, 10 - 1, 25),
         maxDate: '+30Y',
     });
 });
</script>

@endsection