<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    {{-- Favicon--}}
    <link rel="icon shortcode" href="{{ asset('assets/images/s-logo.png') }}">


    {{-- Font--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/Fontawesome/css/all.css') }}">

    {{-- Google--}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&amp;display=swap" rel="stylesheet">

    {{-- Css--}}
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <title>@yield('title', "Sang's Website")</title>

    @yield('head')
</head>
<body>
<div id="container">
    <nav id="tm-header" class="uk-navbar">
        <div class="uk-container uk-container-center">

            <a class="uk-navbar-brand uk-hidden-small" href="{{ url('/') }}">
                <img alt="s-logo" src="{{ asset('assets/images/s-logo.png') }}" width="60px">
            </a>

            <form method="GET" action="/" role="search" name="myForm" onsubmit="return validateForm()"
                  class="uk-search uk-margin-small-top uk-margin-left uk-hidden-small">
                <input class="uk-search-field" placeholder="Search" name="search" type="search">
                <div class="uk-dropdown uk-dropdown-flip uk-dropdown-search" aria-expanded="false"></div>
            </form>
            <div class="uk-navbar-flip uk-hidden-small">

                <div class="uk-button-group">
                    <a class="uk-button uk-button-link uk-button-large" href="#">Sign In</a>
                    <a class="uk-button uk-button-success uk-button-large uk-margin-left" href="#">
                        <i class="uk-icon-lock uk-margin-small-right"></i> Sign Up</a>
                </div>

            </div>
            <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small uk-icon-medium" data-uk-offcanvas=""></a>
            <div class="uk-navbar-flip uk-visible-small">
                <a href="#offcanvas" class="uk-navbar-toggle uk-navbar-toggle-alt uk-icon-medium"
                   data-uk-offcanvas=""></a>
            </div>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
                <img alt="Blockter" src="##" width="100px">
            </div>
        </div>
    </nav>

    <div id="main-content">
        @yield('content')
    </div>

    <div id="footer">
        <footer id="tm-footer" class=" uk-block-secondary uk-block-small">
            <div class="uk-container-center uk-container">
                <div class="uk-grid">
                    <div class="uk-width-medium-5-10">
                        <div class="copyright-text">&copy; 2022
                            <span class="uk-text-bold">Sang's Website</span>
                            <span>- Copyright © 2022 . All rights reserved.</span>
                        </div>
                    </div>
                    <div class="uk-width-medium-5-10">
                        <div class=" uk-float-right">
                            <ul class="uk-subnav">
                                <li><a href="https://www.facebook.com/"><i
                                            class="uk-icon-facebook uk-icon-small"></i></a>
                                </li>
                                <li><a href="https://twitter.com"><i class="uk-icon-twitter uk-icon-small"></i></a></li>
                                <li><a href="https://www.instagram.com"><i class="uk-icon-instagram uk-icon-small"></i></a>
                                </li>
                                <li><a href="https://www.youtube.com"><i class="uk-icon-youtube uk-icon-small"></i></a>
                                </li>
                                <li><a href="https://www.linkedin.com"><i
                                            class="uk-icon-snapchat uk-icon-small"></i></a>
                                </li>
                                <li><a href="https://www.tumblr.com"><i class="uk-icon-tumblr uk-icon-small"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>


<!--     Include JS   -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/uikit.min.js') }}"></script>
<script src="{{ asset('assets/js/grid.min.js') }}"></script>
@yield('script')
<!-- end Include JS   -->

</body>
</html>
