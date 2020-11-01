@extends('layouts.user')
@section('title','My Prescriptions')
@section('content')

<style>
  .btn-warning {
    border-radius:30px;
  }
  .btn-primary {
    border-radius:30px;
  }
  .btn-success {
    border-radius:30px;
  }

  .btn{
    padding: 3px 6px;
  }


  </style>
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
                                  <h2>My Prescription Orders <a href="http://localhost:8000/user/family" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a> </h2>
                                  <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Prescriptions</p>
                              </div>
                          </div>
                            @include('includes.user-notification')
                      </div>   
                  </div>
                  <div>
                    @include('includes.form-success')
                    
                  <div class="container" style="margin-top:15px">
                  <h4> Prescriptions</h4>
                  </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="table-responsive">
                          <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                            <thead>
                              <tr class="table-header-row">
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                             
                                <th >Prescription Files</th>
                             

                                <th>Status</th>
                                <th>Details</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($prescriptions as $prescription)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $prescription->title}}</td>
                                  <td>{{date('d M Y h:i A',strtotime($prescription->created_at))}}</td>
                                 
                                  <td style="max-width:150px;">
                                    @foreach($prescription->files as $file)
                                  <span><a href="{{ route('user-prescriptions.file',[$prescription->id,$file->file,$file->id]) }}" target="_blank" title="{{ $file->file }}"><img src="{{asset('storage/app/public/prescriptions/'.$file->file)}}" style="height:40px;width:40px;border-radius:10px;" alt="{{$file->file}}"/></a></span>
                                    
                                      @endforeach
                                  </td>

                                
                                  <td>
                                    @if($prescription->status == 'processing')
                                    <span class="label label-primary" style="border-radius: 30px;padding: 4px 8px;font-size: 12px;"> <i class="fa fa-spinner fa-spin"></i>
                                      <span class="sr-only">Loading...</span> {{ucfirst($prescription->status)}}</span> 
                                    @elseif($prescription->status == 'cancelled')
                                    <span class="label label-danger" style="border-radius: 30px;padding: 4px 8px;font-size: 12px;">{{ucfirst($prescription->status)}}</span> 
                                    @elseif($prescription->status == 'declined')
                                    <span class="label label-danger" style="border-radius: 30px;padding: 4px 8px;font-size: 12px;">{{ucfirst($prescription->status)}}</span> 


                                    @endif

                                    @if($prescription->status == 'cancelled')
                                    
                                    @else 
                                    {{-- <a href="javascript:;" data-href="{{route('user-family.delete',$member->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i></a> --}}
                           
                                    <a href="javascript:;" data-href="{{route('user-prescriptions.update-status',$prescription->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" style="border-radius : 30px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    {{-- <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></button> --}}
                                    @endif
                                  </td>

                                 
                                  
                                  <td >
                                    <div class="row text-center">
                                    @if($prescription->status == 'cancelled')
                                      No action
                                    @else
                                            @php
                                                $reminder = $prescription->reminder()->select('id','notifiable_id','duration','status','start_date')->first();
                                            @endphp
                                            @if(!$reminder)
                                              <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#add-reminder" data-href="{{route('user-prescriptions.addreminder',$prescription->id)}}" data-effect="fadein" title="Set Reminder"><i class="fa fa-pencil" aria-hidden="true" title="Set you repeating order reminder"></i> </a><br>
                                            @else
                                              <a href="javascript:;" class="btn btn-warning" data-toggle="modal" data-target="#edit-reminder" data-href="{{route('user-prescriptions.editreminder',$prescription->id)}}" data-reminder="{{ json_encode($reminder) }}" data-effect="fadein" title="Edit Reminder"><i class="fa fa-cog" aria-hidden="true" title="Edit your repeating days remainder"></i></a><br>
                                            @endif
                                            @if($prescription->invoice)
                                              <a class="btn btn-info" style="margin-top:5px;"  href="{{route('user-prescriptions.invoice',$prescription->id)}} "><i class="fa fa-file" aria-hidden="true" title="View Order Invoice"></i></a><br>
                                            @endif
                                          
                                            {{-- @if($prescription->status == 'completed') --}}
                                              
                                              <form action="{{route('user-prescriptions.reorder',$prescription->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-success" style="border: 0;margin-top:5px; "><i class="fa fa-refresh" aria-hidden="true" title="Re-order this Order"></i></button>
                                              </form>
                                            {{-- @endif --}}
                                      @endif

                                    </div>


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
{{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> --}}

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content text-center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Prescription Order ?</h4>
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

              <h5 class="text-center">Repeat the Order Reminder certain days. Please input the day below : eg- 15 days</h5>

              <form class="form-horizontal btn-add" action="" method="POST" id="form2">

                {{ csrf_field() }}
                
                <div class="form-group">
                  
                  <label class="control-label col-sm-4"> Duration Days</label>
                  
                  <div class="col-sm-6">

                    
                    <input class="form-control" name="duration" value="{{ old('duration') }}" placeholder="Duration in 'x' days" type="number" value="" min="1" step="1">
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
              <h5 class="text-center">You Order Repeats in following days.</h5>

              <form class="form-horizontal btn-edit" action="" method="POST" id="form2">

                {{ csrf_field() }}

                <div class="form-group">
                  <label class="control-label col-sm-4"> Duration Days </label>
                
                  <div class="col-sm-6">
                    
                    <input class="form-control" name="duration" value="" placeholder="Duration in days" type="number" value="" min="1" step="1"> 
                    {{-- @if ($errors->edit->has('duration'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->edit->first('duration') }}</strong>
                      </span>
                    @endif --}}
                  </div>

                  {{-- <div class="col-sm-3">
                    Days
                  </div>
                  </div> --}}
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

                <div class="form-group">
                  <label class="control-label col-sm-4"> Delete Remainder *<span></span></label>
                  <div class="col-sm-6">
                    <button type="button" class="btn btn-danger" data-href="" data-toggle="modal" data-target="#confirm-delete" style="float:left"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                  </div>
                  
              </div>

               

                <hr>
                <div class="add-product-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  

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
      $(".add-button").append('<div class="col-sm-4 add-product-btn text-center ">'+
        '<a style="cursor: pointer;" href="{{ route("user-prescriptions.create",$user->id) }}" class="add-newProduct-btn email2">'+
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