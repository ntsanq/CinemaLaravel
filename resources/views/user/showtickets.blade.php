@extends('master')

@section('title')
    {{  __('My Tickets') }}
@endsection

@section('content')
    <div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
        <h1 class="uk-flex uk-flex-center uk-margin-large-top uk-margin-bottom">My tickets</h1>
        <div class="my-tickets-table">
            <table class="uk-table uk-table-middle uk-table-hover">
                <thead>
                <tr>
                    <th>Movie</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($userTickets as $ticket)
                    <tr>
                        <td>{{ $ticket[0]['film_name'] }}</td>
                        <td><img class="uk-preserve-width" src="{{ $ticket[0]['path'] }}" alt="movie-img"
                                 style="width: 100px; height: 120px; object-fit: cover"></td>
                        <td>{{ $ticket[0]['created_date'] }}</td>

                        @if($ticket[0]['status'] === "UnPaid")
                            <td style="color: red; min-width: 67px;">{{ $ticket[0]['status'] }}<a style="text-decoration: none;"
                                                                                href="/stripe/repay?sessionId={{ $ticket[0]['session_id'] }}"> <i
                                        class="uk-icon-refresh refresh-icon"></i></a></td>

                        @elseif($ticket[0]['status'] === "Expired")
                            <td style="color: red">{{ $ticket[0]['status'] }}</td>
                        @else
                            <td style="color: limegreen">{{ $ticket[0]['status'] }}</td>
                        @endif

                        <td class="ticket-details-popup" data-session-id={{ $ticket[0]['session_id'] }}></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <ul class="uk-pagination uk-margin-large-top" uk-margin>
                @if($pagination['prev_page_url'] === null)
                    <li style="pointer-events: none"><a href="{{ $pagination['prev_page_url'] }}"><i
                                class="uk-icon-chevron-left" style="color: grey; opacity: 50%"></i></a></li>
                @else
                    <li><a href="{{ $pagination['prev_page_url'] }}"><i class="uk-icon-chevron-left"></i></a></li>
                @endif

                @if($pagination['next_page_url'] === null)
                    <li style="pointer-events: none"><a href="{{ $pagination['next_page_url'] }}"><i
                                class="uk-icon-chevron-right" style="color: grey; opacity: 50%"></i></a></li>
                @else
                    <li><a href="{{ $pagination['next_page_url'] }}"><i class="uk-icon-chevron-right"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".refresh-icon").on("click", function () {
            $(this).addClass("repay-rotate-animation");
            setTimeout(() => {
                $(this).removeClass("repay-rotate-animation");
                setTimeout(() => {
                    window.location.href = $(this).parent().attr("href");
                }, 3000); // 3 seconds delay
            }, 1000);
        });
    </script>
@endsection
