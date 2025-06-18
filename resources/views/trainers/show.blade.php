@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-wraper" id="trainer-cv" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="section-title">
            <h2>{{__('messages.personal_information')}}</h2>
        </div>
        {{-- Personal Information --}}
        <div class="profile-info" id="personal-info">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <div class="profilepic ">
                                <img src="{{ $trainer->profile_image ? asset('storage/' . $trainer->profile_image) : asset('images/placeholder-profile.png') }}" alt="Profile Picture" class="img-fluid rounded-circle">
        
        
                                            </div>
                        </div>
                        <div class="col-md-10 col-sm-9 col-xs-9">
                                            <div class="basic_personal ">
                                                @php
                                                $fullName = collect([
                                                    $trainer->prefix,
                                                    $trainer->first_name,
                                                    $trainer->middle_name,
                                                    $trainer->family_name
                                                ])->filter()->implode(' ');
                                            @endphp
                                            
                                            @if ($fullName)
                                                <p class="name">{!! langContent($fullName) !!}</p>
                                            @endif
                                            <p class="designation">
                                                {{ __('messages.' . $trainer->prefix2) }}
                                            </p>
                                            
                                           <div class="row">
                                            <div class="col-md-8">
                                                <div class="namedetails">
                                                    @if (!empty($trainer->first_name))
                                                    <p>{{__('messages.first_name')}}: {!! langContent($trainer->first_name) !!}</p>
                                                    @endif
                                                    @if (!empty($trainer->middle_name))
                                                    <p>{{__('messages.middle_name')}}: {!! langContent($trainer->middle_name) !!}</p>
                                                    @endif
                                                    @if (!empty($trainer->family_name))
                                                    <p>{{__('messages.family_name')}}: {!! langContent($trainer->family_name) !!}</p>
                                                    @endif
                                                    @if (!empty($trainer->prefix2))
                                                    <p>{{__('messages.title')}}:  {{ __('messages.' . $trainer->prefix2) }}</p>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="more_personal">
                                                    @if (!empty($trainer->gender))
                                                    <p><span class="color-secondary">{{__('messages.gender')}}: </span> {{__('messages.' .$trainer->gender)}}</p>
                                                    @endif
                                                    @if (!empty($trainer->date_of_birth))
                                                    <p><span class="color-secondary">{{__('messages.date_of_birth')}}: </span> {{ \Carbon\Carbon::parse($trainer->date_of_birth)->format('d/m/Y') }}
                                                    </p>
                                                    @endif
                                                    @if (!empty($trainer->languages))
                                                    <p><span class="color-secondary">{{__('messages.languages_known')}}: </span> {!! langContent($trainer->languages) !!}</p>
                                                    @endif
                                                   
                                                </div>
                                            </div>
                                           </div>
                                            </div>
                        </div>
                    </div>
                </div>
                             
            </div>
            <div class="separator"></div>
            <div class="row mt-50 mb-40">
                <div class="col-md-8">
                    <div class="residency">
                        @if (!empty($trainer->residency_status))
    <p><span class="color-secondary">{{__('messages.residency_status')}}: </span> {{__('messages.' .$trainer->residency_status)}}</p>
   
@endif

@if (!empty($trainer->country))
    <p><span class="color-secondary">{{__('messages.country')}}: </span>
        @php
    $locale = app()->getLocale();
    $countryList = config("countries.list.$locale") ?? config('countries.list.en');
    $countryName = $countryList[$trainer->country] ?? $trainer->country;
@endphp
        {{ $countryName }}</p>
@endif

@if (!empty($trainer->residing_city))
    <p><span class="color-secondary">{{__('messages.city')}}: </span> {!! langContent($trainer->residing_city) !!}</p>
@endif

@if (!empty($trainer->email))
    <p><span class="color-secondary">{{__('messages.email')}}: </span> {{ $trainer->email }}</p>
@endif

@if (!empty($trainer->mobile_number))
    <p><span class="color-secondary">{{__('messages.mobile_number')}}: </span> {{ $trainer->mobile_number }}</p>
@endif

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="social-media">
                        @if (!empty($trainer->website) && $trainer->website !== '#')
                            <li><a href="{{ $trainer->website }}" target="_blank">
                                <div class="sm-icon"><x-icon name="web" /></div>{{ $trainer->website }}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->linkedin) && $trainer->linkedin !== '#')
                            <li><a href="{{ $trainer->linkedin }}" target="_blank">
                                <div class="sm-icon"><x-icon name="linkedin" /></div>{!! langContent($trainer->linkedin) !!}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->instagram) && $trainer->instagram !== '#')
                            <li><a href="{{ $trainer->instagram }}" target="_blank">
                                <div class="sm-icon"><x-icon name="instagram" /></div>{!! langContent($trainer->instagram) !!}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->facebook) && $trainer->facebook !== '#')
                            <li><a href="{{ $trainer->facebook }}" target="_blank">
                                <div class="sm-icon"><x-icon name="facebook" /></div>{!! langContent($trainer->facebook) !!}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->youtube) && $trainer->youtube !== '#')
                            <li><a href="{{ $trainer->youtube }}" target="_blank">
                                <div class="sm-icon"><x-icon name="youtube" /></div>{!! langContent($trainer->youtube) !!}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->twitter) && $trainer->twitter !== '#')
                            <li><a href="{{ $trainer->twitter }}" target="_blank">
                                <div class="sm-icon"><x-icon name="twitter" /></div> {!! langContent($trainer->twitter) !!}
                            </a></li>
                        @endif
                    </ul>
                    

                </div>
            </div>

        </div>
        {{-- About Me --}}
        @if (trim(strip_tags(langContent($trainer->about_you))) !== '')
        <div class="profile-info" id="about-me">
