@extends('layouts.front')
@section('title','Blog Posts')
@section('content')


    <!-- Starting of Section title overlay area -->
    <div class="title-overlay-wrap overlay" style="background-image: url({{asset('assets/images/'.$gs->bgimg)}});">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
         
          </div>
        </div>
      </div>
    </div>
    <!-- Ending of Section title overlay area -->

    <div class="section-padding blog-wrap" style="background-color:white;">
  
            <div class="container">
            <h1 class="text-center">Blogs</h1>
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
                    @foreach($blogs as $blogg)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <div class="container" >
                      <a href="{{route('front.blogshow',$blogg->slug)}}" class="blog" style="margin-bottom: 30px;border-radius:30px;">
                        <div class="blog__img" style="border-top-right-radius:30px;border-top-left-radius:30px;">
                          <img src="{{asset('assets/images/'.$blogg->photo)}}" alt="blog image">
                        </div>
                        <div class="blog__content text-center">
                          <div class="blog__meta" style="border-radius:30px;">{{date('jS M, Y', strtotime($blogg->created_at))}}</div>
                          <div class="blog__title">{{strlen($blogg->title) > 80 ? substr($blogg->title,0,80)."...":$blogg->title}}</div>
                          <p>{{substr(strip_tags($blogg->details),0,80)}}...</p>
                          <span class="blog__footer" style="background: #ececec;padding: 10px 0px;border-radius: 30px;color: #777;"><i class="icon-size-fullscreen" style="color:#777;"></i> {{$lang->vd}}</span>
                        </div>
                        </div>
                      </a>
                   </div>
                    @endforeach


                     </div>
                    <div class="text-center">
                    {!! $blogs->links() !!}                 
                    </div>
                </div>
            </div>

@endsection