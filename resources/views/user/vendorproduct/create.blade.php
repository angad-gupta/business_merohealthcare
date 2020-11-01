@extends('layouts.user')
@section('title','Add New Product')

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

@php
    $user = Auth::guard('user')->user();
@endphp
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
                                        <h2>Add Vendor Product <a href="{{ route('user-vendor-product.index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> All Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Add
                                    </div>
                                </div>
                              
                            </div>   
                        </div>
                        <hr>
                      <div>

                          @include('includes.form-error')
                          @include('includes.form-success')
                        


                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div class="tab-pane fade active in" id="physical">
                              <form class="form-horizontal" action="{{route('user-vendor-prod-store')}}" method="POST" enctype="multipart/form-data" id="form1">
                                {{csrf_field()}}
                                <div class="form-group">
                                  <label class="control-label col-sm-4">Product Name* <span>(In Any Language)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Product Name" required="" type="text" >
                                  </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label class="control-label col-sm-4" for="generic_name">SKU Genre<span>(Optional)</span></label>
                                    <div class="col-sm-6">
                                      <input class="form-control" name="generic_name" value="{{ old('generic_name') }}" id="generic_name" placeholder="Enter SKU Genre" value="" type="text" >
                                    </div>
                                </div> --}}
                                
                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="sub_title">Variant Key<span>(Optional)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="sub_title" value="{{ old('sub_title') }}" id="sub_title" placeholder="Enter Product Sub-title" value="" type="text" >
                                  </div>
                                </div> --}}
  
                                

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="company_name">Product Company Name* <span>(In Any Language)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="company_name" value="{{ old('company_name') }}" id="company_name" placeholder="Enter Company Name" required="" type="text" >
                                  </div>
                                </div>
                                
                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="cat">Category*</label>
                                  <div class="col-sm-6">
                                    <select class="form-control category-multiple" name="childcategory_ids[]" value="{{ old('childcategory_ids[]') }}" multiple="multiple" required="">
                                      @foreach($cats as $cat)
                                        <optgroup label="{{$cat->cat_name}}">
                                          @foreach ($cat->subs()->has('childs')->get() as $subcat)
                                            <optgroup label="&nbsp;&nbsp;&nbsp;{{$subcat->sub_name}}">
                                              @foreach ($subcat->childs as $child)
                                                <option value="{{$child->id}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->child_name }}</option>
                                              @endforeach
                                            </optgroup>
                                          @endforeach
                                        </optgroup>
                                      @endforeach
                                    </select>
                                  </div>
                                </div> --}}

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="current_photo">Current Featured Image*</label>
                                  <div class="col-sm-6">
                                  <img id="adminimg" src="" alt="" style="width: 400px; height: 300px;">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="profile_photo">Select Image *</label>
                                  <div class="col-sm-6">
                                    <input type="file" id="uploadFile" name="photo"  value="{{ old('photo') }}" required >
                                    {{-- <button type="button" id="uploadTrigger" onclick="uploadclick()" class="form-control" ><i class="fa fa-download"></i> Choose Image</button> --}}
                                    <p style="text-align:left;">Prefered Size: (600x600) or Square Sized Image</p>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="profile_photo">Product Gallery Images <span></span></label>
                                  <div class="col-sm-6">
                                  <input style="display: none;" type="file" accept="image/*" id="uploadgallery1" name="gallery[]" value="{{ old('gallery[]') }}" multiple/>
                                  <div class="margin-top">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus"></i> Set Gallery</a>
                                  </div>
                                  </div>
                                </div>
                              
                                {{-- <div class="form-group">
                                    <label class="control-label col-sm-4" for="email"></label>
                                    <div class="col-sm-6">
                                      <div class="checkbox2">
                                      <input type="checkbox" id="check2" name="attrcheck" value="1"> 
                                      <label for="check2">Allow Product Attributes</label>
                                      </div>
                                    </div>          
                                </div>
                                
                                <div id="fimg" style="display: none;">

                                  
                                  <div class="profile-filup-description-box margin-bottom-30 row">
                                    <div class="col-sm-6 col-sm-offset-4">
                                      <h2 class="text-center">Product Attributes</h2>

                                      <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Attribute</th>
                                            <th scope="col">Value</th>
                                            <th scope="col"></th>
                                          </tr>
                                        </thead>
                                        <tbody class="attributes">
                                          <tr class="attribute-area">
                                            <td scope="row"><input class="form-control" name="attributes[0][name]" placeholder="Eg. Strip Size, Pack Size" type="text" value=""></td>
                                            
                                            <td><input class="form-control" name="attributes[0][value]" placeholder="Eg. 10 Strips, 10 ml" type="text" value="" ></td>
                                            <td width="10%"><button class="btn btn-danger attribute-close" type="button"><i class="fa fa-trash"></i></td>
                                          </tr>
                                        </tbody>
                                      </table>

                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for=""></label>
                                        <div class="col-sm-12 text-center">
                                          <button class="btn btn-default featured-btn" type="button" name="add-attribute-btn" id="add-attribute-btn"><i class="fa fa-plus"></i> Add More Field</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <br>
                                </div> --}}
                                
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="product_highlights">Product Highlights*  <span>Product key points (few points)</span></label>
                                  <div class="col-sm-6"> 
                                    <textarea class="form-control" name="highlights" value="{{ old('highlights') }}" id="product_highlights" rows="5" style="resize: vertical;" placeholder="Enter Product Highlights" ></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="product_description">Product Description* <span>Product short description(atlest around 50 words)</span></label>
                                  <div class="col-sm-6"> 
                                    <textarea class="form-control" name="description" value="{{ old('description') }}" id="product_description" rows="5" style="resize: vertical;" placeholder="Enter Product Description" ></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4">Product Current Price* <span>(In {{$sign->name}})</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="cprice" value="{{ old('cprice') }}"  placeholder="e.g 20" required="" type="text">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4">Product Previous Price <span>(Optional)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="pprice" value="{{ old('pprice') }}"  placeholder="e.g 25"  type="text">
                                  </div>
                                </div>

                                

                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4"></label>
                                  <div class="col-sm-6">
                                    <div class="checkbox2">
                                    <input type="checkbox" id="pricecheck_bonus" name="adv_price" value="1"> 
                                    <label for="check2">Allow Advanced Bonus Pricing</label>
                                    </div>
                                  </div>          
                                </div> 

                                <div id="adv_price_bonus" style="display: none;">
                           

                                  <div class="profile-filup-description-box margin-bottom-30 row">
                                    <div class="col-sm-6 col-sm-offset-4">
                                      <h2 class="text-center">Advanced Bonus Pricing</h2>
  
                                      <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Min Quantity</th>
                                            <th scope="col">Free Quantity </th>
                                            <th scope="col">Product Category </th>
                                            <th scope="col">Whole Sell Price </th>
                                            <th scope="col"></th>
                                          </tr>
                                        </thead>
                                        <tbody class="pricing-bonus">
                                
                                            <tr class="pricing-area-bonus">
                                              <td> <input class="form-control" name="pricings_bonus[0][is_bonus_price]" placeholder="" type="hidden" value="1" /> </td> 
                                              <td  width=""><input class="form-control" name="pricings_bonus[0][min_qty]" value="{{ old('pricings_bonus[0][min_qty]') }}" placeholder="Min Qty" type="number"  min="2" step="1" ></td>
                                              <td>
                                                <input class="form-control" type="text" value="" name="pricings_bonus[0][product_free_quantity]" value="{{ old('pricings_bonus[0][product_free_quantity]') }}" placeholder="eg. 5 " />
                                              </td>
                                              <td>
                                                <input class="form-control" type="text" value="" name="pricings_bonus[0][product_category]" value="{{ old('pricings_bonus[0][product_category]') }}" placeholder="eg. Strip/Box/Cartoon " />
                                              </td>
                                              <td width=""><input class="form-control pricingValue" name="pricings_bonus[0][product_bonus_price]" value="{{ old('pricings_bonus[0][product_bonus_price]') }}" placeholder="Whole sell Price" type="number" value="" min="0" ></td>
                                              <td width=""><button class="btn btn-danger price-close-bonus" type="button"><i class="fa fa-trash"></i></td>
                                            </tr>
                                    
                                 
                                        </tbody>
                                      </table>
  
                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for=""></label>
                                        <div class="col-sm-12 text-center">
                                          <button class="btn btn-default featured-btn" type="button" name="add-bonus-pricing-btn" id="add-bonus-pricing-btn"><i class="fa fa-plus"></i> Add More Field</button>
                                        </div>
                                      </div>
  
                                  
                                  </div>
                                  
                                  </div>
                                  <br> 
                                </div>--}}

                           

                             
                                <br>
                                <div class="form-group">
                                  <label class="control-label col-sm-4">Product Stock* <span>(Leave Empty will Show Always Available)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="stock" value="{{ old('stock') }}"  placeholder="e.g 15"  type="text">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4">Product Purchase Limit* <span>(Leave Empty for Unlimited Purchase)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="purchase_limit" value="{{ old('purchase_limit') }}" placeholder="e.g 5"  type="text">
                                  </div>
                                </div>
                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4">Product Requires Prescription*</label>
                                  <div class="col-sm-6">
                                    
                                    <input type="checkbox" name="requires_prescription" value="1" style="margin-top: 10px">
                                  </div>
                                </div> --}}
                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="email"></label>
                                  <div class="col-sm-6">
                                    <div class="checkbox2">
                                    <input type="checkbox" id="check50" name="mescheck" value="1">

                                    <label for="check50">Allow Product Measurement</label>
                                    </div>
                                  </div>          
                                </div> 
                                <div id="fimg50" style="display: none;">  
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="product_measure">Product Measurement*</label>
                                    <div class="col-sm-3">
                                      <select class="form-control" id="product_measure">
                                          <option value="">None</option>
                                          <option value="Gram">Gram</option>
                                          <option value="Kilogram">Kilogram</option>
                                          <option value="Litre">Litre</option>
                                          <option value="Pound">Pound</option>
                                          <option value="Custom">Custom</option>
                                      </select>
                                    </div>
                                    <div class="col-sm-3" id="measure" style="display: none;">
                                      <input class="form-control" name="measure" id="measurement" placeholder="Enter Unit"  type="text">
                                    </div>
                                  </div>
                                  <br>
                                </div> --}}
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="placeholder">Video URL* <span>(Optional)</span></label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="youtube" id="placeholder" value="{{ old('youtube') }}" placeholder="Enter Youtube/Facebook Video URL"  type="text">
                                  </div>
                                </div>

                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="policy">Product Buy/Return Policy*</label>
                                  <div class="col-xs-12 col-sm-6"> 
                                    <textarea class="form-control" name="policy" id="policy" rows="5" style="resize: vertical;" placeholder="Enter Profile Description"></textarea>
                                  </div>
                                </div> --}}
                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="email"></label>
                                  <div class="col-sm-6">
                                    <div class="checkbox2">
                                    <input type="checkbox" id="check12" name="secheck" value="1">

                                    <label for="check12">Allow Product SEO</label>
                                    </div>
                                  </div>          
                                </div> 
                                <div id="fimg4" style="display: none;">  
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="metaTags">Product Meta Tags*<span>(Write meta tags Separated by Comma[,])</span></label>
                                        <div class="col-sm-6">
                                            <ul id="metaTags">
                                            </ul>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="meta_description">Meta Description*</label>
                                    <div class="col-sm-6"> 
                                      <textarea class="form-control" name="meta_description" id="meta_description" rows="5" style="resize: vertical;" placeholder="Enter Meta Description"></textarea>
                                    </div>
                                  </div>
                                  <br>
                                </div>

                                <div class="profile-filup-description-box margin-bottom-30 row">
                                  <div class="col-sm-6 col-sm-offset-4">
                                    <h2 class="text-center">Feature Tags</h2>
                                    <div class="qualification" id="q">

                                      <div class="qualification-area">
                                          <div class="form-group">
                                              <div class="col-xs-12 col-sm-6">
                                                <label> Keyword: </label>
                                                <input class="form-control" name="features[]" value="{{ old('features[]') }}" placeholder="Keyword" type="text" value="">
                                              </div>
                                              <div class="col-xs-12 col-sm-6">
                                                <label> Choose Your Color: </label>
                                                  <div  class="input-group colorpicker-component">
                                                    <input type="text" name="colors[]" value="{{ old('colors[]') }}" value="#000000"  class="form-control colorpick" />
                                                      <span class="input-group-addon"><i></i></span>
                                                      <span class="ui-close" id="parentclose">X</span>
                                                  </div>
                                              </div>
                                          </div>
                                          
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for=""></label>
                                      <div class="col-sm-12 text-center">
                                        <button class="btn btn-default featured-btn" type="button" name="add-field-btn" id="add-field-btn"><i class="fa fa-plus"></i> Add More Field</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> --}}
                                <br>
                                {{-- <div class="form-group">
                                    <label class="control-label col-sm-4">Product Tags* <span>(Write your product tags Separated by Comma[,])</span></label>
                                    <div class="col-sm-6">
                                        <ul id="myTags">

                                        </ul>
                                    </div>
                                </div> --}}
                                <input type="hidden" name="type" value="0">

                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="placeholder">Product Quantity*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="product_quantity" value="{{ old('product_quantity') }}" id="placeholder" placeholder="eg: per piece , per strip, per box "  type="text" required="">
                                  </div>
                                </div>

                                {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="placeholder">VAT status *<span>(13% on OTC product)</span></label>
                                  <div class="col-sm-6">
                                 
  
                                    <input class="form-control" name="vat_status" value="" id="placeholder" placeholder="0 or 1 "  type="text" required="">
                                  </div>
                                </div> --}}
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Delivery Time</label>
                                    <div class="col-sm-6">
                                      <div class="checkbox2">
                                      <input type="checkbox" id="check11" name="shcheck" value="1" value="{{ old('shcheck') }}"> 
                                      <label for="check11">Allow Estimated Delivery Time</label>
                                      </div>
                                    </div>          
                                </div> 
                                <div id="fimg3"  style="display: none;">
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="ship_time">Product Estimated Delivery Time*</label>
                                    <div class="col-sm-6">
                                      <input class="form-control" name="ship" value="{{ old('ship') }}" id="ship_time" placeholder="Estimated Shipping Time" value="" type="text">
                                    </div>
                                  </div>
                                  <br>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4"> Discount Offers</label>
                                  <div class="col-sm-6">
                                    <div class="checkbox2">
                                    <input type="checkbox" id="pricecheck" name="adv_price" value="1"> 
                                    <label for="check2">Allow Advanced Pricing</label>
                                    </div>
                                  </div>          
                                </div> 

                                

                                <div id="adv_price" style="display: none;">
                                  <div class="profile-filup-description-box margin-bottom-30 row">
                                    <div class="col-sm-6 col-sm-offset-4">
                                      <h2 class="text-center">Advanced Offer Pricing</h2>

                                      <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Min Quantity</th>
                                            <th scope="col">Discount Type</th>
                                            <th scope="col">Price/Discount per Item</th>
                                            <th scope="col"></th>
                                          </tr>
                                        </thead>
                                        <tbody class="pricing">
                                          <tr class="pricing-area">
                                            <td scope="row" width="25%"><input class="form-control" name="pricings[0][min_qty]" value="{{ old('pricings[0][min_qty]') }}" placeholder="Min Qty" type="number"  min="2" step="1"></td>
                                            <td>
                                              <select class="form-control pricingOption" name="pricings[0][type]" value="{{ old('pricings[0][type]') }}">
                                                <option disabled selected>Choose a type</option>
                                                <option value="0">By Percentage</option>
                                                <option value="1">By Amount</option>
                                              </select>
                                            </td>
                                            <td width="35%"><input class="form-control pricingValue" name="pricings[0][value]" value="{{ old('pricings[0][value]') }}"  placeholder="Discount Amount/Percentage" type="number" min="0"></td>
                                            <td width="5%"><button class="btn btn-danger price-close" type="button"><i class="fa fa-trash"></i></td>
                                          </tr>
                                        </tbody>
                                      </table>

                                      <div class="form-group">
                                        <label class="control-label col-sm-3" for=""></label>
                                        <div class="col-sm-12 text-center">
                                          <button class="btn btn-default featured-btn" type="button" name="add-pricing-btn" id="add-pricing-btn"><i class="fa fa-plus"></i> Add More Field</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <br>

                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4">Discount Timer</label>
                                  <div class="col-sm-6">
                                    <div class="checkbox2">
                                    <input type="checkbox" id="discountCheck" name="discountCheck" value="1"> 
                                    <label for="check11">Allow Discount Timer</label>
                                    </div>
                                  </div>          
                              </div> 
                              <div id="discountSection"  style="display: none;">
                                
                                <div class="form-group">
                                  <label class="control-label col-sm-4">Discount Percentage*</label>
                                  <div class="col-sm-6">
                                      <input class="form-control discountCheck" name="sale_percentage" value="{{ old('sale_percentage') }}" placeholder="Discount Percentage" type="number" value="" min="1" max="100" step="any">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4">Sale Stock* <span>(Leave Empty for Unlimited)</span></label>
                                  <div class="col-sm-6">
                                      <input class="form-control discountCheck" name="sale_stock" value="{{ old('sale_stock') }}" placeholder="Sale Stock" type="number" value="" min="1">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4">Starts From*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control discountCheck startdatepicker" name="sale_from" value="{{ old('sale_from') }}" placeholder="Sale Starts From">
                                      
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4">Ends To*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control discountCheck enddatepicker" name="sale_to" value="{{ old('sale_to') }}" placeholder="Sale Ends At">
                                      
                                  </div>
                                </div>
                              </div>


                                <input class="" name="user_id" value="{{$user->id}}" type="text" hidden>

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
  <!-- Gallry Modal1 -->
  <div id="myModal1" class="modal fade gallery" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Image Gallery</h4>
        </div>
        <div class="modal-body">
          <div class="gallery-btn-area text-center">
              <a style="cursor: pointer;" class="btn btn-info gallery-btn mr-5" id="prod_gallery1"><i class="fa fa-download"></i> Upload Images</a>
              <a style="cursor: pointer; background: #009432;" class="btn btn-info gallery-btn mr-5" data-dismiss="modal"><i class="fa fa-check" ></i> Done</a>
              <p style="font-size: 11px;">You can upload multiple images.</p>
          </div>

          <div class="gallery-wrap" id="gallery-wrap1">
                  <div class="row">
                  </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <style type="text/css">
    .nicEdit-main {
      width: 100% !important;
      min-height: 114px !important;
    }
  </style>
  <script type="text/javascript">
      $('.colorpicker-component').colorpicker();
      $('.colorpick').colorpicker();

      $('.category-multiple').select2({
        placeholder: 'Select a category'
      });
  </script>
  <script type="text/javascript">
  
    // $("#pricecheck").change(function() {
    //     if(this.checked) {
    //         $("#adv_price").show();
    //         $('.pricing-area input').attr('required','required')
    //         $('.pricing-area select').attr('required','required')

    //     }
    //     else
    //     {
    //         $("#adv_price").hide();
    //         $('.pricing-area input').removeAttr('required')
    //         $('.pricing-area select').removeAttr('required')
    //     }
    // });


    $("#pricecheck").change(function() {
        if(this.checked) {
            $("#adv_price").show();
            $('.pricing-area input').attr('required','required')
            $('.pricing-area select').attr('required','required')
        
            // $('.pricing-area-bonus input').attr('required','required')
            // $('.pricing-area-bonus input').attr('required','required')

        }
        else
        {
            $("#adv_price").hide();
            $('.pricing-area input').removeAttr('required')
            $('.pricing-area select').removeAttr('required')
        
            // $('.pricing-area-bonus input').removeAttr('required')
            // $('.pricing-area-bonus input').removeAttr('required')
        }
       
    });

    $("#pricecheck_bonus").change(function() {
        if(this.checked) {
            $("#adv_price_bonus").show();
            // $('.pricing-area-bonus input').attr('required','required')
            // $('.pricing-area-bonus input').attr('required','required')

        }
        else
        {
            $("#adv_price_bonus").hide();
            // $('.pricing-area-bonus input').removeAttr('required')
            // $('.pricing-area-bonus input').removeAttr('required')
        }
       
    });

    $(document).on('change', 'select.pricingOption' ,function() {
      if($(this).val() == 0)
        $(this.parentNode.parentNode).find('.pricingValue').attr('max',100);
      else
        $(this.parentNode.parentNode).find('.pricingValue').removeAttr('max');
    });

    $("#check2").change(function() {
        if(this.checked) {
            $("#fimg").show();
        }
        else
        {
            $("#fimg").hide();

        }
    });
  </script>

  <script type="text/javascript">
    $("#type_check").change(function() {
        var val = $(this).val();
        if(val == 1)
        {
          $('#link').hide();
          $('#file').show();
        }
        else{
          $('#link').show();
          $('#file').hide();      
        }
    });
    $("#type_check1").change(function() {
        var val = $(this).val();
        if(val == 1)
        {
          $('#link1').hide();
          $('#file1').show();
        }
        else{
          $('#link1').show();
          $('#file1').hide();      
        }
    });
    
    $("#check11").change(function() {
        if(this.checked) {
            $("#fimg3").show();
        }
        else
        {
            $("#fimg3").hide();

        }
    });
    $("#check12").change(function() {
        if(this.checked) {
            $("#fimg4").show();
        }
        else
        {
            $("#fimg4").hide();

        }
    });
    $("#check122").change(function() {
        if(this.checked) {
            $("#fimg44").show();
        }
        else
        {
            $("#fimg44").hide();

        }
    });
    $("#check1222").change(function() {
        if(this.checked) {
            $("#fimg444").show();
        }
        else
        {
            $("#fimg444").hide();

        }
    });
    $("#check50").change(function() {
        if(this.checked) {
            $("#fimg50").show();
        }
        else
        {
            $("#fimg50").hide();

        }
    });
    $("#product_measure").change(function() {
        var val = $(this).val();
        $('#measurement').val(val);
        if(val == "Custom")
        {
        $('#measurement').val('');
          $('#measure').show();
        }
        else{
          $('#link').show();
          $('#measure').hide();      
        }
    });
  </script>

  <script type="text/javascript" src="{{asset('assets/admin/js/nicEdit.js')}}"></script> 
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
              };
              reader.readAsDataURL(input.files[0]);
          }
    }

  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">

    $("#discountCheck").change(function() {
        if(this.checked) {
            $("#discountSection").show();
            $('.discountCheck').attr('required','required')
        }
        else
        {
            $("#discountSection").hide();
            $('.discountCheck').removeAttr('required')

        }
    });

    $('.startdatepicker').datetimepicker({
      format: 'YYYY/MM/DD hh:mm A'
    });
    $('.enddatepicker').datetimepicker({
      format: 'YYYY/MM/DD hh:mm A'
    });

  </script>
    
  <script type="text/javascript">
        $(document).on('click','#add-color',function() {

          $(".color-area").append('<div class="form-group single-color">'+
                  ' <label class="control-label col-sm-4">'+
                  ' Product Colors* <span>(Choose Your Favourite Color.)</span></label>'+
                    '<div class="col-sm-6">'+
                    '<div class="input-group colorpicker-component">'+
                  '<input  type="text" name="color[]" value="#000000"  class="form-control colorpick"  />'+
                      '<span class="input-group-addon"><i></i></span>'+
                    '<span class="ui-close1">X</span>'+
                        '</div>'+
                    '</div>'+
                  '</div>');
              $('.colorpicker-component').colorpicker();
              $('.colorpick').colorpicker();

      });

    function isEmpty(el){
        return !$.trim(el.html())
    }


    $(document).on('click', '.ui-close1' ,function() {
      $(this.parentNode.parentNode.parentNode).hide();
      $(this.parentNode.parentNode.parentNode).remove();
      if (isEmpty($('#q1'))) {

          $(".color-area").append('<div class="form-group single-color">'+
                  ' <label class="control-label col-sm-4">'+
                  ' Product Colors* <span>(Choose Your Favourite Color.)</span></label>'+
                    '<div class="col-sm-6">'+
                    '<div class="input-group colorpicker-component">'+
                  '<input  type="text" name="color[]" value="#000000"  class="form-control colorpick"  />'+
                      '<span class="input-group-addon"><i></i></span>'+
                    '<span class="ui-close1">X</span>'+
                        '</div>'+
                    '</div>'+
                  '</div>');

              $('.colorpicker-component').colorpicker();
              $('.colorpick').colorpicker();
      }
    });
  </script>


  <script type="text/javascript">
    $(document).on('click','#add-field-btn',function() {
        $(".qualification").append('<div class="qualification-area">'+
                '<div class="form-group">'+
                '<div class="col-xs-12 col-sm-6">'+
                '<label> Keyword: </label>'+
                '<input type="text" class="form-control" name="features[]" placeholder="Keyword" required="">'+
                  '</div>'+                
                  '<div class="col-xs-12 col-sm-6">'+
                  '<label> Choose Your Color: </label>'+
                  '<div class="input-group colorpicker-component">'+
                '<input  type="text" name="colors[]" value="#000000"  class="form-control colorpick"  />'+
                    '<span class="input-group-addon"><i></i></span>'+
                  '<span class="ui-close">X</span>'+
                      '</div>'+
                    '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>');
            $('.colorpicker-component').colorpicker();
            $('.colorpick').colorpicker();

    });

    $(document).on('click','#add-pricing-btn',function() {
      var index = $('.pricing').children().length;      
                  
      $(".pricing").append('<tr class="pricing-area">'+
        '  <td scope="row" width="25%"><input class="form-control" name="pricings['+index+'][min_qty]" placeholder="Min Quantity" type="number" value="" min="2" step="1" required></td>'+
        '  <td>'+
        '    <select class="form-control pricingOption" name="pricings['+index+'][type]" required>'+
        '      <option disabled selected>Choose a type</option>'+
        '      <option value="0">By Percentage</option>'+
        '      <option value="1">By Amount</option>'+
        '    </select>'+
        '  </td>'+
        '  <td width="35%"><input class="form-control pricingValue" name="pricings['+index+'][value]" placeholder="Discount Amount/Percentage" type="number" value="" min="0" required></td>'+
          '<td width="5%"><button class="btn btn-danger price-close" type="button"><i class="fa fa-trash"></i></td>'+
        '</tr>'
      );

    });

    $(document).on('click','#add-bonus-pricing-btn',function() {
      var index = $('.pricing-bonus').children().length;      
      $(".pricing-bonus").append('<tr class="pricing-area-bonus">'+
        '<td><input class="form-control" name="pricings_bonus['+index+'][is_bonus_price]" placeholder="" type="hidden" value="1" required> </td> '+
        '<td><input class="form-control" name="pricings_bonus['+index+'][min_qty]" placeholder="Min Quantity" type="number" value="" min="2" step="1" required></td>'+
        '<td><input class="form-control" type="text" value="" name="pricings_bonus['+index+'][product_free_quantity]" placeholder="eg. 5 " required/></td>'+
        '<td><input class="form-control" type="text" value="" name="pricings_bonus['+index+'][product_category]" placeholder="eg. Strip/Box/Cartoon " required/><td>'+
        '<td><input class="form-control pricingValue" name="pricings_bonus['+index+'][product_bonus_price]" placeholder="Whole Sell Price" type="number" value="" min="0" required></td>'+
        '<td><button class="btn btn-danger price-close-bonus" type="button"><i class="fa fa-trash"></i></td>'+
        '</tr>');

    });

    $(document).on('click','#add-attribute-btn',function() {
      var index = $('.attributes').children().length;      
                  
      $(".attributes").append('<tr class="attribute-area">'+
        '  <td scope="row"><input class="form-control" name="attributes['+index+'][name]" placeholder="Eg. Strip Size, Pack Size" type="text" value=""></td>'+
        '  <td><input class="form-control" name="attributes['+index+'][value]" placeholder="Eg. 10 Strips, 10 ml" type="text" value=""></td>'+
          '<td width="10%"><button class="btn btn-danger attribute-close" type="button"><i class="fa fa-trash"></i></td>'+
        '</tr>'
      );

    });

    function isEmpty(el){
        return !$.trim(el.html())
    }


    $(document).on('click', '.ui-close' ,function() {
      $(this.parentNode.parentNode.parentNode.parentNode).hide();
      $(this.parentNode.parentNode.parentNode.parentNode).remove();
      if (isEmpty($('#q'))) {
          $(".qualification").append('<div class="qualification-area">'+
                  '<div class="form-group">'+
                  '<div class="col-xs-12 col-sm-6">'+
                  '<label> Keyword: </label>'+
                  '<input type="text" class="form-control" name="features[]" placeholder="Keyword">'+
                    '</div>'+                
                    '<div class="col-xs-12 col-sm-6">'+
                    '<label> Choose Your Color: </label>'+
                    '<div class="input-group colorpicker-component">'+
                  '<input  type="text" name="colors[]" value="#000000"  class="form-control colorpick"  />'+
                      '<span class="input-group-addon"><i></i></span>'+
                    '<span class="ui-close">X</span>'+
                        '</div>'+
                      '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>');
              $('.colorpicker-component').colorpicker();
              $('.colorpick').colorpicker();
      }
    });

    $(document).on('click', '.price-close' ,function() {
      
      $(this.parentNode.parentNode).hide();
      $(this.parentNode.parentNode).remove();

      if (isEmpty($('.pricing'))) {
        $(".pricing").append('<tr class="pricing-area">'+
          '  <td scope="row" width="25%"><input class="form-control" name="pricings[0][min_qty]" placeholder="Min Quantity" type="number" value="" min="2" step="1" required></td>'+
          '  <td>'+
          '    <select class="form-control pricingOption" name="pricings[0][type]" required>'+
          '      <option disabled selected>Choose a type</option>'+
          '      <option value="0">By Percentage</option>'+
          '      <option value="1">By Amount</option>'+
          '    </select>'+
          '  </td>'+
          '  <td width="35%"><input class="form-control pricingValue" name="pricings[0][value]" placeholder="Discount Amount/Percentage" type="number" value="" min="0" required></td>'+
          '  <td width="5%"><button class="btn btn-danger price-close" type="button"><i class="fa fa-trash"></i></td>'+
          '</tr>');
      }
    });

    $(document).on('click', '.price-close-bonus' ,function() {
      
      $(this.parentNode.parentNode).hide();
      $(this.parentNode.parentNode).remove();
  
      if (isEmpty($('.pricing-bonus'))) {
        $(".pricing-bonus").append('<tr class="pricing-area-bonus">'+
          '<td><input class="form-control" name="pricings_bonus[0][is_bonus_price]" placeholder="" type="hidden" value="1" required> </td> '+
        '<td><input class="form-control" name="pricings_bonus[0][min_qty]" placeholder="Min Quantity" type="number" value="" min="2" step="1" required></td>'+
        '<td><input class="form-control" type="text" value="" name="pricings_bonus[0][product_free_quantity]" placeholder="eg. 5 " required/></td>'+
        '<td><input class="form-control" type="text" value="" name="pricings_bonus[0][product_category]" placeholder="eg. Strip/Box/Cartoon " required/><td>'+
        '<td><input class="form-control pricingValue" name="pricings_bonus[0][product_bonus_price]" placeholder="Whole Sell Price" type="number" value="" min="0" required></td>'+
        '<td><button class="btn btn-danger price-close-bonus" type="button"><i class="fa fa-trash"></i></td>'+
          '</tr>');
      }
    });

    $(document).on('click', '.attribute-close' ,function() {
      
      $(this.parentNode.parentNode).hide();
      $(this.parentNode.parentNode).remove();

      if (isEmpty($('.attributes'))) {
        $(".attributes").append('<tr class="attribute-area">'+
          '  <td scope="row"><input class="form-control" name="attributes[0][name]" placeholder="Eg. Strip Size, Pack Size" type="text" value=""></td>'+
          '  <td><input class="form-control" name="attributes[0][value]" placeholder="Eg. 10 Strips, 10 ml" type="text" value=""></td>'+
          '  <td width="10%"><button class="btn btn-danger attribute-close" type="button"><i class="fa fa-trash"></i></td>'+
          '</tr>');
      }
    });
  </script>

  <script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>    
  <script src="{{asset('assets/admin/js/tag-it.js')}}" type="text/javascript" charset="utf-8"></script>

  <script type="text/javascript">
      $(document).ready(function() {
          $("#size").tagit({
            fieldName: "size[]",
            allowSpaces: true 
          });
      });
  </script>

  <script type="text/javascript">
      $(document).ready(function() {
          $("#myTags, #myTags1, #myTags2").tagit({
            fieldName: "tags[]",
            allowSpaces: true 
          });
      });

      $(document).ready(function() {
          $("#metaTags, #metaTags1, #metaTags2").tagit({
            fieldName: "meta_tag[]",
            allowSpaces: true 
          });
      });

  // Gallery Section

    $(document).on('click', '.close1' ,function() {
      var id = $(this).find('input[type=hidden]').val();
      $('#galval1'+id).remove();
      $(this).parent().parent().remove();
    });

    $(document).on('click', '#prod_gallery1' ,function() {
      $('#uploadgallery1').click();
      $('#gallery-wrap1 .row').html('');
      $('#form1').find('.removegal1').val(0);
    });

    $("#uploadgallery1").change(function(){
      var total_file=document.getElementById("uploadgallery1").files.length;
      for(var i=0;i<total_file;i++)
      {
        $('#gallery-wrap1 .row').append('<div class="col-sm-4">'+
                                    '<div class="gallery__img">'+
                                    '<img src="'+URL.createObjectURL(event.target.files[i])+'" alt="gallery image">'+
                                    '<div class="gallery-close close1">'+
                                    '<input type="hidden" value="'+i+'">'+
                                    '<i class="fa fa-close"></i>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>');
        $('#form1').append('<input type="hidden" name="galval[]" id="galval1'+i+'" class="removegal1" value="'+i+'">')
      }

    });
  </script>



@endsection