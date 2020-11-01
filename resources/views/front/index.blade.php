@extends('layouts.front')
@section('title','Online Pharmacy | Buy Medicine in Nepal | Healthcare Products')

@section('content')
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
<link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.css">

@php
$i=1;
$j=1;
$now = Carbon\Carbon::now()->format('Y/m/d h:i A');
@endphp

<style>

  .g-bottom-0{
    bottom:-20px;
  }

@media (min-width: 768px){
  .col-md-8 {
    -ms-flex: 0 0 50%;
    flex: 0 0 65.67%;
    max-width: 65.67%;
    }
  }
  /* .col-md-4 {
    -ms-flex: 0 0 50%;
    flex: 0 0 33%;
    max-width: 33%;
    }
  } */

  @media (min-width: 768px){
  .col-md-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 49%;
    max-width: 49% !important;
    }
  }
 .product-name a{
        font-size:14px;
        font-weight:600;
        color:#333 !important;
      }
  .product-price{
    font-size:12px;
    font-weight:600;
  }
  
  /* ==== Main CSS === */
  h1.second {
	font-weight: 200;
}

h1.second span {
	position: relative;
	display: inline-block;
	padding: 5px 10px ;
	border-radius: 10px;
	border-bottom: 1px solid #2385aa;
}

h1.second span:after {
	content: '';
	position: absolute;
	bottom: calc(-100% - 1px);
	margin-left: -10px;
	display: block;
	width: 100%; height: 100%;
	border-radius: 10px;
	border-top: 1px solid transparent;
}
  
.img-fill{
  width: 100%;
  display: block;
  overflow: hidden;
  position: relative;
  text-align: center
}

.img-fill img {
  height: 100%;
  min-width: 100%;
  position: relative;
  display: inline-block;
  max-width: none;
}

*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.04);
}

.Grid1k {
  padding: 0 15px;
  max-width: 1200px;
  margin: auto;
}

.blocks-box,
.slick-slider {
  margin: 0;
  padding: 0!important;
}

.slick-slide {
  float: left /* If RTL Make This Right */ ;
  padding: 0;
}

/* ==== Slider Style === */
@media only screen and (max-width: 767px){

  #teej{
    margin-bottom:15px;
    padding-right: 0px !important;
  }
.Modern-Slider .item .img-fill{
  height:30vh !important;

}
}

.Modern-Slider .item .img-fill{
  height:50vh;
 
}

.Modern-Slider .item .img-fill .info{
  position:absolute;
  width:100%;
  height:100%;
  top:0px;
  left:0px;
  background:rgba(0,0,0,.00);
  line-height:100vh;
  text-align:center;
}

.Modern-Slider .item .img-fill img{
  /* filter:blur(5px); */
}

.Modern-Slider .item .info > div{
  display:inline-block!important;
  vertical-align:middle;
}

.Modern-Slider .NextArrow{
  position:absolute;
  top:50%;
  right:0px;
  width:45px;
  height:45px;
  background:rgba(0,0,0,.50);
  border:0 none;
  margin-top:-22.5px;
  text-align:center;
  font:20px/45px FontAwesome;
  color:#FFF;
  z-index:5;
}

.Modern-Slider .NextArrow:before{content:'\f105';}

.Modern-Slider .PrevArrow{
  position:absolute;
  top:50%;
  left:0px;
  width:45px;
  height:45px;
  background:rgba(0,0,0,.50);
  border:0 none;
  margin-top:-22.5px;
  text-align:center;
  font:20px/45px FontAwesome;
  color:#FFF;
  z-index:5;
}

.Modern-Slider .PrevArrow:before{content:'\f104';}

.Modern-Slider .slick-dots{
  position:absolute;
  height:5px;
  background:rgba(255,255,255,.20);
  bottom:0px;
  width:100%;
  left:0px;
  padding:0px;
  margin:0px;
  list-style-type:none;
}
.Modern-Slider .slick-dots li button{display:none;}
.Modern-Slider .slick-dots li{
  float:left;
  width:0px;
  height:5px;
  background:#d62828;
  position:absolute;
  left:0px;
  bottom:0px;
}

.Modern-Slider .slick-dots li.slick-active{
  width:100%;
  animation:ProgressDots 11s both;
}

.Modern-Slider .item h3{
  font:30px/50px RalewayB;
  text-transform:uppercase;
  color:#FFF;
  animation:fadeOutRight 1s both;
  margin:0;
  padding:0;
}

.Modern-Slider .item h5{
  margin:0;
  padding:0;
  font:15px/30px RalewayR;
  color:#FFF;
  max-width:600px;
  overflow:hidden;
  height:60px;
  animation:fadeOutLeft 1s both;
}

.Modern-Slider .item.slick-active h3{
  animation:fadeInDown 1s both 1s;
}

.Modern-Slider .item.slick-active h5{
  animation:fadeInLeft 1s both 1.5s;
}

.Modern-Slider .item.slick-active{
  animation:Slick-FastSwipeIn 1s both;
}

.Modern-Slider {background:#000;}

/* ==== Slider Image Transition === */
@keyframes Slick-FastSwipeIn{
    0%{transform:rotate3d(0,1,0,150deg) scale(0)  perspective(400px);} 
    100%{transform:rotate3d(0,1,0,0deg) scale(1) perspective(400px);} 
}

@-webkit-keyframes ProgressDots{from{width:0px;}to{width:100%;}}
@keyframes ProgressDots{from{width:0px;}to{width:100%;}}

/* ==== Slick Slider Css Ruls === */
.slick-slider{position:relative;display:block;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-touch-callout:none;-khtml-user-select:none;-ms-touch-action:pan-y;touch-action:pan-y;-webkit-tap-highlight-color:transparent}
.slick-list{position:relative;display:block;overflow:hidden;margin:0;padding:0}
.slick-list:focus{outline:none}.slick-list.dragging{cursor:hand}
.slick-slider .slick-track,.slick-slider .slick-list{-webkit-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}
.slick-track{position:relative;top:0;left:0;display:block}
.slick-track:before,.slick-track:after{display:table;content:''}.slick-track:after{clear:both}
.slick-loading .slick-track{visibility:hidden}
.slick-slide{display:none;float:left /* If RTL Make This Right */ ;height:100%;min-height:1px}
.slick-slide.dragging img{pointer-events:none}
.slick-initialized .slick-slide{display:block}
.slick-loading .slick-slide{visibility:hidden}
.slick-vertical .slick-slide{display:block;height:auto;border:1px solid transparent}

  .u-ribbon-v1{
    border-radius:30px;
  }

    .product-price{
        font-size:14px;
  }
    
@media only screen and (max-width: 767px){
.product-image-area {
    height: 175px !important;
    width: 100%;
    padding:1.5rem;
}
}

    .js-countdown {
          font-size:10px;
        }
    
      .g-color-black{
        color: 555 !important;
      }
    
    @media only screen and (max-width: 1200px) and (min-width: 992px){
    .category-wrap .product-image-area {
        width: 100%;
        height: 220px;
    }
    }
    
    @media only screen and (max-width: 991px) and (min-width: 768px){
    .category-wrap .product-image-area {
        width: 100%;
        height: 200px;
    }

    
    }

    @media (max-width: 1024px) and (min-width: 768px){
.g-mt-1 {
    margin-top: 0px!important;
}
    }

    .product-name{
            margin-bottom:15px !important;
            font-size:12px;
        }

   
    
    
      @media only screen and (max-width: 767px){

        
        .product-name{
            margin-bottom:10px !important;
        }
      .category-wrap .product-image-area {
          height: 175px;
          width: 100% ;
      }
      .js-countdown {
          font-size:12px !important;
        }
      }
      
      .gallery-overlay {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 2;
          opacity: 0;
          transition: all .4s ease-in;
      }
      
      .product-hover-area {
          position: absolute;
          width: 101%;
          left: 0;
          bottom: -15%;
          opacity: 0;
          visibility: hidden;
          z-index: 3;
          -webkit-transition: all .4s ease-in;
          transition: all .4s ease-in;
          z-index: 36;
      }
      
      .single-product-area {
          border: 0px solid #e0e0e0;
          box-shadow: 0 0 0px 0px #dedede;
          display: block;
          -webkit-transform: perspective(1px) translateZ(0);
          transform: perspective(1px) translateZ(0);
          position: relative;
          overflow: hidden;
          -webkit-transition: all .3s ease-in;
          transition: all .3s ease-in;
          margin-bottom: 30px;
      }

      .product-image-area {
    height: 180px ;
    width: 100%;
    padding:1.5rem;
    }
      </style>


<style>

.js-carousel.slick-initialized .js-next, .js-carousel.slick-initialized .js-prev {
    opacity: 1;
    background: transparent;

}



@media only screen and (max-width: 768px){

    section {

  height: 15rem !important;}

  #slider-img{
      height: 15rem !important;
  }

.g-font-size-16{
    font-size: 10px !important;
}
.g-font-size-15{
    font-size: 10px !important;
}
.g-mt-1 {
    margin-top: 2px!important;
}
.et-icon-alarmclock{
    font-size: 10px;
}

#card-height{
    height: 24rem !important;
}



}

#card-height{
    height: 23rem ;
}

@media (min-width: 768px) and (max-width: 1024px){
.g-font-size-16{
    font-size: 10px !important;
}
.g-font-size-15{
    font-size: 10px !important;
}
.g-mt-1 {
    margin-top: 0px!important;
}
.et-icon-alarmclock{
    font-size: 10px;
}

.product-image-area {
    height: 170px !important;
    width: 100%;
    padding: 1.5rem;
}

.js-countdown{
  margin-top:1px !important;
  font-size:14px !important;
}

}


@media (min-width: 320px) and (max-width: 768px){
  .slider,
  .slide {
    height: 40vh;
    text-align: center !important;
  }

  .slide .slide__img {
 text-align: center;
  width: 100%;
  height: 20rem;
  overflow: auto;
}
}

