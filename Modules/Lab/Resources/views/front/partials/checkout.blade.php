@foreach($products as $product)
    {{-- <tr>
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
    </tr> --}}

    <tr>
        <td style="padding-left:10px">
            <p class=" product-name-header" title="{{ $product['item']['name'] }}">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</a></p>
        
        </td>
        
        <td >
            @if($gs->sign == 0)
                {{$curr->sign}}{{ round($product['price'] * $curr->value, 2) }}
            @else
                {{ round($product['price'] * $curr->value, 2) }}{{$curr->sign}}
            @endif
        </td>
    </tr>
@endforeach