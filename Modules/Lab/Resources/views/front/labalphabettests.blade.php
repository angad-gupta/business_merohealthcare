
@extends('layouts.front')

@section('title','Lab Alphabet Tests')

@section('content')
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/progress-wizard.min.css">
{{-- <link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/slick-carousel/slick/slick.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/jquery-ui/themes/base/jquery-ui.min.css"> --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

  <style>

@media only screen and (max-width: 768px){
    #lab{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: transparent !important;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }

  #lab-mobile{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }
  .header-middle-right-wrap li a {
    border-color: transparent !important;
    color: #ffffff;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}
.header-middle-right-wrap li:first-child a {
    padding: 0 0px 0 0;
}

}

     #lab{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }
  
  .u-shadow-v21 {
    box-shadow: 0 5px 7px -1px rgba(0, 0, 0, 0.2);
    transition-property: all;
    transition-timing-function: ease;
    transition-delay: 0s;
  }
  </style>
  <style>
    #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }
    
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    #customers tr:hover {background-color: #ddd;}
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #2385aa;
      color: white;
    }

    
#breadcrumb {
  list-style: none;
  display: inline-block;
}
#breadcrumb .icon {
  font-size: 14px;
}
#breadcrumb li {
  float: left;
}
#breadcrumb li a {
  color: #FFF;
  display: block;
  background: #2385aa;
  text-decoration: none;
  position: relative;
  height: 40px;
  line-height: 40px;
  padding: 0 10px 0 5px;
  text-align: center;
  margin-right: 23px;
}
#breadcrumb li:nth-child(even) a {
  background-color: #2385aa;
}
#breadcrumb li:nth-child(even) a:before {
  border-color: #2385aa;
  border-left-color: transparent;
}
#breadcrumb li:nth-child(even) a:after {
  border-left-color: #2385aa;
}
#breadcrumb li:first-child a {
  padding-left: 15px;
  -moz-border-radius: 4px 0 0 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px 0 0 4px;
}
#breadcrumb li:first-child a:before {
  border: none;
}
#breadcrumb li:last-child a {
  padding-right: 15px;
  -moz-border-radius: 0 4px 4px 0;
  -webkit-border-radius: 0;
  border-radius: 0 4px 4px 0;
}
#breadcrumb li:last-child a:after {
  border: none;
}
#breadcrumb li a:before, #breadcrumb li a:after {
  content: "";
  position: absolute;
  top: 0;
  border: 0 solid #2385aa;
  border-width: 20px 10px;
  width: 0;
  height: 0;
}
#breadcrumb li a:before {
  left: -20px;
  border-left-color: transparent;
}
#breadcrumb li a:after {
  left: 100%;
  border-color: transparent;
  border-left-color: #2385aa;
}
#breadcrumb li a:hover {
  background-color: #1abc9c;
}
#breadcrumb li a:hover:before {
  border-color: #1abc9c;
  border-left-color: transparent;
}
#breadcrumb li a:hover:after {
  border-left-color: #1abc9c;
}
#breadcrumb li a:active {
  background-color: #16a085;
}
#breadcrumb li a:active:before {
  border-color: #16a085;
  border-left-color: transparent;
}
#breadcrumb li a:active:after {
  border-left-color: #16a085;
}

</style>

<style>
 
 .description {
  padding-left: 15px;
  border-left: 2px solid #000;
}
.description h3 {
  font-weight: 300;
  font-size: 20px;
  line-height: 20px;
  margin: 0px;
  color: #000;
  text-transform: uppercase;
}
.description p {
  margin-top: 10px;
  font-weight: 300;
}

.wrapper {
  margin: 50px;
}

