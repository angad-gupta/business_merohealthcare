@extends('layouts.user')
@section('title','My Businessorders')
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
                                  <h2>My Business Orders </h2>
                                  <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Business Orders</p>
                              </div>
                          </div>
                            @include('includes.user-notification')
                      </div>   
                  </div>
                  <div>
                    @include('includes.form-success')
{{-- 
                    <div class="container" style="padding:2rem;">
                      <h5>Filter with Family Associates</h5>
                      
                      <form method="POST" action="{{route('user-prescriptions.family')}}" class="g-brd-around g-brd-gray-light-v4 g-pa-30 g-mb-30" enctype="multipart/form-data">
                        {{csrf_field()}}
                      
                        
                        
                        <input hidden name="user_id" value="{{$user->id}}"/>
                        <div class="col-lg-6 col-md-12 col-sm-12" style="display:inline-flex;">
                      <select name="family_id" class="form-control form-control-md rounded-0 g-mb-25">
                        <option value=" ">Self</option>
                      
                        @foreach($families as $family)
                        <option value="{{ $family->id}}" >{{ $family->name}}</option>
                    
                        @endforeach
                      </select>
                    
                    
                      <button class="btn btn-primary" type="submit" role="button" style="margin-right:1rem;">Search</button>
                      <a href="{{ route('user-prescriptions.index')}}" class="btn btn-warning pull-right"><i class="fa fa-eye" aria-hidden="true"></i> View All</a>
               
                  </div>
                        
                  
                    </form>

                  
                     
                      
                    </div> --}}

                    
                     
                  
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="table-responsive">
                          {{-- <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%"> --}}
                            <table id=" " class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                            <thead>
                              <tr class="table-header-row">
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                                {{-- <th>Affiliated To</th> --}}
                                <th>Business Orders files</th>
                                <th>Status</th>
                                {{-- <th>Details</th> --}}
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($businessorders as $businessorder)

                              @php
                              $p = App\Product::findOrFail($businessorder->product_id);
                                  
                              @endphp
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td><a href="{{route('front.product',[$p->id,$p->name ])}}">{{$p->name}}</a></td>
                                  <td>{{date('d M Y',strtotime($businessorder->created_at))}}</td>
                                  {{-- <td>{{ $prescription->family ? $prescription->family->name : 'Self' }}</td> --}}
                                  <td>
                                    @foreach($businessorder->files as $file)
                                    <a href="{{ route('user-businessorders.file',[$businessorder->id,$file->file,$file->id]) }}" target="_blank" title="{{ $file->file }}">{!! $file->file  ? : '<i class="fa fa-file"></i>' !!}</a>
                                      <br/>
                                        @endforeach
                                  </td>
                                  <td>
            
                                     @if($businessorder->status == 'processing')
                                    <span class="label label-primary" style="border-radius: 30px;padding: 4px 8px;font-size: 12px;">{{ucfirst($businessorder->status)}}</span> 
                                    @elseif($businessorder->status == 'cancelled')
                                    <span class="label label-danger" style="border-radius: 30px;padding: 4px 8px;font-size: 12px;">{{ucfirst($businessorder->status)}}</span> 

                                    @endif

                                    @if($businessorder->status == 'cancelled')
                                    
                                    @else 
                                    {{-- <a href="javascript:;" data-href="{{route('user-family.delete',$member->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i></a> --}}
                           
                                    <a href="javascript:;" data-href="{{route('user-businessorder.update-status',$businessorder->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" style="border-radius : 30px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    {{-- <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></button> --}}
                                    @endif

                     

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
        </div>
        <!-- Ending of Dashboard data-table area -->

        
      </div>
    </div>
  </div>

  <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content text-center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Business Order ?</h4>
      </div>
      <div class="modal-body">
        <p>Are you Sure u want to cancel?</p>

        {{-- <a href="{{route('user-prescriptions.update-status',$prescription->id)}}" class="btn btn-danger"> Proceed </i></a> --}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <div class="modal fade" id="add-reminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel">Add Reminder</h4>
            </div>
            <div class="modal-body">

              <form class="form-horizontal btn-add" action="" method="POST" id="form2">

                {{ csrf_field() }}
                
                <div class="form-group">
                  <label class="control-label col-sm-4"> Duration *<span>(Repeated after every 'x' days from Order date)</span></label>
                  <div class="col-sm-6">
                    
                    <input class="form-control" name="duration" value="{{ old('duration') }}" placeholder="Duration in days" type="number" value="" min="1">
                    {{-- @if ($errors->has('duration'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('duration') }}</strong>
                      </span>
                    @endif --}}
                  </div>
                  
                </div>

                <hr>
                <div class="add-product-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                  <button name="add_product_btn" type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="edit-reminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel">Edit Reminder</h4>
            </div>
            <div class="modal-body">

              <form class="form-horizontal btn-edit" action="" method="POST" id="form2">

                {{ csrf_field() }}

                <div class="form-group">
                  <label class="control-label col-sm-4"> Duration *<span>(Repeated after every 'x' days from Order date)</span></label>
                  <div class="col-sm-6">
                    
                    <input class="form-control" name="duration" value="" placeholder="Duration in days" type="number" value="" min="1">
                    {{-- @if ($errors->edit->has('duration'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->edit->first('duration') }}</strong>
                      </span>
                    @endif --}}
                  </div>
                  
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4"> Status *<span></span></label>
                    <div class="col-sm-6">
                      <label class="switch">
                        <input type="checkbox" name="status" value="1">
                        <span class="slider round"></span>
                      </label>
                      {{-- @if ($errors->edit->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->edit->first('status') }}</strong>
                        </span>
                      @endif --}}
                    </div>
                    
                </div>

                <hr>
                <div class="add-product-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" data-href="" data-toggle="modal" data-target="#confirm-delete" style="float:left">Delete</button>

                  <button name="add_product_btn" type="submit" class="btn btn-success">Save</button>
                </div>
              </form>
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
                <p class="text-center">You are about to delete.</p>
                <p class="text-center">Do you want to proceed?</p>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <form class="btn-ok" action="" method="POST" style="display:inline-block">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
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

  $('#add-reminder').on('show.bs.modal', function(e) {
      
      $(this).find('.btn-add').attr('action', $(e.relatedTarget).data('href'));
  });

  $('#edit-reminder').on('show.bs.modal', function(e) {
      var reminder = $(e.relatedTarget).data('reminder');
      
      $(this).find('input[name="duration"]').val(reminder.duration);
      $(this).find('.btn-danger').attr('data-href',"/user/prescriptions/"+reminder.notifiable_id+"/reminder/delete");
      
      if(reminder.status)
        $(this).find('input[name="status"]').attr('checked','checked');
      else
        $(this).find('input[name="status"]').removeAttr('checked');

      if($(this).find('input[name="status"]')[0].checked != reminder.status)
        $(this).find('input[name="status"]').trigger("click");

      $(this).find('.btn-edit').attr('action', $(e.relatedTarget).data('href'));
  });

  $('#confirm-delete').on('show.bs.modal', function(e) {
      
      $(this).find('.btn-ok').attr('action', $(e.relatedTarget).data('href'));
  }); 


//   $(document).ready(function () {
// $('#dtOrderExample').DataTable({
// "order": [[4, "desc" ]]
// });
// $('.dataTables_length').addClass('bs-select');
// });
  
</script>

@endsection