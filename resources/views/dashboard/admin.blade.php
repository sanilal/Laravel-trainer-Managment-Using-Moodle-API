@extends('layouts.app')

@section('content')
<div class="container dashboard-container">
    <h2 class="mb-4 text-secondary">{{ __('messages.dashboard_title') }}</h2>

    {{-- Admin: active trainers table --}}
    @include('dashboard.partials.active-trainers-table')

    {{-- Admin: unregistered trainers card --}}
    <div class="card mt-4">
        <h4>{{ __('messages.unregistered_trainers') }}</h4>
        <a href="{{ url('/moodle/users') }}" class="btn btn-warning">
            {{ __('messages.view_unregistered') }}
        </a>
    </div>
</div>
@endsection
