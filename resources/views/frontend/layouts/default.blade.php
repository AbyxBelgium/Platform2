{{-- Main layout file that forms the basis of almost all pages in the system. --}}

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('frontend.includes.head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="mdl-layout content mdl-js-layout mdl-layout--fixed-header">
            @include('frontend.includes.navbar')
            @include('frontend.includes.sidenav')
            <main class="mdl-layout__content" style="flex: 1 0 auto;">
                <div class="mdl-grid page-content">
                    @yield('content')
                </div>
            </main>
            @include('frontend.includes.footer')
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

    <script>
        SyntaxHighlighter.autoloader(
            "js jscript javascript {{ URL::asset('syntaxhighlighter/scripts/shBrushJScript.js') }}",
            "php  {{ URL::asset('syntaxhighlighter/scripts/shBrushPhp.js') }}",
            "cpp  {{ URL::asset('syntaxhighlighter/scripts/shBrushCpp.js') }}",
            "java  {{ URL::asset('syntaxhighlighter/scripts/shBrushJava.js') }}",
            "xml  {{ URL::asset('syntaxhighlighter/scripts/shBrushXml.js') }}",
            "css {{ URL::asset('syntaxhighlighter/scripts/shBrushCss.js') }}");
        SyntaxHighlighter.all()
    </script>
    @yield('javascript')
</html>
