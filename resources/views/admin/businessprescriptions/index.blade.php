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
                                        <div class="row represcription-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Business Order</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Business Order <i class="fa fa-angle-right" style="margin: 0 2px;"></i> All Business Order</p>
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
                                                    <th>Orders#</th>
                                                    <th style="width: 130px;">Name</th>
                                                    <th style="width: 130px;">Email</th>
                                                    <th style="width: 130px;">Contact</th>
                                                    <th>Date</th>
                                                    <th style="width: 380px;">Actions</th></tr>
                                              </thead>

                                              <tbody>
                                                @foreach($business_prescriptions as $business_prescription)                                                  

                                                    <tr>
                                                        <td><a href="{{route('admin-business-prescription-show',$business_prescription->id)}}">{{sprintf("%'.08d", $business_prescription->id)}}</a></td>
                                                        <td> {{$business_prescription->name}}</td>
                                                        <td> {{$business_prescription->email}}</td>
                                                        <td> {{$business_prescription->phone}}</td>
                                                        <td>{{date('d M Y',strtotime($business_prescription->created_at))}}</td>
                                                        <td>
                                                            <input type="hidden" value="{{$business_prescription->email}}">
                                                            <a href="{{route('admin-business-prescription-show',$business_prescription->id)}}" class="btn btn-primary product-btn"><i class="fa fa-check"></i> View Details</a>

                                                            {{-- <a style="cursor: pointer;" class="btn btn-success product-btn email3"  data-toggle="modal" data-target="#emailModal3"><i class="fa fa-send"></i> Send Email</a> --}}


                                                            <span class="dropdown">
                                                            <button class="btn btn-danger product-btn dropdown-toggle btn-xs" type="button" data-toggle="dropdown" style="font-size: 14px;
                                                            @if($business_prescription->status == "completed")
                                                            {{ "background-color: #01c004;" }}
                                                            @elseif($business_prescription->status == "processing")
                                                            {{ "background-color: #02abff;" }}
                                                            @elseif($business_prescription->status == "declined")
                                                            {{ "background-color: #d9534f;" }}
                                                            @else
                                                            {{"background-color: #ff9600;"}}
                                                            @endif
                                                            
                                                            ">{{ucfirst($business_prescription->status)}}
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="javascript:;" data-href="{{route('admin-business-prescription-status',['id1' => $business_prescription->id, 'status' => 'processing'])}}" data-toggle="modal" data-target="#confirm-delete">Processing</a></li>
                                                                <li><a href="javascript:;" data-href="{{route('admin-business-prescription-status',['id1' => $business_prescription->id, 'status' => 'completed'])}}" data-toggle="modal" data-target="#confirm-delete">Completed</a></li>
                                                                <li><a href="javascript:;" data-href="{{route('admin-business-prescription-status',['id1' => $business_prescription->id, 'status' => 'declined'])}}" data-toggle="modal" data-target="#confirm-delete">Declined</a></li>
                                                            </ul>
                                                            </span>
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
                    <!-- Ending of Dashboard data-table area -->
                </div>
            </div>
        </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Update Status</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Do you want to proceed?</p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success btn-ok">Proceed</a>
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
</script>
@endsection