<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Trainer Management')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Header --}}
    <header class="header">
        <div class="container">
            <div class="row">
                {{-- Logo --}}
                <div class="col-md-4 d-flex align-items-center">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('images/arkan logo.png') }}" alt="Arkan Training Researches and Management Consultancy" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-8 text-end nav-top">
                    <a href="https://externalsite.com" class="text-light me-3">External Link</a>
                    @guest
                        {{-- <a href="{{ route('login') }}" class="text-light me-3">Login</a>
                        <a href="{{ route('register') }}" class="text-light">Register</a> --}}
                    @else
                        <a href="{{ route('dashboard') }}" class="text-light me-3">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                        </form>

                    @endguest

                    <!-- Language Switcher -->
                    <form action="{{ route('changeLang', 'ar') }}" method="GET" class="d-inline">
                        <button type="submit" class="btn btn-sm btn-light">عربي</button>
                    </form>
                    <form action="{{ route('changeLang', 'en') }}" method="GET" class="d-inline">
                        <button type="submit" class="btn btn-sm btn-light">English</button>
                    </form>
                </div>
             <!-- Main Navigation -->
             <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNavbar">
                        <ul class="navbar-nav ms-auto nav-main">
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link text-light">Home</a></li>
                            <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link text-light">About</a></li>
                            <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link text-light">Contact</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown">More</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://externalsite.com">External Site</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/services') }}">Services</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Arkan Trainer Management System. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>