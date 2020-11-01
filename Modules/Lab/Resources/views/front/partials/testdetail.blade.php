
<style>

.col-sm-6 p {
  text-align: left;
}
</style>

  <div class="form-group">
    <label class="control-label col-sm-4" for="blood_group_display_name">Test Details</label>
    <div class="col-sm-6 text-left">
      <div class="" style="margin-top:10px;background: #f1f1f1;border-radius:10px;padding:10px;">
        @foreach($prods as $p)
          @if($p->description != null)
          <p style="font-weight:600;color:#2385aa;">Test Description</p> 
          <p>{!! $p->description !!}</p>
          @endif
        @endforeach

        @foreach($prods as $p)
        @if($p->product_collection != null)
        <div> 
          <p style="font-weight:600;color:#2385aa;">Test Collection</p>  
         
            @php
            $decoded = json_decode($p->product_collection, true);
            @endphp
              @foreach((array)$decoded as $pid)
                @php
                $product = Modules\Lab\Entities\LabProduct::findorFail($pid);
                @endphp
                
                <p class="text-left">{{$loop->iteration}}. {{$product->name}}</p>
             
              @endforeach
        </div>
        @endif
     
        @endforeach
      </div>
    </div>
  </div>


