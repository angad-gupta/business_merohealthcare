@extends('layouts.admin')

@section('content')

@php
$now = Carbon\Carbon::now();
@endphp

<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<div class="right-side">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- Starting of Dashboard data-table area -->
                        <div class="section-padding add-product-1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="add-product-box">
                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Bulk Timer Update</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Index</p>
                                                </div>
                                            </div>
                                              @include('includes.notification')
                                        </div>   
                                    </div>
                                <div>

                                  {{-- <style>
                                          
                                  </style>
                                <p>How many check boxes do you want when clicked on a radio button?</p>
                                <input type="radio" name="tab" value="igotnone" onclick="show1();" />
                                None
                                <input type="radio" name="tab" value="igottwo" onclick="show2();" />
                                Twoasd
                                <div id="div1" class="container">
                                fasdfasdfdsafasdfsdfasfasf
                                </div> --}}

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
line-height: 1.25em;
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
font-size: 1.25em;
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

                            


                                          @include('includes.form-error')
                                          @include('includes.form-success')
                                         
                                          
                                          @php
                                              $companies = App\Product::distinct('company_name')->pluck('company_name');
  
                                            //   dd($companies);
                                          @endphp

                                          

                                          <form class="form-horizontal" action="{{route('admin-timer-store')}}" method="POST" enctype="multipart/form-data">
                                    
                                            {{csrf_field()}}
  

                                            <div class="form-group" >
                                              <label class="control-label col-sm-4" for="b1">Select Timer Type</label>
                                              <div class="col-sm-6">

                                                <div id="inputContainer">
                                                  <fieldset id="aspectRatio--group" class="inputGroup">
                                                    {{-- <legend class="label">Select Timer Type</legend> --}}
                                                    <div class="segmentedControl">
                                                      <span class="segmentedControl--group">
                                                        <input type="radio" name="aspectRatio" id="aspectRatio--16x9" checked />
                                                        <label class="label" for="aspectRatio--16x9" onclick="show1();">Company Name</label>
                                                      </span>
                                                      <span class="segmentedControl--group">
                                                        <input type="radio" name="aspectRatio" id="aspectRatio--1x1" />
                                                        <label class="label" for="aspectRatio--1x1" onclick="show2();">Product Tags</label>
                                                      </span>
                                                  
                                                    </div>
                                                  </fieldset>
                                                </div>
                                              </div>
                                              </div>

                                           

                                            <div class="form-group" id="div1" >
                                              <label class="control-label col-sm-4" for="b1">Company Name *</label>
                                              <div class="col-sm-6">
                                                <select class="form-control category-multiple" name="company_name" value="" >
                                                  <option value="" active >&nbsp;&nbsp;&nbsp;&nbsp;Select company</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{$company}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{ $company }}</option>
                                                    @endforeach
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group" id="div2" style="display: none;">
                                            <label class="control-label col-sm-4" for="b1">Product Tag *</label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="product_tag" value="" placeholder="Product Tag eg. mamaearth for her" type="text">
                                            </div>
                                        </div>


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
  
                       
                                              <div class="add-product-footer">
                                                  <button name="addProduct_btn" type="submit" class="btn add-product_btn">Submit</button>
                                              </div>
                                          </form>
                                          <hr>
                                    <div class="row">
                                    <div class="col-sm-12">
                                    <div class="table-responsive">
                                      <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                                              <thead>
                                                  <tr role="row">
                                                    <th style="width: 285px;">Company Name</th>
                                                    
                                                    <th style="width: 285px;">Sale Percentage</th>
                                                    <th style="width: 285px;">Sale From</th>
                                                    <th style="width: 285px;">Sale To</th>
                                                    {{-- <th style="width: 200px;">Status</th> --}}
                                                  </tr>
                                              </thead>

                                              <tbody>
                                                  @php
                                                      $timers = App\Product::where('sale_percentage','!=',null)->distinct('company_name')->pluck('company_name');
                                                  @endphp
                                            @foreach($timers as $timer)                                                
                                              <tr role="row" class="odd">
                                                <td><a href="https://business.merohealthcare.com/search?product={{$timer}}" target="_blank">{{$timer}}</a></td>
                                                @php
                                                $company = App\Product::where('company_name','=',$timer)->first();
                                                // dd($company);
                                                @endphp
                                              
                                              <td>{{$company->sale_percentage}}</td>
                                              <td>{{date('d M Y h:i A',strtotime($company->sale_from))}}</td>
                                              <td>{{date('d M Y h:i A',strtotime($company->sale_to))}}</td>
                                              {{-- <td>
                                                @if($company->sale_from <= $now && $company->sale_to >= $now)
                                                  Active
                                                @else 
                                                  Inactive
                                                @endif
                                              </td> --}}
                                                      
                                                  </tr>
                                                  @endforeach
                                                  </tbody>
                                          </table></div></div>
                                        </div>
                                        </div>
                    </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard data-table area -->
                </div>
            </div>
        </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">You are about to delete this Advertisement.</p>
                    <p class="text-center">Do you want to proceed?</p>
                    {{-- <p>Everything will be deleted under this Name.</p> --}}
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
  function show1(){
  document.getElementById('div2').style.display ='none';
  document.getElementById('div1').style.display ='block';
}
function show2(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display = 'block';
}
  </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">


        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });

