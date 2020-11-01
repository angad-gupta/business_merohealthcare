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
                                                    <h2>Update Payment Gateway <a href="{{ route('admin-payment-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Payment Settings <i class="fa fa-angle-right" style="margin: 0 2px;"></i>  Payment Gateways <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Update
                                                </div>
                                            </div>
                                              @include('includes.notification')
                                        </div>   
                                    </div>
                                        <hr>
                                        <form class="form-horizontal" action="{{route('admin-payment-update',$payment->id)}}" method="POST">
                                          @include('includes.form-error')
                                          @include('includes.form-success')
                                          {{csrf_field()}}
                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="blood_group_display_name">Payment Title* <span>(In Any Language)</span></label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="title" id="blood_group_display_name" placeholder="Enter Payment Title  Name" required="" type="text" value="{{$payment->title}}">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-sm-4" for="blood_group_slug">Payment Details <span>(In Any Language)</span></label>
                                            <div class="col-sm-6">
                                              <textarea class="form-control" name="text" id="edit_profile_description" rows="10" style="resize: vertical;" placeholder="Enter Payment Description">{{$payment->text}}</textarea>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                              <label class="control-label col-sm-4"></label>
                                              <div class="col-sm-6">
                                                <div class="checkbox2">
                                                <input type="checkbox" id="discountCheck" name="discountCheck" {{ $payment->discount_value ? 'checked' :'' }} value="1"> 
                                                <label for="check11">Add Discount</label>
                                                </div>
                                              </div>          
                                          </div> 
                                          <div id="discountSection"  style="display:{{ $payment->discount_value ? 'block' :'none' }}">
                                            <div class="form-group">
                                              <label class="control-label col-sm-4">Discount Type*</label>
                                              <div class="col-sm-6">
                                                <select class="form-control discountCheck" name="discount_type" {{ $payment->discount_type ? 'required' : '' }}>
                                                  <option disabled {{ !$payment->discount_type ? 'selected' : '' }} value="">Choose a type</option>
                                                  <option value="0" {{ $payment->discount_type === 0 ? 'selected' : '' }}>By Percentage</option>
                                                  <option value="1" {{ $payment->discount_type === 1 ? 'selected' : '' }}>By Amount</option>
                                                </select>
                                              </div>
                                            </div>
                                            
                                            <div class="form-group">
                                              <label class="control-label col-sm-4" {{ $payment->discount_value ? 'required' : '' }}>Discount Value*</label>
                                              <div class="col-sm-6">
                                                  <input class="form-control discountCheck" name="discount_value" placeholder="Discount Amount/Percentage" type="number" value="{{$payment->discount_value}}" min="1">
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <label class="control-label col-sm-4">Minimum Purchase Amount <span>(Optional)</span></label>
                                              <div class="col-sm-6">
                                                  <input class="form-control" name="min_purchase_amount" placeholder="Minimum Purchase Amount" type="number" value="{{$payment->min_purchase_amount}}" min="1">
                                                
                                              </div>
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
<script type="text/javascript" src="{{asset('assets/admin/js/nicEdit.js')}}"></script> 
<script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
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
</script>
@endsection