@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $user->name }}">
        <input name="email" value="{{ $user->email }}">
        <input name="password" type="password" placeholder="New password (optional)">

        <select name="role_id">
            @foreach($roles as $role)
                <option value="{{ $role->id }}"
                        @if($user->role_id === $role->id) selected @endif>
                    {{ strtoupper(str_replace('_', ' ', $role->name)) }}
                </option>
            @endforeach
        </select>

        <button>Update</button>
    </form>

@endsection
