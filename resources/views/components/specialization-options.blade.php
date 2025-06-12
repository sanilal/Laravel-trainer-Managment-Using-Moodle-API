@php
    $selectedValue = $selected ?? null;
@endphp
<optgroup label="{{__('messages.engineering_specializations')}}">
<option value="architecture" {{ $selectedValue == 'architecture' ? 'selected' : '' }}>{{ __('messages.architecture') }}</option>


    <option value="civil_engineering" {{ $selectedValue == 'civil_engineering' ? 'selected' : '' }}>{{__('messages.civil_engineering')}}</option>
    <option value="electrical_engineering" {{ $selectedValue == 'electrical_engineering' ? 'selected' : '' }}>{{__('messages.electrical_engineering')}}</option>
    <option value="mechanical_engineering" {{ $selectedValue == 'mechanical_engineering' ? 'selected' : '' }}>{{__('messages.mechanical_engineering')}}</option>
    <option value="industrial_engineering" {{ $selectedValue == 'industrial_engineering' ? 'selected' : '' }}>{{__('messages.industrial_engineering')}}</option>
    <option value="computer_engineering" {{ $selectedValue == 'computer_engineering' ? 'selected' : '' }}>{{__('messages.computer_engineering')}}</option>
    <option value="computer_science" {{ $selectedValue == 'computer_science' ? 'selected' : '' }}>{{__('messages.computer_science')}}</option>
    <option value="information_technology" {{ $selectedValue == 'information_technology' ? 'selected' : '' }}>{{__('messages.information_technology')}}</option>
    <option value="cybersecurity" {{ $selectedValue == 'cybersecurity' ? 'selected' : '' }}>{{__('messages.cybersecurity')}}</option>
    <option value="artificial_intelligence" {{ $selectedValue == 'artificial_intelligence' ? 'selected' : '' }}>{{__('messages.artificial_intelligence')}}</option>
    <option value="chemical_engineering" {{ $selectedValue == 'chemical_engineering' ? 'selected' : '' }}>{{__('messages.chemical_engineering')}}</option>
    <option value="software_engineering" {{ $selectedValue == 'software_engineering' ? 'selected' : '' }}>{{__('messages.software_engineering')}}</option>
</optgroup>

<optgroup label="{{__('messages.literary_humanities_pecializations')}}">
    <option value="arabic_language" {{ $selectedValue == 'arabic_language' ? 'selected' : '' }}>
    {{ __('messages.arabic_language') }}
</option>
    <option value="english_language" {{ $selectedValue == 'english_language' ? 'selected' : '' }}>{{__('messages.english_language')}}</option>
    <option value="history" {{ $selectedValue == 'history' ? 'selected' : '' }}>{{__('messages.history')}}</option>
    <option value="geography" {{ $selectedValue == 'geography' ? 'selected' : '' }}>{{__('messages.geography')}}</option>
    <option value="media" {{ $selectedValue == 'media' ? 'selected' : '' }}>{{__('messages.media')}}</option>
    <option value="public_relations" {{ $selectedValue == 'public_relations' ? 'selected' : '' }}>{{__('messages.public_relations')}}</option>
    <option value="journalism_and_publishing" {{ $selectedValue == 'journalism_and_publishing' ? 'selected' : '' }}>{{__('messages.journalism_and_publishing')}}</option>
    <option value="psychology" {{ $selectedValue == 'psychology' ? 'selected' : '' }}>{{__('messages.psychology')}}</option>
    <option value="social_work" {{ $selectedValue == 'social_work' ? 'selected' : '' }}>{{__('messages.social_work')}}</option>
    <option value="sociology" {{ $selectedValue == 'sociology' ? 'selected' : '' }}>{{__('messages.sociology')}}</option>
    <option value="education" {{ $selectedValue == 'education' ? 'selected' : '' }}>{{__('messages.education')}}</option>
</optgroup>


