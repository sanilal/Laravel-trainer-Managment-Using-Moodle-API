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
                                                <p class="name">{{ $fullName }}</p>
                                            @endif
                                            <p class="designation">
                                                {{ $trainer->prefix2 }}
                                            </p>
                                            
                                           <div class="row">
                                            <div class="col-md-8">
                                                <div class="namedetails">
                                                    @if (!empty($trainer->first_name))
                                                    <p>First Name: {{ $trainer->first_name }}</p>
                                                    @endif
                                                    @if (!empty($trainer->middle_name))
                                                    <p>Mddle Name: {{ $trainer->middle_name }}</p>
                                                    @endif
                                                    @if (!empty($trainer->family_name))
                                                    <p>Family Name: {{ $trainer->family_name }}</p>
                                                    @endif
                                                    @if (!empty($trainer->prefix2))
                                                    <p>Title: {{ $trainer->prefix2 }}</p>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="more_personal">
                                                    @if (!empty($trainer->gender))
                                                    <p><span class="color-secondary">Gender: </span> {{ $trainer->gender }}</p>
                                                    @endif
                                                    @if (!empty($trainer->date_of_birth))
                                                    <p><span class="color-secondary">Date of Birth: </span> {{ \Carbon\Carbon::parse($trainer->date_of_birth)->format('d/m/Y') }}
                                                    </p>
                                                    @endif
                                                    @if (!empty($trainer->languages))
                                                    <p><span class="color-secondary">Languages Known: </span> {{ $trainer->languages }}</p>
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
    <p><span class="color-secondary">Residency Status: </span> {{ $trainer->residency_status }}</p>
@endif

@if (!empty($trainer->country))
    <p><span class="color-secondary">Country: </span> {{ config('countries.list.' . $trainer->country, $trainer->country) }}</p>
@endif

@if (!empty($trainer->residing_city))
    <p><span class="color-secondary">City: </span> {{ $trainer->residing_city }}</p>
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
                                <div class="sm-icon"><x-icon name="linkedin" /></div>{{ $trainer->linkedin }}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->instagram) && $trainer->instagram !== '#')
                            <li><a href="{{ $trainer->instagram }}" target="_blank">
                                <div class="sm-icon"><x-icon name="instagram" /></div>{{ $trainer->instagram }}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->facebook) && $trainer->facebook !== '#')
                            <li><a href="{{ $trainer->facebook }}" target="_blank">
                                <div class="sm-icon"><x-icon name="facebook" /></div>{{ $trainer->facebook }}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->youtube) && $trainer->youtube !== '#')
                            <li><a href="{{ $trainer->youtube }}" target="_blank">
                                <div class="sm-icon"><x-icon name="youtube" /></div>{{ $trainer->youtube }}
                            </a></li>
                        @endif
                    
                        @if (!empty($trainer->twitter) && $trainer->twitter !== '#')
                            <li><a href="{{ $trainer->twitter }}" target="_blank">
                                <div class="sm-icon"><x-icon name="twitter" /></div>{{ $trainer->twitter }}
                            </a></li>
                        @endif
                    </ul>
                    

                </div>
            </div>

        </div>
        {{-- About Me --}}
        <div class="profile-info" id="about-me">
<div class="row">
    <div class="col-md-12">
        <h3>About Me : </h3>
        <p>
            I am a distinguished corporate trainer based in the UAE, renowned for his expertise in leadership development, business communication, and organizational excellence. With over 30 years of experience in training professionals across diverse industries, he has established himself as a trusted mentor and coach, helping individuals and organizations achieve peak performance.</p>
    </div>
