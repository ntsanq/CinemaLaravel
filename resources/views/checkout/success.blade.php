@extends('master')

@section('title')
    {{  __('Checkout successful') }}
@endsection

@include('layouts/head')


@section('content')
    <img src="{{ asset('assets/images/success.png') }}" alt="">
    <h1>Your payment was successful</h1>
    <div>
        <p>Thank you for your payment. We will email you for the invoice, otherwise you can view it</p>
        <a href="#">here</a>
    </div>
@endsection

