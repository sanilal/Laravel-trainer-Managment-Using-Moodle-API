@extends('layouts.app')

@section('title', 'Trainer Registration')

@section('content')
<div class="container">
    <h2>Trainer Registration</h2>
    
    <!-- Fetch trainer data from Moodle -->
    <form id="fetch-trainer-form">
        <div class="mb-3">
            <label>Email (Fetch from Moodle):</label>
            <input type="email" id="email" name="email" class="form-control" required>
            <button type="button" id="fetch-trainer" class="btn btn-primary mt-2">Fetch from Moodle</button>
        </div>
    </form>

    <!-- Registration Form -->
    <form action="{{ route('trainer.store') }}" method="POST">
        @csrf
        <input type="hidden" id="moodle_user_id" name="moodle_user_id">

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Specialization:</label>
            <input type="text" id="specialization" name="specialization" class="form-control">
        </div>

        <div class="mb-3">
            <label>Date of Birth:</label>
            <input type="date" id="dob" name="dob" class="form-control">
        </div>

        <div class="mb-3">
            <label>Summary:</label>
            <textarea id="summary" name="summary" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Register Trainer</button>
    </form>
</div>

<script>
document.getElementById('fetch-trainer').addEventListener('click', function() {
    let email = document.getElementById('email').value;
    if (!email) {
        alert('Please enter an email.');
        return;
    }

    fetch("{{ route('trainer.fetch') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            document.getElementById('moodle_user_id').value = data.id;
            document.getElementById('name').value = data.fullname;
            document.getElementById('email').value = data.email;
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection
