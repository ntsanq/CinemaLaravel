@extends('master')

@section('title')
    {{  __('My Tickets') }}
@endsection

@section('content')
    <h1 class="uk-flex uk-flex-center uk-margin-large-top uk-margin-bottom">My tickets</h1>
    <div class="my-tickets-table">
        <table class="uk-table uk-table-middle uk-table-hover">
            <thead>
            <tr>
                <th>Movie</th>
                <th>Image</th>
                <th>Created Date</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($userTickets as $ticket)
                <tr>
                    <td>{{ $ticket['film_name'] }}</td>
                    <td><img class="uk-preserve-width" src="{{ $ticket['path'] }}" alt="" style="width: 100px; height: 120px; object-fit: cover"></td>
                    <td>{{ $ticket['created_date'] }}</td>
                    <td class="ticket-details-popup" data-session-id={{ $ticket['session_id'] }}>sdfsd</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