@media (min-width: 992px) {
  .slider,
  .slide {
    height: 40vh;
    text-align: center !important;
  }
}
.slide {
  position: relative;
}
.slide .slide__img {
 text-align: center;
  width: 100%;
  height: auto;
  overflow: auto;
}
@media (min-width: 992px) {
  .slide .slide__img {
    position: absolute;
    top: 50%;
    left: 0%;
    -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
  }
}
.slide .slide__img img {
  max-width: 100%;
  height: auto;
  opacity: 1 !important;
  -webkit-animation-duration: 3s;
          animation-duration: 3s;
  -webkit-transition: all 1s ease;
  transition: all 1s ease;
}
.slide .slide__content {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}
.slide .slide__content--headings {
  text-align: center;
  color: #FFF;
}
.slide .slide__content--headings h2 {
  font-size: 4.5rem;
  margin: 10px 0;
}
.slide .slide__content--headings .animated {
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
}
.slider [data-animation-in] {
  opacity: 0;
  -webkit-animation-duration: 1.5s;
          animation-duration: 1.5s;
  -webkit-transition: opacity 0.5s ease 0.3s;
  transition: opacity 0.5s ease 0.3s;
}
.slick-dotted .slick-slider {
  margin-bottom: 30px;
}
.slick-dots {
  position: absolute;
  bottom: 25px;
  list-style: none;
  display: block;
  text-align: center;
  padding: 0;
  margin: 0;
  width: 100%;
}
.slick-dots li {
  position: relative;
  display: inline-block;
  margin: 0 5px;
  padding: 0;
  cursor: pointer;
}
.slick-dots li button {
  border: 0;
  display: block;
  outline: none;
  line-height: 0px;
  font-size: 0px;
  color: transparent;
  padding: 5px;
  cursor: pointer;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}
.slick-dots li button:hover,
.slick-dots li button:focus {
  outline: none;
}
.simple-dots .slick-dots li {
  width: 20px;
  height: 20px;
}
.simple-dots .slick-dots li button {
  border-radius: 50%;
  background-color: white;
  opacity: 0.25;
  width: 20px;
  height: 20px;
}
.simple-dots .slick-dots li button:hover,
.simple-dots .slick-dots li button:focus {
  opacity: 1;
}
.simple-dots .slick-dots li.slick-active button {
  color: white;
  opacity: 0.75;
}
.stick-dots .slick-dots li {
  height: 3px;
  width: 50px;
}
.stick-dots .slick-dots li button {
  position: relative;
  background-color: white;
  opacity: 0.25;
  width: 50px;
  height: 3px;
  padding: 0;
}
.stick-dots .slick-dots li button:hover,
.stick-dots .slick-dots li button:focus {
  opacity: 1;
}
.stick-dots .slick-dots li.slick-active button {
  color: white;
  opacity: 0.75;
}
.stick-dots .slick-dots li.slick-active button:hover,
.stick-dots .slick-dots li.slick-active button:focus {
  opacity: 1;
}
/* /////////// IMAGE ZOOM /////////// */
@-webkit-keyframes zoomInImage {
  from {
    -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
  }
  to {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
            transform: scale3d(1.1, 1.1, 1.1);
  }
}
@keyframes zoomInImage {
  from {
    -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
  }
  to {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
            transform: scale3d(1.1, 1.1, 1.1);
  }
}
.zoomInImage {
  -webkit-animation-name: zoomInImage;
          animation-name: zoomInImage;
}
@-webkit-keyframes zoomOutImage {
  from {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
            transform: scale3d(1.1, 1.1, 1.1);
  }
  to {
    -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
  }
}
@keyframes zoomOutImage {
  from {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
            transform: scale3d(1.1, 1.1, 1.1);
  }
  to {
    -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
  }
}
.zoomOutImage {
  -webkit-animation-name: zoomOutImage;
          animation-name: zoomOutImage;
}




section {
  width: 100%;
  height: 30rem;
  margin: 0 auto;
  overflow: hidden;
  background: #2980b9;
  -moz-border-radius: 0.5em;
  -webkit-border-radius: 0em;
  border-radius: 0em;
}
section img {
  position: relative;
  max-height: 100%;
  left: 50%;
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -webkit-transform: translateX(-50%);
  transform: translateX(-50%);
}
@media (min-width: 800px) {
  section img {
    top: 50%;
    left: 0;
    max-height: none;
    width: 100%;
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
  }
}

@media (min-width: 768px){
.col-md-4 {
-ms-flex: 0 0 32.33%;
flex: 0 0 32.33%;
max-width: 32.33%;
}
}

</style>

<style>
    .slide{
      width:200px;
    }
    
   
    .slick-slide {
        margin: 0px 0px;
    }
    
    .slick-slide img {
        width: 200px;
    }
    
    .slick-slider
    {
        position: relative;
        display: block;
        box-sizing: border-box;
    
        -webkit-user-select: none;
           -moz-user-select: none;
            -ms-user-select: none;
                user-select: none;
    
        -webkit-touch-callout: none;
        -khtml-user-select: none;
        -ms-touch-action: pan-y;
            touch-action: pan-y;
        -webkit-tap-highlight-color: transparent;
    }
    
    .slick-list
    {
        position: relative;
        display: block;
        overflow: hidden;
    
        margin: 0;
        padding: 0;
    }
    .slick-list:focus
    {
        outline: none;
    }
    .slick-list.dragging
    {
        cursor: pointer;
        cursor: hand;
    }
    
    .slick-slider .slick-track,
    .slick-slider .slick-list
    {
        -webkit-transform: translate3d(0, 0, 0);
           -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
             -o-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
    }
    
    .slick-track
    {
        position: relative;
        top: 0;
        left: 0;
    
        display: block;
    }
    .slick-track:before,
    .slick-track:after
    {
        display: table;
    
        content: '';
    }
    .slick-track:after
    {
        clear: both;
    }
    .slick-loading .slick-track
    {
        visibility: hidden;
    }
    
    .slick-slide
    {
        display: none;
        float: left;
    
        height: 50%;
        min-height: 1px;
    }
    [dir='rtl'] .slick-slide
    {
        float: right;
    }
    .slick-slide img
    {
        display: block;
    }
    .slick-slide.slick-loading img
    {
        display: none;
    }
    .slick-slide.dragging img
    {
        pointer-events: none;
    }
    .slick-initialized .slick-slide
    {
        display: block;
    }
    .slick-loading .slick-slide
    {
        visibility: hidden;
    }
    .slick-vertical .slick-slide
    {
        display: block;
    
        height: 100px;
    
        border: 1px solid transparent;
    }
    .slick-arrow.slick-hidden {
        display: none;
    }

    .img-fluid{
      height:200px;
    }
    .js-carousel.slick-initialized .js-next, .js-carousel.slick-initialized .js-prev {
    border-radius: 30px !important;
    opacity: 1;
    background: transparent;
}

body{
  /* background: #f3f3f3; */
}

.js-next, .js-prev {
    z-index: 0;
}


</style>



{{-- 
@if($gs->slider == 1)
<div class="Modern-Slider">

  <div class="container g-color-white g-py-50--md g-py-50">
    <div class="row">
      <div class="col-md-8 align-self-center g-mb-60 g-mb-0--md">
        <h1 class="h1 text-uppercase g-font-weight-300 g-mb-20">ON-GOING PROMOTION <span style="color:gold;">(EXTENDED FOR A WEEK)</span></h1>
        <p class="lead g-mb-30">Due to excessive demand from the customer we have extended our offer for a week. Mamaearth FOR HIM, FOR HER AND THE BABY now available in Merohealthcare at 7% discount. </p>
         
       <p class="lead g-mb-5"> ✔️ Shop now and enjoy!</p>
         <p class="lead g-mb-5">✔️ FREE home delivery for purchases worth Rs.500 and more.</p>
         <p class="lead g-mb-5">✔️ Sign up and get 5% additional discount at the time of checkout. Use coupon code "MERO"</p>
          <p class="lead g-mb-30"> ✔️ We also deliver all kinds of Medicines.</p>
       
      </div>
    </div>

    <div class="item">
      <div class="img-fill">
        <img src="https://www.merohealthcare.com/assets/images/1595928873WhatsApp%20Image%202020-07-28%20at%2011.53.01%20AM%20(1).jpeg" alt="">

      </div>
    </div>

    <div class="item">
      <div class="img-fill">
        <img src="https://www.merohealthcare.com/assets/images/1595928864WhatsApp%20Image%202020-07-28%20at%2011.53.00%20AM.jpeg" alt="">
       
      </div>
    </div>
    @foreach($sliders as $slider)
    <div class="item">
      <div class="img-fill">
        <img src="{{asset('assets/images/'.$slider->photo)}}" alt="">
      
      </div>
    </div>
    @endforeach


</div>
@endif --}}


