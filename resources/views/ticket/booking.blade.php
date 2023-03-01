@extends('master')

@section('title')
    {{  __('Booking') }}
@endsection

@include('layouts/head')


@section('content')
    <div id="ticket_booking" user='{{ json_encode($user) }}'></div>
@endsection
