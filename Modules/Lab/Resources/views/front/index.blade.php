@extends('layouts.front')

@section('title','Lab')

@section('content')
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

<style>



  .tab .nav-tabs > li{
      margin-right: 2px;
  }
  .tab .nav-tabs > li > a{
      border: none;
      padding: 18px 25px;
      color:#fff;
      background:#666;
      border-radius:0;
  }
  .tab .nav-tabs > li > a > i{
      font-size:14px;
      margin-right:10px;
  }
  .tab .nav-tabs > li.active > a,
  .tab .nav-tabs > li.active > a:focus,
  .tab .nav-tabs > li.active > a:hover{
      border: none;
      background: #2385aa;
      color:#fff;
      transition:background 0.20s linear;
  }
  .tab .nav-tabs li.active:after {
      content: "";
      position: absolute;
      bottom: -30px;
      left: 37%;
      border: 15px solid transparent;
      border-top-color: #2385aa ;
  }
  .tab .tab-content{
      background: #f1f1f1;
      line-height: 25px;
      border: 1px solid #ddd;
      border-top:0px solid #2385aa;
      border-bottom:1px solid #f1f1f1;
      padding:30px 25px;
  }

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


  @media only screen and (max-width: 480px){
      .tab > .nav-tabs li{
          width:100%;
      }
      .tab .nav-tabs > li > a{
          padding: 20px;
      }
      .tab .nav-tabs > li.active:after {
          border:none;
      }
  }
  
  @media(min-width:320px) and (max-width:768px){
    #labsearch{
      display: block !important;
      
    }
    .labsearchdesktop{
      display:none;
    }
  
    #cities{
      width:100% !important;
      margin-top: 15px !important;
    }
  }
  
  #labsearch{
    display: none ;
  }
  
  #cities{
    width: 90%;
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
  
    .select2-container--default.select2-container--focus .select2-selection--multiple {
      border: 0px;
      outline: 0;
  }
  
  .select2-container--default .select2-selection--multiple {
      background-color: white;
      border: 0px solid #aaa;
      border-radius: 0px;
      cursor: text;
  }
  
  .select2-container--default .select2-search--inline .select2-search__field {
      background: transparent;
      border: none;
      outline: 0;
      box-shadow: none;
      -webkit-appearance: textfield;
      height: 2.3rem;
  
     
  }
  @media (min-width:320px) and (max-width:768px){
  #comparecity{
        margin-top:20px;
      }
  }
  
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #e4e4e4;
      border: 0px solid #aaa;
      border-radius: 4px;
      cursor: default;
      float: left;
      margin-right: 5px;
      margin-top: 5px;
      padding: 0 5px;
  }
  </style>

  <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll dzsprx-readyall loaded" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
    <div class="divimage dzsparallaxer--target w-100 u-bg-overlay " style="height: 130%; background-image: url('/medimage/lb4.jpg'); transform: translate3d(0px, -47.0242px, 0px);"></div>

    <!-- Promo Block Content -->
    <div class="container text-center g-py-70">

      <h1 class="text-center g-color-white g-font-weight-600 ">Coming Soon !!!</h1>
      <h2 class="h1 g-color-white g-font-weight-600 text-uppercase g-mb-30">MEROHEALTHCARE LAB</h2>
  

      <!-- Search Form -->
      <form action="/lab/tests/search" method="GET">

        <!-- Search Field -->
        <div class="mx-auto g-mb-20">
          {{-- {{Modules\Lab\Entities\LabProduct::where('status',1)->get() }} --}}
          {{-- <div class="input-group">
            <input list="alltest" name="searchkey" type="text" class="form-control g-font-size-16 border-0" style="height:52px;margin:0 10px" placeholder="Search test here. eg (Lipid Profile)"  aria-label="Search your test">
            <datalist id="alltest">

                @foreach(Modules\Lab\Entities\LabProduct::where('status',1)->get() as $product)
                    <option value="{{$product->name}}">
                @endforeach
            </datalist>
            <input list="allcities" name="city" type="text" class="form-control g-font-size-16 border-0" style="height:52px;margin:0 10px"  placeholder="Search location" aria-label="Search by location" autocomplete="off">
            <datalist id="allcities">

                @include('includes.cities')
            </datalist>
            <span class="input-group-btn">
              <button class="btn btn-primary g-font-size-18 g-py-12 g-px-25" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div> --}}

          <div class="mx-auto g-mb-20">

              <div class="row">
                <div class="col-md-6 col-sm-12">

                <select class="form-control selectTests" multiple="multiple" style="height:15px;">
                    @foreach($tests as $test)
                        <option value="{{$test->id}}">{{$test->name}}</option>
                    @endforeach

                </select>
{{-- 
                <select class="form-control " multiple="multiple" style="height:15px;">
                 
                      <option value="dfsdf">sfdsfdf</option>
           

              </select> --}}
                </div>

              <div class="col-md-6 col-sm-12" style="display:inline-flex;">
                <input id="cities" list="allcities" id="comparecity" type="text" class="form-control g-font-size-16" style="height:3rem; border-radius:0px;" placeholder="Search location" aria-label="Search by location" autocomplete="off" required="">
                <button class="btn btn-primary text-center labsearchdesktop" type="button" id="addTests" class="btn" style="padding: 10px 10px; width:10%;height: 42px;
                border-radius: 0px;"><i class="fa fa-search"></i> </button>
                <datalist id="allcities">

                  @include('includes.cities')
              </datalist>
              </div>
              </div>



              <div id="labsearch" class="text-center" style="margin-top: 15px;">
              <button class="btn btn-primary btn-block text-center" type="button" id="addTests" class="btn" style="padding: 10px 100px; "><i class="fa fa-search"></i> Search</button>
              </div>

              {{-- <div class="container text-center" style="margin-top:50px;">
                <a class="btn btn-primary " style="border-radius:30px; cursor: pointer; backgound-color:2385aa; color:white;    position: absolute;
                top: 20px;
                right: 20px;" data-toggle="modal" data-target="#vendorloginModal"> <i class="fa fa-user" aria-hidden="true"></i> Vendor Login</a>
            </div> --}}




        </div>


              {{-- <a href="/lab/compare" class="btn btn-primary">Compare Prices</a> --}}


        <!-- End Search Field -->

        <!-- Checkboxes -->
        {{-- <div class="g-font-size-15">
          <!-- Label -->
          <label class="form-check-inline u-check g-color-white g-pl-25">
            <input class="g-hidden-xs-up" type="checkbox" checked="">
            <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
              <i class="g-brd-white g-brd-primary--checked g-bg-white g-bg-primary--checked g-transition-0_2 g-transition--ease-in g-rounded-2 fa" data-check-icon=""></i>
            </div>
            Recent
          </label>
          <!-- End Label -->

          <!-- Label -->
          <label class="form-check-inline u-check g-color-white g-pl-25 g-ml-20--md">
            <input class="g-hidden-xs-up" type="checkbox">
            <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
              <i class="g-brd-white g-brd-primary--checked g-bg-white g-bg-primary--checked g-transition-0_2 g-transition--ease-in g-rounded-2 fa" data-check-icon=""></i>
            </div>
            Related
          </label>
          <!-- End Label -->

          <!-- Label -->
          <label class="form-check-inline u-check g-color-white g-pl-25 g-ml-20--md">
            <input class="g-hidden-xs-up" type="checkbox">
            <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
              <i class="g-brd-white g-brd-primary--checked g-bg-white g-bg-primary--checked g-transition-0_2 g-transition--ease-in g-rounded-2 fa" data-check-icon=""></i>
            </div>
            Popular
          </label>
          <!-- End Label -->

          <!-- Label -->
          <label class="form-check-inline u-check g-color-white g-pl-25 g-ml-20--md">
            <input class="g-hidden-xs-up" type="checkbox">
            <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
              <i class="g-brd-white g-brd-primary--checked g-bg-white g-bg-primary--checked g-transition-0_2 g-transition--ease-in g-rounded-2 fa" data-check-icon=""></i>
            </div>
            Most common
          </label>
          <!-- End Label -->
        </div> --}}
        <!-- End Checkboxes -->
      </form>
      <!-- End Search Form -->
    </div>
    <!-- End Promo Block Content -->
  </section>



  <div class="container g-mt-5">
    {{-- <label class="d-block g-color-gray-dark-v2 g-font-size-20">Available Tests:</label> --}}

    <div id="compareList" style="min-height:0px">
    
    </div>
