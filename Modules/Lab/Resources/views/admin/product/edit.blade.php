@extends('layouts.admin')

@section('styles')

<style type="text/css">
    .colorpicker-alpha {display:none !important;}
    .colorpicker{ min-width:128px !important;}
    .colorpicker-color {display:none !important;}
    .add-product-box .form-horizontal .form-group:last-child {margin-bottom: 20px; }

    .col-sm-6 p {
    text-align: left;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

@endsection

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
                                          <h2>Update Product <a href="{{ route('lab-prod-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                          <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Lab <i class="fa fa-angle-right" style="margin: 0 2px;"></i> All Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Update
                                      </div>
                                  </div>
                                    @include('includes.notification')
                              </div>   
                          </div>
                          <hr>
                          <form class="form-horizontal" action="{{route('lab-prod-update',$prod->id)}}" method="POST" enctype="multipart/form-data">
                              @include('includes.form-error')
                              @include('includes.form-success')
                              {{csrf_field()}}

                              <div class="form-group">
                                <label class="control-label col-sm-4">Type*</label>
                                <div class="col-sm-6">
                                  <select class="form-control" name="type" required="">
                                      <option value="" {{ !$prod->type ? "selected":""}} disabled>Choose a type</option>
                                      <option value="Test" {{ $prod->type == 'Test' ? "selected":""}}>Test</option>
                                      <option value="Package" {{ $prod->type == 'Package' ? "selected":""}}>Package</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="cat">Category*</label>
                                <div class="col-sm-6">
                                  <select class="form-control category-multiple" name="category_ids[]" multiple="multiple" required="">
                                    @foreach($cats as $cat)
                                      <option value="{{$cat->id}}" {{ in_array($cat->id, $prod->categories()->pluck('lab_categories.id')->toArray()) ? "selected":""}}>{{ $cat->cat_name }}</option>
                                      
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="cat">Condition*</label>
                                <div class="col-sm-6">
                                  <select class="form-control category-multiple" name="condition_ids[]" multiple="multiple" >
                                    @foreach($conds as $cond)
                                      <option value="{{$cond->id}}" {{ in_array($cond->id, $prod->conditions()->pluck('lab_conditions.id')->toArray()) ? "selected":""}}>{{ $cond->condition_name }}</option>
                                      
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="cat">Speciality*</label>
                                <div class="col-sm-6">
                                  <select class="form-control category-multiple" name="speciality_ids[]" multiple="multiple" >
                                    @foreach($specs as $spec)
                                      <option value="{{$spec->id}}" {{ in_array($spec->id, $prod->specialities()->pluck('lab_specialities.id')->toArray()) ? "selected":""}}>{{ $spec->speciality_name }}</option>
                                      
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="blood_group_display_name">Product Name* <span>(In Any English)</span></label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="name" id="blood_group_display_name" placeholder="Enter Product Name" required="" value="{{$prod->name}}" type="text" >
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="current_photo">Current Featured Image*</label>
                                <div class="col-sm-6">
                                  <img id="adminimg" src="{{asset('assets/images/'.$prod->photo)}}" alt="" style="width: 400px; height: 300px;">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="profile_photo">Select Image *</label>
                                <div class="col-sm-6">
                                  <input type="file" id="uploadFile" class="hidden" name="photo" value="">
                                  <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> Edit Featured Image</button>
                                  <p>Prefered Size: (600x600) or Square Sized Image</p>
                                </div>
                              </div>

                              {{-- <div class="form-group">
                                <label class="control-label col-sm-4" for="product_highlights">Product Highlights*</label>
                                <div class="col-sm-6"> 
                                  <textarea class="form-control" name="highlights" id="product_highlights" rows="5" style="resize: vertical;" placeholder="Enter Profile Highlights">{{$prod->highlights}}</textarea>
                                </div>
                              </div> --}}
                            
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="product_description">Product Description*</label>
                                <div class="col-sm-6"> 
                                  <textarea class="form-control" name="description" id="product_description" rows="5" style="resize: vertical;" placeholder="Enter Profile Description">{{$prod->description}}</textarea>
                                </div>
                              </div>

                              <div class="form-group box">
                                <label class="control-label col-sm-4" for="product_description">Product Collection*</label>
                                <div class="col-sm-6" style="text-align: left !important;"> 
                                  <div class="text-left"> 
                                  <p style="font-weight:600">Selected Test</p>  
                                 
                                    @php
                                    $decoded = json_decode($prod->product_collection, true);
                                    @endphp
                                      @foreach((array)$decoded as $pid)
                                        @php
                                        $product = Modules\Lab\Entities\LabProduct::findorFail($pid);
                                        @endphp
                                        
                                        <p class="text-left">{{$loop->iteration}}. {{$product->name}}</p>
                                     
                                      @endforeach
                                 
                                </div>
                                </div>
                              </div>

                              <div class="form-group box">
                                <label class="control-label col-sm-4" for="cat">Select New Product Collection* <span>(Select multiple test to from a test package)</span></label>
                                <div class="col-sm-6">
                                  <select class="form-control product-multiple" name="products_ids[]" multiple="multiple" >
                                    <option></option>
                                    @if($prods->where('type','Package')->count() > 0)
                                      <optgroup label="Packages">
                                        @foreach($prods->where('type','Package') as $test)
                                          <option value="{{$test->id}}" >{{ $test->name }}</option>
                                        @endforeach
                                      </optgroup>
                                    @endif
                                    <optgroup label="Tests">
                                      @foreach($prods->where('type','Test') as $test)
                                        <option value="{{$test->id}}" >{{ $test->name }}</option>
                                      @endforeach
                                    </optgroup>
                                  </select>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript">
    $('.category-multiple').select2({
      placeholder: 'Select a category'
    });
    $('.product-multiple').select2({
      placeholder: 'Select a product'
    });
</script>

<script type="text/javascript" src="{{asset('assets/admin/js/nicEdit.js')}}"></script> 
<script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { 
            // new nicEditor().panelInstance('product_highlights');
            new nicEditor().panelInstance('product_description');
            // new nicEditor().panelInstance('policy');
        });
  //]]>
</script>

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

<script type="text/javascript">
  $(document).ready(function(){
        $("select").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="Test"){
                    $(".box").hide();
                   
                }

                if($(this).attr("value")=="Package"){
                    $(".box").show();
                   
                }
                
            });
        }).change();
    });
</script>

@endsection