ul.breadcrumbs {
  margin: 25px 0px 0px;
  padding: 0px;
  font-size: 0px;
  line-height: 0px;
  display: inline-block;
  *display: inline;
  zoom: 1;
  vertical-align: top;
  height: 40px;
}
ul.breadcrumbs li {
  position: relative;
  margin: 0px 0px;
  padding: 0px;
  list-style: none;
  list-style-image: none;
  display: inline-block;
  *display: inline;
  zoom: 0.8;
  vertical-align: top;
  border-left: 1px solid #ccc;
  transition: 0.3s ease;
}
ul.breadcrumbs li:hover:before {
  border-left: 10px solid #2385aa;
}
ul.breadcrumbs li:hover a {
  color: white;
  background: #2385aa;
}
ul.breadcrumbs li:before {
  content: "";
  position: absolute;
  right: -9px;
  top: -1px;
  z-index: 20;
  border-left: 10px solid #fff;
  border-top: 22px solid transparent;
  border-bottom: 22px solid transparent;
  transition: 0.3s ease;
}
ul.breadcrumbs li:after {
  content: "";
  position: absolute;
  right: -10px;
  top: -1px;
  z-index: 10;
  border-left: 10px solid #ccc;
  border-top: 22px solid transparent;
  border-bottom: 22px solid transparent;
}
ul.breadcrumbs li.active a {
  color: white;
  background: #2385aa;
}
ul.breadcrumbs li.first {
  border-left: none;
}
ul.breadcrumbs li.first a {
  font-size: 18px;
  padding-left: 20px;
  border-radius: 5px 0px 0px 5px;
}
ul.breadcrumbs li.last:before {
  display: none;
}
ul.breadcrumbs li.last:after {
  display: none;
}
ul.breadcrumbs li.last a {
  padding-right: 20px;
  border-radius: 0px 40px 40px 0px;
}
ul.breadcrumbs li a {
  display: block;
  font-size: 16px;
  line-height: 40px;
  color: #757575;
  padding: 0px 15px 0px 25px;
  text-decoration: none;
  background: #fff;
  border: 1px solid #ddd;
  white-space: nowrap;
  overflow: hidden;
  transition: 0.3s ease;
}

form.example input[type=text] {
  padding: 10px;
height:45px;
  float: left;
  width: 90%;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;

}

