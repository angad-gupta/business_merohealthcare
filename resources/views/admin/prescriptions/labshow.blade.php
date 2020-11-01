@extends('layouts.admin')
        
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

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
                                                    <h2>Lab Prescription Details <a href="{{ route('admin-prescriptions-lab-index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> </h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i>Lab Prescriptions <i class="fa fa-angle-right" style="margin: 0 2px;"></i>Lab Prescription Details</p>
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
                                                                    <th class="order-th" width="45%">Lab Prescription ID</th>
                                                                    <th width="10%">:</th>
                                                                    <th class="order-th" width="45%">{{$prescription->id}}</th>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Ordered By</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{!! $prescription->user_id ? '<a href="'.route('admin-user-show',$prescription->user_id).'" target="_blank">'.$prescription->user->name.'</a>' : 'Guest' !!}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <th width="45%">Ordered Date</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($prescription->created_at))}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <th width="45%">Status</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">
                                                                        <button class="btn btn-danger product-btn dropdown-toggle btn-xs" type="button" data-toggle="dropdown" style="font-size: 14px;
                                                            
                                                                            @if($prescription->status == "completed")
                                                                            {{ "background-color: #01c004;" }}
                                                                            @elseif($prescription->status == "processing")
                                                                            {{ "background-color: #02abff;" }}
                                                                            @elseif($prescription->status == "declined")
                                                                            {{ "background-color: #d9534f;" }}
                                                                            @else
                                                                            {{"background-color: #ff9600;"}}
                                                                            @endif
                                                                        
                                                                        ">{{ucfirst($prescription->status)}} <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" style="position: unset;">
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $prescription->id, 'status' => 'processing'])}}" data-toggle="modal" data-target="#confirm-delete">Processing</a></li>
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $prescription->id, 'status' => 'completed'])}}" data-toggle="modal" data-target="#confirm-delete">Completed</a></li>
                                                                                <li><a href="javascript:;" data-href="{{route('admin-prescription-status',['id1' => $prescription->id, 'status' => 'declined'])}}" data-toggle="modal" data-target="#confirm-delete">Declined</a></li>
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
                                                                <th width="10%">:</th>
                                                                <th width="45%">
                                                                    @if($prescription->latlong)
                                                                        <a href="javascript:;" title="View in Map" data-toggle="modal" data-target="#billingLocationModal" style="font-size: 20px;"><i class="fa fa-map-marker"></i></a>
                                                                    @endif
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Name</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$prescription->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Email</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$prescription->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Phone</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$prescription->phone}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="45%">Address</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">{{$prescription->location}}</td>
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
                                                                <th class="order-th" width="45%">Prescription File(s):</th>
                                                                {{-- <th width="5%">:</th> --}}
                                                                
                                                            </tr>

                                                            <tr>
                                                                <th width="45%">Files</th>
                                                                <th width="10%">:</th>
                                                                <td width="45%">
                                                                    @foreach($prescription->files as $file) 
                                                                 
                                                                    <a href="{{ route('admin-prescription-file',[$prescription->id,$file->file,$file->id]) }}" target="_blank"><img src="{{asset('storage/app/public/prescriptions/'.$file->file)}}" style="height:40px;width:40px;border-radius:10px;" alt="{{$file->file}}" title="{{$file->file}}"/></a>
                                                               
                                                                    
                                                                    @endforeach 
                                                                </td>
                                                            </tr>
                                                            @if($prescription->additional_info)
                                                                <tr>
                                                                    <th width="45%">Message</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{ $prescription->additional_info }}</td>
                                                                </tr>
                                                            @endif

                                                            @if($prescription->family_id != null)

                                                                @php
                                                                    $family = App\Family::findOrFail($prescription->family_id);
                                                                @endphp

                                                                @if($family)
                                                                <tr>
                                                                    <th width="45%">Family name</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{ $family->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="45%">Family Relation</th>
                                                                    <th width="10%">:</th>
                                                                    <td width="45%">{{ $family->relation }}</td>
                                                                </tr>
                                                                @endif
                                                            @endif
                                                            
                                                        </tbody></table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        
                                        <br>

                                        @php
                                            $labattachment = App\LabPrescription::where('prescription_id','=',$prescription->id)->get();
                                        @endphp

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="container">
                                                <h4>Lab Attachement Sent</h4>
                                                    
                                                        <div class="table-responsive">
                                                            
                                                            <table class="table">
                                                              <thead>
                                                                <tr>
                                                                  <th>#</th>
                                                                  <th>Lab Test Name</th>
                                                                  <th >Vendor</th>
                                                                </tr>
                                                              </thead>
                                                              @forelse($labattachment as $la)
                                                                @php
                                                                $decoded = json_decode($la->lab_id, true);
                                                                @endphp
                                                               
                                              
                                                              <tbody>
                                                                <tr>
                                                                  <td>{{$loop->iteration}}</td>
                                                                  <td>
                                                                    @foreach((array)$decoded as $pid)
                                                                    @php
                                                                    $product = Modules\Lab\Entities\LabProduct::findorFail($pid);
                                                                    @endphp
                                                                    
                                                                    <p class="text-left">{{$loop->iteration}}. {{$product->name}}</p>
                                                                
                                                                    @endforeach
                                                                  </td>
                                                                  <td >
                                                                      @php
                                                                        $ven = App\User::where('id','=',$la->vendor_id)->get();
                                                                      @endphp
                                                                      @foreach($ven as $v)
                                                                        {{$v->name}}
                                                                        @endforeach
                                              
                                                                  </td>
                                                                  
                                                                   
                                                                </tr>
                                                              </tbody>
                                                              @empty
                                                              No Attachment Found
                                                          @endforelse
                                                        
                                                            </table>
                                                            
                                                  
                                                          </div>
                                                  
                                                </div>
                                            </div>
                                        </div>

                                        <br/>

                                        <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="container">
                                            <h4>Send Lab Test Attachement</h4>
                                            </div>
                                        <div class="text-center" style="display: inline-flex;">
                
                                           @php
                                           $labtests = Modules\Lab\Entities\LabProduct::all();
                                           $vendors = App\User::where('is_vendor','=',2)->get();
                                           @endphp
                                          <form action="{{ route('admin-prescription-lab-invoice',$prescription->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="container" style="display: inline-flex;">
                                                <input name="user_id" value="{!! $prescription->user_id ? $prescription->user_id : null !!}" hidden>
                                                <input name="prescription_id" value="{{$prescription->id}}" hidden>
                                                <input name="status" value="1" hidden>
                                                <input name="name" value="{{$prescription->name}}" hidden>
                                                <input name="email" value="{{$prescription->email}}" hidden>

                                            <label class="container" style="width: 25%;">Select test : </label>
                                            <select class="form-control category-multiple" name="lab_ids[]" multiple="multiple" required style="width:80%">
                                                <option></option>
                                                @if($labtests->where('type','Package')->count() > 0)
                                                <optgroup label="Packages">
                                                    @foreach($labtests->where('type','Package') as $test)
                                                    <option value="{{$test->id}}" >{{ $test->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endif
                                                <optgroup label="Tests">
                                                @foreach($labtests->where('type','Test') as $test)
                                                    <option value="{{$test->id}}" >{{ $test->name }}</option>
                                                @endforeach
                                                </optgroup>
                                            </select>
                                            </div>
                                            <div class="container" style="display: inline-flex; margin-bottom:15px;">

                                            <label class="container" style="width: 25%;">Select Vendor : </label>
                                            <select class="form-control category-multiple-vendor" name="vendor_id" required style="width:80%">
                                                <option></option>
                                                @foreach($vendors as $v)
                                                    <option value="{{$v->id}}" >{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <br>
                                            <button class="btn btn-primary" type="submit">Send to user</button>
                                            </div>
                                          </form>
                                        
                                        </div>
                                    </div>

                                        
                                    </main>
                                    <hr>
                                    <div class="text-center" >
                                        <input type="hidden" value="{{$prescription->email}}">
                                        <a style="cursor: pointer;margin-bottom:15px;" data-toggle="modal" data-target="#emailModal3" class="btn btn-success email"><i class="fa fa-send"></i> Send Email</a>
                                        
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
                    <a class="btn btn-success btn-ok">Proceed</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="billingLocationModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="margin-top: 0;">
            <div class="modal-header text-center" style="border-bottom: none;padding-bottom: 0">
                <h4><strong>Billing Location</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            
            <div class="modal-body text-center">
                
                <div id="map" style="height: 500px"></div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-neutral" data-dismiss="modal" aria-label="Close">OK</button>
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
    
    <script>
         
        function initMap() {
            var myLatLng = JSON.parse('<?php echo $prescription->latlong ?>');
  
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: myLatLng
            });
    
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '{{ $prescription->location }}'
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script type="text/javascript">
    $('.category-multiple').select2({
        placeholder: 'Select For Tests'
    });
    </script>

        <script type="text/javascript">
            $('.category-multiple-vendor').select2({
                placeholder: 'Select For Vendors'
            });
            </script>


    @if($prescription->latlong)
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcvyYLSF2ngh8GM7hX7EQ3dIcQGbGnx5Q&callback=initMap">
        </script>
    @endif
@endsection