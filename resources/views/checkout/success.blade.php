@foreach ($tickets as $ticket)
    <p>{{ $ticket['session_id'] }}</p>
@endforeach
