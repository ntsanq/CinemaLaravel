@include('layouts/head')

<div class="film-info">
</div>

<div id="ticket_booking" film='{{ $film }}' user='{{ json_encode($user) }}'></div>
