@extends('master')

@section('title')
    {{  __('Checkout failed') }}
@endsection

@include('layouts/head')


@section('content')
    <div class="uk-flex uk-flex-center checkout-success">
        <div class="uk-flex uk-flex-column">
            <div class="uk-margin-large-top"></div>
            <div class="uk-margin-large-top"></div>
            <div class="uk-flex uk-flex-center">
                <img class="checkout-success-img" src="{{ asset('assets/images/failed.png') }}" alt="failed-img">
            </div>
            <h1 class="uk-text-center">Your payment was unsuccessful</h1>
            <div class="uk-text-center">
                <span>Please check again. </span><a href="/stripe/repay?sessionId={{ app('request')->input('sessionId') }}">Try again</a>
            </div>
        </div>
    </div>
@endsection
