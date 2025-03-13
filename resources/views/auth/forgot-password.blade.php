@extends('layouts.auth')

@section('content')
    @session('status')
    <div class="status">{{ $value }}</div>
    @endsession

    <form action="{{ route('password.email') }}" method="post">
        <div class="form-holder">
            @csrf

            <label class="fel">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autofocus autocomplete="username">
                <x-back.misc.error for="email"/>
            </label>

            <button type="submit" class="button green">{{ __('Email password reset link') }}</button>
        </div>
    </form>

    <a href="{{ route('login') }}">{{ __('Login') }}</a>
@endsection
