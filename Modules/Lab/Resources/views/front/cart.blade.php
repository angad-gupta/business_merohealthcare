@extends('layouts.front')
@section('title','My Cart - Lab')
@section('content')
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/progress-wizard.min.css">
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
    background-color: #2385aa ;
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
    .section-padding {
    padding: 20px 0;
}
  .select2-selection__rendered{
    
    height:35px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 9px !important;
    right: 1px;
    width: 20px;
}
.section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
    padding: 10px 0px !important;
    text-align: left;
    color: #333;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    /* color: #444; */
    line-height: 23px !important;
}
  .select2-selection__arrow{
    height:35px !important;
  }
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px !important;
    user-select: none;
    -webkit-user-select: none;
}
.section-padding.product-shoppingCart-wrapper .table>tbody>tr>td {
    padding: 10px 0;
    vertical-align: middle;
    color: #555;
    font-size: 16px;
    border: none;
    text-align: left;
}
.section-padding.product-shoppingCart-wrapper .table>thead>tr>th {
    padding: 30px 0px;
    text-align: left;
    color: #333;
}

.product-shoppingCart-wrapper .table>tfoot>tr>td {
    padding: 10px 0;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #fff transparent transparent transparent !important;
    /* border-style: solid; */
    border-width: 5px 4px 0 4px;
    height: 0;
    left: 40% !important;
    margin-left: -4px;
    margin-top: -2px;
    position: absolute;
    top: 60%;
    width: 0;
}

p {
    margin-top: 0;
    margin-bottom: 0rem;
    font-size:14px;
}

.btn-danger {
    color: #fff;
    background-color: #b6b2b2;
    border-color: #aeaeae;

}

p {
    margin-top: 0;
    margin-bottom: 0rem;
    font-size:14px;
}

.section-padding.product-shoppingCart-wrapper .table>tbody>tr>td {
    padding: 10px 0;
    vertical-align: middle;
    color: #555;
    font-size: 16px;
    border: none;
    text-align: left;
    font-size: 14px;
}

