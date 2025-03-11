@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Trainer Registration - Step 1: Personal Information</h2>
    
    <form action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ $moodleUser['username'] }}">


        <label>Family Name</label>
        <input type="text" name="family_name" value="{{ $moodleUser['lastname'] }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ $moodleUser['email'] }}" required>

        <label>Country</label>
        <input type="text" name="country" value="{{ $moodleUser['country'] }}">

        <label>About You</label>
        <textarea name="about_you">{{ $moodleUser['description'] }}</textarea>

        <button type="submit">Next Step</button>
    </form>
</div>
@endsection
