@extends('layouts.admin')

@section('content')
    <h1>{{ ucfirst($slug) }}</h1>
    <p>This is dynamic admin page: {{ $slug }}</p>
@endsection
