<a class="mdl-navigation__link" href="{{ route('frontend/index')  }}"><span class="icon icon-home"></span>Desktop</a>
@if(Auth::check())
    <a class="mdl-navigation__link" href="{{ route('backend/index') }}"><span class="icon icon-swap_horiz"></span>Backend</a>
@else
    <a class="mdl-navigation__link" href="/login"><span class="icon icon-forward"></span>Login</a>
@endif