{{-- <div class="customer-logos">
  <div class="slide"><a href="https://www.merohealthcare.com/search?product=mamaearth"><img style="max-width:80%;height:80px;" src="https://exchange4media.gumlet.com/news-photo/104388-Mamaearth.jpg?w=500"></a></div>
  <div class="slide"><a href="https://www.merohealthcare.com/search?product=himalaya"><img style="max-width:80%;height:80px;" src="https://cdn.shopify.com/s/files/1/0279/8177/4927/files/logo-aboutus_b069db2c-3f10-481f-9201-7e88b32339f8.png?v=1580983201"></a></div>
  <div class="slide"><a href="https://www.merohealthcare.com/search?product=pigeon"><img style="max-width:80%;height:80px;" src="https://www.buttonandwheel.com/image/buttonandwheel/image/data/Brand/Pigeon%20Logo.jpg"></a></div>
  <div class="slide"><a href="https://www.merohealthcare.com/search?product=johnson"><img style="max-width:80%;height:80px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTsQpwWVUJSikB5gG5FPOuxxPcQHr21elprtA&usqp=CAU"></a></div>

  <div class="slide"><a href="https://www.merohealthcare.com/search?product=mamaearth"><img style="max-width:80%;height:80px;" src="https://exchange4media.gumlet.com/news-photo/104388-Mamaearth.jpg?w=500"></a></div>
  <div class="slide"><a href="https://www.merohealthcare.com/search?product=himalaya"><img style="max-width:80%;height:80px;" src="https://cdn.shopify.com/s/files/1/0279/8177/4927/files/logo-aboutus_b069db2c-3f10-481f-9201-7e88b32339f8.png?v=1580983201"></a></div>
  <div class="slide"><a href="https://www.merohealthcare.com/search?product=pigeon"><img style="max-width:80%;height:80px;" src="https://www.buttonandwheel.com/image/buttonandwheel/image/data/Brand/Pigeon%20Logo.jpg"></a></div>
  <div class="slide"><a href="https://www.merohealthcare.com/search?product=johnson"><img style="max-width:80%;height:80px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTsQpwWVUJSikB5gG5FPOuxxPcQHr21elprtA&usqp=CAU"></a></div>
  
</div> --}}




@if($gs->slider == 1)


  <div class="js-carousel text-center g-pb-30" data-autoplay="true" data-ride="carousel" data-infinite="true" >

          @foreach($sliders as $slider)
              <div class="js-slide">
                <section>
                    <div class="" style="width:100%;height:30rem ;">
                  <img id="slider-img" style="width:100%; height:40rem;" src="{{asset('assets/images/'.$slider->photo)}}">
                    </div>
                </section>
              </div>
          @endforeach
  </div>



@endif


{{-- <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll dzsprx-readyall loaded" data-options="{direction: &quot;reverse&quot;, settings_mode_oneelement_max_offset: &quot;150&quot;}">

  <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-black-opacity-0_2--after" style="height: 140%; background-image: url('https://www.merohealthcare.com/assets/images/1597647934mhc-homepage.png'); transform: translate3d(0px, -100.929px, 0px);"></div>


  <div class="container text-center g-color-white g-py-150--md g-py-80">
    <div class="row">
      <div class="col-md-8 ml-md-auto mr-md-auto ">
        <div class="container u-shadow-v36 g-py-10" style="border-radius:30px; background:#eeeeee24 !important">

          <h2 class="g-color-white g-font-weight-700 g-font-size-40 g-font-size-30--md text-uppercase g-line-height-1 g-mb-30 fadeInUp u-in-viewport" data-animation="fadeInUp" data-animation-delay="500" data-animation-duration="1500" style="animation-duration: 1500ms;font-size:30px !important;">
            <span class="g-color-blue" style="color:#143992 !important;text-shadow: 2px 2px 4px #ffffff;">MERO</span><span class="g-color-red" style="color:#dd143c !important;text-shadow: 2px 2px 4px #ffffff;">HEALTH</span><span class="g-color-blue" style="color:#143992 !important;text-shadow: 2px 2px 4px #ffffff;">CARE</span></h2>
          
            <div data-animation="fadeInUp" data-animation-delay="800" data-animation-duration="1500" style="animation-duration: 1500ms;" class="fadeInUp u-in-viewport">
            <p class="g-font-size-18 g-mb-30" style="color:#000 !important;font-weight:500; text-shadow: 2px 2px 4px #fff;">Merohealthcare is an online pharmacy which aims to be every Nepalese personnel's healthcare assistant.
   
            </p>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</section> --}}

<style>
  .banner {
	position: relative;
	/* z-index: 1; */
	margin: 80px auto;
	width: 260px;
}

.banner .line {
	margin: 0 0 10px;
	width: 100%;
	height: 60px;
	box-shadow: 10px 10px 10px rgba(0,0,0,0.05);
	text-align: center;
	text-transform: uppercase;
	font-size: 2em;
	line-height: 60px;
	transform: skew(0, -15deg);
}

.banner .line:after,
.banner .line:first-child:before {
	position: absolute;
	top: 35px;
	left: 0;
	z-index: -1;
	display: block;
	width: 260px;
	height: 58px;
	border-radius: 4px;
	background: rgba(180,180,180,0.8);
	content: '';
	transform: skew(0, 15deg);
}

.banner .line:first-child:before {
	top: -6px;
	right: 0;
	left: auto;
}

.banner .line:first-child:before,
.banner .line:last-child:after {
	width: 0;
	height: 0;
	border-width: 27px;
	border-style: solid;
	border-color: rgba(180,180,180,0.8) rgba(180,180,180,0.8) transparent transparent;
	background: transparent;
}

.banner .line:last-child:after {
	top: 12px;
	border-color: transparent transparent rgba(180,180,180,0.8) rgba(180,180,180,0.8);
}

.banner span {
	display: block;
	width: 100%;
	height: 100%;
	border-radius: 4px;
	background: rgba(255,255,255,0.9);
	color: #666;
	text-shadow: 1px 1px 0 #444;
}
  </style>

  <style>
    .progress-steps {
  font-family: 'Open Sans', sans-serif;
}
.progress-steps > div {
  margin-left: 39px;
  position: relative;
}
.progress-steps > div.hidden {
  display: none;
}
.progress-steps > div.active > h1::before {
  border: none;
}
.progress-steps > div.complete > h1 {
  color:#dc3545;
  font-weight: 600;
}
.progress-steps > div.complete > h1 > .number {
  background: #dc3545;
  color: #FFF;
}
.progress-steps > div:last-child > h1::before {
  border: none;
}
.progress-steps > div > h1 {
  font-size: 1em;
  margin-left: -39px;
  color: #222;
  font-weight: 600;
}
.progress-steps > div > h1 > .number {
  background: #16C4C7;
  color: #FFF;
}
.progress-steps > div > h1::before {
  content: '';
  position: absolute;
  border-left: dashed 1px #dc3545;
  width: 1px;
  height: calc(100% - 27px);
  top: 39px;
  left: -22.5px;
}
.progress-steps > div > h1 > .number {
  border-radius: 50%;
  width: 33px;
  height: 33px;
  display: inline-block;
  text-align: center;
  line-height: 33px;
}

    </style>

     
<div id="accordion-06" class="u-accordion" role="tablist" aria-multiselectable="true">
  <!-- Card -->
  <div class="card rounded-0 g-bg-gray-light-v4 g-brd-none">
    <div id="accordion-06-heading-01" class="u-accordion__header g-pa-20" role="tab">
      <h5 class="text-center mb-0 text-uppercase g-font-size-default g-font-weight-700">
        <a class="text-center justify-content-between g-color-main g-text-underline--none--hover" href="#accordion-06-body-01" data-toggle="collapse" data-parent="#accordion-06" aria-expanded="true" aria-controls="accordion-06-body-01">
            GET <b style="color: red">5%</b> ADDITIONAL DISCOUNT <b style="color: #ca4243">(expand)</b>
          <span class="u-accordion__control-icon g-ml-10">
            <i class="fa fa-angle-up"></i>
            <i class="fa fa-angle-down"></i>
           
          </span>
        </a>
      </h5>
    </div>
    <div id="accordion-06-body-01" class="collapse" role="tabpanel" aria-labelledby="accordion-06-heading-01" data-parent="#accordion-06">
      <div class="fluid" style="background: url('https://www.merohealthcare.com/assets/images/1598768150white-abstract-architecture-background-curved.jpg')"> 
        <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center g-py-20">
            <div class="banner">
              <div class="line">
                <span>GET <b style="color: red;">5%</b></span>
              </div>
              <div class="line">
                <span>ADDITIONAL</span>
              </div>
              <div class="line">
                <span>DISCOUNT</span>
              </div>
            </div>
          </div>
    
          <div class="col-md-6 align-self-center g-py-20">
            {{-- <h2 class="h4 text-uppercase g-letter-spacing-1 g-mb-20" data-animation="fadeInUp" data-animation-delay="500" data-animation-duration="2000">Content block</h2>
            <p class="lead mb-0 g-line-height-2" data-animation="fadeInUp" data-animation-delay="750" data-animation-duration="2000">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin hendrerit rhoncus tempus. Donec id orci malesuada, finibus odio quis, tincidunt libero. Fusce in venenatis ligula. Etiam eget lacus id erat scelerisque tempor.</p> --}}
            <div class="container">
              <div class="progress-steps">
                <div class="complete">
                  <h1>
                    <span class="number">1</span>
                    Sign up
                  </h1>
                  Register with us
                </div>
                <div class="complete">
                  <h1>
                    <span class="number">2</span>
                    Add Product in Cart
                  </h1>
                   Start Shopping
                </div>
                <div class="complete">
                  <h1>
                    <span class="number">3</span>
                    Checkout
                  </h1>
                   Proceed Checkout
                </div>
                <div class="complete">
                  <h1>
                    <span class="number">4</span>
                    Apply Coupon Code (MERO)
                  </h1>
                    Get discount on your first purchase
                </div>
                <div class="complete">
                  <h1>
                    <span class="number">5</span>
                    Get Your discount
                  </h1> 
                  
                  <a href="{{route('front.discount.offers')}}" class="btn btn-md u-btn-skew u-btn-darkred g-mr-10 g-mb-15">
                    <span class="u-btn-skew__inner">Read More</span>
                  </a>
                </div>
               
              </div>
            </div>
          </div>
    
      
        </div>
        </div>
      </div>
    
    </div>
  </div>
  <!-- End Card -->

</div>

 





