@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- First Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    <i class="fa fa-backward"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->toArray()['first_page_url'] }}" rel="prev" aria-label="@lang('pagination.first')">
                    <i class="fa fa-fast-backward"></i>
                </a>
            </li>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    <i class="fa fa-arrow-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </li>
        @endif

        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($paginator->onFirstPage())
                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                        </li>
                    @endif
                @endif
            @elseif($paginator->currentPage() === $paginator->lastPage())
                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                        </li>
                    @endif
                @endif
            @else
                @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                        </li>
                    @endif
                @endif
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    <i class="fa fa-arrow-right"></i>
                </span>
            </li>
        @endif

        {{-- Last Page Link --}}
        @if(!$paginator->hasMorePages())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.last')">
                <span class="page-link" aria-hidden="true">
                    <i class="fa fa-forward"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->toArray()['last_page_url'] }}" rel="next" aria-label="@lang('pagination.first')">
                    <i class="fa fa-forward"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
