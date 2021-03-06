@if ($paginator->hasPages())
<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item {{ $paginator->onFirstpage() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click="previousPage" tabindex="-1">Previous</a>
        </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active">
        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item {{ !$paginator->hasMorePages() ? "disabled" : "" }}">
            <a class="page-link" href="#" wire:click="nextPage">Next</a>
        </li>
    </ul>
</nav>
@endif
