@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-wraper">
        <div class="section-title">
            <h2>Personal Information</h2>
        </div>
        {{-- Personal Information --}}
        <div class="profile-info" id="personal-info">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <div class="profilepic ">
                                <img src="{{ $trainer->profile_image ? asset('storage/' . $trainer->profile_image) : asset('default-avatar.png') }}" alt="Profile Picture" class="img-fluid rounded-circle">
        
        
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
                                                {{ $trainer->prefix2 }}
                                            </p>
                                            
                                           <div class="row">
                                            <div class="col-md-8">
                                                <div class="namedetails">
                                                    @if (!empty($trainer->first_name))
                                                    <p>First Name: {!! langContent($trainer->first_name) !!}</p>
                                                    @endif
                                                    @if (!empty($trainer->middle_name))
                                                    <p>Mddle Name: {!! langContent($trainer->middle_name) !!}</p>
                                                    @endif
                                                    @if (!empty($trainer->family_name))
                                                    <p>Family Name: {!! langContent($trainer->family_name) !!}</p>
                                                    @endif
                                                    @if (!empty($trainer->prefix2))
                                                    <p>Title: {!! langContent($trainer->prefix2) !!}</p>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="more_personal">
                                                    @if (!empty($trainer->gender))
                                                    <p><span class="color-secondary">Gender: </span> {!! langContent($trainer->gender) !!}</p>
                                                    @endif
                                                    @if (!empty($trainer->date_of_birth))
                                                    <p><span class="color-secondary">Date of Birth: </span> {{ \Carbon\Carbon::parse($trainer->date_of_birth)->format('d/m/Y') }}
                                                    </p>
                                                    @endif
                                                    @if (!empty($trainer->languages))
                                                    <p><span class="color-secondary">Languages Known: </span> {!! langContent($trainer->languages) !!}</p>
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
    <p><span class="color-secondary">Residency Status: </span> {!! langContent($trainer->residency_status) !!}</p>
@endif

@if (!empty($trainer->country))
    <p><span class="color-secondary">Country: </span> {{ config('countries.list.' . $trainer->country, $trainer->country) }}</p>
@endif

@if (!empty($trainer->residing_city))
    <p><span class="color-secondary">City: </span> {!! langContent($trainer->residing_city) !!}</p>
@endif

@if (!empty($trainer->email))
    <p><span class="color-secondary">Email: </span> {{ $trainer->email }}</p>
@endif

@if (!empty($trainer->mobile_number))
    <p><span class="color-secondary">Mobile Number: </span> {{ $trainer->mobile_number }}</p>
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
        @if (!empty($trainer->email))
        <div class="profile-info" id="about-me">
<div class="row">
    <div class="col-md-12">
        <h3>About Me : </h3>

        {!! langContent($trainer->about_you) !!}



    </div>  
