@extends('master')

@section('title')
    {{  __('Checkout failed') }}
@endsection

@include('layouts/head')


@section('content')
    <img src="{{ asset('assets/images/failed.png') }}" alt="">
    <h1>Your payment was unsuccessful</h1>
    <div>
        <p>Please check again.</p>
        <a href="/">Go back</a>
    </div>
@endsection
