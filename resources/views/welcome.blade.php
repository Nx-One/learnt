<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Styles -->
        <link href="{{ asset('css/layout.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    </head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"><i class="bx bx-menu" id="header-toggle"></i></div>
            <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt="" /></div>
            <!-- Right Header -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{-- {{ Auth::user()->name }} --}} Testing
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        {{-- @if (Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{ route('admin.index') }}">Admin Panel</a>
                        @endif --}}
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo"><img class="nav_logo-icon" src="{{ asset('img/logo-icon.svg') }}" alt="" width="20" height="20" /><span class="nav_logo-name">Leanrt</span> </a>
                    <div class="nav_list">
                        <a href="#" class="nav_link active"> <i class="bx bx-grid-alt nav_icon"></i> <span class="nav_name">Dashboard</span> </a>
                        <a href="#" class="nav_link"> <i class='bx bx-book-open nav_icon'></i> <span class="nav_name">Course</span> </a>
                        <a href="#" class="nav_link"><i class='bx bx-notepad nav_icon'></i><span class="nav_name">Article</span> </a>
                    </div>
                </div>
                <a href="#" class="nav_link"><i class='bx bx-info-circle nav_icon'></i><span class="nav_name">About Us</span></a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light">
            <h4>Main Components</h4>
        </div>
        <!--Container Main end-->
        <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('js/vendor/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
