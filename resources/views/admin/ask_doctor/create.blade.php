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
                                                    <h2>Add Doctor <a href="{{ route('admin-askdoctor-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Doctor <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Add
                                                </div>
                                            </div>
                                              @include('includes.notification')
                                        </div>   
                                    </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-askdoctor-store')}}" method="POST" enctype="multipart/form-data">
                                          @include('includes.form-error')
                                          @include('includes.form-success')
                                          {{csrf_field()}}

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="link">Email *</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="email" placeholder="Doctor Email" required="" type="text" value="">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="link">Doctor Name *</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="name" placeholder="Doctor Name" required="" type="text" value="">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="link">NMC no. *</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="nmc" placeholder="Doctor NMC" required="" type="text" value="">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="link">Post *</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="post" placeholder="Doctor Post" required="" type="text" value="">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_current_photo">Photo *</label>
                                            <div class="col-sm-6">
     
                                              <img style="width: 50%; height: auto;" id="adminimg" src="" alt="" id="adminimg">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="edit_profile_photo">Add Image</label>
                                            <div class="col-sm-6">
                                    <input type="file" id="uploadFile" class="hidden" name="photo" value="">
                                              <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> Add Doctor Photo</button>
                                              <p class="text-center">Prefered Size: (600x600) or Square Sized Image</p>
                                            </div>
                                          </div>    

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="link">Description *</label>
                                            <div class="col-sm-6">
                                              <textarea class="form-control" name="description" placeholder="Doctor Description" required="" type="text" value="" style="height: 10rem;"></textarea>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                              <input class="" name="status" type="number" value="1" hidden>
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

