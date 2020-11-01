
<style>
  #customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #2385aa;
    color: white;
  }
  </style>

{{-- <h4 class="text-center" style="text-transform:uppercase"></h4> --}}
<a class="u-tags-v1 g-color-blue g-brd-around g-brd-blue g-bg-blue-opacity-0_1 g-bg-blue--hover g-color-white--hover g-rounded-50 g-py-4 g-px-15 g-mt-20" href="#">
  <i class="fa fa-tag mr-1"></i>
  Available Labs
</a>
            <div class="shortcode-html">
                <!-- Products Block -->
                <div class="row">
                    @forelse($vendor_products as $vendor_id => $products)
                    @php
                        $vendor = $vendors->where('id',$vendor_id)->first();
                        $price = 0;
                        $pprice = 0;
                        foreach ($products as $product) {
                            $price += $product->cprice;
                            $pprice += $product->pprice ? : $product->cprice;
                        }
                    @endphp

                    @if(!$vendor) @continue @endif
                   
                  <div class="col-md-4 col-lg-4 g-mb-30">

                   
                    <!-- Article -->
                    <article class="u-shadow-v19 media g-bg-white rounded g-pa-20">
                      <!-- Article Image -->
                      {{-- <div class="d-flex rounded-circle g-mr-15">
                        <img class="rounded-circle g-width-40 g-height-40" src="../../assets/img-temp/100x100/img10.jpg" alt="Image Description">
                      </div> --}}
                      <!-- End Article Image -->
  
                      <div class="media-body">
                        <!-- Article Info -->
                        <div class="g-mb-20">
                          <h3 class="h5 g-mb-5">
                            <a class="g-color-main g-color-primary--hover g-text-underline--none--hover" href="#"><img  style=" height: 2rem;" id="adminimg" src="{{ $product->vendor->photo ? asset('assets/images/'.$product->vendor->photo):asset('assets/images/user.png')}}" alt="profile image">{{ $vendor->name }}</a>
                            <a href="" class="pull-right" data-toggle="modal" style="border-radius: 30px;" data-target="#{{$vendor->id}}"> <i class="icon-info"></i></a>
                        
                          </h3>
                          <div class="js-rating g-font-size-11 g-color-primary g-mb-10" data-rating="3" data-spacing="1" data-backward-icons-classes="fa fa-star g-opacity-0_5"></div>
                          @foreach($products as $p)
                            @php
                              $pname = Modules\Lab\Entities\LabProduct::findOrFail($p->product_id);
                     
                            @endphp
{{--                             
                            <span><p style="font-size:12px; margin-bottom:0rem;">
                            {{$pname->name}} 
                            
                          </p>
                          
                          </span>
                          <span><p style="font-size:12px; margin-bottom:0rem;" class="text-right">
                            {{$pname->name}} 
                            
                          </p>
                          
                          </span> --}}

                          {{-- <header class="d-flex justify-content-between">
                            <h4 class="h5">
                              <a class="g-color-main g-color-primary--hover g-text-underline--none--hover" href="#">{{$pname->name}} </a>
                            </h4>
                            <div class="d-block text-right">
                              <span class="g-color-black g-font-size-16 g-line-height-1">Rs.{{$p->cprice}} </span>
                            </div>
                          </header> --}}

                          <ul class="list-unstyled">
                            <li class="g-brd-bottom--dashed g-brd-gray-light-v3 pt-1 mb-3">
                              <span class="g-font-weight-500 g-font-size-12">{{$pname->name}}:</span>
                              <span class="float-right g-color-black"> Rs.{{$p->cprice}}</span>
                            </li>
                         
                          </ul>

                        

                      

                          <div class="modal fade" id="testdetails{{$vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$vendor->name}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  
                                  {{-- {!! $vendor->description !!} --}}
                                  <div style="overflow-x:auto;">
                                  <table id="customers">
                                    <tr>
                                      <th>Test Name</th>
                                      <th>Specimen</th>
                                      <th>Method</th>
                                      <th>Schedule</th>
                                      <th>Reporting</th>
                                    </tr>

                                    @foreach($products as $p)
                                      @php
                                      $pname = Modules\Lab\Entities\LabProduct::findOrFail($p->product_id);
                            
                                      @endphp
                                      <tr>
                                      <td>{{$pname->name}}</td>
                                        <td>{{$p->specimen}}</td>
                                        <td>{{$p->method}}</td>
                                        <td>{{$p->timing}}</td>
                                        <td>{{$p->report_delivery_time}}</td>
                                      </tr>
                                      <tr>
                              
                                    @endforeach
                                  </table>
                                  </div>

                                  <br/>

                                  @foreach($products as $p)
                                   
                                  @php
                                  $pname = Modules\Lab\Entities\LabProduct::findOrFail($p->product_id);
                                  @endphp
                                   @if($pname->description != null)
                                  <h6 style="font-weight:700;">{{$pname->name}}</h6>
                                  <p>{!! $pname->description !!}</p>
                                  @endif

                                  @if($pname->product_collection)
                                  <div> 
                                    <p style="font-weight:600;color:#2385aa">Test collection in this package</p>  
                                   
                                      @php
                                      $decoded = json_decode($pname->product_collection, true);
                                      @endphp
                                        @foreach((array)$decoded as $pid)
                                          @php
                                          $product = Modules\Lab\Entities\LabProduct::findorFail($pid);
                                          @endphp
                                          
                                          <p class="text-left">{{$loop->iteration}}. {{$product->name}}</p>
                                       
                                        @endforeach
                                  </div>
                                  @endif
                                  @endforeach
                             
                              
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" style="border-radius:30px;" data-dismiss="modal">Close</button>
                        
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach

                        
                          {{-- <li class="list-inline-item ">
                            <a class="u-tags-v1 g-color-blue g-brd-around g-brd-blue g-bg-blue-opacity-0_1 g-bg-blue--hover g-color-white--hover g-rounded-50 g-py-4 g-px-15" href="#">
                              <i class="fa fa-tag mr-1"></i>
                              Marketing
                            </a>
                          </li> --}}
                        </div>
                        <!-- End Article Info -->
  
                        <!-- Article Author -->
                      
                        <!-- End Article Author -->
  
                        {{-- <hr class="g-brd-gray-light-v4 g-my-20"> --}}
  
                        <!-- Figure Footer -->
                        <ul class="list-inline g-mb-10 text-center">
                          <li class="list-inline-item g-mb-10">
                            <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-13 g-text-underline--none--hover rounded g-px-10 g-py-5" href="#">
                                <span class="g-font-weight-600 g-ml-5">Total Price:
                                   
                                
                              
                              <span class="g-font-weight-600 g-ml-5" style="color: #555;">
                                @if($gs->sign == 0)
                                {{$curr->sign}}{{ round($price * $curr->value, 2) }}
                            @else
                                {{ round($price * $curr->value, 2) }}{{$curr->sign}}
                            @endif</span>
                              </span>
                            </a>
                          </li>
                          <li class="list-inline-item ">
                            <input type="hidden" value="{{ $vendor_id }}" />

                            <button class="btn btn-md u-btn-orange g-font-weight-600 g-font-size-11 text-uppercase" style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem;" data-toggle="modal" data-target="#testdetails{{$vendor->id}}">
                              <i class="icon-book-open"></i> View Details
                             
                          </button>

                            <button style="border-radius:30px;line-height:1; padding:0.57143rem 0.82857rem;" class="btn btn-primary btn-md g-font-weight-600 g-font-size-11 text-uppercase addTestsCart">
                                <i class="icon-note"></i>
                                Book Now
                            </button>
                            {{-- <a class="btn btn-md u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase" href="#"><i class="icon-note"></i> Book</a> --}}
                          </li>
                          {{-- <li class="list-inline-item">
                            <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-12 g-text-underline--none--hover rounded g-px-10 g-py-5" href="#">
                              <i class="align-middle icon-christmas-043 u-line-icon-pro"></i>
                              <span class="g-font-weight-600 g-ml-5">66</span>
                            </a>
                          </li> --}}
                        </ul>

                        {{-- <ul class="list-inline g-color-gray-dark-v5 g-font-size-13 text-center">
                          <span class="g-font-weight-600 g-ml-5"><i class="icon-globe"></i> </span>
                        <li class="list-inline-item g-brd-gray-light-v3 g-line-height-1 g-pr-7 g-mr-5">
                          <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-12 g-text-underline--none--hover rounded g-px-10 g-py-5" href="https://{{$vendor->link}}" target="_blank">{{$vendor->link}}</a>
                          <button type="button" class="black-btn" data-toggle="modal" style="border-radius: 30px;" data-target="#{{$vendor->id}}">
                            <i class="icon-info"></i> More info
                          </button>
                        </li>
                  
                      </ul> --}}
                        <!-- End Figure Footer -->
                      </div>
                      <!-- End Article Content -->
                    </article>
                    <!-- End Article -->

                   
                  </div>

                  <div class="modal fade" id="{{$vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{$vendor->name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <ul class="list-inline g-color-gray-dark-v5 g-font-size-13 text-center">
                            <span class="g-font-weight-600 g-ml-5"><i class="icon-globe"></i> </span>
                          <li class="list-inline-item g-brd-gray-light-v3 g-line-height-1 g-pr-7 g-mr-5">
                            <a class="d-inline-block g-brd-around g-brd-gray-light-v4 g-brd-primary--hover g-color-gray-dark-v5 g-font-size-12 g-text-underline--none--hover rounded g-px-10 g-py-5" href="https://{{$vendor->link}}" target="_blank">{{$vendor->link}}</a>
                          
                          </li>
                    
                        </ul>
                          {!! $vendor->description !!}

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" style="border-radius:30px;" data-dismiss="modal">Close</button>
                
                        </div>
                      </div>
                    </div>
                  </div>
  
                  @empty
                  <div class="container text-center">
                  <h4 style="margin: 20px;  text-align:center">No Tests found !</h4>
                  </div>

                  
              
          
                  
              @endforelse  
                  
                </div>
                <!-- End Products Block -->

               
  
             
              </div>


  
{{--         

<div class="row">
    @forelse($vendor_products as $vendor_id => $products)
        @php
            $vendor = $vendors->where('id',$vendor_id)->first();
            $price = 0;
            $pprice = 0;
            foreach ($products as $product) {
                $price += $product->cprice;
                $pprice += $product->pprice ? : $product->cprice;
            }
        @endphp

        @if(!$vendor) @continue @endif
        
        <div class="col-lg-4 g-mb-30">
       
            
            <article class="u-shadow-v21 g-bg-white rounded">
                <div class="g-pa-30">
                    <h3 class="g-font-weight-300 g-mb-15">
                        <a class="u-link-v5 g-color-main g-color-primary--hover" href="#">{{ $vendor->name }}</a>
                    </h3>
                    
                    <p style="font-size: 1.25rem;">Total Price:
                        @if($gs->sign == 0)
                            {{$curr->sign}}{{ round($price * $curr->value, 2) }}
                        @else
                            {{ round($price * $curr->value, 2) }}{{$curr->sign}}
                        @endif
                    </p>

                    <p>{{$vendor->description}}</p>
                    
                </div>

           
                <div class=" g-font-size-12 g-brd-top g-brd-gray-light-v4 g-pa-15-30">
                    <input type="hidden" value="{{ $vendor_id }}" />

                    <button class="btn btn-md u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10 addTestsCart">
                        <i class="g-mr-5 fa fa-heart"></i>
                        Book Now
                    </button>

                <a class="btn btn-default" href="{{$vendor->link}}" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i></a>
                    
                   
                   
                
                    
                </div>
                

    
        </div>

        
        @empty
        <div class="container text-center">
        <h1 style="margin: 20px;  text-align:center">No Tests found !</h1>
        </div>

        
    @endforelse          
</div> --}}

