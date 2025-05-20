@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">Trainer Login</h2>

    <div class="login-container mt-4">
        <form method="POST" action="{{ route('login.check') }}" class="loginform">
            @csrf

                <label for="email">Trainer / Admin Email:</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                >
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                @error('lms')
                    <div class="mt-2 text-info">
                        User not found. <a href="{{ $message }}" target="_blank">Click here to add from LMS</a>
                    </div>
                @enderror

            <button type="submit" class="btn btn-primary mt-3">Continue</button>
        </form>
    </div>
</div>
@endsection
