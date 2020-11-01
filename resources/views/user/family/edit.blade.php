@extends('layouts.user')
@section('title','Edit Family')

@section('styles')
  <style>
    .invalid-feedback{
      color: red
    }
  </style>

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
@endsection

@section('content')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<div class="right-side">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- Starting of Dashboard area -->
          <div class="section-padding add-product-1">
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="add-product-box">
                        <div class="product__header"  style="border-bottom: none;">
                            <div class="row reorder-xs">
                                <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                                    <div class="product-header-title">
                                        <h2>Edit Family <a href="{{ route('user-family.index') }}" style="padding: 5px 12px;" class="btn add-back-btn"><i class="fa fa-arrow-left"></i> Back</a></h2>
                                        <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> My Family <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Edit
                                    </div>
                                </div>
                                  @include('includes.user-notification')
                            </div>   
                        </div>
                        <hr>
                        <div>
                          
                          @include('includes.form-success')

      
                          <!-- Tab panes -->
                          <div class="tab-content">

                            <div class="tab-pane fade active in" id="digital">
                                    <form class="form-horizontal" action="{{route('user-family.update',$member->id)}}" method="POST" id="form2">

                                        {{ csrf_field() }}
                          
                                        <div class="form-group">
                                            <label class="control-label col-sm-4"> First Name *<span></span></label>
                                            <div class="col-sm-6">
                                            <input class="form-control" name="firstname" value="{{ $firstname }}" placeholder="First Name" required="" type="text" >
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
                                            <input class="form-control" name="middlename" value="{{ $member->middlename }}" placeholder="Middle Name" type="text" >
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
                                            <input class="form-control" name="lastname" value="{{ $lastname }}" placeholder="Last Name" required="" type="text" >
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
                                                <input class="form-control" name="age" value="{{ $member->age }}" placeholder="Age" required="" type="number" min="1">
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
                                                <input class="form-control" id="dob" name="dob" value="{{ $member->dob }}" placeholder="YYYY-MM-DD" required=""  >
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
                                                <option value="" disabled>Choose an option</option>
                                                <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ $member->gender == 'Other' ? 'selected' : '' }}>Other</option>
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
                                                <input class="form-control" name="relation" value="{{ $member->relation }}" placeholder="Relation" required="" type="text">
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
                                              <input class="form-control" name="email" value="{{ $member->email }}" placeholder="Email"  type="text" >
                                            
                                            </div>
                                            
                                          </div>
                          
                                          <div class="form-group">
                                            <label class="control-label col-sm-4">Phone Number<span></span></label>
                                            <div class="col-sm-6">
                                              <input class="form-control" name="phone" value="{{ $member->phone }}" placeholder="phone number"  type="text" >
                                          
                                            </div>
                                            
                                          </div>
                        
                                        <hr>
                                        <div class="add-product-footer">
                                            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         --}}
                                            <button name="add_product_btn" type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                            </div>

                          </div>

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

@endsection

@section('scripts')


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>  

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',

    });
</script>

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
