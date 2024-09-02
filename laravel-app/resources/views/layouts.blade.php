<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Text Analyzer')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <header>
            <h1>Text Analyzer</h1>

            @yield('header-navs')
        </header>
        
        <div class="content">
            @yield('content')
        </div>

        <footer>
            <p>&copy; {{ date('Y') }} BudhaTech Ltd. | All rights reserved.</p>
        </footer>
    </body>
</html>