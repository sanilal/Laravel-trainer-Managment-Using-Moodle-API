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
                    <div class="filterparams">
                        <label for="name" class="form-label"> 
                            <x-icon name="search" />
                    <input type="text" placeholder="Search by Name" name="name" id="name" class="form-control" value="{{ request('name') }}">
                    </label>
                   
                    <label for="email" class="form-label">
                        <x-icon name="email" />
                        <input type="text" placeholder="Search by Email" name="email" id="email" class="form-control" value="{{ request('email') }}">
                    </label>
                
                    </div>
                    
                </div>
                <div class="mb-3">
                    <div class="filter-title"><h4>Filter By Category</h4></div>
                      <div class="filterparams">
                        <div class="mb-3 custom-radio-group">
                            <label class="custom-radio">
                                <input type="radio" name="specialization" value=""
                                    {{ request('specialization') == '' ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                All
                            </label>
                            @foreach ($specializations as $spec)
                                <label class="custom-radio">
                                    <input type="radio" name="specialization" value="{{ $spec->specialization }}"
                                        {{ request('specialization') == $spec->specialization ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    {{ $spec->specialization }}
                                </label>
                            @endforeach
                        </div>
                        

                        </div>
                    </div>
                <!-- More filters -->
                <div class="mb-3">
                      <div class="filter-title"><h4>Filter By Gender</h4></div>
    <div class="filterparams">
        <label class="custom-radio">
            <input type="radio" name="gender" value=""
                {{ request('gender') == '' ? 'checked' : '' }}>
            <span class="checkmark"></span>
            All
        </label>

        <label class="custom-radio">
            <input type="radio" name="gender" value="male"
                {{ request('gender') == 'male' ? 'checked' : '' }}>
            <span class="checkmark"></span>
            Male
        </label>

        <label class="custom-radio">
            <input type="radio" name="gender" value="female"
                {{ request('gender') == 'female' ? 'checked' : '' }}>
            <span class="checkmark"></span>
            Female
        </label>
    </div>
                    
                </div>
          

<!-- Academic Filter -->
 <div class="filter-title"><h4>Filter By Academics</h4></div>
    <div class="filterparams">
<div class="mb-3 custom-radio-group">
    <label class="custom-radio">
        <input type="radio" name="academic" value=""
            {{ request('academic') == '' ? 'checked' : '' }}>
        <span class="checkmark"></span>
        All
    </label>

    @foreach ($academics as $acad)
        <label class="custom-radio">
            <input type="radio" name="academic" value="{{ $acad->academics }}"
                {{ request('academic') == $acad->academics ? 'checked' : '' }}>
            <span class="checkmark"></span>
            {{ $acad->academics }}
        </label>
    @endforeach
</div>
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
