@extends('master')

@section('title')
    {{  __('Checkout successful') }}
@endsection

@section('content')
    <div class="uk-flex uk-flex-center checkout-success">
        <div class="uk-flex uk-flex-column">
            <div class="uk-margin-large-top"></div>
            <div class="uk-margin-large-top"></div>
            <div class="uk-flex uk-flex-center">
                <img class="checkout-success-img" src="{{ asset('assets/images/success.png') }}" alt="success-img">
            </div>
            <h1 class="uk-text-center">Your payment was successful</h1>
            <div class="uk-text-center">
                <span>Thank you for your payment. We will email you for the invoice, otherwise you can view it </span>
                <span
                    id="ticket-details-popup"
                    tickets={{ json_encode($tickets) }}>
                </span>.
            </div>
        </div>
    </div>
@endsection

