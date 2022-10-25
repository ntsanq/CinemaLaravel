@extends('auth/master')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/auth-custom.css') }}">
@endsection

@section('content')
    <h2>Sign up</h2>

    <form class="uk-panel uk-panel-box uk-form" action="/sign-in" method="POST">
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" placeholder="Username" type="text" name="username" id="username">
        </div>
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" placeholder="Password" type="password" name="password"
                   id="password">
        </div>
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" placeholder="Password confirmation" type="password" name="password_confirmation"
                   id="password_confirmation">
        </div>
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="submit" value="Login">
        </div>
    </form>
@endsection
