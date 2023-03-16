@extends('master')

@section('content')
    <div class="uk-flex uk-flex-center">
        <div class="auth-form uk-margin-large-top uk-block uk-flex uk-flex-column uk-text-center">
            <h2>Sign in</h2>
            <form class="uk-panel uk-panel-box uk-form uk-flex uk-flex-column" action="/signIn" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="failedFilm" value="{{ request('filmId') }}">
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Email" type="text" name="email" id="email">
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
                    <input class="uk-width-1-1 uk-button uk-button-primary uk-button-large uk-margin-top" type="submit"
                           value="Login">
                </div>
            </form>
            @error('failed_auth')
            <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

@endsection
