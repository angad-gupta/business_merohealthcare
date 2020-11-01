<!DOCTYPE html>
<html lang="en">

<head>

      <!-- Google Tag Manager -->
    {{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WHJLDQ4');</script> --}}
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
    @elseif(isset($product->meta_tag) && isset($product->meta_description))
        <meta name="keywords" content="{{ $product->meta_tag }}">
        <meta name="description" content="{{ $product->meta_description }}">
    @elseif(isset($home))
        <meta name="description" content="Business Merohealthcare is an online pharmacy to buy medicine and healthcare products in Kathmandu-Nepal. We offer home delivery service. DISCOUNTS available.">
        <meta name="keywords" content="Online Pharmacy, Buy Medicine in Kathmandu-Nepal, Healthcare Products">
    @endif

    @if(isset($home))
        <title>@yield('title','Home') </title>
    @else
        <title>@yield('title','Home') | {{$gs->title}}</title>

    @endif


    <!-- Font Awesome CSS -->
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Rubik:300,400,500,700,900');
    </style>
    <link rel="stylesheet" href="{{asset('assets/front/css/all.css')}}">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}">

    @include('styles.design')

    @yield('styles')

    <style type="text/css">

        .login-form .form-control, .login-form button {
                    height: 40px;
                    border-radius: 30px;
                }
        .home-service-wrapper {
            box-shadow: 0 0 5px #fff;
        }
        .pac-container{
            z-index: 1050 !important;
        }
        .u-nav-v4-1.u-nav-primary .nav-link.active {
            background-color: white;
        }


    </style>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="/frontend-assets/main-assets/favicon.ico">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/bootstrap/bootstrap.min.css">
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line/css/simple-line-icons.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-etlinefont/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-hs/style.css">

  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/hamburgers/hamburgers.min.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/animate.css">
  <!-- CSS Unify -->
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-core.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-components.css">
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-globals.css">

  <link  rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/custombox/custombox.min.css">


  <!-- CSS Customization -->
  <link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/custom.css">
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">



  <style>
      .invalid-feedback{
        display:inline;
    }

    .login-form label {
    color: #666;
    font-size: 13px;
    font-weight: 500;
}
    </style>
  @yield('css')


  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e8c318da1c1430012f50dc8&product=inline-share-buttons&cms=sop' async='async'></script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHJLDQ4"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

