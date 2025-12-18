@extends('layouts.admin')

@section('content')
    <h1>Menu</h1>

    <a href="{{ route('admin.menus.create') }}">+ Add menu</a>

    <table border="1" cellpadding="5">
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Order</th>
            <th>Role</th>
        </tr>

        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu['title'] }}</td>
                <td>{{ $menu['slug'] }}</td>
                <td>{{ $menu['order'] }}</td>
                <td>
                    @foreach($menu->roles as $role)
                        {{ $role->name }}<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.menus.edit', $menu->id) }}">Edit</a>
                </td>
            </tr>

        @endforeach

    </table>
@endsection
