@if ($paginator->hasPages())
    <ul class="pagination pagination-sm justify-content-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link rounded-right">@lang('pagination.previous')</span></li>
        @else
            <li class="page-item"><a class="page-link rounded-right" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        <li class="page-item d-flex align-items-center">
            <form method="get" action="{{ url()->current() }}">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@lang('pagination.pages', ['page' => $paginator->currentPage()])</div>
                    </div>
                    <input type="number" class="form-control w-6rem" name="page" placeholder="{{ __('index.jump to') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">@lang('index.confirm')</button>
                    </div>
                </div>
            </form>
        </li>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link rounded-left" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="page-item disabled"><span class="page-link rounded-left">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
