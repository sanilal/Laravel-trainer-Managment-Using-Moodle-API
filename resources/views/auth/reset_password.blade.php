@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">{{ __('messages.reset_password') }}</h2>
<div class="login-container mt-4">
<form method="POST" action="{{ route('password.update') }}" class="mt-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.new_password') }}</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('messages.reset_password') }}
        </button>
    </form>
</div>
    
</div>
@endsection
