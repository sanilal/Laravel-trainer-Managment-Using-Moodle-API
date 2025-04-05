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
    <h2>Add Academic Details</h2>
    
    <form id="academicForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">

        <div class="mb-3">
            <label for="academics">Academic Level</label>
            <select name="academics" class="form-control" required>
                <option value="">Select</option>
                <option value="diploma">Diploma</option>
                <option value="bachelor degree">Bachelor Degree</option>
                <option value="masters degree">Master's Degree</option>
                <option value="doctoral degree">Doctoral Degree</option>

            </select>
        </div>

        <div class="mb-3">
            <label for="name_of_the_university">Name of the University</label>
            <input type="text" name="name_of_the_university" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="upload_certificate">Upload Certificate</label>
            <input type="file" name="upload_certificate" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save & Add More</button>
    <button type="button" id="saveProceedBtn" class="btn btn-success">Save & Proceed</button>
</form>

    <h3 class="mt-4">Added Academics</h3>
    <ul id="academicsList">
        @foreach($academics as $academic)
            <li>
                {{ $academic->academics }} - {{ $academic->name_of_the_university }}
                <button class="btn btn-danger btn-sm remove-academic" data-id="{{ $academic->id }}">X</button>
            </li>
        @endforeach
    </ul>
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
