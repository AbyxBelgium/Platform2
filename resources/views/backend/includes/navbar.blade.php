{{-- Defines the comman header for each view. This includes the navbar of the website. --}}
<header class="mdl-layout__header is-casting-shadow"><div aria-expanded="false" role="button" tabindex="0" class="mdl-layout__drawer-button"><i class="material-icons"></i></div>
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">Backend</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        @if(Auth::check())
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="{{ route('backend/index')  }}"><span class="icon icon-home"></span> Desktop</a>
                <a class="mdl-navigation__link" href="#" id="submenu-new">
                    <span class="icon icon-add"></span> New
                </a>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-new">
                    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/post/create') }}">Post</a></li>
                    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/category/create') }}">Category</a></li>
                    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/page/create') }}">Page</a></li>
                </ul>
                <a class="mdl-navigation__link" href="#" id="submenu-all">
                    <span class="icon icon-list"></span> All
                </a>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-all">
                    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/post/index', ['page' => 1]) }}">Posts</a></li>
                    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/category/index', ['page' => 1]) }}">Categories</a></li>
                    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/image/index', ['page' => 1]) }}">Images</a></li>
                    <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ route('backend/page/index', ['page' => 1]) }}">Pages</a></li>
                </ul>
                <a class="mdl-navigation__link" href="#" id="submenu-settings">
                    <span class="icon icon-settings"></span> Settings
                </a>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-settings">
                </ul>
                <a class="mdl-navigation__link" href="{{ route('frontend/index') }}"><span class="icon icon-screen_share"></span> Live website</a>
                <a class="mdl-navigation__link" href="{{ route('logout') }}"><span class="icon icon-play_for_work"></span> Logout</a>
            </nav>
        @endif()
    </div>
</header>
