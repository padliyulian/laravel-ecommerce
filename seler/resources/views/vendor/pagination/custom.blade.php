@if ($paginator->hasPages())
<div class="row d-flex align-items-center mt-3">
    <div class="col-12 col-md-6 col-lg-6">
        Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} from {{$paginator->total()}} items
    </div>
    <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end">
        <nav>
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}{{request()->get('length') ? '&length='.request()->get('length'):''}}{{request()->get('column') ? '&column='.request()->get('column'):''}}{{request()->get('dir') ? '&dir='.request()->get('dir'):''}}{{request()->get('search') ? '&search='.request()->get('search'):''}}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif
    
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif
    
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}{{request()->get('length') ? '&length='.request()->get('length'):''}}{{request()->get('column') ? '&column='.request()->get('column'):''}}{{request()->get('dir') ? '&dir='.request()->get('dir'):''}}{{request()->get('search') ? '&search='.request()->get('search'):''}}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
    
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}{{request()->get('length') ? '&length='.request()->get('length'):''}}{{request()->get('column') ? '&column='.request()->get('column'):''}}{{request()->get('dir') ? '&dir='.request()->get('dir'):''}}{{request()->get('search') ? '&search='.request()->get('search'):''}}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endif
