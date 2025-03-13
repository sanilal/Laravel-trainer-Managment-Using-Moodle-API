@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Trainer Registration - Step 1: Personal Information</h2>

    <form action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label for="prefix">Prefix</label>
        <x-select-field name="prefix" :options="['Mr', 'Mrs', 'Ms', 'Dr']" />

        <label for="prefix2">Prefix2</label>
        <x-select-field name="prefix2" :options="[
            'Brigadier(Ret)', 'Colonel(Ret)', 'Lieutenant Colonel(Ret)', 
            'Major(Ret)', 'Captain(Ret)', 'Lieutenant(Ret)'
        ]" />

        <label>First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name', $moodleUser['firstname'] ?? '') }}" required>

        <label>Middle Name</label>
        <input type="text" name="middle_name" value="{{ old('middle_name', $moodleUser['middlename'] ?? '') }}" required>

        <label>Family Name</label>
        <input type="text" name="family_name" value="{{ old('family_name', $moodleUser['lastname'] ?? '') }}" required>

        <p>Date of Birth: {{ $dob ?? 'Not available' }}</p>

        {{-- Debugging --}}
        <pre>
            @php
               // print_r($moodleUser);
                echo "\nExtracted DOB: " . ($dob ?? 'NULL');
            @endphp
        </pre>

       
        <label>Date of Birth</label>
        <input type="date" name="dob" value="{{ old('dob', $dob ?? '') }}" required min="1900-01-01" max="2020-12-31">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $moodleUser['email'] ?? '') }}" required>

        <label>Country</label>
        <input type="text" name="country" value="{{ old('country', $moodleUser['country'] ?? '') }}">

        <label>About You</label>
        <textarea name="about_you">{{ old('about_you', $moodleUser['description'] ?? '') }}</textarea>

        <button type="submit">Next Step</button>
    </form>
</div>
@endsection
