@if(isset($paginator) && $paginator->lastPage() > 1)
<div class="pagination-wrapper">
    <ul class="pagination" role="navigation" aria-label="Pagination">
        @if($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">&laquo;</a></li>
        @endif

        @for($p = 1; $p <= $paginator->lastPage(); $p++)
        <li class="page-item {{ $paginator->currentPage() == $p ? 'active' : '' }}">
            @if($paginator->currentPage() == $p)
            <span class="page-link" aria-current="page">{{ $p }}</span>
            @else
            <a class="page-link" href="{{ $paginator->url($p) }}">{{ $p }}</a>
            @endif
        </li>
        @endfor

        @if($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">&raquo;</a></li>
        @else
        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
</div>
@endif
