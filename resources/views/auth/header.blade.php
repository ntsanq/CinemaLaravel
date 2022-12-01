<nav id="tm-header" class="uk-navbar">
    <div class="uk-container uk-container-center">

        <a class="uk-navbar-brand uk-hidden-small" href="{{ url('/') }}">
            <img alt="s-logo" src="{{ asset('assets/images/s-logo.png') }}" width="60px">
        </a>
        <div class="uk-navbar-flip uk-hidden-small">

            <div class="uk-button-group">
                <a class="uk-button uk-button-link uk-button-large" href="/signIn">Sign In</a>
                <a class="uk-button uk-button-success uk-button-large uk-margin-left" href="/signUp">
                    <i class="uk-icon-lock uk-margin-small-right"></i> Sign Up</a>
            </div>

        </div>
    </div>
</nav>
