<a class="mdl-navigation__link" href="{{ route('backend/index')  }}"><span class="icon icon-home"></span>Desktop</a>
<a class="mdl-navigation__link" href="#" id="submenu-posts">
    <span class="icon icon-list"></span> All
</a>
<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-posts">
    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/post/index', ['page' => 1]) }}">Posts</a></li>
</ul>
<a class="mdl-navigation__link" href="/logout"><span class="icon icon-play_for_work"></span>Logout</a>