<optgroup label="{{__('messages.administrative_financial_specializations')}}">
    <option value="business_administration" {{ $selectedValue == 'business_administration' ? 'selected' : '' }}>{{__('messages.business_administration')}}</option>
    <option value="accounting" {{ $selectedValue == 'accounting' ? 'selected' : '' }}>{{__('messages.accounting')}}</option>
    <option value="marketing" {{ $selectedValue == 'marketing' ? 'selected' : '' }}>{{__('messages.marketing')}}</option>
    <option value="economics" {{ $selectedValue == 'economics' ? 'selected' : '' }}>{{__('messages.economics')}}</option>
    <option value="finance" {{ $selectedValue == 'finance' ? 'selected' : '' }}>{{__('messages.finance')}}</option>
    <option value="management_information_systems" {{ $selectedValue == 'management_information_systems' ? 'selected' : '' }}>{{__('messages.management_information_systems')}}</option>
    <option value="human_resources" {{ $selectedValue == 'human_resources' ? 'selected' : '' }}>{{__('messages.human_resources')}}</option>
    <option value="public_administration" {{ $selectedValue == 'public_administration' ? 'selected' : '' }}>{{__('messages.public_administration')}}</option>
</optgroup>

<optgroup label="{{ __('messages.art_and_design_specializations') }}">
    <option value="graphic_design" {{ $selectedValue == 'graphic_design' ? 'selected' : '' }}>{{ __('messages.graphic_design') }}</option>
    <option value="interior_design" {{ $selectedValue == 'interior_design' ? 'selected' : '' }}>{{ __('messages.interior_design') }}</option>
    <option value="fine_arts" {{ $selectedValue == 'fine_arts' ? 'selected' : '' }}>{{ __('messages.fine_arts') }}</option>
    <option value="photography" {{ $selectedValue == 'photography' ? 'selected' : '' }}>{{ __('messages.photography') }}</option>
    <option value="fashion_design" {{ $selectedValue == 'fashion_design' ? 'selected' : '' }}>{{ __('messages.fashion_design') }}</option>
    <option value="film_production" {{ $selectedValue == 'film_production' ? 'selected' : '' }}>{{ __('messages.film_production') }}</option>
</optgroup>

<optgroup label="{{ __('messages.business_and_marketing_specializations') }}">
    <option value="international_trade" {{ $selectedValue == 'international_trade' ? 'selected' : '' }}>{{ __('messages.international_trade') }}</option>
    <option value="digital_marketing" {{ $selectedValue == 'digital_marketing' ? 'selected' : '' }}>{{ __('messages.digital_marketing') }}</option>
    <option value="project_management" {{ $selectedValue == 'project_management' ? 'selected' : '' }}>{{ __('messages.project_management') }}</option>
    <option value="supply_chain" {{ $selectedValue == 'supply_chain' ? 'selected' : '' }}>{{ __('messages.supply_chain') }}</option>
    <option value="e_commerce" {{ $selectedValue == 'e_commerce' ? 'selected' : '' }}>{{ __('messages.e_commerce') }}</option>
    <option value="business_data_analysis" {{ $selectedValue == 'business_data_analysis' ? 'selected' : '' }}>{{ __('messages.business_data_analysis') }}</option>
    <option value="business_development" {{ $selectedValue == 'business_development' ? 'selected' : '' }}>{{ __('messages.business_development') }}</option>
</optgroup>

<optgroup label="{{ __('messages.environmental_and_agricultural_specializations') }}">
    <option value="agriculture" {{ $selectedValue == 'agriculture' ? 'selected' : '' }}>{{ __('messages.agriculture') }}</option>
    <option value="environmental_science" {{ $selectedValue == 'environmental_science' ? 'selected' : '' }}>{{ __('messages.environmental_science') }}</option>
    <option value="natural_resource_management" {{ $selectedValue == 'natural_resource_management' ? 'selected' : '' }}>{{ __('messages.natural_resource_management') }}</option>
    <option value="ocean_sciences" {{ $selectedValue == 'ocean_sciences' ? 'selected' : '' }}>{{ __('messages.ocean_sciences') }}</option>
    <option value="renewable_energy" {{ $selectedValue == 'renewable_energy' ? 'selected' : '' }}>{{ __('messages.renewable_energy') }}</option>
    <option value="agricultural_engineering" {{ $selectedValue == 'agricultural_engineering' ? 'selected' : '' }}>{{ __('messages.agricultural_engineering') }}</option>
    <option value="aerospace" {{ $selectedValue == 'aerospace' ? 'selected' : '' }}>{{ __('messages.aerospace') }}</option>
</optgroup>

