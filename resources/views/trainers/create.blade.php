@extends('layouts.app')

@section('content')

{{-- Check if $moodleUser exists --}}


@if(!$moodleUser)
    <div class="alert alert-danger">Something went wrong. Moodle user not found.</div>
    @php
        return;
    @endphp
@endif
{{-- @if($moodleUser)
    @php
        $dobValue = null;

        foreach ($moodleUser['customfields'] as $field) {
            if (isset($field['shortname']) && $field['shortname'] === 'dob') {
                $dobValue = $field['value'];
                break;
            }
        }
    @endphp

    <p>Date of Birth: {{ $dobValue }}</p>
@endif --}}

{{-- {{dd($moodleUser['customfields'][1]['value'])}} --}}
{{-- Check if $moodleUser exists --}}

{{-- Display validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="page-title">
     
        <h2>{{__('messages.trainer_profile')}}</h2>
    </div>
    <div class="form-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                @if (!empty($moodleUser['id']))
            <a class="nav-link active" href="{{ route('trainer.create', ['moodleUserId' =>  $moodleUser['id']]) }}">
                {{__('messages.personal_information') }}
            </a>
            @else
        <span class="nav-link disabled">{{__('messages.personal_information') }}</span>
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
                <a class="nav-link" href="{{ route('trainers.specializations.create', ['profile' => $profileId, 'user' => $userId]) }}">
                    {{__('messages.specialization')}}
                </a>
            @else
                <span class="nav-link disabled">{{__('messages.specialization')}}</span>
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
        <h2>{{__('messages.personal_information')}}</h2>
    </div>

    <div class="form-container profile-form">
        <form action="{{ isset($trainerProfile) ? route('trainer.update', $trainerProfile->id) : route('trainer.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    @if(isset($trainerProfile))
        @method('PUT')
    @endif
        
       
        @php
        
       if (is_array($moodleUser)) {
    $prefix = null;
    $prefix2 = null;
    $gender = null;
    $firstName = null;
    $middleName = null;
    $familyName = null;
    $country = null;
    $residencyStatus = null;
    $residingCity = null;
    $email = null;
    $phone = null;
    $profileImage = null;
    $website = null;
    $dob = null;
    $linkedin = null;
    $instagram = null;
    $facebook = null;
    $twitter = null;
    $youtube = null;
    $otherSocialMedia = null;
    $languagesKnown = null;
    $aboutYou = null;  

    if (!empty($moodleUser['customfields'] ?? [])) {
        foreach ($moodleUser['customfields'] as $field) {
            $shortname = $field['shortname'] ?? '';
            $value = $field['value'] ?? null;

            switch ($shortname) {
                case 'dob':
                    if (is_numeric($value)) {
                        $dob = date('Y-m-d', $value);
                    } else {
                        $dob = $value;
                    }
                    break;
                case 'linkedin':
                    $linkedin = $value;
                    break;
                case 'instagram':
                    $instagram = $value;
                    break;
                case 'facebook':
                    $facebook = $value;
                    break;
                case 'twitter':
                    $twitter = $value;
                    break;
                case 'youtube':
                    $youtube = $value;
                    break;
                case 'languages':
                    $languagesKnown = $value;
                    break;
                case 'military_rank':
                    $militaryRank = $value;
                    break;
            }
        }
    }




        
   
    
} elseif (is_object($moodleUser)) {
    $firstName = !empty($moodleUser->first_name) ? $moodleUser->first_name : ($moodleUser->firstname ?? '');
}

$prefix = $moodleUser['prefix'] ?? '';
        $userName= !empty($moodleUser['user_name']) ? $moodleUser['user_name'] : ($moodleUser['username'] ?? '');
        $prefix2 = !empty($moodleUser['prefix2']) ? $moodleUser['prefix2'] : ($moodleUser['military_rank'] ?? '');
        $gender = !empty($moodleUser['gender']) ? $moodleUser['gender'] : ($moodleUser['gender'] ?? '');
        $firstName = !empty($moodleUser['first_name']) ? $moodleUser['first_name'] : ($moodleUser['firstname'] ?? '');
        $middleName = !empty($moodleUser['middle_name']) ? $moodleUser['middle_name'] : ($moodleUser['middlename'] ?? '');
        $familyName = !empty($moodleUser['family_name']) ? $moodleUser['family_name'] : ($moodleUser['lastname'] ?? '');
        $dob = !empty($moodleUser['date_of_birth']) ? $moodleUser['date_of_birth'] : ($dob ?? '');
        $country = !empty($moodleUser['country']) ? $moodleUser['country'] : ($moodleUser['country'] ?? '');
        $residencyStatus = !empty($moodleUser['residency_status']) ? $moodleUser['residency_status'] : ($moodleUser['residency_status'] ?? '');
        $residingCity = !empty($moodleUser['residing_city']) ? $moodleUser['residing_city'] : ($moodleUser['residing_city'] ?? '');
        $email = !empty($moodleUser['email']) ? $moodleUser['email'] : ($moodleUser['email'] ?? '');
        $phone = !empty($moodleUser['mobile_number']) ? $moodleUser['mobile_number'] : ($moodleUser['phone1'] ?? '');
        $profileImage = !empty($moodleUser['profile_image']) ? $moodleUser['profile_image'] : ($moodleUser['profileimageurl'] ?? '');
        $website = !empty($moodleUser['website']) ? $moodleUser['website'] : ($moodleUser['website'] ?? '');
        $twitter = !empty($moodleUser['twitter']) ? $moodleUser['twitter'] : ($twitter ?? '');
        $youtube = !empty($moodleUser['youtube']) ? $moodleUser['youtube'] : ($youtube ?? '');
        $instagram = !empty($moodleUser['instagram']) ? $moodleUser['instagram'] : ($instagram ?? '');
        $facebook = !empty($moodleUser['facebook']) ? $moodleUser['facebook'] : ($facebook ?? '');
        $linkedin = !empty($moodleUser['linkedin']) ? $moodleUser['linkedin'] : ($linkedin ?? '');
        $otherSocialMedia = !empty($moodleUser['other_socialmedia']) ? $moodleUser['other_socialmedia'] : ($moodleUser['other_socialmedia'] ?? '');
        $languagesKnown = !empty($moodleUser['languages']) ? $moodleUser['languages'] : ($languagesKnown ?? '');
        $aboutYou = !empty($moodleUser['about_you']) ? $moodleUser['about_you'] : ($moodleUser['description'] ?? '');

        @endphp

<input type="hidden" name="user_id" value="{{ $moodleUser['id'] ?? '' }}">

<input type="hidden" name="user_name" value="{{ $userName ?? ''}}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prefix">{{__('messages.prefix')}}:</label>
                    {{-- <x-select-field name="prefix" :options="['','Mr', 'Mrs', 'Ms', 'Dr']" /> --}}
              
                    <x-select-field 
    name="prefix" 
    :options="['' => 'Select...', 'Mr' => 'Mr', 'Mrs' => 'Mrs', 'Ms' => 'Ms', 'Dr' => 'Dr']" 
    :selected="$prefix ?? ''" 
/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                   
                    {{-- <x-select-field name="prefix2" :options="['','Brigadier(Ret)', 'Colonel(Ret)', 'Lieutenant Colonel(Ret)', 'Major(Ret)', 'Captain(Ret)', 'Lieutenant(Ret)']" /> --}}
                    <label for="prefix2">{{__('messages.prefix2')}}:</label>
                    <x-select-field 
                    name="prefix2" 
                    :options="['' => 'Select...',
                        'Brigadier(Ret)' => 'Brigadier(Ret)',
                        'Colonel(Ret)' => 'Colonel(Ret)',
                        'Lieutenant Colonel(Ret)' => 'Lieutenant Colonel(Ret)',
                        'Major(Ret)' => 'Major(Ret)',
                        'Captain(Ret)' => 'Captain(Ret)', 
                        'Lieutenant(Ret)' => 'Lieutenant(Ret)'
                    ]"
                    :selected="$prefix2 ?? ''" 
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('messages.gender')}}:</label>
                    <div class="d-flex justify-content-start gender-select">
                        <div class="form-check gender-radio">
                            <input 
                                type="radio" 
                                id="male" 
                                name="gender" 
                                value="male" 
                                class="form-check-input" 
                                {{ $gender === 'male' ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="male">{{__('messages.male')}}</label>
                        </div>
                        <div class="form-check gender-radio">
                            <input 
                                type="radio" 
                                id="female" 
                                name="gender" 
                                value="female" 
                                class="form-check-input" 
                                {{ $gender === 'female' ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="female">{{__('messages.female')}}</label>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
      <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">{{__('messages.first_name')}}:</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $firstName ?? '') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="middle_name">{{__('messages.middle_name')}}:</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name', $middleName ?? '') }}" >
                </div>
            </div>
      </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="family_name">{{__('messages.family_name')}}:</label>
                    <input type="text" name="family_name" value="{{ old('family_name', $familyName ?? '') }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mt-3">
                    <label for="date_of_birth">{{__('messages.date_of_birth')}}:</label>
                 
                    <input 
                        type="date" 
                        id="date_of_birth" 
                        name="date_of_birth" 
                        class="form-control"
                        value="{{ old('date_of_birth', $dob ?? '') }}" 
                        required 
                        min="1900-01-01" 
                        max="2020-12-31"
                    >
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">{{__('messages.country')}}:</label>
                    @php
                        $locale = app()->getLocale();
                        $countries = config('countries.list')[$locale] ?? config('countries.list')['en'];
                    @endphp
                   <x-select-field name="country" :options="$countries" :selected="$country ?? ''" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
    <label for="residency_status">{{ __('messages.residency_status') }}:</label>

    <x-select-field 
        name="residency_status" 
        :options="[
            '' => __('messages.select'),
           'uae_national'    => __('messages.uae_national'),
            'golden_visa'     => __('messages.golden_visa'),
            'green_visa'      => __('messages.green_visa'),
            'employment_visa' => __('messages.employment_visa'),
            'family_visa'     => __('messages.family_visa'),
            'student_visa'    => __('messages.student_visa'),
            'visitor_visa'    => __('messages.visitor_visa'),
        ]" 
        :selected="$residencyStatus ?? ''" 
    />
</div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="residing_city">{{__('messages.residing_city')}}:</label>
                    <x-select-field 
                    name="residing_city" 
                    :options="[
                        ''=>__('messages.select'), 
                    'Abu Dhabi' => __('messages.Abu_Dhabi'),
                    'Dubai' => __('messages.Dubai'),
                    'Sharjah' => __('messages.Sharjah'),
                    'Fujairah' => __('messages.Fujairah'),
                    'Umm Al Quwain' => __('messages.Umm_Al_Quwain'),
                    'Ajman' => __('messages.Ajman'),
                    'Ras Al Khaima' => __('messages.Ras_Al_Khaimah'),
                    'Al Ain' => __('messages.Al_Ain')
                    ]" 
                    :selected="$residingCity ?? ''" />
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{__('messages.email')}}:</label>
                    <input type="email" name="email" value="{{ old('email', $email ?? '') }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">{{__('messages.mobile_number')}}: </label>
                   
                    <input type="text" name="mobile_number" value="{{ old('mobile_number', $phone ?? '') }}" required>
                </div>
            </div>
            <div class="col-md-6">
    <div class="form-group w-full d-flex flex-column">
        <div class="d-flex w-full justify-between align-items-center">
            <label for="profileimage">{{__('messages.upload_photo')}}:</label>

            <div class="profile-image">
    @if (!empty($profileImage))
        @if (Str::startsWith($profileImage, 'http'))
            {{-- Use external URL directly (Moodle image) --}}
            <img src="{{ $profileImage }}" alt="Profile Image" class="rounded-full img-fluid">
        @else
            {{-- Use locally stored image --}}
            <img src="{{ asset('storage/' . $profileImage) }}" alt="Profile Image" class="rounded-full img-fluid">
        @endif
    @else
        {{-- Default placeholder --}}
        <img src="{{ asset('images/placeholder-profile.png') }}" alt="Default Placeholder" class="rounded-full img-fluid">
    @endif
</div>


            <input type="file" name="profile_image" accept="image/*">
        </div>
        <span>.jpeg / png</span>
    </div>
</div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="website">{{__('messages.website')}}: </label>
                    <input type="text" name="website" value="{{ old('website', $website ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                
                
                    <label for="linkedin">{{__('messages.linkedin')}}: </label>
                    <input type="text" name="linkedin" value="{{ old('linkedin', $linkedin ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="facebook">{{__('messages.facebook')}}: </label>
                    <input type="text" name="facebook" value="{{ old('facebook', $facebook ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="instagram">{{__('messages.instagram')}}: </label>
                    <input type="text" name="instagram" value="{{ old('instagram', $instagram ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="youtube">{{__('messages.youtube')}}: </label>
                    <input type="text" name="youtube" value="{{ old('youtube', $youtube ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="twitter">X: </label>
                    <input type="text" name="twitter" value="{{ old('twitter', $twitter ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="other_socialmedia">{{__('messages.others')}}: </label>
                    <input type="text" name="other_socialmedia" value="{{ old('other_socialmedia', $otherSocialMedia ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="languages">{{__('messages.languages_known')}}: </label>
                    <input type="text" name="languages" value="{{ old('languages', $languagesKnown ?? '') }}">
                </div>
            </div>
         
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group flex-column align-items-start">
                    <label class="w-100">{{__('messages.describe_about_you')}}:</label>
                    <textarea class="w-100" name="about_you" placeholder="Describe about you. Minimum 100 words maximum 300 words ">{{ old('about_you', str_replace('<br />', "\n", strip_tags($aboutYou ?? ''))) }}</textarea>

                </div>
                <div class="form-btn">
                    <button type="submit" class="btn btn-primary ">{{__('messages.save_and_proceed')}} </button>
                </div>
        </div>
           
           


    </form>
    </div>
</div>
@endsection
