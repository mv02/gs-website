<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('js/app.js') }}"></script>

    <title>Grinding Satisfaction</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-gs2 sticky-top">
        <a class="navbar-brand" href="/">Grinding Satisfaction</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse" aria-controls="collapse" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="collapse" class="collapse navbar-collapse">
            <div class="navbar-nav">
                <a href="/order" class="nav-link mx-lg-2 {{ Request::path() == 'order' ? 'active' : '' }}">New order</a>
                <a href="/" class="nav-link mx-lg-2 {{ Request::path() == '/' ? 'active' : '' }}">Home</a>
                <a href="/about" class="nav-link mx-lg-2 {{ Request::path() == 'about' ? 'active' : '' }}">About</a>
                <a href="/tracker" class="nav-link mx-lg-2 {{ Request::path() == 'tracker' ? 'active' : '' }}">Order tracker</a>
                <a href="/rules" class="nav-link mx-lg-2 {{ Request::path() == 'rules' ? 'active' : '' }}">Rules</a>
                <a href="https://discord.gg/wG9kVdw" class="nav-link mx-lg-2">Discord</a>
                <hr>
                <a href="@if (Auth::check())
                    @if (Request::is('profile*'))
                        /logout
                    @else
                        /profile
                    @endif
                @else
                    /login
                @endif" class="nav-link d-lg-none">
                    <svg width="1em" height="1em"  viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                    </svg>
                    @if (Auth::check())
                        @if (Request::is('profile*'))
                            Logout
                        @else
                            Profile: <b>{{ Auth::user()-> name }}</b>
                        @endif
                    @else
                        Login with Discord
                    @endif
                </a>
            </div>
        </div>
        @if (Auth::check())
            @if (Request::is('profile*'))
                <a href="/logout" class="btn btn-danger d-none d-lg-inline-block">Logout</a>
            @else
                <a href="/profile" class="btn btn-success d-none d-lg-inline-block">Profile: <b>{{ Auth::user()->name }}</b></a>
            @endif
        @else
            <a href="/login" class="btn btn-light d-none d-lg-inline-block">Login with Discord</a>
        @endif
    </nav>

    @yield('content')

    <div id="footer" class="container-fluid bg-black text-light py-5 text-center">
        <p>© 2020 Grinding Satisfaction</p>
        <a href="#">Back to top</a>
    </div>
</body>
</html>