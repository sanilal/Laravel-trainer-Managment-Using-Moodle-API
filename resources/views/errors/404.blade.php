{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-4">404</h1>
    <p class="lead">{{__('messages.error_404_message')}}</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">{{__('messages.back_to_home')}}</a>
</div>
@endsection
