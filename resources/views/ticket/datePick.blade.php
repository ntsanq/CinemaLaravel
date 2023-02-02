@include('layouts/head')

<div class="film-info">
    <div>
        {{ $film->id }}
    </div>
    <div>
        {{ $film->name }}
    </div>
    <div>
        {{ $film->path }}
    </div>
</div>

<div id="ticket_booking"></div>
