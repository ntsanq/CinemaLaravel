@component('mail::message')
    <h1>
        You successfully booked ticket from SAN Cinema:
    </h1>

    Thank you for using our website as SAN Cinema Service.
    We are pleased to announce your transaction has been done as follows:
    User: {{ $ticketsData[0]['user_name'] }}
    @foreach($ticketsData as $ticket)

        Movie: {{ $ticket['film_name'] }}
        Show time: {{ $ticket['start_time'] }}
        Seat: {{ $ticket['seat_name'] }}
        Seat type: {{ $ticket['seat_type'] }}
        Price: {{ $ticket['price'] }} vnd
    @endforeach

    Booked time: {{ \Carbon\Carbon::parse($ticketsData[0]['created_at'])->format('d-m-Y h:i:s A')}}

    Total paid time: {{ $totalAmount }} vnd

    Pay app: Stripe
@endcomponent
