@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Work Experience</h2>

    <form id="workExperienceForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_id" value="{{ request('profile') }}">
        <input type="hidden" name="user_id" value="{{ request('user') }}">

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
            <input type="date" id="start_date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control" required>
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

    fetch("{{ route('trainers.work_experience.store') }}", {
        method: "POST",
        body: formData,
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value }
    }).then(response => response.json()).then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error saving work experience.');
        }
    }).catch(error => console.error('Error:', error));
};

// Save & Proceed to Next Form
document.getElementById("saveProceedBtn").onclick = function() {
    let formData = new FormData(document.getElementById("workExperienceForm"));

    fetch("{{ route('trainers.work_experience.store') }}", {
        method: "POST",
        body: formData,
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value }
    }).then(response => response.json()).then(data => {
        if (data.success) {
            window.location.href = "{{ route('trainers.documents.create', ['profile' => request('profile')]) }}";
        } else {
            alert('Error saving work experience.');
        }
    }).catch(error => console.error('Error:', error));
};

// Handle removing work experience
document.querySelectorAll(".remove-experience").forEach(button => {
    button.addEventListener("click", function() {
        let experienceId = this.getAttribute("data-id");
        fetch(`/trainers/work_experience/delete/${experienceId}`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert("Error deleting work experience.");
            }
        }).catch(error => console.error("Error:", error));
    });
});
</script>

@endsection