<div class="row">
    <div class="col-md-12">
        <h3>{{__('messages.about_me')}} : </h3>

        {!! langContent($trainer->about_you) !!}



    </div>  
</div>
        </div>
        @endif
       @if ($trainer->specializations->count() || $trainer->certifications->count())
    <div class="section-title">
        <h2>{{ __('messages.specialization_certifications') }}</h2>
    </div>
@endif

{{-- Specializations --}}
@if ($trainer->specializations->count())
    <div class="profile-info" id="specializations">
        <div class="row">
            <div class="col-md-11">
                <h3>{{ __('messages.specialization') }}:</h3>
                @foreach($trainer->specializations as $specialization)
                    <div class="course-group mb-4">
                        <div class="course-group-info">
                            <p class="course-group-name">{{__('messages.' .$specialization->specialization)}}</p>
                            <p class="course-group-institute">
                                {{ __('messages.name_of_institution') }}: {{ langContent($specialization->name_of_the_institution) }}
                            </p>
                            <div class="course-group-dates">
                                <p class="course-group-start-date">
                                    {{ __('messages.start_date') }}: {{ \Carbon\Carbon::parse($specialization->start_date)->format('d/m/Y') }}
                                </p>
                                <p class="course-group-end-date">
                                    {{ __('messages.end_date') }}: {{ \Carbon\Carbon::parse($specialization->end_date)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="course-group-image">
                            @if ($specialization->upload_certificate)
                                <a href="{{ asset('storage/' . $specialization->upload_certificate) }}" target="_blank">
                                    <img src="{{ asset('images/certificate.png') }}" alt="Certificate" class="img-fluid">
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

{{-- Certifications --}}
@if ($trainer->certifications->count())
    <div class="profile-info" id="certifications">
        <div class="row">
            <div class="col-md-9">
                <h3>{{ __('messages.certifications') }}:</h3>
                @foreach ($trainer->certifications as $certification)
                    <div class="course-group">
                        <div class="course-group-info">
                            <p class="course-group-name">{{ langContent($certification->certified_in) }}</p>
                            <p class="course-group-institute">
                                {{ __('messages.name_of_institution') }}: {{ langContent($certification->name_of_the_institution) }}
                            </p>
                            <div class="course-group-dates">
                                <p class="course-group-start-date">
                                    {{ __('messages.start_date') }}: {{ langContent($certification->start_date) }}
                                </p>
                                <p class="course-group-end-date">
                                    {{ __('messages.end_date') }}: {{ langContent($certification->end_date) }}
                                </p>
                            </div>
                        </div>

                        <div class="course-group-image">
                            @if ($certification->upload_certificate)
                                <a href="{{ asset('storage/' . $certification->upload_certificate) }}" target="_blank">
                                    <img src="{{ asset('images/certificate.png') }}" alt="Certificate" class="img-fluid">
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif


{{-- Academics --}}
@php
    // Define the desired order
    $academicOrder = [
        'bachelor degree' => 1,   // Under Graduate
        'masters degree' => 2,    // Post Graduate
        'doctoral degree' => 3,   // Doctorate
        'diploma' => 4            // Diploma
    ];

    // Sort the collection
    $sortedAcademics = $trainer->academics->sortBy(function($academic) use ($academicOrder) {
        return $academicOrder[strtolower($academic->academics)] ?? 99;
    });
@endphp
@if ($sortedAcademics->count())
    <div class="section-title">
        <h2>{{ __('messages.academics') }}</h2>
    </div>

    <div id="academics">
        @foreach ($sortedAcademics as $academic)
            <div class="profile-info">
                <div class="row">
                    <div class="col-md-9">
                        <h3>{{ __('messages.' .$academic->academics) }}</h3>
                        <div class="course-group">
                            <div class="course-group-info">
                                <p class="course-group-name">
                                    {{ $academic->stream ? langContent($academic->stream) : 'Stream not specified' }}
                                </p>
                                <p class="course-group-institute">
                                    {{ __('messages.name_of_institution') }}: {{ langContent($academic->name_of_the_university) }}
                                </p>
                                <div class="course-group-dates">
                                    <p class="course-group-start-date">
                                        {{ __('messages.start_date') }}: {{ \Carbon\Carbon::parse($academic->start_date)->format('d/m/Y') }}
                                    </p>
                                    <p class="course-group-end-date">
                                        {{ __('messages.end_date') }}: {{ \Carbon\Carbon::parse($academic->end_date)->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="course-group-image">
                                @if ($academic->upload_certificate)
                                    <a href="{{ asset('storage/' . $academic->upload_certificate) }}" target="_blank">
                                        <img src="{{ asset('images/certificate.png') }}" alt="Certificate" class="img-fluid">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif



{{-- Work Experience  --}}
@if ($trainer->workExperiences->isNotEmpty())
    <div class="section-title">
        <h2>{{ __('messages.work_experience') }}</h2>
    </div>

    <div id="work-experience">
        @foreach($trainer->workExperiences as $index => $work)
            <div class="profile-info">
                <div class="row">
                    <div class="col-md-9">
                       <h3>{{ __('messages.job_label', ['number' => $index + 1]) }}</h3>
                        <div class="course-group">
                            <div class="course-group-info">
                                <p class="course-group-name">{{ langContent($work->organization_name) }}</p>
                                <p class="course-group-institute">{{ __('messages.designation') }}: {{ langContent($work->designation) }}</p>
                                <div class="course-group-dates">
                                    <p class="course-group-start-date">{{ __('messages.start_date') }}: {{ \Carbon\Carbon::parse($work->start_date)->format('d/m/Y') }}</p>
                                    <p class="course-group-end-date">{{ __('messages.end_date') }}: {{ \Carbon\Carbon::parse($work->end_date)->format('d/m/Y') }}</p>
                                </div>
                                <div class="training-info">
                                <p>{!! langContent($work->job_description) !!}</p>
                                
                            </div>
                            </div>

                            <div class="course-group-image">
                                @if ($work->upload_certificate)
                                    <a href="{{ asset('storage/' . $work->upload_certificate) }}" target="_blank">
                                        <img src="{{ asset('images/certificate.png') }}" alt="Certificate" class="img-fluid">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif




{{-- Training Programs  --}}
@if ($trainer->trainingPrograms->isNotEmpty())
<div class="section-title">
    <h2>{{__('messages.training_programs')}}</h2>
</div>
<div id="training-programs">
    @forelse ($trainer->trainingPrograms as $index => $program)
        <div class="profile-info">
            <div class="row">
                <div class="col-md-9">
                    <h3>{{__('messages.program')}} {{ $index + 1 }}:</h3>
                    <div class="course-group">
                        <div class="course-group-info">
                            <p class="course-group-name">{{ langContent($program->program_name) }}</p>
                            <div class="course-group-dates">
                                <p class="course-group-start-date">{{__('messages.training_date')}}: {{ \Carbon\Carbon::parse($program->training_date)->format('d/m/Y') }}</p>
                                
                                {{-- <p class="course-group-end-date">{{__('messages.end_date')}}: {{ \Carbon\Carbon::parse($program->end_date)->format('d/m/Y') }}</p> --}}
                            </div>
                            <div class="training-info">
                                <p>{!! langContent($program->details) !!}</p>
                                
                            </div>
                        </div>
                         <div class="course-group-image">
                        @if ($program->document)
                            <a href="{{ asset('storage/' . $program->document) }}" target="_blank">
                                <img src="{{ asset('images/certificate.png') }}" alt="Certificate" class="img-fluid">
                            </a>
                        @else
                            {{-- <p>{{__('messages.no_attachment')}}</p> --}}
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        {{-- <p>{{__('messages.no_training_programs')}}.</p> --}}
    @endforelse
</div>
@endif

{{-- Documents --}}

@php
    $docs = $trainer->personalDocuments;
    $hasDocuments = $docs && ($docs->your_id || $docs->your_passport || $docs->other_document || $docs->other_document2);
@endphp

@if ($hasDocuments)
    <div class="section-title">
        <h2>{{ __('messages.documents') }}</h2>
    </div>

    <div id="documents">
        <div class="profile-info">
            <div class="row">
                {{-- Full-width row for Your ID --}}
                @if ($docs->your_id)
                    <div class="col-md-12 mb-3">
                        <div class="document-box">
                            <p><strong>{{ __('messages.national_id') }}:</strong></p>
                            <a href="{{ asset('uploads/documents/' . $docs->your_id) }}" target="_blank" class="nationalid">
                                <img src="{{ asset('images/id-card.png') }}" alt="national Id" class="img-fluid">
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="profile-info">
            <div class="row">
                @php
                    $documents = [
                        __('messages.your_passport') => $docs->your_passport,
                        __('messages.other_document_1') => $docs->other_document,
                        __('messages.other_document_2') => $docs->other_document2,
                    ];
                @endphp

                @foreach ($documents as $label => $file)
                    @if ($file)
                        <div class="col-md-4 mb-3">
                            <div class="document-box">
                                <p><strong>{{ $label }}:</strong></p>
                                <a href="{{ asset('uploads/documents/' . $file) }}" target="_blank">{{ __('messages.view_document') }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif



    {{-- Optional: Additional Sections --}}
    {{-- Include partials for documents, academics, etc. if available --}}
</div>

<div class="text-center mb-3">
    <button onclick="printCV()" class="btn btn-primary me-2">{{ __('messages.print') }}</button>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function printCV() {
        const printContents = document.getElementById('trainer-cv').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // Ensure JS works again after restoring DOM
    }

</script>
@endpush

