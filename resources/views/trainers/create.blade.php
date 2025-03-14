@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-title">
        <h2>Personal Information</h2>
    </div>

    <div class="form-container profile-form">
        <form action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="moodle_user_id" value="{{ $moodleUser['id'] }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prefix">Prefix</label>
                    <x-select-field name="prefix" :options="['Mr', 'Mrs', 'Ms', 'Dr']" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prefix2">Prefix2</label>
                    <x-select-field name="prefix2" :options="[
                        'Brigadier(Ret)', 'Colonel(Ret)', 'Lieutenant Colonel(Ret)', 
                        'Major(Ret)', 'Captain(Ret)', 'Lieutenant(Ret)'
                    ]" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="radio" name="gender" value="male" >
                    <input type="radio" name="gender" value="female" >
                </div>
            </div>
        </div>
      <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $moodleUser['firstname'] ?? '') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name', $moodleUser['middlename'] ?? '') }}" required>
                </div>
            </div>
      </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="family_name">Family Name</label>
                    <input type="text" name="family_name" value="{{ old('family_name', $moodleUser['lastname'] ?? '') }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{-- <p>Date of Birth: {{ $dob ?? 'Not available' }}</p> --}}

        {{-- Debugging --}}
        {{-- <pre>
            @php
               // print_r($moodleUser);
                echo "\nExtracted DOB: " . ($dob ?? 'NULL');
            @endphp
        </pre> --}}

       
        <label>Date of Birth</label>
        <input type="date" name="dob" value="{{ old('dob', $dob ?? '') }}" required min="1900-01-01" max="2020-12-31">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Country:</label>
                   <x-select-field name="country" :options="config('countries.list')" :selected="$moodleUser['country'] ?? ''" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Residency Status:</label>
                    <x-select-field name="residency_status" :options="['UAE National', 'Golden Visa', 'Green Visa', 'Employment Visa', 'Family Visa', 'Student Visa', 'Visitor Visa']" />
                </div> 
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Residing City:</label>
                    <x-select-field name="residency_status" :options="['Abu Dhabi', 'Dubai', 'Green Visa', 'Employment Visa', 'Family Visa', 'Student Visa', 'Visitor Visa']" />
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $moodleUser['email'] ?? '') }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mobile Number: </label>
                    <input type="text" name="phone" value="{{ old('phone', $moodleUser['phone2'] ?? '') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group w-full d-flex flex-column ">
                    <div class="d-flex w-full justify-between align-items-center">
                        <label>Upload Your Photo:</label>
                
                    @if(!empty($moodleUser['profileimageurl'])) 
                        <div class="profile-image">
                            <img src="{{ $moodleUser['profileimageurl'] }}" alt="Profile Image" class="rounded-full">
                        </div>
                    @endif
                    
                    <input type="file" name="profileimage" accept="image/*">
                    </div>
                    <span>.jpeg / png </span>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Website URL: </label>
                    <input type="text" name="website" value="{{ old('website', $moodleUser['website'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>LinkedIn </label>
                    <input type="text" name="linkedin" value="{{ old('linkedin', $moodleUser['linkedin'] ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Facebook </label>
                    <input type="text" name="facebook" value="{{ old('facebook', $moodleUser['facebook'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Insagram </label>
                    <input type="text" name="insagram" value="{{ old('insagram', $moodleUser['insagram'] ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Youtube </label>
                    <input type="text" name="youtube" value="{{ old('youtube', $moodleUser['youtube'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>X </label>
                    <input type="text" name="x" value="{{ old('x', $moodleUser['x'] ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Others </label>
                    <input type="text" name="others" value="{{ old('others', $moodleUser['others'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group flex-column align-items-start">
                    <label class="w-100">About You</label>
                    <textarea class="w-100" name="about_you">{{ old('about_you', str_replace('<br />', "\n", strip_tags($moodleUser['description'] ?? ''))) }}</textarea>

                </div>
                <button type="submit">SAVE AND PROCEED </button>
        </div>
           
           


    </form>
    </div>
</div>
@endsection
