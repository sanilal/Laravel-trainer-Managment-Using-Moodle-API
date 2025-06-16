@extends('layouts.app')

@section('content')
<div class="container dashboard-container">
    <h2 class="mb-4 text-secondary">{{ __('messages.dashboard_title') }}</h2>

    <div class="card p-4">
        <h4>{{ __('messages.my_profile') }}</h4>

        {{-- progress bar --}}
        <div class="progress mb-3" style="height: 20px;">
            <div class="progress-bar"
                 role="progressbar"
                 style="width: {{ $progress }}%; background-color: {{ $progress >= 80 ? '#28a745' : ($progress >= 50 ? '#ffc107' : '#dc3545') }};">
                {{ round($progress) }}%
            </div>
        </div>

        {{-- edit button --}}
        <a href="{{ url('/trainers/' . $trainer->id . '/edit') }}" class="btn btn-primary">
            {{ __('messages.edit_profile') }}
        </a>
    </div>
</div>
@endsection
