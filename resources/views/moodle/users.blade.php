@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Moodle Users</h2>
    <p>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users</p>
    <div class="d-flex flex-wrap align-items-center mb-3">
        <strong class="me-2">Filter by email:</strong>
        @foreach(range('A', 'Z') as $letter)
            <a href="{{ request()->url() }}?prefix={{ strtolower($letter) }}"
               class="btn btn-sm me-1 mb-1 {{ request('prefix') === strtolower($letter) ? 'btn-primary' : 'btn-outline-secondary' }}">
                {{ $letter }}
            </a>
        @endforeach
        {{-- <a href="{{ request()->url() }}" class="btn btn-sm mb-1 {{ request('prefix') ? 'btn-outline-danger' : 'btn-dark' }}">
            All
        </a> --}}
        <a href="{{ request()->url() }}?prefix=all" class="btn btn-sm mb-1 {{ request('prefix') === 'all' ? 'btn-outline-danger' : 'btn-dark' }}">
            All
        </a>
        
    </div>
    <form method="GET" action="{{ route('moodle.users.fetch') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="email_search" class="form-control" placeholder="Search by email..." value="{{ request('email_search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
            <a href="{{ route('moodle.users.fetch') }}" class="btn btn-secondary">Clear</a>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
    <tr>
        <td><img src="{{ $user['profileimageurl'] }}" class="rounded-full small-thumb" alt="{{ $user['username'] }}"></td>
        <td>{{ $user['username'] }}</td>
        <td>{{ $user['fullname'] }}</td>
        <td>{{ $user['email'] }}</td>
        <td>
            <a href="../trainers/create/{{ $user['id'] }}" class="btn btn-success add-user-btn" >
                Add User
            </a>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
   
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
