<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    <h1>@yield('title')</h1>
    @section('menubar')
    <h2>※メニュー</h2>
    <ul>
        <li>@show</li>
    </ul>
    <hr size="1">
    <div class="content">
    @yield('content')
    </div>
    <div>
    @yield('footer')
    </div>
</body>
</html>

