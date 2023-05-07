<!DOCTYPE html>
<html>
@include('layouts/head')
<body>
<div id="container">
    <div id="main-content">
        @yield('content')
    </div>
    @include('layouts/footer')
</div>
@include('layouts/script')
@yield('script')
</body>
</html>