</div>
        </div>
        <div class="section-title">
            <h2>Specialization & Certifications</h2>
        </div>
        {{-- Specializations --}}
        <div class="profile-info" id="specializations">
            <div class="row">
                <div class="col-md-9">
                    <h3>Specializations : </h3>
                    <div class="course-group">
                        <div class="course-group-info">
                            <p class="course-group-name">Management in Finance  </p>
                            <p class="course-group-institute">Name of the Institution: Institute of Management Studies </p>
                            <div class="course-group-dates">
                                <p class="course-group-start-date">Start Date: 12/4/2010</p>
                                <p class="course-group-end-date">End Date: 21/5/2012</p>
                            </div>
                        </div>
                        <div class="course-group-image">
                            <img src="" alt="">
                        </div>
                       
                    </div>
                    <div class="course-group">
                        <div class="course-group-info">
                            <p class="course-group-name">Management in Finance  </p>
                            <p class="course-group-institute">Name of the Institution: Institute of Management Studies </p>
                            <div class="course-group-dates">
                                <p class="course-group-start-date">Start Date: 12/4/2010</p>
                                <p class="course-group-end-date">End Date: 21/5/2012</p>
                            </div>
                        </div>
                        <div class="course-group-image">
                            <img src="" alt="">
                        </div>
                       
                    </div>
                    

 
            </div>
        </div>
    </div>
    {{-- Certifications --}}
    <div class="profile-info" id="certifications">
        <div class="row">
            <div class="col-md-9">
                <h3>Certifications : </h3>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">Management in Finance  </p>
                        <p class="course-group-institute">Name of the Institution: Institute of Management Studies </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: 12/4/2010</p>
                            <p class="course-group-end-date">End Date: 21/5/2012</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">Management in Finance  </p>
                        <p class="course-group-institute">Name of the Institution: Institute of Management Studies </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: 12/4/2010</p>
                            <p class="course-group-end-date">End Date: 21/5/2012</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
                


        </div>
    </div>
</div>
{{-- Academics --}}
<div class="section-title">
    <h2>Academics</h2>
</div>
<div id="academics">
    <div class="profile-info" >
        <div class="row">
            <div class="col-md-9">
                <h3>Under Graduation :  </h3>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">Management in Finance  </p>
                        <p class="course-group-institute">Name of the Institution: Institute of Management Studies </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: 12/4/2010</p>
                            <p class="course-group-end-date">End Date: 21/5/2012</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
        </div>
    </div>
    </div>
    
    <div class="profile-info" >
        <div class="row">
            <div class="col-md-9">
                <h3>Post Graduation :  </h3>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">Management in Finance  </p>
                        <p class="course-group-institute">Name of the Institution: Institute of Management Studies </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: 12/4/2010</p>
                            <p class="course-group-end-date">End Date: 21/5/2012</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
        </div>
    </div>
    </div>
    <div class="profile-info" >
        <div class="row">
            <div class="col-md-9">
                <h3>Doctorate :  </h3>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">Management in Finance  </p>
                        <p class="course-group-institute">Name of the Institution: Institute of Management Studies </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: 12/4/2010</p>
                            <p class="course-group-end-date">End Date: 21/5/2012</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
        </div>
    </div>
    </div>
</div>

{{-- Work Experience  --}}

<div class="section-title">
    <h2>Work Experience </h2>
</div>
<div id="work-experience">
    <div class="profile-info" >
        <div class="row">
            <div class="col-md-9">
                <h3>Job 1 :  </h3>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">Dubai Economic Department </p>
                        <p class="course-group-institute">Designation: Your Designation </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: 12/4/2010</p>
                            <p class="course-group-end-date">End Date: 21/5/2012</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
        </div>
    </div>
    </div>
    
   
    
</div>


{{-- Training Programs  --}}

<div class="section-title">
    <h2>Training Programs </h2>
</div>
<div id="work-experience">
    <div class="profile-info" >
        <div class="row">
            <div class="col-md-9">
                <h3>Job 1 :  </h3>
                <div class="course-group">
                    <div class="course-group-info">
                        <p class="course-group-name">Dubai Economic Department </p>
                        <p class="course-group-institute">Designation: Your Designation </p>
                        <div class="course-group-dates">
                            <p class="course-group-start-date">Start Date: 12/4/2010</p>
                            <p class="course-group-end-date">End Date: 21/5/2012</p>
                        </div>
                    </div>
                    <div class="course-group-image">
                        <img src="" alt="">
                    </div>
                   
                </div>
        </div>
    </div>
    </div>
    
   
    
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
