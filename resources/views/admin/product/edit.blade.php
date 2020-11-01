@extends('layouts.admin')
@section('title',$prod->name.' | Update Product')

@section('styles')

<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.min.css">

 <!-- CSS Unify -->
 {{-- <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-core.css">
 <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-components.css">
 <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-globals.css"> --}}

 <!-- CSS Customization -->
 <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/custom.css">
 <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">


<style type="text/css">
    .colorpicker-alpha {display:none !important;}
    .colorpicker{ min-width:128px !important;}
    .colorpicker-color {display:none !important;}
    .add-product-box .form-horizontal .form-group:last-child {margin-bottom: 20px; }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

<style>
  
  :root {
  --font-barlow: 'Barlow', sans-serif;
  --font-barlowCondensed: 'Barlow Condensed', sans-serif;
  --time-nav-hover: 0.25s;
  --color-fire: #2385aa;
  --color-black: #191919;
  --color-grey-5: #FBFBFB;
  --color-grey-10: #F6F7F7;
  --color-grey-cool-10: #EEEEEF;
  --color-grey-15: #E8E8E8;
  --color-grey-20: #D5D6D8;
  --color-grey-60: #ABADB1;
  --color-grey-70: #888891;
  --color-grey-80: #6B6A6A;
  --color-grey-85: #59595F;
  /* --shadow-fire:
  0 4px 12px 4px rgba(227,0,0,0.2),
  0 1px 3px 0 rgba(137,7,7,0.4)
  ; */
  --focus-style: dotted 2px var(--color-black);
  --focus-offset: 2px;
  }
  
  
  
  
  
  #inputContainer {
  
  margin: 0 auto;
  max-width: 50em;
  padding: 0em;
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  flex-flow: column;
  -webkit-box-pack: center;
  justify-content: center;
  }
  
  .inputGroup {
  display: block;
  margin: 0 0 1.5em;
  }
  
  .label {
  display: block;
  font-size: 1.5em;
  font-weight: 700;
  font-family: var(--font-barlowCondensed);
  line-height: 1em;
  margin: 0 0 .6em;
  padding: 0;
  /* text-transform: uppercase; */
  color: gray;
  }
  
  .segmentedControl {
  --options: 3;
  --options-active: 1;
  --options-gap: .5em;
  background: var(--color-grey-10);
  border: solid 1px var(--color-grey-70);
  border-radius: 0.25em;
  position: relative;
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  flex-flow: row;
  -webkit-box-pack: start;
  justify-content: flex-start;
  }
  .segmentedControl .segmentedControl--group {
  -webkit-box-flex: 0;
  flex: 0 0 auto;
  margin: var(--options-gap);
  width: calc((100% - ((var(--options)*var(--options-gap))*2)) / var(--options));
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  flex-flow: row;
  -webkit-box-pack: stretch;
  justify-content: stretch;
  -webkit-box-align: stretch;
  align-items: stretch;
  }
  .segmentedControl .segmentedControl--group input {
  opacity: 0;
  position: absolute;
  }
  .segmentedControl .segmentedControl--group input + label {
  border-radius: .25em;
  -webkit-box-flex: 1;
  flex: 1 1 100%;
  font-size: 1em;
  font-weight: normal;
  font-family: var(--font-barlow);
  line-height: 1;
  margin: 0;
  padding: 0.5em 0;
  position: relative;
  text-align: center;
  -webkit-tap-highlight-color: transparent;
  z-index: 1;
  }
  .segmentedControl .segmentedControl--group input + label::before, .segmentedControl .segmentedControl--group input + label::after {
  border-radius: inherit;
  content: "";
  display: block;
  height: 100%;
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  z-index: -1;
  }
  .segmentedControl .segmentedControl--group input + label::before {
  background: var(--color-grey-20);
  -webkit-transition: opacity .15s ease;
  transition: opacity .15s ease;
  }
  .segmentedControl .segmentedControl--group input + label::after {
  background: var(--color-fire);
  box-shadow: var(--shadow-fire);
  -webkit-transition: opacity .15s ease;
  transition: opacity .15s ease;
  }
  .segmentedControl .segmentedControl--group input + label:hover::before {
  opacity: 1;
  }
  .segmentedControl .segmentedControl--group input:focus + label {
  outline: none;
  }
  .segmentedControl .segmentedControl--group input:focus-visible + label {
  outline: var(--focus-style);
  outline-offset: var(--focus-offset);
  }
  .segmentedControl .segmentedControl--group input:-moz-focusring + label {
  outline: var(--focus-style);
  outline-offset: var(--focus-offset);
  }
  .segmentedControl .segmentedControl--group input:checked + label {
  background: var(--color-grey-10);
  color: #fff;
  font-weight: 700;
  }
  .segmentedControl .segmentedControl--group input:checked + label::after {
  opacity: 1;
  -webkit-transform: scale(1);
  transform: scale(1);
  }
  
  @media (prefers-reduced-motion: no-preference) {
  .segmentedControl .segmentedControl--group input + label {
  -webkit-transition: color .2s ease;
  transition: color .2s ease;
  }
  .segmentedControl .segmentedControl--group input + label::before {
  -webkit-transition: opacity .3s ease;
  transition: opacity .3s ease;
  }
  .segmentedControl .segmentedControl--group input + label::after {
  -webkit-transform: scale(0.85, 0.5);
  transform: scale(0.85, 0.5);
  -webkit-transition: opacity 0.15s ease, -webkit-transform 0.3s cubic-bezier(0, 0.99, 0.52, 1.29);
  transition: opacity 0.15s ease, -webkit-transform 0.3s cubic-bezier(0, 0.99, 0.52, 1.29);
  transition: opacity 0.15s ease, transform 0.3s cubic-bezier(0, 0.99, 0.52, 1.29);
  transition: opacity 0.15s ease, transform 0.3s cubic-bezier(0, 0.99, 0.52, 1.29), -webkit-transform 0.3s cubic-bezier(0, 0.99, 0.52, 1.29);
  }
  .segmentedControl.useSlidingAnimation::before {
  background: var(--color-fire);
  border-radius: .375em;
  box-shadow: var(--shadow-fire);
  content: "";
  display: block;
  height: calc(100% - (var(--options-gap)*2));
  position: absolute;
  top: var(--options-gap);
  left: var(--options-gap);
  -webkit-transform: translateX(calc(  (100% + (var(--options-gap) * 2) ) * (var(--options-active) - 1) ));
  transform: translateX(calc(  (100% + (var(--options-gap) * 2) ) * (var(--options-active) - 1) ));
  -webkit-transition: -webkit-transform cubic-bezier(0.8, 0.34, 0.28, 1.15) 0.35s;
  transition: -webkit-transform cubic-bezier(0.8, 0.34, 0.28, 1.15) 0.35s;
  transition: transform cubic-bezier(0.8, 0.34, 0.28, 1.15) 0.35s;
  transition: transform cubic-bezier(0.8, 0.34, 0.28, 1.15) 0.35s, -webkit-transform cubic-bezier(0.8, 0.34, 0.28, 1.15) 0.35s;
  width: calc((100% - ((var(--options)*var(--options-gap))*2)) / var(--options));
  }
  .segmentedControl.useSlidingAnimation .segmentedControl--group input + label {
  background: none;
  -webkit-transition: color .3s ease;
  transition: color .3s ease;
  }
  .segmentedControl.useSlidingAnimation .segmentedControl--group input + label::after {
  content: none;
  }
  .segmentedControl.useSlidingAnimation .segmentedControl--group input:checked + label:hover::before {
  opacity: 0;
  }
  }
  /* utilities */
  .visually-hidden:not(:focus):not(:active) {
  clip: rect(0 0 0 0);
  -webkit-clip-path: inset(50%);
  clip-path: inset(50%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
  }
  
  .hidden {
  display: none !important;
  }
  
  .offscreen {
  height: 1px;
  left: -10000px;
  overflow: hidden;
  position: absolute;
  top: auto;
  width: 1px;
  }
  
  </style>
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
                                          <h2>Update Product <a href="{{ route('admin-prod-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                          <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> All Products <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Update
                                      </div>
                                  </div>
                                    @include('includes.notification')
                              </div>   
                          </div>
                          <hr>
                          <form class="form-horizontal" action="{{route('admin-prod-update',$prod->id)}}" method="POST" enctype="multipart/form-data">
                              @include('includes.form-error')
                              @include('includes.form-success')
                              {{csrf_field()}}

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="blood_group_display_name">Vendor Name :<span></span></label>
                                <div class="col-sm-6">
                                  @if($prod->user_id != 0)
                                  @php
                                      $vendor = App\User::findOrFail($prod->user_id); 
                                  @endphp
                                  <h2 class="h4" style="font-weight:700;color:rgb(121, 103, 0)">{{$vendor->name}}</h2>
                                  @else
                                  <h2 class="h4" style="font-weight:700; color:red;">Admin</h2>
                                  @endif
                                
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="blood_group_display_name">Product Name* </label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="name" id="blood_group_display_name" placeholder="Enter Product Name" required="" value="{{$prod->name}}" type="text" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="blood_group_display_name">Product Type<span>(If product belongs to any these optional)</span> </label>
                                <div class="col-sm-6">
                                  <div id="inputContainer">
                                    <fieldset id="aspectRatio--group" class="inputGroup">

                                      <div class="segmentedControl">
                                        <span class="segmentedControl--group">
                                          <input type="radio" name="medicine_type" id="tablet" value="tablet" {{ $prod->medicine_type == 'tablet' ? 'checked' : '' }} />
                                          <label class="label" for="tablet">Tablet</label>
                                        </span>
                                        <span class="segmentedControl--group">
                                          <input type="radio" name="medicine_type" id="capsule" value="capsule" {{ $prod->medicine_type == 'capsule' ? 'checked' : '' }} />
                                          <label class="label" for="capsule">Capsule</label>
                                        </span>
                                        <span class="segmentedControl--group">
                                          <input type="radio" name="medicine_type" id="injection" value="injection" {{ $prod->medicine_type == 'injection' ? 'checked' : '' }} />
                                          <label class="label" for="injection">Injection</label>
                                        </span>
                                      </div>
                                      <div class="segmentedControl">
                                        <span class="segmentedControl--group">
                                          <input type="radio" name="medicine_type" id="syrup" value="syrup" {{ $prod->medicine_type == 'syrup' ? 'checked' : '' }} />
                                          <label class="label" for="syrup">Syrup</label>
                                        </span>
                                     
                                        <span class="segmentedControl--group">
                                          <input type="radio" name="medicine_type" id="drops" value="drops" {{ $prod->medicine_type == 'drops' ? 'checked' : '' }} />
                                          <label class="label" for="drops">Drops</label>
                                        </span>
                         
                                        <span class="segmentedControl--group">
                                          <input type="radio" name="medicine_type" id="gel" value="gel" {{ $prod->medicine_type == 'gel' ? 'checked' : '' }} />
                                          <label class="label" for="gel">Gel</label>
                                        </span>
                                      </div>

                                      <div class="segmentedControl">
                                        <span class="segmentedControl--group">
                                          <input type="radio" name="medicine_type" id="infusion" value="infusion" {{ $prod->medicine_type == 'infusion' ? 'checked' : '' }} />
                                          <label class="label" for="infusion">Infusion</label>
                                        </span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-sm-4" for="generic_name">SKU Genre</label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="generic_name" id="generic_name" placeholder="Enter SKU Genre Name" value="{{$prod->generic_name}}" type="text" >
                                  </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="sub_title">Variant Key</label>
                                <div class="col-sm-3">
                                  <input class="form-control" name="sub_title" id="sub_title" placeholder="Enter Product Sub-title" value="{{$prod->sub_title}}" type="text" >
                                </div>
                                <label class="control-label col-sm-2" for="sub_title" style="color:green;">Priority Order <span>(Leave Empty if no order)</span></label>
                                
                                <div class="col-sm-1">
                                  <input class="form-control" name="priority_order" id="sub_title" placeholder="eg, 1,2,3..." value="{{$prod->priority_order}}" type="text" >
                                </div>
                              </div>

                              

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="company_name">Product Company Name* </label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name" required="" value="{{$prod->company_name}}" type="text" >
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="cat">Category*</label>
                                <div class="col-sm-6">
                                  <select class="form-control category-multiple" name="childcategory_ids[]" multiple="multiple" required="">
                                    @foreach($cats as $cat)
                                      <optgroup label="{{$cat->cat_name}}">
                                        @foreach ($cat->subs()->has('childs')->get() as $subcat)
                                          <optgroup label="&nbsp;&nbsp;&nbsp;{{$subcat->sub_name}}">
                                            @foreach ($subcat->childs as $child)
                                              <option value="{{$child->id}}" {{ in_array($child->id, $prod->childcategories()->pluck('id')->toArray()) ? "selected":""}}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->child_name }}</option>
                                            @endforeach
                                          </optgroup>
                                        @endforeach
                                      </optgroup>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="current_photo">Current Featured Image*</label>
                                <div class="col-sm-6">
                                  <img id="adminimg" src="{{asset('assets/images/'.$prod->photo)}}" alt="" style="width: 400px; height: 300px; border-radius:10px;">
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

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="profile_photo">Product Gallery Images *<span></span></label>
                                <div class="col-sm-6">
                                <input style="display: none;" type="file" accept="image/*" id="uploadgallery1" name="gallery[]" multiple/>
                                <div class="margin-top">
                                  <a href="" class="btn btn-primary view-gallery" data-toggle="modal" data-target="#myModal">
                                    <input type="hidden" value="{{$prod->id}}">
                                    <i class="fa fa-eye"></i> View Gallery</a>
                                </div>
                                </div>
                              </div>
                              <hr>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="email"></label>
                                <div class="col-sm-6">
                                  <div class="checkbox2">
                                  <input type="checkbox" id="check11" name="shcheck" value="1" {{$prod->ship != null ? "checked":""}}> 
                                  <label for="check11">Allow Estimated Shipping Time</label>
                                  </div>
                                </div>          
                              </div> 
                              <div id="fimg3" {!! $prod->ship == null ? "style='display: none;'":"" !!}>
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="ship_time">Product Estimated Shipping Time*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control" name="ship" id="ship_time" placeholder="Estimated Shipping Time" value=" {{ $prod->ship != null ? $prod->ship:"" }}" type="text">
                                  </div>
                                </div>
                                <br>
                              </div>
                              
                              {{-- <div id="fimg" >
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Product Sizes* <span>(Write your own size Separated by Comma[,])</span></label>
                                  <div class="col-sm-6">
                                    <ul id="size">
                                      @if(!empty($size))
                                      @foreach($size as $sz)
                                      <li>{{$sz}}</li>
                                      @endforeach
                                      @else
                                      <li>X</li>
                                      <Li>XL</Li>
                                      <li>XXL</li>
                                      <li>M</li>
                                      <li>L</li>
                                      <li>S</li>
                                      @endif
                                    </ul>
                                  </div>
                                </div>
                                <br>
                              </div> --}}

                              {{-- <div class="form-group">
                                  <label class="control-label col-sm-4" for="email"></label>
                                  <div class="col-sm-6">
                                    <div class="checkbox2">
                                    <input type="checkbox" id="check2" name="attrcheck" value="1" {{$prod->attributes()->count() > 0 ? "checked":""}}> 
                                    <label for="check2">Allow Product Attributes</label>
                                    </div>
                                  </div>          
                              </div>
                            
                              <div id="fimg" style="display:{{ $prod->attributes()->count() > 0 ? 'block' :'none' }}">
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
                                        @forelse ($prod->attributes as $attribute)
                                          <tr class="attribute-area">
                                            <td scope="row"><input class="form-control" name="attributes[{{ $loop->iteration-1 }}][name]" placeholder="Eg. Strip Size, Pack Size" type="text" value="{{ $attribute->name }}"></td>
                                            
                                            <td><input class="form-control" name="attributes[{{ $loop->iteration-1 }}][value]" placeholder="Eg. 10 Strips, 10 ml" type="text" value="{{ $attribute->value }}" ></td>
                                            <td width="10%"><button class="btn btn-danger attribute-close" type="button"><i class="fa fa-trash"></i></td>
                                          </tr>
                                        @empty
                                          <tr class="attribute-area">
                                            <td scope="row"><input class="form-control" name="attributes[0][name]" placeholder="Eg. Strip Size, Pack Size" type="text" value=""></td>
                                            
                                            <td><input class="form-control" name="attributes[0][value]" placeholder="Eg. 10 Strips, 10 ml" type="text" value="" ></td>
                                            <td width="10%"><button class="btn btn-danger attribute-close" type="button"><i class="fa fa-trash"></i></td>
                                          </tr>
                                        @endforelse
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
                                <label class="control-label col-sm-4" for="product_highlights">Product Highlights*</label>
                                <div class="col-sm-6"> 
                                  <textarea class="form-control" name="highlights" id="product_highlights" rows="5" style="resize: vertical;" placeholder="Enter Profile Highlights">{{$prod->highlights}}</textarea>
                                </div>
                              </div>
                            
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="product_description">Product Description*</label>
                                <div class="col-sm-6"> 
                                  <textarea class="form-control" name="description" id="product_description" rows="5" style="resize: vertical;" placeholder="Enter Profile Description">{{$prod->description}}</textarea>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="blood_group_display_name">Product Current Price* <span>(In {{$sign->name}})</span></label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="cprice" id="blood_group_display_name" placeholder="e.g 20" required=""  value="{{round($prod->cprice * $sign->value , 2)}}" type="text">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="blood_group_display_name">Product Previous Price <span>(Optional)</span></label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="pprice" id="blood_group_display_name" placeholder="e.g 25"  value="{{ $prod->pprice ? round($prod->pprice * $sign->value , 2) : '' }}"  type="text">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4"></label>
                                <div class="col-sm-6">
                                  <div class="checkbox2">
                                    <input type="checkbox" id="pricecheck" name="adv_price" value="1" {{ $prod->adv_price ? 'checked' : ''}}> 
                                    <label for="check2">Allow Advanced Pricing</label>
                                  </div>
                                </div>          
                              </div>

                              <div id="adv_price" style="display:{{ $prod->adv_price ? 'block' :'none' }}">
                                <div class="profile-filup-description-box margin-bottom-30 row">
                                  <div class="col-sm-6 col-sm-offset-4">
                                    <h2 class="text-center">Advanced Pricing</h2>

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
                                        @forelse ($prod->prices as $price)
                                          <tr class="pricing-area">
                                            <td scope="row" width="25%"><input class="form-control" name="pricings[{{ $loop->iteration-1 }}][min_qty]" placeholder="Min Qty" type="number" value="{{ $price->min_qty }}" min="2" step="1"></td>
                                            <td>
                                              <select class="form-control pricingOption" name="pricings[{{ $loop->iteration-1 }}][type]">
                                                <option disabled {{ $price->type == null ? 'selected' : '' }}>Choose a type</option>
                                                <option value="0" {{ $price->type === 0 ? 'selected' : '' }}>By Percentage</option>
                                                <option value="1" {{ $price->type === 1 ? 'selected' : '' }}>By Amount</option>
                                              </select>
                                            </td>
                                            <td width="35%"><input class="form-control pricingValue" name="pricings[{{ $loop->iteration-1 }}][value]" placeholder="Discount Amount/Percentage" type="number" value="{{ $price->value }}" min="0"></td>
                                            <td width="5%"><button class="btn btn-danger price-close" type="button"><i class="fa fa-trash"></i></td>
                                          </tr>
                                        @empty
                                          <tr class="pricing-area">
                                            <td scope="row" width="25%"><input class="form-control" name="pricings[0][min_qty]" placeholder="Min Qty" type="number" value="" min="2" step="1"></td>
                                            <td>
                                              <select class="form-control pricingOption" name="pricings[0][type]">
                                                <option disabled selected>Choose a type</option>
                                                <option value="0">By Percentage</option>
                                                <option value="1">By Amount</option>
                                              </select>
                                            </td>
                                            <td width="35%"><input class="form-control pricingValue" name="pricings[0][value]" placeholder="Discount Amount/Percentage" type="number" value="" min="0"></td>
                                            <td width="5%"><button class="btn btn-danger price-close" type="button"><i class="fa fa-trash"></i></td>
                                          </tr>
                                        @endforelse
                                        
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
                                <label class="control-label col-sm-4"></label>
                                <div class="col-sm-6">
                                  <div class="checkbox2">
                                    <input type="checkbox" id="pricecheckbonus" name="adv_bonus_price" value="1" {{ $prod->adv_bonus_price ? 'checked' : ''}}> 
                                    <label for="check2">Allow Bonus Pricing</label>
                                  </div>
                                </div>          
                              </div>

                              <div id="adv_bonus_price" style="display:{{ $prod->adv_bonus_price ? 'block' :'none' }}">
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
                                  
                                      @forelse ($prod->prices as $price)
                                        @if($price->is_bonus_price == 1)
                                        <tr class="pricing-area-bonus">
                                          <td> <input class="form-control" name="pricings_bonus[{{ $loop->iteration-1 }}][is_bonus_price]" placeholder="" type="hidden" value="1" required/> </td> 
                                          <td width=""><input class="form-control" name="pricings_bonus[{{ $loop->iteration-1 }}][min_qty]" placeholder="Min Qty" type="number" value="{{ $price->min_qty }}" min="2" step="1" required></td>
                                          <td>
                                            <input class="form-control" type="text" value="{{ $price->product_free_quantity }}" name="pricings_bonus[{{ $loop->iteration-1 }}][product_free_quantity]" placeholder="eg.5 " required/>
                                          </td>
                                          <td>
                                            <input class="form-control" type="text" value="{{ $price->product_category }}" name="pricings_bonus[{{ $loop->iteration-1 }}][product_category]" placeholder="eg. Strip/Box/Cartoon" required />
                                          </td>
                                          <td width=""><input class="form-control pricingValue" name="pricings_bonus[{{ $loop->iteration-1 }}][product_bonus_price]" placeholder="Whole sell Price" type="number" step="0.01" value="{{ $price->product_bonus_price }}" min="0" required></td>
                                          <td width=""><button class="btn btn-danger price-close-bonus" type="button"><i class="fa fa-trash"></i></td>
                                        </tr>
                                        @endif
                                      @empty
                                    
                                        <tr class="pricing-area-bonus">
                                          <td> <input class="form-control" name="pricings_bonus[0][is_bonus_price]" placeholder="" type="hidden" value="1" required/> </td> 
                                          <td  width=""><input class="form-control" name="pricings_bonus[0][min_qty]" placeholder="Min Qty" type="number" value="" min="2" step="1" required></td>
                                          <td>
                                            <input class="form-control" type="text" value="" name="pricings_bonus[0][product_free_quantity]" placeholder="eg. 5 " required/>
                                          </td>
                                          <td>
                                            <input class="form-control" type="text" value="" name="pricings_bonus[0][product_category]" placeholder="eg. Strip/Box/Cartoon " required/>
                                          </td>
                                          <td width=""><input class="form-control pricingValue" name="pricings_bonus[0][product_bonus_price]" placeholder="Whole sell Price" type="number" step="0.01" value="" min="0" required></td>
                                          <td width=""><button class="btn btn-danger price-close-bonus" type="button"><i class="fa fa-trash"></i></td>
                                        </tr>
                                
                                      @endforelse
                                      
                                    </tbody>
                                  </table>

                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for=""></label>
                                    <div class="col-sm-12 text-center">
                                      <button class="btn btn-default featured-btn" type="button" name="add-bonus-pricing-btn" id="add-bonus-pricing-btn"><i class="fa fa-plus"></i> Add More Field</button>
                                    </div>
                                  </div>

                              
                              </div>
                              <br>
                            </div>
                              </div>
                              

                              <div class="form-group" >
                                  <label class="control-label col-sm-4"></label>
                                  <div class="col-sm-6">
                                    <div class="checkbox2">
                                    <input type="checkbox" id="discountCheck" name="discountCheck" {{ $prod->sale_from ? 'checked' : '' }} value="1"> 
                                    <label for="check11">Allow Discount Timer</label>
                                    </div>
                                  </div>          
                              </div> 
                              <div id="discountSection"  style="display:{{ $prod->sale_from ? 'block' :'none' }}">
                                
                                <div class="form-group">
                                  <label class="control-label col-sm-4">Discount Percentage*</label>
                                  <div class="col-sm-6">
                                      <input class="form-control discountCheck" name="sale_percentage" placeholder="Discount Percentage" type="number" value="{{ $prod->sale_percentage }}" min="1" max="100" step="any">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4">Sale Stock* <span style="color:red;">(At least 1,000  must always less than product stock)</span></label>
                                  <div class="col-sm-6">
                                      <input class="form-control discountCheck" name="sale_stock" placeholder="Sale Stock" type="number" value="{{ $prod->sale_stock }}" min="0">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4">Starts From*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control discountCheck startdatepicker" name="sale_from" value="{{ $prod->sale_from }}" placeholder="Sale Starts From">
                                      
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-sm-4">Ends To*</label>
                                  <div class="col-sm-6">
                                    <input class="form-control discountCheck enddatepicker" name="sale_to" value="{{ $prod->sale_to }}" placeholder="Sale Ends At">
                                      
                                  </div>
                                </div>
                              </div>
                              <br>
                              
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="blood_group_display_name">Product Stock* <span style="color:red;">(At least 1,00,000)</span></label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="stock" id="blood_group_display_name" placeholder="e.g 15"  value="{{$prod->getOriginal('stock')}}"  type="text">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4">Product Purchase Limit* <span style="color:red;">(At least 30)</span></label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="purchase_limit"  placeholder="e.g 5" value="{{$prod->purchase_limit}}" type="text">
                                </div>
                              </div>
                              {{-- <div class="form-group">
                                <label class="control-label col-sm-4">Product Requires Prescription*</label>
                                <div class="col-sm-6">
                                  
                                  <input type="checkbox" name="requires_prescription" value="1" style="margin-top: 10px" {{ $prod->requires_prescription ? 'checked' : '' }}>
                                </div>
                              </div> --}}

                              {{-- <div class="form-group">
                                <label class="control-label col-sm-4" for="email"></label>
                                <div class="col-sm-6">
                                  <div class="checkbox2">
                                  <input type="checkbox" id="check50" name="mescheck" value="1"  {{ $prod->measure != null ? 'checked':'' }}>

                                  <label for="check50">Allow Product Measurement</label>
                                  </div>
                                </div>          
                              </div>
                              <div id="fimg50" {!! $prod->measure == null ? "style='display: none;'":"" !!}>  
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="product_measure">Product Measurement*</label>
                                  <div class="col-sm-3">
                                    <select class="form-control" id="product_measure">
                                        <option value="" {{$prod->measure == null ? 'selected':''}}>None</option>
                                        <option value="Gram" {{$prod->measure == 'Gram' ? 'selected':''}}>Gram</option>
                                        <option value="Kilogram" {{$prod->measure == 'Kilogram' ? 'selected':''}}>Kilogram</option>
                                        <option value="Litre" {{$prod->measure == 'Litre' ? 'selected':''}}>Litre</option>
                                        <option value="Pound" {{$prod->measure == 'Pound' ? 'selected':''}}>Pound</option>
                                        @php

                                        @endphp

                                        <option value="Custom" {{ (($prod->measure != null) && (!empty($mescheck))) ? 'selected':'' }}>Custom</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-3" id="measure" {!! (($prod->measure != null) && (!empty($mescheck))) ? 'selected':'style="display: none;"' !!}>
                                    <input class="form-control" name="measure" id="measurement" placeholder="Enter Unit"  type="text" value="{{$prod->measure}}">
                                  </div>
                                </div>
                                <br>
                              </div> --}}
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="placeholder">Youtube Video URL* <span>(Optional)</span></label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="youtube" id="placeholder" placeholder="https://www.youtube.com/watch?v=u3MY3vIw4Aw"  type="text" value="{{$prod->youtube}}">
                                </div>
                              </div>

                              {{-- <div class="form-group">
                                <label class="control-label col-sm-4" for="policy">Product Buy/Return Policy*</label>
                                <div class="col-sm-6"> 
                                  <textarea class="form-control" name="policy" id="policy" rows="5" style="resize: vertical;" placeholder="Enter Profile Description">{{$prod->policy}}</textarea>
                                </div>
                              </div> --}}
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="email"></label>
                                <div class="col-sm-6">
                                  <div class="checkbox2">
                                  <input type="checkbox" id="check12" name="secheck" value="1"  {{ ($prod->meta_tag != null || $prod->meta_description != null) ? 'checked':'' }}>

                                  <label for="check12">Allow Product SEO</label>
                                  </div>
                                </div>          
                              </div> 
                              <div id="fimg4" {!! ($prod->meta_tag == null || $prod->meta_description == null) ? "style='display: none;'":"" !!}>  
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="metaTags">Product Meta Tags*<span>(Write meta tags Separated by Comma[,])</span></label>
                                      <div class="col-sm-6">
                                          <ul id="metaTags">
                                              @if(!empty($metatags))
                                                  @foreach($metatags as $tag)
                                                      <li>{{$tag}}</li>
                                                  @endforeach
                                              @endif
                                          </ul>
                                      </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4" for="meta_description">Meta Description*</label>
                                  <div class="col-sm-6"> 
                                    <textarea class="form-control" name="meta_description" id="meta_description" rows="5" style="resize: vertical;" placeholder="Enter Meta Description">{{$prod->meta_description}}</textarea>
                                  </div>
                                </div>
                                <br>
                              </div>
                              {{-- <div class="profile-filup-description-box margin-bottom-30">
                                <div class="col-sm-6 col-sm-offset-4">
                                <h2 class="text-center">Feature Tags</h2>
                                <div class="qualification" id="q">
                                  @if($prod->features!=null && $prod->colors!=null)
                                  @foreach(array_combine($title,$details) as $ttl => $dtl)
                                  <div class="qualification-area">
                                      <div class="form-group">
                                          <div class="col-xs-12 col-sm-6">
                                            <label> Keywords: </label>
                                            <input class="form-control" name="features[]" id="title" placeholder="Keywords" type="text" value="{{$ttl}}">
                                          </div>
                                          <div class="col-xs-12 col-sm-6">
                                            <label> Choose Your Color: </label>
                                                  <div  class="input-group colorpicker-component">
                                      <input type="text" name="colors[]"   value="{{$dtl}}"  class="form-control colorpick"  />
                                        <span class="input-group-addon"><i></i></span>
                                        <span class="ui-close">X</span>
                                        </div>
                                          </div>
                                    </div>
                                    
                                  </div>
                                  @endforeach
                                  @else
                                  <div class="qualification-area">
                                      <div class="form-group">
                                          <div class="col-xs-12 col-sm-6">
                                            <label> Keyword: </label>
                                            <input class="form-control" name="features[]" placeholder="Keyword" type="text" value="">
                                          </div>
                                          <div class="col-xs-12 col-sm-6">
                                            <label> Choose Your Color: </label>
                                                  <div  class="input-group colorpicker-component">
                                      <input type="text" name="colors[]" value="#000000"  class="form-control colorpick" />
                                        <span class="input-group-addon"><i></i></span>
                                        <span class="ui-close" id="parentclose">X</span>
                                        </div>
                                          </div>
                                    </div>
                                    
                                  </div>
                                  @endif

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
                              <div class="form-group">
                                  <label class="control-label col-sm-4" for="blood_group_display_name">Product Tags* <span>(Write your product tags Separated by Comma[,])</span></label>
                                  <div class="col-sm-6">
                                      <ul id="myTags">
                                          @if(!empty($tags))
                                              @foreach($tags as $tag)
                                                  <li>{{$tag}}</li>
                                              @endforeach
                                          @endif
                                      </ul>
                                  </div>
                              </div>

                              
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="placeholder">Product Quantity*</label>
                                <div class="col-sm-6">
                                  <input class="form-control" name="product_quantity" value="{{ $prod->product_quantity }}" id="placeholder" placeholder="Enter Product Quantity eg: per piece , per strip "  type="text" required="">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-4" for="placeholder">VAT status *<span>(13% on OTC product)</span></label>
                                <div class="col-sm-6">
                                  {{-- <label class="form-check-inline u-check g-mr-20 mx-0 mb-0">
                                    <input class="g-hidden-xs-up g-pos-abs g-top-0 g-right-0" name="vat_status" {{isset($prod->vat_status) =='1' ? 'checked' : ''}} >
                                  
                                    <div class="u-check-icon-radio-v7">
                                      <i class="fa" data-check-icon=""></i>
                                    </div>
                                  </label> --}}

                                  <input class="form-control" name="vat_status" value="{{ $prod->vat_status }}" id="placeholder" placeholder="0 or 1 "  type="text" required="">
                                  <input class="form-control" name="user_id" value="{{ $prod->user_id }}" id="placeholder" type="hidden">
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
  <div id="myModal" class="modal fade gallery" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Image Gallery</h4>
        </div>
        <div class="modal-body">
          <div class="gallery-btn-area text-center">
            <form  method="POST" enctype="multipart/form-data" id="form-gallery">
              {{ csrf_field() }}
              <input style="display: none;" type="file" accept="image/*" id="gallery" name="gallery[]" multiple/>
            <input type="hidden" name="product_id" value="" id="pid">
            </form>
              <a style="cursor: pointer;" class="btn btn-info gallery-btn mr-5" id="prod_gallery"><i class="fa fa-download"></i> Upload Images</a>
              <a style="cursor: pointer; background: #009432;" class="btn btn-info gallery-btn mr-5" data-dismiss="modal"><i class="fa fa-check" ></i> Done</a>
              <p style="font-size: 11px;">You can upload multiple images.</p>
          </div>

          <div class="gallery-wrap">
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

<script type="text/javascript">
    $('.colorpicker-component').colorpicker();
    $('.colorpick').colorpicker();
    $('.category-multiple').select2({
      placeholder: 'Select a category'
    });
</script>
<script type="text/javascript">
  $("#check2").change(function() {
      if(this.checked) {
          $("#fimg").show();
      }
      else
      {
          $("#fimg").hide();

      }
  });
  $("#pricecheck").change(function() {
        if(this.checked) {
            $("#adv_price").show();
            $('.pricing-area input').attr('required','required')
            $('.pricing-area select').attr('required','required')

        }
        else
        {
            $("#adv_price").hide();
            $('.pricing-area input').removeAttr('required')
            $('.pricing-area select').removeAttr('required')
        }
    });

    $("#pricecheckbonus").change(function() {
        if(this.checked) {
            $("#adv_bonus_price").show();
            $('.pricing-area-bonus input').attr('required','required')
            $('.pricing-area-bonus input').attr('required','required')

        }
        else
        {
            $("#adv_bonus_price").hide();
            $('.pricing-area-bonus input').removeAttr('required')
            $('.pricing-area-bonus input').removeAttr('required')
        }
       
    });

    $(document).on('change', 'select.pricingOption' ,function() {
      if($(this).val() == 0)
        $(this.parentNode.parentNode).find('.pricingValue').attr('max',100);
      else
        $(this.parentNode.parentNode).find('.pricingValue').removeAttr('max');
    });
</script>

<script type="text/javascript">


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
            new nicEditor().panelInstance('product_highlights');
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
                ' <label class="control-label col-sm-4" for="blood_group_display_name">'+
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
                ' <label class="control-label col-sm-4" for="blood_group_display_name">'+
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
        '<td><input class="form-control pricingValue" name="pricings_bonus['+index+'][product_bonus_price]" placeholder="Whole Sell Price" type="number" value="" step="0.01" min="0" required></td>'+
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
          '<td><input class="form-control" name="pricings_bonus[0][is_bonus_price]" type="number" value="1" hidden></td>'+
          '  <td scope="row" ><input class="form-control" name="pricings[0][min_qty]" placeholder="Min Quantity" type="number" value="" min="2" step="1" required></td>'+
          '  <td>'+
          '   <input class="form-control" type="text" value="" name="pricings_bonus[0][type]" placeholder="eg. 10 + 2 Strip/Box " required/>'+
          '  </td>'+
          '  <td ><input class="form-control pricingValue" name="pricings[0][value]" placeholder="Discount Amount/Percentage" type="number" value="" step="0.01" min="0" required></td>'+
          '  <td ><button class="btn btn-danger price-close-bonus" type="button"><i class="fa fa-trash"></i></td>'+
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
        $("#myTags").tagit({
          fieldName: "tags[]",
          allowSpaces: true 
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#metaTags").tagit({
          fieldName: "meta_tag[]",
          allowSpaces: true 
        });
    });
</script>
<script type="text/javascript">
    $(document).on("click", ".view-gallery" , function(){
        var pid = $(this).parent().find('input[type=hidden]').val();
        $('#pid').val(pid);
        $('.gallery-wrap .row').html('');
            $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/gallery')}}",
                    data:{id:pid},
                    success:function(data){
                      if(data[0] == 0)
                      {
      $('.gallery-wrap .row').html('<h3 class="text-center">No Images Found.</h3>');
     }
                     
                      else {
      
                          var arr = $.map(data[1], function(el) {
                          return el });
                          for(var k in arr)
                          {
        $('.gallery-wrap .row').append('<div class="col-sm-4">'+
                                  '<div class="gallery__img">'+
                                  '<img src="'+'{{asset('assets/images/gallery').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                  '<div class="gallery-close">'+
                                  '<input type="hidden" value="'+arr[k]['id']+'">'+
                                  '<i class="fa fa-close"></i>'+
                                  '</div>'+
                                  '</div>'+
                                  '</div>');
                          }                         
                       }
 
                    }
                  });
      });



  $(document).on('click', '#prod_gallery' ,function() {
    $('#gallery').click();
  });
  
  $("#gallery").change(function(){
    var pid = $("#pid").val();
    var total_file = document.getElementById("gallery").files.length;
    $("#form-gallery").submit();  
   });
    </script>
    <script type="text/javascript">
  $(document).on('submit', '#form-gallery' ,function() {
  $.ajax({
                    url:"{{URL::to('/json/addgallery')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
    if(data != 0)
    {
                          var arr = $.map(data, function(el) {
                          return el });
                          for(var k in arr)
                          {
        $('.gallery-wrap .row').append('<div class="col-sm-4">'+
                                  '<div class="gallery__img">'+
                                  '<img src="'+'{{asset('assets/images/gallery').'/'}}'+data[k]['photo']+'" alt="gallery image">'+
                                  '<div class="gallery-close">'+
                                  '<input type="hidden" value="'+data[k]['id']+'">'+
                                  '<i class="fa fa-close"></i>'+
                                  '</div>'+
                                  '</div>'+
                                  '</div>');
                          }          
    }
                     
                       }

  });
  return false;
 }); 

    </script>
<script type="text/javascript">
    $(document).on('click', '.gallery-close' ,function() {
    var pid = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
              $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/removegallery')}}",
                    data:{id:pid}
                  });
  });
</script>
@endsection