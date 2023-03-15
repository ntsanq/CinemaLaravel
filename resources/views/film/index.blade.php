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
                        <!-- ================ start Tab Panel =================================== -->
                        <li>
                            <img
                                src="{{ $filmDetails['path'] }}"
                                class="about_img">

                            <h2 class="uk-text-contrast uk-margin-large-top">{{ $filmDetails['name'] }}</h2>

                            <ul class="uk-subnav uk-subnav-line">
                                <li>
                                    <i class="uk-icon-bolt"></i>
                                    @if(count($filmDetails['categories']) > 1)
                                        {{ implode(', ', $filmDetails['categories']) }}
                                    @else
                                        {{ $filmDetails['categories'][0] }}
                                    @endif
                                </li>
                                <li>
                                    <i class="uk-icon-language"></i>
                                    {{ $filmDetails['language'] }}
                                </li>
                            </ul>
                            <hr>
                            <p class="uk-text-muted uk-h4">
                            <p>
                                {{ $filmDetails['description'] }}
                                <br>
                            </p>

                            <div style="color: #f10b0b" class="">
                                (*)
                                @if(count($filmDetails['rules']) > 1)
                                    {{ implode(', ', $filmDetails['rules']) }}
                                @else
                                    {{ $filmDetails['rules'][0] }}
                                @endif
                            </div>
                            <p class="uk-text-muted uk-h4 uk-margin-large-top">
                                <a class="uk-button uk-button-primary uk-margin-small-right uk-height-1-1"
                                   href="/ticket/select?filmId={{ $filmDetails['id'] }}">
                                    Book
                                </a>
                            </p>
                        </li>
                        <!--  ================= ./ Tab Panel 1 =========================== -->
                        <li>
                            <div class="uk-margin-small-top">
                                <h3 class="uk-text-contrast uk-margin-top">{{ $filmDetails['name'] }}:</h3>
                                <iframe style="width: 100%; height: 650px" src="{{ $filmDetails['trailer_link'] }}"
                                        uk-video="autoplay: true">
                                </iframe>
                                <span>{{ $filmDetails['trailer_link'] }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
