<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}"> 
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}"> 
    @else
        <meta name="keywords" content="{{ $seo->meta_keys }}">
    @endif
    <meta name="author" content="GeniusOcean">
    <title>{{$gs->title}}</title>
    <!-- Font Awesome CSS -->
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Rubik:300,400,500,700,900');
    </style>
    <link rel="stylesheet" href="{{asset('assets/front/css/all.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}"> 

    @include('styles.design') 

    @yield('styles')

    <style type="text/css">
        .home-service-wrapper {
            box-shadow: 0 0 5px #fff;
        }
    </style>

</head>

