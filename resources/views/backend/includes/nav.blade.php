<a class="mdl-navigation__link" href="{{ route('backend/index')  }}"><span class="icon icon-home"></span> Desktop</a>
<a class="mdl-navigation__link" href="#" id="submenu-new">
    <span class="icon icon-add"></span> New
</a>
<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-new">
    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/post/create') }}">Post</a></li>
    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/category/create') }}">Category</a></li>
</ul>
<a class="mdl-navigation__link" href="#" id="submenu-all">
    <span class="icon icon-list"></span> All
</a>
<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-all">
    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/post/index', ['page' => 1]) }}">Posts</a></li>
    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/category/index', ['page' => 1]) }}">Categories</a></li>
</ul>
<a class="mdl-navigation__link" href="{{ route('frontend/index') }}"><span class="icon icon-screen_share"></span> Live website</a>
<a class="mdl-navigation__link" href="/logout"><span class="icon icon-play_for_work"></span> Logout</a>
