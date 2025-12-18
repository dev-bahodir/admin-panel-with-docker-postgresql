@extends('layouts.admin')

@section('content')
    <h1>Roles</h1>

    <a href="{{ route('admin.roles.create') }}">+ Add role</a>

    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
        </tr>

        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>

                    @if($role->name !== 'admin')
                        <form method="POST"
                              action="{{ route('admin.roles.destroy', $role->id) }}"
                              style="display:inline;">
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
