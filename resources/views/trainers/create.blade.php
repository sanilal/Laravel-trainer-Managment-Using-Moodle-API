@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Trainer Registration - Step 1: Personal Information</h2>

    <form action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="">Prefix</label>
        <select name="prefix" >
            <option value="Mr" >Mr</option>
            <option value="Mrs" >Mrs</option>
            <option value="Ms" >Ms</option>
            <option value="Dr"  >Dr</option>
        </select>
        <label for="">Prefix2</label>
        <select name="prefix" >
            <option value="Brigadier(Ret)">Brigadier(Ret)</option>
            <option value="Colonel(Ret)">Colonel(Ret)</option>
            <option value="Lieutenant Colonel(Ret)">Lieutenant Colonel(Ret)</option>
            <option value="Major(Ret)">Major(Ret)</option>
            <option value="Captain(Ret)">Captain(Ret)</option>
            <option value="Lieutenant(Ret)">Lieutenant(Ret)</option>

        </select>
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ $moodleUser['firstname'] ?? '' }}" required>
        <label>Middle Name</label>
        <input type="text" name="middle_name" value="{{ $moodleUser['middlename'] ?? '' }}" required>
        {{-- <label>Username</label>
        <input type="text" name="username" value="{{ $moodleUser['username'] ?? '' }}" required> --}}

        <label>Family Name</label>
        <input type="text" name="family_name" value="{{ $moodleUser['lastname'] ?? '' }}" required>

        <label>Date of Birth</label>
        <input type="date" name="dob" value="{{ $moodleUser['dob'] ?? '' }}" required
        min="1900-01-01" max="2020-12-31">

        <label>Email</label>
        <input type="email" name="email" value="{{ $moodleUser['email'] ?? '' }}" required>

        <label>Country</label>
        <input type="text" name="country" value="{{ $moodleUser['country'] ?? '' }}">

        <label>About You</label>
        <textarea name="about_you">{{ $moodleUser['description'] ?? '' }}</textarea>

        <button type="submit">Next Step</button>
    </form>
</div>
@endsection