</div>
        </div>
        @endif
        <div class="section-title">
            <h2>Specialization & Certifications</h2>
        </div>
        
        <div class="profile-info" id="specializations">
            <div class="row">
                <div class="col-md-11">
                    <h3>Specializations : </h3>
        
                    @forelse($trainer->specializations as $specialization)
                        <div class="course-group mb-4">
                            <div class="course-group-info">
                                <p class="course-group-name">{{ langContent($specialization->specialization) }}</p>
                                <p class="course-group-institute">Name of the Institution: {{ langContent($specialization->name_of_the_institution) }}</p>
                                <div class="course-group-dates">
                                    <p class="course-group-start-date">Start Date: {{ \Carbon\Carbon::parse($specialization->start_date)->format('d/m/Y') }}</p>
                                    <p class="course-group-end-date">End Date: {{ \Carbon\Carbon::parse($specialization->end_date)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="course-group-image">
                                @if ($specialization->upload_certificate)
                                    <img src="{{ asset('storage/' . $specialization->upload_certificate) }}" alt="Certificate" class="img-fluid">
                                @else
                                    <img src="{{ asset('images/certificate.png') }}" alt="Default Certificate" class="img-fluid">
                                @endif
                            </div>
                        </div>
                    @empty
                        <p>No specializations added yet.</p>
                    @endforelse
        
                </div>
            </div>
        </div>
        
    {{-- Certifications --}}
    <div class="profile-info" id="certifications">
        <div class="row">
            <div class="col-md-9">
                <h3>Certifications : </h3>
                @forelse ($trainer->certifications as $certification)
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">{{ langContent($certification->certified_in) }}</p>
                        <p class="course-group-institute">Name of the Institution: {{ langContent($certification->name_of_the_institution) }} </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: {{ langContent($certification->start_date) }}</p>
                            <p class="course-group-end-date">End Date: {{ langContent($certification->end_date) }}</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
                @empty
                <p>No Certifiations added yet.</p>
                @endforelse
               
                


        </div>
    </div>
</div>
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

<div class="section-title">
    <h2>Academics</h2>
</div>
<div id="academics">
    @forelse ($sortedAcademics as $academic)
    <div class="profile-info">
        <div class="row">
            <div class="col-md-9">
                <h3>{{ langContent($academic->academics) }}</h3>
                <div class="course-group">
                    <div class="course-group-info">
                       

                        <p class="course-group-name"> {{ $academic->stream ? langContent($academic->stream) : 'Stream not specified' }}</p>
                        <p class="course-group-institute">Name of the Institution: {{ langContent($academic->name_of_the_university) }}</p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: {{ \Carbon\Carbon::parse($academic->start_date)->format('d/m/Y') }}</p>
                            <p class="course-group-end-date">End Date: {{ \Carbon\Carbon::parse($academic->end_date)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        @if ($academic->upload_certificate)
                            <a href="{{ asset('storage/' . $academic->upload_certificate) }}" target="_blank">View Certificate</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
        <p>No Certifications added yet.</p>
    @endforelse
</div>


{{-- Work Experience  --}}

<div class="section-title">
    <h2>Work Experience</h2>
</div>

<div id="work-experience">
    @forelse($trainer->workExperiences as $index => $work)
    <div class="profile-info">
        <div class="row">
            <div class="col-md-9">
                <h3>Job {{ $index + 1 }}:</h3>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">{{ langContent($work->organization_name) }}</p>
                        <p class="course-group-institute">Designation: {{ langContent($work->designation) }}</p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: {{ \Carbon\Carbon::parse($work->start_date)->format('d/m/Y') }}</p>
                            <p class="course-group-end-date">End Date: {{ \Carbon\Carbon::parse($work->end_date)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        @if($work->upload_certificate)
                            <a href="{{ asset('storage/' . $work->upload_certificate) }}" target="_blank">
                                <img src="{{ asset('storage/' . $work->upload_certificate) }}" alt="Certificate" style="max-height: 100px;">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
        <p>No work experience added yet.</p>
    @endforelse
</div>



{{-- Training Programs  --}}

<div class="section-title">
    <h2>Training Programs</h2>
</div>
<div id="training-programs">
    @forelse ($trainer->trainingPrograms as $index => $program)
        <div class="profile-info">
            <div class="row">
                <div class="col-md-9">
                    <h3>Program {{ $index + 1 }}:</h3>
                    <div class="course-group">
                        <div class="course-group-info">
                            <p class="course-group-name">{{ langContent($program->program_name) }}</p>
                            <div class="course-group-dates">
                                <p class="course-group-start-date">Start Date: {{ \Carbon\Carbon::parse($program->start_date)->format('d/m/Y') }}</p>
                                <p class="course-group-end-date">End Date: {{ \Carbon\Carbon::parse($program->end_date)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="course-group-image">
                            <img src="" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No training programs added yet.</p>
    @endforelse
</div>

{{-- Documents --}}
<div class="section-title">
    <h2>Documents</h2>
</div>

<div id="documents">
    @if ($trainer->personalDocuments)
        <div class="profile-info">
            <div class="row">
                {{-- Full-width row for Your ID --}}
                @if ($trainer->personalDocuments->your_id)
                    <div class="col-md-12 mb-3">
                        <div class="document-box">
                            <p><strong>Your ID:</strong></p>
                            <a href="{{ asset('uploads/documents/' . $trainer->personalDocuments->your_id) }}" target="_blank">View Document</a>
                        </div>
                    </div>
                @endif

                {{-- Three-column layout for the rest --}}
                @php
                    $documents = [
                        'Your Passport' => $trainer->personalDocuments->your_passport,
                        'Other Document 1' => $trainer->personalDocuments->other_document,
                        'Other Document 2' => $trainer->personalDocuments->other_document2,
                    ];
                @endphp

                @foreach ($documents as $label => $file)
                    @if ($file)
                        <div class="col-md-4 mb-3">
                            <div class="document-box">
                                <p><strong>{{ $label }}:</strong></p>
                                <a href="{{ asset('uploads/documents/' . $file) }}" target="_blank">View Document</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <p>No documents uploaded yet.</p>
    @endif
</div>





    <div class="card shadow mb-4">
        <div class="card-body d-flex align-items-center">
            <img src="{{ $trainer->profile_image ?? asset('default-avatar.png') }}" class="rounded-circle me-4" width="100" height="100" alt="Profile Image">
            <div>
                <h3>{{ $trainer->salutation }} {{ $trainer->first_name }} {{ $trainer->lastname }}</h3>
                <p><strong>Email:</strong> {{ $trainer->email }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($trainer->gender) }}</p>
                <p><strong>Country:</strong> {{ $trainer->country }}</p>
                <p><strong>City:</strong> {{ $trainer->residing_city }}</p>
                <p><strong>Specializations:</strong> {{ $trainer->specializations->pluck('title')->join(', ') ?? 'N/A' }}</p>
                <!-- Add more fields as needed -->
            </div>
        </div>
    </div>

    {{-- Optional: Additional Sections --}}
    {{-- Include partials for documents, academics, etc. if available --}}
</div>
@endsection
