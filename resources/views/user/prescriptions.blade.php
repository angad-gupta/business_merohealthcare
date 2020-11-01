@extends('layouts.user')
@section('title','My Prescriptions')
@section('content')
  <div class="right-side">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- Starting of Dashboard data-table area -->
        <div class="section-padding add-product-1">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="add-product-box">
                <div class="product__header">
                    <div class="row represcription-xs">
                        <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                            <div class="product-header-title">
                                <h2>My Prescriptions</h2>
                                <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Prescriptions</p>
                            </div>
                        </div>
                          @include('includes.user-notification')
                    </div>   
                </div>
                <div>
                  @include('includes.form-success')
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                          <thead>
                            <tr class="table-header-row">
                              <th>Prescription#</th>
                              <th>Date</th>
                              <th>Prescription File</th>
                              <th>Prescription Status</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($prescriptions as $prescription)
                              <tr>
                                <td>{{$prescription->prescription_number}}</td>
                                <td>{{date('d M Y',strtotime($prescription->created_at))}}</td>
                                <td>{{$prescription->currency_sign}}{{ round($prescription->pay_amount * $prescription->currency_value , 2) }}</td>
                                <td>{{ucfirst($prescription->status)}}</td>
                                <td><a href="{{route('user-prescription',$prescription->id)}}">View Prescription</a></td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ending of Dashboard data-table area -->
    </div>
  </div>
  </div>


@endsection

@section('scripts')

<script type="text/javascript">

  $( document ).ready(function() {
      $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
        '<a style="cursor: pointer;" href="{{ route("user-prescriptions.create") }}" class="add-newProduct-btn email2">'+
        '<i class="fa fa-plus"></i> Upload New Prescription</a>'+
        '</div>');                                                                       
  });

</script>

@endsection