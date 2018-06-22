@if ($paginator->hasPages())
    <div class="center nav-buttons">
        {{-- Previous PageRepresentation Link --}}
        @if ($paginator->onFirstPage())
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect small-button" id="post-previous-btn" disabled>
                <span class="icon icon-keyboard_arrow_left"></span>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect small-button" id="post-previous-btn">
                <span class="icon icon-keyboard_arrow_left"></span>
            </a>
        @endif

        <a class="no-link">
            Page {{ $paginator->currentPage() }}
        </a>

        {{-- Next PageRepresentation Link --}}
        @if ($paginator->hasMorePages())
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect small-button" id="post-next-btn" disabled>
                <span class="icon icon-keyboard_arrow_right"></span>
            </button>
        @else
            <a href="{{ $paginator->nextPageUrl() }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect small-button" id="post-next-btn">
                <span class="icon icon-keyboard_arrow_right"></span>
            </a>
        @endif
    </div>
@endif
