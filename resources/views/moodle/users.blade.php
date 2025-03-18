@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Moodle Users</h2>
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
                        <a href="../trainers/create/{{ $user['id'] }}" class="btn btn-success add-user-btn" data-username="{{ $user['username'] }}" data-fullname="{{ $user['fullname'] }}" data-email="{{ $user['email'] }}">
                            Add User
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".add-user-btn").forEach(button => {
        button.addEventListener("click", function () {
            const username = this.dataset.username;
            const fullname = this.dataset.fullname;
            const email = this.dataset.email;

            fetch("{{ route('moodle.users.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ username, fullname, email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    this.closest("tr").remove(); // Remove user from the list
                }
            });
        });
    });
});
</script>
@endsection
