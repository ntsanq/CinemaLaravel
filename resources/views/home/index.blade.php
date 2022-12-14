@extends('master')

@section('title')
    {{  __('Home page') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
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
                            <a href="/">All Genres</a>
                        </li>
                        @foreach($data['categories'] as $category)
                        <li
                            @if(app('request')->input('category') === $category['name'])
                                class="uk-nav-parent-icon-selected"
                            @endif
                        >
                            <a href="/?category={{ $category['name' ]}}">
                                {{ $category['name'] }}
                            </a>
                        </li>
                        @endforeach
                        {{--line--}}
                        <li class="uk-nav-divider"></li>
                    </ul>
                    {{--end gernes--}}

                    {{--latest movies--}}
{{--                    <ul class="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">--}}
{{--                        <li class="uk-nav-header uk-margin-small-bottom">Latest Movies</li>--}}
{{--                        <li>--}}
{{--                            <a href="http://market.gorilletheme.com/Blockter/Movies/goodbye-solot">--}}
{{--                                <img class="uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-fade"--}}
{{--                                     src="http://market.gorilletheme.com/Blockter/images/6315bbaaf38d91.jpg">--}}
{{--                                Goodbye SoloT--}}
{{--                                <div></div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="uk-nav-divider"></li>--}}
{{--                    </ul>--}}
                    {{--end latest movies--}}

                </div>
            </div>
            {{--end NAV Pane--}}


            <div id="tm-right-section" class="uk-width-large-8-10 uk-width-medium-7-10"
                 data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">


                {{--cards container--}}
                <div class="uk-grid-width-small-1-4 uk-grid-width-medium-1-4 uk-grid-width-large-1-4"
                     data-uk-grid="{gutter:20}" style="position: relative; margin-left: 50px;">

                    @foreach($data['data'] as $film)
                    <div>
                        <div class="uk-overlay uk-overlay-hover">
                            <img
                                src="{{ $film['path'] }}">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                            <a class="uk-position-cover" href="/films/{{ $film['id'] }}"></a>
                        </div>
                        <div class="uk-panel">
                            <h5 class="uk-panel-title">{{ $film['name'] }}</h5>
                            <p>
                                <span class="rating">
                                  <i class="uk-icon-language"></i> {{ $film['language'] }}
                                </span>
                                <span class="uk-float-right">
                                  {{ $film['duration'] }} <i class="uk-icon-clock-o"></i>
                                </span>
                            </p>
                            <p>
                                <span class="uk-text-break uk-float-right">
                                     <a class="uk-button uk-button-primary uk-margin-small-right"
                                        href="/ticket/date?filmId={{ $film['id'] }}">
                                        Book
                                     </a>
                                </span>
                            </p>
                        </div>
                    </div>
                    @endforeach

                </div>
                {{--end cards container--}}

                {{--Bottom--}}

                <div class="uk-margin-large-top uk-margin-bottom">
                    <div class="uk-Movies">
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                            <a class="relative inline-flex items-center px-4 py-2 text-sm font-medium
                             text-gray-500 bg-white border border-gray-300 cursor-default
                             leading-5 rounded-md"
                               @if($data['prev_page_url']== null)
                                    style="pointer-events: none"
                               @endif
                               href="{{ $data['prev_page_url'] }}">
                            ?? Previous
                            </a>
                            <a class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300
                             leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100
                             active:text-gray-700 transition ease-in-out duration-150 uk-margin-small-left"
                               @if($data['next_page_url']== null)
                                   style="pointer-events: none"
                               @endif
                            href="{{ $data['next_page_url'] }}">
                             Next ??
                            </a>
                        </nav>
                    </div>
                </div>
                <span class="uk-margin-small-left">
                    Page {{ $data['current_page'] }} of {{ $data['last_page'] }}
                    @if($data['last_page']>1)
                        pages
                    @else
                        page
                    @endif
                </span>
            </div>
            {{--end Bottom--}}

        </div>
    </div>
    {{--end container--}}
@endsection
