@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@section('content')
<style>
    
    /* Laravel Pagination CSS Fix */

/* Main pagination container */
nav[role="navigation"] {
    margin: 20px 0;
    clear: both;
}

/* Pagination wrapper */
.flex.items-center.justify-between {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 16px;
}

/* Mobile pagination (sm:hidden) */
.flex.justify-between.flex-1.sm\:hidden {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    width: 100% !important;
    gap: 12px;
}

/* Desktop pagination container */
.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
    display: none !important;
}

@media (min-width: 640px) {
    .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
        display: flex !important;
        flex: 1 !important;
        align-items: center !important;
        justify-content: space-between !important;
    }
    
    .flex.justify-between.flex-1.sm\:hidden {
        display: none !important;
    }
}

/* Pagination buttons styling */
.relative.inline-flex.items-center {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 40px;
    min-height: 40px;
    padding: 8px 12px;
    margin: 0 1px;
    text-decoration: none;
    border: 1px solid #d1d5db;
    background-color: white;
    color: #374151;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.25;
    border-radius: 6px;
    transition: all 0.15s ease-in-out;
    cursor: pointer;
    white-space: nowrap;
}

/* Dark mode support */
.dark .relative.inline-flex.items-center {
    background-color: #1f2937;
    border-color: #4b5563;
    color: #d1d5db;
}

/* Hover states */
.relative.inline-flex.items-center:hover:not([aria-disabled="true"]):not([aria-current="page"] span) {
    background-color: #f9fafb;
    color: #6b7280;
    border-color: #9ca3af;
}

.dark .relative.inline-flex.items-center:hover:not([aria-disabled="true"]):not([aria-current="page"] span) {
    background-color: #374151;
    color: #e5e7eb;
}

/* Active/Current page */
span[aria-current="page"] span {
    background-color: #c23a2b !important;
    color: white !important;
    border-color: #c23a2b !important;
    cursor: default;
}

/* Disabled state */
span[aria-disabled="true"] span {
    background-color: #f9fafb !important;
    color: #9ca3af !important;
    border-color: #e5e7eb !important;
    cursor: not-allowed !important;
}

.dark span[aria-disabled="true"] span {
    background-color: #374151 !important;
    color: #6b7280 !important;
    border-color: #4b5563 !important;
}

/* SVG icons in arrows */
.relative.inline-flex.items-center svg {
    width: 20px !important;
    height: 20px !important;
    flex-shrink: 0;
}

