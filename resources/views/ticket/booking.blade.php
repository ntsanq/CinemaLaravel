@extends('master')

@section('title')
    {{  __('Booking') }}
@endsection

@section('content')
    <div id="ticket_booking" user='{{ json_encode($user) }}'></div>
@endsection
