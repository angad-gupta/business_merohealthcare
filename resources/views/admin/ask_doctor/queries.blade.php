@extends('layouts.admin')

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
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Ask Doctor</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Customer Queries
                                                </div>
                                            </div>
                                              @include('includes.notification')
                                        </div>   
                                    </div>
                  <div>
                                          @include('includes.form-error')
                                          @include('includes.form-success')
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="table-responsive">
                                      <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                                              <thead>
                                                <tr>
                                                  <th style="width: 80px;">Date</th>
                                                    <th style="width: 130px;">Doctor Name</th>
                                                  <th style="width: 130px;">Customer Email</th>
                                                  <th style="width: 130px;">Customer Phone</th>
                                                  <th style="width: 130px;">Customer Query</th>
                                             
                                                </tr>
                                              </thead>

                                              <tbody>
                                            @foreach($queries as $query)            
                                                  @php
                                                      $doctor = App\Doctor::findOrFail($query->doctor_id);
                                                  @endphp
                                                   <td>{{date('d M Y',strtotime($doctor->created_at))}}</td>
                                                    <td>{{$doctor->name}}</td>
                                                    <td>{{$query->email}}</td>
                                                    <td>{{$query->phone}}</td>
                                                    <td>{{$query->question}}</td>
           
                                                  </tr>
                                                  @endforeach
                                                  </tbody>
                                          </table></div></div>
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
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">

                  <form action="" class="btn-ok">
                
                    <input type="hidden" name="_method" value="DELETE" />
                      <p class="text-center">You are about to delete this Doctor.</p>
                      <p class="text-center">Do you want to proceed?</p>
                    
                      <div class="modal-footer" style="text-align: center;">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger">Delete</a>
                      </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

{{-- <script type="text/javascript">

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('action', $(e.relatedTarget).data('href'));
        });

  $( document ).ready(function() {
        $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
          '<a href="{{route('admin-askdoctor-create')}}" class="add-newProduct-btn">'+
          '<i class="fa fa-plus"></i> Add New Doctor</a>'+
          '</div>');                                                                       
});
</script> --}}

@endsection

