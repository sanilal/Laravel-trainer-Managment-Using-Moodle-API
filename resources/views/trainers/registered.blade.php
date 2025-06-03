@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@section('content')
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
                                    <h6>{{ $trainer->prefix2 }}</h6>
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