</div>

  <div class="container g-mt-30">
    <div class="row">
        <div class="col-md-12">

          <ul class="nav justify-content-center u-nav-v5-1 u-nav-primary" role="tablist" data-target="nav-5-1-primary-hor-center" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block u-btn-outline-primary">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#nav-5-1-primary-hor-center--1" role="tab"><i class="icon-education-036 u-line-icon-pro"></i> Test By Alphabet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#nav-5-1-primary-hor-center--2" role="tab"><i class="icon-medical-010 u-line-icon-pro"></i> Test By Condition</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#nav-5-1-primary-hor-center--3" role="tab"><i class="icon-science-033 u-line-icon-pro"></i> Test By Speciality</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#nav-5-1-primary-hor-center--4" role="tab"><i class="icon-science-040 u-line-icon-pro"></i> Test By Category</a>
            </li>
          </ul>
          <!-- End Nav tabs -->
          
          <!-- Tab panes -->
          <div id="nav-5-1-primary-hor-center" class="tab-content g-pt-20">
            <div class="tab-pane fade show active" id="nav-5-1-primary-hor-center--1" role="tabpanel">
              <h4>A-Z Alphabet</h4>
                        <a href="/lab/alphabet/a" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">A</a>
                        <a href="/lab/alphabet/b" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">B</a>
                        <a href="/lab/alphabet/c" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">C</a>
                        <a href="/lab/alphabet/d" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">D</a>
                        <a href="/lab/alphabet/e" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">E</a>
                        <a href="/lab/alphabet/f" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">F</a>
                        <a href="/lab/alphabet/g" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">G</a>
                        <a href="/lab/alphabet/h" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">H</a>
                        <a href="/lab/alphabet/i" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">I</a>
                        <a href="/lab/alphabet/j" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">J</a>
                        <a href="/lab/alphabet/k" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">K</a>
                        <a href="/lab/alphabet/l" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">L</a>
                        <a href="/lab/alphabet/m" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">M</a>
                        <a href="/lab/alphabet/n" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">N</a>
                        <a href="/lab/alphabet/o" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">O</a>
                        <a href="/lab/alphabet/p" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">P</a>
                        <a href="/lab/alphabet/q" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">Q</a>
                        <a href="/lab/alphabet/r" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">R</a>
                        <a href="/lab/alphabet/s" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">S</a>
                        <a href="/lab/alphabet/t" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">T</a>
                        <a href="/lab/alphabet/u" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">U</a>
                        <a href="/lab/alphabet/v" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">V</a>
                        <a href="/lab/alphabet/w" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">W</a>
                        <a href="/lab/alphabet/x" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">X</a>
                        <a href="/lab/alphabet/y" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">Y</a>
                        <a href="/lab/alphabet/z" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">Z</a>
            </div>

            <div class="tab-pane fade" id="nav-5-1-primary-hor-center--2" role="tabpanel">
              <h6>Test By Condition</h6>
              @foreach($labconditions as $c)
              <a href="/lab/condition/{{$c->condition_slug}}" class="btn btn-md u-btn-primary g-mr-10 g-mb-15 u-shadow-v22 " style="border-radius: 0px;" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">{{$c->condition_name}} </a>
              @endforeach
            </div>

            <div class="tab-pane fade" id="nav-5-1-primary-hor-center--3" role="tabpanel">
              <h6>Test By Speciality</h6>
              @foreach($labspecialities as $s)
              <a href="/lab/speciality/{{$s->speciality_slug}}" class="btn btn-md u-btn-primary g-mr-10 g-mb-15 u-shadow-v22" style="border-radius: 0px;" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000">{{$s->speciality_name}} </a>
              @endforeach
            </div>

            <div class="tab-pane fade" id="nav-5-1-primary-hor-center--4" role="tabpanel">
              <h6>Test By Category</h6>
              @foreach($labcategories as $c)
                <a href="/lab/category/{{$c->cat_slug}}" class="btn btn-md u-btn-primary g-mr-10 g-mb-15 u-shadow-v22" style="border-radius: 0px;" data-animation="bounceIn" data-animation-delay="0" data-animation-duration="1000"><img  style="height:2rem;border-radius:30px;" src="/assets/images/{{$c->photo}}" alt="Image Description"> {{$c->cat_name}} ({{$c->products->count()}})</a>
              @endforeach
            </div>
          </div>

          


            {{-- <div class="tab" role="tabpanel">
      
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab"><i class="icon-education-036 u-line-icon-pro"></i>Test By Alphabet</a></li>
                    <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab"><i class="icon-medical-010 u-line-icon-pro"></i>Test By Condition</a></li>
                    <li role="presentation"><a href="#Section3" aria-controls="settings" role="tab" data-toggle="tab"><i class="icon-science-033 u-line-icon-pro"></i>Test By Speciality</a></li>
                    <li role="presentation"><a href="#Section4" aria-controls="settings" role="tab" data-toggle="tab"><i class="icon-science-040 u-line-icon-pro"></i>Test By Category</a></li>
                </ul>
           
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <h4>A-Z Alphabet</h4>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">A</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">B</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">C</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">D</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">E</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">F</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">G</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">H</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">I</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">J</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">K</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">L</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">M</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">N</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">O</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">P</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">Q</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">R</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">S</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">T</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">U</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">V</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">W</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">X</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">Y</a>
                        <a href="#" class="btn btn-md u-btn-outline-primary g-mr-10 g-mb-15">Z</a>

                    </div>
 
                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                        <h4>Test By Condition</h4>
                        @foreach($labconditions as $c)
                        <a href="/lab/condition/{{$c->condition_slug}}" class="btn btn-md u-btn-primary g-mr-10 g-mb-15 " style="border-radius: 0px;">{{$c->condition_name}} </a>
                        @endforeach
                    </div>
 
                    <div role="tabpanel" class="tab-pane fade" id="Section3">
                        <h4>Section 3</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pretium, metus et scelerisque dignissim, ligula est imperdiet nisl, sit amet malesuada nunc felis in nisi. Nullam dapibus ligula dui, in rhoncus purus euismod nec. Duis in lacinia neque. Etiam tellus.
                        </p>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="Section4">
                      <h4>Test By Category</h4>
                      @foreach($labcategories as $c)
                    
                        
                        <a href="/lab/category/{{$c->cat_slug}}" class="btn btn-md u-btn-primary g-mr-10 g-mb-15 " style="border-radius: 0px;"><img  style="height:2rem;border-radius:30px;" src="/assets/images/{{$c->photo}}" alt="Image Description"> {{$c->cat_name}} ({{$c->products->count()}})</a>
                      @endforeach
                  </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>






<div class="container g-pt-50 g-pb-20 " style="display:none;">
  <div class="row justify-content-between">
    <div class="col-lg-9 order-lg-2 g-mb-80">

      <div class="g-pl-0--lg">

        
      
      </div>
    

      <div class="g-pl-0--lg">
        <div class="container g-mt-5">
      @if($packages->count() > 0)
      <div class="">
        <a class="u-tags-v1 g-color-blue g-brd-around g-brd-blue g-bg-blue-opacity-0_1 g-bg-blue--hover g-color-white--hover g-rounded-50 g-py-4 g-px-15" href="#">
          <i class="fa fa-tag mr-1"></i>
          Available Packages
        </a>
      </div>
      <div class="">
        <div class="row">
          @foreach($packages as $product)

            <div class="col-lg-6 g-mb-30">

                <article class="u-shadow-v21 g-bg-white rounded" style="display: none;">
                  <div class="g-pa-30">
                      <h3 class="g-font-weight-300 g-mb-15">
                      <a class="u-link-v5 g-color-main g-color-primary--hover" id="test-vendor-{{ $product->id }}" href="#">{{$product->vendor->name}}</a>
                      </h3>
                      <p style="font-size: 1.25rem;" id="test-name-{{ $product->id }}">{{ $product->type->name}}</p>
                      <p style="font-size: 1.25rem;">Price: Rs. {{$product->cprice}}</p>

                  </div>
                  <div style="display: none" id="test-details-{{ $product->id }}">
                    {!! $product->type->description !!}
                  </div>

                  <div class=" g-font-size-12 g-brd-top g-brd-gray-light-v4 g-pa-15-20">
                    <input type="hidden" value="{{ $product->id }}" />

                    <button class="btn btn-md u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10 addTest" style="border-radius:30px;">
                        <i class="g-mr-5 fa fa-heart"></i>
                        Book Now
                    </button>
                    <button class="btn btn-md u-btn-orange pull-right g-font-weight-600 g-font-size-11 text-uppercase g-py-10 viewDetails">
                        <i class="g-mr-5 fa fa-eye"></i>
                        View Details
                    </button>
                  </div>
                </article>


                <article class="u-shadow-v19 media g-bg-white rounded g-pa-20">


                  <div class="media-body">
                    <!-- Article Info -->
                    <div class="g-mb-10">
                      <h3 class="h5 g-mb-5">
                        <a class="g-color-main g-color-primary--hover g-text-underline--none--hover" id="test-vendor-{{ $product->id }}" href="#"><img  style=" height: 2rem;" id="adminimg" src="{{ $product->vendor->photo ? asset('assets/images/'.$product->vendor->photo):asset('assets/images/user.png')}}" alt="profile image">{{$product->vendor->name}}</a>
                        <a href="" class="pull-right" data-toggle="modal" style="border-radius: 30px;" data-target="#c{{$product->vendor->id}}"> <i class="icon-info"></i></a>
                      </h3>
                      <div class="js-rating g-font-size-11 g-color-primary g-mb-10" data-rating="3" data-spacing="1" data-backward-icons-classes="fa fa-star g-opacity-0_5"></div>
                      <p style="font-size:13px;" id="test-name-{{ $product->id }}">{{ $product->type->name}}</p>
                    </div>
                    <!-- End Article Info -->

                    <!-- Article Author -->

                    <!-- End Article Author -->
{{--
                    <hr class="g-brd-gray-light-v4 g-my-20"> --}}

                    <!-- Figure Footer -->
                    <ul class="list-inline text-center" style="margin-bottom: 0rem;font-size:14px;">
                      <li class="list-inline-item ">
                        <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-13 g-text-underline--none--hover rounded g-px-10 g-py-5" href="#">
                            <span class="g-font-weight-600 g-ml-5">Total Package Price:



                          <span class="g-font-weight-600 g-ml-5 " style="color: #555 ;">
                            Rs.{{$product->cprice}}
                      </span>
                          </span>
                        </a>
                      </li>
                      {{-- <li class="list-inline-item pull-right">
                        <input type="hidden" value="{{ $product->id }}" />

                        <button style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem;" class="btn btn-md u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase addTest" title="Book now">
                            <i class="icon-note"></i>
                            Book Now
                        </button>
                        &nbsp;
                        <button class="btn btn-md u-btn-orange pull-right g-font-weight-600 g-font-size-11 text-uppercase viewDetails" style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem;">
                          <i class="icon-book-open"></i>

                      </button>

                      </li> --}}

                    </ul>


                      <div class=" g-font-size-12 g-brd-gray-light-v4 g-pa-15-20 text-center" >
                        <input type="hidden" value="{{ $product->id }}" />
                        <button class="btn btn-md u-btn-orange g-font-weight-600 g-font-size-11 text-uppercase viewDetails" style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem; ">
                          <i class="icon-book-open"></i> View Details

                      </button>
                        <button style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem; " class="btn btn-md u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase addTest" title="Book now">
                            <i class="icon-note"></i>
                            Book Now
                        </button>


                      </div>
                      {{-- <ul class="list-inline g-color-gray-dark-v5 g-font-size-13 text-center" >
                        <span class="g-font-weight-600 g-ml-5"><i class="icon-globe"></i>  </span>
                      <li class="list-inline-item g-brd-gray-light-v3 g-line-height-1 g-pr-7 g-mr-5">
                        <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-12 g-text-underline--none--hover rounded g-px-10 g-py-5" href="https://{{$product->vendor->link}}" target="_blank">{{$product->vendor->link}}</a>
                        <button type="button" class="black-btn" data-toggle="modal" style="border-radius: 30px;" data-target="#c{{$product->vendor->id}}">
                          <i class="icon-info"></i> More info
                        </button>
                      </li>

                    </ul> --}}

                    <!-- End Figure Footer -->
                  </div>
                  <!-- End Article Content -->
                </article>
            </div>

            <div class="modal fade" id="c{{$product->vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


          @endforeach
        </div>
      </div>
    @endif
      </div>
      </div>


    </div>

    <div class="col-lg-3 order-lg-1 g-brd-right--lg g-brd-gray-light-v4 g-mb-80">
      <div class="g-pr-1--lg">
        <!-- Links -->
        <div class="g-mb-5">
          <h3 class="h5 mb-1" style="text-transform: uppercase;color:#2385aa;">Categories:</h3>
          <ul class="list-unstyled g-font-size-13 mb-0">
            @foreach($labcategories as $c)
            <li>
              <a class="d-block u-link-v5 g-color-black g-px-20 g-py-8" href="/lab/category/{{$c->cat_slug}}"> <img  style="height:2rem;border-radius:30px;" src="/assets/images/{{$c->photo}}" alt="Image Description"> {{$c->cat_name}} ({{$c->products->count()}})</a>
            </li>
            @endforeach

          </ul>
        </div>
        <!-- End Links -->


{{--
        <div id="stickyblock-start">
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





  <div class="container g-mt-20">
    {{-- <div class="text-center">
      <h2>Trusted Diagnostics. Most Affordable Rates.</h2>
    </div> --}}

      {{-- <div class="row g-mt-20">
          <div class="col-lg-4 g-mb-30">
            <!-- Icon Blocks -->
            <div class="text-center u-icon-block--hover">
              <img class="u-image-icon-size-2xl rounded-circle g-mb-25" src="/frontend-assets/main-assets/assets/img/icons/set-1/01.png" alt="Image Description">
              <h3 style="font-size: 1.25rem;"  class="h5 g-color-black g-font-weight-600 mb-3">Assured Home Service</h3>
              <p style="font-size: 1.25rem;" class="g-color-gray-dark-v4">Medlife expert technician visits your home to collect blood sample. All samples have a Unique-ID. You can track your sample in real time.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-mb-30">
            <!-- Icon Blocks -->
            <div class="text-center u-icon-block--hover">
              <img class="u-image-icon-size-2xl rounded-circle g-mb-25" src="/frontend-assets/main-assets/assets/img/icons/set-1/02.png" alt="Image Description">
              <h3 class="h5 g-color-black mb-3 g-font-weight-600">High Quality Reports</h3>
              <p style="font-size: 1.25rem;" class="g-color-gray-dark-v4">Sample with Unique-ID is deposited in accredited Lab and you receive the reports immediately after our Pathologist reviews it.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>

          <div class="col-lg-4 g-mb-30">
            <!-- Icon Blocks -->
            <div class="text-center u-icon-block--hover">
              <img class="u-image-icon-size-2xl rounded-circle g-mb-25" src="/frontend-assets/main-assets/assets/img/icons/set-1/03.png" alt="Image Description">
              <h3 class="h5 g-color-black mb-3 g-font-weight-600">Expert Review</h3>
              <p style="font-size: 1.25rem;" class="g-color-gray-dark-v4">Get review from expert doctors and dietician on your report at the comfort of your home.</p>
            </div>
            <!-- End Icon Blocks -->
          </div>
      </div> --}}
      {{-- <label class="d-block g-color-gray-dark-v2 g-font-size-20">Categories:</label> --}}

{{--

      <div class="text-center">
        <h4 style="text-transform: uppercase;">Categories:</h4>
      </div>
      <div class="g-mx-minus-15">
          <div class="row">
            @foreach($labcategories as $c)

            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 g-pt-20 g-mb-30">

              <article class="u-block-hover u-block-hover--uncroped text-center">

              <a class="d-block u-block-hover__additional--jump g-mb-10" href="/lab/category/{{$c->cat_slug}}">
                <img  style="height:6rem;" src="/assets/images/{{$c->photo}}" alt="Image Description">
                </a>

                <em class="d-block g-color-gray-dark-v5 g-font-style-normal g-font-size-12 g-mb-0">({{$c->products->count()}} tests)</em>
                <h6 class="h6">
                  <a class="g-color-main g-color-primary--hover g-text-underline--none--hover" href="/lab/category/{{$c->cat_slug}}">{{$c->cat_name}}</a>
                </h6>

              </article>

            </div>
            @endforeach

          </div>

      </div> --}}




  </div>

@endsection

@section('scripts')

<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $('.selectTests').select2({
    placeholder: 'Select Lab Tests'
  });
</script>

<script >
    $(document).ready(function () {

      // initialization of carousel
      $.HSCore.components.HSCarousel.init('.js-carousel');

      $(document).on("click", ".viewDetails" , function(){
          var pid = $(this).parent().find('input[type=hidden]').val();

          var html = '<div class="row" style="padding: 10px;">'+
                      '  <div class="col-md-12 col-sm-12">'+
                      '    <div class="product-review-details-description">'+
                      '      <h4>'+$('#test-name-'+pid).html()+'</h4>'+
                      '      <h5 class="modal-product-review">'+$('#test-vendor-'+pid).html()+'</h5>'+
                      '      <div class="product-review-description">'+
                      '        <p style="text-align:justify;">'+$('#test-details-'+pid).html()+'</p>'+
                      '      </div>'+
                      '    </div>'+
                      '  </div>'+
                      '</div>'
          $("#myModal .modal-content").html(html);
          $("#myModal").modal('show');

      });
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
          console.log(selected);

          var city = $('#comparecity').val();

          $('#addTests').attr('disabled','disabled');

          $.ajax({
              type: "POST",
              url:"{{URL::to('/lab/json/compare')}}",
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
{{-- 
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script> --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
{{-- <script type="text/javascript">
  $('.category-multiple').select2({
    placeholder: 'Select Tests'
  });
</script> --}}

 <!-- JS Unify -->
 <script  src="/frontend-assets/main-assets/assets/js/components/hs.tabs.js"></script>

 <!-- JS Plugins Init. -->
 <script >
   $(document).on('ready', function () {
     // initialization of tabs
     $.HSCore.components.HSTabs.init('[role="tablist"]');
   });

   $(window).on('resize', function () {
     setTimeout(function () {
       $.HSCore.components.HSTabs.init('[role="tablist"]');
     }, 200);
   });
 </script>

@endsection
