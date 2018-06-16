<div class="mdl-layout__drawer" aria-hidden="false">
    <span class="mdl-layout-title">ABYX</span>
    @if(Auth::check())
        <nav class="mdl-navigation">
            @foreach($backendNavbar as $title => $menuItem)
                @if (count($menuItem) == 2)
                    <a class="mdl-navigation__link" href="{{ $menuItem[1] }}"><span class="icon icon-{{ $menuItem[0] }}"></span> {{ $title }}</a>
                @else
                    <a class="mdl-navigation__link" href="#"><span class="icon icon-{{ $menuItem[0] }}"></span> {{ $title }}</a>
                    @foreach($menuItem[2] as $subTitle => $subMenu)
                        <a class="mdl-navigation__link sidenav-submenu" href="{{ $subMenu[1] }}"><span class="icon icon-subdirectory_arrow_right"></span>{{ $subTitle }}</a>
                    @endforeach
                @endif
            @endforeach

        </nav>
    @endif()
</div>
