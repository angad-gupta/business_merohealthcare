@extends('layouts.front')
@section('title',$blog->title.' - Blog')

@section('content')

<style>
.blog-post-wrapper img {
    width: 100%;
    margin-top: 0px;
    margin-bottom: 20px;
}
.post-heading {
    border-bottom: 1px solid #555;
    padding-bottom: 10px;
    margin-bottom: 25px;
}
</style>

    <!-- Starting of Section title overlay area -->
    <!-- <div class="title-overlay-wrap overlay" style="background-image: url({{asset('assets/images/'.$gs->bgimg)}});">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h1>{{$lang->blogss}}</h1>
          </div>
        </div>
      </div>
    </div> -->
    <!-- Ending of Section title overlay area -->
<div class="section-padding blog-post-wrapper" style="padding:15px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
            @if(strlen($blog->title) > 50)
              @if($lang->rtl == 1)
              <h1 class="h4 g-font-weight-600" style="color:#977041;" dir="rtl">{{$blog->title}}</h1>
              @else
              <h1 class="h4 g-font-weight-600" style="color:#977041;">{{$blog->title}}</h1>
              @endif
            @else
              @if($lang->rtl == 1)
              <h1 dir="rtl" class="h4 g-font-weight-600" style="color:#977041;">{{$blog->title}}</h1>
              @else
              <h1 class="h4 g-font-weight-600" style="color:#977041;">{{$blog->title}}</h1>
              @endif
            @endif
                            <li style="font-size:14px;color: cadetblue;">{{$lang->bs}}: {{$blog->source}} .</li>
                            <ul>
                                <li style="font-size:14px;color:chocolate;"><i class="icon-clock"></i> {{$blog->created_at->diffForHumans()}} .</li>
                            
                                <li style="font-size:14px;color:#2385aa;"><i class="icon-eye"></i> {{$blog->views}} </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                  @if($lang->rtl == 1)
                    <div class="col-md-4">
                       <div class="post-sidebar-area" >
                           <h2 class="post-heading" dir="rtl">{{$lang->blogsss}}</h2>
                           <ul>
                              @foreach($lblogs->where('id','!=',$blog->id) as $lblog)
                               <li>
                                   <div class="row post-row">
                                       <div class="col-xs-8">
                                           <p class="post-meta-date">{{date('d M Y',(strtotime($lblog->created_at)))}}</p>
                                           <a href="{{route('front.blogshow',$lblog->slug)}}">{{strlen($lblog->title) > 30 ? substr($lblog->title,0,30)."..." : $lblog->title}}</a>
                                       </div>
                                       <div class="col-xs-4">

                                           <img src="{{asset('assets/images/'.$lblog->photo)}}" alt="{{$lblog->title}}">
                                       </div>
                                   </div>
                               </li>
                               @endforeach
                           </ul>
                       </div>
                   </div>
                    <div class="col-md-8">
                        <p><img src="{{asset('assets/images/'.$blog->photo)}}" alt="{{$lblog->title}}"></p>
                        <div class="entry-content" dir="{{$lang->rtl == 1 ? 'rtl':''}}">
                          {!!$blog->details!!}
                        </div>

                        @if($blog->filename != null)
                        @php
                        $decoded = json_decode($blog->filename, true);
                        @endphp

                        <div class="container" style="margin-top:10px;">
                        <span><strong style="font-size:15px;margin-top:15px;"> Attachments :</strong></span>
                        </div>
                        @foreach((array)$decoded as $d)
                        <a class="btn btn-primary" href="{{route('blog-file',$d)}}" target="_blank" download><i class="fa fa-file"></i> {{str_limit($d, $limit = 10, $end = '...')}}</a>
                        @endforeach
                    @endif

                        <div class="sharethis-inline-share-buttons" >
                            <style>
                              #st-el-3 .st-btns {
                                bottom: 56px;
                                left: 0;
                                margin: 100px auto 0;
                                max-width: 90%;
                                position: absolute;
                                right: 0;
                                text-align: center;
                                top: 10px !important;
                                z-index: 20;
                                overflow-y: auto;
                            }
                            </style>
                          </div>

                          <h4 style="margin-top:2rem;" class="text-center">Share with</h4>
                {{-- <div id="shareRoundIcons" class="text-center" >

                </div> --}}
                <div class="sharethis-inline-share-buttons" >
                  <style>
                    #st-el-3 .st-btns {
                      bottom: 56px;
                      left: 0;
                      margin: 100px auto 0;
                      max-width: 90%;
                      position: absolute;
                      right: 0;
                      text-align: center;
                      top: 10px !important;
                      z-index: 20;
                      overflow-y: auto;
                  }
                  </style>
                </div>
{{-- 
                        <div class="social-sharing a2a_kit a2a_kit_size_32" dir="rtl">
                            <a class="facebook a2a_button_facebook" href=""><i class="fa fa-facebook"></i> Share </a>
                            <a class="twitter a2a_button_twitter" href=""><i class="fa fa-twitter"></i> Tweet</a>
                            <a class="pinterest a2a_button_google_plus" href=""><i class="fa fa-pinterest"></i> Pinterest</a>
                            <a class="a2a_dd" href="https://www.addtoany.com/share" style="position: absolute; background-color: rgb(1, 102, 255); "></a>
                        </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script> --}}

                        <div dir="rtl" class="blog-comments-msg-area">
                            <h2>{{$lang->contacts}}</h2>
                            <hr>
                             @include('includes.form-success') 
                            <form action="{{route('front.contact.submit')}}" method="POST">
                                <input type="hidden" name="to" value="{{$ps->contact_email}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">{{$lang->con}}</label>
                                    <input class="form-control" name="name" placeholder="" required="" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{$lang->coe}}</label>
                                    <input class="form-control" name="email" placeholder="" required="" type="email">
                                </div>
                                <div class="form-group">
                                    <label for="message">{{$lang->cor}}</label>
                                    <textarea name="message" class="form-control" id="comments-msg" rows="5" style="resize: vertical;" required=""></textarea>
                                </div>
                                    <div class="row">
                                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <span style="cursor: pointer;" class="refresh_code"><i class="fa fa-refresh fa-2x" style="margin-top: 10px;"></i></span>
                                        </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <img id="codeimg" src="{{url('assets/images')}}/capcha_code.png">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-lg-push-8 col-md-4 col-md-push-8 col-sm-4 col-sm-push-8">

                                            <input class="form-control" name="codes" placeholder="Enter Code" required="" type="text">
                                        </div>
                                    </div>
                                    <br>
                                <div class="form-group">
                                    <button class="btn blog-btn comments" type="submit">{{$lang->sm}}</button>
                                </div>
                            </form>
                        </div>  
                        </div>
                  @else
                    <div class="col-md-8">
                        <p><img src="{{asset('assets/images/'.$blog->photo)}}" alt=""></p>
                        <div class="entry-content" dir="{{$lang->rtl == 1 ? 'rtl':''}}">
                          {!!$blog->details!!}
                        </div>

                        
                        @if($blog->filename != null)
                            @php
                            $decoded = json_decode($blog->filename, true);
                            @endphp


                            <div class="container" style="margin-top:10px;">
                        <span><strong style="font-size:15px;margin-top:15px;"> Attachments :</strong></span>
                        </div>
                            @foreach((array)$decoded as $d)
                            <a class="btn btn-primary" style="border-radius:30px;" href="{{route('blog-file',$d)}}" target="_blank" download><i class="fa fa-file"></i> {{str_limit($d, $limit = 10, $end = '...')}}</a>
                            @endforeach
                        @endif

                        <h4 style="margin-top:2rem;" class="text-left">Share with</h4>
              
                        <div class="sharethis-inline-share-buttons pull-left" >
                        <style>
                            #st-el-3 .st-btns {
                            bottom: 56px;
                            left: 0;
                            margin: 100px auto 0;
                            max-width: 90%;
                            position: absolute;
                            right: 0;
                            text-align: center;
                            top: 10px !important;
                            z-index: 20;
                            overflow-y: auto;
                        }
                    
                        </style>
                        </div>
                         
                        
{{-- 
                        <div class="social-sharing a2a_kit a2a_kit_size_32">
                            <a class="facebook a2a_button_facebook" href=""><i class="fa fa-facebook"></i> Share </a>
                            <a class="twitter a2a_button_twitter" href=""><i class="fa fa-twitter"></i> Tweet</a>
                            <a class="pinterest a2a_button_google_plus" href=""><i class="fa fa-pinterest"></i> Pinterest</a>
                            <a class="a2a_dd" href="https://www.addtoany.com/share" style="position: absolute; background-color: rgb(1, 102, 255); "></a>
                        </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>  --}}
                        </div>

                        

                    <div class="col-md-4" style="margin-top:20px;">
                       <div class="post-sidebar-area" style="padding: 10px;border-radius: 15px;background: #ececec;">
                           <h4 class="post-heading" style="color:#2385aa;border-bottom: 1px solid #d8d8d8;font-size:18px;"><i class="icon-feed"></i> {{$lang->blogsss}}</h4>
                           <ul style="direction: ltr;">
                              @foreach($lblogs->where('id','!=',$blog->id) as $lblog)
                               <li>
                                   <div class="row post-row">
                                       <div class="col-xs-4">

                                           <img src="{{asset('assets/images/'.$lblog->photo)}}" alt="{{$lblog->photo}}" style="border-radius: 10px; height:3rem;">
                                       </div>
                                       <div class="col-xs-8">
                                           <p class="post-meta-date" style="color:#666;font-size:13px;">{{date('d M Y',(strtotime($lblog->created_at)))}}</p>
                                           <a style="color:#555;font-size:12px;color:#2385aa;" href="{{route('front.blogshow',$lblog->slug)}}">{{strlen($lblog->title) > 30 ? substr($lblog->title,0,30)."..." : $lblog->title}}</a>
                                       </div>
                                   </div>
                               </li>
                               @endforeach
                           </ul>
                       </div>
                   </div>
                  @endif


                  

                </div>
            </div>
        </div>
@endsection
