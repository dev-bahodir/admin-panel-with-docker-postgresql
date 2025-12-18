@extends('layouts.admin')

@section('content')
    <h1>Create User</h1>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <input name="name" placeholder="Name">
        <input name="email" placeholder="Email">
        <input name="password" type="password" placeholder="Password">

        <select name="role_id">
            @foreach($roles as $role)
                <option value="{{ $role->id }}">
                    {{ $role->name }}
                </option>
            @endforeach
        </select>

        <button>Save</button>
    </form>

@endsection
