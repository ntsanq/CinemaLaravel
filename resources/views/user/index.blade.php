@extends('master')

@section('title')
    {{  __('My Profile') }}
@endsection

@section('content')
    <div class="uk-flex uk-flex-center">
        <div class="auth-form uk-margin-large-top uk-block uk-flex uk-flex-column uk-text-center">
            <h2>Edit profile</h2>
            <form class="uk-panel uk-panel-box uk-form uk-flex uk-flex-column" action="/profile/update" method="POST">
                @csrf
                @method('PUT')
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Email" type="text" value="{{ $user['email'] }}" disabled>
                </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Name" type="text" name="name" id="name"  value="{{ $user['name'] }}" >
                </div>
                <div class="uk-form-row">
                    <input style="-webkit-appearance: none;" class="uk-width-1-1 uk-form-large" placeholder="Birthday" type="date" name="birthday" id="birthday"  value="{{ $user['birthday'] }}" >
                </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Your city" type="text" name="address" id="address"  value="{{ $user['address'] }}" >
                </div>

                <div class="uk-form-row">

                </div>
                <div class="uk-form-row" style="font-style: italic">
                    Skip password inputs if you don't want to change:
                </div>


                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" placeholder="Old password" type="password" name="old_password"
                           id="old_password">
                </div>
                @error('old_password')
                <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="uk-form-row uk-margin-top">
                    <input class="uk-width-1-1 uk-form-large" placeholder="New password" type="password"
                           name="new_password"
                           id="new_password">
                </div>
                @error('new_password')
                <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="uk-form-row uk-margin-top">
                    <input class="uk-width-1-1 uk-form-large" placeholder="New password confirmation" type="password"
                           name="new_password_confirmation"
                           id="new_password_confirmation">
                </div>
                @error('new_password_confirmation')
                <span class="uk-contrast" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="uk-form-row uk-margin-top">
                    <input class="uk-width-1-1 uk-button uk-button-primary uk-button-large uk-margin-top" type="submit"
                           value="Update">
                </div>
            </form>
            @if (session('status'))
                <div class="uk-contrast">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
@endsection

