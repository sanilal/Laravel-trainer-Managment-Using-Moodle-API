@extends('layouts.app') {{-- Ensure you have a base layout --}}

@section('content')
    <div class="container">
        <h2>Trainer List</h2>

        @if($trainers->isEmpty())
            <p>No trainers found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainers as $trainer)
                        <tr>
                            <td>{{ $trainer->first_name }}</td>
                            <td>{{ $trainer->id }}</td>
                            <td>{{ $trainer->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