{{-- @if($gs->slider == 1)
<div class="row">
  <div class="col-lg-12">
    <div class="g-flex-middle h-50 g-bg-black">
      <div class="g-flex-middle-item">
  
        <div class="js-carousel" data-infinite="true" data-autoplay="true" data-fade="true" data-arrows-classes="u-arrow-v1 g-pos-abs g-left-75 g-bottom-30 g-width-45 g-height-45 g-font-size-default g-color-gray-dark-v5 g-bg-white g-color-white--hover g-bg-primary--hover rounded" data-arrow-left-classes="fa fa-angle-left g-ml-minus-45" data-arrow-right-classes="fa fa-angle-right g-ml-5">
        
          @foreach($sliders as $slider)
          <article class="g-bg-cover ">
        
          <img class="w-100" id="slider-img" style="height:40rem;" src="{{asset('assets/images/'.$slider->photo)}}" alt="{{$slider->photo}}">
   

            <div class="w-100 g-color-white-opacity-0_8 g-pos-abs g-left-0 g-bottom-0 g-z-index-1 g-px-30 g-pb-100--sm g-pb-70">
              <span class="d-block g-font-weight-700 g-font-size-20 g-color-primary">$19.50</span>
              <h3 class="h3 g-font-weight-700 text-uppercase g-color-white">Unify template</h3>
              <p>Understanding who you are and what you want is our strategy for your health.</p>
            </div>
      
          </article>
          @endforeach
         

        </div>
     
      </div>
    </div>
  </div>

  
</div>
@endif --}}

{{-- <div class="g-mt-15" style="padding:30px; ">
 <div class="text-center g-mb-10">
  <div class="d-inline-flex g-font-weight-600 g-font-size-11 text-uppercase g-mr-10 g-mb-10 g-mb-0--md text-center">
    <span class="u-label u-triangle-v1-2 u-triangle-right g-bg-black g-px-20 g-py-14" style="background-color:#dc3545 !important;border-top-left-radius:20px;border-bottom-left-radius:20px;">Current</span>
    <span class="u-label g-color-gray-dark-v1 g-bg-primary g-px-20 g-py-14" style="background-color:#72c02c !important;border-top-right-radius:20px;border-bottom-right-radius:20px;color:white !important;">Offers</span>
  </div>
 </div>
  <div class="row">
    <div class="col-sm-6 col-lg-3 g-px-10 g-mb-30">
      <div class="u-shadow-v21">
        <div class="g-pos-rel">
          <div class="js-carousel text-center g-rounded-50 g-bg-gray-light-v5 g-py-3" data-infinite="true" data-fade="true" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-30 g-height-30 g-color-white g-color-primary--hover g-font-size-18 g-mb-45" >
            <div class="js-slide">
              <img class="img-fluid" style="width:100%;border-radius:15px;" src="https://www.merohealthcare.com/assets/images/1596797310WhatsApp%20Image%202020-08-07%20at%204.00.13%20PM.jpeg" data-animation="zoomInDown" data-animation-delay="0" data-animation-duration="1000" alt="Image Description">
            </div>
          </div>
        </div>
        <div class="g-bg-white g-pa-10">
          <div class="text-center">
            <div class="text-center">
              <h4 class="g-font-size-11 text-center text-uppercase g-font-weight-600">Lovillea</h4>
              <a class="btn btn-md g-font-weight-600 g-font-size-12 text-uppercase blue" style="border-radius:25px;background-color:#dc3545;color:white;" href="/search?product=Lovillea"><i class="icon-finance-100 u-line-icon-pro"></i> Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="col-sm-6 col-lg-3 g-px-10 g-mb-30">
      <div class="u-shadow-v21">
        <div class="g-pos-rel">
          <div class="js-carousel text-center g-rounded-50 g-bg-gray-light-v5 g-py-3" data-infinite="true" data-fade="true" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-30 g-height-30 g-color-white g-color-primary--hover g-font-size-18 g-mb-45" >
            <div class="js-slide">
              <img class="img-fluid u-block-hover__main--zoom-v1" style="width:100%;border-radius:15px;" src="https://www.merohealthcare.com/assets/images/1596797331WhatsApp%20Image%202020-08-07%20at%204.00.14%20PM.jpeg" data-animation="zoomInDown" data-animation-delay="0" data-animation-duration="1000" alt="Image Description">
            </div>
          </div>
        </div>
        <div class="g-bg-white g-pa-10">
          <div class="text-center">
            <h4 class="g-font-size-11 text-center text-uppercase g-font-weight-600">St. Ives</h4>
            <a class="btn btn-md g-font-weight-600 g-font-size-12 text-uppercase blue" style="border-radius:25px;background-color:#dc3545;color:white;" href="/search?product=St.+Ives"><i class="icon-finance-100 u-line-icon-pro"></i> Shop Now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 g-px-10 g-mb-30">
      <div class="u-shadow-v21">
        <div class="g-pos-rel">
          <div class="js-carousel text-center g-rounded-50 g-bg-gray-light-v5 g-py-3" data-infinite="true" data-fade="true" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-30 g-height-30 g-color-white g-color-primary--hover g-font-size-18 g-mb-45" >
            <div class="js-slide">
              <img class="img-fluid" style="width:100%;border-radius:15px;" src="https://www.merohealthcare.com/assets/images/1596797320WhatsApp%20Image%202020-08-07%20at%204.00.14%20PM%20(1).jpeg" data-animation="zoomInDown" data-animation-delay="0" data-animation-duration="1000" alt="Image Description">
            </div>
          </div>
        </div>
        <div class="g-bg-white g-pa-10">
          <div class="text-center">
            <h4 class="g-font-size-11 text-center text-uppercase g-font-weight-600">Gatsby</h4>
            <a class="btn btn-md g-font-weight-600 g-font-size-12 text-uppercase blue" style="border-radius:25px;background-color:#dc3545;color:white;" href="/search?product=Gatsby"><i class="icon-finance-100 u-line-icon-pro"></i> Shop Now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 g-px-10 g-mb-30">
      <div class="u-shadow-v21">
        <div class="g-pos-rel">
          <div class="js-carousel text-center g-rounded-50 g-bg-gray-light-v5 g-py-3" data-infinite="true" data-fade="true" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-30 g-height-30 g-color-white g-color-primary--hover g-font-size-18 g-mb-45" >
            <div class="js-slide">
              <img class="img-fluid" style="width:100%;border-radius:15px;" src="https://www.merohealthcare.com/assets/images/1596797342WhatsApp%20Image%202020-08-07%20at%204.00.15%20PM.jpeg" data-animation="zoomInDown" data-animation-delay="0" data-animation-duration="1000" alt="Image Description">
            </div>
          </div>
        </div>
        <div class="g-bg-white g-pa-10">
          <div class="text-center">
            <h4 class="g-font-size-11 text-center text-uppercase g-font-weight-600">Morisons</h4>
            <a class="btn btn-md g-font-weight-600 g-font-size-12 text-uppercase blue" style="border-radius:25px;background-color:#dc3545;color:white;" href="/search?product=morisons"><i class="icon-finance-100 u-line-icon-pro"></i> Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  
  </div>
  </div> --}}

  {{-- <div class="text-uppercase text-center">
     ends in
    <div class="js-countdown u-countdown-v3 g-line-height-1_3 g-color-black" data-end-date="2020/08/14 8:00 PM" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S">
      <div class="d-inline-block text-center g-mx-15 mb-3">
        <div class="js-cd-days g-color-lightred g-font-weight-500 g-font-size-17">144</div>
        <span class="g-color-gray-dark-v4 g-font-size-11">Days</span>
      </div>

      <div class="hidden-down d-inline-block align-top g-font-size-15">:</div>

      <div class="d-inline-block text-center g-mx-15 mb-3">
        <div class="js-cd-hours g-font-weight-500 g-font-size-17">14</div>
        <span class="g-color-gray-dark-v4 g-font-size-11">Hours</span>
      </div>

      <div class="hidden-down d-inline-block align-top g-font-size-17">:</div>

      <div class="d-inline-block text-center g-mx-15 mb-3">
        <div class="js-cd-minutes g-font-weight-500 g-font-size-17">00</div>
        <span class="g-color-gray-dark-v4 g-font-size-11">Minutes</span>
      </div>

      <div class="hidden-down d-inline-block align-top g-font-size-15">:</div>

      <div class="d-inline-block text-center g-mx-15 mb-3">
        <div class="js-cd-seconds g-font-weight-500 g-font-size-17">41</div>
        <span class="g-color-gray-dark-v4 g-font-size-11">Seconds</span>
      </div>
    </div>
  </div>
   --}}

<style>
  .g-ma-10{
  margin:0.25rem !important;
  }
  </style>


