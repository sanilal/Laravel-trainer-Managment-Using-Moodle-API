@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Password</h2>
    <form method="POST" action="{{ route('login.create_password') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror
        <button type="submit">Register & Login</button>
    </form>
</div>
@endsection
