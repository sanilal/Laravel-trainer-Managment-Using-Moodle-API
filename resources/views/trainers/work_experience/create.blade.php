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
    <p>Profile ID: {{ $profileId }}</p>
    <p>User ID: {{ $userId }}</p>
    <h2>Add Work Experience</h2>

    <form id="workExperienceForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">

        <div class="mb-3">
            <label for="name_of_the_organization">Name of the Organization</label>
            <input type="text" name="name_of_the_organization" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="designation">Designation</label>
            <input type="text" name="designation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date">End Date (leave blank if ongoing)</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="upload_work_document">Upload Work Document</label>
            <input type="file" name="upload_work_document" class="form-control">
        </div>

        <div class="mb-3">
            <label for="job_description">Job Description</label>
            <textarea name="job_description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save & Add More</button>
        <button type="button" id="saveProceedBtn" class="btn btn-success">Save & Proceed</button>
    </form>

    <h3 class="mt-4">Added Work Experiences</h3>
    <ul id="workExperienceList">
        @foreach($workExperiences as $experience)
            <li>
                {{ $experience->designation }} at {{ $experience->name_of_the_organization }}
                <button class="btn btn-danger btn-sm remove-experience" data-id="{{ $experience->id }}">X</button>
            </li>
        @endforeach
    </ul>
</div>

<script>
document.getElementById("workExperienceForm").onsubmit = function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    if (!formData.get("name_of_the_organization") || 
        !formData.get("designation") || 
        !formData.get("start_date") || 
        !formData.get("job_description")) {
        alert("Please fill in all required fields.");
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
