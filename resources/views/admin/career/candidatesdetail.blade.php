@extends('layouts.admin')
@section('title','Categories')

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
                                        <h2>Career <a class="btn btn-primary" href="{{route('admin-career-candidates')}}">Back</a></h2>
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Career <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Candidates <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Details</p>
                                    </div>
                                </div>
                                @include('includes.notification')
                            </div>   
                        </div>
                        <div>
                          @include('includes.form-error')
                          @include('includes.form-success')

                          @php

                            $openings = App\CareerOpening::orderBy('id','desc')->get();
    
                                
                            @endphp
                   

                        <div class="container">
                            <br/>
                            <h4>Candidate Details</h4>
                           

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Full Name </label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->first_name}} {{$candidates->middle_name}} {{$candidates->last_name}} </h5>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Email </label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->email}} </h5>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Portfolio Website Link </label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->portfolio}} </h5>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Position Applied </label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->position}} </h5>
                            </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Salary Requirements</label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->salary_requirements}} </h5>
                            </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Start Date</label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->start}} </h5>
                            </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Phone</label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->phone}} </h5>
                            </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >Last Company </label>
                                <div class="col-sm-6">
                                <h5 style="color:#555;">: {{$candidates->last_company}} </h5>
                            </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="setup_new_logo" style="color:#555;" >CV/Resume </label>
                                <div class="col-sm-6">
                                <a href="{{route('candidate-file',$candidates->id)}}" target="_blank">: {{$candidates->cv}} </h5>
                            </div>
                            </div>
                        </div>



                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
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
                <p class="text-center">You are about to delete this Blog.</p>
                <p class="text-center">Do you want to proceed?</p>
                {{-- <p>Everything will be deleted under this Name.</p> --}}
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

// $( document ).ready(function() {
//     $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
//       '<a href="{{route('admin-career-openings-create')}}" class="add-newProduct-btn">'+
//       '<i class="fa fa-plus"></i> Add New Opening</a>'+
//       '</div>');                                                                       
// });
</script>


@endsection