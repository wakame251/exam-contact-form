{{-- resources/views/vendor/pagination/default.blade.php --}}
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&lt;</span></li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                {{-- 省略用（…）は不要なら削除してOK --}}
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
            </li>
        @else
            <li class="disabled"><span>&gt;</span></li>
        @endif
    </ul>
@endif

