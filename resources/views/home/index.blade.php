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
                        <li
                            @if(!app('request')->input('category'))
                                class="uk-nav-parent-icon-selected uk-active"
                            @endif
                        >
                            <a href="/">All Genres</a>
                        </li>
                        @foreach($data['categories'] as $category)
                            <li
                                @if(app('request')->input('category') === $category['name'])
                                    class="uk-nav-parent-icon-selected uk-contrast uk-active"
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
                                <div
                                    class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                                <a class="uk-position-cover" href="/films/{{ $film['id'] }}"></a>
                            </div>
                            <div class="uk-panel">
                                <h5 class="uk-panel-title">{{ $film['name'] }}</h5>
                                <p>
                                <span class="">
                                  {{ $film['duration'] }} <i class="uk-icon-clock-o"></i>
                                </span>
                                    <span class="uk-text-break uk-float-right uk-display-inline">
                                     <a class="uk-button uk-button-primary uk-margin-small-right"
                                        href="/ticket/select?filmId={{ $film['id'] }}">
                                        Book
                                     </a>
                                </span>
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{--end cards container--}}

                {{--Pagination--}}

                <ul class="uk-pagination uk-margin-large-top" uk-margin>
                    {{--                    <li><a href="{{ $data['prev_page_url'] }}" disabled><i class="uk-icon-chevron-left"></i></a></li>--}}
                    @foreach ($data['links'] as $link)
                        @if($link['label'] == '&laquo; Previous')
                            <li
                                @if($link['url'] === null)
                                    style="pointer-events: none"
                                @endif
                            ><a href="{{ $link['url'] }}"><i class="uk-icon-chevron-left"></i></a></li>
                        @elseif($link['label'] == 'Next &raquo;')
                            <li
                                @if($link['url'] === null)
                                    style="pointer-events: none"
                                @endif
                            ><a href="{{ $link['url'] }}"><i class="uk-icon-chevron-right"></i></a></li>
                        @elseif($link['active'] === true)
                            <li class="uk-active"><span>{{ $link['label'] }}</span></li>
                        @else
                            <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                        @endif
                    @endforeach
                </ul>
                {{--end Pagination--}}

            </div>
        </div>
    {{--end container--}}
@endsection
