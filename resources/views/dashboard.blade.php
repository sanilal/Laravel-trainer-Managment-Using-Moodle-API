@extends('layouts.app')

@section('content')


<div class="container dashboard-container">
    <h2 class="mb-4" style="color: var(--secondary);">Trainer Management Dashboard</h2>

    <div class="card">
        <h4>Trainers Not Yet added (from LMS)</h4>
        <p>Total: <strong>{{ count($notRegisteredLmsUsers) }}</strong></p>

        <a href="{{ url('/moodle/users') }}" class="btn btn-warning">View Unregistered Trainers</a>
    </div>

    <div class="card">
        <h4>Registered Trainers </h4>
        <p>Total: <strong>{{ $activeTrainers->count() }}</strong></p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile Progress</th>
                    <th>View</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activeTrainers as $trainer)
    @php
        $full_name = collect([
            $trainer->prefix,
            $trainer->prefix2,
            $trainer->first_name,
            $trainer->middle_name,
            $trainer->family_name
        ])->filter()->implode(' ');

        $completed = 0;
        $totalSections = 5;

        if ($trainer->personalDocuments && (
            $trainer->personalDocuments->your_id ||
            $trainer->personalDocuments->your_passport ||
            $trainer->personalDocuments->other_document
        )) {
            $completed++;
        }

        if ($trainer->specializations->count()) $completed++;
        if ($trainer->academics->count()) $completed++;
        if ($trainer->workExperiences->count()) $completed++;
        if ($trainer->trainingPrograms->count()) $completed++;

        $progress = ($completed / $totalSections) * 100;
    @endphp

    <tr>
        <td>{{ $full_name ?? 'N/A' }}</td>
        <td>{{ $trainer->email }}</td>
        <td>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar" role="progressbar"
                    style="width: {{ $progress }}%; background-color: {{ $progress >= 80 ? '#28a745' : ($progress >= 50 ? '#ffc107' : '#dc3545') }};"
                    aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                    {{ round($progress) }}%
                </div>
            </div>
        </td>
        <td>
            <a href="{{ url('/trainers/' . $trainer->id . '/show') }}" class="btn btn-info btn-sm">View</a>
        </td>
        <td>
            <a href="{{ url('/trainers/' . $trainer->id . '/edit') }}" class="btn btn-danger btn-sm">Edit</a>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
