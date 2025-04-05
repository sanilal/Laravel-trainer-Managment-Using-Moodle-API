@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add Training Programs</h4>

    <form id="trainingProgramForm">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profile->id }}">
        <input type="hidden" name="user_id" value="{{ $profile->user_id }}">

        <div class="form-group mb-2">
            <label>Name of Training Program</label>
            <input type="text" name="program_name" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Training Program Details</label>
            <textarea name="details" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save & Add More</button>
    </form>

    <hr>

    <h5>Added Training Programs</h5>
    <ul id="trainingProgramsList" class="list-group mt-2">
        <!-- Training programs will be dynamically inserted here -->
    </ul>
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
