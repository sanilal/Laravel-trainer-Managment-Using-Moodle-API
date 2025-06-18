@extends('layouts.app') {{-- or use your base layout --}}

@section('title', 'Access Denied')

@section('content')
    <div class="text-center py-5">
        <h1 class="text-4xl font-bold text-red-600">{{__('messages.403_Forbidden')}}</h1>
        <p class="mt-4 text-gray-600">
            {{__('messages.Sorry_you_dont_have_permission_to_access')}}
        </p>
        <a href="{{ url()->previous() }}" class="mt-6 inline-block text-blue-500 hover:underline">
            {{__('messages.go_back')}}
        </a>
    </div>
@endsection
