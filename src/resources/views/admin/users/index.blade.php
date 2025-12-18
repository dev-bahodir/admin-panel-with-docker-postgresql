@extends('layouts.admin')

@section('content')
    <h1>Users</h1>

    <a href="{{ route('admin.users.create') }}">+ Add user</a>

    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['role_name'] }}</td>
                <td>
                    @if($user['destroy'])
                        <form method="POST" action="{{ route('admin.users.destroy', $user['id']) }}">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach


    </table>
@endsection
