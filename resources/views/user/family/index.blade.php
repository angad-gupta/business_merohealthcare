@extends('layouts.user')
@section('title','My Family')
@section('styles')
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<style>
  
  .gj-datepicker-bootstrap [role=right-icon] button .gj-icon, .gj-datepicker-bootstrap [role=right-icon] button .material-icons {
      position: absolute;
      font-size: 21px;
      top: 9px;
      left: 9px;
      color: white;
  }  
      .gj-datepicker-bootstrap [role=right-icon] button {
  width: 38px;
  position: relative;
  border: 0px solid white;
  }

  </style> 

  <style>
    .invalid-feedback{
      color: red
    }

    @media(max-width:768px){
    #h5text{
      margin-top:10px !important;
    }
    }
  </style>
@endsection

@section('content')

@php

  $now = Carbon\Carbon::now()->format('Y-m-d  ');

  @endphp
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
                                  <h2>My Family</h2>
                                  <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Family</p>
                              </div>
                          </div>
                            @include('includes.user-notification')
                      </div>   
                  </div>
                  <div>

                    
                    @include('includes.form-success')
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="table-responsive">
                          <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                            <thead>
                              <tr class="table-header-row">
                                <th>#</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Relation</th>
                                {{-- <th>Prescription File Count</th> --}}
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($family as $member)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $member->name }}</td>
                                  <td>{{ \Carbon\Carbon::parse($member->dob)->diff(\Carbon\Carbon::now())->format('%y years')  }}</td>
                                  <td>{{ $member->gender }}</td>
                                  <td>{{ $member->relation }}</td>
                                  {{-- <td>
                                    @php
                                    $family_count = App\PrescriptionFile::where('family_id','=', $member->id)->count();
                                        
                                    @endphp
                                    <span class="badge g-rounded-20">{{ $family_count }}</span>
                            
                                  </td> --}}
                                  <td>
                                    <input type="hidden" value="{{$member->id}}">
                                    <a href="javascript:;" data-href="{{route('user-family.delete',$member->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i></a>
                                    <a href="{{route('user-family.edit',$member->id)}}"  class="btn btn-primary product-btn"><i class="fa fa-edit"></i> Edit</a>
   
                                    <a href="{{route('user-prescriptions.family-filter',$member->id)}}"  class="btn btn-primary product-btn"><i class="fa fa-list"></i> List Order</a>
                                    <a href="{{route('user-prescriptions.family-create',$member->id)}}"  class="btn btn-primary product-btn"><i class="fa fa-plus"></i> New Order</a>
                                  <a href="javascript:;" data-href="{{route('user-prescriptions.filestorefamily',[$user->id,$member->id])}}" data-toggle="modal" data-target="#add-file" class="btn btn-primary product-btn"><i class="fa fa-file"></i> Add File</a>
                                    <a href="{{route('user-prescriptions.family-file-filter',$member->id)}}"  class="btn btn-primary product-btn"><i class="fa fa-eye"></i> View file</a>
                                 
                                  </td>
                 
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    


                    

                    

                    <div class="container" style="display:none;">
                    <div class="table-responsive">
                      <table id="product-table_wrapper" class="table table-striped table-hover products dt-responsive" cellspacing="0" width="100%">
                        
                        <div class="container">
                        <h4>Famililes Prescriptions List </h4>
                        </div>
                        {{-- <p>Suitable to hide old prescription which is not required to prevent accidental orders on old prescriptions.  </p> --}}
                        <thead>
                          
                          <tr class="table-header-row">
                            <th>#</th>
                            <th>Filename</th>
                            <th>Family Name</th>
                            <th>Family Relation</th>
                            <th>Date</th>
                            {{-- <th>Make Prescription</th> --}}
                            {{-- <th>Actions</th>  --}}
                            
                          </tr>
                        </thead>
                        <tbody>

                          
                        @foreach($p_file as $pf)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('user-file',[$pf->file]) }}">{{ $pf->file}}</a></td>
                           

                            <td>
                              @php
                              $family_name = App\Family::where('id','=', $pf->family_id)->get(); 
                              $user = Auth::user();
                              @endphp

                              @if($pf->family_id == null)
                              {{ $user->name }}
                              @else
                                @foreach ($family_name as $fn)
                                {{ $fn->name }}
                                @endforeach
                              @endif
                          </td>
                            <td>
                              
                                @php
                                $family_name = App\Family::where('id','=', $pf->family_id)->get(); 
                              
                                @endphp
                                @if($pf->family_id == null)
                                 Self
                               @else
                                    @foreach ($family_name as $fn)
                                    {{ $fn->relation }}
                                    @endforeach
                                @endif
                              
                              </td>

                                <td>
                                  {{ $pf->created_at }}
                                </td>
                                {{-- <td>
                                 Make
                                </td> --}}

                              {{-- <td>
                                @if($pf->status == 'active')
                                <span class="label label-success">{{$pf->status}}</span>
                                @else
                                <span class="label label-danger">{{$pf->status}}</span>
                                @endif 
                            </td>




                              <td>
                              @if($pf->status == 'active')
                              <a href="{{route('user-filemanagerupdate', $pf->id)}}" class="btn btn-danger">Inactive</a>
                              @else
                              <a href="{{route('user-filemanagerupdate', $pf->id)}}" class="btn btn-success">Active</a>
                              @endif    
                             
    
                            </td> --}}
                           
                              
                              
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

  <div class="modal fade" id="add-family" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-center" id="myModalLabel">Add new Member</h4>
              </div>
              <div class="modal-body">

                <form class="form-horizontal" action="{{route('user-family.store')}}" method="POST" id="form2">

                  {{ csrf_field() }}

                  {{-- <div class="form-group">
                    <label class="control-label col-sm-4"> Name *<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="name" value="{{ old('name') }}" placeholder=" Name" required="" type="text" >
                      @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
                    </div> --}}

                  <div class="form-group">
                    <label class="control-label col-sm-4">First Name *<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" required="" type="text" >
                      @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4">Middle Name <span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="middlename" value="{{ old('middlename') }}" placeholder="Middle Name" type="text" >
                      @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4">Last Name *<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="LastName" type="text" >
                      @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                    

                  {{-- <div class="form-group">
                      <label class="control-label col-sm-4"> Age *<span></span></label>
                      <div class="col-sm-6">
                        <input class="form-control" name="age" value="{{ old('age') }}" placeholder="Age" required="" type="number" min="1">
                        @if ($errors->has('age'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('age') }}</strong>
                          </span>
                        @endif
                      </div>
                      
                  </div> --}}

                  <div class="form-group">
                    <label class="control-label col-sm-4"> Date of Birth *<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" id="dob" placeholder="YYYY-MM-DD" name="dob" id="reg_name" required>
                        {{-- @if ($errors->has('age'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('age') }}</strong>
                        </span>
                        @endif --}}
                    </div>
                    
                </div>

                  <div class="form-group">
                      <label class="control-label col-sm-4"> Gender *<span></span></label>
                      <div class="col-sm-6">
                        <select class="form-control" name="gender" required="" >
                          <option value="" {{ !old('gender') ? 'selected' : '' }} disabled>Choose an option</option>
                          <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                          <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                          <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @if ($errors->has('gender'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('gender') }}</strong>
                          </span>
                        @endif
                      </div>
                      
                  </div>

                  <div class="form-group">
                      <label class="control-label col-sm-4"> Relation *<span></span></label>
                      <div class="col-sm-6">
                        <input class="form-control" name="relation" value="{{ old('relation') }}" placeholder="Relation" required="" type="text">
                        @if ($errors->has('relation'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('relation') }}</strong>
                          </span>
                        @endif
                      </div>
                      
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-4">Email<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"  type="text" >
                    
                    </div>
                    
                  </div>
  
                  <div class="form-group">
                    <label class="control-label col-sm-4">Phone Number<span></span></label>
                    <div class="col-sm-6">
                      <input class="form-control" name="phone" value="{{ old('phone') }}" placeholder="phone number"  type="text" >
                  
                    </div>
                    
                  </div>

                  <hr>
                  <div class="add-product-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    <button name="add_product_btn" type="submit" class="btn btn-success" >Submit</button>
                  </div>
                </form>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="add-many-family" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel">Add new Members</h4>
            </div>
            <div class="modal-body">

              <form class="form-horizontal" action="{{route('user-family.storemany')}}" method="POST" id="form2">

                {{ csrf_field() }}

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="40%">Name</th>
                        <th scope="col" width="10%">Age</th>
                        <th scope="col" width="20%">Gender</th>
                        <th scope="col">Relation</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody class="family">
                      @php
                          $old_family = old('familys') ? : [];
                      @endphp

                      
                      @forelse ($old_family as $item)
                        <tr class="family-area">
                          <td scope="row">
                              <input class="form-control" name="familys[{{ $loop->iteration -1 }}][name]" value="{{ $item['name'] }}" placeholder="Name" required="" type="text" >
                              @if ($errors->familys->has('familys.'.($loop->iteration-1).'.name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->familys->first('familys.'.($loop->iteration-1).'.name') }}</strong>
                                </span>
                              @endif
                          </td>
                          <td scope="row">
                            <input class="form-control" name="familys[{{ $loop->iteration -1 }}][age]" placeholder="Age" type="number" value="{{ $item['age'] }}" min="1" step="1"></td>
                            @if ($errors->familys->has('familys.'.($loop->iteration-1).'.age'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->familys->first('familys.'.($loop->iteration-1).'.age') }}</strong>
                              </span>
                            @endif
                          <td>
                            <select class="form-control" name="familys[{{ $loop->iteration -1 }}][gender]" required="" >
                              <option value="" {{ !$item['gender'] ? 'selected' : '' }} disabled>Choose an option</option>
                              <option value="Male" {{ $item['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                              <option value="Female" {{ $item['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
                              <option value="Other" {{ $item['gender'] == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @if ($errors->familys->has('familys.'.($loop->iteration-1).'.gender'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->familys->first('familys.'.($loop->iteration-1).'.gender') }}</strong>
                              </span>
                            @endif
                          </td>
                          <td>
                              <input class="form-control" name="familys[{{ $loop->iteration -1 }}][relation]" value="{{ $item['relation'] }}" placeholder="Relation" required="" type="text">
                              @if ($errors->familys->has('familys.'.($loop->iteration-1).'.relation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->familys->first('familys.'.($loop->iteration-1).'.relation') }}</strong>
                                </span>
                              @endif
                          </td>
                          <td width="5%"><button class="btn btn-danger family-close" type="button"><i class="fa fa-trash"></i></td>
                        </tr>
                      @empty
                        <tr class="family-area">
                          <td scope="row">
                              <input class="form-control" name="familys[0][name]" value="{{ old('familys[0].name') }}" placeholder="Name" required="" type="text" >
                              
                          </td>
                          <td scope="row">
                            <input class="form-control" name="familys[0][age]" placeholder="Age" type="number" value="" min="1" step="1"></td>
                            
                          <td>
                            <select class="form-control" name="familys[0][gender]" required="" >
                              <option value="" {{ !old('gender') ? 'selected' : '' }} disabled>Choose an option</option>
                              <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                              <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                              <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            
                          </td>
                          <td>
                              <input class="form-control" name="familys[0][relation]" value="{{ old('relation') }}" placeholder="Relation" required="" type="text">
                              
                          </td>
                          <td width="5%"><button class="btn btn-danger family-close" type="button"><i class="fa fa-trash"></i></td>
                        </tr>
                      @endforelse
                      
                    </tbody>
                  </table>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for=""></label>
                    <div class="col-sm-12 text-center">
                      <button class="btn btn-default featured-btn" type="button" name="add-family-btn" id="add-family-btn"><i class="fa fa-plus"></i> Add More Field</button>
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
  <div class="modal fade" id="add-file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel">Add Prescription File</h4>
            </div>
            <div class="modal-body">
          
                <form class="btn-submit" method="POST" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                {{-- <h3>For {{$member->name}}</h3>
           --}}

                <label class="g-color-gray-dark-v2 g-font-size-13">Prescription Title</label>
                  <div class="control-group ">
                    <input class="form-control" name="title" value="{{ old('title') }}" placeholder="Prescription Title"  type="text" required >
                  </div>
            
                  <br/>
         
     

                  <label class="g-color-gray-dark-v2 g-font-size-13">Family Prescription File Upload (Can be Multiple Files)</label>
                  <input type="file" name="filename[]" class="form-control" required multiple>
                  {{-- <div class="control-group increment" >
                      
                      <div class=""> 
                        <button class="btn btn-default" type="button" style="margin-top:10px; background-color:green; color:white;"><i class="glyphicon glyphicon-plus"></i> Add</button>
                      </div>
                    </div>
                    <div class="clone hide">
                      <div class="control-group " style="margin-top:10px">
                        <input type="file" name="filename[]" class="form-control">
                        <div class=""> 
                          <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                      </div>
                    </div> --}}
                   
                     
                  
                        {{-- <h5 id="h5text" class="g-color-gray-dark-v2 g-font-size-13 " style="margin-bottom: 10px; margin-top:0px;">Family Prescription File Upload For : </h5>
                        <select name="family" class="form-control" id="selectFamily" style="width: 50%; display: inline-block;" required>
                          <option value="{{$member->relation}} ">{{$member->relation}}</option>
                          @foreach($user->family as $fam)
                              @if(isset($fam))
                                  <option {{ $fam->id == $fam->id ? 'selected' : '' }} value="{{$fam->id}}" >{{$fam->name}} ({{$fam->relation}})</option>
                              @else
                                  <option value="{{ $fam->id }}" {{ old('family') == $fam->id ? 'selected' : '' }}>{{$fam->name}} ({{$fam->relation}})</option>

                              @endif
                          @endforeach
                      </select> --}}
                
                      <div class="control-group text-center">
                      <button type="submit" class="btn btn-primary" style="margin-top:15px;">Submit</button>
                      </div>

      
                </form>
         
            </div>
            {{-- <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <form class="btn-ok" action="" method="POST" style="display:inline-block">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div> --}}
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">

  $( document ).ready(function() {
      $(".add-button").append('<div class="col-sm-4 add-product-btn text-right">'+
        '<a style="cursor: pointer;" href="{{route('user-family.create')}}" class="add-newProduct-btn email2">'+
        '<i class="fa fa-plus"></i> Add New Member</a>'+
        '</div>');  

    $('#confirm-delete').on('show.bs.modal', function(e) {
      
        $(this).find('.btn-ok').attr('action', $(e.relatedTarget).data('href'));
    }); 

    $('#add-file').on('show.bs.modal', function(e) {
      
      $(this).find('.btn-submit').attr('action', $(e.relatedTarget).data('href'));
  }); 

    $(document).on('click','#add-family-btn',function() {
      var index = $('.family').children().length;      
                  
      $(".family").append('<tr class="family-area">'+
        '<td scope="row">'+
            '<input class="form-control" name="familys['+index+'][name]" value="" placeholder="Name" required="" type="text" >'+
        '</td>'+
        '<td scope="row">'+
          '<input class="form-control" name="familys['+index+'][age]" placeholder="Age" type="number" value="" min="1" step="1"></td>'+
        '<td>'+
          '<select class="form-control" name="familys['+index+'][gender]" required="" >'+
            '<option value="" selected disabled>Choose an option</option>'+
            '<option value="Male">Male</option>'+
            '<option value="Female">Female</option>'+
            '<option value="Other">Other</option>'+
          '</select>'+
        '</td>'+
        '<td>'+
            '<input class="form-control" name="familys['+index+'][relation]" placeholder="Relation" required="" type="text">'+
        '</td>'+
        '<td width="5%"><button class="btn btn-danger family-close" type="button"><i class="fa fa-trash"></i></td>'+
      '</tr>');

    });   

    $(document).on('click', '.family-close' ,function() {
      
      $(this.parentNode.parentNode).hide();
      $(this.parentNode.parentNode).remove();

      if (isEmpty($('.family'))) {
        $(".family").append('<tr class="family-area">'+
          '<td scope="row">'+
              '<input class="form-control" name="familys[0][name]" value="" placeholder="Name" required="" type="text" >'+
          '</td>'+
          '<td scope="row">'+
            '<input class="form-control" name="familys[0][age]" placeholder="Age" type="number" value="" min="1" step="1"></td>'+
          '<td>'+
            '<select class="form-control" name="familys[0][gender]" required="" >'+
              '<option value="" selected disabled>Choose an option</option>'+
              '<option value="Male">Male</option>'+
              '<option value="Female">Female</option>'+
              '<option value="Other">Other</option>'+
            '</select>'+
          '</td>'+
          '<td>'+
              '<input class="form-control" name="familys[0][relation]" placeholder="Relation" required="" type="text">'+
          '</td>'+
          '<td width="5%"><button class="btn btn-danger family-close" type="button"><i class="fa fa-trash"></i></td>'+
        '</tr>');
      }
    });

    function isEmpty(el){
        return !$.trim(el.html())
    }
                                                                 
  });

</script>

<script type="text/javascript">
    
  $(document).ready(function() {

    // $(".btn-default").click(function(){ 
    //     var html = $(".clone").html();
    //     $(".increment").after(html);
    // });

    // $("body").on("click",".btn-danger",function(){ 
    //     $(this).parents(".control-group").remove();
    // });

  });

</script>

@if(count($errors) > 0)
  <script>
    $('#add-family').modal('show');
  </script>
@elseif(count($errors->familys) > 0)
  <script>
    $('#add-many-family').modal('show');
  </script>
@endif

<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>  
<script>
  $(function() {
     $( "#dob" ).datepicker({ 
          dateFormat: 'yy-mm-dd',
         yearRange: '1950:c+1' ,
         changeMonth: true,
         changeYear: true,
         minDate: new Date(1950, 10 - 1, 25),
         maxDate: '+30Y',
     });
 });
</script>

@endsection