<optgroup label="{{ __('messages.legal_and_political_specializations') }}">
    <option value="civil_law" {{ $selectedValue == 'civil_law' ? 'selected' : '' }}>{{ __('messages.civil_law') }}</option>
    <option value="criminal_law" {{ $selectedValue == 'criminal_law' ? 'selected' : '' }}>{{ __('messages.criminal_law') }}</option>
    <option value="international_law" {{ $selectedValue == 'international_law' ? 'selected' : '' }}>{{ __('messages.international_law') }}</option>
    <option value="human_rights" {{ $selectedValue == 'human_rights' ? 'selected' : '' }}>{{ __('messages.human_rights') }}</option>
    <option value="public_policy" {{ $selectedValue == 'public_policy' ? 'selected' : '' }}>{{ __('messages.public_policy') }}</option>
    <option value="political_science" {{ $selectedValue == 'political_science' ? 'selected' : '' }}>{{ __('messages.political_science') }}</option>
    <option value="international_relations" {{ $selectedValue == 'international_relations' ? 'selected' : '' }}>{{ __('messages.international_relations') }}</option>
    <option value="crisis_and_disaster_management" {{ $selectedValue == 'crisis_and_disaster_management' ? 'selected' : '' }}>{{ __('messages.crisis_and_disaster_management') }}</option>
</optgroup>

<optgroup label="{{ __('messages.brain_and_behavioral_specializations') }}">
    <option value="neuroscience" {{ $selectedValue == 'neuroscience' ? 'selected' : '' }}>{{ __('messages.neuroscience') }}</option>
    <option value="neuropsychology" {{ $selectedValue == 'neuropsychology' ? 'selected' : '' }}>{{ __('messages.neuropsychology') }}</option>
    <option value="behavioral_science" {{ $selectedValue == 'behavioral_science' ? 'selected' : '' }}>{{ __('messages.behavioral_science') }}</option>
    <option value="autism_studies" {{ $selectedValue == 'autism_studies' ? 'selected' : '' }}>{{ __('messages.autism_studies') }}</option>
    <option value="addiction_studies" {{ $selectedValue == 'addiction_studies' ? 'selected' : '' }}>{{ __('messages.addiction_studies') }}</option>
    <option value="psychotherapy" {{ $selectedValue == 'psychotherapy' ? 'selected' : '' }}>{{ __('messages.psychotherapy') }}</option>
</optgroup>


<optgroup label="{{ __('messages.social_and_intellectual_specializations') }}">
    <option value="philosophy" {{ $selectedValue == 'philosophy' ? 'selected' : '' }}>{{ __('messages.philosophy') }}</option>
    <option value="comparative_literature" {{ $selectedValue == 'comparative_literature' ? 'selected' : '' }}>{{ __('messages.comparative_literature') }}</option>
    <option value="cultural_studies" {{ $selectedValue == 'cultural_studies' ? 'selected' : '' }}>{{ __('messages.cultural_studies') }}</option>
    <option value="anthropology" {{ $selectedValue == 'anthropology' ? 'selected' : '' }}>{{ __('messages.anthropology') }}</option>
    <option value="middle_eastern_studies" {{ $selectedValue == 'middle_eastern_studies' ? 'selected' : '' }}>{{ __('messages.middle_eastern_studies') }}</option>
    <option value="religious_studies" {{ $selectedValue == 'religious_studies' ? 'selected' : '' }}>{{ __('messages.religious_studies') }}</option>
    <option value="performing_arts" {{ $selectedValue == 'performing_arts' ? 'selected' : '' }}>{{ __('messages.performing_arts') }}</option>
</optgroup>
<optgroup label="{{ __('messages.mechatronics_and_robotics_specializations') }}">
    <option value="mechatronics_engineering" {{ $selectedValue == 'mechatronics_engineering' ? 'selected' : '' }}>{{ __('messages.mechatronics_engineering') }}</option>
    <option value="robotics" {{ $selectedValue == 'robotics' ? 'selected' : '' }}>{{ __('messages.robotics') }}</option>
    <option value="automation_and_control" {{ $selectedValue == 'automation_and_control' ? 'selected' : '' }}>{{ __('messages.automation_and_control') }}</option>
    <option value="3d_printing" {{ $selectedValue == '3d_printing' ? 'selected' : '' }}>{{ __('messages.3d_printing') }}</option>
    <option value="embedded_systems" {{ $selectedValue == 'embedded_systems' ? 'selected' : '' }}>{{ __('messages.embedded_systems') }}</option>
</optgroup>

