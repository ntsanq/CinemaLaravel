@extends('master')

@section('title')
    {{  __('Film details') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
@endsection

@section('content')
    <div id="tm-media-section">
        <div class="uk-container uk-container-center uk-width-8-10">
            <div class="uk-grid mt-50">
                <div class="uk-width-medium-10-10">
                    <div>
                        <ul class="uk-tab uk-tab-grid" data-uk-switcher="{connect:'#media-tabs'}">
                            <li class="uk-width-medium-1-2 uk-active"><a href="#">Description</a></li>
                            <li class="uk-width-medium-1-2"><a href="#">Trailer</a></li>
                        </ul>
                    </div>
                    <ul id="media-tabs" class="uk-switcher">
                        <!-- ================ Description Tab =================================== -->
                        <li class="">
                            <img
                                src="{{ $filmDetails['path'] }}"
                                class="about_img" alt="movie-img"
                                style="width: 330px; object-fit: cover"
                            >

                            <div class="uk-flex uk-flex-column uk-margin-large-top">
                                <h2 class="uk-text-contrast">{{ $filmDetails['name'] }}</h2>
                                <div>
                                    <ul class="uk-subnav uk-subnav-line">
                                        <li>
                                            <i class="uk-icon-clock-o"></i>
                                            {{ $filmDetails['duration'] }}
                                        </li>
                                        <li>
                                            <i class="uk-icon-language"></i>
                                            {{ $filmDetails['language'] }}
                                        </li>
                                    </ul>
                                    <hr>

                                    <p>
                                        <span class="uk-text-bold uk-contrast">Description: </span>
                                        {!! $filmDetails['description'] !!}
                                        <br>
                                    </p>

                                    <p>
                                        <span class="uk-text-bold uk-contrast">Genres: </span>
                                        @if(count($filmDetails['categories']) > 1)
                                            {{ implode(', ', $filmDetails['categories']) }}
                                        @else
                                            {{ $filmDetails['categories'][0] }}
                                        @endif
                                    </p>
                                </div>

                                <div style="color: #c12525" class="">
                                    <span class="uk-text-bold uk-contrast">Rules: </span>
                                    @if(count($filmDetails['rules']) > 1)
                                        {{ implode(', ', $filmDetails['rules']) }}
                                    @else
                                        {{ $filmDetails['rules'][0] }}
                                    @endif
                                </div>
                                <div class="uk-margin-small-top">
                                    <p class="uk-text-muted uk-h4 uk-margin-top uk-flex">
                                        <a class="uk-button uk-button-primary uk-margin-small-right uk-height-1-1"
                                           href="/ticket/select?filmId={{ $filmDetails['id'] }}">
                                            Buy ticket
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <!--  ================= Trailer Tab =========================== -->
                        <li>
                            <h3 class="uk-text-contrast uk-margin-top">{{ $filmDetails['name'] }}:</h3>
                            <div class="uk-margin-small-top">
                                <div class="">
                                    <iframe style="height: 500px; width: 100%" src="{{ $filmDetails['trailer_link'] }}">
                                    </iframe>
                                </div>
                            </div>
                            <span>{{ $filmDetails['trailer_link'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
