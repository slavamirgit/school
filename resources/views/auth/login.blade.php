@extends('layouts.auth')

@section('content')
    @session('status')
    <div class="status">{{ $value }}</div>
    @endsession

    <form action="{{ route('login') }}" method="post">
        <div class="form-holder">
            @csrf

            <label class="fel">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autofocus autocomplete="username">
                <x-back.misc.error for="email"/>
            </label>

            <label class="fel">
                <input type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                <x-back.misc.error for="password"/>
            </label>

            <label class="fel">
                <input type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
            <x-back.misc.error for="remember"/>

            <button type="submit" class="button green">{{ __('Log in') }}</button>
        </div>
    </form>

    @if(Route::has('password.request'))
        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
    @endif
@endsection
