@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-title">
     
        <h2>Trainer Profile</h2>
    </div>
    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                @if (!empty($userId))
            <a class="nav-link " href="{{ route('trainer.create', ['moodleUserId' => $userId]) }}">
                Personal Information
            </a>
            @else
        <span class="nav-link disabled">Personal Information</span>
        @endif
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
        <a class="nav-link " href="{{ route('trainers.documents.create', ['profile' => $profileId]) }}">
            Documents
        </a>
        @else
        <span class="nav-link disabled">Documents</span>
        @endif
                
            </li>
            <li class="nav-item">
               
    
                @if (!empty($profileId))
                <a class="nav-link active" href="{{ route('trainers.specializations.create', ['profile' => $profileId, 'user' => $userId]) }}">
                    Specialization
                </a>
            @else
                <span class="nav-link disabled">Specialization</span>
            @endif
    
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.academics.create', ['profile' => $profileId]) }}">
                    Academics
                </a>
            @else
                <span class="nav-link disabled">Academics</span>
            @endif
    
    
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.work_experience.create', ['profile' => $profileId]) }}">
                    Work Experience
                </a>
            @else
                <span class="nav-link disabled">Work Experience</span>
            @endif
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.training_programs.create', ['profile' => $profileId]) }}">
                    Training Programs
                </a>
            @else
                <span class="nav-link disabled">Training Programs</span>
            @endif
               
              
            </li>
        </ul>
    </div>
    <div class="section-title">
        <h2>Training Specialization</h2>
    </div>

    <!-- Training Specialization Form -->
    <div class="form-container specialization-form">
    <form id="specialization-form">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">

        <div class="mb-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-field">
                    <div class="form-group">
                        <label for="specialization" class="form-label">Specialization</label>
                <select name="specialization" class="form-control">
                    <option value="">Select Specialization</option>
            
                    <optgroup label="🏗️ Engineering Specializations">
                        <option>Architecture</option>
                        <option>Civil Engineering</option>
                        <option>Electrical Engineering</option>
                        <option>Mechanical Engineering</option>
                        <option>Industrial Engineering</option>
                        <option>Computer Engineering</option>
                        <option>Computer Science</option>
                        <option>Information Technology</option>
                        <option>Cybersecurity</option>
                        <option>Artificial Intelligence</option>
                        <option>Chemical Engineering</option>
                        <option>Software Engineering</option>
                    </optgroup>
            
                    <optgroup label="📚 Literary and Humanities Specializations">
                        <option>Arabic Language</option>
                        <option>English Language</option>
                        <option>History</option>
                        <option>Geography</option>
                        <option>Media</option>
                        <option>Public Relations</option>
                        <option>Journalism and Publishing</option>
                        <option>Psychology</option>
                        <option>Social Work</option>
                        <option>Sociology</option>
                        <option>Education</option>
                    </optgroup>
            
                    <optgroup label="💼 Administrative and Financial Specializations">
                        <option>Business Administration</option>
                        <option>Accounting</option>
                        <option>Marketing</option>
                        <option>Economics</option>
                        <option>Finance</option>
                        <option>Management Information Systems</option>
                        <option>Human Resources</option>
                        <option>Public Administration</option>
                    </optgroup>
            
                    <optgroup label="🎨 Art and Design Specializations">
                        <option>Graphic Design</option>
                        <option>Interior Design</option>
                        <option>Fine Arts</option>
                        <option>Photography</option>
                        <option>Fashion Design</option>
                        <option>Film Production</option>
                    </optgroup>
            
                    <optgroup label="📈 Business and Marketing Specializations">
                        <option>International Trade</option>
                        <option>Digital Marketing</option>
                        <option>Project Management</option>
                        <option>Supply Chain (Logistics)</option>
                        <option>E-Commerce</option>
                        <option>Business Data Analysis</option>
                        <option>Business Development</option>
                    </optgroup>
            
                    <optgroup label="🌍 Environmental and Agricultural Specializations">
                        <option>Agriculture</option>
                        <option>Environmental Science</option>
                        <option>Natural Resource Management</option>
                        <option>Ocean Sciences</option>
                        <option>Renewable Energy</option>
                        <option>Agricultural Engineering</option>
                        <option>Aerospace</option>
                    </optgroup>
            
                    <optgroup label="⚖️ Legal and Political Specializations">
                        <option>Civil Law</option>
                        <option>Criminal Law</option>
                        <option>International Law</option>
                        <option>Human Rights</option>
                        <option>Public Policy</option>
                        <option>Political Science</option>
                        <option>International Relations</option>
                        <option>Crisis and Disaster Management</option>
                    </optgroup>
            
                    <optgroup label="🧠 Brain and Behavioral Sciences Specializations">
                        <option>Neuroscience</option>
                        <option>Neuropsychology</option>
                        <option>Behavioral Science</option>
                        <option>Autism Studies</option>
                        <option>Addiction Studies</option>
                        <option>Psychotherapy</option>
                    </optgroup>
            
                    <optgroup label="🏛️ Social and Intellectual Specializations">
                        <option>Philosophy</option>
                        <option>Comparative Literature</option>
                        <option>Cultural Studies</option>
                        <option>Anthropology</option>
                        <option>Middle Eastern Studies</option>
                        <option>Religious Studies</option>
                        <option>Performing Arts</option>
                    </optgroup>
            
                    <optgroup label="⚙️ Mechatronics and Robotics Specializations">
                        <option>Mechatronics Engineering</option>
                        <option>Robotics</option>
                        <option>Automation and Control</option>
                        <option>3D Printing</option>
                        <option>Embedded Systems</option>
                    </optgroup>
            
                    <optgroup label="💻 Programming and Modern Technology Specializations">
                        <option>Game Development</option>
                        <option>Data Analysis</option>
                        <option>Programming (Java, Python, C++)</option>
                        <option>App Development</option>
                        <option>Web Development</option>
                        <option>Networking</option>
                        <option>Embedded Software Development</option>
                    </optgroup>
            
                    <optgroup label="🌐 Languages and Translation Specializations">
                        <option>Linguistics</option>
                        <option>Simultaneous Interpretation</option>
                        <option>Literary Translation</option>
                        <option>Technical Translation</option>
                        <option>Legal Translation</option>
                        <option>Eastern Languages (e.g., Chinese, Japanese, Korean)</option>
                    </optgroup>
            
                    <optgroup label="💡 Modern Technical and Engineering Specializations">
                        <option>Software Engineering</option>
                        <option>Artificial Intelligence</option>
                        <option>Data Science and Analytics</option>
                        <option>Mobile App Development</option>
                        <option>Virtual and Augmented Reality (VR/AR)</option>
                        <option>Smart Systems</option>
                        <option>Tech Systems Management</option>
                        <option>Embedded Systems</option>
                    </optgroup>
            
                    <optgroup label="🎭 Arts and Media Specializations">
                        <option>Film and TV Production</option>
                        <option>Digital Media</option>
                        <option>Screenwriting</option>
                        <option>Sound and Music Design</option>
                        <option>Advertising and Public Relations</option>
                        <option>Radio and TV Production</option>
                        <option>Digital Game Design</option>
                        <option>Animation</option>
                        <option>Expressive Arts and Dance</option>
                    </optgroup>
            
                    <optgroup label="🚀 Space and Aviation Specializations">
                        <option>Space Engineering</option>
                        <option>Aeronautical Engineering</option>
                        <option>Space Science</option>
                        <option>Astrophysics</option>
                        <option>Space Research and Exploration</option>
                    </optgroup>
            
                    <optgroup label="💼 Management and Economics Specializations">
                        <option>International Project Management</option>
                        <option>International Economics</option>
                        <option>Risk Management</option>
                        <option>Political Economy</option>
                        <option>Strategic Marketing</option>
                        <option>Financial Management</option>
                        <option>Financial and Managerial Accounting</option>
                    </optgroup>
            
                    <optgroup label="🧩 Mind and Behavior Studies Specializations">
                        <option>Behavioral Neuroscience</option>
                        <option>Psychiatry</option>
                        <option>Social Psychology</option>
                        <option>Psychoanalysis</option>
                        <option>Addiction and Treatment</option>
                        <option>Autism Studies</option>
                        <option>Art and Music Therapy</option>
                    </optgroup>
                    
                </select>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Name of the Institution</label>
                        <input type="text" name="name_of_the_institution" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Start Date</label>
                        <div class="input-group date-picker-group">
                            <input type="date" name="start_date" class="form-control date-input">
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
                            <input type="date" name="end_date" class="form-control date-input">
                            <button class="btn btn-outline-secondary calendar-button" type="button">
                                <i class="fa fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3"> <div class="mb-3 documents-row">
                    <label for="your_passport" class="custom-file-upload">
                        Upload Certificate
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M472 312c-22.1 0-40 17.9-40 40v72H80v-72c0-22.1-17.9-40-40-40s-40 17.9-40 40v112c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V352c0-22.1-17.9-40-40-40zM241 280V96h-56c-13.3 0-24-10.7-24-24s10.7-24 24-24h160c13.3 0 24 10.7 24 24s-10.7 24-24 24h-56v184l73-73c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-112 112c-9.4 9.4-24.6 9.4-33.9 0l-112-112c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l73 73z"/>
                        </svg>
                    </label>
                    <input type="file" name="upload_certificate" id="upload_certificate" class="form-control">
                </div></div>

              
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" id="add-specialization">Save & Add More</button>
                </div>
                <div class="col-md-3">

                </div>
            </div>
            
        </div>
        


     

        
    </form>

     <!-- Added Specializations -->