{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$vendor->name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p name="description"> </p>
        <a href="" target="__blank"></a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div> --}}



{{-- <ul class="nav justify-content u-nav-v5-1 u-nav-primary g-brd-bottom--md g-brd-gray-light-v4" role="tablist" data-target="nav-5-1-primary-hor-center-border-bottom" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block u-btn-outline-primary">

    @foreach($cats as $c)
        <li class="nav-item">
        <a class="nav-link {{$loop->index==0?'active':''}}" data-toggle="tab" href="#{{$c->id}}" role="tab">{{$c->name}}</a>
        </li>
    @endforeach
</ul> --}}

{{-- <div id="nav-5-1-primary-hor-center-border-bottom" class="tab-content g-pt-20">
    @foreach($cats as $c)
        <div class="tab-pane fade {{$loop->index==0?'show active':''}}" id="{{$c->id}}" role="tabpanel">

                {!! $c->description !!}
        
        </div>
    @endforeach
</div> --}}


@section('scripts')

{{-- <script type="text/javascript">

$( document ).ready(function() {
    
  $('#exampleModal').on('show.bs.modal', function(e) {
      var reminder = $(e.relatedTarget).data('reminder');
      
      $(this).find('p[name="description"]').val(reminder.description);    


  });


    
}); 
</script> --}}

@endsection