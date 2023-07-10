@if ($paginator->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="pagination left">


                <ul class="pagination-list">
                    @if ($paginator->onFirstPage())
                        <li class="disabled"><span>{{ __('Previous') }}</span></li>
                    @else
                        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ __('Previous') }}</a></li>
                    @endif
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active my-active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('Next') }}</a></li>
                    @else
                        <li class="disabled"><span>{{ __('Next') }}</span></li>
                    @endif
                </ul>
            </div>
            {{ __('Showing') }}: {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} {{ __('of') }} {{ $paginator->total() }} {{ __('items') }}
        </div>
    </div>
@endif