<optgroup label="{{ __('messages.programming_and_modern_tech_specializations') }}">
    <option value="game_development" {{ $selectedValue == 'game_development' ? 'selected' : '' }}>{{ __('messages.game_development') }}</option>
    <option value="data_analysis" {{ $selectedValue == 'data_analysis' ? 'selected' : '' }}>{{ __('messages.data_analysis') }}</option>
    <option value="programming_languages" {{ $selectedValue == 'programming_languages' ? 'selected' : '' }}>{{ __('messages.programming_languages') }}</option>
    <option value="app_development" {{ $selectedValue == 'app_development' ? 'selected' : '' }}>{{ __('messages.app_development') }}</option>
    <option value="web_development" {{ $selectedValue == 'web_development' ? 'selected' : '' }}>{{ __('messages.web_development') }}</option>
    <option value="networking" {{ $selectedValue == 'networking' ? 'selected' : '' }}>{{ __('messages.networking') }}</option>
    <option value="embedded_software_development" {{ $selectedValue == 'embedded_software_development' ? 'selected' : '' }}>{{ __('messages.embedded_software_development') }}</option>
</optgroup>
<optgroup label="{{ __('messages.languages_and_translation_specializations') }}">
    <option value="linguistics" {{ $selectedValue == 'linguistics' ? 'selected' : '' }}>{{ __('messages.linguistics') }}</option>
    <option value="simultaneous_interpretation" {{ $selectedValue == 'simultaneous_interpretation' ? 'selected' : '' }}>{{ __('messages.simultaneous_interpretation') }}</option>
    <option value="literary_translation" {{ $selectedValue == 'literary_translation' ? 'selected' : '' }}>{{ __('messages.literary_translation') }}</option>
    <option value="technical_translation" {{ $selectedValue == 'technical_translation' ? 'selected' : '' }}>{{ __('messages.technical_translation') }}</option>
    <option value="legal_translation" {{ $selectedValue == 'legal_translation' ? 'selected' : '' }}>{{ __('messages.legal_translation') }}</option>
    <option value="eastern_languages" {{ $selectedValue == 'eastern_languages' ? 'selected' : '' }}>{{ __('messages.eastern_languages') }}</option>
</optgroup>

<optgroup label="{{ __('messages.modern_technical_and_engineering_specializations') }}">
    <option value="software_engineering" {{ $selectedValue == 'software_engineering' ? 'selected' : '' }}>{{ __('messages.software_engineering') }}</option>
    <option value="artificial_intelligence" {{ $selectedValue == 'artificial_intelligence' ? 'selected' : '' }}>{{ __('messages.artificial_intelligence') }}</option>
    <option value="data_science_analytics" {{ $selectedValue == 'data_science_analytics' ? 'selected' : '' }}>{{ __('messages.data_science_analytics') }}</option>
    <option value="mobile_app_development" {{ $selectedValue == 'mobile_app_development' ? 'selected' : '' }}>{{ __('messages.mobile_app_development') }}</option>
    <option value="vr_ar" {{ $selectedValue == 'vr_ar' ? 'selected' : '' }}>{{ __('messages.vr_ar') }}</option>
    <option value="smart_systems" {{ $selectedValue == 'smart_systems' ? 'selected' : '' }}>{{ __('messages.smart_systems') }}</option>
    <option value="tech_systems_management" {{ $selectedValue == 'tech_systems_management' ? 'selected' : '' }}>{{ __('messages.tech_systems_management') }}</option>
    <option value="embedded_systems" {{ $selectedValue == 'embedded_systems' ? 'selected' : '' }}>{{ __('messages.embedded_systems') }}</option>
