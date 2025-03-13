@extends('layouts.auth')

@section('content')
    <form action="{{ route('register') }}" method="post">
        <div class="form-holder">
            @csrf

            <label class="fel">
                <span>{{ __('Name') }}</span>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                <x-back.misc.error for="name"/>
            </label>

            <label class="fel">
                <span>{{ __('Email') }}</span>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                <x-back.misc.error for="email"/>
            </label>

            <label class="fel">
                <span>{{ __('Password') }}</span>
                <input type="password" name="password" required autocomplete="new-password">
                <x-back.misc.error for="password"/>
            </label>

            <label class="fel">
                <span>{{ __('Confirm password') }}</span>
                <input type="password" name="password_confirmation" required autocomplete="new-password">
                <x-back.misc.error for="password_confirmation"/>
            </label>
        </div>

        <footer class="form-holder">
            <button type="submit" class="button green">{{ __('Register') }}</button>
        </footer>
    </form>

    <a href="{{ route('login') }}">{{ __('Login') }}</a>
@endsection
