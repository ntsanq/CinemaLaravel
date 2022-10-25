<!DOCTYPE html>
<html>
    @include('layouts/head')
    <body>
        <div id="container">
            @include('auth/header')
            <div id="main-content">
                <div class="uk-vertical-align uk-text-center uk-height-1-1 uk-margin-large-top">
                    <div class="uk-vertical-align-middle uk-margin-large-top" style="width: 250px;">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('layouts/footer')
        </div>
        @include('layouts/script')
        @yield('script')
    </body>
</html>