form.example button {
  float: left;
  width: 10%;
    padding:8px;
  background: #2385aa;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}
.select2-container--default .select2-search--inline .select2-search__field {
    background: transparent;
    border: none;
    outline: 0;
    box-shadow: none;
    -webkit-appearance: textfield;
    height: 30px;
    border-top-right-radius: 0px !important;
    border-bottom-right-radius: 0px;
}

@media (min-width: 768px){
.u-info-v9-1::before {
    position: absolute;
    top: 75px;
    left: 17%;
    width: 66%;
    border-top: 1px dotted #ddd;
    content: " ";
}
}
.progress-indicator>li.completed .bubble, .progress-indicator>li.completed .bubble:after, .progress-indicator>li.completed .bubble:before {
    background-color: #2385aa;
    border-color: #2385aa;
}
.progress-indicator>li.completed, .progress-indicator>li.completed .bubble {
    color: #2385aa;
}

h4{
  text-transform: uppercase;
  color:#2385aa !important;
  margin-top:0px;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12 g-mt-15 g-mr-5">
            <div class="view-cart-title pull-right">
                <a style="color:black;" href="{{route('lab.index')}}"><i class="icon-home"></i>{{ucfirst(strtolower($lang->home))}}</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <ul class="progress-indicator custom-complex">
    <li class="completed" style="font-size:14px;"> <span class="bubble"></span><i class="icon-note"></i> Book  <i class="fa fa-check-circle"></i> </li>
    <li style="font-size:14px;"> <span class="bubble" ></span><i class="icon-finance-100 u-line-icon-pro"></i> Checkout </li>
    <li style="font-size:14px;"> <span class="bubble"></span><i class="icon-credit-card"></i> Purchase </li>
  </ul>
</div>


  

  <div class="container g-pt-10 g-pb-20">
    <div class="row justify-content-between">
      <div class="col-lg-9 order-lg-2 g-mb-80">
  
        <div class="container g-mt-5">
        
        
        <form class="example" action="" method="GET">
          
          <div style="display:flex;">
          <select class="selectTests category-multiple" multiple="multiple" style="height:20px; width:90%;">
            @foreach($alphabet as $a)
                <option value="{{$a->id}}">{{$a->name}}</option>
            @endforeach

        </select>

       
          <button class="btn btn-primary btn-block text-center" type="button" id="addTests" class="btn" style="width:10%;border-top-left-radius:0px;border-bottom-left-radius:0px; "><i class="fa fa-search"></i> </button>
          </div>
        </form>

        <div class="container g-mt-5">
          {{-- <label class="d-block g-color-gray-dark-v2 g-font-size-20">Available Tests:</label> --}}
      
          <div id="compareList" style="min-height:0px">
          
          </div>
        </div>


         <ul class="breadcrumbs" style="margin-top: 10px;">
            <li class="first"><a href="/lab" class="icon-home"></a></li>
           
            <li class="last active"><a href="#"> Test For Alphabet : {{$alphabetslug}} </a></li>
        </ul>

        

         {{-- <ul id="breadcrumbs">
            <li><a href="/lab"><span class="icon icon-home"> </span></a></li>
            <li><a href="#"><span class="icon icon-beaker"> </span> Test For {{$cond[0]}}</a></li>
            <li><a href="#"><span class="icon icon-double-angle-right"></span> Available Test</a></li>
            
          </ul> --}}

          <ul class="nav u-nav-v2-1 u-nav-primary g-mb-20" role="tablist" data-target="nav-2-1-primary-hor-left" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block rounded-0 u-btn-outline-primary g-mb-20">
                
            @foreach($alphabet->slice(0, 3) as $a)
            <li class="nav-item" style="margin-top:5px;margin-bottom:5px;">
              <a class="nav-link {{$loop->index==0?'active':''}}" data-toggle="tab" href="#{{$a->id}}" role="tab" style="border-radius: 30px; padding: 2px 10px;margin: 0px 5px;"> {{$a->name}}</a>
            </li>
          @endforeach
          <div class="pull-right">
            <button class="btn btn-primary pull-right" style="border-radius:30px;margin-top:5px;padding:3px 10px; margin-right:5px;background-color: #ffffff;border-color: #2385aa;color: steelblue;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              .....
              </button>
            </div>
          <div class="pull-right">
          <button class="btn btn-primary pull-right" style="border-radius:30px;margin-top:5px;padding:3px 10px;background-color: #ffffff;border-color: #2385aa;color: steelblue;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="icon-size-fullscreen"></i>
            </button>
          </div>
        </ul>

         
   
          
     
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <ul class="nav u-nav-v2-1 u-nav-primary g-mb-20" role="tablist" data-target="nav-2-1-primary-hor-left" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block rounded-0 u-btn-outline-primary g-mb-20">
        
                  @foreach($alphabet as $a)
                    <li class="nav-item" style="margin-top:5px;margin-bottom:5px;">
                      <a class="nav-link {{$loop->index==0?'active':''}}" data-toggle="tab" href="#{{$a->id}}" role="tab" style="border-radius: 30px; padding: 2px 10px;margin: 0px 5px;"> {{$a->name}}</a>
                    </li>
                  @endforeach
              </ul>
            </div>
          </div>
            <!-- End Nav tabs -->
            
            <!-- Tab panes -->
        
            <div id="nav-2-1-primary-hor-left" class="tab-content">
                
                @foreach($alphabet as $a)
                  <div class="tab-pane fade {{$loop->index==0?'show active':''}}" id="{{$a->id}}" role="tabpanel">
                    
                     
        
                        <div class="row">
                          @php
                                $prods = $a->options()->whereHas('vendor',function($q){
                                    $q->where('users.is_vendor','=',2);
                                })->where('status',1)->get();
        
                                if(\Request::get('city')){
                                    $products = [];
                                    foreach($prods as $product){
                                        $vendor =  $product->vendor;
                                        $areas = $vendor->service_areas ? json_decode($vendor->service_areas) : [];
        
                                        if(in_array(\Request::get('city'),$areas)) $products []= $product;
                                    }
                                }else $products = $prods;
                            @endphp
                          @forelse($products as $product)
                          {{-- <div class="col-md-12 col-lg-12 ">
                            <h6>
                            <a class="u-tags-v1 g-color-blue g-brd-around g-brd-blue g-bg-blue-opacity-0_1 g-bg-blue--hover g-color-white--hover g-rounded-50 g-py-4 g-px-15" href="#">
                              <i class="fa fa-tag mr-1"></i>
                              Available Vendors
                            </a>
                            </h6>
                            </div> --}}
               
                          <div class="col-md-6 col-lg-6 g-mb-30">
                    
                           
                      
                            {{-- <article class="u-shadow-v19 media g-bg-white rounded g-pa-20">
                           
                    
                              <div class="media-body">
                    
                                <div class="g-mb-20">
                                  <h3 class="h5 g-mb-5">
                                    <a class="g-color-main g-color-primary--hover g-text-underline--none--hover" href="#">{{$product->vendor->name}}</a>
                                  </h3>
                                  <div class="js-rating g-font-size-11 g-color-primary g-mb-10" data-rating="3" data-spacing="1" data-backward-icons-classes="fa fa-star g-opacity-0_5"></div>
                                  <p><i class="icon-science-011 u-line-icon-pro"></i> {{ $c->name}}</p>
                                </div>
                         
                    
                       
                                <ul class="list-inline g-color-gray-dark-v5 g-font-size-13">
                                    <span class="g-font-weight-600 g-ml-5"><i class="icon-globe"></i></span>
                                  <li class="list-inline-item g-brd-gray-light-v3 g-line-height-1 g-pr-7 g-mr-5">
                                    <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-12 g-text-underline--none--hover rounded g-px-10 g-py-5" href="https://{{$product->vendor->link}}" target="_blank">{{$product->vendor->link}}</a>
                                  </li>
                           
                                </ul>
                           
                    
                                <hr class="g-brd-gray-light-v4 g-my-20">
                    
                       
                                <ul class="list-inline g-mb-0">
                                  <li class="list-inline-item">
                                    <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-12 g-text-underline--none--hover rounded g-px-10 g-py-5" href="#">
                                        <span class="g-font-weight-600 g-ml-5">Total Price:
                                       
                                      <span class="g-font-weight-600 g-ml-5">
                                        Rs {{$product->cprice}}</span>
                                      </span>
                                    </a>
                                  </li>
                                  <li class="list-inline-item pull-right">
                                    <input type="hidden" value="{{ $product->id }}" />
        
                                        <button class="btn btn-md u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10 addTest">
                                            <i class="g-mr-5 icon-note"></i>
                                            Book Now
                                        </button>
                                  
                                  </li>
                             
                                </ul>
                        
                              </div>
                           
                            </article> --}}
        
                            <article class="u-shadow-v19 media g-bg-white rounded g-pa-20" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000"><div class="media-body" >
                                <div class="g-mb-10">
                                  <h3 class="h5 g-mb-5">
                                    <a class="g-color-main g-color-primary--hover g-text-underline--none--hover" id="test-vendor-{{ $product->id }}" href="#"><img  style=" height: 2rem;" id="adminimg" src="{{ $product->vendor->photo ? asset('assets/images/'.$product->vendor->photo):asset('assets/images/user.png')}}" alt="profile image">{{$product->vendor->name}}</a>
                                    <a href="" class="pull-right" data-toggle="modal" style="border-radius: 30px;" data-target="#cat{{$product->id}}"> <i class="icon-info"></i></a>
                                  </h3>
                                  <div class="js-rating g-font-size-11 g-color-primary g-mb-10" data-rating="3" data-spacing="1" data-backward-icons-classes="fa fa-star g-opacity-0_5"></div>
                                  <p style="font-size:13px;" id="test-name-{{ $product->id }}">{{ $product->type->name}}</p>
                                </div>
                              
                                <ul class="list-inline text-center" style="margin-bottom: 0rem;font-size:14px;">
                                  <li class="list-inline-item ">
                                    <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-13 g-text-underline--none--hover rounded g-px-10 g-py-5" href="#">
                                        <span class="g-font-weight-600 g-ml-5">Total Price: 
                                           
                                        
                                      
                                      <span class="g-font-weight-600 g-ml-5 " style="color: #555 ;">
                                        Rs.{{$product->cprice}}
                                  </span>
                                      </span>
                                    </a>
                                  </li>
                                
                                  
                                </ul>
                              
          
                                  <div class=" g-font-size-12 g-brd-gray-light-v4 g-pa-15-20 text-center" >
                                    <input type="hidden" value="{{ $product->id }}" />
                                  <button class="btn btn-md u-btn-orange g-font-weight-600 g-font-size-11 text-uppercase" style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem;" data-toggle="modal" data-target="#testdetails{{$a->id}}">
                                      <i class="icon-book-open"></i> View Details
                                     
                                  </button>
                                    <button style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem; " class="btn btn-md u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase addTest" title="Book now">
                                        <i class="icon-note"></i>
                                        Book Now
                                    </button>
                                  
                                  
                                  </div>
                               
                              </div>
                         
                            </article>
                         
                    
                           
                          </div>
        
                          
                      <div class="modal fade" id="cat{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{$product->vendor->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <ul class="list-inline g-color-gray-dark-v5 g-font-size-13 text-center" >
                                <span class="g-font-weight-600 g-ml-5"><i class="icon-globe"></i>  </span>
                              <li class="list-inline-item g-brd-gray-light-v3 g-line-height-1 g-pr-7 g-mr-5">
                                <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-12 g-text-underline--none--hover rounded g-px-10 g-py-5" href="https://{{$product->vendor->link}}" target="_blank">{{$product->vendor->link}}</a>
                              
                              </li>
                           
                            </ul>
                              {!! $product->vendor->description !!}
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" style="border-radius:30px;" data-dismiss="modal">Close</button>
                    
                            </div>
                          </div>
                        </div>
                      </div>
        
                      <div class="modal fade" id="testdetails{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{$product->vendor->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              
                              {{-- {!! $vendor->description !!} --}}
                              <div style="overflow-x:auto;">
                              <table id="customers">
                                <tr>
                                  <th>Test Name</th>
                                  <th>Specimen</th>
                                  <th>Method</th>
                                  <th>Schedule</th>
                                  <th>Reporting</th>
                                </tr>
        
                                @foreach($products as $p)
                                  @php
                                  $pname = Modules\Lab\Entities\LabProduct::findOrFail($p->product_id);
                        
                                  @endphp
                                  <tr>
                                  <td>{{$pname->name}}</td>
                                    <td>{{$p->specimen}}</td>
                                    <td>{{$p->method}}</td>
                                    <td>{{$p->timing}}</td>
                                    <td>{{$p->report_delivery_time}}</td>
                                  </tr>
                                  <tr>
                          
                                @endforeach
                              </table>
                              </div>
                          
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" style="border-radius:30px;" data-dismiss="modal">Close</button>
                    
                            </div>
                          </div>
                        </div>
                      </div>
                    
                          @empty
                          <div class="container text-center">
                          <h4 style="margin: 20px;  text-align:center">No Vendor found for this test !</h4>
                          </div>
                    
                          
                          @endforelse  
                          
                        </div>
                       
                   
                  </div>
                @endforeach
            </div>

          
        
          </div>
     
  
        <div class="g-pl-0--lg">
          <div class="container g-mt-5">
        
        </div>
        </div>
  
        
      </div>
  
      <div class="col-lg-3 order-lg-1 g-brd-right--lg g-brd-gray-light-v4 g-mb-80">
        <div class="container" style="">
          <!-- Links -->
          <div class="g-mb-5">
            <h4 class="h6 g-font-weight-700 g-mb-10 g-mt-0" >Test By Alphabets:</h4>
            <select id="mounth" class="form-control" onChange="window.location.href=this.value">
                <option value="hide">Search by Alphabets</option>
                <option value="/lab/alphabet/a" rel="icon-temperature" >A</option>
                <option value="/lab/alphabet/b" rel="icon-temperature" >B</option>
                <option value="/lab/alphabet/c" rel="icon-temperature" >C</option>
                <option value="/lab/alphabet/d" rel="icon-temperature" >D</option>
                <option value="/lab/alphabet/e" rel="icon-temperature" >E</option>
                <option value="/lab/alphabet/f" rel="icon-temperature" >F</option>
                <option value="/lab/alphabet/g" rel="icon-temperature" >G</option>
                <option value="/lab/alphabet/h" rel="icon-temperature" >H</option>
                <option value="/lab/alphabet/i" rel="icon-temperature" >I</option>
                <option value="/lab/alphabet/j" rel="icon-temperature" >J</option>
                <option value="/lab/alphabet/k" rel="icon-temperature" >K</option>
                <option value="/lab/alphabet/l" rel="icon-temperature" >L</option>
                <option value="/lab/alphabet/m" rel="icon-temperature" >M</option>
                <option value="/lab/alphabet/n" rel="icon-temperature" >N</option>
                <option value="/lab/alphabet/o" rel="icon-temperature" >O</option>
                <option value="/lab/alphabet/p" rel="icon-temperature" >P</option>
                <option value="/lab/alphabet/q" rel="icon-temperature" >Q</option>
                <option value="/lab/alphabet/r" rel="icon-temperature" >R</option>
                <option value="/lab/alphabet/s" rel="icon-temperature" >S</option>
                <option value="/lab/alphabet/t" rel="icon-temperature" >T</option>
                <option value="/lab/alphabet/u" rel="icon-temperature" >U</option>
                <option value="/lab/alphabet/v" rel="icon-temperature" >V</option>
                <option value="/lab/alphabet/w" rel="icon-temperature" >W</option>
                <option value="/lab/alphabet/x" rel="icon-temperature" >X</option>
                <option value="/lab/alphabet/y" rel="icon-temperature" >Y</option>
                <option value="/lab/alphabet/z" rel="icon-temperature" >Z</option>
                
            
            </select> 

            <h4 class="h6 g-font-weight-700 g-mb-10">Filter By:</h4>
            <div class="btn-group justified-content">
                <label class="u-check g-pl-0">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" checked="">
                <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked rounded-0">Test</span>
                </label>
                <label class="u-check g-pl-0">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                <span class="btn btn-md btn-block u-btn-outline-lightgray g-color-white--checked g-bg-primary--checked g-brd-left-none--md rounded-0">Package</span>
                </label>
                
            </div>
          
          </div> 
          <!-- End Links -->
  
      
  
          {{-- <div id="stickyblock-start">
            <div class="js-sticky-block g-sticky-block--lg g-pt-50" data-type="responsive" data-start-point="#stickyblock-start" data-end-point="#stickyblock-end" style="top: 0px; width: 234.012px; height: 200.6px;">
        
  
          
  
          
              <div class="g-mb-40">
                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Tags</h3>
                <ul class="u-list-inline mb-0">
                  <li class="list-inline-item g-mb-10">
                    <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15" href="#">Design</a>
                  </li>
                  <li class="list-inline-item g-mb-10">
                    <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15" href="#">Art</a>
                  </li>
                  <li class="list-inline-item g-mb-10">
                    <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15" href="#">Graphic</a>
                  </li>
                  <li class="list-inline-item g-mb-10">
                    <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15" href="#">Front End Development</a>
                  </li>
                  <li class="list-inline-item g-mb-10">
                    <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15" href="#">CSS</a>
                  </li>
                  <li class="list-inline-item g-mb-10">
                    <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15" href="#">HTML</a>
                  </li>
                  <li class="list-inline-item g-mb-10">
                    <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15" href="#">Sass</a>
                  </li>
                </ul>
              </div>
      
  
       
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>

 
 
@endsection

@section('scripts')

<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $('.category-multiple').select2({
    placeholder: 'Select For Tests'
  });
</script>

<script >

      // initialization of carousel
      $.HSCore.components.HSCarousel.init('.js-carousel');
    });
  </script>

<script >
  $(document).ready(function () {
      var selected = [];
      // initialization of carousel
      $.HSCore.components.HSCarousel.init('.js-carousel');

      $('.selectTests').select2({
          width: '100%',
          placeholder: 'Select Tests'
      });


      $(document).on("click", "#addTests" , function(){
          selected = $('.selectTests').select2('val');
          if(selected.length == 0){
              $.notify("Select a test first","error");
              return;
          }

          var city = $('#comparecity').val();

          $('#addTests').attr('disabled','disabled');

          $.ajax({
              type: "POST",
              url:"{{URL::to('/lab/json/comparesearch')}}",
              data:{test_ids: selected, city: city, _token: '{{ csrf_token() }}'},
              success:function(data){
                  $('#addTests').removeAttr('disabled');
                  console.log('asdfsadfasdf');
                  console.log(data);
                  $('#compareList').html(data);

              },
              error: function(data){
                  $('#addTests').removeAttr('disabled');

                  if(data.status == 422 && data.responseJSON.error)
                      $.notify(data.responseJSON.error,"error");
                  else
                      $.notify("Something went wrong.","error");
              }
          });
          return false;
      });

      $(document).on("click", ".addTestsCart" , function(){
          var btn = $(this);

          if(selected.length == 0){
              $.notify("Select a test first","error");
              return;
          }

          var vendor_id =  $(this).parent().find('input[type=hidden]').val();

          btn.attr('disabled','disabled');

          $.ajax({
              type: "POST",
              url:"{{URL::to('/lab/json/addpackage')}}",
              data:{ vendor_id: vendor_id, test_ids: selected, _token: '{{ csrf_token() }}'},
              success:function(data){
                  location.href = "{{ route('lab.cart') }}";

              },
              error: function(data){
                  btn.removeAttr('disabled');

                  if(data.status == 422 && data.responseJSON.error)
                      $.notify(data.responseJSON.error,"error");
                  else
                      $.notify("Something went wrong.","error");
              }
          });
          return false;
      });
  });

  $("#addTests").click(function() {
    $('html, body').animate({
        scrollTop: $("#compareList").offset().top
    }, 1500);
});

</script>
<script>


  $(document).on("click", ".addTest" , function(){
      var pid = $(this).parent().find('input[type=hidden]').val();
      var button = $(this);
      button.attr('disabled','disabled');

      $.ajax({
          type: "POST",
          url:"{{URL::to('/lab/json/addcart')}}",
          data:{ test_id: pid, reset_cart: true, _token: '{{ csrf_token() }}' },
          success:function(data){
            if(data == 0)
            {
                $.notify("{{$gs->cart_error}}","error");
            }
            else
            {
              location.href = "{{ route('lab.cart') }}";
            }
          },
          error: function(data){
            button.removeAttr('disabled');

            $.notify("Something went wrong.","error");
          }
      }); 
      return false;
  });

</script>
<script>
    var x, i, j, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      /*for each element, create a new DIV that will act as the selected item:*/
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /*for each element, create a new DIV that will contain the option list:*/
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide");
      for (j = 1; j < selElmnt.length; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var y, i, k, s, h;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            h = this.parentNode.previousSibling;
            for (i = 0; i < s.length; i++) {
              if (s.options[i].innerHTML == this.innerHTML) {
                s.selectedIndex = i;
                h.innerHTML = this.innerHTML;
                y = this.parentNode.getElementsByClassName("same-as-selected");
                for (k = 0; k < y.length; k++) {
                  y[k].removeAttribute("class");
                }
                this.setAttribute("class", "same-as-selected");
                break;
              }
            }
            h.click();
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
          /*when the select box is clicked, close any other select boxes,
          and open/close the current select box:*/
          e.stopPropagation();
          closeAllSelect(this);
          this.nextSibling.classList.toggle("select-hide");
          this.classList.toggle("select-arrow-active");
        });
    }
    function closeAllSelect(elmnt) {
      /*a function that will close all select boxes in the document,
      except the current select box:*/
      var x, y, i, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      for (i = 0; i < y.length; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < x.length; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }
    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
    </script>
{{-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">
  $('.category-multiple').select2({
    placeholder: 'Select a Prescription file'
  });
</script> --}}

<script>
/*
Reference: http://jsfiddle.net/BB3JK/47/
*/




@endsection