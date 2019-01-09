<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>dIV Forum</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style type="text/css" media="screen">
        body {
            font-family: Helvetica;
        }

        .date-container {
            width: 100%;
            background-color: #333;
            color: white;
            text-align: right;
        }

        .date-label {
            margin-bottom: 0px;
        }

        .navbar {
            background-color: #333;
            border: none;
        }

        .navbar-default .navbar-toggle {
            border-color: #FFFFFF;
            transition-duration: 0.5s;
        }

        .navbar-default .navbar-toggle .icon-bar {
            background-color: #FFFFFF;
            transition-duration: 0.5s;
        }

        .navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {
            background-color: #FFFFFF;
            transition-duration: 0.5s;
        }   

        .navbar-default .navbar-toggle:focus .icon-bar, .navbar-default .navbar-toggle:hover .icon-bar {
            background-color: #333;
            transition-duration: 0.5s;
        } 

        .navbar-default .navbar-nav > li > a, .navbar-default .navbar-brand, .navbar-default .navbar-brand:focus {
            background-color: #333;
            color: white;
            transition-duration: 0.5s;
        }

        .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-brand:hover {
            color: #B0FF84;
            transition-duration: 0.5s;
        }

        .icon {
            padding-right: 5px;
        }

        .dropdown-menu {
            background-color: #333;
        }

        .dropdown-menu > li > a {
            color: white;
            font-size: 18px;
        }

        .navbar-default .navbar-nav .open .dropdown-menu > li > a {
            color: white;
            transition-duration: 0.5s;
        }

        .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover {
            color: #B0FF84;
            transition-duration: 0.5s;
        }

        .dropdown-menu > li > a:hover, .open .dropdown-menu > li > a:hover {
            background-color: #333;
            color: #B0FF84;
            transition-duration: 0.5s;
        }

        .user-image {
            width: 35px; 
            height: 35px;
            position: absolute;
            top: 8px; 
            border-radius: 60px;
        }

        .user-name {
            padding-left: 45px;
        }

        .required-item {
            color: red;
        }
    </style>
</head>
<body onload="startTime()">
    <div id="app">
        <div  class="date-container">
            <div class="container">
                    <label id="date" class="date-label"></label>
            </div>
        </div>

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        dIV Forum
                    </a>

                    @auth
                         @if(Auth::user()->admin == 1)
                            <div class="btn-group">
                                <label class="navbar-brand"> / </label>
                                <button type="button" class="btn navbar-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Master <span class="caret"></span>
                                </button>
                    
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('user') }}">User</a></li>
                                    <li><a href="{{ url('master') }}">Forum</a></li>
                                    <li><a href="{{ url('category') }}">Category</a></li>
                                </ul>
                            </div>
                        @endif

                        <label class="navbar-brand"> / </label>
                        
                        <a class="navbar-brand" href="{{ url('/myforum/'.Auth::user()->id) }}">
                            My Forum
                        </a>
                    @endauth
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="icon fas fa-user"></i> Login</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}"><i class="icon fas fa-user-plus"></i> Register</a>
                                @endif
                            </li>

                        @else
                            <li class="nav-item">

                                <div class="btn-group">
                                    <button type="button" class="btn navbar-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="/avatars/{{ Auth::user()->avatar }}" class="user-image">
                                        <span class="user-name">{{ Auth::user()->name }} <span class="caret"></span></span>
                                    </button>
                                
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('profile/'.Auth::user()->id) }}">Profile</a></li>
                                        <li><a href="{{ url('message/'.Auth::user()->id) }}">Message</a></li>
                                        <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                                    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </ul>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function startTime() {
        var now = new Date();
        var day = now.getDate();
        var month = now.getMonth();
        var namedMonth = ["January", "February", "March", "April", "June", "July", "August", "September", "October", "November", "December"]
        var year = now.getFullYear();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();

        if (hour < 10)
            hour = "0" + hour;
        if (minute < 10)
            minute = "0" + minute;
        if (second < 10)
            second = "0" + second;

        document.getElementById("date").innerHTML = day + " " + namedMonth[month] + " " + year + " - " + hour + ":" + minute + ":" + second;
        setTimeout(startTime, 1000);
    }
</script>
</html>
