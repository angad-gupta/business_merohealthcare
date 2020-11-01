      @php
        $product_notff = App\Notification::where('product_id','!=',null)->orderBy('id','desc')->get();
   
        if($product_notff->count() > 0){
          foreach($product_notff as $notf){
            $notf->is_read = 1;
            $notf->update();
          }
        }
      @endphp   

                          <div class="profile-comments-title" style="background: #12CBC4; padding:10px;color:white;">
                          
                              <h5>Products in low quantity.</h5>
                              @if($product_notff->count() > 0)
                              <p  style="cursor: pointer;" id="product_clear">Clear All</p>
                              @endif
                          </div>

                          @if($product_notff->count() > 0)
                          @foreach($product_notff as $notf)
                          {{-- {{dd($notf->product->id)}} --}}
                          <div class="single-comments-area" style="padding:0 20px;">
                              <div class="comments-img">
                                  <img src="{{asset('assets/images/'.$notf->product->photo)}}" alt="comments image">
                              </div>
                              <div class="single-comments-text">
                                  <h5><a href="{{route('admin-prod-edit',$notf->product->id)}}" style="color: #333;">{{$notf->product->name > 30 ? substr($notf->product->name,0,30) : $notf->product->name}}</a></h5>
                                  <p>Stock : {{$notf->product->getOriginal('stock')}}</p>
                              </div>
                              </div>
                            @endforeach
                          @else
                          <div class="single-comments-area" style="padding: 10px;">
                          <h5><i class="icon-close"></i> No Products in low quantity.</h5> 
                          </div>  
                          @endif