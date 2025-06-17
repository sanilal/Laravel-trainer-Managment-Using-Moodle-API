@extends('layouts.app') {{-- or use your base layout --}}

@section('title', 'Access Denied')

@section('content')
    <div class="text-center py-5">
        <h1 class="text-4xl font-bold text-red-600">403 - Forbidden</h1>
        <p class="mt-4 text-gray-600">
            Sorry, you don’t have permission to access this page.<br>
            Please contact the administrator if you believe this is a mistake.
        </p>
        <a href="{{ url()->previous() }}" class="mt-6 inline-block text-blue-500 hover:underline">
            ← Go back
        </a>
    </div>
@endsection
