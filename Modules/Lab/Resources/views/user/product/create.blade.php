@extends('layouts.user')
@section('title','My Cart - Lab')

@section('styles')

<style type="text/css">
    .colorpicker-alpha {display:none !important;}
    .colorpicker{ min-width:128px !important;}
    .colorpicker-color {display:none !important;}
    .add-product-box .form-horizontal .form-group:last-child {margin-bottom: 20px; }
    .nav-tabs a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
        content: '';
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
                              <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                  <div class="product-header-title">
                                      <h2>Add Product <a href="{{ route('user-lab-prod-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                      <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Lab <i class="fa fa-angle-right" style="margin: 0 2px;"></i> All Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Add
                                  </div>
                              </div>
                                @include('includes.user-notification')
                          </div>   
                      </div>
                      <hr>
                      <div>

                          @include('includes.form-error')
                          @include('includes.form-success')


                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div class="tab-pane fade active in" id="physical">
                              <form class="form-horizontal" action="{{route('user-lab-prod-store')}}" method="POST" enctype="multipart/form-data" id="form1">
                                {{csrf_field()}}
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Product Name*</label>
                                  <div class="col-sm-6">
                                    <select class="form-control test-product" id="testDetail" name="product_id" required="" >
                                      <option></option>
                                      @if($tests->where('type','Package')->count() > 0)
                                        <optgroup label="Packages">
                                          @foreach($tests->where('type','Package') as $test)
                                            <option value="{{$test->id}}" >{{ $test->name }}</option>
                                          @endforeach
                                        </optgroup>
                                      @endif
                                      <optgroup label="Tests">
                                        @foreach($tests->where('type','Test') as $test)
                                          <option value="{{$test->id}}" >{{ $test->name }}</option>
                                        @endforeach
                                      </optgroup>
                                    </select>
                              
                                  </div>
                                </div>

                                <div id="detail">
                                
                                </div>
                                
                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="product_highlights">Product Highlights*</label>
                                  <div class="col-sm-6"> 
                                    <textarea class="form-control" name="highlights" id="product_highlights" rows="5" style="resize: vertical;" placeholder="Enter Product Highlights" ></textarea>
                                  </div>
                                </div> --}}
                                
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Price* <span>(In {{$sign->name}})</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="cprice" id="blood_group_display_name" placeholder="e.g 200" required="" type="text">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Previous Price <span>(Optional)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="pprice" id="blood_group_display_name" placeholder="e.g 250" type="text">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Specimen <span>(Optional)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="specimen" id="blood_group_display_name" placeholder="e.g WB EDTA(2ml) " type="text">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Method <span>(Optional)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="method" id="blood_group_display_name" placeholder="e.g Cell Counter/Microscopy " type="text">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Schedule*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="timing" id="blood_group_display_name" placeholder="e.g Daily" required="" type="text">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Report Delivery time*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="report_delivery_time" id="blood_group_display_name" placeholder="e.g Daily / Next day" required="" type="text">
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
      $('.test-product').select2({
        placeholder: 'Select a test'
      });

    $(document).on("change", "#testDetail" , function(){
      
      var selected = [];
      selected.push($('.test-product').select2('val'));
      if(selected.length == 0){
          $.notify("Select a test first","error");
          return;
      }
    console.log(selected);
    $.ajax({
        type: "POST",
        url:"{{URL::to('/lab/json/testdetail')}}",
        data:{test_ids: selected, _token: '{{ csrf_token() }}'},
        success:function(data){
            console.log('testdetail-success');
            console.log(data);
            $('#detail').html(data);

        },
        error: function(data){
          
            if(data.status == 422 && data.responseJSON.error)
                $.notify(data.responseJSON.error,"error");
            else
                $.notify("Something went wrong.","error");
        }
    });
    return false;
});
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
@endsection