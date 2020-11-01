      @php
        $order_notff = App\Notification::where('order_id','!=',null)->where('vendor_id',null)->orderBy('id','desc')->get();
        if($order_notff->count() > 0){
          foreach($order_notff as $notf){
            $notf->is_read = 1;
            $notf->update();
          }
        }
      @endphp   

{{-- <link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line/css/simple-line-icons.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-etlinefont/style.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-line-pro/style.css">
<link rel="stylesheet" href="/frontend-assets/main-assets/assets/vendor/icon-hs/style.css"> --}}

                  <div class="profile-notifi-title" style="background: #d9534f; padding:10px;color:white;">
                      <h5>New Orders.</h5>
                      @if($order_notff->count() > 0)
                      <p style="cursor: pointer;" id="order_clear">Clear All</p>
                      @endif
                  </div>

                  
                    @if($order_notff->count() > 0)
                      @foreach($order_notff as $notf)
                      <div class="single-notifi-area" style="padding:10px 20px;">
                      <div class="notifi-img" style="background-color:#d9534f;">
                          <i class="icon-basket-loaded"></i>
                      </div>
                      <div class="single-notifi-text">
                          <h5><a href="{{route('admin-order-show',$notf->order_id)}}" style="color: #333;">You Have a new order.</a></h5>
                          <p>{{$notf->created_at->diffForHumans()}}</p>
                      </div>
                    </div>
                      @endforeach
                    @else
                    <div class="single-notifi-area" style="padding:10px;">
                    <h5><i class="icon-close"></i> No New Order(s).</h5>
                  </div>
                    @endif