{{-- <div class="container g-mt-15">

   <div class="" style=" border-radius:15px; padding:0px;">
    <h1 class="h4 text-center" style="font-weight:bold; color:#2385aa;padding:10px;font-weight:600;text-shadow:2px 2px 4px #95dffb;">CATEGORIES</h1>
    <div class="col-md-12 text-center">
      <div class="container">
    <div class="text-center">
    <div class="d-inline-block g-mb-30 g-width-130 g-ma-10">
      
      <article class="u-block-hover g-rounded-0">
        <div class="">
          <img class="w-100 u-block-hover__main--zoom-v1 g-rounded-15" style="height:100px" src="https://i.ndtvimg.com/i/2015-09/ayurveda-625_625x350_81441093672.jpg" alt="Image Description">
        </div>
        <div class="text-center">
          <span class="u-label g-bg-indigo g-rounded-5 g-px-15" style="font-size:10px;background:#fff !important; color:#555 !important; font-weight:600;">Ayurveda</span>
        </div>
        <a href="/category/Ayurveda" class="u-link-v2"></a>
      </article>

    </div>

    <div class="d-inline-block g-mb-30 g-width-130 g-ma-10">
      <article class="u-block-hover g-rounded-0">
        <div class="rounded">
          <img class="w-100 u-block-hover__main--zoom-v1 g-rounded-15" style="height:100px" src="https://www.lawinsport.com/media/zoo/images/Generic_Fitness_Supplements_47aa02322aab00c346292ab628a891ad.jpg" alt="Image Description">
        </div>
        <div class="text-center">
          <span class="u-label g-bg-red g-rounded-5 g-px-15" style="font-size:10px;background:#fff !important; color:#555 !important; font-weight:600;">Fitness & Suppliments</span>
        </div>
        <a href="/category/Fitness-and-Supplements" class="u-link-v2"></a>
      </article>
    </div>

    <div class="d-inline-block g-mb-30 g-width-130 g-ma-10">
      <article class="u-block-hover g-rounded-0">
        <div class="rounded">
          <img class="w-100 u-block-hover__main--zoom-v1 g-rounded-15" style="height:100px" src="https://www.whatech.com/images/featured/13426/home-healthcare-devices.jpg" alt="Image Description">
        </div>
        <div class="text-center">
          <span class="u-label g-bg-blue g-rounded-5 g-px-15" style="font-size:10px;background:#fff !important; color:#555 !important; font-weight:600;">Healthcare Devices</span>
        </div>
        <a href="/category/Healthcare-Devices" class="u-link-v2"></a>
      </article>
    </div>

    <div class="d-inline-block g-mb-30 g-width-130 g-ma-10">
      <article class="u-block-hover g-rounded-0">
        <div class="rounded">
          <img class="w-100 u-block-hover__main--zoom-v1 g-rounded-15" style="height:100px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS21BuOv09BEk8xhHtaaD-E0E5T6g2vmERt6A&usqp=CAU" alt="Image Description">
        </div>
        <div class="text-center">
          <span class="u-label g-bg-yellow g-rounded-5 g-px-15" style="font-size:10px;background:#fff !important; color:#555 !important; font-weight:600;">Mother & Baby Care</span>
        </div>
        <a href="/category/Mother-Baby" class="u-link-v2"></a>
      </article>
    </div>

    <div class="d-inline-block g-mb-30 g-width-130 g-ma-10">
      <article class="u-block-hover g-rounded-0">
        <div class="rounded">
          <img class="w-100 u-block-hover__main--zoom-v1 g-rounded-15" style="height:100px" src="https://klinegroup.com/wp-content/uploads/2010/08/personal-care-blog.jpg" alt="Image Description">
        </div>
        <div class="text-center">
          <span class="u-label g-bg-purple g-rounded-5 g-px-15" style="font-size:10px;background:#fff !important; color:#555 !important; font-weight:600;">Personal Care</span>
        </div>
        <a href="/category/Personal-care" class="u-link-v2"></a>
      </article>
      
    </div>

    <div class="d-inline-block g-mb-30 g-width-130 g-ma-10">
      <article class="u-block-hover g-rounded-0">
        <div class="rounded">
          <img class="w-100 u-block-hover__main--zoom-v1 g-rounded-15" style="height:100px" src="https://res.cloudinary.com/industry-plus/image/upload/ar_1300:542,c_scale,w_500/dpr_3.0,f_auto,q_auto/v1538662459/overview/capability/overview-capability-cropped--608" alt="Image Description">
        </div>
        <div class="text-center">
          <span class="u-label g-bg-teal g-rounded-5 g-px-15" style="font-size:10px;background:#fff !important; color:#555 !important; font-weight:600;">Surgical Care</span>
        </div>
        <a href="category/surgical-care" class="u-link-v2"></a>
      </article>
      
    </div>
    </div>
      </div>
    </div>
   </div>
</div> --}}








<div class="" style="padding: 10px;">
    <div class="section-title text-center g-mt-15" >
      <div class="g-bg-main g-brd-primary g-mb-20" style="background-color:#f3f3f3;margin-top:5px;margin-bottom:5px;">
        <h1 class="h4 " style="font-weight:bold; color:red;padding:10px;font-weight:300;text-shadow:2px 2px 4px #eb93ff;">FEATURE PRODUCT</h1>
      </div>
    
        
    </div>
    <div class="js-carousel g-pb-40" style="padding:2rem;" data-autoplay="true" data-slides-show="7" data-slides-scroll="2" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-45 g-height-45 g-font-size-default g-color-gray-dark-v5 g-bg-gray-light-v5 g-color-white--hover g-bg-primary--hover g-rounded-30" data-arrow-left-classes="fa fa-angle-left g-left-35x--lg g-left-15" data-arrow-right-classes="fa fa-angle-right g-right-35x--lg g-right-15" data-pagi-classes="u-carousel-indicators-v1 g-absolute-centered--x g-bottom-10 text-center"
        data-responsive='[{
            "breakpoint": 1050,
            "settings": {
            "slidesToShow": 4
            }
        },{
            "breakpoint": 992,
            "settings": {
            "slidesToShow": 4
            }
        }, {
            "breakpoint": 768,
            "settings": {
            "slidesToShow": 2
            }
        }, {
            "breakpoint": 554,
            "settings": {
            "slidesToShow": 2
            }
        }]'>



    @foreach($fproducts as $prod)



    <div class="js-slide g-px-5" >
 
        <div class="u-shadow-v19 u-shadow-v20--hover" style="background: white;" data-animation="fadeIn" data-animation-delay="0" data-animation-duration="1000">

        
            @php
                $name = str_replace(" ","-",$prod->name);
            @endphp
            <div class="single-product-area text-center" style="margin-bottom:0px;" >
              

           
              @php
              $prod->pprice = $prod->pprice ? : $prod->cprice;
              $prod->cprice = $prod->getPrice(1);
              @endphp
      
              @if($gs->sign == 0)
                @if($prod->discount_percent != 0)
                <div class="u-ribbon-v1 g-width-55 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-left-0 p-0" style="z-index:100;">
                  <span class="d-block g-color-white g-py-15 g-line-height-0_8" style="padding: 1px;">{{ $prod->discount_percent }}%
                    <small class="g-font-size-12">save</small>
                  </span>
                </div>
                @endif
              @endif


              @if($prod->sale_from && $prod->sale_from <= $now && $prod->sale_to >= $now)
              <div class="u-ribbon-v1 g-width-35 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-right-0 p-0" style="z-index:100;border-radius:0px;">
                <div class="js-countdown u-countdown-v3" data-end-date="{{$prod->sale_to}}" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S" style="margin-top:5px;">
                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <i class="et-icon-alarmclock u-icon-effect-v4--hover g-font-size-16" title="Offers time"></i>
                  </span>

                  <span class="d-block g-bg-white g-color-primary g-py-5">
                    <div class="d-inline-block" style="font-weight:600; font-size:14px; color:red;">
                      <div class="js-cd-days mb-0" id="dayss">00</div>
                    </div>
                    D
                  </span>
                
                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-hours mb-0" id="hourss">00 H</div>
                    </div>
                    H
                  </span>

                  <span class="d-block g-bg-white g-color-primary g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-minutes mb-0" id="minutess">00 M</div>
                    </div>
                    M
                  </span>

                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-seconds mb-0" id="secondss">00 </div>
                    </div>
                    S
                  </span>
                </div>
              </div>
              @endif

               

              <div class="product-image-area">

                @if($prod->features!=null && $prod->colors!=null)
                  @php
                  $title = explode(',', $prod->features);
                  $details = explode(',', $prod->colors);
                  @endphp
                
                @endif
                <a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}"><img src="{{asset('assets/images/'.$prod->photo)}}" alt="{{$prod->name}}" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000"></a>
                @if($prod->youtube != null)
                  <div class="product-hover-top">
                    <span class="fancybox" data-fancybox href="{{$prod->youtube}}"><i class="fa fa-play-circle"></i></span>
                  </div>
                @endif

                <div class="gallery-overlay"></div>
                <div class="gallery-border"></div>
                <div class="product-hover-area">
                  @if(Auth::guard('user')->check())
                      <input type="hidden" value="{{$prod->id}}">
                      <span class="hovertip addcart text-center" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                      </a>
                      <i class="icon-finance-100 u-line-icon-pro"></i> 
                      </span>
                  @else
                    <a class="productDetails-addCart-btn" href="{{route('user-login')}}" style="cursor: pointer;">
                        <span class="hovertip text-center" rel-toggle="tooltip" title="{{$lang->hcs}}">
                            <i class="icon-finance-100 u-line-icon-pro"></i> 
                        </span>
                    </a>
                  @endif
                </div>



              </div>
            </div>
              <div class="product-description text-center single-product-area" style="margin-top:0px;">
                <div class="product-name"><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 38 ? substr($prod->name,0,38)."..." : ucwords(strtolower($prod->name))}}</a>
                  <p class="g-color-gray-dark-v5 g-font-size-11">{{strlen($prod->company_name) > 25 ? ucwords(strtolower(substr($prod->company_name,0,25))).'...' : ucwords(strtolower(substr($prod->company_name,0,25)))}}</p>
                </div>

         
              @if($gs->sign == 0)
                <div class="product-price">{{$curr->sign}}
                    {{round($prod->cprice * $curr->value,2)}}
                  @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice)
                    <span style="display:inline; font-size:12px;color:green;"><del style="color:red" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}% </span>  
                  @endif

                </div>
              @else
                  <div class="product-price">
                    {{round($prod->cprice * $curr->value,2)}}
                    @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice)
                    <span style="display:inline; font-size:12px;color:green;"><del style="color:red" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}% </span>  
                    @endif
                    {{$curr->sign}}
                  </div>
              @endif

              


              </div>
              </div>


        </div>
        @endforeach
    </div>
</div>



