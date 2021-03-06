@if ($paginator->hasPages())
<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item {{ $paginator->onFirstpage() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click.prevent="previousPage" tabindex="-1">Previous</a>
        </li>
        @foreach ($elements as $element)
            @foreach ($element as $page => $url)
                <li class="page-item {{ $page == $paginator->currentPage() ? "active" : "" }}">
                    <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                </li>
            @endforeach
        @endforeach
        <li class="page-item {{ !$paginator->hasMorePages() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click.prevent="nextPage">Next</a>
        </li>
    </ul>
</nav>
@endif
