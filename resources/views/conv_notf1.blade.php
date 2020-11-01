      @php
        $conv_notff = App\Notification::where('conversation_id','!=',null)->orderBy('id','desc')->get();
        if($conv_notff->count() > 0){
          foreach($conv_notff as $notf){
            $notf->is_read = 1;
            $notf->update();
          }
        }
      @endphp   

      <div class="profile-notifi-title" style="background: green; padding:10px;color:white;">
          <h5>New Conversations.</h5>
          @if($conv_notff->count() > 0)
          <p  style="cursor: pointer;" id="conv_clear">Clear All</p>
          @endif
      </div>

      @if($conv_notff->count() > 0)
      @foreach($conv_notff as $notf)
      <div class="single-notifi-area" style="padding:10px 20px;">
          <div class="notifi-img" style="background: green">
              <i class="fa fa-envelope"></i>
          </div>
          <div class="single-notifi-text">
              <h5><a href="{{route('admin-message-show',$notf->conversation_id)}}" style="color: #333;">You Have a New Message.</a></h5>
          </div>
          </div>
        @endforeach
      @else
      <div class="single-notifi-area" style="padding:10px;">
      <h5 class="g-color-gray"><i class="icon-close"></i> You Have No New Message.</h5> 
      </div>  
      @endif