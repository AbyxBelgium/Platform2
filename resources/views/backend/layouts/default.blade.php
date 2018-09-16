{{-- Main layout file that forms the basis of almost all pages in the system. --}}

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('backend.includes.head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="app">
            <div class="mdl-layout content mdl-js-layout mdl-layout--fixed-header">
                @include('backend.includes.navbar')
                @include('backend.includes.sidenav')
                <main class="mdl-layout__content" style="flex: 1 0 auto;">
                    <div class="mdl-grid page-content">
                        @yield('content')
                    </div>
                </main>
                @include('backend.includes.footer')
            </div>
        </div>
    </body>
    @yield('custom-style')
    <!-- Automatically insert CSRF-token when performing async calls with jQuery -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('javascript')
</html>
