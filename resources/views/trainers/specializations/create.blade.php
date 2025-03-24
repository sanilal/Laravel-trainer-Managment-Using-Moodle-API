@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Specialization</h2>

    <!-- Training Specialization Form -->
    <h4>Training Specialization</h4>
    <form id="specialization-form">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">

        <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <select name="specialization" class="form-control">
                <option value="">Select Specialization</option>
                <option value="IT">IT</option>
                <option value="Management">Management</option>
                <option value="Finance">Finance</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Name of the Institution</label>
            <input type="text" name="name_of_the_institution" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Certificate</label>
            <input type="file" name="upload_certificate" class="form-control">
        </div>

        <button type="button" class="btn btn-primary" id="add-specialization">Save & Add More</button>
    </form>

    <!-- Added Specializations -->
    <div class="mt-4">
        <h5>Added Specializations</h5>
        <ul id="specialization-list">
            @foreach ($specializations as $specialization)
                <li id="specialization-{{ $specialization->id }}">
                    {{ $specialization->specialization }} - {{ $specialization->name_of_the_institution }}
                    <button class="btn btn-danger btn-sm remove-specialization" data-id="{{ $specialization->id }}">X</button>
                </li>
            @endforeach
        </ul>
    </div>

    <hr>

    <!-- Certification Section -->
    <h4>Certifications</h4>
    <form id="certification-form">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">

        <div class="mb-3">
            <label class="form-label">Certified In</label>
            <select name="certified_in" class="form-control">
                <option value="">Select Certification</option>
                <option value="PMP">PMP</option>
                <option value="AWS">AWS</option>
                <option value="CFA">CFA</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Name of the Institution</label>
            <input type="text" name="cert_name_of_the_institution" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="cert_start_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="cert_end_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Certificate</label>
            <input type="file" name="cert_upload_certificate" class="form-control">
        </div>

        <button type="button" class="btn btn-primary" id="add-certification">Save & Add More</button>
    </form>

    <!-- Added Certifications -->
    <div class="mt-4">
        <h5>Added Certifications</h5>
        <ul id="certification-list">
            @foreach ($certifications as $certification)
                <li id="certification-{{ $certification->id }}">
                    {{ $certification->certified_in }} - {{ $certification->cert_name_of_the_institution }}
                    <button class="btn btn-danger btn-sm remove-certification" data-id="{{ $certification->id }}">X</button>
                </li>
            @endforeach
        </ul>
    </div>

    <hr>

    <form action="{{ route('trainers.complete') }}" method="POST">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <button type="submit" class="btn btn-success">Save and Proceed</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // AJAX for Adding Specialization
        document.getElementById('add-specialization').addEventListener('click', function () {
            let formData = new FormData(document.getElementById('specialization-form'));

            fetch("{{ route('specializations.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let listItem = `<li id="specialization-${data.specialization.id}">
                        ${data.specialization.specialization} - ${data.specialization.name_of_the_institution}
                        <button class="btn btn-danger btn-sm remove-specialization" data-id="${data.specialization.id}">X</button>
                    </li>`;
                    document.getElementById('specialization-list').innerHTML += listItem;
                }
            });
        });

        // AJAX for Adding Certification
        document.getElementById('add-certification').addEventListener('click', function () {
            let formData = new FormData(document.getElementById('certification-form'));

            fetch("{{ route('certifications.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let listItem = `<li id="certification-${data.certification.id}">
                        ${data.certification.certified_in} - ${data.certification.cert_name_of_the_institution}
                        <button class="btn btn-danger btn-sm remove-certification" data-id="${data.certification.id}">X</button>
                    </li>`;
                    document.getElementById('certification-list').innerHTML += listItem;
                }
            });
        });

        // AJAX for Removing Specialization
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-specialization')) {
                let id = event.target.getAttribute('data-id');

                fetch(`/specializations/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                    .then(response => response.json())
                    .then(() => document.getElementById(`specialization-${id}`).remove());
            }
        });

        // AJAX for Removing Certification
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-certification')) {
                let id = event.target.getAttribute('data-id');

                fetch(`/certifications/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                    .then(response => response.json())
                    .then(() => document.getElementById(`certification-${id}`).remove());
            }
        });
    });
</script>
@endsection
