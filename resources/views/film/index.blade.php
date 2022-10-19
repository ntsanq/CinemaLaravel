@extends('master')

@section('title')
    {{  __('Home page') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css111') }}">
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
                            <li class="uk-tab-responsive uk-active uk-hidden" aria-haspopup="true"
                                aria-expanded="false">
                                <a>Active</a>
                                <div class="uk-dropdown uk-dropdown-small uk-dropdown-up">
                                    <ul class="uk-nav uk-nav-dropdown"></ul>
                                    <div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul id="media-tabs" class="uk-switcher">
                        <!-- ================ start Tab Panel =================================== -->
                        <li>
                            <img
                                src="http://market.gorilletheme.com/Blockter/images/6315e0378b2c847-sila-spokoju-300x450.jpg"
                                class="about_img">

                            <h2 class="uk-text-contrast uk-margin-large-top">Jikirag</h2>
                            <ul class="uk-subnav uk-subnav-line">
                                <li>
                                    <i class="uk-icon-clock-o uk-margin-small-right"></i>
                                    05-09-2022
                                </li>
                                <li>
                                    <i class="uk-icon-simplybuilt"></i> 30 MB
                                </li>
                                <li>
                                    <i class="uk-icon-language"></i>
                                    French (2050)

                                </li>
                                <li>
                                    <i class="uk-icon-th-large"></i>
                                    Action

                                </li>
                                <li>
                                    <a class="uk-button uk-button-primary" download=""
                                       href="http://market.gorilletheme.com/Blockter/Audios/6315e039d01eeFile.zip">
                                        <i class="uk-icon-download uk-margin-small-right"></i>
                                        Download</a>
                                </li>
                            </ul>
                            <hr>
                            <p class="uk-text-muted uk-h4">
                            <p>Pete Davidson&nbsp; A pagan village, founded on the bones of both innocent and foul, is
                                deeply rooted within the heart of an ancient Eden. When a balance of flesh and soil
                                decays,
                                the last surviving village elder battles madness and the macabre to save her people from
                                not
                                only themselves, but the monstrous judgement that burrows up from below.&nbsp; <br>
                            </p> </p>
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
