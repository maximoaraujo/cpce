@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li style="cursor: pointer;" class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li style="cursor: pointer;" class="page-item">
                    <a class="page-link" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    @endif
                </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li style="cursor: pointer;" class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="cursor: pointer;" class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li style="cursor: pointer;" class="page-item" wire:click="gotoPage({{ $page }})"><a class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="cursor: pointer;" class="page-item">
                    <a class="page-link" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li style="cursor: pointer;" class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif