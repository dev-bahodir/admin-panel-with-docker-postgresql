@extends('layouts.admin')

@section('content')
    <h1>Edit Menu</h1>

    <form method="POST" action="{{ route('admin.menus.update', $menu) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input name="title" value="{{ $menu->title }}">
        <input name="slug" value="{{ $menu->slug }}">
        <input name="order" type="number" value="{{ $menu->order }}">
        <br>
        <input type="file" name="images[]" multiple>

        @foreach($menu->images ?? [] as $index => $image)
            <div>
                <img src="{{ asset('storage/' . $image['path']) }}" width="80" alt="">

                <label>
                    <input
                        type="radio"
                        name="primary_image"
                        value="{{ $index }}"
                        {{ $image['is_primary'] ? 'checked' : '' }}>
                </label>
            </div>
        @endforeach

        {{--<h4>Roles</h4>
        @foreach($roles as $role)
            <label>
                <input type="checkbox"
                       name="roles[]"
                       value="{{ $role->id }}"
                    @checked($menu->roles->contains($role))>
                {{ $role->name }}
            </label><br>
        @endforeach--}}

        <br><br>
        <button>Update</button>
    </form>
@endsection
