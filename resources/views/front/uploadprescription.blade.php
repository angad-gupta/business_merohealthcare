@extends('layouts.front')
@section('title','Upload Prescription')
@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<style>
.hide{
  display:none;
}
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
.u-icon-v4 .u-icon-v4-inner {
    z-index: 0;
    transition: all .2s ease-in-out;
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
                <span class="u-icon-v4-inner" style="z-index: 0 !important;">
                  <i class="icon-education-087 u-line-icon-pro" style="z-index: 0 !important;"></i>
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
                <span class="u-icon-v4-inner" style="z-index: 0 !important;">
                  <i class="icon-education-035 u-line-icon-pro" style="z-index: 0 !important;"></i>
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
                <span class="u-icon-v4-inner" style="z-index:0 !important;">
                  <i class="icon-education-141 u-line-icon-pro" style="z-index: 0 !important;"></i>
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
        <div class="col-lg-12" style="background: #f1f1f1; padding:1rem 3rem; border-radius:30px;">
          <h3 class="g-color-black g-font-weight-500 text-center mb-5">Send us your Prescription</h3>
        <form method="POST" action="{{route('prescription-upload')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">

              <div class="col-md-6 form-group g-mb-20 ">
                <label class="g-color-gray-dark-v2 g-font-size-13">Type *</label>
                <select class="form-control" name="type">
                  <option value="medicine" disabled>Select your prescription type</option>
                  <option value="medicine" >Medicine</option>
                  {{-- <option value="lab">Lab</option> --}}
                 
                </select>
            </div>
            <div class="col-md-6 form-group g-mb-20">
             
          </div>

                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Name *</label>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="name" value="" placeholder="Enter Your Name" required="">
                </div>

                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Email *</label>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="email" name="email" placeholder="Enter Your Email" value="" required="">
                </div>

                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Location *</label>
                    <input id="geolocation" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" placeholder="Location" name="location" value="" required="" onclick="$('.locationModal').modal('show');" autocomplete="off">
                    <input id="latlong" type="hidden" name="latlong" value="">
                </div>

                <div class="col-md-6 form-group g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Phone *</label>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded-3 g-py-13 g-px-15" type="text" name="phone" placeholder="Your Phone" value="" required="">
                </div>

                <div class="col-md-6 form-group g-mb-20">
                  <label class="g-mb-10" for="inputGroup2_2">Notes</label>
                  <textarea name="additional_info" id="inputGroup2_3" class="form-control form-control-md rounded-20" rows="3" placeholder="Some notes"></textarea>
                  <small class="form-text text-muted g-font-size-default g-mt-10">
                        <strong>Any notes for prescription</strong> 
                      </small>
                </div>

                {{-- <div class="col-md-12 form-group g-mb-40">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Prescription</label>
                    <input type="file" name="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" multiple="multiple" required>
                </div> --}}

                <div class="col-md-6 form-group g-mb-20">
                  <label class="g-font-size-13" style="color:red;">Prescription Required (Can be Multiple File) *</label>
                  {{-- <input type="file" name="filename[]" class="form-control" style="height:3rem;" required multiple> --}}
                  {{-- <div class="form-group mb-0">
                    <label class="g-mb-10">Advanced File input</label>
                    <input class="js-file-attachment" type="file" name="filename[]">
                  </div> --}}

                  
                  {{-- <div class="input-group control-group increment" >
                     
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
                    </div> --}}
                  
                    
                      <div id="drop-zone">
                        <span class="u-icon-v4 u-icon-v4-rounded-10 u-icon-v4-bg-primary g-color-white" style="margin-top:7px; border-radius:30px;">
                        <div id="clickHere"><i class="icon-docs"></i>
                          <input type="file" name="filenames[]" id="file" multiple required/>
                        </div>
                        </span>
                        <span style="font-size:14px;">Or, Drop files here</span>
                        <div id='filename'></div>
                      </div>
                 </div>
            </div>

            <div class="text-center">
              <button id="proceed-submit" class="btn u-btn-primary g-font-weight-600 g-font-size-13 text-uppercase g-rounded-25 g-py-10 g-px-25" type="submit" ><i class="loading-icon fa fa-spinner fa-spin hide"></i> <span class="btn-txt">Submit</span></button>
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
        <h6 style="margin-left: 15px;">Drag the pin to your exact location</h6>
        <h6 style="margin-left: 15px;">Or, Simply type your address below.</h6>

        <div class="modal-body text-center">
            <input type="hidden" id="model-type" value="" />
            <div class="input-group g-pb-13 g-px-0 g-mb-10">
          
                <input style="background-color:#d8f4ff !important;"
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

{{-- 
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

    
  
  </script> --}}

 
  
@endsection

@section('js')
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
  <script src="/assets/front/js/ng-map.min.js"></script>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&libraries=places"></script>
  <script src="/assets/front/js/location.js"></script>
   <!-- JS Implementing Plugins -->
   <script  src="/frontend-assets/main-assets/assets/vendor/jquery.filer/js/jquery.filer.min.js"></script>

   <!-- JS Unify -->
   <script  src="/frontend-assets/main-assets/assets/js/helpers/hs.focus-state.js"></script>
   <script  src="/frontend-assets/main-assets/assets/js/components/hs.file-attachement.js"></script>
 
   <!-- JS Plugins Init. -->
   <script >
     $(document).on('ready', function () {
           // initialization of forms
           $.HSCore.components.HSFileAttachment.init('.js-file-attachment');
           $.HSCore.helpers.HSFocusState.init();
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

<script>
  $(document).ready(function(){
    $("#proceed-submit").on("click", function(){
      $(".loading-icon").removeClass("hide");
      // $("#submit").attr("disabled", true);
      $(".btn-txt").text("Submitting.....");
    });
  });
  </script>
@endsection


