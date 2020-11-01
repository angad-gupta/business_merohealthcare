@extends('layouts.front')
@section('content')

  <div class="section-padding compare-wrap">
    <div class="container-fluid">
      @if(Session::has('lab_compare'))
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h3 class="compare-h3">{{$lang->compare_title}}</h3>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="clear-area text-right">
            <button class="btn lab-clear-btn">{{$lang->clear}}</button>
          </div>
          </div>
        </div>

        <div class="compare-content-wrap">
          <div class="singleComapre__area">
            <div class="singleCompare__title"></div>
            @foreach ($vendors as $vendor)
              <div class="singleCompare__title">{{ $vendor->name }}</div>
                
            @endforeach
          </div>

          <div class="singleCompare__content-wrap">
            @if(Session::has('lab_compare'))
              @foreach($products as $product)
                @php
                    $options = $product['item']->options;
                @endphp
                <div class="singleCompare__content" style="width:200px">
                  <div class="compare__img" style="height:unset">

                    <input type="hidden" value="{{ $product['item']['id'] }}">
                    <i class="fa fa-close compare-remove" style="cursor: pointer;"></i>
                    <p><strong><span style="color: black;">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</span></strong></p>
                  </div>
                  @foreach ($vendors as $vendor)
                    @php
                        $test = $options->where('user_id',$vendor->id)->first();
                       
                    @endphp
                    @if ($test)
                      <p>              
                        @if($gs->sign == 0)
                        {{$curr->sign}}{{ round($test->cprice * $curr->value, 2) }}
                        @else
                        {{ round($test->cprice * $curr->value, 2) }}{{$curr->sign}}
                        @endif
                      </p>
                    @else
                      -
                    @endif

                  @endforeach
                  
                  {{-- <p class="text-center">
                    <input type="hidden" value="{{ $product['item']['id'] }}">
                    <a href="" class="btn compare-cartBtn addcart">{{$lang->hcs}}</a>
                  </p> --}}
                </div>
              @endforeach
            @endif

          </div>
        </div>
      @else
        <h2 class="text-center">{{$lang->no_compare}}</h2>
      @endif
    </div>
  </div>

@endsection


@section('scripts')
<script>
    $(document).on("click", ".lab-compare-remove" , function(){
        var pid = $(this).parent().find('input[type=hidden]').val();
        $(this).parent().parent().hide('slow');
        $.ajax({
            type: "POST",
            url:"{{URL::to('/lab/json/removecompare')}}",
            data:{test_id: pid, _token: '{{ csrf_token() }}'},
            
            success:function(data){
                $.notify("{{$gs->compare_remove}}","success");
                $('.lab-compare-quantity').html(data[1]);
                if(data[0] == 1)
                {
                    $('.container-fluid').html('<h2 class="text-center">{{$lang->no_compare}}</h2>')
                }
            }
        });
    });

    $(document).on("click", ".lab-clear-btn" , function(){
        $('.compare-content-wrap').hide('slow');
        $('.container-fluid').html('<h2 class="text-center">{{$lang->no_compare}}</h2>');
        $('.lab-compare-quantity').html('0');
        $.ajax({
            type: "POST",
            url:"{{URL::to('/lab/json/clearcompare')}}",
            data:{_token: '{{ csrf_token() }}'},

        });
        return false;
    });
</script>
@endsection