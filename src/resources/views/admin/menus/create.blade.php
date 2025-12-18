@extends('layouts.admin')

@section('content')
    <h1>Create Menu</h1>

    <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
        @csrf

        <input name="title" placeholder="Title">
        <input name="slug" placeholder="Slug">
        <input name="order" type="number">
        <br>
        <input type="file" name="images[]" multiple>

        {{--@foreach($menu->images ?? [] as $index => $image)
            <h1>and</h1>

            <div>
                <img src="{{ asset('storage/' . $image['path']) }}" width="80" alt="">

                <label>
                    <input
                        type="radio"
                        name="primary_image"
                        value="{{ $index }}"
                        {{ $image['is_primary'] ? 'checked' : '' }}
                    >
                    Asosiy rasm
                </label>
            </div>
        @endforeach--}}

        <br><br>
        <button>Save</button>
    </form>
@endsection
