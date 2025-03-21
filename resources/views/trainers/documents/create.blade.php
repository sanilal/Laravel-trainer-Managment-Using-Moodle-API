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
    <h2>Upload Your Documents</h2>
    <form action="{{ route('trainers.documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div class="mb-3">
            <label for="your_id" class="form-label">Your ID</label>
            <input type="file" name="your_id" class="form-control">
        </div>

        <div class="mb-3">
            <label for="your_passport" class="form-label">Your Passport</label>
            <input type="file" name="your_passport" class="form-control">
        </div>

        <div class="mb-3">
            <label for="other_document" class="form-label">Other Document</label>
            <input type="file" name="other_document" class="form-control">
        </div>

        <div class="mb-3">
            <label for="other_document2" class="form-label">Other Document 2</label>
            <input type="file" name="other_document2" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Upload Documents</button>
    </form>
</div>
@endsection
