<nav id="tm-header" class="uk-navbar">
    <div class="auth-buttons-group uk-flex uk-flex-space-between">
        <div class="uk-button-group uk-panel-box-primary-hover uk-visible-small">
            <div
                class="uk-button-large"
                data-uk-dropdown>
                <i class="uk-navbar-toggle"></i>
                <div class="uk-dropdown logout-btn uk-text-center">
                    <div>
                        <a href="/">
                            <button id="profile-button" type="submit"
                                    class="uk-button-link">
                                Home
                            </button>
                        </a>
                    </div>
                    <div>
                        <form method="GET" action="/" role="search" name="myForm">
                            <input class="uk-search-field uk-icon-search uk-margin-left" placeholder="Search"
                                   name="search" type="search">
                        </form>
                    </div>
                    @if(isset($data))
                        <span>-----</span>
                        @foreach($data['categories'] as $category)
                            <div
                                @if(app('request')->input('category') === $category['name'])
                                    class="uk-nav-parent-icon-selected uk-contrast uk-active"
                                @endif
                            >
                                <a href="/?category={{ $category['name'] }}" style="color: white">
                                    {{ $category['name'] }}
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="">
            <a class="uk-navbar-brand uk-hidden-small" href="{{ url('/') }}">
                <img alt="s-logo" src="{{ asset('assets/images/s-logo.png') }}" width="60px">
            </a>

            <form method="GET" action="/" role="search" name="myForm"
                  class="uk-search uk-margin-small-top uk-margin-left uk-hidden-small">
                <input class="uk-search-field" placeholder="Search" name="search" type="search"
                       value="{{ app('request')->get('search') ?? '' }}"
                       style="border: 1px solid #353535;border-radius: 20px;">
                <input type="hidden" name="category" value="{{ app('request')->input('category') }}">
                <div class="uk-dropdown uk-dropdown-flip uk-dropdown-search" aria-expanded="false"></div>
            </form>
        </div>

        <div class="uk-flex uk-navbar-flip uk-flex-space-between">
            @if(!empty( $user ))
                <div id="profile_button" user="{{ json_encode($user) }}"></div>
            @else
                <div class="uk-button-group">
                    <a class="sign-in-button uk-button uk-button-link uk-button-large" href="/signIn">Sign In</a>
                    <a class="sign-up-button uk-button uk-button-success uk-button-large uk-margin-left"
                       href="/signUp{{app('request')->get('filmId') ? "?filmId=".app('request')->get('filmId') : ''}}">
                        <i class="uk-icon-lock uk-margin-small-right"></i> Sign Up</a>
                </div>
            @endif
        </div>
    </div>
</nav>
