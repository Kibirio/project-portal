<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'User Roles and Management') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/mdbootstrap.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="p-6 bg-white flex justify-between mb-3">
        <ul class="flex items-center">
            <li>
                <a href="" class="p-3">Home</a>
            </li>
            <li>
                <a href="" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="" class="p-3">Projects</a>
            </li>
        </ul>
        <ul class="flex items-center">
            @auth
                <li>
                    <a href="" class="p-3">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    <form action="{{ route('logout' )}}" method="POST" class="p-3 inline">
                        @csrf
                        <button type="submit" href="{{ route('logout') }}" class="p-3">Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
            @endguest
        </ul>
    </nav>
    @yield('content')
</body>
</html> 