@media (min-width: 768px){
.u-info-v9-1::before {
    position: absolute;
    top: 75px;
    left: 17%;
    width: 66%;
    border-top: 1px dotted #ddd;
    content: " ";
}
}
.progress-indicator>li.completed .bubble, .progress-indicator>li.completed .bubble:after, .progress-indicator>li.completed .bubble:before {
    background-color: #2385aa;
    border-color: #2385aa;
}
.progress-indicator>li.completed, .progress-indicator>li.completed .bubble {
    color: #2385aa;
}

  </style>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Starting of ViewCart area -->
    <div class="section-padding product-shoppingCart-wrapper">
        <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="view-cart-title pull-right">
                  <a style="color:black;" href="{{route('lab.index')}}"><i class="icon-home"></i>{{ucfirst(strtolower($lang->home))}}</a>
                  <i class="fa fa-angle-right"></i>
                  <a style="color:black;" href="{{route('lab.cart')}}">Lab Test</a>
                </div>
              </div>

              <div class="container">
                <ul class="progress-indicator custom-complex">
                  <li class="completed" style="font-size:14px;"> <span class="bubble"></span><i class="icon-note"></i> Book  <i class="fa fa-check-circle"></i> </li>
                  <li class="completed" style="font-size:14px;"> <span class="bubble" ></span><i class="icon-finance-100 u-line-icon-pro"></i> Checkout <i class="fa fa-check-circle"></i></li>
                  <li style="font-size:14px;"> <span class="bubble"></span><i class="icon-credit-card"></i> Purchase </li>
                </ul>
              </div>

              <div class="col-md-12 col-sm-12">
                @include('includes.form-success')
              <div class="card g-brd-teal rounded-0 g-mb-30">
                <h3 class="card-header g-bg-primary g-brd-transparent g-color-white g-font-size-16 rounded-0 mb-0">
                  <i class="icon-finance-100 u-line-icon-pro g-mr-5"></i>
                  Lab Cart
                </h3>
              
                <div class="table-responsive">
                  <table class="table table-striped u-table--v1 mb-0">
                    <thead>
                      <tr>
                        <th style="padding-left:10px !important; ">Test Name</th>
                        <th class="hidden-sm">Unit Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
              
                    <tbody>

                      @if(Session::has('lab_cart'))
                          @include('lab::front.partials.cart')
                        @else
                          <tr>
                            <td colspan="9"><h2 class="text-center">{{$lang->h}}</h2></td>
                          </tr>
                        @endif
                     
               
                   
                    </tbody>
                    <tfoot style="background-color:#f3f3f3;">

                      @if(Session::has('lab_cart'))
                      <tr>
                        <td style="padding-left:10px">
                          <p class="g-font-size-14"> <b>Health Tax ({{$gs->lab_vat}}%):</b> </p>
                        </td>
                        <td>
                          <p class="g-font-size-14">
                           
                            <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{$health_tax_amount}}</span></b>
                           
                          </p>
                        </td>
                        <td>
                        </td>
                      </tr>
                      @endif

                      @if(Session::has('lab_cart'))
                      <tr>
                        <td style="padding-left:10px">
                          <p class="g-font-size-14"> <b>{{$lang->vt}}:</b> </p>
                        </td>
                        <td>
                          <p class="g-font-size-14">
                            @if($gs->sign == 0)
                            <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span></b>
                            @else
                              <span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span>{{$curr->sign}}
                            @endif
                          </p>
                        </td>
                        <td>
                        </td>
                      </tr>
                      @endif

                      <tr>
                        <td style="padding-left:10px">
                            <select class="form-control js-example-basic" id="allTests" style="height:37px;max-width:20px;"><option></option></select>                          
                        </td>
                        <td >
                            <button class="btn btn-primary" type="button" id="addTest" class="btn" style="border-radius:30px;"><i class="fa fa-plus"></i> Add Test</button>                          
                        </td>
                        <td>
                         
                        </td>
                        
                      </tr>
                     
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="text-center">
                @if(Session::has('lab_cart'))

                  
                  @if(Auth::guard('user')->check())
                    @if(Auth::guard('user')->user()->is_vendor == 0)
                      <a href="{{route('lab.checkout')}}" class="btn u-btn-primary g-font-size-13 text-uppercase g-px-10 g-py-6" style="border-radius:30px;"><i class="icon-finance-100 u-line-icon-pro"></i> Checkout</a>
                    @else
                      <a data-toggle="modal" data-target="#invalidUserModal" href="javascript:;" class="btn u-btn-primary g-font-size-13 text-uppercase g-px-10 g-py-6" style="border-radius:30px;"><i class="icon-finance-100 u-line-icon-pro"></i> Checkout</a>
                    @endif
                  @else
                    <a data-toggle="modal" data-target="#loginModal" href="javascript:;" class="btn u-btn-primary g-font-size-13 text-uppercase g-px-10 g-py-6" style="border-radius:30px;"><i class="icon-finance-100 u-line-icon-pro"></i> Checkout</a>
                  @endif
                @endif
              </div>

              </div>


              <div class="col-md-12 col-sm-12">
                
                {{-- <div class="table-responsive">
                  <table class="table " style="width:100%">
                    <thead>
                      <tr>
                        <th colspan="4">Test Name</th>
                        <th>{{$lang->cupice}}</th>
                        <th>{{$lang->cremove}}</th>
                      </tr>
                    </thead>
                    <tbody id="testList">
                        @if(Session::has('lab_cart'))
                          @include('lab::front.partials.cart')
                        @else
                          <tr>
                            <td ><h2 class="text-center">{{$lang->h}}</h2></td>
                          </tr>
                        @endif
                    </tbody>
                    <tfoot>

                      @if(Session::has('lab_cart'))
                      <tr>
                        <td colspan="4">
                          <p class="g-font-size-14"> <b>Health Tax ({{$gs->lab_vat}}%):</b> </p>
                        </td>
                        <td colspan="1" style="text-align: center; text-align:left;">
                          <p class="g-font-size-14">
                           
                            <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{$health_tax_amount}}</span></b>
                           
                          </p>
                        </td>
                      </tr>
                      @endif

                      @if(Session::has('lab_cart'))
                      <tr>
                        <td colspan="4">
                          <p class="g-font-size-14"> <b>{{$lang->vt}}:</b> </p>
                        </td>
                        <td colspan="1" style="text-align: center; text-align:left;">
                          <p class="g-font-size-14">
                            @if($gs->sign == 0)
                            <b> {{$curr->sign}}<span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span></b>
                            @else
                              <span class="lab-total" id="grandtotal">{{round($totalPrice * $curr->value, 2)}}</span>{{$curr->sign}}
                            @endif
                          </p>
                        </td>
                      </tr>
                      @endif

                      <tr>
                        <td colspan="4">
                            <select class="form-control js-example-basic" id="allTests" style="height:37px;max-width:20px;"><option></option></select>                          
                        </td>
                        <td colspan="1" style="text-align: center;  text-align:left;">
                            <button class="btn btn-primary" type="button" id="addTest" class="btn" style="border-radius:30px;"><i class="fa fa-plus"></i> Add Test</button>                          
                        </td>

                        
                      </tr>

                     

                     
                     
                    </tfoot>
                  </table>
                  
                  
                </div> --}}

              
              </div>

            </div>
        </div>
    </div>
    <!-- Ending of ViewCart area -->
    
    <div class="modal fade" id="invalidUserModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="margin-right:10px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
      
            </div>
      
            <div class="modal-body">
                <div class="row" style="margin: 15px;">
                  You cannot use vendor account to book lab tests. You must have a normal user account.<br><br>
                  <a href="{{route('user-logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i>Logout</a>
                  <form id="logout-form" action="{{route('user-logout')}}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
            </div>
          </div>
      </div>
      </div>

