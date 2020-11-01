@extends('layouts.front')
@section('title','Promotions')
@section('content')
<style>
    #promotion{
        font-weight: 700;
        color:#2385aa !important;
    }
</style>



    <!-- Starting of Section title overlay area -->
    <div class="title-overlay-wrap overlay" style="background-image: url({{asset('assets/images/'.$gs->bgimg)}});">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Promotions</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of Section title overlay area -->

    <div class="section-padding blog-wrap">

        <div class="g-mx-20">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-title pb_50 text-center">

                        <div class="section-borders">
                            <span></span>
                            <span class="black-border"></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($promotions as $promotion)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <a href="{{ $promotion->link }}" class="blog" style="margin-bottom: 30px;">
                            <div class="blog__img">
                                <img src="{{ asset('assets/images/'.$promotion->photo) }}" alt="blog image">
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
                
        </div>
    </div>

@endsection