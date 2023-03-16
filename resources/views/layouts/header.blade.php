<nav id="tm-header" class="uk-navbar">
    <div class="uk-flex uk-flex-space-between uk-margin-large-left uk-margin-large-right">
        <div class="">
            <a class="uk-navbar-brand uk-hidden-small" href="{{ url('/') }}">
                <img alt="s-logo" src="{{ asset('assets/images/s-logo.png') }}" width="60px">
            </a>

            <form method="GET" action="/" role="search" name="myForm"
                  class="uk-search uk-margin-small-top uk-margin-left uk-hidden-small">
                <input class="uk-search-field" placeholder="Search" name="search" type="search"
                       value="{{ $search ?? '' }}">
                <div class="uk-dropdown uk-dropdown-flip uk-dropdown-search" aria-expanded="false"></div>
            </form>
        </div>

        <div class="uk-flex uk-flex-space-between">
            @if(!empty( $user ))
                <div id="profile_button" user="{{ json_encode($user) }}"></div>
            @else
                <div class="uk-button-group">
                    <a class="uk-button uk-button-link uk-button-large" href="/signIn">Sign In</a>
                    <a class="uk-button uk-button-success uk-button-large uk-margin-left" href="/signUp">
                        <i class="uk-icon-lock uk-margin-small-right"></i> Sign Up</a>
                </div>
            @endif

        </div>
        <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small uk-icon-medium" data-uk-offcanvas=""></a>
        <div class="uk-navbar-flip uk-visible-small">
            <a href="#offcanvas" class="uk-navbar-toggle uk-navbar-toggle-alt uk-icon-medium"
               data-uk-offcanvas=""></a>
        </div>
        <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
            <img alt="" src="{{ asset('assets/images/s-logo.png') }}" width="100px">
        </div>
    </div>
</nav>

