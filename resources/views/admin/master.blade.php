<!DOCTYPE html>
<html>
<head>
    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>
<body>
<div>
    <div id="admin_dashboard" role="{{ session()->get('role') }}"></div>
    @yield('content')
</div>
</body>
</html>
