<div class="mdl-layout__drawer" aria-hidden="false">
    <span class="mdl-layout-title">ABYX</span>
    @if(Auth::check())
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="{{ route('backend/index') }}">
                <span class="icon icon-home"></span> Desktop
            </a>
            <a class="mdl-navigation__link" href="#">
                <span class="icon icon-add"></span> New
            </a>
            <a class="mdl-navigation__link sidenav-submenu" href="{{ route('backend/post/create') }}">
                <span class="icon icon-subdirectory_arrow_right"></span>Post
            </a>
            <a class="mdl-navigation__link sidenav-submenu" href="{{ route('backend/category/create') }}">
                <span class="icon icon-subdirectory_arrow_right"></span>Category
            </a>
            <a class="mdl-navigation__link" href="#">
                <span class="icon icon-list"></span> All
            </a>
            <a class="mdl-navigation__link sidenav-submenu" href="{{ route('backend/post/index') }}">
                <span class="icon icon-subdirectory_arrow_right"></span>Posts
            </a>
            <a class="mdl-navigation__link sidenav-submenu" href="{{ route('backend/category/index') }}">
                <span class="icon icon-subdirectory_arrow_right"></span>Categories
            </a>
            <a class="mdl-navigation__link" href="#" id="submenu-all">
                <span class="icon icon-settings"></span> Settings
            </a>
            <a class="mdl-navigation__link sidenav-submenu" href="{{ route('backend/settings/composition') }}">
                <span class="icon icon-subdirectory_arrow_right"></span>Composition
            </a>
            <a class="mdl-navigation__link" href="{{ route('frontend/index') }}">
                <span class="icon icon-screen_share"></span> Live website
            </a>
            <a class="mdl-navigation__link" href="{{ route('logout') }}">
                <span class="icon icon-play_for_work"></span> Logout
            </a>
        </nav>
    @endif()
</div>