@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    var allTests = JSON.parse('<?php echo $tests ?>');

    $('#allTests').select2({
        placeholder: "Search Your Desired Test",
        width: '90%',
        height: '45px',
        data : allTests,
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatData
    });

    function formatData (data) {
        // if(data.data!='')
        //     var $result= $(
        //         '<span> ' + data.text + '</span>'
        //     );
        // else
            var $result= $(
                '<span>' + data.text + ' </span>'
            );
        return $result;
    }

    $(document).on("click", ".removeTest" , function(){
      var button = $(this);
      button.attr('disabled','disabled');

      var pid =  $(this).parent().find('input[type=hidden]').val();

      $.ajax({
        type: "POST",
        url:"{{URL::to('/lab/json/removecart')}}",
        data:{test_id: pid, _token: '{{ csrf_token() }}'},
        success:function(data){
          $(".delTest"+pid).remove();

          $('#allTests').find("[value='"+pid+"']").removeAttr('disabled');

          $(".lab-total").html((data[0] * {{$curr->value}}).toFixed(2));
          $(".lab-cart-quantity").html(data[2]);
          $(".lab-cart").html("");
          if(data[1] == null)
          {
            $(".lab-total").html("0.00");
            $(".lab-cart-quantity").html("0");

            location.reload();
          }                           
                                    
        },
        error: function(data){
          button.removeAttr('disabled');

          $.notify("Something went wrong.","error");
        }
      }); 
    });

    $(document).on("click", "#addTest" , function(){
      var selected = $('#allTests').select2('data')[0];
      var pid = selected.id;

      if(pid == ''){
        $.notify("Select a test first","error");
        return;
      }
      $('#addTest').attr('disabled','disabled');

      $.ajax({
        type: "POST",
        url:"{{URL::to('/lab/json/addcart')}}",
        data:{ test_id: pid, _token: '{{ csrf_token() }}'},
        success:function(data){
          if(data == 0)
          {
              $.notify("{{$gs->cart_error}}","error");
          }
          else
          {
            $('#allTests').find("[value='"+pid+"']").attr('disabled','disabled');
            $('#allTests').val('').trigger('change');
            $('#testList').html(data[1]);
            $(".lab-total").html((data[0] * {{$curr->value}}).toFixed(2));
            $(".lab-cart-quantity").html(data[2]);
            $(".lab-cart").html("");
          }
          $('#addTest').removeAttr('disabled');

        },
        error: function(data){
          $('#addTest').removeAttr('disabled');

          if(data.status == 422 && data.responseJSON.error)
            $.notify(data.responseJSON.error,"error");
          else
            $.notify("Something went wrong.","error");
        }
      }); 
      return false;
    });
  </script>





@endsection