@php
$product_notff = App\Notification::where('vendor_product_id','!=',null)->orderBy('id','desc')->get();
// dd($product_notff);
if($product_notff->count() > 0){
  foreach($product_notff as $notf){
    $notf->is_read = 1;
    $notf->update();
 
  }
}
@endphp   

                  <div class="profile-comments-title" style="background: #ac930f; padding:10px;color:white;">
                      <h5>Products Added By Vendor.</h5>
                      @if($product_notff->count() > 0)
                      <p  style="cursor: pointer;" id="vendor_product_clear">Clear All</p>
                      @endif
                  </div>

                  @if($product_notff->count() > 0)
                  @foreach($product_notff as $notf)
                  {{-- {{dd($notf->vendor_product_id)}} --}}

                  @php 
                  $product = App\Product::findOrFail($notf->vendor_product_id);
                  @endphp
                  <div class="single-comments-area" style="padding:0 20px;">
                      <div class="comments-img">
                          <img src="{{asset('assets/images/'.$product->photo)}}" alt="product image">
                      </div>
                      
                      <div class="single-comments-text">
                          <h5><a href="{{route('admin-prod-edit',$product->id)}}" style="color: #333;">{{$product->name > 30 ? substr($product->name,0,30) : $product->name}}</a></h5>
                          {{-- <p>Stock : {{$product->getOriginal('stock')}}</p> --}}
                          <p>{{$notf->created_at->diffForHumans()}}</p>
                      
                         
                      </div>
                      </div>
                    @endforeach
                  @else
                  <div class="single-comments-area" style="padding:10px;">
                  <h5><i class="icon-close"></i> No Products Added By Vendor.</h5> 
                  </div>  
                  @endif