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
                                                    <h2>Lab Vendor Verify</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Lab Vendor <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Lab Vendor Verify</p>
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
                                                    <th>S/No.</th>
                                                    <th style="width: 130px;">Date</th>
                                                    <th style="width: 130px;">Name</th>
                                                    <th style="width: 130px;">Email</th>
                                                    <th style="width: 130px;">Contact</th>
                                                    <th>Date</th>
                                                    <th style="max-width:300px;"> Registration Certificates</th>
                                                    <th >Actions</th>
                                                </tr>
                                              </thead>

                                              <tbody>
                                                @foreach($users as $vendor)                                                  

                                                    <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td> {{date('d M Y',strtotime($vendor->created_at))}} </td>
                                                        <td> {{$vendor->name}}</td>
                                                        <td> {{$vendor->email}}</td>
                                                        <td> {{$vendor->phone}}</td>
                                                        <td>{{date('d M Y',strtotime($vendor->created_at))}}</td>
                                                        <td>

                                                            @php
                                                                $decoded = json_decode($vendor->registration_file, true);
                                                      
                                                            @endphp


                                                        
                                                            @foreach((array)$decoded as $d)
                                                                <a href="{{route('admin-lab-vendor-reg-file',[$vendor->id,$d])}}" target="_blank"><i class="fa fa-image"></i></a>
                                                            @endforeach
                                                           
                                                        </td>
                                                        <td>
                                                        @if($vendor->verified_at == null)
                                                        <a href="javascript:;" class="btn btn-warning" data-href="{{route('admin-lab-vendor-verify',$vendor->id )}}" data-toggle="modal" data-target="#confirm-delete" style="border-radius:30px;">Verify</a>
                                                        @else
                                                        <span class="badge badge-pill badge-success" style="background-color:#4bcc4b;">Verified</span>
                                                        @endif
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