<!DOCTYPE html>
<html>
<head>
    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>
<body>
<div>
    <div id="admin_dashboard" role="{{ session()->get('role') }}" user="{{ session()->get('admin_name') }}"></div>
    @yield('content')
</div>
</body>
</html>
