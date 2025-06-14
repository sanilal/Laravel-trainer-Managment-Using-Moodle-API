@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">{{ __('messages.forgot_password') }}</h2>

    @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('messages.send_password_reset_link') }}
        </button>
    </form>
</div>
@endsection
