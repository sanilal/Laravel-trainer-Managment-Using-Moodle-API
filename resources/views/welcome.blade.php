@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <script> 
        // window.location.href = "{{ route('dashboard') }}";
        window.location.href = "{{ route('trainers.registered.trainers') }}";
        </script>
    @else
        @include('auth.login') {{-- This will load login form --}}
    @endif
@endsection
