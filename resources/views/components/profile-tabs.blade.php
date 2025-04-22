@php
    $profileId = $profile->id ?? null;
    $userId = $profile->user_id ?? 24;
  
@endphp

{{-- Check if $userId exists --}}
@if(!$userId)
    <div class="alert alert-danger">Something went wrong. User ID not found.</div>
    @php
        return;
    @endphp
@endif


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
