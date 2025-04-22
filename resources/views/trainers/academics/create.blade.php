@extends('layouts.app')

@section('content')
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
    {{-- <p>Profile ID: {{ $profileId }}</p>
    <p>User ID: {{ $userId }}</p>
    <h2>Add Academic Details</h2> --}}
    <div class="page-title">
     
        <h2>Trainer Profile</h2>
    </div>

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
                <a class="nav-link active" href="{{ route('trainers.academics.create', ['profile' => $profileId]) }}">
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
        <h2>Academics</h2>
    </div>
    
    <div class="form-container academics-form">
        <form id="academicForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="profile_id" value="{{ $profileId }}">
            <input type="hidden" name="user_id" value="{{ $userId }}">
    
            <div class="row">
             <div class="col-md-12">
                <div class="single-field">
                    <div class="form-group">
                        <label for="academics">Academic Level</label>
                        <select name="academics" class="form-control" required>
                            <option value="">Select</option>
                            <option value="diploma">Diploma</option>
                            <option value="bachelor degree">Bachelor Degree</option>
                            <option value="masters degree">Master's Degree</option>
                            <option value="doctoral degree">Doctoral Degree</option>
            
                        </select>
                    </div>
                </div>
             </div>
            </div>
    
            <div class="row">
                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group">
                            <label for="name_of_the_university">Name of the University</label>
                <input type="text" name="name_of_the_university" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Start Date</label>
                        <div class="input-group date-picker-group">
                            <input type="date" name="start_date" class="form-control date-input">
                            <button class="btn btn-outline-secondary calendar-button" type="button">
                                <i class="fa fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">End Date</label>
                        <div class="input-group date-picker-group">
                            <input type="date" name="end_date" class="form-control date-input">
                            <button class="btn btn-outline-secondary calendar-button" type="button">
                                <i class="fa fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3 ">
                    <div class="mb-3 documents-row">
                        <label for="your_passport" class="custom-file-upload">
                        Upload Certificate
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M472 312c-22.1 0-40 17.9-40 40v72H80v-72c0-22.1-17.9-40-40-40s-40 17.9-40 40v112c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V352c0-22.1-17.9-40-40-40zM241 280V96h-56c-13.3 0-24-10.7-24-24s10.7-24 24-24h160c13.3 0 24 10.7 24 24s-10.7 24-24 24h-56v184l73-73c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-112 112c-9.4 9.4-24.6 9.4-33.9 0l-112-112c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l73 73z"/>
                        </svg>
                    </label>
                    <input type="file" name="upload_certificate" class="form-control">
                    </div>
                    
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Save & Add More</button>
                </div>
                <div class="col-md-3"></div>
            </div>
    
            <div class="row">
                <div class="col-md-12">
                    <div class="single-field">
                        <button type="button" id="saveProceedBtn" class="btn btn-success">Save & Proceed</button>
                    </div>
                </div>
            </div>
    
            
        
    </form>
    {{-- <h3 class="mt-4">Added Academics</h3> --}}
    <ul id="academicsList">
        @foreach($academics as $academic)
            <li>
                {{ $academic->academics }} - {{ $academic->name_of_the_university }}
                <button class="btn btn-danger btn-sm remove-academic" data-id="{{ $academic->id }}">X</button>
            </li>
        @endforeach
    </ul>
    </div>

    
</div>

<script>
document.getElementById("academicForm").onsubmit = function(event) {
    event.preventDefault();
    
    let formData = new FormData(this);

    // Debugging: Check FormData before sending
    console.log("Form Data before sending:");
    for (let pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }

    // Validate before sending
    if (!formData.get("academics") || 
        !formData.get("name_of_the_university") || 
        !formData.get("start_date") || 
        !formData.get("end_date")) {
        alert("Please fill in all required fields.");
        return;
    }

    fetch(`{{ route('trainers.academics.store') }}`, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value,
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(response => response.json().catch(() => response.text().then(text => { throw new Error(text); })))
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            console.error('Validation Errors:', data.errors);
            alert('Error saving academic record. Check console for details.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. See console for details.');
    });
};


// Handle "Save & Proceed"
document.getElementById("saveProceedBtn").onclick = function() {
    let existingAcademics = document.getElementById("academicsList").children.length;

    if (existingAcademics > 0) {
        // If at least one academic detail exists, proceed without re-submitting
        window.location.href = "{{ url('trainers/work_experience/create/' . $profileId) }}";
        return;
    }

    // If no academic details exist, validate and submit form data
    let formData = new FormData(document.getElementById("academicForm"));

    if (!formData.get("academics") || 
        !formData.get("name_of_the_university") || 
        !formData.get("start_date") || 
        !formData.get("end_date")) {
        alert("Please add at least one academic record before proceeding.");
        return;
    }

    fetch("{{ route('trainers.academics.store') }}", {
        method: "POST",
        body: formData,
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "{{ route('trainers.work_experience.create',  ['profile' => $profileId, 'user' => $userId]) }}";
        } else {
            alert("Validation failed. Check console for details.");
            console.error("Validation Errors:", data.errors);
        }
    })
    .catch(error => console.error("Fetch Error:", error));
};



</script>
@endsection
