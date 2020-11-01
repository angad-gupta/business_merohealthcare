@extends('layouts.admin')
        
@section('content')
    <div class="right-side">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Starting of Dashboard area -->
                    <div class="section-padding add-product-1">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="add-product-box">
                                    <div class="product__header" style="border-bottom: none;">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Business Order Details <a href="{{ route('admin-business-prescriptions-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> </h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Business Order <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Business Order Details</p>
                                                </div>
                                            </div>
                                            @include('includes.notification')
                                        </div>   
                                    </div>

                                    <main>

                                        @include('includes.form-success')

                                        <div class="order-table-wrap">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="tr-head">
                                                                    <th class="order-th" width="45%">Business Order ID</th>
                                                                    <th width="10%">:</th>
                                                                    <th class="order-th" width="45%">{{$business_prescriptions->id}}</th>
                                                                </tr>

                                                                {{-- <tr>
                                                                    <th width="45%">Product Name</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$product->name}}</td>
                                                                </tr> --}}

                                                                <tr>
                                                                    <th width="45%">Quantity</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{$business_prescriptions->quantity}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Ordered By</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{ $business_prescriptions->user_id }}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <th width="45%">Ordered Date</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($business_prescriptions->created_at))}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Status</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">
                                                                        <button class="btn btn-danger product-btn dropdown-toggle btn-xs" type="button" data-toggle="dropdown" style="font-size: 14px;
                                                            
                                                                            @if($business_prescriptions->status == "completed")
                                                                            {{ "background-color: #01c004;" }}
                                                                            @elseif($business_prescriptions->status == "processing")
                                                                            {{ "background-color: #02abff;" }}
                                                                            @elseif($business_prescriptions->status == "declined")
                                                                            {{ "background-color: #d9534f;" }}
                                                                            @else
                                                                            {{"background-color: #ff9600;"}}
                                                                            @endif
                                                                        
                                                                        ">{{ucfirst($business_prescriptions->status)}} <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" style="position: unset;">
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $business_prescriptions->id, 'status' => 'processing'])}}" data-toggle="modal" data-target="#confirm-delete">Processing</a></li>
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $business_prescriptions->id, 'status' => 'completed'])}}" data-toggle="modal" data-target="#confirm-delete">Completed</a></li>
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $business_prescriptions->id, 'status' => 'declined'])}}" data-toggle="modal" data-target="#confirm-delete">Declined</a></li>
                                                                            </ul>
                                                                        </span>
                                                                    </td>
                                                                </tr>
    
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr class="tr-head">
                                                                <th class="order-th" width="45%">Contact Details</th>
                                                                <th width="10%"></th>
                                                                <th width="45%"></th>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Name</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$business_prescriptions->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Email</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$business_prescriptions->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Phone</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$business_prescriptions->phone}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Address</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$business_prescriptions->address}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Pan / Vat</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$business_prescriptions->pan_vat}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Registration no.</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$business_prescriptions->reg_no}}</td>
                                                            </tr>


                                                        </tbody></table>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr class="tr-head">
                                                                <th class="order-th" width="45%">Registration Certificate File</th>
                                                                <th width="10%">:</th>
                                                                <th width="45%"><a href="{{ route('admin-businessorder-reg-file',[$business_prescriptions->id,$business_prescriptions->reg_certificate_file]) }}" target="_blank">{{ $business_prescriptions->reg_certificate_file }}</a></th>
                                                            </tr>
                                                            @if($business_prescriptions->additional_info)
                                                                <tr>
                                                                    <th width="45%">Message</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{ $business_prescriptions->additional_info }}</td>
                                                                </tr>
                                                            @endif

                                                            <tr class="tr-head">
                                                                <th class="order-th" width="45%">Business Order File</th>
                                                                <th width="10%">:</th>
                                                                <th width="45%">
                                                                    @foreach($business_prescriptions->files as $file)
                                                                    <a href="{{ route('admin-businessorder-file',[$business_prescriptions->id,$file->file,$file->id]) }}" target="_blank">{{ $file->file}}</a>
                                                                <br/>
                                                                    @endforeach
                                                                </th>
                                                            </tr>
                                                        </tbody></table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        
                                        <br>
                                        
                                    </main>
                                    <hr>
                                    <div class="text-center">
                                        <input type="hidden" value="{{$business_prescriptions->email}}">
                                        <a style="cursor: pointer;" data-toggle="modal" data-target="#emailModal3" class="btn btn-success email"><i class="fa fa-send"></i> Send Email</a>
                                        <a style="cursor: pointer;" href="{{ route('admin-business-prescription-invoice',$business_prescriptions->id) }}" class="btn btn-primary"><i class="fa fa-file"></i> {{ $business_prescriptions->invoice ? 'View Invoice' : 'Generate Invoice' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ending of Dashboard area --> 
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
                    <a  class="btn btn-success btn-ok">Proceed</a>
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