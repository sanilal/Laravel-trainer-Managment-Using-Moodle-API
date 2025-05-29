@extends('layouts.app')


@section('content')

@if(!$moodleUser)

    <div class="alert alert-danger">Something went wrong. Moodle user not found.</div>
    @php
        return;
    @endphp
@endif
{{-- 
@php
    if (!empty($moodleUser['customfields'] ?? [])) {
        foreach ($moodleUser['customfields'] as $field) {
            $shortname = $field['shortname'] ?? '';
            $value = $field['value'] ?? null;

            switch ($shortname) {
                case 'idcard':
                        $idcard = $value;
                    break;
                case 'passport':
                    $passport = $value;
                    break;
            }
        }
    }
@endphp --}}

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
    {{-- {{ dd($profileId) }}
    <h2>Upload Your Documents</h2>
    <p>Profile ID: {{ $profileId }}</p>
<p>User ID: {{ $userId }}</p> --}}
<div class="form-tabs">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            @if (!empty($userId))
        <a class="nav-link " href="{{ route('trainer.create', ['moodleUserId' => $userId]) }}">
            Personal Information
        </a>
        @else
    <span class="nav-link disabled">Personal Information</span>
    @endif
        </li>
        <li class="nav-item">

            @if (!empty($profileId))
    <a class="nav-link active" href="{{ route('trainers.documents.create', ['profile' => $profileId]) }}">
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
    <h2>Documents</h2>
</div>
<div class="form-container profile-form">
    <form action="{{ route('trainers.documents.update', ['profile' => $profileId]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        
        <!-- Debugging to check if Moodle data is received -->
      

        <div class="documents-collection">
            <div class="mb-3 documents-row">
                <span>Your ID Document:</span>
                <label for="your_id" class="custom-file-upload">
                    Upload Document
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M472 312c-22.1 0-40 17.9-40 40v72H80v-72c0-22.1-17.9-40-40-40s-40 17.9-40 40v112c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V352c0-22.1-17.9-40-40-40zM241 280V96h-56c-13.3 0-24-10.7-24-24s10.7-24 24-24h160c13.3 0 24 10.7 24 24s-10.7 24-24 24h-56v184l73-73c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-112 112c-9.4 9.4-24.6 9.4-33.9 0l-112-112c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l73 73z"/>
                    </svg>
                </label>
                    @if (!empty($document->your_id))
    <div class="existing-document">
        <a href="{{ asset('storage/' . $document->your_id) }}" target="_blank">
                Current File
            </a>
       
    </div>
@endif
<input type="file" name="your_id" id="your_id" class="form-control">
            </div>
        
    
            <div class="mb-3 documents-row">
                <span>Your Passport:</span>
                <label for="your_passport" class="custom-file-upload">
                    Upload Document
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M472 312c-22.1 0-40 17.9-40 40v72H80v-72c0-22.1-17.9-40-40-40s-40 17.9-40 40v112c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V352c0-22.1-17.9-40-40-40zM241 280V96h-56c-13.3 0-24-10.7-24-24s10.7-24 24-24h160c13.3 0 24 10.7 24 24s-10.7 24-24 24h-56v184l73-73c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-112 112c-9.4 9.4-24.6 9.4-33.9 0l-112-112c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l73 73z"/>
                    </svg>
                </label>

                @if (!empty($document->your_passport))
    <div class="existing-document">
            <a href="{{ asset('storage/' . $document->your_passport) }}" target="_blank">
                Current File
            </a>
    </div>
@endif
                <input type="file" name="your_passport" id="your_passport" class="form-control">
                
            </div>
    
            <div class="mb-3 documents-row">
                <span>Other Document:</span>
                <label for="other_document" class="custom-file-upload">
                    Upload Document
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M472 312c-22.1 0-40 17.9-40 40v72H80v-72c0-22.1-17.9-40-40-40s-40 17.9-40 40v112c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V352c0-22.1-17.9-40-40-40zM241 280V96h-56c-13.3 0-24-10.7-24-24s10.7-24 24-24h160c13.3 0 24 10.7 24 24s-10.7 24-24 24h-56v184l73-73c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-112 112c-9.4 9.4-24.6 9.4-33.9 0l-112-112c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l73 73z"/>
                    </svg>
                </label>
                  @if (!empty($document->other_document))
    <div class="existing-document">
            <a href="{{ asset('storage/' . $document->other_document) }}" target="_blank">Current File</a>
    </div>
@endif
                <input type="file" name="other_document" id="other_document" class="form-control">
               
            </div>
    
            <div class="mb-3 documents-row">
                <span>Other Document:</span>
                <label for="other_document2" class="custom-file-upload">
                    Upload Document
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M472 312c-22.1 0-40 17.9-40 40v72H80v-72c0-22.1-17.9-40-40-40s-40 17.9-40 40v112c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V352c0-22.1-17.9-40-40-40zM241 280V96h-56c-13.3 0-24-10.7-24-24s10.7-24 24-24h160c13.3 0 24 10.7 24 24s-10.7 24-24 24h-56v184l73-73c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-112 112c-9.4 9.4-24.6 9.4-33.9 0l-112-112c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l73 73z"/>
                    </svg>
                </label>
                
                 @if (!empty($document->other_document2))
    <div class="existing-document">
            <a href="{{ asset('storage/' . $document->other_document2) }}" target="_blank">
                Current File
            </a>
    </div>
@endif
                <input type="file" name="other_document2" id="other_document2" class="form-control">
                
            </div>
            <button type="submit" class="btn btn-primary">SAVE AND PROCEED</button>
        </div>

    </form>
    <ul id="selected-file-list">
        <li id="your_id_filename" class="file-name mt-1 text-sm text-muted"></li>
        <li id="your_passport_filename" class="file-name mt-1 text-sm text-muted"></li>
        <li id="other_document_filename" class="file-name mt-1 text-sm text-muted"></li>
        <li id="other_document2_filename" class="file-name mt-1 text-sm text-muted"></li>
    </ul>
</div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fileInputs = document.querySelectorAll('input[type="file"]');

        fileInputs.forEach(input => {
            input.addEventListener('change', function () {
                const fileNameContainer = document.getElementById(`${this.id}_filename`);
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    fileNameContainer.innerHTML = `<a href="#" onclick="return false;">${file.name}</a>`;
                } else {
                    fileNameContainer.innerHTML = "";
                }
            });
        });
    });
</script>
