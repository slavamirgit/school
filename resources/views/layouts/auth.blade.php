<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/fonts.css', 'resources/css/reset.css', 'resources/css/app.css', 'resources/js/alpine.js'])
</head>
<body>

<div id="auth" class="stack">
    @yield('content')
</div>

<svg xmlns="http://www.w3.org/2000/svg" class="sprite">
    <symbol id="svg-user" viewBox="0 0 16 16">
        <path d="M11.31,8.72c1.03-.92,1.69-2.24,1.69-3.72,0-2.76-2.24-5-5-5S3,2.24,3,5c0,1.49.66,2.81,1.69,3.72C1.93,9.98,0,12.76,0,16h16c0-3.24-1.93-6.02-4.69-7.28ZM8,2c1.66,0,3,1.34,3,3s-1.34,3-3,3-3-1.34-3-3,1.34-3,3-3ZM2.35,14c.82-2.33,3.04-4,5.65-4s4.83,1.67,5.65,4H2.35Z"/>
    </symbol><!--[ #svg-user ]-->

    <symbol id="svg-exit" viewBox="0 0 16 16">
        <polygon points="7 7 7 9 13 9 13 11 16 8 13 5 13 7 7 7"/>
        <polygon points="9 11 9 14 2 14 2 2 9 2 9 5 11 5 11 0 0 0 0 16 11 16 11 11 9 11"/>
    </symbol><!--[ #svg-exit ]-->
</svg>

</body>
</html>
