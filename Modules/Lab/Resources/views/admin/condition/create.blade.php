@extends('layouts.admin')
@section('title','Add Lab Category')

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
                                      <h2>Add Condition <a href="{{ route('lab-condition-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                      <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Manage Condition <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Main Condition <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Add
                                  </div>
                              </div>
                                @include('includes.notification')
                          </div>   
                      </div>
                      <hr>
                      <form class="form-horizontal" action="{{route('lab-condition-store')}}" method="POST" enctype="multipart/form-data">
                        @include('includes.form-error')
                        @include('includes.form-success')
                        {{csrf_field()}}
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="blood_group_display_name">Name* <span>(In Any Language)</span></label>
                          <div class="col-sm-6">
                            <input class="form-control" name="condition_name" id="blood_group_display_name" placeholder="Enter Condition name" required="" type="text" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="blood_group_slug">Slug* <span>(In English)</span></label>
                          <div class="col-sm-6">
                            <input class="form-control" name="condition_slug" id="blood_group_slug" placeholder="Enter Condition Slug eg. haemoglobin-test" required="" type="text" >
                          </div>
                        </div>

                        {{-- <div class="form-group">
                          <label class="control-label col-sm-4" for="priority_no">Priority No.<span>(Optioanl)</span></label>
                          <div class="col-sm-6">
                            <input class="form-control" name="priority_no" id="priority_no" placeholder="Enter Priority No." type="number" step="1" >
                          </div>
                        </div> --}}

                        <div class="form-group">
                          <label class="control-label col-sm-4" for="current_photo">Current Image*</label>
                          <div class="col-sm-6">
                            <img width="130px" height="90px" id="adminimg" src="" alt="No Image Added!">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="profile_photo">Add Image *</label>
                          <div class="col-sm-6">
                            <input type="file" id="uploadFile" class="hidden" name="photo" value="" required>
                            <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> Add Category Image</button>
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


  function readURL(input){
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