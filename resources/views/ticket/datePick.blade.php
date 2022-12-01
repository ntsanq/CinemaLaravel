@include('layouts/head')
@yield('')

<form class="uk-form">
    <input type="text" data-uk-datepicker="{format:'DD.MM.YYYY'}">
</form>

<script>

    var datepicker = UIkit.datepicker(element, { "{weekstart:0, format:'DD.MM.YYYY'}" });
</script>
