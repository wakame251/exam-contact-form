@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled"><span class="page-link">&lt;</span></li>
            @else
                <li><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a></li>
            @endif

            @foreach ($elements as $element)
                {{-- "..." --}}
                @if (is_string($element))
                    <li class="disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a></li>
            @else
                <li class="disabled"><span class="page-link">&gt;</span></li>
            @endif
        </ul>
    </nav>
@endif
