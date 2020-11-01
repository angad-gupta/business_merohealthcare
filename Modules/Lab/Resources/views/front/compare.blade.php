
@extends('layouts.front')

@section('title','Compare Tests - Lab')


@section('content')
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />


    <style>
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
        .progress-indicator>li.completed .bubble, .progress-indicator>li.completed .bubble:after, .progress-indicator>li.completed .bubble:before {
    background-color: #2385aa;
    border-color: #2385aa;
}
.progress-indicator>li.completed, .progress-indicator>li.completed .bubble {
    color: #2385aa;
}

    </style>
    <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll dzsprx-readyall loaded" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
        <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-bluegray-opacity-0_5--after" style="height: 130%; background-image: url('/medimage/lb2.jpg'); transform: translate3d(0px, -47.0242px, 0px);"></div>

        <!-- Promo Block Content -->
        <div class="container u-bg-overlay__inner text-center g-py-70">
            <h2 class="h1 g-color-white g-font-weight-600 text-uppercase g-mb-30">Mero Health Lab</h2>

            <!-- Search Form -->
            <form action="/lab/tests/search" method="GET">
                <!-- Search Field -->
                <div class="mx-auto g-mb-20">
                    <div class="input-group">
                        <input list="alltest" name="searchkey" type="text" class="form-control g-font-size-16 border-0" style="height:52px;margin:0 10px" placeholder="Search test here. eg (Lipid Profile)" aria-label="Search your test" autocomplete="off" required>
                        <datalist id="alltest">
                        
                            @foreach($tests as $product)
                                <option value="{{$product->name}}">
                            @endforeach
                        </datalist>
                        <input list="allcities" name="searchcity" type="text" class="form-control g-font-size-16 border-0" style="height:52px;margin:0 10px" placeholder="Search location" aria-label="Search by location" autocomplete="off">
                        <datalist id="allcities">
                        
                            @include('includes.cities')
                        </datalist>
                        <span class="input-group-btn">
                            <button class="btn btn-primary g-font-size-18 g-py-12 g-px-25" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <!-- End Search Field -->

            </form>
            <!-- End Search Form -->
        </div>
        <!-- End Promo Block Content -->
    </section>
 
    <div class="container g-mt-20">
        {{-- <label class="d-block g-color-gray-dark-v2 g-font-size-20">Available Tests:</label> --}}
        <div class="mx-auto g-mb-20">
            <div class="input-group">
                <select class="form-control selectTests" multiple="multiple">
                    @foreach($tests as $test)
                        <option value="{{$test->id}}">{{$test->name}}</option>

                    @endforeach
                    
                </select>
                <input list="allcities" id="comparecity" type="text" class="form-control g-font-size-16" style="margin:0 10px" placeholder="Search location" aria-label="Search by location" autocomplete="off">
                
                <span class="input-group-btn">
                    
                    <button class="btn btn-primary" type="button" id="addTests" class="btn"><i class="fa fa-exchange"></i> Compare</button>                          

                </span>
            </div>
        </div>

        <div id="compareList" style="min-height:100px">
                
        </div>

    </div>
@endsection

@section('scripts')

<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script src="/frontend-assets/main-assets/assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script >
    $(document).ready(function () {
        var selected = [];
        // initialization of carousel
        $.HSCore.components.HSCarousel.init('.js-carousel');

        $('.selectTests').select2({
            width: '70%',
            placeholder: 'Select Tests To Compare'
        });

 
        $(document).on("click", "#addTests" , function(){
            selected = $('.selectTests').select2('val');
            if(selected.length == 0){
                $.notify("Select a test first","error");
                return;
            }

            var city = $('#comparecity').val();

            $('#addTests').attr('disabled','disabled');

            $.ajax({
                type: "POST",
                url:"{{URL::to('/lab/json/compare')}}",
                data:{test_ids: selected, city: city, _token: '{{ csrf_token() }}'},
                success:function(data){
                    $('#addTests').removeAttr('disabled');

                    console.log(data)
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
  </script>

@endsection