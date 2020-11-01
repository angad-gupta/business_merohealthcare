@foreach($products as $product)
    {{-- <tr class="delTest{{$product['item']['id']}}">
        <td colspan="4">
            <p class=" product-name-header" title="{{ $product['item']['name'] }}">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</a></p>
        
        </td>
        
        <td>
            @if($gs->sign == 0)
                {{$curr->sign}}{{ round($product['price'] * $curr->value, 2) }}
            @else
                {{ round($product['price'] * $curr->value, 2) }}{{$curr->sign}}
            @endif
        </td>
        <td>
            <input type="hidden" value="{{ $product['item']['id'] }}" />

            <button class="btn btn-sm btn-danger removeTest" style="border-radius:30px;"><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;"></i></button>
        </td>
    </tr> --}}

    <tr class="delTest{{$product['item']['id']}}">
        <td style="padding-left:10px"> 
            <p class=" product-name-header" title="{{ $product['item']['name'] }}">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</a></p>
        </td>
        <td class="hidden-sm">
            @if($gs->sign == 0)
            {{$curr->sign}}{{ round($product['price'] * $curr->value, 2) }}
            @else
            {{ round($product['price'] * $curr->value, 2) }}{{$curr->sign}}
            @endif
        </td>
        <td>
            <input type="hidden" value="{{ $product['item']['id'] }}" />

            <button class="btn btn-sm btn-danger removeTest" style="border-radius:30px;"><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;"></i></button>
        </td>
      </tr>
@endforeach