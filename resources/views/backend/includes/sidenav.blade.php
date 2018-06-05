<div class="mdl-layout__drawer" aria-hidden="false">
    <span class="mdl-layout-title">ABYX</span>
    @if(Auth::check())
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="/"><span class="icon icon-home"></span>Home</a>
        </nav>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="/logout"><span class="icon icon-play_for_work"></span>Logout</a>
        </nav>
    @endif()
</div>
