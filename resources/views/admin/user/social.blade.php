@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/css/unify-globals.css">
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
                                                    <h2>Social Login Customers</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Social Login Customers List</p>
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
                                                    <th style="width: 130px;">Date</th>
                                                    <th style="width: 100px;">Total Orders</th>
                                                    <th style="width: 239px;">Customer's Name</th>
                                                    <th style="width: 171px;">Customer's Email</th>
                                                    <th style="width: 134px;">Login Type</th>
                                                    <th style="width: 340px;">Actions</th>
                                                  </tr>
                                              </thead>

                                              <tbody>
                                                @foreach($users as $user)                                                  
                                              <tr role="row" class="odd">
                                                <td> {{date('d M Y',strtotime($user->created_at))}} </td>
                                                <td>
                                                    @php
                                                        $orders = App\Order::where('user_id','=',$user->id)->get();
                                                    @endphp
                                                    <span class="label label-primary" style="border-radius: 20px;">{{count($orders)}}</span>
                                                </td>
                                                      <td tabindex="0" class="sorting_1">{{$user->name}}</td>
                                                      <td>{{$user->email}}</td>

                                                     
                                                        <td>
                                                        @if($user->is_provider == 1)
                                                            @php 
                                                                $social = App\SocialProvider::where('user_id','=',$user->id)->first();
                                                            @endphp
                                                            @if($social->provider == 'google')
                                                                <a class="u-icon-v3 g-bg-google-plus g-rounded-30x g-color-white g-color-white--hover g-mr-0 g-mb-20" style="padding:5px;border-radius:30%;" href="#!">
                                                                    <i class="fa fa-google"></i>
                                                                </a>
                                                            @elseif(($social->provider == 'facebook')) 
                                                
                                                                <a class="u-icon-v3 g-bg-facebook g-rounded-30x g-color-white g-color-white--hover g-mr-15 g-mb-20" style="padding:5px;border-radius:30%;" href="#!">
                                                                    <i class="fa fa-facebook"></i>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                   







                                              
                                                      <td>
                                                        <input type="hidden" value="{{$user->email}}">
                                                      <a href="{{route('admin-user-show',$user->id)}}" class="btn btn-primary product-btn"><i class="fa fa-check"></i> View Details</a>
                                                      <a href="{{route('admin-user-edit',$user->id)}}" class="btn btn-info product-btn"><i class="fa fa-edit"></i> Edit</a>
                                                      <a style="cursor: pointer;" class="btn btn-success product-btn email1"  data-toggle="modal" data-target="#emailModal1"><i class="fa fa-send"></i> Send Message</a>
                                                        <a href="javascript:;" data-href="{{route('admin-user-delete',$user->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i> Remove</a>
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