@extends('auth/master')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/auth-custom.css') }}">
@endsection

@section('content')
    <h2>Sign in</h2>

    <form class="uk-panel uk-panel-box uk-form" action="/signIn" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" placeholder="Email" type="text" name="email" id="email">
        </div>
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" placeholder="Password" type="password" name="password"
                   id="password">
        </div>

        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="submit" value="Login">
        </div>
    </form>
    <span>
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
    </span>

@endsection
