{{-- Main layout file that forms the basis of almost all pages in the system. --}}

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="mdl-layout content mdl-js-layout mdl-layout--fixed-header">
            @include('includes.navbar')
            @include('includes.sidenav')
            <main class="mdl-layout__content" style="flex: 1 0 auto;">
                <div class="mdl-grid page-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
