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
                @foreach($backendNavbar as $title => $menuItem)
                    @if (count($menuItem) == 2)
                        <a class="mdl-navigation__link" href="{{ $menuItem[1] }}"><span class="icon icon-{{ $menuItem[0] }}"></span> {{ $title }}</a>
                    @else
                        <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-{{ $title }}">
                            @foreach($menuItem[2] as $subTitle => $subMenu)
                                <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1"><a class="no-link" href="{{ $subMenu[1] }}">{{ $subTitle }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </nav>
        @endif()
    </div>
</header>
