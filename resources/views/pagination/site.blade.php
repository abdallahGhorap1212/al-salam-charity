@if ($paginator->hasPages())
    <nav class="site-pagination" role="navigation" aria-label="Pagination Navigation">
        @if ($paginator->onFirstPage())
            <span class="page-btn disabled">السابق</span>
        @else
            <a class="page-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">السابق</a>
        @endif

        <div class="page-numbers">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="page-ellipsis">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-number active">{{ $page }}</span>
                        @else
                            <a class="page-number" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a class="page-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">التالي</a>
        @else
            <span class="page-btn disabled">التالي</span>
        @endif
    </nav>
@endif