<div class="" style="padding: 10px;">
    <div class="section-title text-center">
      <div class="g-bg-main g-brd-primary g-mb-20" style="background-color:#f3f3f3;margin-top:5px;margin-bottom:5px;">
        <h1 class="h4 " style="font-weight:bold; color:red;padding:10px;font-weight:300;text-shadow:2px 2px 4px #eb93ff;">BEST SELLER</h1>
      </div>
      
      </div>
    <div class="js-carousel g-pb-40" style="padding:2rem;" data-autoplay="true" data-slides-show="7" data-slides-scroll="2" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-45 g-height-45 g-font-size-default g-color-gray-dark-v5 g-bg-gray-light-v5 g-color-white--hover g-bg-primary--hover g-rounded-30" data-arrow-left-classes="fa fa-angle-left g-left-35x--lg g-left-15" data-arrow-right-classes="fa fa-angle-right g-right-35x--lg g-right-15" data-pagi-classes="u-carousel-indicators-v1 g-absolute-centered--x g-bottom-10 text-center"
        data-responsive='[{
            "breakpoint": 1050,
            "settings": {
            "slidesToShow": 4
            }
        },{
            "breakpoint": 992,
            "settings": {
            "slidesToShow": 4
            }
        }, {
            "breakpoint": 768,
            "settings": {
            "slidesToShow": 2
            }
        }, {
            "breakpoint": 554,
            "settings": {
            "slidesToShow": 2
            }
        }]'>
        @foreach($beproducts as $prod)
        
        <div class="js-slide g-px-5">
   
        <div class="u-shadow-v19 u-shadow-v20--hover" style="background: white;" data-animation="fadeIn" data-animation-delay="0" data-animation-duration="1000">
            @php
                $name = str_replace(" ","-",$prod->name);
            @endphp
            <div class="single-product-area text-center" style="margin-bottom:0px;" >

              @php
              $prod->pprice = $prod->pprice ? : $prod->cprice;
              $prod->cprice = $prod->getPrice(1);
              @endphp
      
              @if($gs->sign == 0)
                @if($prod->discount_percent != 0)
                <div class="u-ribbon-v1 g-width-55 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-left-0 p-0" style="z-index:100;">
                  <span class="d-block g-color-white g-py-15 g-line-height-0_8" style="padding: 1px;">{{ $prod->discount_percent }}%
                    <small class="g-font-size-12">save</small>
                  </span>
                </div>
                @endif
              @endif

              @if($prod->sale_from && $prod->sale_from <= $now && $prod->sale_to >= $now)
              <div class="u-ribbon-v1 g-width-35 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-right-0 p-0" style="z-index:100;border-radius:0px;">
                <div class="js-countdown u-countdown-v3" data-end-date="{{$prod->sale_to}}" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S" style="margin-top:5px;">
                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <i class="et-icon-alarmclock u-icon-effect-v4--hover g-font-size-16" title="Offers time"></i>
                  </span>

                  <span class="d-block g-bg-white g-color-primary g-py-5">
                    <div class="d-inline-block" style="font-weight:600; font-size:14px; color:red;">
                      <div class="js-cd-days mb-0" id="dayss">00</div>
                    </div>
                    D
                  </span>
                
                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-hours mb-0" id="hourss">00 </div>
                    </div>
                    H
                  </span>

                  <span class="d-block g-bg-white g-color-primary g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-minutes mb-0" id="minutess">00 </div>
                    </div>
                    M
                  </span>

                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-seconds mb-0" id="secondss">00 </div>
                    </div>
                    S
                  </span>
                </div>
              </div>
              @endif

              <div class="product-image-area" >
                @if($prod->features!=null && $prod->colors!=null)
                  @php
                  $title = explode(',', $prod->features);
                  $details = explode(',', $prod->colors);
                  @endphp
                  
                @endif
                <img src="{{asset('assets/images/'.$prod->photo)}}" alt="{{$prod->name}}" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                @if($prod->youtube != null)
                  <div class="product-hover-top">
                    <span class="fancybox" data-fancybox href="{{$prod->youtube}}"><i class="fa fa-play-circle"></i></span>
                  </div>
                @endif

                <div class="gallery-overlay"></div>
                <div class="gallery-border"></div>
                <div class="product-hover-area">
            
                  @if(Auth::guard('user')->check())
                  <input type="hidden" value="{{$prod->id}}">
                  <span class="hovertip addcart text-center" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                  </a>
                  <i class="icon-finance-100 u-line-icon-pro"></i> 
                  </span>
                  @else
                    <a class="productDetails-addCart-btn" href="{{route('user-login')}}" style="cursor: pointer;">
                        <span class="hovertip text-center" rel-toggle="tooltip" title="{{$lang->hcs}}">
                            <i class="icon-finance-100 u-line-icon-pro"></i> 
                        </span>
                    </a>
                  @endif
               
                </div>



              </div>
            </div>
              <div class="product-description text-center single-product-area" style="margin-top:0px;">
                <div class="product-name" ><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 38 ? substr($prod->name,0,38)."..." : ucwords(strtolower($prod->name))}}</a>
                  <p class="g-color-gray-dark-v5 g-font-size-11">{{strlen($prod->company_name) > 25 ? ucwords(strtolower(substr($prod->company_name,0,25))).'...' : ucwords(strtolower(substr($prod->company_name,0,25)))}}</p>
                </div>
         
                @if($gs->sign == 0)
                    <div class="product-price">{{$curr->sign}}
                      {{round($prod->cprice * $curr->value,2)}}
                      @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                        <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                      @endif

                    </div>
                @else
                    <div class="product-price">
                      {{round($prod->cprice * $curr->value,2)}}
                      @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                        <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                      @endif
                      {{$curr->sign}}
                    </div>
                @endif
              </div>
              </div>


        </div>
        @endforeach
    </div>
</div>


<div class="" style="padding: 10px;">
    <div class="section-title text-center">
      <div class="g-bg-main g-brd-primary g-mb-20" style="background-color:#f3f3f3;margin-top:5px;margin-bottom:5px;">
     
      <h1 class="h4 " style="font-weight:bold; color:red;padding:10px;font-weight:300;text-shadow:2px 2px 4px #eb93ff;">TOP RATED</h1>
      </div>
     
      </div>
    <div class="js-carousel g-pb-40" style="padding:2rem;" data-autoplay="true" data-slides-show="7" data-slides-scroll="2" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-45 g-height-45 g-font-size-default g-color-gray-dark-v5 g-bg-gray-light-v5 g-color-white--hover g-bg-primary--hover g-rounded-30" data-arrow-left-classes="fa fa-angle-left g-left-35x--lg g-left-15" data-arrow-right-classes="fa fa-angle-right g-right-35x--lg g-right-15" data-pagi-classes="u-carousel-indicators-v1 g-absolute-centered--x g-bottom-10 text-center"
        data-responsive='[{
            "breakpoint": 1050,
            "settings": {
            "slidesToShow": 4
            }
        },{
            "breakpoint": 992,
            "settings": {
            "slidesToShow": 4
            }
        }, {
            "breakpoint": 768,
            "settings": {
            "slidesToShow": 2
            }
        }, {
            "breakpoint": 554,
            "settings": {
            "slidesToShow": 2
            }
        }]'>
    @foreach($tproducts as $prod)
 

    <div class="js-slide g-px-5">

        <div class="u-shadow-v19 u-shadow-v20--hover" style="background: white;" data-animation="fadeIn" data-animation-delay="0" data-animation-duration="1000">
            @php
                $name = str_replace(" ","-",$prod->name);
            @endphp
            <div class="single-product-area text-center" style="margin-bottom:0px;" >
              @php
              $prod->pprice = $prod->pprice ? : $prod->cprice;
              $prod->cprice = $prod->getPrice(1);
              @endphp
      
              @if($gs->sign == 0)
                @if($prod->discount_percent != 0)
                <div class="u-ribbon-v1 g-width-55 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-left-0 p-0" style="z-index:100;">
                  <span class="d-block g-color-white g-py-15 g-line-height-0_8" style="padding: 1px;">{{ $prod->discount_percent }}%
                    <small class="g-font-size-12">save</small>
                  </span>
                </div>
                @endif
              @endif

              @if($prod->sale_from && $prod->sale_from <= $now && $prod->sale_to >= $now)
              <div class="u-ribbon-v1 g-width-35 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-right-0 p-0" style="z-index:100;border-radius:0px;">
                <div class="js-countdown u-countdown-v3" data-end-date="{{$prod->sale_to}}" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S" style="margin-top:5px;">
                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <i class="et-icon-alarmclock u-icon-effect-v4--hover g-font-size-16" title="Offers time"></i>
                  </span>

                  <span class="d-block g-bg-white g-color-primary g-py-5">
                    <div class="d-inline-block" style="font-weight:600; font-size:14px; color:red;">
                      <div class="js-cd-days mb-0" id="dayss">00</div>
                    </div>
                    D
                  </span>
                
                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-hours mb-0" id="hourss">00 H</div>
                    </div>
                    H
                  </span>

                  <span class="d-block g-bg-white g-color-primary g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-minutes mb-0" id="minutess">00 M</div>
                    </div>
                    M
                  </span>

                  <span class="d-block g-bg-primary g-color-white g-py-5">
                    <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                      <div class="js-cd-seconds mb-0" id="secondss">00 </div>
                    </div>
                    S
                  </span>
                </div>
              </div>
              @endif

              <div class="product-image-area">
                @if($prod->features!=null && $prod->colors!=null)
                  @php
                  $title = explode(',', $prod->features);
                  $details = explode(',', $prod->colors);
                  @endphp
              
                @endif
                <img src="{{asset('assets/images/'.$prod->photo)}}" alt="{{$prod->name}}" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
                @if($prod->youtube != null)
                  <div class="product-hover-top">
                    <span class="fancybox" data-fancybox href="{{$prod->youtube}}"><i class="fa fa-play-circle"></i></span>
                  </div>
                @endif

                <div class="gallery-overlay"></div>
                <div class="gallery-border"></div>
                <div class="product-hover-area">
                  
                  @if(Auth::guard('user')->check())
                  <input type="hidden" value="{{$prod->id}}">
                  <span class="hovertip addcart text-center" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                  </a>
                  <i class="icon-finance-100 u-line-icon-pro"></i> 
                  </span>
                  @else
                    <a class="productDetails-addCart-btn" href="{{route('user-login')}}" style="cursor: pointer;">
                        <span class="hovertip text-center" rel-toggle="tooltip" title="{{$lang->hcs}}">
                            <i class="icon-finance-100 u-line-icon-pro"></i> 
                        </span>
                    </a>
                  @endif
                </div>



              </div>
            </div>
              <div class="product-description text-center single-product-area" style="margin-top:0px;">
                <div class="product-name" ><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 38 ? substr($prod->name,0,38)."..." : ucwords(strtolower($prod->name))}}</a>
               
                  <p class="g-color-gray-dark-v5 g-font-size-11">{{strlen($prod->company_name) > 25 ? ucwords(strtolower(substr($prod->company_name,0,25))).'...' : ucwords(strtolower(substr($prod->company_name,0,25)))}}</p>
                </div>
         
                @if($gs->sign == 0)
                    <div class="product-price">{{$curr->sign}}
                      {{round($prod->cprice * $curr->value,2)}}
                      @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                        <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                      @endif

                    </div>
                @else
                    <div class="product-price">
                      {{round($prod->cprice * $curr->value,2)}}
                      @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                        <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                      @endif
                      {{$curr->sign}}
                    </div>
                @endif
              </div>
              </div>
  

        </div>
        @endforeach
    </div>
