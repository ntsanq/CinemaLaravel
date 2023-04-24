@component('mail::message')
    <h2>
        You successfully booked ticket from SAN Cinema:
    </h2>

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

    Booked time: {{ $ticketsData[0]['updated_at'] }}

    Total paid: {{ $totalAmount }} vnd

    Pay app: Stripe

    Please show the QR CODE in this link to get your tickets: http://localhost:8000/stripe/success?sessionId={{ $ticketsData[0]['session_id'] }}

@endcomponent