</optgroup>
<optgroup label="{{ __('messages.arts_and_media_specializations') }}">
    <option value="film_tv_production" {{ $selectedValue == 'film_tv_production' ? 'selected' : '' }}>{{ __('messages.film_tv_production') }}</option>
    <option value="digital_media" {{ $selectedValue == 'digital_media' ? 'selected' : '' }}>{{ __('messages.digital_media') }}</option>
    <option value="screenwriting" {{ $selectedValue == 'screenwriting' ? 'selected' : '' }}>{{ __('messages.screenwriting') }}</option>
    <option value="sound_music_design" {{ $selectedValue == 'sound_music_design' ? 'selected' : '' }}>{{ __('messages.sound_music_design') }}</option>
    <option value="advertising_pr" {{ $selectedValue == 'advertising_pr' ? 'selected' : '' }}>{{ __('messages.advertising_pr') }}</option>
    <option value="radio_tv_production" {{ $selectedValue == 'radio_tv_production' ? 'selected' : '' }}>{{ __('messages.radio_tv_production') }}</option>
    <option value="digital_game_design" {{ $selectedValue == 'digital_game_design' ? 'selected' : '' }}>{{ __('messages.digital_game_design') }}</option>
    <option value="animation" {{ $selectedValue == 'animation' ? 'selected' : '' }}>{{ __('messages.animation') }}</option>
    <option value="expressive_arts_dance" {{ $selectedValue == 'expressive_arts_dance' ? 'selected' : '' }}>{{ __('messages.expressive_arts_dance') }}</option>
</optgroup>

<optgroup label="{{ __('messages.space_and_aviation_specializations') }}">
    <option value="space_engineering" {{ $selectedValue == 'space_engineering' ? 'selected' : '' }}>{{ __('messages.space_engineering') }}</option>
    <option value="aeronautical_engineering" {{ $selectedValue == 'aeronautical_engineering' ? 'selected' : '' }}>{{ __('messages.aeronautical_engineering') }}</option>
    <option value="space_science" {{ $selectedValue == 'space_science' ? 'selected' : '' }}>{{ __('messages.space_science') }}</option>
    <option value="astrophysics" {{ $selectedValue == 'astrophysics' ? 'selected' : '' }}>{{ __('messages.astrophysics') }}</option>
    <option value="space_research_exploration" {{ $selectedValue == 'space_research_exploration' ? 'selected' : '' }}>{{ __('messages.space_research_exploration') }}</option>
</optgroup>


<optgroup label="{{ __('messages.management_economics_specializations') }}">
    <option value="international_project_management" {{ $selectedValue == 'international_project_management' ? 'selected' : '' }}>{{ __('messages.international_project_management') }}</option>
    <option value="international_economics" {{ $selectedValue == 'international_economics' ? 'selected' : '' }}>{{ __('messages.international_economics') }}</option>
    <option value="risk_management" {{ $selectedValue == 'risk_management' ? 'selected' : '' }}>{{ __('messages.risk_management') }}</option>
    <option value="political_economy" {{ $selectedValue == 'political_economy' ? 'selected' : '' }}>{{ __('messages.political_economy') }}</option>
    <option value="strategic_marketing" {{ $selectedValue == 'strategic_marketing' ? 'selected' : '' }}>{{ __('messages.strategic_marketing') }}</option>
    <option value="financial_management" {{ $selectedValue == 'financial_management' ? 'selected' : '' }}>{{ __('messages.financial_management') }}</option>
    <option value="financial_managerial_accounting" {{ $selectedValue == 'financial_managerial_accounting' ? 'selected' : '' }}>{{ __('messages.financial_managerial_accounting') }}</option>
</optgroup>

<optgroup label="{{ __('messages.mind_behavior_specializations') }}">
    <option value="behavioral_neuroscience" {{ $selectedValue == 'behavioral_neuroscience' ? 'selected' : '' }}>{{ __('messages.behavioral_neuroscience') }}</option>
    <option value="psychiatry" {{ $selectedValue == 'psychiatry' ? 'selected' : '' }}>{{ __('messages.psychiatry') }}</option>
    <option value="social_psychology" {{ $selectedValue == 'social_psychology' ? 'selected' : '' }}>{{ __('messages.social_psychology') }}</option>
    <option value="psychoanalysis" {{ $selectedValue == 'psychoanalysis' ? 'selected' : '' }}>{{ __('messages.psychoanalysis') }}</option>
    <option value="addiction_treatment" {{ $selectedValue == 'addiction_treatment' ? 'selected' : '' }}>{{ __('messages.addiction_treatment') }}</option>
    <option value="autism_studies" {{ $selectedValue == 'autism_studies' ? 'selected' : '' }}>{{ __('messages.autism_studies') }}</option>
    <option value="art_music_therapy" {{ $selectedValue == 'art_music_therapy' ? 'selected' : '' }}>{{ __('messages.art_music_therapy') }}</option>
</optgroup>

<option value="none" {{ $selectedValue == 'none' ? 'selected' : '' }}>{{ __('messages.no_data_available') }}</option>
