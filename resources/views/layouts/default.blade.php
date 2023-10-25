<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Weibo App')</title>
</head>
<body>
    @include('layouts._header')
    <div class="container">
        <div class="offset-md-1">
            <div class="bg-light p-3 p-sm-5 rounded">
                <h2>@yield('title', 'Weibo App')</h2>
                <hr>
                @yield('content')
            </div>
            @include('layouts._footer')
        </div>
    </div>
</body>
</html>