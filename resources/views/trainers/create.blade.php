@extends('layouts.app')

@section('content')

{{-- Check if $moodleUser exists --}}


@if(!$moodleUser)
    <div class="alert alert-danger">Something went wrong. Moodle user not found.</div>
    @php
        return;
    @endphp
@endif
{{-- @if($moodleUser)
    @php
        $dobValue = null;

        foreach ($moodleUser['customfields'] as $field) {
            if (isset($field['shortname']) && $field['shortname'] === 'dob') {
                $dobValue = $field['value'];
                break;
            }
        }
    @endphp

    <p>Date of Birth: {{ $dobValue }}</p>
@endif --}}

{{-- {{dd($moodleUser['customfields'][1]['value'])}} --}}
{{-- Check if $moodleUser exists --}}

{{-- Display validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="page-title">
     
        <h2>Trainer Profile</h2>
    </div>
    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                @if (!empty($moodleUser['id']))
            <a class="nav-link active" href="{{ route('trainer.create', ['moodleUserId' =>  $moodleUser['id']]) }}">
                Personal Information
            </a>
            @else
        <span class="nav-link disabled">Personal Information</span>
        @endif
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
        <a class="nav-link " href="{{ route('trainers.documents.create', ['profile' => $profileId]) }}">
            Documents
        </a>
        @else
        <span class="nav-link disabled">Documents</span>
        @endif
                
            </li>
            <li class="nav-item">
               
    
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.specializations.create', ['profile' => $profileId, 'user' => $userId]) }}">
                    Specialization
                </a>
            @else
                <span class="nav-link disabled">Specialization</span>
            @endif
    
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.academics.create', ['profile' => $profileId]) }}">
                    Academics
                </a>
            @else
                <span class="nav-link disabled">Academics</span>
            @endif
    
    
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.work_experience.create', ['profile' => $profileId]) }}">
                    Work Experience
                </a>
            @else
                <span class="nav-link disabled">Work Experience</span>
            @endif
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.training_programs.create', ['profile' => $profileId]) }}">
                    Training Programs
                </a>
            @else
                <span class="nav-link disabled">Training Programs</span>
            @endif
               
              
            </li>
        </ul>
    </div>

    <div class="section-title">
        <h2>Personal Information</h2>
    </div>

    <div class="form-container profile-form">
        <form action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="user_id" value="{{ $moodleUser['id'] ?? '' }}">


        <input type="hidden" name="user_name" value="{{ $moodleUser['username'] ?? ''}}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prefix">Prefix:</label>
                    <x-select-field name="prefix" :options="['Mr', 'Mrs', 'Ms', 'Dr']" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prefix2">Prefix2:</label>
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
                    <label for="gender">Gender:</label>
                    
                    <div class="d-flex justify-content-start">
                    <div class="gender-select">
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Male</label>
                        
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label>
                    </div>
                    </div>
                </div>
                
            </div>
        </div>
      <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $moodleUser['firstname'] ?? '') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name', $moodleUser['middlename'] ?? '') }}" >
                </div>
            </div>
      </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="family_name">Family Name:</label>
                    <input type="text" name="family_name" value="{{ old('family_name', $moodleUser['lastname'] ?? '') }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @php
                    $dob = null;
                    if (!empty($moodleUser['customfields'] ?? [])) {
                        foreach ($moodleUser['customfields'] as $field) {
                            if ($field['shortname'] === 'dob') {
                                $dob = date('Y-m-d', $field['value']);
                                break;
                            }
                        }
                    }
                @endphp

       
        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" value="{{ old('dob', $dob ?? '') }}" required min="1900-01-01" max="2020-12-31">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Country:</label>
                   <x-select-field name="country" :options="config('countries.list')" :selected="$moodleUser['country'] ?? ''" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="residency_status">Residency Status:</label>
                    <x-select-field name="residency_status" :options="['UAE National', 'Golden Visa', 'Green Visa', 'Employment Visa', 'Family Visa', 'Student Visa', 'Visitor Visa']" />
                </div> 
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="residing_city">Residing City:</label>
                    <x-select-field name="residing_city" :options="['Abu Dhabi', 'Dubai', 'Sharjah', 'Fujairah', 'Umm Al Quwain', 'Ajman', 'Ras Al Khaima', 'Al Ain']" />
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ old('email', $moodleUser['email'] ?? '') }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Mobile Number: </label>
                    <input type="text" name="phone" value="{{ old('phone', $moodleUser['phone2'] ?? '') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group w-full d-flex flex-column ">
                    <div class="d-flex w-full justify-between align-items-center">
                        <label for="profileimage">Upload Your Photo:</label>
                
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
                    <label for="website">Website URL: </label>
                    <input type="text" name="website" value="{{ old('website', $moodleUser['website'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @php
                    $linkedin = null;
                    $instagram = null;
                    $facebook = null;
                    $twitter = null;
                    $youtube = null;
                
                    if (!empty($moodleUser['customfields'] ?? [])) {
                        foreach ($moodleUser['customfields'] as $field) {
                            switch ($field['shortname']) {
                                case 'linkedin':
                                    $linkedin = $field['value'];
                                    break;
                                case 'instagram':
                                    $instagram = $field['value'];
                                    break;
                                case 'facebook':
                                    $facebook = $field['value'];
                                    break;
                                case 'twitter':
                                    $twitter = $field['value'];
                                    break;
                                case 'youtube':
                                    $youtube = $field['value'];
                                    break;
                            }
                        }
                    }
                @endphp
                
                    <label for="linkedin">LinkedIn: </label>
                    <input type="text" name="linkedin" value="{{ old('linkedin', $linkedin ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="facebook">Facebook: </label>
                    <input type="text" name="facebook" value="{{ old('facebook', $facebook ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="instagram">Insagram: </label>
                    <input type="text" name="instagram" value="{{ old('instagram', $instagram ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="youtube">Youtube: </label>
                    <input type="text" name="youtube" value="{{ old('youtube', $youtube ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="twitter">X: </label>
                    <input type="text" name="twitter" value="{{ old('twitter', $twitter ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="other_socialmedia">Others: </label>
                    <input type="text" name="other_socialmedia" value="{{ old('other_socialmedia' ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group flex-column align-items-start">
                    <label class="w-100">Describe About You:</label>
                    <textarea class="w-100" name="about_you" placeholder="Describe about you. Minimum 100 words maximum 300 words ">{{ old('about_you', str_replace('<br />', "\n", strip_tags($moodleUser['description'] ?? ''))) }}</textarea>

                </div>
                <div class="form-btn">
                    <button type="submit" class="btn btn-primary ">SAVE AND PROCEED </button>
                </div>
        </div>
           
           


    </form>
    </div>
</div>
@endsection
