{{-- resources/views/components/icon.blade.php --}}
@php
    $iconPath = resource_path("svg/{$name}.svg");
@endphp

@if (file_exists($iconPath))
    {!! file_get_contents($iconPath) !!}
@else
    <!-- SVG not found -->
@endif
