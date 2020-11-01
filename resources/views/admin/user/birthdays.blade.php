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
                                        <div class="row reorder-xs">
                                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="product-header-title">
                                                    <h2>Birthday Customers</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Birthday List</p>
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
                                                    <th style="width: 130px;">Day</th>
                                                    <th style="width: 239px;"> Name</th>
                                                    <th style="width: 171px;">Customer's Email</th>
                                                    <th style="width: 171px;">Action</th>
                                                  
                                                    {{-- <th style="width: 340px;">Actions</th> --}}
                                                  </tr>
                                              </thead>

                                              <tbody>
                                                @php
                                                    $now = Carbon\Carbon::now()->format('m-d');
                                                @endphp
                                                @foreach($users as $user)   
                                                
                                               
                                              <tr role="row" class="odd">
                                                <td> 
                                                    @if($user->orderNo == $now)
                                                        <span style="color: green">Today </span>
                                                    @else
                                                        {{$user->day}} 
                                                    @endif
                                                </td>
                                            
                                                      <td tabindex="0" class="sorting_1">
                                                        @if($user->orderNo == $now)
                                                            <span style="color: green"> {{$user->name}} </span>
                                                        @else
                                                            {{$user->name}} 
                                                        @endif
                                                        </td>
                                                      <td>
                                                        @if($user->orderNo == $now)
                                                            <span style="color: green"> {{$user->email}} </span>
                                                        @else
                                                            {{$user->email}} 
                                                        @endif
                                                        </td>

                                                        <td>
                                                            <a href="{{route('admin-user-show',$user->id)}}" class="btn btn-primary product-btn"><i class="fa fa-check"></i> View Details</a>
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
                    <h4 class="modal-title text-center" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">You are about to delete this User. Everything will be deleted under this User.</p>
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
</script>

@endsection