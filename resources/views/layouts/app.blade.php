<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trainer Management')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Arabic-specific CSS -->
@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
@endif
</head>
<body>
    {{-- Header --}}
    <header class="header">
        <div class="container">
            <div class="row">
                {{-- Logo --}}
                @if(app()->getLocale() === 'ar')
    <div class="col-md-8 text-end nav-top">
        @guest
            {{-- Login/Register links (commented out) --}}
        @else
            
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-light" onclick="return confirm('Are you sure you want to logout?')">{{__('messages.logout')}}</button>
            </form>
        @endguest

        <!-- Language Switcher -->
       @php
    $locale = app()->getLocale();
    $languages = [
        'en' => 'English',
        'ar' => 'العربية',
    ];
    // Remove current locale from the list to show in dropdown
    $otherLanguages = collect($languages)->except($locale);
@endphp

<span class="dropdown languageswitcher">
    <button class="btn btn-primary dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $languages[$locale] }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="langDropdown">
        @foreach($otherLanguages as $code => $language)
            <li><a class="dropdown-item" href="{{ route('changeLang', ['locale' => $code]) }}">{{ $language }}</a></li>
        @endforeach
    </ul>
</span>

        
    </div>

    <div class="col-md-4 d-flex align-items-center">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/arkan logo.png') }}" alt="Arkan Training Researches and Management Consultancy" class="img-fluid">
        </a>
    </div>
@else
    <div class="col-md-4 d-flex align-items-center">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/arkan logo.png') }}" alt="Arkan Training Researches and Management Consultancy" class="img-fluid">
        </a>
    </div>

    <div class="col-md-8 text-end nav-top">
        @guest
            {{-- Login/Register links (commented out) --}}
        @else
            
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-light" onclick="return confirm('Are you sure you want to logout?')">{{__('messages.logout')}}</button>
            </form>
        @endguest

        <!-- Language Switcher -->
@php
  $locale = app()->getLocale();
    $languages = [
        'en' => 'English',
        'ar' => 'العربية',
    ];
     $otherLanguages = collect($languages)->except($locale);
    @endphp
        <span class="dropdown languageswitcher">
    <button class="btn btn-primary dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $languages[$locale] }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="langDropdown">
        @foreach($otherLanguages as $code => $language)
            <li><a class="dropdown-item" href="{{ route('changeLang', ['locale' => $code]) }}">{{ $language }}</a></li>
        @endforeach
    </ul>
</span>
    </div>
@endif

             <!-- Main Navigation -->
             <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNavbar">
                        <ul class="navbar-nav ms-auto nav-main">
    @auth
        {{-- Common Links for All Authenticated Users --}}
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link text-light">
                {{ __('messages.home') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-light">
                {{ __('messages.dashboard') }}
            </a>
        </li>

        {{-- Admin Specific Links --}}

        @if(auth()->user()->is_admin == 1)
            <li class="nav-item">
                <a href="{{ url('/trainers/registered-trainers') }}" class="nav-link text-light">
                    {{ __('messages.browse_trainers') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/moodle/users') }}" class="nav-link text-light">
                    {{ __('messages.unregistered_trainers') }}
                </a>
            </li>
        @endif
    @endauth
</ul>

                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} {{__('messages.arkan_allrights')}}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- This renders pushed scripts --}}
    @stack('scripts')
</body>
</html>