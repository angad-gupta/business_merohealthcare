@extends('layouts.user')
@section('title','My Orders')
@section('content')
<style>
  .btn{
padding: 2px 8px;
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
                      <div class="row reorder-xs">
                          <div class="col-lg-8 col-md-5 col-sm-5 col-xs-12">
                              <div class="product-header-title">
                                  <h2>Purchased Items</h2>
                                  <p>Dashboard <i class="fa fa-angle-right" style="margin: 0 2px;"></i> Purchased Items</p>
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
                                <th><strong>Order#</strong></th>
                                <th><strong>Date</strong></th>
                                <th><strong>Order Total</strong></th>
                                <th><strong>Order Status</strong></th>
                                <th><strong>Details</strong></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($orders as $order)
                                <tr>
                                  <td style="text-transform: uppercase;">{{$order->order_number}}</td>
                                  <td>{{date('d M Y',strtotime($order->created_at))}}</td>

                                  
                                  <td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
                                  <td>
                                    @if($order->status == 'processing')
                                    <h4><span class="label label-primary" style="border-radius: 30px;"><i class="fa fa-spinner fa-spin"></i>
                                      <span class="sr-only">Loading...</span>{{ucfirst($order->status)}}</span></h4>
                                    
                                    @elseif($order->status == 'declined')
                                    <h4><span class="label label-danger" style="border-radius: 30px;">{{ucfirst($order->status)}}</span></h4>
                                    @elseif($order->status == 'cancellation request')
                                    <h4><span class="label label-danger">{{ucfirst($order->status)}}</span></h4>
                                    
                                    @elseif($order->status == 'completed')
                                    <h4><span class="label label-success" style="border-radius: 30px;">{{ucfirst($order->status)}}</span></h4>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    <a href="{{route('user-order',$order->id)}}" class="btn btn-primary" style="border-radius:30px;"><i class="icon-education-164 u-line-icon-pro" aria-hidden="true" title="View your order details"></i> Details</a><br>
                                    @if($order->status != 'completed')
                                        
                                        @if ($order->status == 'cancellation request')
                                          <span class="badge" style=" background-color:orange; margin:5px;">Requested for cancellation</span>
                                        @elseif ($order->status == 'processing')
                                          <a class="btn btn-danger" style="border-radius:30px; margin:5px;"  style="cursor:pointer" data-href="{{ route('user-order.cancellation',$order->id) }}" data-toggle="modal" data-target="#confirm-cancel" ><i class="icon-trash" aria-hidden="true" title="Request Cancellation"></i> Cancel </a>
                                        @elseif ($order->status == 'completed' && $order->completed_at > Carbon\Carbon::today()->subDays(1))
                                          <a class="btn btn-danger" style="border-radius:30px; margin:5px;" style="cursor:pointer" data-href="{{ route('user-order.cancellation',$order->id) }}" data-toggle="modal" data-target="#confirm-cancel"  title=">Request Cancellation"></a>
                                        @endif
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
  <div class="modal fade" id="confirm-cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-center" id="myModalLabel">Cancellation request for Order</h4>
              </div>
              <div class="modal-body">
                  <p class="text-center">Do you want to proceed?</p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <form class="btn-ok" action="" method="POST" style="display:inline-block">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">Send Request</button>
                  </form>
              </div>
          </div>
      </div>
  </div>


@endsection

@section('scripts')

  <script type="text/javascript">

    $( document ).ready(function() {

      $('#confirm-cancel').on('show.bs.modal', function(e) {
        
          $(this).find('.btn-ok').attr('action', $(e.relatedTarget).data('href'));
      }); 
    });
  </script>

@endsection