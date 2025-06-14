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
    <h2>Add Work Experience</h2> --}}
    <div class="page-title">
     
        <h2>{{__('messages.trainer_profile')}}</h2>
    </div>

    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                @if (!empty($userId))
             <a class="nav-link " href="{{ route('trainer.edit', ['id' => $profileId]) }}">
                {{__('messages.personal_information')}}
            </a>
            @else
        <span class="nav-link disabled">{{__('messages.personal_information')}}</span>
        @endif
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
        <a class="nav-link " href="{{ route('trainers.documents.create', ['profile' => $profileId]) }}">
            {{__('messages.documents')}}
        </a>
        @else
        <span class="nav-link disabled">{{__('messages.documents')}}</span>
        @endif
                
            </li>
            <li class="nav-item">
               
    
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.specializations.create', ['profile' => $profileId, 'user' => $userId]) }}">
                    {{__('messages.specialization')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.specialization')}}</span>
            @endif
    
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.academics.create', ['profile' => $profileId]) }}">
                    {{__('messages.academics')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.academics')}}</span>
            @endif
    
    
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link active" href="{{ route('trainers.work_experience.create', ['profile' => $profileId]) }}">
                    {{__('messages.work_experience')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.work_experience')}}</span>
            @endif
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.training_programs.create', ['profile' => $profileId]) }}">
                    {{__('messages.training_programs')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.training_programs')}}</span>
            @endif
               
              
            </li>
        </ul>
    </div>

    <div class="section-title">
        <h2>{{__('messages.work_experience')}}</h2>
    </div>
    <div class="form-container academics-form">
        <form id="workExperienceForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="profile_id" value="{{ $profileId }}">
            <input type="hidden" name="user_id" value="{{ $userId }}">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group">
                            <label for="name_of_the_organization">{{__('messages.name_of_the_organization')}}</label>
                <input type="text" name="name_of_the_organization" class="form-control" required>
                        </div>
                    </div>
                </div>
                
            </div>
    
            <div class="row">
                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group">
                            <label for="designation">{{__('messages.designation')}}</label>
                            <input type="text" name="designation" class="form-control" required>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">{{__('messages.start_date')}}</label>
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
                        <label class="form-label">{{__('messages.end_date')}}</label>
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
                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group flex-column">
                            <label for="job_description">{{__('messages.describe_about_work')}} </label>
                            <textarea name="job_description" class="form-control" rows="5" required></textarea>
                    </div>
                    </div>
                    
                </div>
            </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="upload_work_document">{{__('messages.upload_work_document')}}</label>
                <input type="file" name="upload_work_document" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            
            <button type="submit" class="btn btn-primary">{{__('messages.save_add_more')}}</button>
        </div>
        <div class="col-md-3"></div>
      
    </div>
           
    
           
    
           
    
          
    
            
            
        </form>
    
        {{-- <h3 class="mt-4">Added Work Experiences</h3> --}}
        <ul id="workExperienceList">
            @foreach($workExperiences as $experience)
                <li>
                    {{ $experience->designation }} at {{ $experience->name_of_the_organization }}
                    <button class="btn btn-danger btn-sm remove-experience" data-id="{{ $experience->id }}">X</button>
                </li>
            @endforeach
        </ul>
</div>
<div class="row mt-5">
    <div class="col-md-12"><div class="single-field text-center">
        <button type="button" id="saveProceedBtn" class="btn btn-success">Save & Proceed</button>
    </div>
    </div>
   </div>
</div>

<script>
document.getElementById("workExperienceForm").onsubmit = function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    if (!formData.get("name_of_the_organization") || 
        !formData.get("designation") || 
        !formData.get("start_date") || 
        !formData.get("job_description")) {
        alert("{{__('messages.please_fill_required_fields')}}");
        return;
    }

    fetch(`{{ route('trainers.work_experience.store') }}`, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value,
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(response => response.json().catch(() => response.text().then(text => { 
    console.error('Raw response:', text); // Log raw response
    throw new Error('Invalid JSON: ' + text); 
})))
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error saving work experience. Check console.');
            console.error('Validation Errors:', data.errors);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. See console for details.');
    });
};

// Handle Save & Proceed
document.getElementById("saveProceedBtn").onclick = function() {
    let existing = document.getElementById("workExperienceList").children.length;

    if (existing > 0) {
        window.location.href = "{{ url('trainers/training_programs/create/' . $profileId) }}";
        return;
    }

    let formData = new FormData(document.getElementById("workExperienceForm"));

    if (!formData.get("name_of_the_organization") || 
        !formData.get("designation") || 
        !formData.get("start_date") || 
        !formData.get("job_description")) {
        alert("Please add at least one work experience before proceeding.");
        return;
    }

    fetch("{{ route('trainers.work_experience.store') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "{{ url('trainers/training_programs/create/' . $profileId) }}";
        } else {
            alert("Validation failed. Check console.");
            console.error("Validation Errors:", data.errors);
        }
    })
    .catch(error => console.error("Fetch Error:", error));
};

// Delete Experience (Optional Enhancement)
document.querySelectorAll('.remove-experience').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        if (confirm("Are you sure you want to delete this experience?")) {
            fetch(`/trainers/work_experience/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Failed to delete.");
                }
            });
        }
    });
});
</script>
@endsection
