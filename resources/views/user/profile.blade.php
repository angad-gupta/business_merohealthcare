@extends('layouts.user')
@section('title','My Profile')
@section('content') 


{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/user/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
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

{{-- 
<link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet">
<link href="{{asset('assets/user/css/responsive.css')}}" rel="stylesheet"> --}}
<link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}">
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

    <div class="right-side">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Starting of Dashboard add-product-1 area -->
                    <div class="section-padding add-product-1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="add-product-box">
                                <div class="product__header">
                                    <div class="row reorder-xs">
                                        <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                            <div class="product-header-title">
                                                <h2>Edit Profile</h2>
                                                <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Edit Profile</p>
                                            </div>
                                        </div>
                                            @include('includes.user-notification')
                                    </div>   
                                </div>
                                    <form class="form-horizontal" action="{{route('user-profile-update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                        @include('includes.form-error')
                                        @include('includes.form-success')
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="admin_current_photo">Current Photo *</label>
                                            <div class="col-sm-2">
                                                @if($user->is_provider == 1)
                                                <img style="width: 100%; height: auto;" src="{{ $user->photo ? $user->photo:asset('assets/images/user.png')}}" alt="profile no image">
                                                @else
                                                <img  style="width: 100%; height: auto;" id="adminimg" src="{{ $user->photo ? asset('assets/images/'.$user->photo):asset('assets/images/user.png')}}" alt="profile image">
                                                @endif

                                            </div>
                                            @if($user->is_provider != 1)
                                            <div class="col-sm-4">
                                                <input type="file" id="uploadFile" class="hidden" name="photo" value="">
                                                <button  type="button" id="uploadTrigger" onclick="uploadclick()" class="btn btn-block add-product_btn adminImg-btn"><i class="fa fa-upload"></i> Change Photo</button>
                                                <button  type="button" id="deletebutton" onclick="deleteclick()" class="btn btn-block add-product_btn adminImg-btn" style="background-color:red;"><i class="fa fa-trash"></i> Delete Photo</button>
                                                <p>Max File Size : <strong>5 MB</strong> | Support Format : <strong>jpg, jpeg, png</strong></p>
                                                
                                                
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="dash_fname">{{$lang->fname}} *</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="name" id="dash_fname" placeholder="{{$lang->fname}}" value="{{$user->name}}" required>
                                            </div>
                                        </div>
                                        @if($user->is_provider != 1)
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="dash_lname">{{$lang->doeml}} *</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="dash_lname" placeholder="{{$lang->doeml}}" value="{{$user->email}}" readonly disabled>
                                            </div>
                                        </div>
                                        @endif


                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Gender </label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="gender" style="    height: 40px;" required>
                                                 
                                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                    <option value="Others" {{ $user->gender == 'Others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Date of Birth </label>
                                            <div class="col-sm-6">
                                                
                                                {{-- <input class="form-control" id="datepicker" name="dob" value="{{$user->dob}}" placeholder="DOB"> --}}
                                                <input class="form-control" name="dob" value={{$user->dob}} id="dob" placeholder="YYYY-MM-DD" type="text" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">PAN Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="pan_number" value="{{$user->pan_number}}" placeholder="PAN Number">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Address Type *</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="address_type" style="    height: 40px;" required>
                                                    <option value="" {{ !$user->address_type ? 'selected' : '' }} disabled>Select an option</option>
                                                    <option value="Home" {{ $user->address_type == 'Home' ? 'selected' : '' }}>Home</option>
                                                    <option value="Office" {{ $user->address_type == 'Office' ? 'selected' : '' }}>Office</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="form-group">
                                            <label class="control-label col-sm-4">Nearest LandMark *</label>
                                            <div class="col-sm-6">
                                                <textarea placeholder="Nearest LandMark" class="form-control" name="nearest_landmark" cols="30" rows="2" style="resize: vertical;" required>{{$user->nearest_landmark}}</textarea>
                                            </div>
                                        </div> --}}

                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="geolocation">{{$lang->doad}} *</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="address" id="geolocation" placeholder="{{$lang->doad}}" value="{{$user->address}}" required onclick="$('.locationModal').modal('show');" autocomplete="off">
                                                <input id="latlong" type="hidden" name="latlong" value="{{ $user->latlong }}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="dash_phone">{{$lang->doph}} *</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="phone" id="dash_phone" placeholder="{{$lang->cop}}" value="{{$user->phone}}" required>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="control-label col-sm-4" for="dash_city">{{$lang->doct}} *</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="city" id="dash_city" placeholder="{{$lang->doct}}" value="{{$user->city}}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="dash_zip">{{$lang->suph}} </label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="zip" id="dash_zip" placeholder="{{$lang->suph}}" value="{{$user->zip}}">
                                            </div>
                                        </div> --}}

                                        <hr>
                                        <div class="add-product-footer">
                                            <button name="addProduct_btn" type="submit" class="btn add-product_btn">{{$lang->doupl}}</button>
                                        </div>
                                    </form>

                                    <form id="deleteform" class="form-horizontal" action="{{route('user-profile-image-delete',$user->id)}}" method="POST" enctype="multipart/form-data">
                                        @include('includes.form-error')
                                        @include('includes.form-success')
                                        {{csrf_field()}}

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard add-product-1 area -->
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
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>

   
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

        // function delclick(){
        //  document.getElementById('adminimg').src='{{asset('assets/images/noimage.png') }}'
        //     // $("#uploadFile").click();
        //     // $("#uploadFile").change(function(event) {
        //     //     document.getElementById('adminimg').src='{{asset('assets/images/noimage.png') }}'
        //     //     $("#delTrigger").html($("#uploadFile").val());
        //     // });

        // }

        // function deleteURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function (e) {
        //             $('#adminimg').attr('src', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQikVhGsLPMUq5TInJ--3ossfcT7ZyDUFM9e0mOgSQN6TEHQugJ' );
        //         }
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#adminimg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function(){
    $("#deletebutton").click(function(){        
        $("#deleteform").submit(); // Submit the form
    });
});
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
    <script src="/assets/front/js/ng-map.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&libraries=places"></script>
    <script src="/assets/front/js/location.js"></script>



<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>  

{{-- <script type="text/javascript">
    var dateToday = '01/01/1960';
    var dates =  $( "#from,#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        minDate: dateToday
    
  
});
</script> --}}

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