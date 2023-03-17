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
                    <td>{{ $ticket[0]['film_name'] }}</td>
                    <td><img class="uk-preserve-width" src="{{ $ticket[0]['path'] }}" alt="" style="width: 100px; height: 120px; object-fit: cover"></td>
                    <td>{{ $ticket[0]['created_date'] }}</td>
                    <td class="ticket-details-popup" data-session-id={{ $ticket[0]['session_id'] }}>sdfsd</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <ul class="uk-pagination uk-margin-large-top" uk-margin>
            @if($pagination['prev_page_url'] === null)
                <li style="pointer-events: none" ><a href="{{ $pagination['prev_page_url'] }}"><i class="uk-icon-chevron-left"></i></a></li>
            @else
                <li><a href="{{ $pagination['prev_page_url'] }}"><i class="uk-icon-chevron-left"></i></a></li>
            @endif

            @if($pagination['next_page_url'] === null)
                <li style="pointer-events: none" ><a href="{{ $pagination['next_page_url'] }}"><i class="uk-icon-chevron-right"></i></a></li>
            @else
                <li><a href="{{ $pagination['next_page_url'] }}"><i class="uk-icon-chevron-right"></i></a></li>
            @endif
        </ul>
    </div>

@endsection
