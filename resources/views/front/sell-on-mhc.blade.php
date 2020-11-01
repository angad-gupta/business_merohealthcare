@extends('layouts.front')
@section('title','Sell on Merohealthcare')
@section('content')
<style>
    
</style>


<section class="g-bg-gray-light-v5">
    <div class="container">
      <div class="row justify-content-between g-pt-30">
        <div class="col-md-6 align-self-center g-mb-40 g-mb-0--md">
          <h2 class="g-color-gray-dark-v3 g-font-weight-600 g-font-size-35 text-uppercase g-line-height-1_2 g-letter-spacing-1_5 g-mb-40">merohealthcare<br><span class="g-color-primary">A Online Pharmacy</span>
          </h2>

          <!-- Promo Block - Media -->
          {{-- <div class="media g-mb-20">
            <div class="d-flex align-self-center mr-4">
              <i class="g-color-primary g-font-size-40 icon-finance-218"></i>
            </div>
            <div class="media-body">
              <p class="mb-0">Now that we've aligned the details, it's time to get things mapped out and organized. This part is really crucial in keeping the project in line to completion.</p>
            </div>
          </div> --}}
          <!-- End Promo Block - Media -->

          <!-- Promo Block - Media -->
          {{-- <div class="media g-mb-20">
            <div class="d-flex align-self-center mr-4">
              <i class="g-color-primary g-font-size-40 icon-finance-038"></i>
            </div>
            <div class="media-body">
              <p class="mb-0">The time has come to bring those ideas and plans to life. This is where we really begin to visualize your napkin sketches and make them into beautiful pixels.</p>
            </div>
          </div> --}}
          <!-- End Promo Block - Media -->

          <!-- Promo Block - Media -->
          <div class="media g-mb-30">
            <div class="d-flex align-self-center mr-4">
              <i class="g-color-primary g-font-size-40 icon-finance-075"></i>
            </div>
            <div class="media-body">
              <p class="mb-0">Merohealthcare provides platform for selling products from different vendors on merohealthcare as well as provide labs to get connected on MHC to provide lab services to their customers needs.</p>
            </div>
          </div>
          <!-- End Promo Block - Media -->

          <p class="text-uppercase g-font-size-20 mb-0">
            <span class="g-color-primary g-font-weight-700">Call us at:</span> +977-1-5902444
          </p>
        </div>

        <div class="col-md-6 align-self-end g-overflow-hidden">
          <img class="img-fluid" src="https://www.merohealthcare.com/assets/images/1592375295logo.jpg" alt="Image description">
        </div>
      </div>
    </div>
  </section>

  <section class="container g-pt-50">
    <div class="text-center g-mb-0">
      <h2 class="h1 g-color-black g-font-weight-600">What can we provide?</h2>
      <p class="lead">This is where user can get platform to sell products or provide service to customers on Merohealthcare on followings.</p>
    </div>

    <div class="row no-gutters g-mx-minus-10">
      <div class="col-sm-6 col-lg-4 g-px-10 g-mb-20">
        <!-- Projects -->
        <div class="u-block-hover g-brd-around g-brd-gray-light-v4 g-color-black g-color-white--hover g-bg-cyan--hover text-center rounded g-transition-0_3 g-px-30 g-py-50">
          <img class="img-fluid u-block-hover__main--zoom-v1 mb-5" style="height:250px;border-radius:30px" src="https://www.merohealthcare.com/assets/images/1594621914ecommerce-icon-on-white-background-simple-element-vector-28222469.jpg" alt="Image Description">
          <span class="g-font-weight-600 g-font-size-12 text-uppercase">Sell Product</span>
          <h3 class="h4 g-font-weight-600 mb-0">Product Vendor</h3>

          <a class="u-link-v2" href="{{route('product-vendor-login')}}"></a>
        </div>
        <!-- End Projects -->
      </div>

      <div class="col-sm-6 col-lg-4 g-px-10 g-mb-20">
        <!-- Projects -->
        <div class="u-block-hover g-brd-around g-brd-gray-light-v4 g-color-black g-color-white--hover g-bg-purple--hover text-center rounded g-transition-0_3 g-px-30 g-py-50">
          <img class="img-fluid u-block-hover__main--zoom-v1 mb-5" style="height:250px;border-radius:30px" src="https://www.merohealthcare.com/assets/images/1594622184molecule-particule-laboratory-icon_24908-29288.jpg" alt="Image Description">
          <span class="g-font-weight-600 g-font-size-12 text-uppercase">Provide Service</span>
          <h3 class="h4 g-font-weight-600 mb-0">Lab Vendor</h3>

          <a class="u-link-v2" href="{{route('vendor-login')}}"></a>
        </div>
        <!-- End Projects -->
      </div>

      <div class="col-sm-6 col-lg-4 g-px-10 g-mb-20">
        <!-- Projects -->
        <div class="u-block-hover g-brd-around g-brd-gray-light-v4 g-color-black g-color-white--hover g-bg-teal--hover text-center rounded g-transition-0_3 g-px-30 g-py-50">
          <img class="img-fluid u-block-hover__main--zoom-v1 mb-5" style="height:250px;border-radius:30px" src="https://www.merohealthcare.com/assets/images/1594622791Gold%203D%20Mockup%20II.jpg" alt="Image Description">
          <span class="g-font-weight-600 g-font-size-12 text-uppercase">Connect Wholesale</span>
          <h3 class="h4 g-font-weight-600 mb-0">B2B Merohealthcare</h3>

          <a class="u-link-v2" href="http://business.merohealthcare.com/"></a>
        </div>
        <!-- End Projects -->
      </div>

   

    
    </div>
  </section>

  <section class="container g-py-20">
    <div class="text-center g-mb-50">
      <h2 class="h1 g-color-black g-font-weight-600">Have any Questions ?</h2>

    </div>

    <div class="col-sm-6 col-lg-4 g-px-10 g-mb-20">
        <!-- Projects -->
        <div class="u-block-hover g-brd-around g-brd-gray-light-v4 g-color-black g-color-white--hover g-bg-green--hover text-center rounded g-transition-0_3 g-px-30 g-py-50">
          <img class="img-fluid u-block-hover__main--zoom-v1 mb-5" style="height:250px;border-radius:30px" src="https://www.merohealthcare.com/assets/images/1594623187unnamed.jpg" alt="Image Description">
          <span class="g-font-weight-600 g-font-size-12 text-uppercase">Ask Queries</span>
          <h3 class="h4 g-font-weight-600 mb-0">Enquiry</h3>

          <a class="u-link-v2" href="{{route('provider-enquiry')}}"></a>
        </div>
        <!-- End Projects -->
      </div>
  </section>

@endsection