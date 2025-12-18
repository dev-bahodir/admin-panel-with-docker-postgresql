@extends('layouts.admin')

@section('content')
    <h1>Create Role</h1>

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Role name">

        <h4>Menus</h4>

        @foreach($menus as $menu)
            <label>
                <input type="checkbox" name="menus[]" value="{{ $menu->id }}">
                {{ $menu->title }}
            </label><br>
        @endforeach

        <button type="submit">Save</button>
    </form>


@endsection
