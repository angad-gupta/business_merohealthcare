@extends('layouts.admin')
@section('title','Comments')

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
                                                    <h2>Comments</h2>
                                                    <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Product Discussion <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Comments</p>
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
                                                    <th style="width: 130px;">Product</th>
                                                    <th style="width: 150px;">Commenter</th>
                                                    <th style="width: 100px;">Comment</th>
                                                    <th style="width: 160px;">Action</th></tr>
                                              </thead>

                                              <tbody>
                                                @foreach($comments as $comment)                                                  

                                                    <tr>
                                                        <td>
                                                    <a target="_blank" href="{{route('front.product',['id1' => $comment->product->id, str_slug($comment->product->name,'-')])}}">
                                                    {{ strlen($comment->product->name) > 45 ? substr($comment->product->name,0,45).'...' : $comment->product->name }}
                                                          </a></td>
                                                    <td>{{ $comment->user->email }}</td>
                                                    <td>{{ strlen($comment->text) > 45 ? substr($comment->text,0,45).'...' : $comment->text  }}</td>
                                                    <td>
                                                      <input type="hidden" value="{{$comment->user->email}}">
                                                      <a href="{{route('admin-comment-show',$comment->id)}}" class="btn btn-primary product-btn"><i class="fa fa-eye"></i> View Details</a>
                                                      <a style="cursor: pointer;" class="btn btn-success product-btn email1"  data-toggle="modal" data-backdrop="false" data-target="#emailModal1"><i class="fa fa-send"></i> Send Message</a>
                                                        <a href="javascript:;" data-href="{{route('admin-comment-delete',$comment->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger product-btn"><i class="fa fa-trash"></i> Remove</a>
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
                    <p class="text-center">You are about to delete this Comment.</p>
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