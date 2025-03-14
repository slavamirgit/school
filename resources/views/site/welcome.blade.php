@extends('layouts.auth')

@section('content')
    <h1>{{ __('Welcome') }}</h1>

    <form>
        <div class="form-holder">
            <a href="/register" class="button simple width-auto">{{ __('Registration') }}</a>
            <a href="/login" class="button simple width-auto">{{ __('Login') }}</a>
        </div>
    </form>
@endsection
