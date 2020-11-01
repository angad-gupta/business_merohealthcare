@extends('layouts.user')
@section('title','Vendor Description')

@section('styles')

<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.min.css">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    <div class="right-side">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Starting of Dashboard Office Address -->
                    <div class="section-padding add-product-1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="add-product-box" style="min-height:500px">
                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Settings</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Vendor Description </p>
                                                </div>
                                            </div>
                                            @include('includes.user-notification')
                                        </div>   
                                    </div>


                                    <form class="form-horizontal" action="{{route('user-vendor-description-update',[$user->id])}}" method="POST">
                                        @include('includes.form-success')      
                                        {{csrf_field()}}
                                        {{-- <h1> UPDATE</h1> --}}


                                     
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="product_highlights">Vendor Description*</label>
                                            <div class="col-sm-6"> 
                                            <textarea class="form-control" name="description" id="product_highlights" rows="5" style="resize: vertical;" placeholder="Enter Vendor Description">{{$user->description}}</textarea>
                                            </div>
                                          </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="street_address">Vendor Website Link *</label>
                                          
                                            <div class="col-sm-6">
                                            <input id="inputGroup1_1" name="link" class="form-control form-control-md rounded-0" type="text" value="{{$user->link}}" placeholder="Enter Web Link">
                                            </div>
                                        </div>
                                      
                                        {{-- <div class="form-group">
                                            <label class="control-label col-sm-4" for="street_address">Shipping Cost *<span>Enter 0 if you don't want to add any shipping cost.</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="shipping_cost" id="street_address" placeholder="Shipping Cost" class="form-control" required="" value="{{$user->shipping_cost}}">

                                            </div>
                                        </div> --}}

                                        <hr>
                                        <div class="add-product-footer">
                                            <button name="addProduct_btn" type="submit" class="btn add-product_btn">Submit</button> 
                                        </div>
                                    </form>

                           
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard Office Address -->
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/nicEdit.js')}}"></script> 
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<style type="text/css">
    .nicEdit-main {
      width: 100% !important;
      min-height: 114px !important;
    }
  </style>
  <script type="text/javascript">
  //<![CDATA[
          bkLib.onDomLoaded(function() {
              new nicEditor().panelInstance('product_description');
              new nicEditor().panelInstance('product_highlights');
              // new nicEditor().panelInstance('policy');
              $('.nicEdit-panelContain').parent().width('100%');
              $('.nicEdit-panelContain').parent().next().width('98%');
          });
    //]]>




  </script>
   
@endsection