<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>@yield('title', 'Weibo App')</title>
</head>
<body>
    @include('layouts._header')
    <div class="container">
        <div class="offset-md-1">
            @yield('content')
            @include('layouts._footer')
        </div>
    </div>
</body>
</html>