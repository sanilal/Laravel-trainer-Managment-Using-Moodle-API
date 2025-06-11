@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">{{__('messages.trainer_login ')}}</h2>

    <div class="login-container mt-4">
        <form method="POST" action="{{ route('login.check') }}" class="loginform">
            @csrf

                <label for="email">{{__('messages.trainer_admin_email')}}</label>
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
                        {{__('messages.User_not_found_contact_administrator')}}</a>
                    </div>
                @enderror

            <button type="submit" class="btn btn-primary mt-3">{{__('messages.continue')}}</button>
        </form>
    </div>
</div>
@endsection
