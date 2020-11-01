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
                                        <h2>Career</h2>
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Career <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Openings<i class="fa fa-angle-right" style="margin: 0 2px;"></i> Index</p>
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
                   

                          <div class="row">
                           
                            <div class="col-sm-12">
                                
                                <div class="table-responsive">
                                <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 130px;">Featured Image</th>
                                                <th style="width: 100px;">Opening Title</th>
                                                <th style="width: 174px;">Opening Details</th>
                                                
                                                <th style="width: 150px;">Actions</th></tr>
                                        </thead>

                                        <tbody>
                                        @foreach($openings as $h)                                                
                                        <tr role="row" class="odd">
                                                <td tabindex="0" class="sorting_1"><img src="{{ $h->image ? asset('assets/images/'.$h->image):'http://fulldubai.com/SiteImages/noimage.png'}}" alt="Careers Photo" style="width: 200px"></td>
                                                <td>{{$h->title}}</td>
                                                <td>{{$h->description}}</td>
                                                <td>
                                                    <a href="{{route('admin-career-openings-edit',$h->id)}}" class="btn btn-primary product-btn"><i class="fa fa-edit"></i> Edit</a>
                                                   
                                                    <a href="javascript:;" data-href="{{route('admin-career-openings-delete',$h->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i> Remove</a>
                                                </td>
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
                <p class="text-center">You are about to delete this Opening.</p>
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

$( document ).ready(function() {
    $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
      '<a href="{{route('admin-career-openings-create')}}" class="add-newProduct-btn">'+
      '<i class="fa fa-plus"></i> Add New Opening</a>'+
      '</div>');                                                                       
});
</script>


@endsection