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
    <div class="page-title">
        <h2>Edit Academic Record</h2>
    </div>

    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trainer.create', ['moodleUserId' => $userId]) }}">Personal Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trainers.documents.create', ['profile' => $profileId]) }}">Documents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trainers.specializations.create', ['profile' => $profileId, 'user' => $userId]) }}">Specialization</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Academics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trainers.work_experience.create', ['profile' => $profileId]) }}">Work Experience</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trainers.training_programs.create', ['profile' => $profileId]) }}">Training Programs</a>
            </li>
        </ul>
    </div>

    <div class="section-title">
        <h2>Edit Academic Record</h2>
    </div>

    <div class="form-container academics-form">
        <form id="academicEditForm" method="POST" action="{{ route('trainers.academics.update', $academic->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="profile_id" value="{{ $profileId }}">
            <input type="hidden" name="user_id" value="{{ $userId }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group">
                            <label for="academics">Academic Level</label>
                            <select name="academics" class="form-control" required>
                                <option value="">Select</option>
                                <option value="diploma" {{ $academic->academics == 'diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="bachelor" {{ $academic->academics == 'bachelor' ? 'selected' : '' }}>Bachelor Degree</option>
                                <option value="masters" {{ $academic->academics == 'masters' ? 'selected' : '' }}>Master's Degree</option>
                                <option value="doctoral" {{ $academic->academics == 'doctoral' ? 'selected' : '' }}>Doctoral Degree</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group">
                            <label for="stream">Stream</label>
                            <input type="text" name="stream" class="form-control" value="{{ old('stream', $academic->stream) }}" placeholder="e.g. Computer Science, Mechanical, etc.">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="single-field">
                        <div class="form-group">
                            <label for="name_of_the_university">Name of the University</label>
                            <input type="text" name="name_of_the_university" class="form-control" value="{{ old('name_of_the_university', $academic->name_of_the_university) }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Start Date</label>
                        <div class="input-group date-picker-group">
                            <input type="date" name="start_date" class="form-control date-input" value="{{ old('start_date', $academic->start_date) }}">
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
                            <input type="date" name="end_date" class="form-control date-input" value="{{ old('end_date', $academic->end_date) }}">
                            <button class="btn btn-outline-secondary calendar-button" type="button">
                                <i class="fa fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>

                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="mb-3 documents-row">
                        <label for="upload_certificate" class="custom-file-upload">
                            Upload Certificate
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="..."/>
                            </svg>
                        </label>
                        <input type="file" name="upload_certificate" class="form-control">
                        @if($academic->upload_certificate)
                            <small>Current: 
                                <a href="{{ asset('uploads/academics/' . $academic->upload_certificate) }}" target="_blank">
                                    View Certificate
                                </a>
                            </small>
                        @endif
                    </div>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-success mt-4">Update</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('trainers.academics.create', ['profile' => $profileId]) }}" class="btn btn-secondary mt-4">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
