@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-title">
     
        <h2>{{__('messages.trainer_profile')}}</h2>
    </div>
    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                @if (!empty($userId))
             <a class="nav-link " href="{{ route('trainer.edit', ['id' => $profileId]) }}">
                {{__('messages.personal_information')}}
            </a>
            @else
        <span class="nav-link disabled">{{__('messages.personal_information')}}</span>
        @endif
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
        <a class="nav-link " href="{{ route('trainers.documents.create', ['profile' => $profileId]) }}">
            {{__('messages.documents')}}
        </a>
        @else
        <span class="nav-link disabled">{{__('messages.documents')}}</span>
        @endif
                
            </li>
            <li class="nav-item">
               
    
                @if (!empty($profileId))
                <a class="nav-link active" href="{{ route('trainers.specializations.create', ['profile' => $profileId, 'user' => $userId]) }}">
                    {{__('messages.specialization')}}
                </a>
            @else
                <span class="nav-link disabled">{{Specialization}}</span>
            @endif
    
            </li>
            <li class="nav-item">
    
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.academics.create', ['profile' => $profileId]) }}">
                    {{__('messages.academics')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.academics')}}</span>
            @endif
    
    
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.work_experience.create', ['profile' => $profileId]) }}">
                    {{__('messages.work_experience')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.work_experience')}}</span>
            @endif
               
            </li>
            <li class="nav-item">
                @if (!empty($profileId))
                <a class="nav-link" href="{{ route('trainers.training_programs.create', ['profile' => $profileId]) }}">
                    {{__('messages.training_programs')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.training_programs')}}</span>
            @endif
               
              
            </li>
        </ul>
    </div>
    <div class="section-title">
        <h2>{{__('messages.training_specialization')}}</h2>
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
                        <label for="specialization" class="form-label">{{__('messages.specialization')}}</label>
                <select name="specialization" class="form-control">
                    <option value="">{{__('messages.select_specialization')}}</option>
            
                    @include('components.specialization-options')
                    
                </select>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">{{__('messages.name_of_institution')}}</label>
                        <input type="text" name="name_of_the_institution" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">{{__('messages.start_date')}}</label>
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
                        <label class="form-label">{{__('messages.end_date')}}</label>
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
                    <label for="upload_certificate" class="custom-file-upload">
                        {{__('messages.upload_certificate')}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M472 312c-22.1 0-40 17.9-40 40v72H80v-72c0-22.1-17.9-40-40-40s-40 17.9-40 40v112c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V352c0-22.1-17.9-40-40-40zM241 280V96h-56c-13.3 0-24-10.7-24-24s10.7-24 24-24h160c13.3 0 24 10.7 24 24s-10.7 24-24 24h-56v184l73-73c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-112 112c-9.4 9.4-24.6 9.4-33.9 0l-112-112c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l73 73z"/>
                        </svg>
                    </label>
                    <input type="file" name="upload_certificate" id="upload_certificate" class="form-control">
                </div></div>

              
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" id="add-specialization">{{__('messages.save_add_more')}}</button>
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
                <button class="btn btn-danger btn-sm remove-specialization" data-id="{{ $specialization->id }}">X</button>
            </li>
        @endforeach
    </ul>
</div>
</div>



    <!-- Certification Section -->
    <div class="section-title">
        <h2>{{__('messages.certifications')}}</h2>
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
                    <label class="form-label">{{__('messages.certified_in')}}</label>
                    <select name="certified_in" class="form-control">
                        <option value="">{{__('messages.select_certification')}}</option>
                        <option value="PMP">PMP</option>
                        <option value="AWS">AWS</option>
                        <option value="CFA">CFA</option>
                         <option value="none" {{ $selectedValue == 'none' ? 'selected' : '' }}>No data available</option>
                    </select>
                </div>
               </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">{{__('messages.name_of_institution')}}</label>
            <input type="text" name="cert_name_of_the_institution" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">{{__('messages.start_date')}}</label>
            
            <div class="input-group date-picker-group">
                <input type="date" name="cert_start_date" class="form-control date-input">
                <button class="btn btn-outline-secondary calendar-button" type="button">
                    <i class="fa fa-calendar-alt"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">{{__('messages.end_date')}}</label>
            <div class="input-group date-picker-group">
                <input type="date" name="cert_end_date" class="form-control date-input">
                <button class="btn btn-outline-secondary calendar-button" type="button">
                    <i class="fa fa-calendar-alt"></i>
                </button>
            </div>
        </div>
    </div>
</div>
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">{{__('messages.upload_certificate')}}</label>
            <input type="file" name="cert_upload_certificate" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary" id="add-certification">{{__('messages.save_add_more')}}</button>
    </div>
    <div class="col-md-3"></div>    
    </div>    
    </form>

         
  <!-- Added Certifications -->
  <ul id="certification-list"  class="added-items">
    @foreach ($certifications as $certification)
        <li id="certification-{{ $certification->id }}">
            {{ $certification->certified_in }} - {{ $certification->cert_name_of_the_institution }}
            <button class="btn btn-danger btn-sm remove-certification" data-id="{{ $certification->id }}">X</button>
        </li>
    @endforeach
</ul>
    </div>
 
    </div>    

 

        

  
</div>



    <form action="{{ route('trainers.specializations.complete') }}" method="POST" class="specialization-complete-form">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profileId }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <button type="submit" class="btn btn-primary">{{__('messages.save_and_proceed')}}</button>
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
                        <button class="btn btn-danger btn-sm remove-specialization" data-id="${data.specialization.id}">X</button>
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

        if (confirm("Do you want to delete this specialization?")) {
            fetch(`/trainers/specializations/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(() => document.getElementById(`specialization-${id}`).remove());
        }
    }
});


        // AJAX for Removing Certification
    document.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-certification')) {
        let id = event.target.getAttribute('data-id');

        if (confirm("Do you want to delete this certification?")) {
            fetch(`/trainers/certifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(() => document.getElementById(`certification-${id}`).remove());
        }
    }
});
    });
</script>
@endsection
