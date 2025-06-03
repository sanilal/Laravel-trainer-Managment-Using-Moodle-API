@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-title">
     
        <h2>{{ __('messages.lms_users') }}</h2>
    </div>
   
    {{-- <p>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users</p> --}}
    <div class="d-flex flex-wrap align-items-center mb-3">
        <strong class="me-2">{{ __('messages.filter_by_email') }}</strong>
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
            {{ __('messages.all') }}
        </a>
        
    </div>
    <form method="GET" action="{{ route('moodle.users.fetch') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="email_search" class="form-control" placeholder="Search by email..." value="{{ request('email_search') }}">
            <button class="btn btn-primary" type="submit">{{__('messages.search')}}</button>
            <a href="{{ route('moodle.users.fetch') }}" class="btn btn-secondary">{{__('messages.clear')}}</a>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>{{__('messages.photo')}}</th>
                <th>{{__('messages.username')}}</th>
                <th>{{__('messages.fullname')}}</th>
                <th>{{__('messages.email')}}</th>
                <th>{{__('messages.action')}}</th>
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
                {{__('messages.add_user') }}
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
