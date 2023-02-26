@extends('master')

@section('title')
    {{  __('Booking') }}
@endsection

@include('layouts/head')


@section('content')
    <div class="film-info">
    </div>

    <div id="ticket_booking" film='{{ $film }}' user='{{ json_encode($user) }}'></div>
@endsection