<div class="mt-4">
    {{-- <h5>Added Specializations</h5> --}}
    <ul id="specialization-list" class="added-items">
        @foreach ($specializations as $specialization)
            <li id="specialization-{{ $specialization->id }}">
                {{ $specialization->specialization }} - {{ $specialization->name_of_the_institution }}
                <button class="btn-sm remove-specialization" data-id="{{ $specialization->id }}">X</button>
            </li>
        @endforeach
    </ul>
</div>
</div>



    <!-- Certification Section -->
    <div class="section-title">
        <h2>Certifications</h2>
    </div>
    <div class="form-container certification-form">
    <form id="certification-form">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">

        <div class="row">
            <div class="col-md-12">
               <div class="single-field">
                <div class="form-group">
                    <label class="form-label">Certified In</label>
                    <select name="certified_in" class="form-control">
                        <option value="">Select Certification</option>
                        <option value="PMP">PMP</option>
                        <option value="AWS">AWS</option>
                        <option value="CFA">CFA</option>
                    </select>
                </div>
               </div>
    </div>
</div>

        <div class="mb-3">
            <label class="form-label">Name of the Institution</label>
            <input type="text" name="cert_name_of_the_institution" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="cert_start_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="cert_end_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Certificate</label>
            <input type="file" name="cert_upload_certificate" class="form-control">
        </div>

        <button type="button" class="btn btn-primary" id="add-certification">Save & Add More</button>
    </form>
  <!-- Added Certifications -->
    <div class="mt-4">
        <h5>Added Certifications</h5>
        <ul id="certification-list">
            @foreach ($certifications as $certification)
                <li id="certification-{{ $certification->id }}">
                    {{ $certification->certified_in }} - {{ $certification->cert_name_of_the_institution }}
                    <button class="btn btn-danger btn-sm remove-certification" data-id="{{ $certification->id }}">X</button>
                </li>
            @endforeach
        </ul>
    </div>
