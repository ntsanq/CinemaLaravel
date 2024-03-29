@extends('master')

@section('title')
    {{  __('Home page') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
@endsection

@section('content')
    <div id="banner-container">
        <img id="banner-img" src="https://media.timeout.com/images/105771947/image.jpg" alt="banner-img">
        <div id="banner-text">SAN Cinema</div>
    </div>

    <div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
        <div class="uk-grid">
            <div id="tm-left-section" class="uk-width-medium-3-10 uk-width-large-2-10 uk-hidden-small">
                <div class="uk-panel">
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
                                <a href="/?category={{ $category['name'] }}">
                                    {{ $category['name'] }}
                                </a>
                            </li>
                        @endforeach

                        <li class="uk-nav-divider"></li>
                    </ul>
                    <div id="weekly_post"></div>
                </div>
            </div>
            <div id="tm-right-section" class="uk-width-large-8-10 uk-width-medium-7-10"
                 data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">
                @if(!empty($interested) && !app('request')->input('category') && !app('request')->input('search') && !app('request')->input('page'))
                    <div class="uk-flex uk-flex-center uk-margin uk-contrast">
                        <h1>Maybe you like</h1>
                    </div>
                    <div class="uk-grid-width-small-1-4 uk-grid-width-medium-1-4 uk-grid-width-large-1-4"
                         data-uk-grid="{gutter:20}" style="position: relative; margin-left: 50px;">
                        @foreach($interested as $each)
                            <div>
                                <div class="uk-overlay uk-overlay-hover movie-img">
                                    <img src="{{ $each['path'] }}" alt="movie-img">
                                    <div
                                        class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                                    <a class="uk-position-cover" href="/films/{{ $each['id'] }}"></a>
                                </div>
                                <div class="uk-panel">
                                    <h5 class="uk-panel-title film-name-card">{{ $each['name'] }}</h5>
                                    <p>
                                            <span>
                                              {{ $each['duration'] }} minutes <i class="uk-icon-clock-o"></i>
                                            </span>
                                        <span
                                            class="uk-text-break uk-float-right uk-display-inline uk-margin-small-bottom">
                                     <a class="uk-button uk-button-primary"
                                        href="/ticket/select?filmId={{ $each['id'] }}">
                                        Buy ticket
                                     </a>
                                </span>
                                    </p>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif

                <div class="uk-flex uk-flex-center uk-margin uk-contrast">
                    <h1 style="border-bottom: 0.5px solid #dfdfdf; padding-bottom: 10px">
                        Now showing </h1>
                </div>
                @if($data['data'])
                    <div class="uk-grid-width-small-1-4 uk-grid-width-medium-1-4 uk-grid-width-large-1-4"
                         data-uk-grid="{gutter:20}" style="position: relative; margin-left: 50px;">
                        @foreach($data['data'] as $film)
                            <div>
                                <div class="uk-overlay uk-overlay-hover movie-img">
                                    <img src="{{ $film['path'] }}" alt="movie-img">
                                    <div
                                        class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                                    <a class="uk-position-cover" href="/films/{{ $film['id'] }}"></a>
                                </div>
                                <div class="uk-panel">
                                    <h5 class="uk-panel-title film-name-card">{{ $film['name'] }}</h5>
                                    <p>
                                <span>
                                  {{ $film['duration'] }} minutes <i class="uk-icon-clock-o"></i>
                                </span>
                                        <span
                                            class="uk-text-break uk-float-right uk-display-inline uk-margin-small-bottom">
                                     <a class="uk-button uk-button-primary"
                                        href="/ticket/select?filmId={{ $film['id'] }}">
                                        Buy ticket
                                     </a>
                                </span>
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <ul class="uk-pagination uk-margin-large-top" uk-margin>
                        @foreach ($data['links'] as $link)
                            @if($link['label'] == '&laquo; Previous')
                                <li
                                    @if($link['url'] === null)
                                        style="pointer-events: none"
                                    @endif
                                ><a href="{{ $link['url'] }}"><i class="uk-icon-chevron-left" @if($link['url'] === null)
                                            style="color: grey; opacity: 50%"
                                            @endif></i></a></li>
                            @elseif($link['label'] == 'Next &raquo;')
                                <li
                                    @if($link['url'] === null)
                                        style="pointer-events: none"
                                    @endif
                                ><a href="{{ $link['url'] }}"><i class="uk-icon-chevron-right"
                                                                 @if($link['url'] === null)
                                                                     style="color: grey; opacity: 50%"
                                            @endif></i></a></li>
                            @elseif($link['active'] === true)
                                <li class="uk-active"><span>{{ $link['label'] }}</span></li>
                            @else
                                <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <h2 class="uk-flex uk-text-middle">No movie with "{{ app('request')->input('search') }}"</h2>
                @endif

            </div>
        </div>
@endsection
