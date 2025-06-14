@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">{{__('messages.enter_password')}}</h2>
    <div class="login-container mt-4">
    <form method="POST" action="{{ route('login.attempt') }}">
    @csrf
    <input type="hidden" name="email" value="{{ old('email', $email) }}">
    <label>{{__('messages.password')}}</label>
    <input type="password" name="password" required>

    <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">
            {{ __('messages.remember_me') }}
        </label>
    </div>

    <button type="submit" class="btn btn-primary mt-3">{{__('messages.login')}}</button>
</form>
    @error('password')
    <p style="color:red;">{{ $message }}</p>
@enderror
</div>
</div>
@endsection
