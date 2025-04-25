@extends('layouts.app')

@section('content')
<div class="container">
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
                <a class="nav-link" href="{{ route('trainers.academics.create', ['profile' => $profileId]) }}">
                    Academics
                </a>
            @else
                <span class="nav-link disabled">Academics</span>
            @endif
    
    
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link " href="{{ route('trainers.work_experience.create', ['profile' => $profileId]) }}">
                    Work Experience
                </a>
            @else
                <span class="nav-link disabled">Work Experience</span>
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
    
    
        <a href="{{ route('trainer.show', $trainer->id) }}" class="btn btn-sm btn-outline-primary mt-2">Save & View</a>

        {{-- <h5>Added Training Programs</h5> --}}
        <ul id="trainingProgramsList" class="list-group mt-2">
            <!-- Training programs will be dynamically inserted here -->
        </ul>

    </div>

    
</div>

<script>
    document.getElementById('trainingProgramForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let form = e.target;
        let formData = new FormData(form);

        fetch("{{ route('trainers.training_programs.store') }}", {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: formData
})
.then(async res => {
    if (!res.ok) {
        const text = await res.text(); // Try to get raw HTML
        console.error("Server returned error:", text);
        throw new Error('Server error');
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
                btn.closest('li').remove();
            }
        });
    }
</script>
@endsection
