<h1>
    You successfully booked ticket from SAN Cinema:

    <br>
    @foreach($ticketsData as $ticket)
        "id": {{ $ticket['id'] }},
        <br>
        "start_time": {{ $ticket['start_time'] }},
        <br>
        "end_time": {{ $ticket['end_time'] }},
        <br>
        "film_name": {{ $ticket['film_name'] }},
        <br>
        "seat_name": {{ $ticket['seat_name'] }},
        <br>
        "user_name": {{ $ticket['user_name'] }},
        <br>
        "seat_type": {{ $ticket['seat_type'] }}
        <br>
        ---------------------
        <br>
    @endforeach

</h1>
