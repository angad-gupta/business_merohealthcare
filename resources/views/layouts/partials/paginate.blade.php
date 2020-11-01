<style>
    li.disabled, span.disabled{
        cursor: default!important;
    }
</style>
@if ($paginator->hasPages())
    <ul class="list-inline mb-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="list-inline-item disabled"><span class="disabled u-pagination-v1__item g-width-30 g-height-30 g-brd-gray-light-v3 g-color-gray-dark-v5 g-font-size-12 rounded-circle g-pa-5 g-ml-15">&laquo;</span></li>
        @else
            <li class="list-inline-item"><a class="u-pagination-v1__item g-width-30 g-height-30 g-brd-gray-light-v3 g-brd-primary--hover g-color-gray-dark-v5 g-color-primary--hover g-font-size-12 rounded-circle g-pa-5 g-ml-15" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="list-inline-item hidden-down disabled"><span class="disabled u-pagination-v1__item g-width-30 g-height-30 g-color-gray-dark-v5 g-font-size-12 rounded-circle g-pa-5">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="list-inline-item hidden-down"><span class="active u-pagination-v1__item g-width-30 g-height-30 g-brd-gray-light-v3 g-brd-primary--active g-color-white g-bg-primary--active g-font-size-12 rounded-circle g-pa-5">{{ $page }}</span></li>
                    @else
                        <li class="list-inline-item hidden-down"><a class="u-pagination-v1__item g-width-30 g-height-30 g-color-gray-dark-v5 g-color-primary--hover g-font-size-12 rounded-circle g-pa-5" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="list-inline-item"><a class="u-pagination-v1__item g-width-30 g-height-30 g-brd-gray-light-v3 g-brd-primary--hover g-color-gray-dark-v5 g-color-primary--hover g-font-size-12 rounded-circle g-pa-5 g-ml-15" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="list-inline-item disabled"><span class="disabled u-pagination-v1__item g-width-30 g-height-30 g-brd-gray-light-v3 g-color-gray-dark-v5 g-font-size-12 rounded-circle g-pa-5 g-ml-15">&raquo;</span></li>
        @endif
    </ul>
@endif










