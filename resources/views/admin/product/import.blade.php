@extends('layouts.admin')
@section('title','Import Products')

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
                                        <h2>Add Product <a href="{{ route('admin-prod-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> All Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Import
                                    </div>
                                </div>
                                  @include('includes.notification')
                            </div>   
                        </div>
                        <hr>
                      <div>
                        <a href="{{ route('admin-prod-export') }}" style="padding: 5px 12px; float:right;    margin-right: 10px;" class="btn add-back-btn"><i class="fa fa-download"></i> Download Template</a>
                        <br><br>
                          @include('includes.form-error')
                          @include('includes.form-success')


                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div class="tab-pane fade active in" id="physical">
                                <form class="form-horizontal" action="{{route('admin-prod-import')}}" method="POST" enctype="multipart/form-data" id="form1">
                                    {{csrf_field()}}


                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="">Select Excel File *</label>
                                        <div class="col-sm-6">
                                            <input type="file" id="uploadFile" class="hidden" name="file" value="" accept=".xlsx, .xls">
                                            <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control"><i class="fa fa-download"></i> Choose Excel File</button>
                                            
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="type" value="0">
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

  <script type="text/javascript">
    
    function uploadclick(){
        $("#uploadFile").click();
        $("#uploadFile").change(function(event) {
            $("#uploadTrigger").html($("#uploadFile").val());
        });
    }

  </script>
  
@endsection