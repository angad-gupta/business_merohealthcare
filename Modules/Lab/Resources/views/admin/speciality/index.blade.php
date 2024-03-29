@extends('layouts.admin')
@section('title','Lab Categories')

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
                                                    <h2>Speciality</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Manage Speciality <i class="fa fa-angle-right" style="margin: 0 2px;"></i>  Main Speciality</p>
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
                                                            <th style="width: 250px;">Name</th>
                                                            <th style="width: 250px;">Slug</th>
                                                            {{-- <th style="width: 200px;">Priority No.</th> --}}
                                                            <th style="width: 250px;">Status</th>
                                                            <th style="width: 250px;">Actions</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach($specs as $spec)    
                                                                <tr role="row" class="odd">
                                                                    <td>{{$spec->speciality_name}}</td>
                                                                    <td>{{$spec->speciality_slug}}</td>
                                                                    {{-- <td>{{ $cat->priority_no }}</td> --}}
                                                                    <td>
                                                                        <span class="dropdown">
                                                                            <button class="btn btn-{{$spec->status == 1 ? "success" : "danger"}} product-btn dropdown-toggle btn-xs" type="button" data-toggle="dropdown" style="font-size: 14px;">{{$spec->status == 1 ? "Activated" : "Deactivated"}}
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a href="{{route('lab-speciality-st',['id1'=>$spec->id,'id2'=>1])}}">Active</a></li>
                                                                                <li><a href="{{route('lab-speciality-st',['id1'=>$spec->id,'id2'=>0])}}">Deactive</a></li>
                                                                            </ul>
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('lab-speciality-edit',$spec->id)}}" class="btn btn-primary product-btn"><i class="fa fa-edit"></i> Edit</a>
                                                                        <a href="javascript:;" data-href="{{route('lab-speciality-delete',$spec->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i> Remove</a>
                                                                    </td>
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
                    <!-- Ending of Dashboard data-table area -->
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
                    <p class="text-center">You are about to delete this Speciality. Everything will be deleted under this Speciality.</p>
                    <p class="text-center">Do you want to proceed?</p>
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
          '<a href="{{route('lab-speciality-create')}}" class="add-newProduct-btn">'+
          '<i class="fa fa-plus"></i> Add New Speciality</a>'+
          '</div>');                                                                       
    });
</script>

@endsection