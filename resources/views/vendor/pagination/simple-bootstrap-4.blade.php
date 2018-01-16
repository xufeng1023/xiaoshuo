@if ($paginator->hasPages())
    <ul class="pagination justify-content-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link rounded-right">@lang('pagination.previous')</span></li>
        @else
            <li class="page-item"><a class="page-link rounded-right" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        <li class="page-item d-flex align-items-center">
            <span>@lang('pagination.pages', ['page' => $paginator->currentPage()])</span>
        </li>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link rounded-left" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="page-item disabled"><span class="page-link rounded-left">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
