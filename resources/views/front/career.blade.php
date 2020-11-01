@extends('layouts.front')
@section('title','Career')
@section('content')


<style>

.display-4 {
    font-size: 2.5rem;
    font-weight: 300;

}

.btn-xl {

    font-size: 14px;
}

.rounded-0 {
    border-radius: 30px!important;
}

.g-bg-darkgray-radialgradient-circle {
    background-image: radial-gradient(circle farthest-side at 110% 0, #18ba9b, #2385aa);
    background-repeat: no-repeat;
}

</style>

  <div class="container" style="padding:20px;">

  <div class="row">
    <div class="col-lg-6 g-mb-50 g-mb-0--lg">
    <img class="img-fluid" style="margin-top:50px;" src="{{url('assets/images/logo.jpg')}}" style="" alt="Image Description">
    </div>

    @php
    $description = App\CareerDescription::get();
    $hirings = App\CareerHiring::get();
    $openings = App\CareerOpening::get();
    @endphp



    <div class="col-lg-6 align-self-center">

       @foreach($description as $dd)
       @if($dd->points == null)
      <header class="u-heading-v2-3--bottom g-brd-primary g-mb-20">
        <h2 class="h3 u-heading-v2__title text-uppercase g-font-weight-300">{{$dd->title}}</h2>
      </header>

      <p class="lead g-mb-30">{{$dd->description}}</p>
      @endif
    @endforeach

    <ul class="list-unstyled g-color-gray-dark-v4 g-mb-40">
      @foreach($description as $dd)
        @if($dd->description == null && $dd->title == null && $dd->points != null )
        <li class="d-flex g-mb-10">
          <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i>
          {{$dd->points}}
        </li>
        @endif
      @endforeach
    </ul>

      {{-- <a class="btn btn-md u-btn-primary rounded-0" href="#">Learn More</a> --}}
    </div>


  </div>
  </div>




  <div class="shortcode-html">
    <section class="g-flex-centered g-height-450 g-bg-darkgray-radialgradient-circle g-color-white-opacity-0_7 g-py-30">
      <div class="container">

        @foreach($hirings as $h)
        <div class="row">
          <div class="col-md-6 align-self-center g-py-20">
            <div class="u-heading-v2-5--bottom g-brd-primary g-mb-30">
                <h2 class="u-heading-v2__title text-uppercase g-font-weight-300 mb-0">{{$h->title}}</h2>
              </div>
            <p class="lead mb-0 g-line-height-2">{{$h->description}}</p>
          </div>

          <div class="col-md-6 align-self-center g-py-20">
            <img class="w-100" src="{{ $h->image ? asset('assets/images/'.$h->image):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Iamge Description">
          </div>
        </div>
        @endforeach
      </div>
    </section>
  </div>


  <div class="container" style="padding:20px;">

    <h2 class="h3 u-heading-v2__title text-uppercase g-font-weight-300 text-center">Current Openings</h2>
    <br/>


    <div class="shortcode-html">
      <div class="row g-mx-minus-10 g-mb-50">

        @foreach($openings as $h)

        <div class="col-md-8 col-lg-8 g-px-10 ml-md-auto mr-md-auto">
          <!-- Article -->
          <article class="media g-brd-around g-brd-gray-light-v4 g-bg-white rounded g-pa-10 g-mb-20">
            <!-- Article Image -->
      
                <div class="g-max-width-100 g-mr-15">
                  <img class="d-flex w-100" style="border-radius:50px;" src="{{ $h->image ? asset('assets/images/'.$h->image):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Image Description">
                </div>
           
            <!-- End Article Image -->
         
            <!-- Article Info -->
            <div class="media-body align-self-center">
           
              <h4 class="h5 g-mb-7">
                <a class="g-color-black g-color-primary--hover g-text-underline--none--hover" href="#">{{$h->title}}</a>
              </h4>
           


              <a class="btn btn-primary pull-right" style="border-radius:30px;" data-toggle="collapse" href="#{{ $h->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="icon-list"></i> Details
                </a>
              {{-- <a class="d-inline-block g-color-gray-dark-v5 g-font-size-13 g-mb-10" href="#">{!! str_limit($h->description, $limit = 150, $end = '...') !!}</a> --}}
              <!-- End Article Info -->

              <!-- Article Footer -->
              <footer class="d-flex justify-content-between g-font-size-16">
                <span class="g-color-black g-line-height-1"></span>
                <ul class="list-inline g-color-gray-light-v2 g-font-size-14 g-line-height-1">
                  {{-- <li class="list-inline-item align-middle g-pr-10 g-mr-6">
                    <a class="g-color-gray-dark-v5 g-color-primary--hover g-text-underline--none--hover" href="#" data-toggle="tooltip" data-placement="top" title="Opening Date">
                      <i class="icon-calender"></i>{{date('d M Y ',strtotime($h->created_at))}}
                    </a>
                  </li> --}}
                  <div class="media-body col-4">

                    <span class="g-color-primary g-font-weight-500 g-font-size-40 g-line-height-0_7">{{date('d',strtotime($h->created_at))}}</span>
                    <span class="g-line-height-0_7">{{date('M ',strtotime($h->created_at))}}</span>

                  </div>
                </ul>
              </footer>
            </div>




         
              <!-- End Article Footer -->
            
         

          
       
          </article>
          <!-- End Article -->


        </div>

          
       
        <div class="col-md-8 col-lg-8 g-px-10 ml-md-auto mr-md-auto">
            <div class="collapse" id="{{ $h->id }}">

             
                <article id="myDIV" class="media g-brd-around g-brd-gray-light-v4 g-bg-white rounded g-pa-10 g-mb-20">
                    <div class="card card-body" style="border-color: #fff;">
                      {!! $h->description !!}

                      <h4 style="" class="text-center"><i class="icon-share-alt"></i> Share with:</h4>

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
                    </div>
          
               </article>
          
            </div>
        </div>
      

       

        @endforeach





      </div>
    </div>


  </div>

  <section class="g-py-50--md g-py-80">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-8 ml-md-auto mr-md-auto">
          <div class="u-heading-v7-2 g-mb-30">
            <h2 class="h3 u-heading-v2__title text-uppercase g-font-weight-300 text-center">Candidate Application</h2>

          </div>

          <form class=" text-left" action="{{route('admin-career-candidates-submit')}}" method="POST" enctype="multipart/form-data">

            {{csrf_field()}}
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">First Name *</label>
                <input id="inputGroup1_1" name="first_name" class="form-control form-control-md rounded-0" type="text" placeholder="First Name" required>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Middle Name</label>
                <input id="inputGroup1_1" name="middle_name" class="form-control form-control-md rounded-0" type="text" placeholder="Middle name">
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Last Name *</label>
                <input id="inputGroup1_1" name="last_name" class="form-control form-control-md rounded-0" type="text" placeholder="Last Name" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Email *</label>
                <input id="inputGroup1_1" name="email" class="form-control form-control-md rounded-0" type="email" placeholder="Email" required>
              </div>
            </div>

            <div class="col-md-6 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Portfolio Website  (eg-LinkedIn)</label>
                <input id="inputGroup1_1" name="portfolio" class="form-control form-control-md rounded-0" type="text" placeholder="Portfolio Website" >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Apply Position *</label>
                <input id="inputGroup1_1" name="position" class="form-control form-control-md rounded-0" type="text" placeholder="Apply Position" required>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Salary Requirements *</label>
                <input id="inputGroup1_1" name="salary_requirements" class="form-control form-control-md rounded-0" type="text" placeholder="Salary Expectation" required>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">When can you start? </label>
                <input id="inputGroup1_1" name="start" class="form-control form-control-md rounded-0" type="text" placeholder="Joining Date" >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Phone *</label>
                <input id="inputGroup1_1" name="phone" class="form-control form-control-md rounded-0" type="tel" placeholder="Phone" required>
              </div>
            </div>

            <div class="col-md-6 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Last Company Name (if any)</label>
                <input id="inputGroup1_1" name="last_company" class="form-control form-control-md rounded-0" type="text" placeholder="Last Company Name" >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group g-mb-20">
                <label class="g-mb-10" for="inputGroup1_1">Upload your CV/Resume *</label>
                <input name="cv" class=" " type="file" required>
                <small class="form-text text-muted g-font-size-default g-mt-10">
                  <strong>Note: </strong>&nbsp; PDF, DOCX, JPG, JPEG, PNG.
                </small>
              </div>
            </div>


          </div>

          <div class="form-group g-mb-20">
            <label class="g-mb-10" for="inputGroup2_2">Comments</label>
            <textarea name="comments" id="inputGroup2_2" class="form-control form-control-md rounded-0" rows="3" placeholder="Comments"></textarea>
          </div>
          <div class="text-center">
          <button class="js-fancybox-media btn btn-xl u-btn-primary g-rounded-30 text-center" type="submit" >
            <i class="icon-paper-plane" aria-hidden="true"></i>
            Send Application
          </button>
          </div>

          </form>




        </div>
      </div>
    </div>
  </section>



  {{-- <section class="g-py-50--md g-py-80">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-8 ml-md-auto mr-md-auto">
          <div class="u-heading-v7-2 g-mb-30">
            <h2 class="display-4 u-heading-v7__title g-mb-20">Build a Great
              <span class="g-color-primary">Product!</span>
            </h2>
            <i class="fa fa-star g-color-primary g-font-size-70x"></i>
            <i class="fa fa-star g-font-size-95x g-color-primary"></i>
            <i class="fa fa-star g-color-primary"></i>
            <i class="fa fa-star g-font-size-95x g-color-primary"></i>
            <i class="fa fa-star g-font-size-70x g-color-primary"></i>
          </div>




          <a class="js-fancybox-media btn btn-xl u-btn-primary g-rounded-30" href="{{route('front.contact')}}" data-src="//vimeo.com/14220611" data-animate-in="flipInY" data-animate-out="flipOutY" data-speed="1000">
            <i class="fa fa-phone" aria-hidden="true"></i>
            Contact Us
          </a>


        </div>
      </div>
    </div>
  </section> --}}




@endsection

@section('scripts')
<script>
  function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
  </script>
@endsection