/* Pagination numbers container */
.relative.z-0.inline-flex.shadow-sm.rounded-md {
    display: inline-flex !important;
    align-items: center !important;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

/* Remove individual border radius for connected buttons */
.relative.z-0.inline-flex.shadow-sm.rounded-md .relative.inline-flex.items-center {
    border-radius: 0 !important;
    margin: 0 !important;
    border-right-width: 0;
}

/* First button (previous arrow) */
.relative.z-0.inline-flex.shadow-sm.rounded-md .relative.inline-flex.items-center:first-child {
    border-top-left-radius: 8px !important;
    border-bottom-left-radius: 8px !important;
}

/* Last button (next arrow) */
.relative.z-0.inline-flex.shadow-sm.rounded-md .relative.inline-flex.items-center:last-child {
    border-top-right-radius: 8px !important;
    border-bottom-right-radius: 8px !important;
    border-right-width: 1px;
}

/* Results text styling */
.text-sm.text-gray-700.leading-5 {
    font-size: 14px;
    color: #374151;
    line-height: 1.25;
    margin: 0;
}

.dark .text-sm.text-gray-700.leading-5 {
    color: #9ca3af;
}

/* Font weight for numbers */
.font-medium {
    font-weight: 600 !important;
}

/* Focus states */
.relative.inline-flex.items-center:focus {
    outline: none !important;
    ring: 2px solid #c23a2b !important;
    ring-offset: 2px;
    z-index: 10;
}

/* Responsive adjustments */
@media (max-width: 639px) {
    .relative.inline-flex.items-center {
        min-width: 36px;
        min-height: 36px;
        padding: 6px 10px;
        font-size: 13px;
    }
    
    .relative.inline-flex.items-center svg {
        width: 16px !important;
        height: 16px !important;
    }
}

/* Fix for RTL support */
.rtl\:flex-row-reverse {
    flex-direction: row-reverse;
}

/* Ensure proper spacing */
.relative.z-0.inline-flex.shadow-sm.rounded-md {
    gap: 0 !important;
}

/* Additional margin fixes */
.-ml-px {
    margin-left: -1px !important;
}

/* Active state improvements */
.active\:bg-gray-100:active {
    background-color: #f3f4f6 !important;
}

.dark .active\:bg-gray-100:active {
    background-color: #374151 !important;
}
</style>
<div class="container">
    <div class="section-title">
        <h2 class="">{{__('messages.list_of_trainers')}}</h2>
    </div>
    
    <div class="row mt-50">
        <!-- Left Sidebar: Filters -->
        <div class="col-md-3">
            <form method="GET" action="{{ route('trainers.registered.trainers') }}">
                <div class="mb-3">
                    <div class="filter-title"><h4>{{__('messages.filter_trainers')}}</h4></div>
                    <div class="filterparams">
                        <label for="name" class="form-label"> 
                            <x-icon name="search" />
                    <input type="text" placeholder="{{__('messages.search_name')}}" name="name" id="name" class="form-control" value="{{ request('name') }}">
                    </label>
                   
                    <label for="email" class="form-label">
                        <x-icon name="email" />
                        <input type="text" placeholder="{{__('messages.search_email')}}" name="email" id="email" class="form-control" value="{{ request('email') }}">
                    </label>
                
                    </div>
                    
                </div>
                <div class="mb-3">
                    <div class="filter-title"><h4>{{__('messages.filter_by_category')}}</h4></div>
                      <div class="filterparams">
                        <div class="mb-3 custom-radio-group">
                            <label class="custom-radio">
                                <input type="radio" name="specialization" value=""
                                    {{ request('specialization') == '' ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                {{__('messages.all')}}
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
                      <div class="filter-title"><h4>{{__('messages.filter_by_gender')}}</h4></div>
    <div class="filterparams">
        <label class="custom-radio">
            <input type="radio" name="gender" value=""
                {{ request('gender') == '' ? 'checked' : '' }}>
            <span class="checkmark"></span>
             {{__('messages.all')}}
        </label>

        <label class="custom-radio">
            <input type="radio" name="gender" value="male"
                {{ request('gender') == 'male' ? 'checked' : '' }}>
            <span class="checkmark"></span>
             {{__('messages.male')}}
        </label>

        <label class="custom-radio">
            <input type="radio" name="gender" value="female"
                {{ request('gender') == 'female' ? 'checked' : '' }}>
            <span class="checkmark"></span>
             {{__('messages.female')}}
        </label>
    </div>
                    
                </div>
          

<!-- Academic Filter -->
 <div class="filter-title"><h4> {{__('messages.filter_by_academics')}}</h4></div>
    <div class="filterparams">
<div class="mb-3 custom-radio-group">
    <label class="custom-radio">
        <input type="radio" name="academic" value=""
            {{ request('academic') == '' ? 'checked' : '' }}>
        <span class="checkmark"></span>
        {{__('messages.all')}}
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

 {{-- <div class="filter-title"><h4>Filter By Country</h4></div>
    <div class="filterparams">
                <div class="mb-3">
               
               <select name="country[]" multiple class="select2">
    @foreach ($countries as $code => $name)
        <option value="{{ $code }}" {{ in_array($code, (array) request('country', [])) ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach
</select>

            </div></div> --}}


                {{-- <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ request('city') }}">
                </div> --}}
                <button type="submit" class="btn btn-primary w-100">{{__('messages.filter')}}</button>
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
                                    <h6>{{ __('messages.' . $trainer->prefix2) }}</h6>
                                    <p class="mb-1 text-muted">
                                        <strong>{{__('messages.specialization')}}:</strong>
                                        
                                        {{ $trainer->specializations->pluck('specialization')->join(', ') ?? 'N/A' }}
                                    </p>
                                    <p class="mb-0 text-muted">
                                        {!! Str::limit(strip_tags(langContent($trainer->about_you)), 100, '...') !!}
                                     
                                    </p>
                                    <a href="{{ route('trainer.show', $trainer->id) }}" class="btn btn-sm btn-primary mt-2">{{__('messages.view_profile')}}</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">{{__('messages.no_trainers_found')}}.</p>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "All",
            allowClear: true
        });
    });
</script>
