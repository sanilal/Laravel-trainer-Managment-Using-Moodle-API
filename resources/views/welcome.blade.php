@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <script>window.location.href = "{{ route('dashboard') }}";</script>
    @else
        @include('auth.login') {{-- This will load login form --}}
    @endif
@endsection
