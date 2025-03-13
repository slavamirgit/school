@extends('layouts.auth')

@section('content')
    <div>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</div>

    <form action="{{ route('password.confirm') }}" method="post">
        <div class="form-holder">
            @csrf

            <label class="fel">
                <input type="password" name="password" placeholder="{{ __('Password') }}" required autofocus autocomplete="current-password">
                <x-back.misc.error for="password"/>
            </label>

            <button type="submit" class="button green">{{ __('Confirm') }}</button>
        </div>
    </form>
@endsection
