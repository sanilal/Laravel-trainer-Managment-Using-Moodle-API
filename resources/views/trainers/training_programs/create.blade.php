@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-title">
     
        <h2>{{__('messages.trainer_profile')}}</h2>
    </div>

    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                @if (!empty($userId))
            <a class="nav-link " href="{{ route('trainer.create', ['moodleUserId' => $userId]) }}">
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
                <a class="nav-link " href="{{ route('trainers.work_experience.create', ['profile' => $profileId]) }}">
                    {{__('messages.work_experience')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.work_experience')}}</span>
            @endif
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link active" href="{{ route('trainers.training_programs.create', ['profile' => $profileId]) }}">
                    Training Programs
                </a>
            @else
                <span class="nav-link disabled">Training Programs</span>
            @endif
               
              
            </li>
        </ul>
    </div>

    <div class="section-title">
        <h2>Training Programs</h2>
    </div>

    <div class="form-container academics-form">

        <form id="trainingProgramForm">
            @csrf
            
            <input type="hidden" name="profile_id" value="{{ $profileId }}">
            <input type="hidden" name="user_id" value="{{ $userId }}">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group ">
                            <label>Name of Training Program</label>
                            <input type="text" name="program_name" class="form-control" required>
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
                <div class="col-md-12">
                    <div class="form-group ">
                        <label>Training Program Details</label>
                        <textarea name="details" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
    
            <button type="submit" class="btn btn-primary">Save & Add More</button>
        </form>
    
    
        <a href="{{ route('trainer.show', $profileId) }}" class="btn btn-sm btn-outline-primary mt-2">Save & View</a>

        {{-- <h5>Added Training Programs</h5> --}}
        <ul id="trainingProgramsList" class="list-group mt-2">
            <!-- Training programs will be dynamically inserted here -->
        </ul>

    </div>

    
</div>

<script>
    document.getElementById('trainingProgramForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const start = new Date(e.target.start_date.value);
    const end = new Date(e.target.end_date.value);

    // If end_date is filled and before start_date, show alert and prevent submit
    if (e.target.end_date.value && end < start) {
        alert("End date must be after or equal to start date.");
        return;
    }

        let form = e.target;
        let formData = new FormData(form);

        const trainingProgramStoreURL = "{{ route('trainers.training_programs.store') }}";


        fetch(trainingProgramStoreURL, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
         'Accept': 'application/json'
    },
    body: formData
})
.then(async res => {
     const text = await res.text();
   try {
        const data = JSON.parse(text);

        if (data.success) {
            // Append new training program
            let program = data.program;
            let li = document.createElement('li');
            li.className = "list-group-item d-flex justify-content-between align-items-center";
            li.innerHTML = `
                <span>
                    <strong>${program.program_name}</strong> (${program.start_date} to ${program.end_date || 'Ongoing'})<br>
                    ${program.details || ''}
                </span>
                <button class="btn btn-danger btn-sm" onclick="deleteProgram(${program.id}, this)">×</button>
            `;
            document.getElementById('trainingProgramsList').appendChild(li);
            form.reset();
        } else {
            console.error("Validation errors:", data.errors);
            alert("Please fix validation errors.");
        }
    } catch (err) {
        console.error("Server returned HTML or unexpected output:", text);
    }
    return res.json();
})
.then(data => {
    if (data.success) {
        let program = data.program;
        let li = document.createElement('li');
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        li.innerHTML = `
            <span>
                <strong>${program.program_name}</strong> (${program.start_date} to ${program.end_date || 'Ongoing'})<br>
                ${program.details || ''}
            </span>
            <button class="btn btn-danger btn-sm" onclick="deleteProgram(${program.id}, this)">×</button>
        `;
        document.getElementById('trainingProgramsList').appendChild(li);
        form.reset();
    }
})
.catch(error => {
    console.error('Error parsing JSON or network issue:', error);
});

    });

    function deleteProgram(id, btn) {
        if (!confirm('Are you sure you want to delete this training program?')) return;

        fetch(`/trainers/training_programs/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(res => res.json())
        .then(data => {
    if (data.success) {
        let program = data.program;
        let li = document.createElement('li');
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        li.innerHTML = `
            <span>
                <strong>${program.program_name}</strong> (${program.start_date} to ${program.end_date || 'Ongoing'})<br>
                ${program.details || ''}
            </span>
            <button class="btn btn-danger btn-sm" onclick="deleteProgram(${program.id}, this)">×</button>
        `;
        document.getElementById('trainingProgramsList').appendChild(li);
        form.reset();
    } else {
        console.error("Validation errors:", data.errors);
        alert("Please fix validation errors.");
    }
})
.catch(error => {
    console.error('Error parsing JSON or network issue:', error);
});
    }
</script>
@endsection
