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

<div>
    <h2 style="text-align: center; padding-top: 5rem;">Which day you want to watch?</h2>
    <form class="uk-panel uk-panel-box uk-form" style="padding: 0 20rem;" id="date-form">
        <input type="hidden" value="{{ app('request')->input('filmId') }}" name="filmId" id="filmId">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="date" name="date" id="date">
        </div>
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="submit" value="Choose">
        </div>
    </form>

    <span id="response"></span>

</div>


<script>
    const form = document.querySelector('#date-form');
    const date = document.querySelector('#date');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        try {
            getSeats(date.value);

        } catch (e) {

        }
    });

    function getSeats(date) {
        return fetch("http://localhost:8000/api/getSeatsAvailable", {
            method: 'post',
            body: {
                date: date
            }
        }, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            });
    }
</script>
