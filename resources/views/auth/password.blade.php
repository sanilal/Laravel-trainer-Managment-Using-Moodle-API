@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">Enter Your Password</h2>
    <div class="login-container mt-4">
    <form method="POST" action="{{ route('login.attempt') }}" class="loginform">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <label>Password:</label>
        <input type="password" name="password" required>
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror
        <button type="submit" class="btn btn-primary mt-3">Login</button>
    </form>
</div>
</div>
@endsection
