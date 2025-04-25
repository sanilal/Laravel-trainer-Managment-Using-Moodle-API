@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">List of Registered Trainers</h2>
    <div class="row">
        <!-- Left Sidebar: Filters -->
        <div class="col-md-3">
            <form method="GET" action="{{ route('trainers.registered.trainers') }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Search by Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Search by Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ request('email') }}">
                </div>
                <!-- More filters -->
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">-- All --</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ request('country') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ request('city') }}">
                </div>
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </form>
        </div>

        <!-- Main Content: Trainer Cards -->
        <div class="col-md-9">
            <div class="row">
                @forelse ($trainers as $trainer)
                {{-- @php
                    
                    dd($trainer->first_name)
                @endphp --}}
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ $trainer->profile_image ?? asset('default-avatar.png') }}"
                                     class="rounded-circle me-3" alt="Profile" width="60" height="60">
                                <div>
                                    <h5>{{ $trainer->salutation }} {{ $trainer->first_name }} {{ $trainer->lastname }}</h5>
                                    <p class="mb-0 text-muted">
                                        <strong>Specialization:</strong>
                                        {{ $trainer->specializations->pluck('title')->join(', ') ?? 'N/A' }}
                                    </p>
                                    <a href="{{ route('trainer.show', $trainer->id) }}" class="btn btn-sm btn-outline-primary mt-2">View Profile</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No trainers found matching your filters.</p>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-end">
                {{ $trainers->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
