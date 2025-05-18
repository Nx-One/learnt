<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">

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

        <!-- Tiny MCE -->
        <!-- Place the first <script> tag in your HTML's <head> -->
        <script src="https://cdn.tiny.cloud/1/u3e13p0vei6a50o8h82xd466ed78r8se8v5jra26ephepikj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
        tinymce.init({
            selector: 'textarea#editor',
            plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Oct 4, 2024:
            // 'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
        tinymce.init({
            selector: 'textarea#simple',
            height: 300,
            plugins: [
            // Core editing features
            // 'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Oct 4, 2024:
            // 'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
            ],
            toolbar: 'bold italic underline strikethrough | link image media table mergetags | addcomment showcomments',
            tinycomments_mode: 'embedded',
            placeholder: 'Type your message here',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
        </script>
    </head>
    <body id="body-pd" class="bg-secprim">
        <header class="header" id="header">
            <div class="header_toggle"><i class="bx bx-menu" id="header-toggle"></i></div>
            <!-- Right Header -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        {{-- @if (Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{ route('admin.index') }}">Admin Panel</a>
                        @endif --}}
                        {{-- <a class="dropdown-item" href="#">Profile</a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
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
        {{-- {{ (request()->route()->getName()) }} --}}
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="{{ route('home') }}" class="nav_logo"><img class="nav_logo-icon" src="{{ asset('img/logo-icon.svg') }}" alt="" width="20" height="20" /><span class="nav_logo-name">{{ config('app.name', 'Laravel') }}</span> </a>
                    <div class="nav_list">
                        <a href="{{ route('home') }}" class="nav_link {{ (request()->routeIs('home')) || (request()->routeIs('')) ? 'active' : '' }}"> <i class="bx bx-grid-alt nav_icon"></i> <span class="nav_name">Dashboard</span> </a>
                        <a href="{{ route('courses.index') }}" class="nav_link {{ (request()->routeIs('courses.*')) ? 'active' : '' }}"> <i class='bx bx-book-open nav_icon'></i> <span class="nav_name">Course</span> </a>
                        <a href="{{ route('articles.index') }}" class="nav_link {{ (request()->routeIs('articles.*')) ? 'active' : '' }}"><i class='bx bx-notepad nav_icon'></i><span class="nav_name">Article</span> </a>
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('users.index') }}" class="nav_link {{ (request()->routeIs('users.*')) ? 'active' : '' }}"><i class='bx bx-user'></i><span class="nav_name">User</span> </a>
                        @endif
                    </div>
                </div>
                {{-- <a href="{{ route('about') }}" class="nav_link {{ (request()->routeIs('about')) ? 'active' : '' }}"><i class='bx bx-info-circle nav_icon'></i><span class="nav_name">About Us</span></a> --}}
            </nav>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!--Container Main start-->
        <main class="py-4">
            <div class="row">
                @yield('backButton')
                <div class="col">
                    <h2 class="fw-bold">
                        @yield('pagename', 'Dashboard')
                    </h2>
                </div>
            </div>
            <hr class="mb-4">
            @yield('content')
        </main>
        <!--Container Main end-->
        <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('js/vendor/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        @yield('scripts')
    </body>
</html>
