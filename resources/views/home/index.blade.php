@extends('master')

@section('title')
    {{  __('Home page') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css111') }}">
@endsection

@section('content')

    {{--container--}}
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
                            <a class="uk-position-cover" href="/films/32"></a>
                        </div>
                        <div class="uk-panel">
                            <h5 class="uk-panel-title">Jikirag</h5>
                            <p>
                            <span class="rating">
                              <i class="uk-icon-language"></i>French (2050)

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
                            <a class="uk-position-cover"
                               href="http://market.gorilletheme.com/Blockter/Movies/madly-in-love"></a>
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
                            <a class="uk-position-cover"
                               href="http://market.gorilletheme.com/Blockter/Movies/heatwave"></a>
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
        </div>
    </div>
    {{--end container--}}
@endsection
