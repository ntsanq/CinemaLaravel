<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    {{-- Favicon--}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/s-logo.png') }}">
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
    <title>Sang's Website</title>
</head>
<body>
<nav id="tm-header" class="uk-navbar">
    <div class="uk-container uk-container-center">

        <a class="uk-navbar-brand uk-hidden-small" href="#">
            <img alt="Blockter" src="{{ asset('assets/images/s-logo.png') }}" width="60px">
        </a>

        <form method="GET" action="#" role="search" name="myForm" onsubmit="return validateForm()"
              class="uk-search uk-margin-small-top uk-margin-left uk-hidden-small">
            <input type="hidden" name="_token" value="ROrcUstuajqKErS3KEwMqmbJmDXKRfW8243SARnz">
            <input class="uk-search-field" placeholder="Search" name="search">
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
            <a href="#offcanvas" class="uk-navbar-toggle uk-navbar-toggle-alt uk-icon-medium" data-uk-offcanvas=""></a>
        </div>
        <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
            <img alt="Blockter" src="##" width="100px">
        </div>
    </div>
</nav>


<div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
    <div class="uk-grid">

        {{--NAV Pane--}}
        <div id="tm-left-section" class="uk-width-medium-3-10 uk-width-large-2-10 uk-hidden-small">
            <div class="uk-panel">

                {{--gernes--}}
                <ul class="uk-nav uk-nav-side uk-nav-parent-icon uk-margin-bottom" data-uk-nav="">
                    <li class="uk-active">
                        <a>All Genres</a></li>
                    <li>
                        <a href="http://market.gorilletheme.com/Blockter/Cat/all">
                            All
                        </a>
                    </li>
                    <li>
                        <a href="http://market.gorilletheme.com/Blockter/Cat/action">
                            Action
                        </a>
                    </li>
                    <li>
                        <a href="http://market.gorilletheme.com/Blockter/Cat/adventure">
                            Adventure
                        </a>
                    </li>
                    <li>
                        <a href="http://market.gorilletheme.com/Blockter/Cat/animation">
                            Animation
                        </a>
                    </li>
                    <li class="uk-nav-divider"></li>
                </ul>
                {{--end gernes--}}

                {{--latest movies--}}
                <ul class="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
                    <li class="uk-nav-header uk-margin-small-bottom">Latest Movies</li>
                    <li>
                        <a href="http://market.gorilletheme.com/Blockter/Movies/goodbye-solot">
                            <img class="uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-fade"
                                 src="http://market.gorilletheme.com/Blockter/images/6315bbaaf38d91.jpg">
                            Goodbye SoloT
                            <div></div>
                        </a>
                    </li>
                    <li class="uk-nav-divider"></li>
                </ul>
                {{--end latest movies--}}

            </div>
        </div>
        {{--end NAV Pane--}}

        {{--container--}}
        <div id="tm-right-section" class="uk-width-large-8-10 uk-width-medium-7-10"
             data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">

            {{--cards container--}}
            <div class="uk-grid-width-small-1-4 uk-grid-width-medium-1-4 uk-grid-width-large-1-4"
                 data-uk-grid="{gutter:20}" style="position: relative; margin-left: 50px;">

                <div>
                    <div class="uk-overlay uk-overlay-hover">
                        <img
                            src="http://market.gorilletheme.com/Blockter/images/6315e0378b2c847-sila-spokoju-300x450.jpg">
                        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                        <a class="uk-position-cover" href="http://market.gorilletheme.com/Blockter/Movies/jikirag"></a>
                    </div>
                    <div class="uk-panel">
                        <h5 class="uk-panel-title">Jikirag</h5>
                        <p>
                            <span class="rating">
                              <i class="uk-icon-language"></i>                                French (2050)

                            </span>
                            <span class="uk-float-right">
                              <i class="uk-icon-simplybuilt"></i> 30 MB
                            </span>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-overlay uk-overlay-hover">
                        <img
                            src="http://market.gorilletheme.com/Blockter/images/6315dff2a377035-brothers-bloom-300x450.jpg">
                        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                        <a class="uk-position-cover"
                           href="http://market.gorilletheme.com/Blockter/Movies/pete-davidson"></a>
                    </div>
                    <div class="uk-panel">
                        <h5 class="uk-panel-title">Pete Davidson</h5>
                        <p>
                            <span class="rating">
                              <i class="uk-icon-language"></i>                                Japanese (1791)

                            </span>
                            <span class="uk-float-right">
                              <i class="uk-icon-simplybuilt"></i> 30 MB
                            </span>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-overlay uk-overlay-hover">
                        <img
                            src="http://market.gorilletheme.com/Blockter/images/6315de14c3ef332-a-long-way-down-300x450.jpg">
                        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                        <a class="uk-position-cover"
                           href="http://market.gorilletheme.com/Blockter/Movies/being-bebe"></a>
                    </div>
                    <div class="uk-panel">
                        <h5 class="uk-panel-title">Being BeBe</h5>
                        <p>
                            <span class="rating">
                              <i class="uk-icon-language"></i>                                French (2050)

                            </span>
                            <span class="uk-float-right">
                              <i class="uk-icon-simplybuilt"></i> 30 MB
                            </span>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-overlay uk-overlay-hover">
                        <img src="http://market.gorilletheme.com/Blockter/images/6315d34f39da220-300x450.jpg">
                        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                        <a class="uk-position-cover"
                           href="http://market.gorilletheme.com/Blockter/Movies/together-free"></a>
                    </div>
                    <div class="uk-panel">
                        <h5 class="uk-panel-title">Together Free</h5>
                        <p>
                            <span class="rating">
                              <i class="uk-icon-language"></i>                                French (2050)

                            </span>
                            <span class="uk-float-right">
                              <i class="uk-icon-simplybuilt"></i> 30 MB
                            </span>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-overlay uk-overlay-hover">
                        <img src="http://market.gorilletheme.com/Blockter/images/6315c43fca74831-300x450.jpg">
                        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                        <a class="uk-position-cover" href="http://market.gorilletheme.com/Blockter/Movies/madly-in-love"></a>
                    </div>
                    <div class="uk-panel">
                        <h5 class="uk-panel-title">Madly in Love</h5>
                        <p>
                            <span class="rating">
                              <i class="uk-icon-language"></i>                                French (2050)

                            </span>
                            <span class="uk-float-right">
                              <i class="uk-icon-simplybuilt"></i> 30 MB
                            </span>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-overlay uk-overlay-hover">
                        <img src="http://market.gorilletheme.com/Blockter/images/6315c37777edc31-300x450.jpg">
                        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                        <a class="uk-position-cover" href="http://market.gorilletheme.com/Blockter/Movies/heatwave"></a>
                    </div>
                    <div class="uk-panel">
                        <h5 class="uk-panel-title">Heatwave</h5>
                        <p>
                            <span class="rating">
                              <i class="uk-icon-language"></i>                                Japanese (1791)

                            </span>
                            <span class="uk-float-right">
                              <i class="uk-icon-simplybuilt"></i> 30 MB
                            </span>
                        </p>
                    </div>
                </div>

            </div>
            {{--end cards container--}}

            {{--Bottom--}}
            <div class="uk-margin-large-top uk-margin-bottom">
                <a>
                    <img src="http://market.gorilletheme.com/Blockter/images/631d90b83d91eads2-1.png" alt="Image"
                         style="width: 100%;">
                </a>
            </div>

            <div class="uk-margin-large-top uk-margin-bottom">
                <div class="uk-Movies">
                    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                            « Previous
                            </span>
                        <a class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            Next »
                        </a>
                    </nav>
                </div>
            </div>
            {{--end Bottom--}}

        </div>
        {{--end container--}}
    </div>
</div>


<!--     Include JS   -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/uikit.min.js') }}"></script>
<script src="{{ asset('assets/js/grid.min.js') }}"></script>
<!-- end Include JS   -->

</body>
</html>
