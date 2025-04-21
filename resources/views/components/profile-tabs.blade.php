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

            <a class="nav-link {{ request()->routeIs('trainer.create') ? 'active' : '' }}" 
                href="{{ route('trainer.create', ['moodleUserId' => $userId]) }}">
                 Personal Information
             </a>
             
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('trainers.documents.create') ? 'active' : '' }}" 
               href="{{ route('trainers.documents.create', $profileId) }}">
                Documents
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('trainers.specializations.create') ? 'active' : '' }}" 
               href="{{ route('trainers.specializations.create', [$profileId, $userId]) }}">
                Specialization
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('trainers.academics.create') ? 'active' : '' }}" 
               href="{{ route('trainers.academics.create', $profileId) }}">
                Academics
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('trainers.work_experience.create') ? 'active' : '' }}" 
               href="{{ route('trainers.work_experience.create', $profileId) }}">
                Work Experience
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('trainers.training_programs.create') ? 'active' : '' }}" 
               href="{{ route('trainers.training_programs.create', $profileId) }}">
                Training Programs
            </a>
        </li>
    </ul>
</div>
