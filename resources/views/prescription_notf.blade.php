@php
    $prescription_notff = App\Notification::where('prescription_id','!=',null)->orderBy('id','desc')->get();
    if($prescription_notff->count() > 0){
    foreach($prescription_notff as $notf){
        $notf->is_read = 1;
        $notf->update();
    }
    }
@endphp   
<div class="profile-wishlist-title" style="background: purple; padding:10px;color:white;">
    <h5>New Prescriptions(s).</h5>
    @if($prescription_notff->count() > 0)
    <p style="cursor: pointer;" id="prescription_clear">Clear All</p>
    @endif
</div>

@if($prescription_notff->count() > 0)
    @foreach($prescription_notff as $notf)
    
        <div class="single-wishlist-area" style="padding:10px 20px;">
            <div class="wishlist-img">
                    <i class="fa fa-file"></i>
            </div>
            <div class="single-wishlist-text">
                <h5><a href="{{route('admin-prescription-show',$notf->prescription_id)}}" style="color: #333;">A New prescription Has been uploaded.</a></h5>
                <p>{{$notf->created_at->diffForHumans()}}</p>
            </div>
        </div>
    
    @endforeach
@else
    <div class="single-wishlist-area" style="padding:10px;">
        <h5><i class="icon-close"></i> No New Prescription(s).</h5>
    </div>
@endif