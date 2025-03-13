@extends('layouts.auth')

@section('content')
    <form action="{{ route('password.update') }}" method="post">
        <div class="form-holder">
            @csrf

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <label class="fel">
                <input type="email" name="email" value="{{ old('email', request()->email) }}" placeholder="{{ __('Email') }}" required autofocus autocomplete="username">
                <x-back.misc.error for="email"/>
            </label>

            <label class="fel">
                <input type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
                <x-back.misc.error for="password"/>
            </label>

            <label class="fel">
                <input type="password" name="password_confirmation" placeholder="{{ __('Confirm password') }}" required autocomplete="new-password">
                <x-back.misc.error for="password_confirmation"/>
            </label>

            <button type="submit" class="button green">{{ __('Reset') }}</button>
        </div>
    </form>
@endsection
