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
                            <li class="uk-width-medium-1-2"><a href="#">Comments</a></li>
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
                                <h3 class="uk-text-contrast uk-margin-top">Type Comment</h3>
                                <div class="uk-alert uk-alert-warning" data-uk-alert="">
                                    <a href="" class="uk-alert-close uk-close"></a>
                                    <p><i class="uk-icon-exclamation-triangle uk-margin-small-right"></i>
                                        Please <a class="uk-text-contrast"
                                                  href="http://market.gorilletheme.com/Blockter/en/login">Sign In</a>
                                        Sign up to write a message
                                    </p>
                                </div>
                                <!--   ================  Messagge ================  -->
                                <!--   ================  Messagge ================= -->
                                <!--   ================  Messagge ================= -->
                                <!--   ================  Messagge ================  -->
                                <!--   =================  Messagge ================  -->
                                <form method="post" class="uk-form uk-margin-bottom"
                                      action="http://market.gorilletheme.com/Blockter/en/Comments">
                                    <input type="hidden" name="_token" value="ROrcUstuajqKErS3KEwMqmbJmDXKRfW8243SARnz">
                                    <input type="text" name="Post_id" hidden="" value="127">
                                    <div class="uk-form-row">
                                    <textarea class="uk-width-1-1" name="Comment" cols="30" rows="5"
                                              placeholder="Type your Comment here..."></textarea>

                                        <p class="uk-form-help-block">0 Comments</p>
                                    </div>
                                    <div class="uk-form-row">
                                        <button class="uk-button uk-button-large uk-button-success uk-float-right"
                                                type="submit">
                                            Reply
                                        </button>
                                    </div>
                                </form>
                                <!--  ========================================================  Messagge ==================  -->
                            </div>
                            <div class="uk-scrollable-box uk-responsive-width">
                                <ul class="uk-comment-list uk-margin-top">
                                    <!-- =============================== Comments Posts ======================================== -->
                                    <!-- =============================== Comments Posts ======================================== -->
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
