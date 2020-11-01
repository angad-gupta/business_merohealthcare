@extends('layouts.front')
@section('title','Ask A Doctor')
@section('content')
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.css">

<style>
.rounded-0 {
  border-radius: 30px !important;
}

</style>

<style>


   #askdoctor{
    font-weight: 700 !important;
    color: #fefefe !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  }

  @media only screen and (max-width: 768px){
    #askdoctor{
    font-weight: 700 !important;
    color: #fefefe ;
    background-color: white !important;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }

  #askdoctor-mobile{
    font-weight: 700 !important;
    color: white !important;
    background-color: #2385aa ;
    padding: 2px 15px !important;
    border-radius: 30px !important;
  
  }

  #askdoctor-mobile-a{
    color:white !important;
  }

}
</style>

<section class="dzsparallaxer auto-init height-is-based-on-content use-loading" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
  <!-- Parallax Image -->
  <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-black-opacity-0_4--after" style="height: 140%; background-image: url('https://www.bertelsmann-stiftung.de/fileadmin/files/_processed_/e/c/csm_1745760019AdobeStock_168106216_144499710_KONZERN_ST-VV_Montage_2_f2e20d797d.jpg');"></div>
  <!-- End Parallax Image -->

  <div class="container text-center g-color-white g-py-50--md g-py-80">
    <h2 class="text-uppercase g-font-weight-700 g-mb-20">Ask A Doctor</h2>

    <p class="lead g-px-100--md g-mb-40">Ask your queries with our online doctors for FREE</p>

    <div class="g-hidden-md-up"></div>
    {{-- <button id="doctor" class="btn btn-xl u-btn-primary text-uppercase g-font-weight-600 g-font-size-12 g-rounded-50 g-mb-15">Let's Start</button> --}}
  </div>
</section>



<div class="container" id="alldoctor">
  <h3 class="h4 g-font-weight-300 g-mt-30 text-center">Available Doctors</h3>
  <div class="row">

    @foreach ($doctors as $doctor)
        
   
    <div class="col-sm-6 col-md-4 g-mb-30">
    
      <article class="u-shadow-v28 g-bg-white u-block-hover" style="border-radius:30px;">
        <img class="img-fluid w-100 img-fluid u-block-hover__main--zoom-v1" src="{{ $doctor->photo ? asset('assets/images/'.$doctor->photo):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Image Description" style="height:300px;">

        <div class="g-pos-rel">

          <svg class="g-pos-abs g-left-0 g-right-0" version="1.1" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="140px" viewBox="20 -20 300 100" style="top: -70%;">
            <path d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729 c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" opacity="0.4" fill="#f0f1f3"></path>
            <path d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729 c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" opacity="0.4" fill="#f0f1f3"></path>
            <path d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716 H42.401L43.415,98.342z" opacity="0" fill="#fff"></path>
            <path d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428 c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#fff"></path>
          </svg>
    

          <div class="g-pos-rel g-z-index-1 g-pa-30">
            <h3 class="h5 mb-1">
            <a class="u-link-v5 g-color-black g-color-primary--hover" href="{{route('user-askdoctor-doctor',['id' => $doctor->id, 'slug' => str_slug($doctor->name,'-')])}}">{{$doctor->name}}</a>
            </h3>
            <span class="u-label g-bg-primary g-rounded-20">{{$doctor->post}}</span>
          
              <a class="btn u-btn-primary g-rounded-50 pull-right" style="background-color:#28a745;padding:5px 30px;" href="{{route('user-askdoctor-doctor',['id' => $doctor->id, 'slug' => str_slug($doctor->name,'-')])}}">Ask</a>
         
            </div>
        </div>
      </article>

    </div>
    @endforeach

 
  </div>
</div>


@endsection



@section('scripts')

<!-- JS Implementing Plugins -->
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>

    <script>
        $('.refresh_code').click(function () {
            $.get('{{url('askdoctor/refresh_code')}}', function(data, status){
                $('#codeimg').attr("src","{{url('assets/images')}}/capcha_code.png?time="+ Math.random());
            });
        })
    </script>
    <script>
      jQuery(function(){
         jQuery('#captcha').click();
      });
      </script>

<script>

  $("#doctor").click(function() {
  $('html, body').animate({
      scrollTop: $("#alldoctor").offset().top
  }, 2000);
});



  </script>


@endsection