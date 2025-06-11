@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">{{__('messages.enter_password')}}</h2>
    <div class="login-container mt-4">
    <form method="POST" action="{{ route('login.attempt') }}" class="loginform">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <label>{{__('messages.password')}}</label>
        <input type="password" name="password" required>
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror
        <button type="submit" class="btn btn-primary mt-3">{{__('messages.login')}}</button>
    </form>
</div>
</div>
@endsection
