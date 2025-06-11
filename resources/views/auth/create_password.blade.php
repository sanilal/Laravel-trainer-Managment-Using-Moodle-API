@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{__('messages.create_password')}}</h2>
    <div class="login-container mt-4">
        <form method="POST" action="{{ route('login.create_password') }}" class="loginform">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <label>{{__('messages.password')}}</label>
        <input type="password" name="password" required>
        <label>{{__('messages.confirm_password')}}</label>
        <input type="password" name="password_confirmation" required>
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror
        <button type="submit" class="btn btn-primary mt-3">{{__('messages.register_login')}}</button>
    </form>
    </div>
    
</div>
@endsection
