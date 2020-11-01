@extends('layouts.user')
@section('title','Vendor Settings')

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
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Settings </p>
                                                </div>
                                            </div>
                                            @include('includes.user-notification')
                                        </div>   
                                    </div>
                                    <form class="form-horizontal" action="{{route('user-service-location')}}" method="POST">
                                        @include('includes.form-success')      
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="street_address">Service Areas *</label>
                                            @php
                                                $areas = $user->service_areas ? : '[]';
                                                
                                            @endphp
                                            <div class="col-sm-6">
                                                <select class="form-control location-multiple" name="service_areas[]" multiple="multiple" required="">
                                                    @include('includes.cities')
                                                </select>
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
                                            <button name="addProduct_btn" type="submit" class="btn add-product_btn">Update Settings</button> 
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
  
    <script type="text/javascript">

        $('.location-multiple').select2({
            placeholder: 'Select location'
        });

        $('.location-multiple').val(JSON.parse('<?php echo $areas ?>')).trigger('change');
    </script>
    
@endsection