<div class="mdl-layout__drawer" aria-hidden="false">
    <span class="mdl-layout-title">ABYX</span>
    @if(Auth::check())
        <nav class="mdl-navigation">
            @include('backend.includes.nav')
        </nav>
    @endif()
</div>
