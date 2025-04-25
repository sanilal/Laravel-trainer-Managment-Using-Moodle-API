@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-wraper">
        <div class="section-title">
            <h2>Personal Information</h2>
        </div>
        <div class="profile-info" id="personal-info">
            <div class="profilepic">
<img src="" alt="">
            </div>
            <div class="basic_personal">
            <p class="name">Dr. Ahmed Mohamed Al Suwaidi </p>
            <p class="designation">Brigadier (Ret)</p>
            <div class="namedetails">
                <p>
                    First Name: Ahmed
Mddle Name: Mohamed
Family Name: Al Suwaidi
Title: Brigadier (Ret)
                </p>
            </div>
            </div>
            <div class="more_personal">
                <p>
                    Gender: Male
Date of Birth: 13/02/1970
Languages Known: Arahbic, English
                </p>
            </div>

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body d-flex align-items-center">
            <img src="{{ $trainer->profile_image ?? asset('default-avatar.png') }}" class="rounded-circle me-4" width="100" height="100" alt="Profile Image">
            <div>
                <h3>{{ $trainer->salutation }} {{ $trainer->first_name }} {{ $trainer->lastname }}</h3>
                <p><strong>Email:</strong> {{ $trainer->email }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($trainer->gender) }}</p>
                <p><strong>Country:</strong> {{ $trainer->country }}</p>
                <p><strong>City:</strong> {{ $trainer->residing_city }}</p>
                <p><strong>Specializations:</strong> {{ $trainer->specializations->pluck('title')->join(', ') ?? 'N/A' }}</p>
                <!-- Add more fields as needed -->
            </div>
        </div>
    </div>

    {{-- Optional: Additional Sections --}}
    {{-- Include partials for documents, academics, etc. if available --}}
</div>
@endsection
