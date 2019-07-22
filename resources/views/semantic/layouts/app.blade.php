<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body>

<div class="ui inverted fixed main menu">
    <div class="item">
        <a href="{{ url('/') }}">Advert</a>
    </div>

    <div class="right menu">

        @guest
            <div class="header item">
                <a class="ui blue button" href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
            @if (Route::has('register'))
                <div class="header item">
                    <a class="ui button" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            @endif
        @else
            <div class="ui dropdown item">
                {{ Auth::user()->name }}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="{{route('admin.home')}}">Admin</a>
                    <a class="item" href="{{route('cabinet.home')}}">Cabinet</a>
                    <div class="item">
                        <a class="ui black button" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        @endguest
    </div>
</div>

<main class="app-content pt-5rem">
    <div class="main ui container">
        @section('breadcrumbs', Breadcrumbs::render())
        @yield('breadcrumbs')
        @include('partials.flash')
        @yield('content')
    </div>
</main>

<footer>
    <div class="ui container pt-10">
        <div class="ui inverted segment">
            <p>&copy; {{date('Y')}} - Adverts</p>
        </div>
    </div>
</footer>

<script src="{{mix('js/app.js', 'build')}}"></script>

</body>
</html>
