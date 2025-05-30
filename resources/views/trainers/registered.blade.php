@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-title">
        <h2 class="">List of Registered Trainers</h2>
    </div>
    
    <div class="row mt-50">
        <!-- Left Sidebar: Filters -->
        <div class="col-md-3">
            <form method="GET" action="{{ route('trainers.registered.trainers') }}">
                <div class="mb-3">
                    <div class="filter-title"><h4>Filter Trainers List</h4></div>
                    <div class="searchboxfilter">
                        <label for="name" class="form-label"> 
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="16.5" cy="16.5" r="9" stroke="#A7A4A4"/>
<path d="M16.5 12C15.9091 12 15.3239 12.1164 14.7779 12.3425C14.232 12.5687 13.7359 12.9002 13.318 13.318C12.9002 13.7359 12.5687 14.232 12.3425 14.7779C12.1164 15.3239 12 15.9091 12 16.5" stroke="#A7A4A4" stroke-linecap="round"/>
<path d="M30 30L25.5 25.5" stroke="#A7A4A4" stroke-linecap="round"/>
</svg>

                        
                    <input type="text" placeholder="Search by Name" name="name" id="name" class="form-control" value="{{ request('name') }}">
                    </label>
                    <div class="mb-3">
                    <label for="email" class="form-label"><i class="fa-regular fa-envelope"></i>
                        <input type="text" placeholder="Search by Email" name="email" id="email" class="form-control" value="{{ request('email') }}">
                    </label>
                </div>
                    </div>
                    
                </div>
                
                      <div class="mb-3">
    <label class="form-label">Specialization</label>
    <select name="specialization" class="form-select">
        <option value="">-- All --</option>
        @foreach ($specializations as $spec)
            <option value="{{ $spec->specialization }}" {{ request('specialization') == $spec->specialization ? 'selected' : '' }}>
                {{ $spec->specialization }}
            </option>
        @endforeach
    </select>
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
          

<!-- Academic Filter -->
<div class="mb-3">
    <label class="form-label">Academic Degree</label>
    <select name="academic" class="form-select">
        <option value="">-- All --</option>
        @foreach ($academics as $acad)
            <option value="{{ $acad->academics }}" {{ request('academic') == $acad->academics ? 'selected' : '' }}>
                {{ $acad->academics }}
            </option>
        @endforeach
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
                            <div class="card-body d-flex align-items-center flex-column">
                              <img src="{{ $trainer->profile_image ? asset('storage/' . $trainer->profile_image) : asset('images/placeholder-profile.png') }}"
     class="rounded-circle me-3" alt="Profile" width="100" height="100">
                                <div>
                                    <h5 class="color-red">{{ $trainer->prefix }} {{ $trainer->first_name }} {{ $trainer->middle_name }} {{ $trainer->family_name }}</h5>
                                    <h6>{{ $trainer->prefix2 }}</h6>
                                    <p class="mb-0 text-muted">
                                        <strong>Specialization:</strong>
                                        
                                        {{ $trainer->specializations->pluck('specialization')->join(', ') ?? 'N/A' }}
                                    </p>
                                    <p class="mb-0 text-muted">
                                        {!! Str::limit(strip_tags(langContent($trainer->about_you)), 100, '...') !!}
                                     
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
