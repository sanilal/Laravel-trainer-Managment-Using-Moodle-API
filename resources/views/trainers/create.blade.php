@extends('layouts.app')

@section('content')

{{-- Check if $moodleUser exists --}}
@if($moodleUser)
  <div>
    <h3>Moodle User Details</h3>
    <p>User Id: {{ $moodleUser['id'] ?? 'N/A' }}</p>
    <p>Email: {{ $moodleUser['email'] ?? 'N/A' }}</p>
    <p>First Name: {{ $moodleUser['firstname'] ?? 'N/A' }}</p>
    <p>Last Name: {{ $moodleUser['lastname'] ?? 'N/A' }}</p>
  </div>
@else
  <p>No Moodle user data found.</p>
@endif

@if(!$moodleUser)
    <div class="alert alert-danger">
        Moodle user data is missing or invalid.
    </div>
@endif

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
    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Personal Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Documents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Specialization</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Academics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Work Experience</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Training Programs</a>
            </li>
        </ul>
    </div> 

    <div class="section-title">
        <h2>Personal Information</h2>
    </div>

    <div class="form-container profile-form">
        <form action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="user_id" value="{{ $moodleUser['id'] }}">
        <input type="hidden" name="user_name" value="{{ $moodleUser['username'] }}">
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
                        <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                    
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
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
                    <input type="text" name="middle_name" value="{{ old('middle_name', $moodleUser['middlename'] ?? '') }}" required>
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
                    <label for="linkedin">LinkedIn: </label>
                    <input type="text" name="linkedin" value="{{ old('linkedin', $moodleUser['linkedin'] ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="facebook">Facebook: </label>
                    <input type="text" name="facebook" value="{{ old('facebook', $moodleUser['facebook'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="instagram">Insagram: </label>
                    <input type="text" name="instagram" value="{{ old('instagram', $moodleUser['instagram'] ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="youtube">Youtube: </label>
                    <input type="text" name="youtube" value="{{ old('youtube', $moodleUser['youtube'] ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="twitter">X: </label>
                    <input type="text" name="twitter" value="{{ old('twitter', $moodleUser['twitter'] ?? '') }}">
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
