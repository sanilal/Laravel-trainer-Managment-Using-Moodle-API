@extends('layouts.app')

@section('content')
<div class="container dashboard-container">
    <h2 class="mb-4 text-secondary">{{ __('messages.dashboard_title') }}</h2>

    {{-- Admin: active trainers table --}}
    @include('dashboard.partials.active-trainers-table')

    {{-- Admin: unregistered trainers card --}}
    <div class="card mt-4">
        <h4>{{ __('messages.unregistered_trainers') }}</h4>
        <a href="{{ url('/moodle/users') }}" class="btn btn-warning">
            {{ __('messages.view_unregistered') }}
        </a>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.show-confirm').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the trainer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush