@extends('layouts.admin')

@section('content')
    <h1>Edit Role</h1>

    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $role->name }}">

        <h4>Menus</h4>

        @foreach($menus as $menu)
            <label>
                <input type="checkbox" name="menus[]" value="{{ $menu->id }}"{{ in_array($menu->id, $role_menu) ? 'checked' : '' }}>
                {{ $menu->title }}
            </label><br>
        @endforeach

        <button>Update</button>


    </form>
@endsection