//   $( document ).ready(function() {
//         $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
//           '<a href="{{route('admin-adv-create')}}" class="add-newProduct-btn">'+
//           '<i class="fa fa-plus"></i> Add New Avertisement</a>'+
//           '</div>');                                                                       
// });

    $('.startdatepicker').datetimepicker({
      format: 'YYYY/MM/DD hh:mm A'
    });
    $('.enddatepicker').datetimepicker({
      format: 'YYYY/MM/DD hh:mm A'
    });
</script>

<script type="text/javascript">
    $('.category-multiple').select2({
      placeholder: 'Select a category'
    });
</script>

<script>
  let aspectRatioGroup = document.querySelector('#aspectRatio--group .segmentedControl');
let radios = aspectRatioGroup.querySelectorAll('input');
let i = 1;

// set CSS Var to number of radios we have
aspectRatioGroup.style.setProperty('--options',radios.length);

// loop through radio elements
radios.forEach((input)=>{
	// store position as data attribute
	input.setAttribute('data-pos',i);
	
	// add click handler to change position
	input.addEventListener('click',(e)=>{
		aspectRatioGroup.style.setProperty('--options-active',e.target.getAttribute('data-pos'));
	});
	
	// increment counter
	i++;
});

// add class to enable the sliding pill animation, otherwise it uses a fallback
aspectRatioGroup.classList.add('useSlidingAnimation');
</script>



<script>
  (function() {
  var CountDownTimer;

  CountDownTimer = function(dt, id) {
    var _day, _hour, _minute, _second, end, selector, showRemaining, timer;
    selector = document.getElementById(id);
    end = new Date(dt);
    _second = 1000;
    _minute = _second * 60;
    _hour = _minute * 60;
    _day = _hour * 24;
    showRemaining = function() {
      var days, distance, hours, minutes, now, seconds;
      now = new Date();
      distance = end - now;
      if (distance <= 0) {
        clearInterval(timer);
        selector.innerHTML = "Now";
        return;
      }
      days = Math.floor(distance / _day);
      hours = Math.floor((distance % _day) / _hour);
      minutes = Math.floor((distance % _hour) / _minute);
      seconds = Math.floor((distance % _minute) / _second);
      return selector.innerHTML = "<div class=\"days\"> <div class=\"numbers\">" + days + "</div>days</div> <div class=\"hours\"> <div class=\"numbers\">" + hours + "</div>hours</div> <div class=\"minutes\"> <div class=\"numbers\">" + minutes + "</div>minutes</div> <div class=\"seconds\"> <div class=\"numbers\">" + seconds + "</div>seconds</div> </div>";
    };
    return timer = setInterval(showRemaining, 1000);
  };

  CountDownTimer("12/20/2020 10:00 AM", "countdown");

}).call(this);
  </script>


@endsection