</div>

<div class="" style="padding: 10px; margin-bottom:20px;">
  <div class="section-title text-center">
    <div class="g-bg-main g-brd-primary g-mb-20" style="background-color:#f3f3f3;margin-top:5px;margin-bottom:5px;">
      <h1 class="h4 " style="font-weight:bold; color:red;padding:10px;font-weight:300;text-shadow:2px 2px 4px #eb93ff;">HOT SALES</h1>
    </div>
     
    </div>
  <div class="js-carousel g-pb-40" style="padding:2rem;" data-autoplay="true" data-slides-show="7" data-slides-scroll="2" data-arrows-classes="u-arrow-v1 g-pos-abs g-bottom-0 g-width-45 g-height-45 g-font-size-default g-color-gray-dark-v5 g-bg-gray-light-v5 g-color-white--hover g-bg-primary--hover g-rounded-30" data-arrow-left-classes="fa fa-angle-left g-left-35x--lg g-left-15" data-arrow-right-classes="fa fa-angle-right g-right-35x--lg g-right-15" data-pagi-classes="u-carousel-indicators-v1 g-absolute-centered--x g-bottom-10 text-center"
      data-responsive='[{
          "breakpoint": 1050,
          "settings": {
          "slidesToShow": 4
          }
      },{
          "breakpoint": 992,
          "settings": {
          "slidesToShow": 4
          }
      }, {
          "breakpoint": 768,
          "settings": {
          "slidesToShow": 2
          }
      }, {
          "breakpoint": 554,
          "settings": {
          "slidesToShow": 2
          }
      }]'>
      @foreach($hproducts as $prod)
     

      <div class="js-slide g-px-5">

      <div class="u-shadow-v19 u-shadow-v20--hover" style="background: white;" data-animation="fadeIn" data-animation-delay="0" data-animation-duration="1000">
          @php
              $name = str_replace(" ","-",$prod->name);
          @endphp
          <div class="single-product-area text-center" style="margin-bottom:0px;" >

            @php
            $prod->pprice = $prod->pprice ? : $prod->cprice;
            $prod->cprice = $prod->getPrice(1);
            @endphp
    
            @if($gs->sign == 0)
              @if($prod->discount_percent != 0)
              <div class="u-ribbon-v1 g-width-55 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-left-0 p-0" style="z-index:100;">
                <span class="d-block g-color-white g-py-15 g-line-height-0_8" style="padding: 1px;">{{ $prod->discount_percent }}%
                  <small class="g-font-size-12">save</small>
                </span>
              </div>
              @endif
            @endif

            @if($prod->sale_from && $prod->sale_from <= $now && $prod->sale_to >= $now)
            <div class="u-ribbon-v1 g-width-35 g-bg-primary g-font-weight-600 g-font-size-17 g-top-0 g-right-0 p-0" style="z-index:100;border-radius:0px;">
              <div class="js-countdown u-countdown-v3" data-end-date="{{$prod->sale_to}}" data-month-format="%m" data-days-format="%D" data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S" style="margin-top:5px;">
                <span class="d-block g-bg-primary g-color-white g-py-5">
                  <i class="et-icon-alarmclock u-icon-effect-v4--hover g-font-size-16" title="Offers time"></i>
                </span>

                <span class="d-block g-bg-white g-color-primary g-py-5">
                  <div class="d-inline-block" style="font-weight:600; font-size:14px; color:red;">
                    <div class="js-cd-days mb-0" id="dayss">00</div>
                  </div>
                  D
                </span>
              
                <span class="d-block g-bg-primary g-color-white g-py-5">
                  <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                    <div class="js-cd-hours mb-0" id="hourss">00 H</div>
                  </div>
                  H
                </span>

                <span class="d-block g-bg-white g-color-primary g-py-5">
                  <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                    <div class="js-cd-minutes mb-0" id="minutess">00 M</div>
                  </div>
                  M
                </span>

                <span class="d-block g-bg-primary g-color-white g-py-5">
                  <div class="d-inline-block " style="font-weight:600; font-size:14px;">
                    <div class="js-cd-seconds mb-0" id="secondss">00 </div>
                  </div>
                  S
                </span>
              </div>
            </div>
            @endif

            <div class="product-image-area" >
              @if($prod->features!=null && $prod->colors!=null)
                @php
                $title = explode(',', $prod->features);
                $details = explode(',', $prod->colors);
                @endphp
            
              @endif
              <img src="{{asset('assets/images/'.$prod->photo)}}" alt="{{$prod->name}}" data-animation="zoomIn" data-animation-delay="0" data-animation-duration="1000">
              @if($prod->youtube != null)
                <div class="product-hover-top">
                  <span class="fancybox" data-fancybox href="{{$prod->youtube}}"><i class="fa fa-play-circle"></i></span>
                </div>
              @endif

              <div class="gallery-overlay"></div>
              <div class="gallery-border"></div>
              <div class="product-hover-area">
                
                @if(Auth::guard('user')->check())
                <input type="hidden" value="{{$prod->id}}">
                <span class="hovertip addcart text-center" rel-toggle="tooltip" title="{{$lang->hcs}}"><a class="productDetails-addCart-btn" id="addcrt" href="javascript:;" style="cursor: pointer;">
                </a>
                <i class="icon-finance-100 u-line-icon-pro"></i> 
                </span>
                @else
                  <a class="productDetails-addCart-btn" href="{{route('user-login')}}" style="cursor: pointer;">
                      <span class="hovertip text-center" rel-toggle="tooltip" title="{{$lang->hcs}}">
                          <i class="icon-finance-100 u-line-icon-pro"></i> 
                      </span>
                  </a>
                @endif
              </div>

            </div>
          </div>
            <div class="product-description text-center single-product-area" style="margin-top:0px;">
              <div class="product-name" ><a href="{{route('front.product',['id' => $prod->id, 'slug' => str_slug($name,'-')])}}" class="text-center">{{strlen($prod->name) > 38 ? substr($prod->name,0,38)."..." : ucwords(strtolower($prod->name))}}</a>
                <p class="g-color-gray-dark-v5 g-font-size-11">{{strlen($prod->company_name) > 25 ? ucwords(strtolower(substr($prod->company_name,0,25))).'...' : ucwords(strtolower(substr($prod->company_name,0,25)))}}</p>

              </div>
       
              @if($gs->sign == 0)
                  <div class="product-price">{{$curr->sign}}
                    {{round($prod->cprice * $curr->value,2)}}
                    @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                      <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                    @endif

                  </div>
              @else
                  <div class="product-price">
                    {{round($prod->cprice * $curr->value,2)}}
                    @if($prod->pprice != null && $prod->pprice != 0  && $prod->pprice > $prod->cprice) 
                      <span style="display:inline; font-size:12px; color:green;"><del style="color:red;" class="offer-price">{{$curr->sign}}{{round($prod->pprice * $curr->value,2)}}</del> -{{ $prod->discount_percent }}%</span>

                    @endif
                    {{$curr->sign}}
                  </div>
              @endif
            </div>
            </div>


      </div>
      @endforeach
  </div>
</div>




    @php
    $adv = App\Advertise::where('status','=','1')->get();
  @endphp

