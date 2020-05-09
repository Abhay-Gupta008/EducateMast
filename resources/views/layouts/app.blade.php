<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="{{ url('/') }}">{{ env("APP_NAME") }}</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
             id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
            </ul>
        @guest
            <span class="navbar-text actions"> <a class="login" href="{{ route('login') }}">Log In</a><a class="btn btn-light action-button" role="button" href="{{ route('register') }}">Register</a></span>
        @else
            <ul class="nav navbar ml-auto">
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-dark" data-toggle="dropdown" aria-expanded="false" href="#">{{ Auth::user()->username }} </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" role="presentation" href="{{ route('profiles.show', [Auth::user()->username]) }}">{{ __('My Profile') }}</a>
                        <a class="dropdown-item" role="presentation" href="{{ route('profiles.edit', [Auth::user()->username]) }}">Edit Profile</a>
                        @can('viewAdminDashboard')<a class="dropdown-item" role="presentation" href="{{ route('admin.dashboard.show') }}">Admin Dashboard</a>@endcan
                        <a class="dropdown-item" role="presentation" href="{{ route('logout') }}" onclick="event.preventDefault()
                        document.getElementById('logout-form').submit()
                        ">Logout</a>
                    </div>
                </li>
                <form id="logout-form" method="post" action="{{ route('logout') }}" style="display: none">
                    @csrf
                </form>
            </ul>
        @endguest
        </div>
    </div>
</nav>
<main id="app">
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-primary" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
    @yield('content')
</main>
<div class="footer-dark">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 item">
                    <h3>Social</h3>
                    <ul>
                        <li><a target="_blank" href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li><a target="_blank" href="{{ route('patreon') }}">Patreon</a></li>
                        <li><a target="_blank" href="{{ route('discord') }}">Discord</a></li>
                        <li><a target="_blank" href="{{ route('twitter') }}">Twitter</a></li>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>{{ env('APP_NAME') }}</h3>
                    <p>{{ env('APP_NAME') }} is a blog website that gives you a wide variety of knowledge, from Geography to Gaming.</p>
                </div>
                <div class="col item social"><a target="_blank" href="{{ route('twitter') }}"><i class="icon ion-social-twitter"></i></a></div>
            </div>
            <p class="copyright">&copy; Copyright {{ env('APP_START') }}-{{ now()->format('Y') }} {{ env('APP_NAME') }} and/or all child companies.</p>
        </div>
    </footer>
</div>
</body>
</html>
