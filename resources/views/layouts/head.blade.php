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
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @yield('head')
</head>