<div id="offer" class="modal" style="border-radius:15px;" >
    <div class="modal-dialog modal-md" style="border-radius:15px;" >
        <div class="modal-content" id="adv-mobile" style="border-radius:15px;">
          
            <div class="modal-body" style="padding:0px;border-radius:15px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute;right: 5px;top: 5px;z-index: 100;"><i class="icon-close g-font-size-30" ></i></button>
                {{-- <div class="js-carousel text-center g-pb-0" id="mainslider-mobile" data-autoplay="true" data-ride="carousel" data-infinite="true" data-arrows-classes="u-arrow-v1 g-absolute-centered--y g-font-size-40 g-color-gray g-mt-minus-10" data-arrow-left-classes="fa fa-angle-left g-left-0" data-arrow-right-classes="fa fa-angle-right g-right-0" style="background: transparent !important;height:35rem;width:auto;">
                    @foreach($adv as $a)
                        <div class="js-slide" style="background: transparent !important;width:auto; border-radius:15px;" >
                            <a class="js-fancybox" href="{{$a->url}}" target="__blank" data-slide="prev" data-fancybox="lightbox-gallery--07-1" data-src="/frontend-assets/main-assets/assets/img-temp/900x600/img5.jpg" data-caption="Lightbox Gallery" data-animate-in="zoomInDown" data-animate-out="bounceOutDown" data-speed="2000" data-overlay-blur-bg="true" style="background: transparent !important;" >

                                  <div class="" style="width:auto;height:auto;">
                                   <img id="adv-img-mobile" style="width:100%; height:35rem;border-radius:15px;" src="{{asset('assets/images/'.$a->photo)}}" alt="{{$a->photo}}">
                                  </div>
                            </a>
                        </div>
                    @endforeach
            
            </div> --}}

            <div class="text-center" style="width:auto;height:auto;">
            <a href="{{route('user-login')}}"><img id="adv-img-mobile" style="width:25rem; height:40rem;border-radius:15px;" src="https://www.merohealthcare.com/assets/images/1598684998WhatsApp%20Image%202020-08-29%20at%2012.06.31%20PM.jpeg"></a>
             </div>
            </div>
        </div>
    </div>
  </div>

  {{-- <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall g-overflow-hidden" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
  
    <div style="height: 200%; background-image: url(&quot;../../assets/img/bg/pattern6-2.png&quot;); transform: translate3d(0px, -145.635px, 0px);" class="divimage dzsparallaxer--target w-100 g-bg-repeat g-bg-gray-light-v4"></div>
   

    <div class="container g-z-index-1 g-py-100">
      <h1 class="g-font-weight-300 g-letter-spacing-1 g-mb-15">How it works ?</h1>

      <div class="lead g-font-weight-400 g-line-height-2 g-letter-spacing-0_5">
        <div class="row">
          <div class="col-lg-4 g-mb-30">
         
            <div class="u-shadow-v19 g-bg-white rounded g-pa-20">
              <div class="media">
                <div class="d-flex align-self-center mr-3">
                  <span class="u-icon-v3 g-bg-lightred g-color-white g-rounded-50x">
                    <i class="icon-wallet"></i>
                  </span>
                </div>
                <div class="media-body align-self-center">
                  <p class="mb-0">
                    <span class="g-font-weight-700">Discount up to 20%</span>
                   
                  </p>
                  
                </div>
              </div>
            </div>
          
          </div>
        
          <div class="col-lg-4 g-mb-30">
     
            <div class="u-shadow-v19 g-bg-white rounded g-pa-20">
              <div class="media">
                <div class="d-flex align-self-center mr-3">
                  <span class="u-icon-v3 g-bg-blue g-color-white g-rounded-50x">
                    <i class="icon-transport-069 u-line-icon-pro"></i>
                  </span>
                </div>
                <div class="media-body align-self-center">
                  <p class="mb-0">
                    <span class="g-font-weight-700">Free Delivery Above Rs.500 </span>
              
                  </p>

                </div>
              </div>
            </div>
           
          </div>
        
          <div class="col-lg-4 g-mb-30">
 
            <div class="u-shadow-v19 g-bg-white rounded g-pa-20">
              <div class="media">
                <div class="d-flex align-self-center mr-3">
                  <span class="u-icon-v3 g-bg-orange g-color-white g-rounded-50x">
                    <i class="icon-finance-260 u-line-icon-pro"></i>
                  </span>
                </div>
                <div class="media-body align-self-center">
                  <p class="mb-0">
                    <span class="g-font-weight-700">Cash On Delivery</span>
                 
                  </p>
             
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </section>
 --}}



<div class="LoaderBalls">
	<div class="LoaderBalls__item"></div>
	<div class="LoaderBalls__item"></div>
	<div class="LoaderBalls__item"></div>
</div>

@endsection

@section('scripts')

<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script  src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
<script>
    $(document).on("click", ".addcart" , function(){
        var pid = $(this).parent().find('input[type=hidden]').val();
            $.ajax({
                    type: "GET",
                    url:"{{URL::to('/json/addcart')}}",
                    data:{id:pid},
                    success:function(data){
                        if(data == 0)
                        {
                            $.notify("{{$gs->cart_error}}","error");
                        }
                        else
                        {
                        $(".empty").html("");
                        $(".total").html((data[0] * {{$curr->value}}).toFixed(2));
                        $(".cart-quantity").html(data[2]);
                        var arr = $.map(data[1], function(el) {
                        return el });
                        $(".cart").html("");
                        for(var k in arr)
                        {
                            var x = arr[k]['item']['name'];
                            var p = x.length  > 45 ? x.substring(0,45)+'...' : x;
                            var measure = arr[k]['item']['measure'] != null ? arr[k]['item']['measure'] : "";
                            $(".cart").append(
                            '<div class="single-myCart">'+
            '<p class="cart-close" onclick="remove('+arr[k]['item']['id']+')"><i class="fa fa-close"></i></p>'+
                            '<div class="cart-img">'+
                    '<img src="{{ asset('assets/images/') }}/'+arr[k]['item']['photo']+'" alt="Product image">'+
                            '</div>'+
                            '<div class="cart-info">'+
        '<a href="{{url('/')}}/product/'+arr[k]['item']['id']+'/'+arr[k]['item']['name']+'" style="color: black; padding: 0 0;">'+'<h5>'+p+'</h5></a>'+
                        '<p>{{$lang->cquantity}}: <span id="cqt'+arr[k]['item']['id']+'">'+arr[k]['qty']+'</span> '+measure+'</p>'+
                        @if($gs->sign == 0)
                        '<p>{{$curr->sign}}<span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span></p>'+
                        @else
                        '<p><span id="prct'+arr[k]['item']['id']+'">'+(arr[k]['price'] * {{$curr->value}}).toFixed(2)+'</span>{{$curr->sign}}</p>'+
                        @endif
                        '</div>'+
                        '</div>'
                        );
                          }
                        $.notify("{{$gs->cart_success}}","success");
                        }
                    },
                    error: function(data){
                        if(data.responseJSON)
                        $.notify(data.responseJSON.error,"error");
                        else
                        $.notify('Something went wrong',"error");
  
                    }
              }); 
        return false;
    });
  
   
  
    </script>


@if($prod->sale_from && $prod->sale_from <= $now && $prod->sale_to >= $now)
  <script type="text/javascript">
    function makeTimer() {

      var endTime = new Date("{{ $prod->sale_to }}");
        endTime = (Date.parse(endTime) / 1000);

        var now = new Date();
        now = (Date.parse(now) / 1000);

        var timeLeft = endTime - now;

        if(timeLeft<0) return;

        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

        if (hours < "10") { hours = "0" + hours; }
        if (minutes < "10") { minutes = "0" + minutes; }
        if (seconds < "10") { seconds = "0" + seconds; }

        $("#dayss").html(days);
        $("#hourss").html(hours);
        $("#minutess").html(minutes);
        $("#secondss").html(seconds);

    }

    setInterval(function() { makeTimer(); }, 1000);

  </script>
@endif

<script  src="{{asset('frontend-assets/main-assets/assets/vendor/jquery.countdown.min.js')}}"></script>

  <!-- JS Unify -->
  <script  src="{{asset('frontend-assets/main-assets/assets/js/components/hs.countdown.js')}}"></script>

  <!-- JS Plugins Init. -->
  <script >
    $(document).on('ready', function () {
      // initialization of countdowns
      var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
        yearsElSelector: '.js-cd-years',
        monthElSelector: '.js-cd-month',
        daysElSelector: '.js-cd-days',
        hoursElSelector: '.js-cd-hours',
        minutesElSelector: '.js-cd-minutes',
        secondsElSelector: '.js-cd-seconds'
      });
    });
  </script>


    <script>
        $(window).on('load',function() {
            setTimeout(function(){

                $('#extraData').load('{{route('front.extraIndex')}}');

            }, 500);
        });
    

        $('.slider').slick({
  autoplay: false,
  speed: 1600,
  lazyLoad: 'progressive',
  arrows: false,
  dots: true,
}).slickAnimation();

    </script>
    <script>
      $(document).ready(function(){
  
        $(".Modern-Slider").slick({
    autoplay:true,
    autoplaySpeed:10000,
    speed:1000,
    slidesToShow:1,
    slidesToScroll:1,
    pauseOnHover:false,
    dots:true,
    pauseOnDotsHover:true,
    cssEase:'linear',
   // fade:true,
    draggable:false,
    prevArrow:'<button class="PrevArrow"></button>',
    nextArrow:'<button class="NextArrow"></button>',
  });
  
})
      </script>

      <script>
        $(document).ready(function(){
			$('.customer-logos').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 3000,
				arrows: false,
				dots: false,
					pauseOnHover: false,
					responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 3
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 2
					}
				}]
			});
		});
        </script>

<script>
    // $(window).on('load',function(){
    //       $('#offer').modal('show');
    //   });

//       $(document).ready(function() {
//     if(localStorage.getItem('popState') != 'shown'){
//         $("#offer").delay(2000).fadeIn();
//         localStorage.setItem('popState','shown')
//     }

//     $('#popup-close').click(function(e) // You are clicking the close button
//     {
//     $('#offer').fadeOut(); // Now the pop up is hiden.
//     });
//     $('#offer').click(function(e) 
//     {
//     $('#offer').fadeOut(); 
//     });
// });


  </script>

      <!-- JS Implementing Plugins -->
      <script  src="frontend-assets/main-assets/assets/vendor/fancybox/jquery.fancybox.min.js"></script>

      <!-- JS Unify -->
      <script  src="frontend-assets/main-assets/assets/js/components/hs.popup.js"></script>

      <!-- JS Plugins Init. -->
      <script >
        $(document).on('ready', function () {
          // initialization of popups
          $.HSCore.components.HSPopup.init('.js-fancybox');
        });
      </script>


    
@endsection