</div>

  

    <hr>

    <form action="{{ route('trainers.specializations.complete') }}" method="POST">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <button type="submit" class="btn btn-success">Save and Proceed</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // AJAX for Adding Specialization
        document.getElementById('add-specialization').addEventListener('click', function () {
            let formData = new FormData(document.getElementById('specialization-form'));

            fetch("{{ route('trainers.specializations.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let listItem = `<li id="specialization-${data.specialization.id}">
                        ${data.specialization.specialization} - ${data.specialization.name_of_the_institution}
                        <button class="btn-sm remove-specialization" data-id="${data.specialization.id}">X</button>
                    </li>`;
                    document.getElementById('specialization-list').innerHTML += listItem;
                }
            });
        });

        // AJAX for Adding Certification
        document.getElementById('add-certification').addEventListener('click', function () {
            let formData = new FormData(document.getElementById('certification-form'));

            fetch("{{ route('trainers.certifications.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let listItem = `<li id="certification-${data.certification.id}">
                        ${data.certification.certified_in} - ${data.certification.cert_name_of_the_institution}
                        <button class="btn btn-danger btn-sm remove-certification" data-id="${data.certification.id}">X</button>
                    </li>`;
                    document.getElementById('certification-list').innerHTML += listItem;
                }
            });
        });

        // AJAX for Removing Specialization
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-specialization')) {
                let id = event.target.getAttribute('data-id');

                fetch(`/specializations/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                    .then(response => response.json())
                    .then(() => document.getElementById(`specialization-${id}`).remove());
            }
        });

        // AJAX for Removing Certification
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-certification')) {
                let id = event.target.getAttribute('data-id');

                fetch(`/certifications/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                    .then(response => response.json())
                    .then(() => document.getElementById(`certification-${id}`).remove());
            }
        });
    });
</script>
@endsection
