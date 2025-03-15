<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/fonts.css', 'resources/css/reset.css', 'resources/css/app.css'])
    @livewireStyles
</head>
<body x-data>

<div id="wrapper">
    <div id="sidebar">
        <div class="intro">
            <div>{{ auth()->user()->name }}</div>
            <div>{{ auth()->user()->role->name }}</div>
        </div>

        <div class="links">
            <div class="title">{{ __('Grades') }}</div>
            <a href="{{ route('grades.index') }}" wire:current.exact="active">{{ __('Index') }}</a>
            <a href="{{ route('grades.create') }}" wire:current.exact="active">{{ __('Create') }}</a>
        </div>

        <div class="links">
            <div class="title">{{ __('Students') }}</div>
            <a href="{{ route('students.index') }}" wire:current.exact="active">{{ __('Index') }}</a>
            <a href="{{ route('students.create') }}" wire:current.exact="active">{{ __('Create') }}</a>
        </div>

        <x-back.actions.logout/>
    </div>

    <main id="general">
        <div id="title">{{ $title }}</div>

        @yield('content')
    </main>
</div>

<svg xmlns="http://www.w3.org/2000/svg" class="sprite">
    <symbol id="svg-crumb" viewBox="0 0 5 8">
        <polygon points="0 1 1 0 5 4 1 8 0 7 3 4 0 1"/>
    </symbol><!--[ #svg-crumb ]-->

    <symbol id="svg-prev" viewBox="0 0 16 16">
        <polygon points="3.5 8 9.5 14 11 12.5 6.5 8 11 3.5 9.5 2 3.5 8"/>
    </symbol><!--[ #svg-prev ]-->

    <symbol id="svg-next" viewBox="0 0 16 16">
        <polygon points="12.5 8 6.5 14 5 12.5 9.5 8 5 3.5 6.5 2 12.5 8"/>
    </symbol><!--[ #svg-next ]-->

    <symbol id="svg-select" viewBox="0 0 8 10">
        <polygon points="4 0 0 4 8 4 4 0"/>
        <polygon points="4 10 0 6 8 6 4 10"/>
    </symbol><!--[ #svg-select ]-->

    <symbol id="svg-home" viewBox="0 0 16 16">
        <path d="M8,0L1,7v9h6v-5h2v5h6V7L8,0ZM13,14h-2v-5h-6v5h-2v-6.17l5-5,5,5v6.17Z"/>
    </symbol><!--[ #svg-home ]-->

    <symbol id="svg-root" viewBox="0 0 16 16">
        <polygon points="0 6 4 6 4 7 7 7 7 1 12 1 12 0 16 0 16 4 12 4 12 3 9 3 9 7 12 7 12 6 16 6 16 10 12 10 12 9 9 9 9 13 12 13 12 12 16 12 16 16 12 16 12 15 7 15 7 9 4 9 4 10 0 10 0 6"/>
    </symbol><!--[ #svg-root ]-->

    <symbol id="svg-user" viewBox="0 0 16 16">
        <path d="M11.31,8.72c1.03-.92,1.69-2.24,1.69-3.72,0-2.76-2.24-5-5-5S3,2.24,3,5c0,1.49.66,2.81,1.69,3.72C1.93,9.98,0,12.76,0,16h16c0-3.24-1.93-6.02-4.69-7.28ZM8,2c1.66,0,3,1.34,3,3s-1.34,3-3,3-3-1.34-3-3,1.34-3,3-3ZM2.35,14c.82-2.33,3.04-4,5.65-4s4.83,1.67,5.65,4H2.35Z"/>
    </symbol><!--[ #svg-user ]-->

    <symbol id="svg-exit" viewBox="0 0 16 16">
        <polygon points="7 7 7 9 13 9 13 11 16 8 13 5 13 7 7 7"/>
        <polygon points="9 11 9 14 2 14 2 2 9 2 9 5 11 5 11 0 0 0 0 16 11 16 11 11 9 11"/>
    </symbol><!--[ #svg-exit ]-->

    <symbol id="svg-blank" viewBox="0 0 16 16">
        <polygon points="11 10 11 14 2 14 2 5 6 5 6 3 0 3 0 16 13 16 13 10 11 10"/>
        <polygon points="8 0 8 2 12.59 2 5.29 9.29 6.71 10.71 14 3.41 14 8 16 8 16 0 8 0"/>
    </symbol><!--[ #svg-blank ]-->

    <symbol id="svg-edit" viewBox="0 0 16 16">
        <polygon points="11.5 1.5 13 0 16 3 14.5 4.5 11.5 1.5"/>
        <polygon points="10.5 2.5 0 13 0 16 3 16 13.5 5.5 10.5 2.5"/>
    </symbol><!--[ #svg-edit ]-->

    <symbol id="svg-delete" viewBox="0 0 16 16">
        <path d="m11,2V0h-6v2H1v2h2v12h10V4h2v-2h-4Zm0,12h-2V6h-2v8h-2V4h6v10Z"/>
    </symbol><!--[ #svg-delete ]-->
</svg>

@livewireScripts

</body>
</html>
