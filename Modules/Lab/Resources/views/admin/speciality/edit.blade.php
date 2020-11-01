@extends('layouts.admin')

@section('content')
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
                                  <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                      <div class="product-header-title">
                                          <h2>Update Speciality <a href="{{ route('lab-speciality-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                          <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Manage Speciality <i class="fa fa-angle-right" style="margin: 0 2px;"></i>  Main Speciality <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Update
                                      </div>
                                  </div>
                                  @include('includes.notification')
                              </div>   
                          </div>
                          <hr>
                          <form class="form-horizontal" action="{{route('lab-speciality-update',$spec->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @include('includes.form-error')
                            @include('includes.form-success')
                            <div class="form-group">
                              <label class="control-label col-sm-4" for="edit_blood_group_display_name"> Name* <span>(In Any Language)</span></label>
                              <div class="col-sm-6">
                                <input class="form-control" name="speciality_name" id="edit_blood_group_display_name" placeholder="Enter Speciality Name" required="" type="text" value="{{$spec->speciality_name}}" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-4" for="edit_blood_group_slug">Slug* <span>(In English)</span></label>
                              <div class="col-sm-6">
                                <input class="form-control" name="speciality_slug" id="edit_blood_group_slug" placeholder="Enter Speciality Slug eg. haemoglobin-test"  required="" type="text" value="{{$spec->speciality_slug}}" >
                              </div>
                            </div>

                            {{-- <div class="form-group">
                              <label class="control-label col-sm-4" for="priority_no">Priority No. <span>(Optional)</span></label>
                              <div class="col-sm-6">
                                <input class="form-control" name="priority_no" id="priority_no" placeholder="Enter Priority No." type="number" step="1" value="{{$cat->priority_no}}">
                              </div>
                            </div> --}}

                            <div class="form-group">
                              <label class="control-label col-sm-4" for="current_photo">Current Photo*</label>
                              <div class="col-sm-6">
                                <img width="130px" height="90px" id="adminimg" src="{{ $spec->photo ? asset('assets/images/'.$spec->photo):'http://fulldubai.com/SiteImages/user.png'}}" alt="" id="adminimg">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-4" for="profile_photo">Edit Photo *</label>
                              <div class="col-sm-6">
                                <input type="file" id="uploadFile" class="hidden" name="photo" value="">
                                <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> Edit Speciality Photo</button>
                              </div>
                            </div>

                            <hr>
                            <div class="add-product-footer">
                                <button name="addProduct_btn" type="submit" class="btn add-product_btn">Submit</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ending of Dashboard area --> 
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
              $('#adminimg').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
    }

</script>

@endsection