@extends('master')

@section('content')
    <div class="uk-flex uk-flex-center">
        <div class="auth-form uk-cover-background uk-margin-large-top uk-block uk-flex uk-flex-column uk-text-center">
            <h2>Sign up</h2>
            <form class="uk-panel uk-panel-box uk-form uk-flex uk-flex-column" action="/signUp" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Name" type="text" name="name" id="name"
                           value="{{ old('name') }}">
                </div>
                @error('name')
                <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="uk-form-row uk-margin-top">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Email" type="text" name="email" id="email"
                           value="{{ old('email') }}">
                </div>
                @error('email')
                <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="uk-form-row uk-margin-top">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Password" type="password" name="password"
                           id="password">
                </div>
                @error('password')
                <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="uk-form-row uk-margin-top">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Password confirmation" type="password"
                           name="password_confirmation"
                           id="password_confirmation">
                </div>
                @error('password')
                <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="uk-form-row uk-margin-top">
                    <input class="uk-width-1-1 uk-button uk-button-primary uk-button-large uk-margin-top" type="submit"
                           value="Login">
                </div>
            </form>
        </div>
    </div>
@endsection
